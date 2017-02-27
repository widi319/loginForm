<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header bg-red">
            <h2>
                ANDA BELUM MENDAFTARKAN RT RW NET <small>Silahkan isi nama RT RW NET anda di bawah ini...</small>
            </h2>

        </div>
        <div class="body">
          <form id="form_advanced_validation" method="POST" action="{{url('rtrwnet/validBaruDashboard')}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <div class="row clearfix">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" align="centel">

            <div align="center">
              <img src="{{url('themes/images/no_image1.jpg')}}" style="width:90%; hight:auto; border:solid 1px #cccccc;">
              <br><br>
              <div class="fileUpload btn btn-primary">
              <span>Upload Gambar</span>
              <input type="file" class="upload" name="logo" id="logo"  />

              </div>
              <div class="col-pink">

              </div>
            </div>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <label for="email_address">Nama RT RW NET</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" class="form-control" value="" name="nama" minlength="3" required>

                        <div class="col-pink">
                        {{ $errors->first('name') }}
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary waves-effect" type="submit">
                  {{ isset($data->id) ? 'Edit' : 'Simpan' }}
                </button>

          </div>
        </div>
      </form>
    </div>
</div>
