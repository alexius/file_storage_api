<?php

namespace App\Http\Controllers;

use App\Contracts\FileManagerFactoryContract;
use App\Models\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Class FileStorageController
 * Realization of API for manage the files.
 * @package App\Http\Controllers
 */
class FileStorageController extends Controller
{
    /**
     * Interface for file manager factory.
     * @var FileManagerFactoryContract
     */
    protected FileManagerFactoryContract $fileManagerFactory;

    /**
     * Create a new controller instance.
     * Realization of dependency injection.
     *
     * @return void
     */
    public function __construct(FileManagerFactoryContract $fileManagerFactory)
    {
        $this->fileManagerFactory = $fileManagerFactory;
    }

    /**
     * Get file's information.
     *
     * @param $systemFileName
     * @return JsonResponse
     */
    public function getFileInfo($systemFileName): JsonResponse
    {
        //\request()->file('file')->getFileInfo()
        $fileManager = $this->fileManagerFactory->determineFactory();
        $fileData = $fileManager->getFileInfo($systemFileName);

        return response()->json($fileData);
    }

    /**
     * Get file.
     *
     * @param $systemFileName
     * @return StreamedResponse | array
     */
    public function getFile($systemFileName)
    {
        $fileManager = $this->fileManagerFactory->determineFactory();

        return $fileManager->getFile($systemFileName);
    }

    /**
     * Upload a file to the storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function uploadFile(Request $request): JsonResponse
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:jpeg,jpg,JPG,png,gif,tif,tiff,cgm,bmp,svg,webp,mp4,mpeg,3gp,3g2,webm,weba,ts,ogv,avi'
        ]);

        $fileManager = $this->fileManagerFactory->determineFactory();
        $data = $fileManager->uploadFile($request);

        return response()->json($data, 201);
    }

    /**
     * Delete the file.
     *
     * @param $systemFileName
     * @return JsonResponse
     */
    public function deleteFile($systemFileName): JsonResponse
    {
        $fileManager = $this->fileManagerFactory->determineFactory();
        $result = $fileManager->deleteFile($systemFileName);

        return response()->json($result);
    }
}
