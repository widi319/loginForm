@include('head2')
<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b>BSB</b></a>
            <small>Admin BootStrap Based - Material Design</small>
        </div>
        <?php //var_dump($errors); ?>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" value="{{ old('email') }}" name="email" placeholder="Email" required autofocus>

                        </div>
                        @if ($errors->has('email'))
                            <span class="col-pink">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>

                        </div>
                        @if ($errors->has('password'))
                            <span class="col-pink">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif


                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink" {{ old('remember') ? 'checked' : '' }}>
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20" style="margin-bottom: 20px;">
                      <div class="col-xs-12 loginwith" align="center">
                          <div>Atau Login Dengan :<br><br></div>
                          <a href="{{url('social/redirect/facebook')}}" style="color:#fff" class="btn btn-primary btn-circle-lg waves-effect waves-circle waves-float"><i class="fa fa-facebook"></i></a>
                          <a href="" style="color:#fff" class="btn btn-info btn-circle-lg waves-effect waves-circle waves-float"><i class="fa fa-twitter"></i></a>
                          <a href="" style="color:#fff" class="btn btn-danger btn-circle-lg waves-effect waves-circle waves-float"><i class="fa fa-google-plus"></i></a>
                          <a href="" style="color:#fff" class="btn btn-primary btn-circle-lg waves-effect waves-circle waves-float"><i class="fa fa-github"></i></a>

                        </div>


                      </div>


                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="{{ url('/register') }}">Register!</a>
                        </div>
                        <div class="col-xs-6 align-right" href="{{ route('password.request') }}">
                            <a href="{{ route('password.request') }}">Lupa Password?</a>
                        </div>
                    </div>

                </form>
                @if (Session::has('message'))
                  <div class="alert alert-success" style="margin-bottom: 20px;">{{Session::get('message')}}</div>
                @endif
            </div>
        </div>
    </div>
    @include('footer2')
