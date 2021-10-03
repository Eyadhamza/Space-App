<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = PostResource::collection(Post::all());

        return $posts->additional([
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
        if (Post::find($id) == null){
            return [
                'data' => [],
                'status' => 'failure',
                'msg' => 'Resource was not found!',
                'code' => 404
            ];
        }
        return (new PostResource(Post::with('categories')->find($id)))
            ->additional([
            'status' => 'success',
            'msg' => '',
            'code' => 200
        ]);
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
