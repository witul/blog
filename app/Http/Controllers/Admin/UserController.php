<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\Post;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends AdminController
{
    public function __construct(protected UserRepositoryInterface $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('admin.user.index', [
            'models' => $this->repository->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.user.create', ['roles' => Role::toSelect()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        if($request->isNotFilled('password')){
            $request->merge(['password' => Str::random(8)]);
        }
        $model = $this->repository->store($request->only(['name', 'email', 'password', 'role']));

        event(new Registered($model));

        return to_route('admin.user.edit', ['id' => $model->id])
            ->with('message', ['type' => 'success', 'message' => 'Użytkownik został dodany']);
    }


    public function resetPassword(int $id)
    {
        $model = $this->repository->findById($id);
        $status = Password::sendResetLink(['email' => $model->email]);
        return to_route('admin.user.edit', ['id' => $model->id])
            ->with('message', ['type' => 'success', 'message' => 'Link do zresetowania hasła został wysłany']);
    }

    public function verify($id)
    {

        $model = $this->repository->findById($id);
        $model->markEmailAsVerified();
        event(new Verified($model));
        return to_route('admin.user.show', ['id' => $model->id])
            ->with('message', ['type' => 'success', 'message' => 'Użytkownik został zweryfikowany']);
    }

    public function show(int $id)
    {
        return view('admin.user.show', [
            'model' => $this->repository->findById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        return view('admin.user.edit', [
            'model' => $this->repository->findById($id),
            'roles' => Role::toSelect(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, int $id)
    {

        $this->repository->update($id, $request->all());

        return to_route('admin.user.edit', ['id' => $id])
            ->with('message', ['type' => 'success', 'message' => 'Użytkownik został dodany']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteUserRequest $request)
    {
        if ($this->repository->delete($request->get('id'))){
            return to_route('admin.user.index')->with('message', ['type' => 'warn', 'message' => 'Użytkownik został usunięty']);
        }
    }
}
