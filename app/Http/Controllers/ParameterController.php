<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Parameter;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;

class ParameterController extends Controller
{
	
	public function index()
	{
		
	}
	public function store(Request $request)
	{		
		$emp = Session::get('empresa');  
		Parameter::where('par_company',$emp)->forceDelete();

		Parameter::create($request->all());
		
		return view('parameters')->with('data',$request->all());
	}


	
}