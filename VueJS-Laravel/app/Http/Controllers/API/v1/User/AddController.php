<?php

namespace App\Http\Controllers\API\v1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;

class AddController extends Controller
{
    public function __invoke(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|unique:users',
    		'age' => 'required|numeric',
    		'email' => 'nullable|email'
    	]);	

    	return User::create($request->all());
    }
}
