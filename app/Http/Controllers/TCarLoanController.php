<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TCarLoan;
use App\Models\MCar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class TCarLoanController extends Controller
{
  protected $title = 'Sewa Mobil';
  protected $route = 't-car-loans';

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    return view('master.car-loan.index',
      [
        'route' => $this->route,
        'title' => $this->title
      ]
    );
  }

  public function list(Request $request)
  {
    if ($request->ajax()) {
      $data = TCarLoan::with('car')->where('user_id',Auth::user()->id)->latest()->get();
      return Datatables::of($data)
      ->addIndexColumn()
      ->addColumn('action', function($row){
        if($row->status==0){
        $actionBtn = '<a href="#" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
        }else{
          $actionBtn = '<a href="#" class="btn btn-info btn-sm"> Tidak ada Aksi</a>';
        }
        return $actionBtn;
      })
      ->addColumn('master_car_id',function($row){
        $price = number_format($row->car->price,0,',','.');
        return  ($row->car) ?  $row->car->merek." - ". $row->car->model ." - Rp. ". $price :"-";
      })
      ->addColumn('plat',function($row){
        $price = number_format($row->car->price,0,',','.');
        return  ($row->car) ?  $row->car->platNumber :"-";
      })
      ->addColumn('status', function($row){
        if($row->status=="0"){
          $status = "<label style='color:white'>Sewa</label>";
        }elseif($row->status=="1"){
          $status = "<label style='color:white'>Sudah dikembalikan</label>";
        }else{
          $status = "<label style='color:white'>Sedang disewa</label>";
        }
        $btn = '<a href="#" class="btn btn-info btn-sm">'.$status.'</a>';
        return $btn;
      })
      ->rawColumns(['action','master_car_id','status','plat'])
      ->make(true);
    }
  }

  public function create()
  {

    return view('master.car-loan.create',[
      'route' => $this->route,
      'dataOption' => MCar::where('created_by','!=',Auth::user()->id)->where('status',1)->get()
    ]);
  }

  public function edit($id)
  {
    $record = TCarLoan::findOrFail($id);
    return view('master.car-loan.edit',[
      'route' => $this->route,
      'record' => $record,
    ]);

  }

  public function show($id)
  {
    $record = TCarLoan::findOrFail($id);
    return view('master.car-loan.show',[
      'route' => $this->route,
      'record' => $record,
    ]);

  }

  public function store()
  {
    $this->validate(request(),[
      'loanDate' => 'required',
      'returnPlanDate' => 'required',
      'master_car_id' => 'required',
    ]);
    $temp = TCarLoan::saveData(request());

    $temp2 = MCar::findOrFail(request()->master_car_id);
    $data['status'] = "2";
    $temp2->update($data);

    return redirect()->route( $this->route.'.index')->with('success', 'Rent Added successfully.');
  }

  public function update($id)
  {
   
    return redirect()->route( $this->route.'.index')->with('success', 'Rent Updated successfully.');
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
   $temp = TCarLoan::findOrFail($id);
   $item = TCarLoan::destroy($id);
   $car = MCar::findOrFail($temp->master_car_id);
   $data['status'] = "1";
   $car->update($data);
   return response()->json(['success'=>'Rent deleted successfully.']);
 }

 public function export() 
 {
  return Excel::download(new TCarLoanExport(request()->tanggal_awal), request()->tanggal_awal.'.xlsx');
}
}
