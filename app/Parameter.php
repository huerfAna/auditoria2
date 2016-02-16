<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/** 
   ******************
   * Validaciones
   ******************
 **/
class Parameter extends Model  {

	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'aud_parameters';
	protected $fillable = ['par_first','par_finish','par_origin','par_company'];

	public $timestamps = false;


}
