<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Infraction;
use App\Sanction;
use App\Anexo22;
use App\Http\Requests\InfractionRequest;
use Illuminate\Routing\Route;
use Session;

class InfractionController extends Controller
{
	protected $request;

	public function __construct()
	{
		$this->beforeFilter('@findInfraction', ['only' => ['edit','update']]);
		$this->beforeFilter('@listFines', ['only' => ['create','edit']]);		
	}
	public function findInfraction(Route $route)
	{
		$this->infraccion = Infraction::findOrFail($route->getParameter('infraction'));
	}
	public function listFines()
	{
		$this->multas = \DB::table('aud_fines')->lists('type','id');
	}
	public function index()
	{
		$data = Infraction::all();
		$anexo = Anexo22::all();
		$infraccion = Infraction::lists('inf_description','id');

		return view('infraction.index')->with(["data" => $data,'anexo' => $anexo,'infra' => $infraccion]);
	}
	public function create()
	{		
		return view('infraction.create')->with(['multas' => $this->multas]);
	}
	public function edit($id)
	{
		return view('infraction.edit')->with(['infraccion' => $this->infraccion,'multas' => $this->multas]);
	}
	public function store(InfractionRequest $request)
	{
		Infraction::create($request->all());
		Session::flash('flash_message', 'Infracción creada!');

		return redirect()->route('infraction.index');	
	}
	public function update(InfractionRequest $request, $id)
	{
		$this->infraccion->fill($request->all());
		$this->infraccion->save();	
		Session::flash('flash_message', 'Infracción modificada!');

		return redirect()->route('infraction.index');	
	}
	public function destroy($id)
	{
		Infraction::destroy($id);
		Session::flash('flash_message', 'Infracción eliminada!');

		return redirect()->back();
	}

	
}