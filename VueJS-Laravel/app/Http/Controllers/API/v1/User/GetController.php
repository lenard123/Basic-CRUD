<?php

namespace App\Http\Controllers\API\v1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;

class GetController extends Controller
{
    public function __invoke(Request $request)
    {
    	return User::all()->paginate(10);
    }
}
