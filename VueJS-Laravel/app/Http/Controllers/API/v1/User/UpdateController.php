<?php

namespace App\Http\Controllers\API\v1\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Model\User;

class UpdateController extends Controller
{
    public function __invoke(Request $request, $id)
    {
    	$this->validate($request,[
    		'name'=> ['required', Rule::unique('users')->ignore($id)],
    		'age' => 'required|numeric',
    		'email' => 'nullable|email'
    	]);

    	User::find($id)->update($request->all());

    	return User::find($id);
    }
}
