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
                            <a class="btn btn-primary" onclick="create()"> Add {{ $title }}</a>
                        </div>
                    </div>
                    <table class="table table-bordered data-table">
                        <thead align="center">
                            <tr>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Rencana Kembali</th>
                                <th>Mobil</th>
                                <th>Plat Nomor</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
  $(function () {

     var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route($route.'-list') }}",
        columns: [
            {data: 'loanDate', name: 'loanDate'},
            {data: 'returnPlanDate', name: 'returnPlanDate'},
            {data: 'master_car_id', name: 'master_car_id'},
            {data: 'plat', name: 'plat'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
    });


 });
</script>
@endsection
