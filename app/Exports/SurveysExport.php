<?php

namespace App\Exports;

use App\Survey;
use Maatwebsite\Excel\Concerns\FromCollection;

class SurveysExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Survey::whereBetween('id', [1,500])->get();
    }
}
