<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryResource::collection(Category::all());

        return $categories->additional([
            'status' => 'success' ,
            'msg' => '',
            'code' => 200
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        if (Category::find($id) == null){
            return [
                'data' => [],
                'status' => 'failure',
                'msg' => 'Resource was not found!',
                'code' => 404
            ];
        }
        return (new CategoryResource(Category::with('posts')->find($id)))
            ->additional([
                'status' => 'success',
                'msg' => '',
                'code' => 200
            ]);
    }

    public function update(Request $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        //
    }
}
