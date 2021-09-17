<?php

namespace App\Http\Controllers\api\api;

use App\Http\Controllers\api\Controller;
use App\Models\Category;
use App\Models\Device;
use App\Models\MeshData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JsonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return MeshData[]|Collection|Response
     */
    public function index()
    {
        return MeshData::all();
    }

    /**
     * Display the specified resource.
     *
     * @param int $device_id
     * @param int $category_id
     * @return int[]
     */
    public function show(int $device_id, int $category_id): array
    {
        $data = MeshData::all()->where('device_id', $device_id)->where('category_id', $category_id)->makeHidden(['id', 'device_id', 'category_id']);
        $category = Category::findOrFail($category_id);
        $device = Device::findOrFail($device_id);

        return [
            "device_name" => $device->name,
            "{$category->name} values" => $data
        ];
    }
}
