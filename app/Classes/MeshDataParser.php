<?php


namespace App\Classes;


use App\Models\MeshData;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use function PHPUnit\Framework\throwException;


class MeshDataParser
{
    //Return 6 recordings of each category
    public function returnFromTimeScale($timescale, $_device_id, $_catNum, $_is_api = False): array
    {
        $givenTimescaleReturn = [];

        $CONST_TIME_SCALES = array(
            "1H" => 10,
            "4H" => 40,
            "12H" => 120,
            "24H" => 240,
            "6D" => 1440,
            "30D" => 7200
        );
//        Carbon::setTestNow('2022-02-15 07:46:32');
        $current_timestamp = Carbon::now();

        $oldest_timestamp = Carbon::parse(DB::table('mesh_data')->orderBy('created_at', 'asc')->first()->created_at);

        $timescale_interval = $CONST_TIME_SCALES[$timescale];

        $time_diff = $current_timestamp->copy()->diffInMinutes($oldest_timestamp->toDateTimeString());

        //BREAK OUT OF FUNCTION IF SELECTED TIMESCALE DOES NOT EXIST
        if ($time_diff < $timescale_interval * 6) {
            echo "Interval Gathering not long enough or enough data yes (Wait a month)";
            throw new Exception('Selected interval does not exist in our database');
        }

        $date_querystart = Carbon::createFromFormat('Y-m-d H:i:s', $current_timestamp->copy())
            ->subMinutes($timescale_interval * 6);


        if (!$_is_api) //If not api then add google charts header, Called up here because we only want it to happen once
        {
            array_push($givenTimescaleReturn, ['created_at', 'data']);
        }

        for ($i = 1; $i <= 6; $i++) {
            //We clone the initial timestamp because Carbon will change the original everytime we use a method on it

            $envValue = MeshData::where('created_at', '<=', ($date_querystart->copy()->addMinutes($timescale_interval * $i)))
                ->where('category_id', $_catNum)
                ->where('device_id', $_device_id)
                ->orderBy('created_at', 'desc')
                ->limit(1)
                ->get(['created_at', 'data']);

            foreach ($envValue as $eVal) {
                $_arr2Push = [];
                if ($_is_api) {
                    $_arr2Push = ['date' => $eVal->created_at->toDateTimeString(), 'value' => $eVal->data];
                } else {
                    $_arr2Push = [$eVal->created_at->toDateTimeString(), $eVal->data];
                }
                array_push($givenTimescaleReturn, $_arr2Push);
            }
        }
        return $givenTimescaleReturn;
    }
}
