@include('head2')


<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="{{ URL::to('themes/pop-up/lib/jquery.mousewheel-3.0.6.pack.js') }}"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="{{ URL::to('themes/pop-up/source/jquery.fancybox.js?v=2.1.5') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::to('themes/pop-up/source/jquery.fancybox.css?v=2.1.5') }}" media="screen" />

<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="{{ URL::to('themes/pop-up/source/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}" />
<script type="text/javascript" src="{{ URL::to('themes/pop-up/source/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}"></script>

<!-- Add Thumbnail helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="{{ URL::to('themes/pop-up/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7') }}" />
<script type="text/javascript" src="{{ URL::to('themes/pop-up/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7') }}"></script>

<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="{{ URL::to('themes/pop-up/source/helpers/jquery.fancybox-media.js?v=1.0.6') }}"></script>
@include('googleMap')

<body class="theme-red">
    @include('topbar')
    @include('menu2')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    PELANGGAN
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
                                    <a href="{{url('rtrwnet/'.$kdRtRwNet.'/billing/listPelanggan')}}">
                                        <i class="material-icons">view_list</i> LIST PELANGGAN
                                    </a>
                                </li>

                                <li role="presentation"  {{ isset($data->kdPelanggan) ? '' : 'class="active"' }}>
                                    <a href="{{url('rtrwnet/'.$kdRtRwNet.'/billing/tambahPelanggan')}}">
                                        <i class="material-icons">playlist_add</i> TAMBAH PELANGGAN
                                    </a>
                                </li>

                                <li role="presentation" class="active" style="{{ isset($data->kdPelanggan) ? '' : 'display:none' }}">
                                    <a href="">
                                        <i class="material-icons">edit</i> EDIT PELANGGAN
                                    </a>
                                </li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade" id="home_with_icon_title">

                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
                                  <form id="form_advanced_validation" method="POST" action="{{ isset($data->kdPelanggan) ? url('rtrwnet/'.$kdRtRwNet.'/billing/validEdit') : url('rtrwnet/'.$kdRtRwNet.'/billing/validBaru') }}" enctype="multipart/form-data">

                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="kdPelanggan" value="{{ isset($data->kdPelanggan) ? $data->kdPelanggan : '' }}">
                                    <input type="hidden" name="kdRtRwNet" value="{{$kdRtRwNet}}">
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
                                            <a class="fancybox" href="#inline1" id="fancybox" data-url="{{url('map/showEditMap')}}">
                                            <div style="width:90%; height:20%; margin-top:10px;">
                                              {!! Mapper::render() !!}
                                              <i style="font-size:11px; color:#ff0000">Kilik Map untuk menentukan coordinat</i>
                                            </div>
                                            </a>
                                            <input type="hidden" value="" id="latmap" name="latmap">
                                            <input type="hidden" value="" id="lonmap" name="lonmap">
                                          </div>

                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                              <label for="nama_lengkap">Nama Lengkap</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" value="{{ isset($data->namaLengkap) ? $data->namaLengkap : request()->old('namaLengkap') }}" name="namaLengkap" minlength="3" required>

                                                      <div class="col-pink">
                                                      {{ $errors->first('namaLengkap') }}
                                                      </div>
                                                  </div>
                                              </div>
                                              <label for="nama_panggilan">Nama Panggilan</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" value="{{ isset($data->namaPanggilan) ? $data->namaPanggilan : request()->old('namaPanggilan') }}" name="namaPanggilan" minlength="3">

                                                      <div class="col-pink">
                                                      {{ $errors->first('namaPanggilan') }}
                                                      </div>
                                                  </div>
                                              </div>
                                              <label for="alamat">Alamat</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                    <textarea rows="4" name="alamat" class="form-control no-resize" placeholder="">{{ isset($data->alamat) ? $data->alamat : request()->old('alamat') }}</textarea>
                                                      <div class="col-pink">
                                                      {{ $errors->first('alamat') }}
                                                      </div>
                                                  </div>
                                              </div>
                                              <label for="notelp">No Telp</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" value="{{ isset($data->noTelp) ? $data->noTelp : request()->old('noTelp') }}" name="noTelp" minlength="3">

                                                      <div class="col-pink">
                                                      {{ $errors->first('noTelp') }}
                                                      </div>
                                                  </div>
                                              </div>
                                              <label for="email_address">Email Address</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text" id="email" name="email" class="form-control" placeholder="" required value="{{ isset($data->email) ? $data->email : request()->old('email') }}">
                                                      <div class="help-info">Ex: example@example.com</div>
                                                      <div class="col-pink">
                                                      {{ $errors->first('email') }}
                                                      </div>
                                                  </div>
                                              </div>

                                              <button class="btn btn-primary waves-effect" type="submit">
                                                {{ isset($data->kdPelanggan) ? 'Edit' : 'Simpan' }}

                                              </button>

                                        </div>
                                        @if (isset($data->kdPelanggan))
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          @if ($data->suspended == 1)
                                            <a class="btn btn-success waves-effect" href="{{url('master/barangDefault/show/')}}/{{$data->kdPelanggan}}">&nbsp;&nbsp;&nbsp;Show&nbsp;&nbsp;&nbsp;</a>
                                          @else
                                            <a class="btn btn-warning waves-effect" href="{{url('master/barangDefault/hide/')}}/{{$data->kdPelanggan}}">&nbsp;&nbsp;&nbsp;Hide&nbsp;&nbsp;&nbsp;</a>
                                          @endif
                                          <a class="btn btn-danger waves-effect" href="{{url('master/barangDefault/delete/')}}/{{$data->kdPelanggan}}">Hapus</a>
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

    </section>

    @include('footer2')
