
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <script src="http://code.jquery.com/jquery-3.1.0.min.js" crossorigin="anonymous"></script>
    <!-- Jquery Core Js -->
    <script type="text/javascript" src="{{ URL::to('themes/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Css -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('themes/plugins/bootstrap/css/bootstrap.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::to('themes/plugins/font-awesome/css/font-awesome.css') }}">
    <!-- Waves Effect Css -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('themes/plugins/node-waves/waves.css') }}">


    <!-- Animation Css -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('themes/plugins/animate-css/animate.css') }}">



    <!-- Dropzone Css -->
    <link href="{{ URL::to('themes/plugins/dropzone/dropzone.css') }}" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="{{ URL::to('themes/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="{{ URL::to('themes/plugins/jquery-spinner/css/bootstrap-spinner.css') }}" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ URL::to('themes/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ URL::to('themes/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <!-- noUISlider Css -->
    <link href="{{ URL::to('themes/plugins/nouislider/nouislider.min.css') }}" rel="stylesheet" />


    <!-- Sweet Alert Css -->
    <link href="{{ URL::to('themes/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('themes/css/style.css') }}">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('themes/css/themes/all-themes.css') }}">

    <!-- JQuery DataTable Css -->
    <link href="{{ URL::to('themes/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- Morris Chart Css-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('themes/plugins/morrisjs/morris.css') }}">
    
    <style>
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    </style>


</head>
