<?php

namespace App\Contracts\Services;

/**
 * Interface for task service
 */
interface TaskServiceInterface
{
    /**
     * Get task list
     * @return object
     */
    public function getTasks(): object;

    /**
     * Save task
     * @param array $data
     * @return void
     */
    public function createTask(array $data): void;

    /**
     * Get task by id
     * @param int $id
     * @return object
     */
    public function getTaskById(int $id): object;

    /**
     * Delete task by id
     * @param int $id
     * @return void
     */
    public function deleteTaskById(int $id): void;
}
