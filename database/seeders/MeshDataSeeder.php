<?php

namespace Database\Seeders;

use App\Models\meshData;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;

class MeshDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents("database/seeders/data/Meshdata.json");
        $data = json_decode($json);

        foreach ($data as $obj) {
            MeshData::create(array(
                'device_id' => $obj->device_id,
                'category_id' => $obj->category,
                'data' => $obj->data,
                )
            );
        }
    }
}
