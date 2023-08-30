<?php

namespace App\Http\Controllers\Blog;

use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
   //     return response()->json($this->repository->paginate(10)->toArray());

        return view('home', ['posts' => $this->repository->orderBy('created_at','desc')->paginate(10)]);
    }

    /**
     * Display a listing of the resource.
     */
    public function get($id)
    {
       // return response()->json($this->repository->findById($id));
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


