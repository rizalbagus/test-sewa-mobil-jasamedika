<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Blameable;
use App\Http\Filters\Filterable;
use Carbon\Carbon;
use App\Traits\Utilities;
use App\Traits\UuidTrait;

class TCarReturn extends Model
{
	use Utilities, UuidTrait, Filterable;

	public $rules = [
		'returnRealDate' => 'required',
	];

  protected $casts = [
    'id' => 'string',
  ];
  protected $table 		= 't_car_returns';

  protected $fillable = [
    'returnRealDate',
    'totalDay',
    'totalPrice',
    't_car_loan_id',
  ];

  public function carLoan(){
    return $this->belongsTo(carLoan::class,'t_car_loan_id');
  }
}
