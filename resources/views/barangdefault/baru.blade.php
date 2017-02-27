@include('head2')


<body class="theme-red">
    @include('topbar')
    @include('menu2')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    BARANG DEFAULT
                </h2>
            </div>

            <!-- Tabs With Icon Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation">
                                    <a href="{{url('master/barangDefault/list')}}">
                                        <i class="material-icons">view_list</i> LIST
                                    </a>
                                </li>
                                <li role="presentation"  {{ isset($data->kdBarangDefault) ? '' : 'class="active"' }}>
                                    <a href="{{url('master/barangDefault/baru')}}">
                                        <i class="material-icons">playlist_add</i> TAMBAH BARANG DEFAULT
                                    </a>
                                </li>

                                <li role="presentation" class="active" style="{{ isset($data->kdBarangDefault) ? '' : 'display:none' }}">
                                    <a href="">
                                        <i class="material-icons">edit</i> EDIT BARANG DEFAULT
                                    </a>
                                </li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade" id="home_with_icon_title">

                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
                                  <form id="form_advanced_validation" method="POST" action="{{ isset($data->kdBarangDefault) ? url('master/barangDefault/validEdit') : url('master/barangDefault/validBaru') }}" enctype="multipart/form-data">

                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="kdBarangDefault" value="{{ isset($data->kdBarangDefault) ? $data->kdBarangDefault : '' }}">
                                  <div class="body">
                                        <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" align="centel">

                                          <div align="center">
                                            <img src="{{ isset($data->foto) ? url('uploadgambar/'.$data->foto) : url('themes/images/no_image1.jpg')}}" style="width:90%; hight:auto; border:solid 1px #cccccc;">
                                            <br><br>
                                            <div class="fileUpload btn btn-primary">
                                            <span>Upload Gambar</span>
                                            <input type="file" class="upload" name="foto" id="foto"  />

                                            </div>
                                            <div class="col-pink">
                                            {{ $errors->first('foto') }}
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                              <label for="nama_barang">Nama Barang</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" value="{{ isset($data->nama) ? $data->nama : request()->old('nama') }}" name="nama" minlength="3" required>

                                                      <div class="col-pink">
                                                      {{ $errors->first('nama') }}
                                                      </div>
                                                  </div>
                                              </div>

                                              <label for="merk">Merk</label>
                                              <div class="form-group">
                                                  <div class="form-line">

                                                    <input id="something" list="somethingelse" value="{{ isset($data->merk) ? $data->merk : request()->old('merk') }}" name="merk" class="form-control show-tick" data-live-search="true">
                                                  	<datalist id="somethingelse">
                                                      @foreach($listmerk as $listmerkx)
                                                      <option value="{{$listmerkx->nama}}">{{$listmerkx->nama}}</option>
                                                      @endforeach
                                                  	</datalist>
                                                      <div class="col-pink">
                                                      {{ $errors->first('merk') }}
                                                      </div>
                                                  </div>
                                              </div>


                                              <label for="harga">Harga</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" value="{{ isset($data->harga) ? $data->harga : request()->old('harga') }}" name="harga" minlength="3" required>

                                                      <div class="col-pink">
                                                      {{ $errors->first('harga') }}
                                                      </div>
                                                  </div>
                                              </div>


                                              <label for="harga">Spec</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                    <textarea rows="4" name="spec" class="form-control no-resize" placeholder="" required>{{ isset($data->spec) ? $data->spec : request()->old('spec') }}</textarea>
                                                      <div class="col-pink">
                                                      {{ $errors->first('spec') }}
                                                      </div>
                                                  </div>
                                              </div>

                                              <label for="harga">Kategori</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                    <input type="text" name="kategori" class="form-control" data-role="tagsinput"
                                                    value="

                                                    {{ isset($kategori) ? $kategori : request()->old('kategori') }}
                                                    ">
                                                      <div class="col-pink">
                                                      {{ $errors->first('kategori') }}
                                                      </div>
                                                  </div>
                                              </div>



                                              <button class="btn btn-primary waves-effect" type="submit">
                                                {{ isset($data->kdBarangDefault) ? 'Edit' : 'Simpan' }}
                                              </button>

                                        </div>
                                        @if (isset($data->kdBarangDefault))
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          @if ($data->hided == 1)
                                            <a class="btn btn-success waves-effect" href="{{url('master/barangDefault/show/')}}/{{$data->kdBarangDefault}}">&nbsp;&nbsp;&nbsp;Show&nbsp;&nbsp;&nbsp;</a>
                                          @else
                                            <a class="btn btn-warning waves-effect" href="{{url('master/barangDefault/hide/')}}/{{$data->kdBarangDefault}}">&nbsp;&nbsp;&nbsp;Hide&nbsp;&nbsp;&nbsp;</a>
                                          @endif
                                          <a class="btn btn-danger waves-effect" href="{{url('master/barangDefault/delete/')}}/{{$data->kdBarangDefault}}">Hapus</a>
                                        </div>
                                        @endif

                                      </div>
                                  </div>
                                  </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Icon Title -->
        </div>
    </section>

    @include('footer2')
