@include('head2')
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
                                <li role="presentation" class="active">
                                    <a href="{{url('rtrwnet/'.$kdRtRwNet.'/billing/listPelanggan')}}">
                                        <i class="material-icons">view_list</i> LIST PELANGGAN
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="{{url('rtrwnet/'.$kdRtRwNet.'/billing/tambahPelanggan')}}">
                                        <i class="material-icons">playlist_add</i> TAMBAH PELANGGAN
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
                                    <form method="POST" action="{{url('rtrwnet/billing/listPelangganWithSearch')}}">
                                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <div class="row clearfix">

                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="form-line">

                                                  <input type="text" value="{{ isset($search) ? $search : '' }}" class="form-control date" placeholder="Kata Kunci" name="katakunci">

                                                  <input type="hidden" name="kdRtRwNet" value="">
                                                </div>
                                                <span class="input-group-addon">
                                                  <button class="btn btn-primary waves-effect" type="submit">
                                                    <i class="material-icons">search</i>
                                                  </button>

                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                  </form>



                                                  <table class="table table-striped">
                                                      <thead>
                                                          <tr>
                                                              <th style="width:5%;"></th>
                                                              <th>Nama</th>

                                                          </tr>
                                                      </thead>
                                                      <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nama</th>


                                                        </tr>
                                                      </tfoot>
                                                      <tbody>
                                                      @foreach($data as $jasad)


                                                        <tr  class="{{ $jasad->suspended == 1 ? 'danger' : '' }}">
                                                            <td><a href="{{url('rtrwnet/'.$jasad->kdRtRwNet.'/billing/editPelanggan')}}/{{$jasad->kdPelanggan}}"><i class="material-icons">edit</i></a></td>
                                                            <td>{{$jasad->namaPanggilan}}</td>

                                                        </tr>
                                                          @endforeach

                                                      </tbody>
                                                  </table>

                                                  <?php echo $data->links(); ?>
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
