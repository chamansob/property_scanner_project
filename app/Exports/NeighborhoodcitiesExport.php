<?php

namespace App\Exports;

use App\Models\Neighborhoodcity;
use Maatwebsite\Excel\Concerns\FromCollection;

class NeighborhoodcitiesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Neighborhoodcity::select('name', 'city_id')->get();
    }
}
