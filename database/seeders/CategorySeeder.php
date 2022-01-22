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
                "name"=>"temperature",
            ],
            [
                "id" =>2,
                "name"=>"humidity",
            ],
            [
                "id" =>3,
                "name"=>"eco2",
            ],
            [
                "id" =>4,
                "name"=>"tvoc",
            ],
            [
                "id" =>5,
                "name"=>"moisture",
            ],
       ];

        foreach($cats as $cat){
            Category::create($cat);
        }
    }
}
