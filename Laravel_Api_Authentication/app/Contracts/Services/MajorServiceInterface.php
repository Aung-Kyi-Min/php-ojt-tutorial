<?php

namespace App\Contracts\Services;

/**
 * Interface for user service
 */
interface MajorServiceInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getMajors(): object;

    /**
     * Save user
     * @param array $data
     * @return void
     */
    public function createMajor(array $data): void;

    /**
     * Get user by id
     * @param int $id
     * @return object
     */
    public function getMajorById(int $id): object;

    /**
     * Update User
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateMajor(array $data, int $id): void;

    /**
     * Delete user by id
     * @param int $id
     * @return void
     */
    public function deleteMajorById(int $id): void;
}
