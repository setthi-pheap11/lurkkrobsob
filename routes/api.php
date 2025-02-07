<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

// User List API
Route::get('user-list', function(){
    return response()->json(User::all());
});
