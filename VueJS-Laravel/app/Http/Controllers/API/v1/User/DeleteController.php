<?php

namespace App\Http\Controllers\API\v1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;

class DeleteController extends Controller
{
    public function __invoke(Request $request, $id)
    {
    	return response()->json(User::destroy($id));
    }
}
