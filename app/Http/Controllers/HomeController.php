<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MCar;
use App\Models\TCarLoan;
use App\Models\TCarReturn;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $car = MCar::where('created_by',Auth::user()->id)->get();
        $loan = TCarLoan::with('car','user')->where('status',1)->whereHas('car', function ($q) {
           $q->where('created_by', Auth::user()->id);
       })->get();;
        $return = TCarLoan::where('status',1)->where('user_id',Auth::user()->id)->get();

        return view('home',[
            'route' => 'home',
            'data'  => $car,
            'dataL'  => $loan,
            'dataR'  => $return
        ]);
    }

    public function profile()
    {
        $data = User::findorfail(Auth::user()->id);
        return view('master.profile.index',[
            'route' => 'home',
            'data'  => $data,
        ]);
    }

    public function update($id){
        $data = User::findOrFail($id);
        $data->update(request()->all());
    
        return redirect()->route('profile')->with('success', 'Profile Updated successfully.');
    }
}
