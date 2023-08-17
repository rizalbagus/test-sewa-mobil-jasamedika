<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="modelHeading">Create Data</h4>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" action="{{ url($route.'/'.$record->id) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row">
             <div class="col-sm-12">
                <div class="form-group">
                    <label for="merek" class="col-sm-2 control-label">Merek</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="merek" name="merek" placeholder="Enter Merk" required value="{{ $record->merek }}">
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="naa" class="col-sm-2 control-label">Model</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="model" name="model" placeholder="Enter Model" required value="{{ $record->model }}">
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="naa" class="col-sm-6 control-label">Plat Nomor (tanpa spasi)</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="platNumber" name="platNumber" placeholder="Enter Plat Number" required value="{{ $record->platNumber }}">
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="naa" class="col-sm-6 control-label">Harga Sewa</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price/day" required value="{{ $record->price }}">
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="naa" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="status">
                            <option value="3" <?= ($record->status=="3") ? 'selected' : '' ?>>Tidak Tersedia</option>
                            <option value="1" <?= ($record->status=="1") ? 'selected' : '' ?>>Tersedia</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="col-sm-offset-2 col-sm-12" align="right">
                    <button type="submit" class="btn btn-sm btn-info" >Save
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>