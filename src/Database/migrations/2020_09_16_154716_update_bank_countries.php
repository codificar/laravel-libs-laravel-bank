<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Codificar\Bank\Models\Bank;
use Codificar\Bank\Models\Country;

class UpdateBankCountries extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$locale = App::getLocale();
		
		switch ($locale) {
			case 'pt-br':
				$country = Country::getByIso('BR');
				Bank::where('country_id', null)
					->update(['country_id' => $country->id]);
				break;
			case 'pt-ao':
				$country = Country::getByIso('AO');
				Bank::where('country_id', null)
					->update(['country_id' => $country->id]);
				break;
			case 'es-cl':
				$country = Country::getByIso('CL');
				Bank::where('country_id', null)
					->update(['country_id' => $country->id]);
				break;
			case 'es-py':
				$country = Country::getByIso('PY');
				Bank::where('country_id', null)
					->update(['country_id' => $country->id]);
				break;
			case 'es':
				$country = Country::getByIso('ES');
				Bank::where('country_id', null)
					->update(['country_id' => $country->id]);
				break;
			default:
				# code...
				break;
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

	}
}
