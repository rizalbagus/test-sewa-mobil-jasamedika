@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Transaksi') }}</div>

                <div class="card-body">
                    @if($message = Session::get('success'))

                    <div class="alert alert-success">
                        {{ $message }}
                    </div>

                    @endif
                    <div class="row">
                        <div class="col-8">
                            <h2>{{ $title }}</h2>
                        </div>
                        <div class="col-4" align="right">
                            <a class="btn btn-primary" onclick="create()">Pengembalian</a>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($data))
            <hr/>
            <div class="card">
                <div class="card-header">{{ __('Data Pemesanan') }}</div>

                <div class="card-body">
                    <div class="alert alert-success">
                        <table class="table table-bordered table-responsive">
                            <thead align="center">
                                <tr>
                                    <td>Nama</td>
                                    <td>Email</td>
                                    <td>Nomor SIM</td>
                                    <td>Nomor Telphone</td>
                                </tr>
                            </thead>
                            <tbody align="center">
                                <tr>
                                    <td>{{$data->user->name}}</td>
                                    <td>{{$data->user->email}}</td>
                                    <td>{{$data->user->SIMNumber}}</td>
                                    <td>{{$data->user->telphoneNumber}}</td>
                                </tr>
                                <tr>
                                 <td colspan="4">{{ $data->user->address }}</td> 
                             </tr>
                         </tbody>
                     </table>
                 </div>

                 <div class="row">
                    <table class="table table-bordered table-responsive">
                        <thead align="center">
                            <tr>
                                <th>Tanggal Sewa</th>
                                <th>Tanggal Rencana Kembali</th>
                                <th>Tanggal Sekarang</th>
                                <th>Merek Mobil</th>
                                <th>Model Mobil</th>
                                <th>Plat Nomor Mobil</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td>{{$data->loanDate}}</td>
                                <td>{{$data->returnPlanDate}}</td>
                                <td>{{date(now())}}</td>
                                <td>{{$data->car->merek}}</td>
                                <td>{{$data->car->model}}</td>
                                <td>{{$data->car->platNumber}}</td>
                            </tr>
                        </tbody>
                        <tfoot align="center">
                            <tr>
                                <th>Jumlah hari</th>
                                <th colspan="2">
                                    @php 
                                    $tgl1 = date_create(\Carbon\Carbon::now()->format('Y-m-d'));
                                    $tgl2 = date_create(\Carbon\Carbon::parse($data->loanDate)->format('Y-m-d'));
                                    $diff = date_diff($tgl1, $tgl2); 
                                    $selisih = $diff->format('%a');
                                    if($selisih==0){
                                        $s = $selisih+1;                                        
                                    }else{
                                        $s = $selisih;
                                    }
                                    echo $s ." hari ";
                                    @endphp
                                </th>
                                <th>Biaya Sewa</th>
                                <th colspan="2">Rp. {{ number_format($data->car->price,0,',','.')}}</th>
                                
                            </tr>
                            <tr>
                                <th colspan="2">Total Tarif</th>
                                <th colspan="4">Rp. {{ number_format($s*$data->car->price,0,',','.') }}</th>
                            </tr>
                            <tr>
                                <th colspan="6">
                                    <form class="form-horizontal" action="{{route($route.'.store')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="returnRealDate" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                        <input type="hidden" name="totalDay" value="{{ $s }}">
                                        <input type="hidden" name="totalPrice" value="{{ $s*$data->car->price }}">
                                        <input type="hidden" name="t_car_loan_id" value="{{ $data->id }}">
                                        <input type="hidden" name="master_car_id" value="{{ $data->car->id }}">
                                        klik disini jika mobil sudah dikembalikan => <input type="submit" class="btn btn-lg btn-primary" value="Mobil Sewa Kembali">
                                    </form>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        @else
        <div class="table table-bordered table-responsive" align="center">
            <h4>Data Anda Tidak ada/ mugkin nomor plat tersedia/disewa Silahkan Klik Tombol Pengembalian
            </h4>
        </div>
        @endif
    </div>
</div>
</div>
</div>

@endsection

@section('script')

@endsection
