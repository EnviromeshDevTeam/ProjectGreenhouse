<?php

namespace Database\Seeders;

use App\Models\meshData;
use Illuminate\Database\Seeder;

class MeshDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [{'category_id':1, 'device_id':1, 'data':1.0}];

        foreach ($data as $datapoint) {
            MeshData::create($datapoint);
        }
    }
}
