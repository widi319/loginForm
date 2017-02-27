@include('head2')


<body class="theme-red">
    @include('topbar')
    @include('menu2')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    @if(Auth::user()->role == 1)
                    USER
                    @else
                    EDIT PROFILE
                    @endif

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
                                    <a href="{{url('master/user/list')}}">
                                        <i class="material-icons">view_list</i> LIST
                                    </a>
                                </li>

                                <li role="presentation"  {{ isset($data->id) ? '' : 'class="active"' }}>
                                    <a href="{{url('master/user/baru')}}">
                                        <i class="material-icons">playlist_add</i> TAMBAH USER
                                    </a>
                                </li>
                                <li role="presentation" class="active" style="{{ isset($data->id) ? '' : 'display:none' }}">
                                    <a href="">
                                        <i class="material-icons">edit</i> EDIT USER
                                    </a>
                                </li>
                                @else
                                <li role="presentation" class="active" style="{{ isset($data->id) ? '' : 'display:none' }}">
                                    <a href="">
                                        <i class="material-icons">edit</i> EDIT PROFILE
                                    </a>
                                </li>
                                @endif


                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade" id="home_with_icon_title">

                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
                                  <form id="form_advanced_validation" method="POST" action="{{ isset($data->id) ? url('master/user/validEdit') : url('master/user/validBaru') }}" enctype="multipart/form-data">

                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="id" value="{{ isset($data->id) ? $data->id : '' }}">
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
                                              <label for="email_address">Nama</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" value="{{ isset($data->name) ? $data->name : request()->old('name') }}" name="name" minlength="3" required>

                                                      <div class="col-pink">
                                                      {{ $errors->first('name') }}
                                                      </div>
                                                  </div>
                                              </div>




                                              <label for="email_address">Telp</label>
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" name="noTelp" value="{{ isset($data->noTelp) ? $data->noTelp : request()->old('noTelp') }}">
                                                      <div class="help-info"></div>
                                                      <div class="col-pink">

                                                      </div>
                                                  </div>
                                              </div>

                                              <button class="btn btn-primary waves-effect" type="submit">
                                                {{ isset($data->id) ? 'Edit' : 'Simpan' }}
                                              </button>

                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          <div class="header">
                                              <h2>
                                                  User Name & Password
                                              </h2>

                                          </div>


                                          <label for="email_address">Email</label>
                                          <div class="form-group">
                                              <div class="form-line">
                                                  <input type="text" id="email" name="email" class="form-control" placeholder="" required value="{{ isset($data->email) ? $data->email : request()->old('email') }}">
                                                  <div class="help-info">Ex: example@example.com(sebagai User Name Saat Login)</div>
                                                  <div class="col-pink">
                                                  {{ $errors->first('email') }}
                                                  </div>
                                              </div>
                                          </div>


                                          <label for="email_address">Password</label>
                                          <div class="form-group">
                                              <div class="form-line">
                                                  <input type="password" name="password" class="form-control" placeholder="" {{ isset($data->password) ? '' : 'required' }}  value="{{ isset($data->password) ? '' : request()->old('password') }}"  >
                                                  <div class="help-info"></div>
                                                  <div class="col-pink">
                                                  {{ $errors->first('password') }}
                                                  </div>
                                              </div>
                                          </div>

                                          <label for="email_address">Re-Password</label>
                                          <div class="form-group">
                                              <div class="form-line">
                                                  <input type="password" name="password_confirmation" class="form-control" placeholder="" {{ isset($data->password) ? '' : 'required' }}  value="{{ isset($data->password) ? '' : request()->old('password_confirmation') }}">
                                                  <div class="help-info"></div>
                                                  <div class="col-pink">

                                                  </div>
                                              </div>
                                          </div>

                                          @if(Auth::user()->role == 1)
                                          <label for="email_address">Role</label>
                                          <div class="form-group">
                                              <div class="form-line">

                                                    <select class="form-control show-tick" name="role">
                                                      <option value="2" {{ isset($data->role) ? $data->role == 2 ? 'selected' : '' : '' }}>User</option>
                                                      <option value="1" {{ isset($data->role) ? $data->role == 1 ? 'selected' : '' : '' }}>Super Admin</option>
                                                    </select>
                                                  <div class="help-info"></div>
                                                  <div class="col-pink">

                                                  </div>
                                              </div>
                                          </div>
                                          @else
                                            <input type="hidden" id="" name="role" value="2">
                                          @endif

                                              <button class="btn btn-primary waves-effect" type="submit">
                                                {{ isset($data->id) ? 'Edit' : 'Simpan' }}
                                              </button>

                                        </div>
                                        @if(Auth::user()->role == 1)
                                        @if (isset($data->id))
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          @if ($data->suspended == 1)
                                            <a class="btn btn-success waves-effect" href="{{url('master/user/active/')}}/{{$data->id}}">&nbsp;&nbsp;&nbsp;Active&nbsp;&nbsp;&nbsp;</a>
                                          @else
                                            <a class="btn btn-warning waves-effect" href="{{url('master/user/suspended/')}}/{{$data->id}}">&nbsp;&nbsp;&nbsp;Suspened&nbsp;&nbsp;&nbsp;</a>
                                          @endif
                                          <a class="btn btn-danger waves-effect" href="{{url('master/user/delete/')}}/{{$data->id}}">Hapus</a>
                                        </div>
                                        @endif
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
