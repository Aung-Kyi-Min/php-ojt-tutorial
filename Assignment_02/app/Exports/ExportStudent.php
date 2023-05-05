<?php

namespace App\Exports;

use App\Models\Major;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportStudent implements FromCollection
, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Student::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Majors',
            'Phone',
            'Email',
            'Address',
            'Created At',
            'Updated At',
        ];
    }

    public function map($student): array
    {
        return [
            $student->id,
            $student->name,
            $student->major->name,
            $student->email,
            $student->phone,
            $student->address,
            $student->created_at,
            $student->updated_at,
        ];
    }
}
