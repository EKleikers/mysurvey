<!doctype html>
<html>
<head>
    <!--Copyright AppsForce Ltd.-->
    <meta charset="utf-8" />
    <title>Anonymus Survey</title>
    <?php if (is_dir('/myadmin/resources/assets/')) { ?>   
    <link href="/myadmin/resources/assets/remote/opensans/opensans.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/assets/global/plugins/simple-line-icons/simple-line-icons.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="/myadmin/resources/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/assets/global/plugins/jquery-notific8/jquery.notific8.min.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/assets/global/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/public/assets/addchat/css/addchat.css" rel="stylesheet">
    <link href="/myadmin/resources/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link href="/myadmin/resources/assets/layouts/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/assets/layouts/layout/css/theme1.css" rel="stylesheet" type="text/css" /> 
    <?php } else { ?>
    <link href="/myadmin/resources/themes/metronic/assets/remote/opensans/opensans.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/themes/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/themes/metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/themes/metronic/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/themes/metronic/assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="/myadmin/resources/themes/metronic/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/themes/metronic/assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/themes/metronic/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/themes/metronic/assets/global/plugins/jquery-notific8/jquery.notific8.min.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/themes/metronic/assets/global/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/themes/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link href="/myadmin/resources/themes/metronic/assets/layouts/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/themes/metronic/assets/layouts/layout/css/theme1.css" rel="stylesheet" type="text/css" />     
        

    <?php } ?>    
    <link href="/mysurvey/resources/sass/survey.min.css" type="text/css" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="page-header-fixed page-footer-fixed navbar navbar-fixed-top page-content-white page-sidebar-fixed">

    <div class="page-logo">
        
        <?php
        try {
            $client = \DB::table('appsforce_client')->first();
            if ($client->logo == 'default') {
        ?>
            <a href="https://appsforce.org/">
            <img src="myadmin/resources/assets/layouts/layout/img/AppsForceLogoB.png" alt="AppsForce"  width="100" style="margin-top: 10px"> </a>
            <label>AppsForce</label>
            <?php } else {?>
            <a href="https://digitalewerkplaatsen.nl/">
            <img src="/myadmin/public/images/avatars/{{$client->logo}}"  alt=""  width="130px" height="40px" style="object-fit: contain; margin-top: 5px"> </a>
            <label>{{$client->company}}</label>
            <?php
                }
            } catch (\Exception $e) {
                ?> <img src="myadmin/resources/assets/layouts/layout/img/AppsForceLogoB.png" alt="AppsForce"  width="100" style="margin-top: 10px"> </a> <?php
            }
            ?> 
    
            
        </div>
        <div class="page-container">
        <div class="col-md-1">
        </div>
            <div class="col-md-10">
                    <div class="page-content">
                        @yield('content')
                    </div>
            </div>
            <div class="page-footer">
    
                <div class="page-footer-inner">
                    &copy; AppsForce 2020 Version 2.4.16.1 71d8136d 
                </div>
            </div>
    
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>                   
        </div>
        <?php if (is_dir('/myadmin/resources/assets/')) { ?>    
        <!--[if lt IE 9]>
        <script src="/myadmin/resources/assets/global/plugins/respond.min.js"></script>
        <script src="/myadmin/resources/assets/global/plugins/excanvas.min.js"></script> 
        <script src="/myadmin/resources/assets/global/plugins/ie8.fix.min.js"></script> 
        <![endif]-->
        <script src="/myadmin/resources/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>   
        <script src="/myadmin/resources/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/assets/layouts/layout/scripts/layout.js" type="text/javascript"></script>
        <script src="/myadmin/resources/assets/global/plugins/jquery-notific8/jquery.notific8.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/assets/layouts/global/scripts/quick-sidebar.js" type="text/javascript"></script>
        <script src="/myadmin/resources/assets/layouts/global/scripts/quick-nav.js" type="text/javascript"></script>
        <script src="/myadmin/resources/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <?php } else { ?>
        <script src="/myadmin/resources/themes/metronic/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/themes/metronic/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/themes/metronic/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/themes/metronic/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/themes/metronic/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/themes/metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/themes/metronic/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/themes/metronic/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>   
        <script src="/myadmin/resources/themes/metronic/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/themes/metronic/assets/layouts/layout/scripts/layout.js" type="text/javascript"></script>
        <script src="/myadmin/resources/themes/metronic/assets/global/plugins/jquery-notific8/jquery.notific8.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/themes/metronic/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="/myadmin/resources/themes/metronic/assets/layouts/global/scripts/quick-sidebar.js" type="text/javascript"></script>
        <script src="/myadmin/resources/themes/metronic/assets/layouts/global/scripts/quick-nav.js" type="text/javascript"></script>
        <script src="/myadmin/resources/themes/metronic/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>    
        <?php } ?>
        <script src="/mysurvey/resources/js/knockout-min.js"></script>
        <script src="/mysurvey/resources/js/survey.ko.js"></script>
        <script src="/mysurvey/resources/js/ace.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="/mysurvey/resources/js/ext-language_tools.js" type="text/javascript" charset="utf-8"></script>
        <!-- Uncomment to enable Select2 <script src="https://unpkg.com/jquery"></script> <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->
        <script type="text/javascript" src="/mysurvey/resources/js/takeanonymous.js"></script>    
        <script> 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </body>
</html>
