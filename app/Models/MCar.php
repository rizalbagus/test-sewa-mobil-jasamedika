<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Blameable;
use App\Http\Filters\Filterable;
use Carbon\Carbon;
use App\Traits\UtilitiesMaster;
use App\Traits\UuidTrait;

class MCar extends Model
{
	use UtilitiesMaster, UuidTrait, Filterable, Blameable;

	public $rules = [
    'merek' => 'required|max:200',
    'model' => 'required',
    'platNumber' => 'required',
    'price' => 'required'
  ];

  protected $casts = [
    'id' => 'string',
  ];
  protected $table 		= 'master_cars';

  protected $fillable = [
    'merek',
    'model',
    'platNumber',
    'price',
    'status',
    'description',
    'created_by',
    'updated_by',
  ];


}
