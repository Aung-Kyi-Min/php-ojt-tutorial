<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportStudent implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dd($row);
        return new Student([
            'name' => $row['name'],
            'majors' => $row['majors'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'address' => $row['address'],
        ]);
    }
}
