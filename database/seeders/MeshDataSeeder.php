<?php

namespace Database\Seeders;

use App\Models\MeshData;
use Carbon\Carbon;
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
        //NORMALLY USE FACTORIES less code but each data column will have different values of data for the cat id

        $currentTime = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
        $startOfMonth = $currentTime->subMonth();

        #Change MeshData model, we are manually saving time, We intepret this from eventual Pi script
        $timeVsMoist = 0;
        $moisture = 100;
        for ($i=0; $i <= 172880; $i++) {
            MeshData::create(array(
                    'device_id' => 1,
                    'category_id' => 1,
                    'data' => rand(10,30), // Between 10 and 30 for normal operation maybe we can adjust gradient
                    'created_at' => $startOfMonth
                )
            );
            MeshData::create(array(
                    'device_id' => 1,
                    'category_id' => 2,
                    'data' => rand(40,50),//Humidity Value between 20 and 80 in relation to a percentage out of 100
                    //normal level 40-50?
                    'created_at' => $startOfMonth
                )
            );
            MeshData::create(array(
                    'device_id' => 1,
                    'category_id' => 3,
                    'data' => rand(400,500), //eC02 Equivalent Carbon dioxide is measured in a range between 400 to 8192 parts per million
                    //Normal levels are around 400
                    'created_at' => $startOfMonth
                )
            );
            MeshData::create(array(
                    'device_id' => 1,
                    'category_id' => 4,
                    'data' => rand(300 ,400), //TVOC contaminants levels are measured between 0 and 1187 parts per billion
                    //Normal levels sit between 250 and 500
                    'created_at' => $startOfMonth
                )
            );
            MeshData::create(array(
                    'device_id' => 1,
                    'category_id' => 5,
                    'data' => $moisture, //Soil moisture sensor measures conductivity changes in the earth, (Soil resistance increases with drought or less moisture)
                    //Analogue value between 0 moisture and 100 percent moisture fully wet gradual change
                    'created_at' => $startOfMonth
                )
            );
            //End of loop changes

            //Manipulate the graph to show gradual change over time.
            if ($timeVsMoist == 2161){
                //Check for 1 percent of day measurements, After a day our moisture reaches 0
                $moisture--;
                $timeVsMoist = 0;
            }
            else{
                $timeVsMoist++;
            }
            //Space records timestamped with a gap of 15 seconds between each one. After 86400 we should have a day of data
            $startOfMonth->addSeconds(30);
        }
    }
}
