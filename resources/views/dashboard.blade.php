@include('head2')
<body class="theme-red">
    @include('topbar')
    @include('menu2')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>
              @if(Auth::user()->role != 1)
                @if($contx ==0)
                  @include('addRtRwNetOnDashboard')
                @endif
              @endif
            <!-- Widgets -->

                <!-- #END# Browser Usage -->
            </div>
        </div>
    </section>
    @include('footer2')
