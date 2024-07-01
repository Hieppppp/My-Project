<?php

namespace App\Imports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class CoursesImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function transformDate($value, $format = 'Y-m-d'){
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\Throwable $th) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
    public function model(array $row)
    {
        if (is_null($row[0])) {
            return null;
        }

        return new Course([
            'name' => $row[0],
            'description' => $row[1],
            'start_date' => $this->transformDate(($row[2])),
            'end_date' => $this->transformDate(($row[3])),
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
        ];
        
    }

    public function customValidationMessages()
    {
        return [
            '0.required' => 'The course name is required.',
            '0.string' => 'The course name must be string.',
            '1.required' => 'The description is required.',
            '1.string' => 'The description must be string.',
            '2.required' => 'The start date is required.',
            '2.date_format' => 'The start date must be in the format YYYY-MM-DD.',
            '3.required' => 'The end date is required.',
            '3.date_format' => 'The end date must be in the format YYYY-MM-DD.',
            '3.after_or_equal' => 'The end date must be after or equal the start date.',
        ];
    }
}