<?php
$user = \Auth::user();
$activeAppID = 100000046;
$menuItem = NULL;
$adminMenu = array();
if ($user->role != 'admin') {
    $menuItem['badge']['style'] = NULL;
    $menuItem['badge']['text'] = NULL;
    $menuItem['name'] = trans('surveys.home');
    $menuItem['icon'] = 'fa-building';
    $menuItem['link'] = url('/') . '';
    if ($selected == 'home')
        $menuItem['active'] = 1;
    else
        $menuItem['active'] = 0;
    $menuItem['children'] = NULL;
    $adminMenu[] = $menuItem;

    $menuItem['badge']['style'] = NULL;
    $menuItem['badge']['text'] = NULL;
    $menuItem['name'] = trans('surveys.profile');
    $menuItem['icon'] = 'fa-building';
    $menuItem['link'] = url('/profile') . '';
    if ($selected == 'profile')
        $menuItem['active'] = 1;
    else
        $menuItem['active'] = 0;
    $menuItem['children'] = NULL;
    $adminMenu[] = $menuItem;
} else {
    $menuItem['badge']['style'] = NULL;
    $menuItem['badge']['text'] = NULL;
    $menuItem['name'] =  trans('surveys.surveys');
    $menuItem['icon'] = 'fa-building';
    $menuItem['link'] = url('/surveys') . '';
    if ($selected == 'surveys')
        $menuItem['active'] = 1;
    else
        $menuItem['active'] = 0;
    $menuItem['children'] = NULL;
    $adminMenu[] = $menuItem;

    $menuItem['badge']['style'] = NULL;
    $menuItem['badge']['text'] = NULL;
    $menuItem['name'] = trans('surveys.smes');
    $menuItem['icon'] = 'fa-building';
    $menuItem['link'] = url('/smes') . '';
    if ($selected == 'smes')
        $menuItem['active'] = 1;
    else
        $menuItem['active'] = 0;
    $menuItem['children'] = NULL;
    $adminMenu[] = $menuItem;

    $menuItem['badge']['style'] = NULL;
    $menuItem['badge']['text'] = NULL;
    $menuItem['name'] = trans('surveys.reports');
    $menuItem['icon'] = 'fa-building';
    $menuItem['link'] = url('/reports') . '';
    if ($selected == 'reports')
        $menuItem['active'] = 1;
    else
        $menuItem['active'] = 0;
    $menuItem['children'] = NULL;
    $adminMenu[] = $menuItem;
}
$string = base64_encode(serialize($adminMenu));

include_once $_SERVER['DOCUMENT_ROOT'] . '/myadmin/resources/helpers/helper.php';
$head = callAppsForceAPI($activeAppID, 'include/head', 1);
$topbar = callAppsForcePostAPI($activeAppID, 'includeMenu/topbar', $string, 1);
$leftbar = callAppsForcePostAPI($activeAppID, 'includeMenu/leftbar', $string, 1);
$scripts = callAppsForceAPI($activeAppID, 'include/scripts', 1);
$footer = callAppsForceAPI($activeAppID, 'include/footer',);
if ($head == null | $topbar == null | $leftbar == null | $scripts == null | $footer == null) {
    header('Location: /issue?message=Error accessing Graphics APIs');
    die();
}
if ($head['code'] != '200' | $topbar['code'] != '200' | $leftbar['code'] != '200' | $scripts['code'] != '200' | $footer['code'] != '200') {
    header('Location: /login');
    die();
}
$head = $head['data'];
$topbar = $topbar['data'];
$leftbar = $leftbar['data'];
$scripts = $scripts['data'];
$footer = $footer['data'];
?>

<!doctype html>           
<html>
    <head>
        <?php echo $head; ?>
        @include('includes.notific8')
        <link href="/mysurvey/resources/sass/survey-creator.css" type="text/css" rel="stylesheet"/>

         <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body class="page-header-fixed page-footer-fixed navbar navbar-fixed-top page-content-white page-sidebar-fixed">
        <?php echo $topbar; ?>
        <div class="page-container">
            <?php echo $leftbar; ?>
            <div class="page-content-wrapper">
                <div class="page-content">
                    @yield('content')
                </div>

                <!-- BEGIN QUICK SIDEBAR -->
                <a href="javascript:;" class="page-quick-sidebar-toggler">
                    <i class="icon-login"></i>
                </a>
                <div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
                    <div class="page-quick-sidebar">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab">Menu
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
                                <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
                                    <ul class="media-list list-items" id="appsforce-sidebar-paste">

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END QUICK SIDEBAR -->
            </div>
            <?php echo $footer; ?>
            <?php echo $scripts; ?>

            <script src="/mysurvey/resources/js/knockout-min.js"></script>
            <script src="/mysurvey/resources/js/survey.ko.js"></script>
            <script src="/mysurvey/resources/js/ace.min.js" type="text/javascript" charset="utf-8"></script>
            <script src="/mysurvey/resources/js/ext-language_tools.js" type="text/javascript" charset="utf-8"></script>
            <script src="/mysurvey/resources/js/survey-creator.js"></script>
            <script src="/mysurvey/resources/js/index.js" type="text/javascript"></script>

            <script>
                jQuery(document).ready(function ($) {
                    $("#selectall").change(function () {
                    $(".checkboxes").prop("checked", $(this).prop("checked"));
                    });
                });
            </script>
            <script>
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                })
        </script>
    </body>
</html>
