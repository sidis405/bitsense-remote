<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends ApiController
{
    /**
    * @SWG\Get(
    *   path="/posts",
    *   summary="Show All Post",
    *   tags={"Posts"},
    *   operationId="indexPosts",
    *   produces={"application/json"},
    *   consumes={"multipart/form-data"},
    *   security={{"default": {}}},
    *   @SWG\Response(response=200, description="successful operation", @SWG\Schema(type="object")),
    *   @SWG\Response(response=500, description="internal server error")
    * )
    *
    */

    public function index()
    {
        return Post::with('user')->latest()->get();
    }

    /**
    * @SWG\Post(
    *   path="/posts",
    *   summary="Create New Post",
    *   tags={"Posts"},
    *   operationId="createPosts",
    *   produces={"application/json"},
    *   consumes={"multipart/form-data"},
    *   security={{"default": {}}},
    *   @SWG\Parameter(
     *     name="title",
     *     in="formData",
     *     description="Post Title",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="body",
     *     in="formData",
     *     description="Post Body",
     *     required=true,
     *     type="string"
     *   ),
    *   @SWG\Response(response=200, description="successful operation", @SWG\Schema(type="object")),
    *   @SWG\Response(response=422, description="wrong input"),
    *   @SWG\Response(response=500, description="internal server error")
    * )
    *
    */

    public function store(Request $request)
    {
        return auth()->user()->posts()->create($request->only('title', 'body'));
    }

    public function show(Post $post)
    {
        return $post;
    }

    /**
    * @SWG\Post(
    *   path="/posts/{$post}",
    *   summary="Update Post",
    *   tags={"Posts"},
    *   operationId="updatePosts",
    *   produces={"application/json"},
    *   consumes={"multipart/form-data"},
    *   security={{"default": {}}},
    *   @SWG\Parameter(
     *     name="post",
     *     in="formData",
     *     description="Post To Update",
     *     required=true,
     *     type="integer"
     *   ),
    *   @SWG\Parameter(
     *     name="title",
     *     in="formData",
     *     description="Post Title",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="body",
     *     in="formData",
     *     description="Post Body",
     *     required=true,
     *     type="string"
     *   ),
    *   @SWG\Response(response=200, description="successful operation", @SWG\Schema(type="object")),
    *   @SWG\Response(response=422, description="wrong input"),
    *   @SWG\Response(response=500, description="internal server error")
    * )
    *
    */

    public function update(Request $request, Post $post)
    {
        $post->update($request->only("title"));
    }

    public function destroy(Post $post)
    {
        //
    }
}
