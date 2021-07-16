<?php


namespace App\Contracts;


use App\Models\File;

/**
 * Interface FileManagerContract
 * Contract (Interface) for different file managers.
 * @package App\Contracts
 */
interface FileManagerContract
{
    // Get information about file like name, extension, mime type etc.
    public function getFileInfo($systemFileName): array;

    // Load file from storage.
    public function getFile($systemFileName);

    // Upload file to the storage.
    public function uploadFile($data): string;

    // Delete file.
    public function deleteFile($systemFileName): array;

    // Move file to another storage.
    public function movingFile($systemFileName): bool;
}
