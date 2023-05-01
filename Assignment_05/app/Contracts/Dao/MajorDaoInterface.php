<?php

namespace App\Contracts\Dao;

/**
 * Interface of Data Access Object for user
 */
interface MajorDaoInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getMajors(): object;

    /**
     * Save Major
     * @param array
     * @return void
     */
    public function createMajor(array $data): void;

    /**
     * Get Major by id
     * @param int $id
     * @return object
     */
    public function getMajorById(int $id): object;

    /**
     * Update Major
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateMajor(array $data, int $id): void;

    /**
     * Delete Major by id
     * @param int $id
     * @return void
     */
    public function deleteMajorById(int $id): void;
}
