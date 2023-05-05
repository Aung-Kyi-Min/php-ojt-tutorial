<?php

namespace App\Contracts\Services;

/**
 * Interface for user service
 */
interface StudentServiceInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getStudents(): object;

    /**
     * Save user
     * @param array $data
     * @return void
     */
    public function createStudent(array $data): void;

    /**
     * Get user by id
     * @param int $id
     * @return object
     */
    public function getStudentById(int $id): object;

    /**
     * Update User
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateStudent(array $data, int $id): void;

    /**
     * Delete user by id
     * @param int $id
     * @return void
     */
    public function deleteStudentById(int $id): void;

}
