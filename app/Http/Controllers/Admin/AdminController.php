<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function index(Request $request){

    }
}
