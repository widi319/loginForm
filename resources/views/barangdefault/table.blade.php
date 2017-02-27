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
                                <li role="presentation" class="active">
                                    <a href="{{url('master/barangDefault/list')}}">
                                        <i class="material-icons">view_list</i> LIST
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="{{url('master/barangDefault/baru')}}">
                                        <i class="material-icons">playlist_add</i> TAMBAH BARANG DEFAULT
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
                                    <form method="POST" action="{{url('master/barangDefault/listWithSearch')}}">
                                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <div class="row clearfix">
                                        <div class="col-md-4">
                                            <div class="input-group">

                                                <div class="form-line">

                                                    <input type="text" value="{{ isset($search) ? $search : '' }}" class="form-control date" placeholder="Kata Kunci" name="katakunci">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="form-line">

                                                  <select class="form-control show-tick" name="kdMerk">
                                                    <option value="" {{ (isset($kdMerk) ? $kdMerk : '') =="" ? 'selected' : ''}}>Semua Merk</option>
                                                    @foreach($merk as $merks)
                                                      <option value="{{$merks->kdMerk}}" {{ (isset($kdMerk) ? $kdMerk : '')==$merks->kdMerk ? 'selected' : ''}}>{{$merks->nama}}</option>
                                                      @endforeach
                                                  </select>

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
                                                              <th style="width:10%;"></th>
                                                              <th>Barang default</th>
                                                              <th>Harga</th>


                                                          </tr>
                                                      </thead>
                                                      <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th>Barang default</th>
                                                            <th>Harga</th>

                                                        </tr>
                                                      </tfoot>
                                                      <tbody>

                                                      @foreach($data as $barangd)


                                                        <tr class="{{ $barangd->hided == 1 ? 'danger' : '' }}">
                                                            <td><a href="{{url('master/barangDefault/edit')}}/{{$barangd->kdBarangDefault}}"><i class="material-icons">edit</i></a></td>
                                                            <td><img src="{{ isset($barangd->foto) ? url('uploadgambar/'.$barangd->foto) : url('themes/images/no_image1.jpg')}}"  style="width:100%; height:auto"></td>
                                                            <td><div><b>{{$barangd->nama}}</b></div><div><b>Spac : </b><br>{{$barangd->spec}}</div></td>
                                                            <th>{{$barangd->harga}}</th>
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
