<?php

namespace Codificar\Bank\Models;

use Illuminate\Database\Eloquent\Relations\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Eloquent;

class Bank extends Eloquent
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'bank';
	
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = true;

    protected $fillable = array('id', 'name', 'code', 'agency_max_length', 'agency_digit_required', 'agency_digit_max_length', 'account_max_length',
        'account_digit_required', 'account_digit_max_length');

    public static function buildTreeData(){
        $treeData = [] ;
        $banks = self::all();

        foreach($banks as $bank){
            $treeChild = new stdClass ;
            $treeChild->text = $bank->name ;
            $treeChild->href = $bank->id ;
            $treeChild->nodes = [];
            $treeData[] = $treeChild ;
        }

        return $treeData ;
	}

	public function search($id = null, $name = null, $code = null, $agency_max_length = null, $agency_digit_required =
        null, $agency_digit_max_length = null, $account_max_length = null, $account_digit_required = null,
        $account_digit_max_length = null
    )
    {
        $query = self::query();

        if ($id) {
            $query->find($id);
        }
        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }
        if ($code) {
            $query->where('code', $code);
        }
        if ($agency_max_length) {
            $query->where('agency_max_length', $agency_max_length);
        }        
        if ($agency_digit_required != null) {
            if($agency_digit_required == 1){
                $query->where('agency_digit_required',true);
            }else{
                $query->where('agency_digit_required',false);
            }
        }
        if ($agency_digit_max_length) {
        $query->where('agency_digit_max_length', $agency_digit_max_length);
        }

        if ($account_max_length) {
        $query->where('account_max_length', $account_max_length);
        }
        if ($account_digit_required != null) {
            if($account_digit_required == 1){
                $query->where('account_digit_required',true);
            }else{
                $query->where('account_digit_required',false);
            }
        
        }
        if ($account_digit_max_length) {
        $query->where('account_digit_max_length', $account_digit_max_length);
        }

        return $query->select("bank.*");

    }
	
	/**
	 * Obtém o banco pelo ID
	 * 
	 * @return void
	 */
	public static function getById($id)
	{
		return self::where('id', '=', $id)->first();
	}	

	public static function getBankCode($id)
	{
		$bank = self::where('id', '=', $id)->first();
		
		return $bank->code;
	}
}
