@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Hello, '.Auth()->user()->name) }}
                    <hr/>
                    <div align="center">
                        <table class="table table-bordered table-responsive" align="center">
                            <thead align="center">
                                <tr>
                                    <th>Jumlah Mobil yang dimiliki</th>
                                    <th>Jumlah Mobil dimiliki yang disewa </th>
                                    <th>Jumlah Sewa Mobil lain</th>
                                </tr>
                            </thead >
                            <tbody align="center">
                                <tr>
                                    <td><b>{{ $data->count() }}</b> Mobil yang dimiliki</td>
                                    <td><b>{{ $dataL->count() }}</b> Peyewaan Mobil dimiliki</td>
                                    <td><b>{{ $dataR->count() }}</b> Sewa Mobil lain</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
