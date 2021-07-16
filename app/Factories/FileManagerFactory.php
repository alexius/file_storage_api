<?php


namespace App\Factories;


use App\Contracts\FileManagerContract;
use App\Contracts\FileManagerFactoryContract;

/**
 * Class FileManagerFactory
 * Class to determine which file manager to use to process the file.
 * @package App\Factories
 */
class FileManagerFactory implements FileManagerFactoryContract
{
    private function getFileManager(string $factory): FileManagerContract
    {
        $class = 'App\FileManagers\\' . $factory;
        return new $class();
    }

    /**
     * Determine the file manager.
     *
     * @return FileManagerContract
     */
    public function determineFactory(): FileManagerContract
    {
        //TODO make condition how to determine which file manager to use: Local, AWZ etc.

        return $this->getFileManager('LocalFileManager');
    }
}
