@include('head2')
<body class="fp-page">
    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b>BSB</b></a>
            <small>Admin BootStrap Based - Material Design</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="forgot_password" method="POST" action="{{ route('password.email') }}">
                    <div class="msg">
                      Masukkan alamat email Anda yang Anda gunakan untuk mendaftar. Kami akan mengirimkan email dengan nama pengguna dan Anda
                      Link untuk mereset password Anda.
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>
                    @if ($errors->has('email'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('email') }}</strong>
                                   </span>
                               @endif
                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">RESET PASSWORD SAYA</button>

                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="{{url('')}}">Sign In!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@include('footer2')
