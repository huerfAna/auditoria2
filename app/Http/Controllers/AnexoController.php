<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Anexo22;
use App\Infraction;
use App\Http\Requests\AnexoRequest;
use Illuminate\Routing\Route;
use Session;
use Input;


class AnexoController extends Controller
{
	protected $request;

	
	public function index()
	{
		$anexo = Anexo22::all();
		$infraccion = Infraction::lists('inf_description','id');

		return view('anexo.index')->with(['anexo' => $anexo,'infra'=>$infraccion]);	
	}
	public function store()
	{
		 $input = Input::all();
		 for($i=1; $i<179; $i++)
		 {
		 	$infra = 0;
		 	$rect = 0;
		 	$mult = 0;
		 	
		 	if(isset($input['inf_'.$i]))	
		 		$infra = $input['inf_'.$i];	
		 	if(isset($input['rect_'.$i]))
		 	$rect =  $input['rect_'.$i];	
		 	if(isset($input['mult_'.$i]))	
		 	$mult =  $input['mult_'.$i];	
		 	$id = $input['id_'.$i];
		 	$anexo = Anexo22::find($id);
		 	$anexo->a22_rectifiable = $rect;
		 	$anexo->a22_fine = $mult;
		 	$anexo->infractions_id = $infra;
		 	$anexo->save();
		 	echo $infra.$mult.$rect;
		 	
		 }

		 //return redirect()->back();
		 
	}
}


