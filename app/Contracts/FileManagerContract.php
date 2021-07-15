<?php


namespace App\Contracts;


use App\Models\File;

interface FileManagerContract
{
    // Get information about file like name, extension, mime type etc.
    public function getFileInfo($id): array;

    // Load file from storage.
    public function getFile($id);

    // Upload file to the storage.
    public function uploadFile($data): array;

    // Delete file.
    public function deleteFile($id): array;

    // Move file to another storage.
    public function movingFile($id): array;
}
