<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="modelHeading">Edit Data</h4>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" action="{{ url($route.'/'.$record->id) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row"> 
                <div class="col-4">
                    <div class="form-group">
                        <label for="naa" class="col-sm-2 control-label">Tanggal</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Enter Date" value="<?= $record->tanggal ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <label for="naa" class="col-sm-2 control-label">Jumlah</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Enter Income/Outcome" value="<?= ($record->debit==0) ? $record->credit : $record->debit ?>" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label">Kategori COA</label>
                        <select name="master_chart_of_account_id" class=" form-control" required="">
                            {!! \App\Models\MCategoryChartAccount::options('name','id',['selected' => $record->master_chart_of_account_id ],'( Pilih Kategori )')  !!}

                        </select>
                        
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="naa" class="col-sm-2 control-label">Deskripsi</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" required value="<?= $record->description ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
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