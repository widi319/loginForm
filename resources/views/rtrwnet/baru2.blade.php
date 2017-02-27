
@include('head2')


<body class="theme-red">
    @include('topbar')
    @include('menu2')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    RT RW NET
                </h2>
            </div>

            <!-- Tabs With Icon Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                              @if(Auth::user()->role == 1)
                                <li role="presentation">
                                    <a href="{{url('master/rtrwnet/list')}}">
                                        <i class="material-icons">view_list</i> LIST
                                    </a>
                                </li>
                                <li role="presentation"  {{ isset($data->kdRtRwNet) ? '' : 'class="active"' }}>
                                    <a href="{{url('master/rtrwnet/baru')}}">
                                        <i class="material-icons">playlist_add</i> TAMBAH RT RW NET
                                    </a>
                                </li>

                                <li role="presentation" class="active" style="{{ isset($data->kdRtRwNet) ? '' : 'display:none' }}">
                                    <a href="">
                                        <i class="material-icons">edit</i> EDIT RT RW NET
                                    </a>
                                </li>
                              @else
                              <li role="presentation" class="active">
                                  <a href="">
                                      <i class="material-icons">edit</i> EDIT RT RW NET
                                  </a>
                              </li>
                              <li role="presentation">
                                  <a href="">
                                      <i class="material-icons">person_add</i> Tambah Pengelola RT RW NET
                                  </a>
                              </li>
                              @endif

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade" id="home_with_icon_title">

                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">


                                  <div class="body">
                                        <div class="row clearfix">
                                          @if(Auth::user()->role ==1){
                                            <form id="form_advanced_validation" method="POST" action="{{ isset($data->kdRtRwNet) ? url('master/rtrwnet/validEdit') : url('master/rtrwnet/validBaru') }}" enctype="multipart/form-data">
                                          @else
                                            <form id="form_advanced_validation" method="POST" action="{{url('rtrwnet/validEdit') }}" enctype="multipart/form-data">
                                          @endif

                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" align="centel">
                                          @if (Session::has('message'))
                                            <div class="alert alert-success" style="margin-bottom: 20px;">{{Session::get('message')}}</div>
                                          @endif
                                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                          <input type="hidden" name="kdRtRwNet" value="{{ isset($data->kdRtRwNet) ? $data->kdRtRwNet : '' }}">
                                          <div align="center">
                                            <img src="{{ isset($data->logo) ? url('uploadgambar/'.$data->logo) : url('themes/images/nologo.png')}}" style="width:90%; hight:auto; border:solid 1px #cccccc;">
                                            <br><br>
                                            <div class="fileUpload btn btn-primary">
                                            <span>Upload Logo</span>
                                            <input type="file" class="upload" name="logo" id="logo"  />

                                            </div>
                                            <div class="col-pink">
                                            {{ $errors->first('logo') }}
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                              <label for="nama">Nama RT RW NET</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" value="{{ isset($data->nama) ? $data->nama : request()->old('nama') }}" name="nama" minlength="3" required>

                                                      <div class="col-pink">
                                                      {{ $errors->first('nama') }}
                                                      </div>
                                                  </div>
                                              </div>

                                              <label for="alamat">Alamat</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <textarea rows="4" name="alamat" class="form-control no-resize" placeholder="" required>{{ isset($data->alamat) ? $data->alamat : request()->old('alamat') }}</textarea>
                                                      <div class="col-pink">
                                                      {{ $errors->first('alamat') }}
                                                      </div>
                                                  </div>
                                              </div>

                                              <label for="notelp">No.Telp</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" name="noTelp" value="{{ isset($data->noTelp) ? $data->noTelp : request()->old('noTelp') }}" required>
                                                      <div class="help-info"></div>
                                                      <div class="col-pink">
                                                          {{ $errors->first('noTelp') }}
                                                      </div>
                                                  </div>
                                              </div>

                                              <label for="fanpage">Fanpage</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" name="fanpage" value="{{ isset($data->fanpage) ? $data->fanpage : request()->old('fanpage') }}">
                                                      <div class="help-info"></div>
                                                      <div class="col-pink">
                                                        {{ $errors->first('fanpage') }}
                                                      </div>
                                                  </div>
                                              </div>


                                              <label for="website">Website</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" name="website" value="{{ isset($data->website) ? $data->website : request()->old('website') }}" >
                                                      <div class="help-info"></div>
                                                      <div class="col-pink">
                                                        {{ $errors->first('website') }}
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
                                                {{ isset($data->kdRtRwNet) ? 'Edit' : 'Simpan' }}
                                              </button>


                                        </div>
                                        </form>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          <div class="header">
                                            @if (isset($data->kdRtRwNet))
                                              <h2>
                                                  Pengelola
                                              </h2>

                                              <div class="body table-responsive">
                                                  <table class="table table-condensed">
                                                      <thead>
                                                          <tr>
                                                              <th>#</th>
                                                              <th>User name</th>
                                                              <th>Owner</th>
                                                              <th>Profile</th>
                                                              <th>Komplain</th>
                                                              <th>Transaksi</th>
                                                              <th>Jadwal</th>
                                                              <th>Proyek</th>
                                                              <th>Billing</th>

                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                          @foreach($list as $usernet)
                                                          <tr>
                                                              <th scope="row"><a href="{{url('master/rtrwnet/editPengelola')}}/{{$data->kdRtRwNet}}?id={{$usernet->id}}"><i class="material-icons">edit</i></a></th>
                                                              <td>{{$usernet->name}}</td>
                                                              <td>@if ($usernet->owner == 1)<i class="material-icons">done</i>@endif</td>
                                                              <td>@if ($usernet->profile == 1)<i class="material-icons">done</i>@endif</td>
                                                              <td>@if ($usernet->komplain == 1)<i class="material-icons">done</i>@endif</td>
                                                              <td>@if ($usernet->transaksi == 1)<i class="material-icons">done</i>@endif</td>
                                                              <td>@if ($usernet->jadwal == 1)<i class="material-icons">done</i>@endif</td>
                                                              <td>@if ($usernet->proyek == 1)<i class="material-icons">done</i>@endif</td>
                                                              <td>@if ($usernet->billing == 1)<i class="material-icons">done</i>@endif</td>
                                                          </tr>
                                                          @endforeach
                                                      </tbody>
                                                  </table>
                                              </div>
                                              @if(Auth::user()->role == 1)
                                              <a class="btn btn-primary waves-effect" href="{{url('master/rtrwnet/tambahPengelola')}}/{{$data->kdRtRwNet}}">Tambah Pengelola</a>
                                              @else
                                              <a class="btn btn-primary waves-effect" href="{{url('rtrwnet/'.$data->kdRtRwNet.'/tambahPengelola')}}">Tambah Pengelola</a>
                                              @endif

                                              @endif

                                          </div>

                                        </div>

                                      </div>

                                      @if (isset($data->kdRtRwNet))
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        @if(Auth::user()->role == 1)
                                        @if ($data->suspended == 1)
                                          <a class="btn btn-success waves-effect" href="{{url('master/rtrwnet/active/')}}/{{$data->kdRtRwNet}}">&nbsp;&nbsp;&nbsp;Active&nbsp;&nbsp;&nbsp;</a>
                                        @else
                                          <a class="btn btn-warning waves-effect" href="{{url('master/rtrwnet/suspended/')}}/{{$data->kdRtRwNet}}">&nbsp;&nbsp;&nbsp;Suspened&nbsp;&nbsp;&nbsp;</a>
                                        @endif
                                        @endif
                                        <a class="btn btn-danger waves-effect" href="{{url('master/rtrwnet/delete/')}}/{{$data->kdRtRwNet}}">Hapus RT RW NET</a>
                                      </div>
                                      @endif

                                    </div>


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
