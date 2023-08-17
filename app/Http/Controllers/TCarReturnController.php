<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TCarReturn;
use App\Models\TCarLoan;
use App\Models\MCar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class TCarReturnController extends Controller
{
  protected $title = 'Pengembalian Mobil';
  protected $route = 't-car-returns';

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {

    return view('master.car-return.index',
      [
        'route' => $this->route,
        'title' => $this->title
      ]
    );
  }


  public function create()
  {

    return view('master.car-return.create',[
      'route' => $this->route,
      'dataOption' => MCar::where('created_by','!=',Auth::user()->id)->where('status',1)->get()
    ]);
  }

  public function store()
  {
    $this->validate(request(),[
      't_car_loan_id' => 'required',
      'returnRealDate' => 'required',
      'totalDay' => 'required',
      'totalPrice' => 'required',
    ]);
    $temp = TCarReturn::saveData(request());
    $data['status'] = "1";
    $temp1 = MCar::findOrFail(request()->master_car_id);
    $temp1->update($data);
    $temp2 = TCarLoan::findOrFail(request()->t_car_loan_id);
    $temp2->update($data);
    return redirect()->route('t-car-loans.index')->with('success', 'Rent Added successfully.');
  }

 public function check() 
 {
  $data = TCarLoan::with('car','user')->where('status',0)->where('user_id',Auth::user()->id)->whereHas('car', function ($q) {
   $q->where('platNumber', request()->platNumber);
 })->first();
  // dd($data);
  return view('master.car-return.index',
    [
      'route' => $this->route,
      'title' => $this->title,
      'data'  => $data
    ]
  );
}
}
