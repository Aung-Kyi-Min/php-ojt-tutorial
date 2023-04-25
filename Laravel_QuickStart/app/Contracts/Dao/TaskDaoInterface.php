<?php

namespace App\Contracts\Dao;

/**
 * Interface of Data Access Object for task
 */
interface TaskDaoInterface
{
    /**
     * Get task list
     * @return object
     */
    public function getTasks(): object;

    /**
     * Save task
     * @param array
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
