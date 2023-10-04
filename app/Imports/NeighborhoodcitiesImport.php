<?php

namespace App\Imports;

use App\Models\Neighborhoodcity;
use Maatwebsite\Excel\Concerns\ToModel;

class NeighborhoodcitiesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Neighborhoodcity(['name' => $row[0],
            'city_id'   => $row[1],
        ]);
    }
}
