<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Seeder;

class Deviceseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $devices = [[
            'id'=>'1',
            'name'=>'Environment 1 Device',
            'address'=>'00:1B:44:11:3A:B7',
        ]];
        foreach ($devices as $dev){
            Device::create($dev);
        }
    }
}
