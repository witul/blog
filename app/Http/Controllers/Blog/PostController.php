<?php

namespace App\Http\Controllers\Blog;

use App\Repositories\PostRepositoryInterface;

class PostController extends BlogBaseController
{
    public function __construct(protected PostRepositoryInterface $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home', ['posts' => $this->repository->orderBy('created_at','desc')->paginate(10)]);
    }

    /**
     * Display a listing of the resource.
     */
    public function get($id)
    {
        return view('blog.post.show', ['post' => $this->repository->findById($id)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return view('blog.post.show', ['post' => $this->repository->findById($id)]);
    }

}


