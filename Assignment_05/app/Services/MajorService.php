<?php

namespace App\Services;

use App\Contracts\Dao\MajorDaoInterface;
use App\Contracts\Services\MajorServiceInterface;

/**
 * major Service class
 */
class MajorService implements MajorServiceInterface
{
    /**
     * major Dao
     */
    private $majorDao;

    /**
     * Class Constructor
     * @param majorDaoInterface
     * @return void
     */
    public function __construct(MajorDaoInterface $majorDao)
    {
        $this->majorDao = $majorDao;
    }

    /**
     * Get major list
     * @return object
     */
    public function getMajors(): object
    {
        return $this->majorDao->getMajors();
    }

    /**
     * Save major
     * @param array
     * @return void
     */
    public function createMajor(array $data): void
    {
        // Mail Send Code
        $this->majorDao->createMajor($data);
    }

    /**
     * Get major by id
     * @param int $id
     * @return object
     */
    public function getMajorById(int $id): object
    {
        return $this->majorDao->getMajorById($id);
    }

    /**
     * Update major
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateMajor(array $data, int $id): void
    {
        $this->majorDao->updateMajor($data, $id);
    }

    /**
     * Delete major by id
     * @param int $id
     * @return void
     */
    public function deleteMajorById(int $id): void
    {
        $this->majorDao->deleteMajorById($id);
    }
}
