@include('head2')


<body class="theme-red">
    @include('topbar')
    @include('menu2')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    PAKET DEFAULT
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

                                <li role="presentation"  {{ isset($data->kdPaketDefault) ? '' : 'class="active"' }}>
                                    <a href="{{url('master/paketDefault/baru')}}">
                                        <i class="material-icons">playlist_add</i> TAMBAH PAKET DEFAULT
                                    </a>
                                </li>

                                <li role="presentation" class="active" style="{{ isset($data->kdPaketDefault) ? '' : 'display:none' }}">
                                    <a href="">
                                        <i class="material-icons">edit</i> EDIT PAKET DEFAULT
                                    </a>
                                </li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade" id="home_with_icon_title">

                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
                                  <form id="form_advanced_validation" method="POST" action="{{ isset($data->kdPaketDefault) ? url('master/paketDefault/validEdit') : url('master/paketDefault/validBaru') }}" enctype="multipart/form-data">

                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="kdPaketDefault" value="{{ isset($data->kdPaketDefault) ? $data->kdPaketDefault : '' }}">
                                  <div class="body">
                                        <div class="row clearfix">

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                              <label for="nama_barang">Nama Paket</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" value="{{ isset($data->nama) ? $data->nama : request()->old('nama') }}" name="nama" minlength="3" required>

                                                      <div class="col-pink">
                                                      {{ $errors->first('nama') }}
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






                                              <button class="btn btn-primary waves-effect" type="submit">
                                                {{ isset($data->kdPaketDefault) ? 'Edit' : 'Simpan' }}
                                              </button>

                                        </div>
                                        @if (isset($data->kdPaketDefault))
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          @if ($data->hided == 1)
                                            <a class="btn btn-success waves-effect" href="{{url('master/paketDefault/show/')}}/{{$data->kdPaketDefault}}">&nbsp;&nbsp;&nbsp;Show&nbsp;&nbsp;&nbsp;</a>
                                          @else
                                            <a class="btn btn-warning waves-effect" href="{{url('master/paketDefault/hide/')}}/{{$data->kdPaketDefault}}">&nbsp;&nbsp;&nbsp;Hide&nbsp;&nbsp;&nbsp;</a>
                                          @endif
                                          <a class="btn btn-danger waves-effect" href="{{url('master/paketDefault/delete/')}}/{{$data->kdPaketDefault}}">Hapus</a>
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
