<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Blameable;
use App\Http\Filters\Filterable;
use Carbon\Carbon;
use App\Traits\Utilities;
use App\Traits\UuidTrait;

class TCarLoan extends Model
{
	use Utilities, UuidTrait, Filterable;

	public $rules = [
    'loanDate' => 'required',
    'master_car_id' => 'required',
    'returnPlanDate' => 'required',
  ];

  protected $casts = [
    'id' => 'string',
  ];
  protected $table 		= 't_car_loans';

  protected $fillable = [
    'loanDate',
    'returnPlanDate',
    'status',
    'master_car_id',
    'user_id',

  ];

  public function user(){
    return $this->belongsTo(User::class,'user_id');
  }
  public function car(){
    return $this->belongsTo(MCar::class,'master_car_id');
  }

}
