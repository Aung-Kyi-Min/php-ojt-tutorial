<?php

namespace App\Dao;

use App\Contracts\Dao\MajorDaoInterface;
use App\Models\Major;

class MajorDao implements MajorDaoInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getMajors(): object
    {
        return Major::latest()->paginate(10);
    }

    /**
     * Save user
     * @param array
     * @return void
     */
    public function createMajor(array $data): void
    {
        Major::create([
            'name' => $data['name'],
        ]);
    }

    /**
     * Get user by id
     * @param int $id
     * @return object
     */
    public function getMajorById($id): object
    {
        return Major::findOrFail($id);
    }

    /**
     * Update User
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateMajor(array $data, $id): void
    {
        $major = Major::findOrFail($id);
        $major->update([
            'name' => $data['name'],
        ]);
    }

    /**
     * Delete user by id
     * @param int $id
     * @return void
     */
    public function deleteMajorById($id): void
    {
        $major = Major::findOrFail($id);
        $major->delete();
    }
}
