<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostController extends AdminController
{
    public function __construct(protected PostRepositoryInterface $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = $this->repository->orderBy('created_at','desc')->paginate(10);
        return view('admin.post.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = $this->repository->store($request->all());
        return to_route('admin.post.edit', ['id' => $post->id])
            ->with('message', ['type' => 'success', 'message' => 'Wpis został dodany']);
    }

    public function show(int $id)
    {
        return view('admin.post.show', [
            'post' => $post = $this->repository->findById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        return view('admin.post.edit', [
            'model' => $this->repository->findById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, int $id)
    {
        if ($this->repository->update($id, $request->all())) {
            return to_route('admin.post.edit', ['id' => $id])
                ->with('message', ['type' => 'success', 'message' => 'Wpis został zaktualizowany']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeletePostRequest $request)
    {
        if ($this->repository->delete($request->get('id'))){
            return to_route('admin.post.index')->with('message', ['type' => 'warn', 'message' => 'Wpis został usunięty']);
        }
    }
}
