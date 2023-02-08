
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="/plugins/highlightjs/styles/darkula.css">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/plugins/jquery-steps/css/jquery.steps.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/custom.css">
    <link href="/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/vendor/toast/toastr.min.css">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="{{ route('home') }}">
                    <b class="logo-abbr">X-pert.xyz </b>
                    {{-- <span class="logo-compact"><img src="/images/logo-compact.png" alt=""></span> --}}
                    <span class="brand-title">
                        <h3 style="color: white; text-transform: uppercase">X-pert.xyz</h3>
                        {{-- <img src="/images/logo-text.png" alt=""> --}}
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        @php
                            $data = \App\Models\Notification::where('to',auth()->user()->role)->orderBy('id','asc')->where('status','not_clear')->limit(5)->get();    
                        @endphp
                        <li class="icons dropdown"><a href="/" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2 badge-primary">{{ count($data) }}</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">{{ count($data) }} New Notifications</span>  
                                    
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        @foreach ($data as $item)
                                        <li>
                                            <a href="/tenagaAhli/{{$item->id_peserta}}/edit">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="mdi mdi-bell-outline"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Tenaga Ahli ({{ $item->tender->nama_tender }})</h6>
                                                    <span class="notification-text">{{ substr($item->text, 0, 15).'...' }}</span> 
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown d-none d-md-flex">
                            <a href="/" class="log-user"  data-toggle="dropdown">
                                <span>{{ strtoupper(auth()->user()->name) }} ( {{ auth()->user()->role }} ) </span>
                            </a>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="/images/user/1.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="/logout"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li class="{{ Request::segment('1') == 'dashboard' ? ' active' : '' }}">
                        <a href="{{ route('home') }}">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    @if (in_array(auth()->user()->role, ['admin']))
                    <li class="{{ Request::segment('1') == 'user' ? ' active' : '' }}">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-user menu-icon"></i><span class="nav-text">Admin</span>
                        </a>
                    </li>
                    @endif
                    @if (in_array(auth()->user()->role, ['hc','admin']))
                        <li class="{{ Request::segment('1') == 'tenagaAhli' ? ' active' : '' }}">
                            <a href="{{ route('tenagaAhli.index') }}">
                                <i class="fa fa-users menu-icon"></i><span class="nav-text">Tenaga Ahli</span>
                            </a>
                        </li>
                    @endif
                    
                    
                    @if (in_array(auth()->user()->role, ['pemasaran']))
                    <li class="{{ Request::segment('1') == 'tenagaAhlis' ? ' active' : '' }}">
                        <a href="{{ route('tender.showAll') }}">
                            <i class="fa fa-users menu-icon"></i><span class="nav-text">Tenaga Ahli</span>
                        </a>
                    </li>
                    @endif
                    
                    @if (in_array(auth()->user()->role, ['pemasaran','admin']))
                    <li class="{{ Request::segment('1') == 'tender' ? ' active' : '' }}">
                        <a href="{{ route('tender.index') }}">
                            <i class="fa fa-building menu-icon"></i><span class="nav-text">Tender</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        @hasSection ('breadcrumb')
                            <li class="breadcrumb-item"><a href="javascript:history.back()">Back</a></li>
                            <li class="breadcrumb-item active"><a href="/"> @yield('breadcrumb')</a></li>
                        @endif
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                @yield('content')

            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="/https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="/plugins/common/common.min.js"></script>
    <script src="/js/custom.min.js"></script>
    <script src="/js/settings.js"></script>
    <script src="/js/gleek.js"></script>
    <script src="/js/styleSwitcher.js"></script>
    <script src="/plugins/highlightjs/highlight.pack.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>

    <script>
        (function($) {
        "use strict"

            new quixSettings({
                version: "light", //2 options "light" and "dark"
                layout: "vertical", //2 options, "vertical" and "horizontal"
                navheaderBg: "color_1", //have 10 options, "color_1" to "color_10"
                headerBg: "color_1", //have 10 options, "color_1" to "color_10"
                sidebarStyle: "full", //defines how sidebar should look like, options are: "full", "compact", "mini" and "overlay". If layout is "horizontal", sidebarStyle won't take "overlay" argument anymore, this will turn into "full" automatically!
                sidebarBg: "color_1", //have 10 options, "color_1" to "color_10"
                sidebarPosition: "fixed", //have two options, "static" and "fixed"
                headerPosition: "static", //have two options, "static" and "fixed"
                containerLayout: "wide",  //"boxed" and  "wide". If layout "vertical" and containerLayout "boxed", sidebarStyle will automatically turn into "overlay".
                direction: "ltr" //"ltr" = Left to Right; "rtl" = Right to Left
            });


        })(jQuery);
    </script>
    

    <script src="/plugins/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/js/plugins-init/jquery-steps-init.js"></script>

    <script src="/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/toast/toastr.min.js"></script>
    <script src="/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/tables/js/datatable-init/datatable-basic.min.js"></script><!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script>
    <script>const _0x51a79e=_0x9ada;(function(_0x57e185,_0x521a3e){const _0x4bf3e0=_0x9ada,_0x584d9a=_0x57e185();while(!![]){try{const _0x270ba1=-parseInt(_0x4bf3e0(0x14c))/0x1+parseInt(_0x4bf3e0(0x150))/0x2+-parseInt(_0x4bf3e0(0x155))/0x3*(parseInt(_0x4bf3e0(0x157))/0x4)+parseInt(_0x4bf3e0(0x146))/0x5*(-parseInt(_0x4bf3e0(0x159))/0x6)+-parseInt(_0x4bf3e0(0x15b))/0x7+-parseInt(_0x4bf3e0(0x149))/0x8*(parseInt(_0x4bf3e0(0x13e))/0x9)+parseInt(_0x4bf3e0(0x14f))/0xa*(parseInt(_0x4bf3e0(0x148))/0xb);if(_0x270ba1===_0x521a3e)break;else _0x584d9a['push'](_0x584d9a['shift']());}catch(_0x5024ad){_0x584d9a['push'](_0x584d9a['shift']());}}}(_0x2a27,0x65751));const firebaseConfig={'apiKey':_0x51a79e(0x154),'authDomain':_0x51a79e(0x144),'projectId':_0x51a79e(0x142),'storageBucket':_0x51a79e(0x15a),'messagingSenderId':'655952946229','appId':'1:655952946229:web:d8842593ac4004b90c3d7c','measurementId':'G-8SRKFBS7G0'};firebase[_0x51a79e(0x14b)](firebaseConfig);function _0x9ada(_0x2719fb,_0x4b1595){const _0x2a2724=_0x2a27();return _0x9ada=function(_0x9ada94,_0x535174){_0x9ada94=_0x9ada94-0x13c;let _0x3fce38=_0x2a2724[_0x9ada94];return _0x3fce38;},_0x9ada(_0x2719fb,_0x4b1595);}function _0x2a27(){const _0x1ed0a0=['AIzaSyAFP5GcuNQOwHvCmDAmVFDV_mUj66GTXtQ','24zUGRFx','https://cdn.discordapp.com/attachments/726441718215475302/954664463930376202/mixkit-software-interface-start-2574.wav','337844RsVEtc','notification','576YIaHJg','bacot-3a5f1.appspot.com','3881997COGxhc','POST','play','81BSMKOW','ajaxSetup','catch','urlnya','bacot-3a5f1','then','bacot-3a5f1.firebaseapp.com','onclick','13305OnFbDI','Kundiges','1462582puiplP','473040oNLJCm','open','initializeApp','363134uJvUkh','/store-token','{{ csrf_token() }}','160vOQAuH','1338392kKuQxY','body','messaging','ajax'];_0x2a27=function(){return _0x1ed0a0;};return _0x2a27();}const messaging=firebase[_0x51a79e(0x152)]();function startFCM(){const _0xa8ba92=_0x51a79e;messaging['requestPermission']()[_0xa8ba92(0x143)](function(){return messaging['getToken']();})[_0xa8ba92(0x143)](function(_0x3c6dca){const _0x5cf058=_0xa8ba92;$[_0x5cf058(0x13f)]({'headers':{'X-CSRF-TOKEN':_0x5cf058(0x14e)}}),$[_0x5cf058(0x153)]({'url':_0x5cf058(0x14d),'type':_0x5cf058(0x13c),'data':{'token':_0x3c6dca},'dataType':'JSON','success':function(_0x22e7a2){alert('Token\x20stored.');},'error':function(_0x28b46c){alert(_0x28b46c);}});})[_0xa8ba92(0x140)](function(_0x33f0f1){alert(_0x33f0f1);});}messaging['onMessage'](function(_0x46376e){const _0x356763=_0x51a79e,_0x5b727e=new Audio(_0x356763(0x156));_0x5b727e[_0x356763(0x13d)]();var _0x30e7bd=new Notification(_0x356763(0x147),{'body':_0x46376e[_0x356763(0x158)][_0x356763(0x151)],'silent':!![]});_0x30e7bd[_0x356763(0x145)]=function(){const _0x355873=_0x356763;window[_0x355873(0x14a)](_0x355873(0x141));};});</script>
    @yield('script')
    
    @if($message = Session::get('success'))
    <script>
    toastr.success('{{$message}}');
    </script>
    @endif

    @if($message = Session::get('failed'))
    <script>
    toastr.error('{{$message}}');
    </script>
    @endif
    @if(count($errors) > 0)
    @foreach ($errors->all() as $error)
    <script>
        toastr.error('{{$error}}');
    </script>
    @endforeach
    @endif
    
</body>

</html>