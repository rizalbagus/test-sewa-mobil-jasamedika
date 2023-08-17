<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="modelHeading">Create Data</h4>
    </div>
    <div class="modal-body">
     <form class="form-horizontal" action="{{route($route.'.check')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row"> 
            <div class="col-12">
                <div class="form-group">
                    <label for="naa" class="col-sm-12 control-label">Masukkan Plat Nomor Kendaraan</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="platNumber" name="platNumber" placeholder="Enter Car Plat Number" value="" required>
                    </div>
                </div>
            </div>
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