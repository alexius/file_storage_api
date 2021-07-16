<?php


namespace App\FileManagers;


use App\Contracts\FileManagerContract;
use App\Models\File;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

/**
 * Class LocalFileManager
 * File manager for working with local storage (manage files on server).
 * @package App\FileManagers
 */
class LocalFileManager implements FileManagerContract
{
    const STORAGE_FOLDER = 'files';

    /**
     * Get file's information from DB.
     *
     * @param $systemFileName
     * @return array
     */
    public function getFileInfo($systemFileName): array
    {
        try {
            return File::where('system_name', $systemFileName)->firstOrFail()->toArray();
        } catch  (ModelNotFoundException $exception) {
            return ['error' => 'File not found.', 'status' => 400];
        }
    }

    /**
     * Download file from server.
     *
     * @param $systemFileName
     */
    public function getFile($systemFileName)
    {
        // Get file's information from DB if file is existed.
        //$file = File::find($id);
        $file = File::where('system_name', $systemFileName)->firstOrFail();

        if ($file) {
            $headers = [
                'Content-Type: ' . $file->mime_type
            ];

            return Storage::download(self::STORAGE_FOLDER . DIRECTORY_SEPARATOR . $file->system_name . '.' . $file->file_extension,
                $file->original_name, $headers);
        }

        return ['error' => 'File not found.', 'status' => 400];
    }

    /**
     * Upload file on server and store its information id DB.
     *
     * @return string
     */
    public function uploadFile($data): string
    {
        // If we use image.intervention library to change the image
        /*$img = Image::make($data);
        $mimeType = $img->mime();
        $fileSize = $img->filesize();*/

        $file = $data->file('file');

        // Store file on server and take generated name of file on server which will be used like ID for file.
        $system_name = Storage::putFile(self::STORAGE_FOLDER, $file);
        $system_name = explode(DIRECTORY_SEPARATOR, $system_name)[1];
        $system_name = explode('.', $system_name)[0];

        // Prepare data of file.
        $storedFileInfo = [
            'user_id' => $data->get('user_id'), // What user send the file in particular application.
            'original_name' => $file->getClientOriginalName(),
            'system_name' => $system_name, // Save unique file name given by system.
            'file_extension' => $file->extension(),
            'file_source' => $data->get('file_source'), // From where file has come, what particular application.
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'storage_provider' => __CLASS__, // Save information about the manager who processed the file.
        ];

        // Save file information in DB
        File::create($storedFileInfo);

        return $system_name;
    }

    /**
     * Delete file from server and from DB.
     *
     * @param $systemFileName
     * @return array
     */
    public function deleteFile($systemFileName): array
    {
        try {
            // Get file's information from DB if file is existed.
            // Otherwise get error 'File not found'.
            $file = File::where('system_name', $systemFileName)->firstOrFail();

            // Delete file from server.
            $delResult = Storage::delete(
                self::STORAGE_FOLDER . DIRECTORY_SEPARATOR . $file->system_name . '.' . $file->file_extension
            );

            // Delete file's information from DB.
            if ($delResult) {
                $file->delete();
            } else {
                return ['error' => 'File is not deleted.', 'status' => 400];
            }

            return ['message' => 'Deleted File Successfully', 'status' => $delResult];
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
    public function movingFile($id): bool
    {
        // TODO: Implement movingFile() method.
        return true;
    }
}
