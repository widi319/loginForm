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
    <script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
			addtabel();
		});

		function addtabel(){

			var katakunci = $("#katakunci").val();

			$("#tabelDisini").load($('#tabelDisini').data('url')+"?katakunci="+katakunci);

		}

		function isiText(nama,kode){
			$("#userName").val(nama);
			$("#kdUser").val(kode);
			$.fancybox.close();
		}
	</script>

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
                                <li role="presentation">
                                    <a href="{{url('master/rtrwnet/list')}}">
                                        <i class="material-icons">view_list</i> LIST
                                    </a>
                                </li>
                                <li role="presentation" class="active">
                                    <a href="{{url('master/rtrwnet/baru')}}">
                                        <i class="material-icons">playlist_add</i> TAMBAH RT RW NET
                                    </a>
                                </li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade" id="home_with_icon_title">

                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">

                                  <div class="body">
																		@if(Auth::user()->role == 1)
																		<form id="form_advanced_validation" method="POST" action="{{url('master/rtrwnet/addStaff') }}/{{$data->kdRtRwNet}}" enctype="multipart/form-data">
																			@else
																			<form id="form_advanced_validation" method="POST" action="{{url('rtrwnet/addStaff') }}/{{$data->kdRtRwNet}}" enctype="multipart/form-data">
																			@endif
																			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
																			<div class="row clearfix">
																				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																					<h2 class="card-inside-title">Email User</h2>
																			</div>
																						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">

																						<input type="hidden" name="kdUser" id="kdUser" value="{{$data->kdUser}}">
																						<input type="text" value="{{$data->userName}}" id="userName" name="email" onClick="" class="form-control" placeholder="Input Email User" required>

																					</div>
																					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																						 Atau &nbsp;&nbsp;&nbsp;&nbsp;<a class="fancybox btn btn-primary waves-effect" href="#inline1">Search Email</a>
																						<div class="help-info"></div>
																						<div class="col-pink"></div>
																					</div>
																					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																						<h2 class="card-inside-title">Tugas User</h2>
																						<div class="demo-checkbox">
																							 <input type="checkbox" name="owner" id="md_checkbox_1" class="chk-col-blue" {{ $data->owner == 1 ? 'checked' : '' }} />
																							 <label for="md_checkbox_1">Owner</label>

																								<input type="checkbox" name="profile" id="md_checkbox_2" class="chk-col-blue" {{ $data->profile == 1 ? 'checked' : '' }}/>
																							 <label for="md_checkbox_2">Profile</label>

																								<input type="checkbox" name="komplain" id="md_checkbox_3" class="chk-col-blue" {{ $data->komplain == 1 ? 'checked' : '' }}/>
																							 <label for="md_checkbox_3">Komplain</label>

																								<input type="checkbox" name="transaksi" id="md_checkbox_4" class="chk-col-blue" {{ $data->transaksi == 1 ? 'checked' : '' }}/>
																							 <label for="md_checkbox_4">Transaksi</label>

																								<input type="checkbox" name="jadwal" id="md_checkbox_5" class="chk-col-blue" {{ $data->jadwal == 1 ? 'checked' : '' }} />
																							 <label for="md_checkbox_5">Jadwal</label>

																								<input type="checkbox" name="proyek" id="md_checkbox_6" class="chk-col-blue" {{ $data->proyek == 1 ? 'checked' : '' }}/>
																							 <label for="md_checkbox_6">Proyek</label>

																								<input type="checkbox" name="billing" id="md_checkbox_7" class="chk-col-blue" {{ $data->billing == 1 ? 'checked' : '' }}/>
																							 <label for="md_checkbox_7">Billing</label>

																							 </div>
																					</div>
																					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																						<div id="inline1" style="width:600px;display: none;">
																								<div class="row clearfix">
																										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																												<div class="card">
																														<div class="header">
																																<h2>
																																		<input type="text" id="katakunci" onChange="addtabel()" onKeyDown="addtabel()" onKeyPress="addtabel()" name="katakunci" class="form-control" placeholder="Masukkan Kata Kunci">
																																</h2>
																																<i style="font-size:11px; color:#999">"Dobel klik user name untuk memilih"</i>
																														</div>
																														@if(Auth::user()->role == 1)
																														<div class="body"  id="tabelDisini" data-url="{{url('master/rtrwnet/searchTable')}}">
																														@else
																														<div class="body"  id="tabelDisini" data-url="{{url('rtrwnet/searchTable')}}">
																														@endif
																														</div>
																												</div>
																										</div>
																								</div>


																						</div>

																					<button class="btn btn-primary waves-effect" type="submit">
																						@if (isset($data->kdUser))
																						Edit
																						@else
																						Simpan
																						@endif
																					</button>

																					<a class="btn btn-warning waves-effect" href="{{url('master/rtrwnet/edit')}}/{{$data->kdRtRwNet}}">
																						Kembali
																					</a>
																					</div>
																			</div>
																			</form>
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
