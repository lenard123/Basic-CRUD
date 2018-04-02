<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class ItemController extends Controller
{

	public function index()
	{
		$items = DB::select("select * from item");
		echo json_encode($items);
	}

	public function create()
	{
		echo 'create';
	}

	public function store(Request $request)
	{
		$name = $request->input('name');
		$email = $request->input('email');
		DB::insert('insert into item (name, email) values (?, ?)', [$name, $email]);
	}

	public function show($id)
	{
		echo 'show';
	}

	public function edit($id)
	{
		echo 'edit';
	}

	public function update(Request $request, $id)
	{
		$name = $request->input('name');
		$email = $request->input('email');
		DB::update('update item set name=?, email=? where id=?',[$name, $email, $id]);
	}

	public function destroy($id)
	{
		DB::delete('delete from item where id=?', [$id]);
	}
}