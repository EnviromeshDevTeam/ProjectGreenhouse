<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Category[]|Collection|Response
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request //Request should look like \api\JSON\?
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        request()->validate([
            'name'=>'required',
        ]);

        $category = new Category();
        $category->name = $request->name;//Change this to $request->category->name?
        $category->save();
        return response()->json("New Category - {$category->name} has been saved", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name'=>'required',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();
        return response()->json("Updated Category - {$category->name} has been saved", 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json("Deleted Category - {$category->name} changes have been saved", 201);
    }
}
