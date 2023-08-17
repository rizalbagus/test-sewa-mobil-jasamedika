<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MCar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Filters\MCarFilter;
use App\Http\Requests\MCarRequest;


class MCarController extends Controller
{
  protected $title = 'List Mobil yang dimiliki';
  protected $route = 'm-cars';

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    return view('master.car.index',
      [
        'route' => $this->route,
        'title' => $this->title
      ]
    );
  }

  public function list(Request $request)
  {
    if ($request->ajax()) {
      $data = MCar::latest()->where('created_by',Auth::user()->id);
      if(!empty($request->merek)){
          $data->where('merek','LIKE', "%".$request->merek."%");
      }
      if(!empty($request->model)){
          $data->where('model','LIKE',"%".$request->model."%");
      }
      if(!empty($request->status)){
          $data->where('status',$request->status);
      }
      return Datatables::of($data)
      ->addIndexColumn()
      ->addColumn('status', function($row){
        if($row->status=="3"){
          $status = "<label style='color:white'>Tidak Tersedia</label>";
        }elseif($row->status=="1"){
          $status = "<label style='color:white'>Tersedia</label>";
        }else{
          $status = "<label style='color:white'>Sedang disewa</label>";
        }
        $btn = '<a href="#" class="btn btn-info btn-sm">'.$status.'</a>';
        return $btn;
      })
      ->addColumn('price', function($row){
        $price = number_format($row->price,0,',','.');
        return "Rp. ".$price;

      })
      ->addColumn('action', function($row){
        $actionBtn = '<a href="javascript:void(0)" id="show-data" data-id="'.$row->id.'" class="edit btn btn-warning btn-sm">Edit</a> <a href="#" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
        return $actionBtn;
      })
      ->rawColumns(['action','status','price'])
      ->make(true);
    }
  }

  public function create()
  {
    return view('master.car.create',[
      'route' => $this->route
    ]);
  }

  public function edit($id)
  {
    $record = MCar::findOrFail($id);
    return view('master.car.edit',[
      'route' => $this->route,
      'record' => $record,
    ]);

  }

  public function show($id)
  {
    $record = MCar::findOrFail($id);
    return view('master.car.show',[
      'route' => $this->route,
      'record' => $record,
    ]);

  }

  public function store()
  {

    $this->validate(request(),[
      'merek' => 'required',
      'model' => 'required',
      'platNumber' => 'required',
      'price' => 'required',
    ]);
    MCar::create(request()->all());

    return redirect()->route( $this->route.'.index')->with('success', 'car Added successfully.');
  }

  public function update($id)
  {
    $data = MCar::findOrFail($id);
    
    $data->update(request()->all());

    return redirect()->route( $this->route.'.index')->with('success', 'car Updated successfully.');
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
   $item = MCar::destroy($id);
   return response()->json(['success'=>'Car deleted successfully.']);
 }

}
