<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
              @if(Auth::user()->foto != "")
                <img src="{{url('uploadgambar/'.Auth::user()->foto)}}" width="48" height="48" alt="User" />
              @else
              <img src="{{url('themes/images/nologo.png')}}" width="48" height="48" alt="User" />
              @endif
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
                </div>
                <div class="email">

                  @if(Auth::user()->role == 1)
                    Super admin
                  @else
                    User
                  @endif
                </div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{{url('profile/edit').'/'.Auth::user()->id}}"><i class="material-icons">person</i>Profile</a></li>
                        <li role="seperator" class="divider"></li>
                        <li>
                          <a href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();"><i class="material-icons">input</i>
                              Logout
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
          @if (Auth::user()->role == 1)
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active">
                    <a href="index.html">
                        <i class="material-icons">home</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ Request::is('master*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">view_list</i>
                        <span>Master</span>
                    </a>

                    <ul class="ml-menu">
                        <li class="{{ Request::is('master/user*') ? 'active' : '' }}">
                            <a href="{{url('master/user/list')}}">User</a>
                        </li>
                        <li class="{{ Request::is('master/rtrwnet*') ? 'active' : '' }}">
                            <a href="{{url('master/rtrwnet/list')}}">RTRW NET</a>
                        </li>
                        <li class="{{ Request::is('master/barangDefault*') ? 'active' : '' }}">
                            <a href="{{url('master/barangDefault/list')}}">Barang Default</a>
                        </li>
                        <li class="{{ Request::is('master/jasaDefault*') ? 'active' : '' }}">
                            <a href="{{url('master/jasaDefault/list')}}">Jasa Default</a>
                        </li>
                        <li class="{{ Request::is('master/paketDefault*') ? 'active' : '' }}">
                            <a href="{{url('master/paketDefault/list')}}">Paket Default</a>
                        </li>
                    </ul>

                </li>

            </ul>
            @else
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active">
                    <a href="index.html">
                        <i class="material-icons">home</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @foreach(Session::get('RtRwNetList') as $RtRwNetList)
                  @foreach($RtRwNetList as $RtRwNetList2)

                <li class="{{ Request::is('rtrwnet/'.$RtRwNetList2->kdRtRwNet.'*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">view_list</i>
                        <span>{{$RtRwNetList2->nama}}</span>
                    </a>

                    <ul class="ml-menu">
                      <!-- Billing -->
                      <li class="{{ Request::is('rtrwnet/'.$RtRwNetList2->kdRtRwNet.'/billing*') ? 'active' : '' }}">
                          <a href="javascript:void(0);" class="menu-toggle">
                              <i class="material-icons">playlist_add_check</i>
                              <span>BILLING</span>
                          </a>

                          <ul class="ml-menu">
                            <li class="{{ Request::is('rtrwnet/'.$RtRwNetList2->kdRtRwNet.'/billing/listPelanggan') ? 'active' : '' }}">
                                <a href="{{url('rtrwnet/'.$RtRwNetList2->kdRtRwNet.'/billing/listPelanggan')}}">Pelanggan</a>
                            </li>
                            <li class="">
                                <a href="">Billing Pelanggan</a>
                            </li>
                            <li class="">
                                <a href="">Paket</a>
                            </li>

                          </ul>
                      </li>
                      <!-- Billing -->


                      <!-- TRANSAKSI -->
                      <li class="">
                          <a href="javascript:void(0);" class="menu-toggle">
                              <i class="material-icons">attach_money</i>
                              <span>TRANSAKSI</span>
                          </a>

                          <ul class="ml-menu">
                            <li class="">
                                <a href="">RAB ke deal</a>
                            </li>
                            <li class="">
                                <a href="">Penjualan</a>
                            </li>
                          </ul>
                      </li>
                      <!-- TRANSAKSI-->

                      <!-- KOMPLAIN -->
                      <li class="">
                          <a href="javascript:void(0);" class="menu-toggle">
                              <i class="material-icons">sentiment_very_dissatisfied</i>
                              <span>KOMPLAIN</span>
                          </a>

                          <ul class="ml-menu">
                            <li class="">
                                <a href="">RAB ke deal</a>
                            </li>
                          </ul>
                      </li>
                      <!-- KOMPLAIN-->

                      <!-- PROYEK -->
                      <li class="">
                          <a href="javascript:void(0);" class="menu-toggle">
                              <i class="material-icons">my_location</i>
                              <span>PROYEK</span>
                          </a>

                          <ul class="ml-menu">
                            <li class="">
                                <a href="">RAB ke deal</a>
                            </li>
                          </ul>
                      </li>
                      <!-- PROYEK-->

                      <!-- JADWAL -->
                      <li class="">
                          <a href="javascript:void(0);" class="menu-toggle">
                              <i class="material-icons">insert_invitation</i>
                              <span>JADWAL</span>
                          </a>

                          <ul class="ml-menu">
                            <li class="">
                                <a href="">RAB ke deal</a>
                            </li>
                          </ul>
                      </li>
                      <!-- JADWAL-->

                      <!-- Profile RT RW NET -->
                      <li class="{{ Request::is('rtrwnet/'.$RtRwNetList2->kdRtRwNet.'/profileRtRwNet') ? 'active' : '' }}">
                          <a href="{{url('rtrwnet/'.$RtRwNetList2->kdRtRwNet.'/profileRtRwNet')}}">
                              <i class="material-icons">wifi</i>
                              <span>Profile RT RW NET</span>
                          </a>

                      </li>
                      <!-- Profile RT RW NET-->
                    </ul>

                </li>
                @endforeach
                @endforeach
                <li class="">
                    <a href="javascript:void(0);">
                        <i class="material-icons">note_add</i>
                        <span>Tambah RT RW NET</span>
                    </a>

                </li>
            </ul>
            @endif
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2016 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.4
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
            <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                <ul class="demo-choose-skin">
                    <li data-theme="red" class="active">
                        <div class="red"></div>
                        <span>Red</span>
                    </li>
                    <li data-theme="pink">
                        <div class="pink"></div>
                        <span>Pink</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>
                    <li data-theme="deep-purple">
                        <div class="deep-purple"></div>
                        <span>Deep Purple</span>
                    </li>
                    <li data-theme="indigo">
                        <div class="indigo"></div>
                        <span>Indigo</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="light-blue">
                        <div class="light-blue"></div>
                        <span>Light Blue</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="teal">
                        <div class="teal"></div>
                        <span>Teal</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="light-green">
                        <div class="light-green"></div>
                        <span>Light Green</span>
                    </li>
                    <li data-theme="lime">
                        <div class="lime"></div>
                        <span>Lime</span>
                    </li>
                    <li data-theme="yellow">
                        <div class="yellow"></div>
                        <span>Yellow</span>
                    </li>
                    <li data-theme="amber">
                        <div class="amber"></div>
                        <span>Amber</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div>
                        <span>Deep Orange</span>
                    </li>
                    <li data-theme="brown">
                        <div class="brown"></div>
                        <span>Brown</span>
                    </li>
                    <li data-theme="grey">
                        <div class="grey"></div>
                        <span>Grey</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div>
                        <span>Blue Grey</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div>
                        <span>Black</span>
                    </li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</section>
