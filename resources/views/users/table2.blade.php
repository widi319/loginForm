@include('head2')
<body class="theme-red">
    @include('topbar')
    @include('menu2')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    USER
                </h2>
            </div>

            <!-- Tabs With Icon Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="{{url('master/user/list')}}">
                                        <i class="material-icons">view_list</i> LIST
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="{{url('master/user/baru')}}">
                                        <i class="material-icons">playlist_add</i> TAMBAH USER
                                    </a>
                                </li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                                  @if (Session::has('message'))
                                    <div class="alert alert-success" style="margin-bottom: 20px;">{{Session::get('message')}}</div>
                                  @endif
                                    <!-- Basic Examples -->





                                                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                      <thead>
                                                          <tr>
                                                              <th style="width:5%;"></th>
                                                              <th>Email Login</th>
                                                              <th>Nama</th>
                                                              


                                                          </tr>
                                                      </thead>
                                                      <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th>Email Login</th>
                                                            <th>Nama</th>

                                                        </tr>
                                                      </tfoot>
                                                      <tbody>
                                                      @foreach($data as $usersz)


                                                        <tr class="{{ $usersz->suspended == 1 ? 'danger' : '' }}">
                                                            <td><a href="{{url('master/user/edit')}}/{{$usersz->id}}"><i class="material-icons">edit</i></a></td>
                                                            <td>{{$usersz->email}}</td>
                                                            <td>{{$usersz->name}}</td>

                                                        </tr>
                                                          @endforeach

                                                      </tbody>
                                                  </table>

                                  <!-- #END# Basic Examples -->
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">

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
