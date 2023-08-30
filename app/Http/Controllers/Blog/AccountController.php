<?php

namespace App\Http\Controllers\Blog;

use App\Http\Requests\Account\LoginRequest;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class AccountController extends BlogBaseController
{
    public function __construct(protected UserRepositoryInterface $repository)
    {
    }

    /**
     * Display an registration form view
     */
    public function registration()
    {
        return view('blog.account.registration');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return view('post.show', ['post' => $this->repository->findById($id)]);
    }

    /**
     * @param StoreAccountRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAccountRequest $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $model = $this->repository->store($data);
        dispatch(new \App\Jobs\FinalizeNewAccount($model->id));
//        $model)($model));
//


        //dd($data);
        //return to_route('');
        return to_route('blog.home')->with('message', ['type' => 'success', 'message' => 'Konto zostało utworzone']);;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function login()
    {
        return view('blog.account.login', []);
    }


    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return ($status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])->with('message', ['type' => 'success', 'message' => 'Instrukcja została wysłana na maila'])
            : back()->withErrors(['email' => __($status)])->with('message', ['type' => 'error', 'message' => 'Nie udało się wysłać wiadomości']));

        //  return view('account.reset-password', [
        //'posts' => $this->repository->paginate(10)
    }

    /**
     * @param Request $request
     * @return void
     */
    public function resetPassword(Request $request)
    {
        dump($request);
    }

}
