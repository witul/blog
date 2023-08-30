<?php

namespace App\Http\Controllers\Blog;

use App\Http\Requests\Account\AccountRequest;
use App\Http\Requests\Account\LoginRequest;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AccountController extends BlogBaseController
{
    public function __construct(protected UserRepositoryInterface $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function registration()
    {
        return view('account.registration', [
            //'posts' => $this->repository->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return view('post.show', ['post' => $this->repository->findById($id)]);
    }

    public function store(StoreAccountRequest $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        //1. mail do usera
        //2. odpowiednia rola


        $model = $this->repository->store($data);
        event(new \Illuminate\Auth\Events\Registered($model));

        //dd($data);
        //return to_route('');
        return to_route('blog.home');
    }

    public function login()
    {
        return view('account.login', []);
    }


    public function authenticate(LoginRequest $request)
    {

        $credentials = $request->only(['email', 'password']);

        if (\Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => 'Nieprawidłowe dane logowania.',
        ])->onlyInput('email');
    }


    public function logout(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     */
    public function forgotPassword()
    {
        return view('account.reset-password', [
            //'posts' => $this->repository->paginate(10)
        ]);
    }

    public function resetPassword(Request $request){
        dump($request);
    }

}
