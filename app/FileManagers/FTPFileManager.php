<?php


namespace App\FileManagers;


use App\Models\File;

class FTPFileManager implements \App\Contracts\FileManagerContract
{

    public function getFileInfo($id): array
    {
        // TODO: Implement getFileInfo() method.
    }

    public function getFile($id)
    {
        // TODO: Implement getFile() method.
    }

    public function uploadFile(): File
    {
        // TODO: Implement uploadFile() method.
    }

    public function deleteFile($id): array
    {
        // TODO: Implement deleteFile() method.
    }

    public function movingFile($id): array
    {
        // TODO: Implement movingFile() method.
    }
}
