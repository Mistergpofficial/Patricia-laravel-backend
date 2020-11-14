<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class UserController extends Controller
{
    public function currentUser(){
		return Auth::user();
	}
}
