<?php


namespace App\Contracts;

/**
 * Interface FileManagerFactoryContract
 * Contract for file manager, who determine which file manager to use.
 * @package App\Contracts
 */
interface FileManagerFactoryContract
{
    public function determineFactory();
}
