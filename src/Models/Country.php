<?php

namespace Codificar\Bank\Models;

use Codificar\Bank\Models\Bank;

use Illuminate\Database\Eloquent\Relations\Model;
use Eloquent;

class Country extends Eloquent
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'country';
	
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = true;

    protected $fillable = array('id', 'name','iso', 'phone_code');
    
    public function banks() {
        return $this->hasMany(Bank::class);
    }

	public function getNamePhoneCodeAttribute()
	{
		return $this->name .' +'. $this->phone_code;
	}

	public function getPlusPhoneCodeAttribute()
	{
		return '+'. $this->phone_code;
    }
    
	
}