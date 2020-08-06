<?php

namespace Codificar\Bank\Models;

use Illuminate\Database\Eloquent\Relations\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Eloquent;
use Finance;


class Bank extends Eloquent
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // protected $table = 'finance';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


}
