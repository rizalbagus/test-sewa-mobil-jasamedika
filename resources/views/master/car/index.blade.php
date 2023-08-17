@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form>
                      <div class="row">
                        <div class="col-12 col-sm-6 col-lg-3">
                            <label for="users-list-role">Merek</label>
                            <fieldset class="form-group">
                                <input type="text" data-post="merek" id="dataFilter" class="form-control filter-control" placeholder="Merek">
                            </fieldset>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                          <label for="users-list-role">Model</label>
                          <fieldset class="form-group">
                            <input type="text" data-post="model" id="dataFilter" class="form-control filter-control" placeholder="Model">
                        </fieldset>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                      <label for="users-list-role">Status</label>
                      <fieldset class="form-group">
                        <select data-post='status' id="dataFilter"  class="form-control filter-control"> 
                            <option value="">Pilih Salah Satu</option>
                            <option value="3">Tidak Tersedia</option>
                            <option value="1">Tersedia</option>
                            <option value="2">Disewa</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 row">
                    <button type="button" class="btn btn-sm btn-secondary clear" >
                        <i class="flaticon-circle"></i>
                        Clear Search
                    </button>
                    <button type="button" class="btn btn-sm btn-primary filter-data">
                        <i class="flaticon-search"></i>
                        Search Data
                    </button>

                </div>
            </div>
        </form>
    </div>


</div>
<br/>
</div>
<div class="col-md-8">
    <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>

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
                    <a class="btn btn-primary" onclick="create()"> Add {{$title}}</a>
                </div>
            </div>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <!-- <th>No</th> -->
                        <th>Merek</th>
                        <th>Model</th>
                        <th>Plat Nomor</th>
                        <th>Harga Sewa/hari</th>
                        <th>Status</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
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
    fixedHeader:true,
    lengthChange: false,
    ajax: {
      url: "{{ route($route.'-list') }}",
      data: function (d) {
         d._token = "{{ csrf_token() }}";
         $('.filter-control').each(function(idx, el) {
            var name = $(el).data('post');
            var val = $(el).val();
            d[name] = val;
        })
     }
 },
 columns: [
        // {data: 'id', name: 'id'},
    {data: 'merek', name: 'merek'},
    {data: 'model', name: 'model'},
    {data: 'platNumber', name: 'platNumber'},
    {data: 'price', name: 'price'},
    {data: 'status', name: 'status'},
    {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});

   $('.filter-data').on('click', function(e) {
      table.draw();
  });

   $('.clear').on('click', function(e) {
      $(".filter-control").val('');
      table.draw();
  });

});
</script>
@endsection
