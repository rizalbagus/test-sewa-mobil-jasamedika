<?php
namespace App\Filters;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Filters\QueryFilters;

class MCarFilter extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function id($term){
        return $this->builder->where('id', $term);
    }
    public function merek($term){
        return $this->builder->where('merek', $term);
    }
    public function model($term){
        return $this->builder->where('model', $term);
    }
    public function status($term){
        return $this->builder->where('status', $term);
    }

    public function sort($array) {
        $myArray = explode(',', $array);
        foreach ($myArray as $value) {
              $this->builder->orderBy($value,'desc');
        }
    }


    public function sort_date($type = null) {
        return $this->builder->orderBy('created_at', (!$type || $type == 'asc') ? 'desc' : 'desc');
    }

    public function sort_name($type = null) {
        return $this->builder->orderBy('title', (!$type || $type == 'asc') ? 'asc' : 'desc');
    }
}
