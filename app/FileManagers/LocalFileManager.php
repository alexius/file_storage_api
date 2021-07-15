<?php


namespace App\FileManagers;


use App\Contracts\FileManagerContract;
use App\Models\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

/**
 * Class LocalFileManager
 * File manager for working with local storage (manage files on server).
 *
 * @package App\FileManagers
 */
class LocalFileManager implements FileManagerContract
{
    /**
     * Get file's information from DB.
     *
     * @param $id
     * @return array
     */
    public function getFileInfo($id): array
    {
        return File::find($id)->toArray();
    }

    /**
     * Download file from server.
     *
     * @param $id
     */
    public function getFile($id)
    {
        // Get file's information from DB if file is existed.
        $file = File::find($id);

        if ($file) {
            $headers = [
                'Content-Type: ' . $file->mime_type
            ];

            return Storage::download($file->system_name, $file->original_name, $headers);
        } else {
            return ['error' => 'File not found.', 'status' => 400];
        }
    }

    /**
     * Upload file on server and store its information id DB.
     *
     * @return array
     */
    public function uploadFile($data): array
    {
        // If we use image.intervention library to change the image
        /*$img = Image::make($data);
        $mimeType = $img->mime();
        $fileSize = $img->filesize();*/

        $userId = $data->get('user_id');
        $data = $data->file('file');

        // Prepare data of file.
        $storedFileInfo = [
            'user_id' => $userId,
            'original_name' => $data->getClientOriginalName(),
            'file_extension' => $data->extension(),
            'mime_type' => $data->getMimeType(),
            'file_size' => $data->getSize(),
            'file_type' => $data->getType(),
            'storage_provider' => 'LocalFileManager',
            'system_name' => Storage::putFile('files', $data)
        ];

        // Save file information in DB
        $file = File::create($storedFileInfo);

        return $storedFileInfo;
    }

    /**
     * Delete file from server and from DB.
     *
     * @param $id
     * @return array
     */
    public function deleteFile($id): array
    {
        try {
            // Get file's information from DB if file is existed.
            // Otherwise get error 'File not found'.
            $file = File::findOrFail($id);

            // Delete file from server.
            Storage::delete($file->system_name);

            // Delete file's information from DB.
            $file->delete();

            return ['message' => 'Deleted File Successfully', 'status' => 200];
        } catch (ModelNotFoundException $exception) {
            return ['error' => 'File not found.', 'status' => 400];
        }
    }

    /**
     * Move files to another storage.
     *
     * @param $id
     * @return array
     */
    public function movingFile($id): array
    {
        // TODO: Implement movingFile() method.
    }
}
