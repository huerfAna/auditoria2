<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Result;
use App\Validation;
use App\Checklist;
use Session;
use Input;
use App\Http\Requests\ListRequest;


class ListController extends Controller
{
	 
	public function create()
	{
		$documentos = \DB::connection('master')->table('mdb_tipodocum')->lists('doc_nombre','doc_clave');		
		$transporte = \DB::connection('master')->table('mdb_transp')->lists('tra_medio','tra_clave');		
		$empresa = Session::get('empresa');

		$check = \DB::select('select * from auditoria.aud_checklist chk INNER JOIN secenetc_master_mdb.mdb_tipodocum td ON chk.chk_document = td.doc_clave INNER JOIN secenetc_master_mdb.mdb_transp trans ON chk.chk_transport = trans.tra_clave 	WHERE chk_company = ?', [$empresa]);

		//$check  = DB::raw()Checklist::join('')->where('chk_company',$empresa)->get();

		return view('checklist.create')->with(['documents' => $documentos,'transport' => $transporte,'company' => $empresa,'check' => $check]);
	}
	public function show($referen)
	{
		$empresa = Session::get('empresa');
		//Expedient::where('exp_referen',$referen)->delete();
		//$documentos = \DB::connection('master')->table('mdb_tipodocum')->select('doc_clave','doc_nombre')->get();		
		/*foreach ($documentos as $doc) 
		{
			$result = Result::where('res_referen', $referen)->first();
			if(!empty($result))
			{
				$validacion = Validation::where('attribute_id',9)->where('id',$result->validations_id)->whereRaw('SUBSTRING_INDEX(val_data, "|", 1) = '.$doc->doc_clave)->count();
				if($validacion > 0)
				{
					$imagen = \DB::connection('users')->table('opauimg')->where('pk_referencia',$referen)->where('imgtipodoc',$doc->doc_clave)->count();
					if($imagen > 0 )
						$check = 1;
					else
						$check = 0;
				}
				else
				{
					$check = 2;
				}
			}
			else
			{
				$check = 0;
			}
			$data = [
				"chk_referen"  => $referen,
				"chk_document" => $doc->doc_nombre,
				"chk_status"   => $check,
				"chk_company"  => $empresa
			];
			Checklist::create($data);
		}*/

        
        $pedimento = \DB::connection('users')->table('optr01')->select('ref_transport1','ref_tipo')->where('pk_referencia',$referen)->first();


        /*$resultado = Result::join('aud_validations' , 'aud_results.validations_id' ,'=' , 'aud_validations.id')
            ->join('aud_anexo22' , 'aud_validations.anexo22_id' , '=' , 'aud_anexo22.id')
            ->join('aud_infractions' , 'aud_anexo22.infractions_id' , '=' , 'aud_infractions.id')
            ->leftjoin('aud_solutions' , 'aud_results.id' ,'=' , 'aud_solutions.results_id')
            ->select('aud_solutions.id as idsol','res_referen','aud_results.id as id','a22_name','val_description','inf_fundament','inf_description','inf_valmax','res_status','inf_fine')
            ->where('res_status',0)->where('res_referen','like','%'.$referen.'%')
            ->orderby('res_referen')
            ->get();*/
        $result =  Checklist::where('chk_opera',$pedimento->ref_tipo)->where('chk_transport',$pedimento->ref_transport1)->get();

        
       // return view('results')->with(['result'=> $resultado]);
		return view('list_document')->with(['document'=>$result,'referen'=>$referen]);
	}	
	/*public function update (ListRequest $request, $referen)
	{	
		//Checklist::where('chk_referen',$referen)->delete();
		//$id = 'chk'.$request->chk_id;		
		
		return $request->all();
	}*/
	public function store(ListRequest $request)
	{		
		$campos = $request->all();
		Checklist::create($campos);
	}

}