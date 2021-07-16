<?php


namespace App\FileManagers;


use App\Models\File;

/**
 * Class FTPFileManager
 * Realization of FTP file storage manager.
 * @package App\FileManagers
 */
class FTPFileManager implements \App\Contracts\FileManagerContract
{

    public function getFileInfo($systemFileName): array
    {
        // TODO: Implement getFileInfo() method.
    }

    public function getFile($systemFileName)
    {
        // TODO: Implement getFile() method.
    }

    public function uploadFile($data): array
    {
        // TODO: Implement uploadFile() method.
    }

    public function deleteFile($systemFileName): array
    {
        // TODO: Implement deleteFile() method.
    }

    public function movingFile($systemFileName): bool
    {
        // TODO: Implement movingFile() method.
    }
}
