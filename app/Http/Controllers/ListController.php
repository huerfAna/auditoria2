<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Result;
use App\Validation;
use App\Checklist;
use Session;
use Input;
use App\Record;
use App\Http\Requests\ListRequest;


class ListController extends Controller
{
	 
	public function create()
	{
		$documentos = \DB::connection('master')->table('mdb_tipodocum')->lists('doc_nombre','doc_clave');		
		$transporte = \DB::connection('master')->table('mdb_transp')->lists('tra_medio','tra_clave');		
		$empresa = Session::get('empresa');

		$check = \DB::select('select chk.id as id, doc_nombre, chk_opera,chk_required,tra_medio from auditoria.aud_checklist chk INNER JOIN secenetc_master_mdb.mdb_tipodocum td ON chk.chk_document = td.doc_clave INNER JOIN secenetc_master_mdb.mdb_transp trans ON chk.chk_transport = trans.tra_clave 	WHERE chk_company = ?', [$empresa]);

		//$check  = DB::raw()Checklist::join('')->where('chk_company',$empresa)->get();

		return view('checklist.create')->with(['documents' => $documentos,'transport' => $transporte,'company' => $empresa,'check' => $check]);
	}
	public function show($referen)
	{
		$empresa = Session::get('empresa');
        $pedimento = \DB::connection('users')->table('optr01')->select('ref_transport1','ref_tipo')->where('pk_referencia',$referen)->first();
        $result = \DB::select('select chk.id as id,chk_document,doc_nombre,chk_required from auditoria.aud_checklist chk INNER JOIN secenetc_master_mdb.mdb_tipodocum td ON chk.chk_document = td.doc_clave WHERE chk_opera = ? AND  chk_transport = ?', [$pedimento->ref_tipo,$pedimento->ref_transport1]);
        
		return view('administration.list')->with(['document'=>$result,'referen'=>$referen]);
	}	
	public function update (ListRequest $request, $referen)
	{	
		$empresa = Session::get('empresa');
		$input = Input::all();
		$pedimento = \DB::connection('users')->table('optr01')->select('ref_transport1','ref_tipo')->where('pk_referencia',$referen)->first();
		$result = Checklist::where('chk_opera', $pedimento->ref_tipo)->where('chk_transport',$pedimento->ref_transport1)->get();
		foreach ($result as $res) {
			$doc = $input['id_'.$res->id];
		 	$digital = 0;
		 	$fisico = 0;
		 	
		 	if(isset($input['exp_digital_'.$res->id]))	
		 		$digital = $input['exp_digital_'.$res->id];	
		 	if(isset($input['exp_material_'.$res->id]))
		 		$fisico =  $input['exp_material_'.$res->id];	

			Record::updateOrCreate(['exp_referen'=>$referen,'exp_document'=>$doc],['exp_material' => $fisico,'exp_company'=>$empresa,'exp_digital'=>$digital]);
		//$id = 'chk'.$request->chk_id;		
		}
		return redirect()->back();
	}
	public function store(ListRequest $request)
	{		
		$campos = $request->all();
		Checklist::create($campos);

		return redirect()->back();
	}

	public function destroy($id)
	{
		Checklist::destroy($id);
		Session::flash('flash_message', 'check eliminada!');

		return redirect()->back();
	}

}