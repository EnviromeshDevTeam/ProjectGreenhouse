<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = [
            [
                "id" =>1,
                "name"=>"temp",
            ],
            [
                "id" =>2,
                "name"=>"humidity",
            ],
            [
                "id" =>3,
                "name"=>"eCO2",
            ],
            [
                "id" =>4,
                "name"=>"TVOC",
            ],
            [
                "id" =>5,
                "name"=>"soilMoist",
            ],
            [
                "id" =>6,
                "name"=>"cpuTemp",
            ]
       ];

        foreach($cats as $cat){
            Category::create($cat);
        }
    }
}
