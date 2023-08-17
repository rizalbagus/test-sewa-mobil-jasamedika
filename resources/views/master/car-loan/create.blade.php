<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="modelHeading">Create Data</h4>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" action="{{route($route.'.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="status" value="0">
            <div class="row"> 
                <div class="col-6">
                    <div class="form-group">
                        <label for="naa" class="col-sm-12 control-label">Tanggal Pinjam</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="loanDate" name="loanDate" placeholder="Enter Date" value="" required>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="naa" class="col-sm-12 control-label">Tanggal Kembali</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="returnDate" name="returnPlanDate" placeholder="Enter Date" value="" required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label class="control-label col-sm-6">Pilih Mobil</label>
                    <select name="master_car_id" class=" form-control" required="">
                        @foreach($dataOption as $do)
                        <option value="{{ $do->id }}">{{$do->merek.' - '.$do->model.' - '.$do->price.'/day'}}</option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-sm-12" align="right">
                <div class="form-group">
                    <br/>
                    <button type="submit" class="btn btn-sm btn-info" >Save
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>