<?php

namespace App\Imports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentImport implements ToArray, WithHeadingRow, WithStartRow
{
    use HasFactory;

    function array(array $array) {
        return $array;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function headingRow()
    {
        return 1;
    }
}
