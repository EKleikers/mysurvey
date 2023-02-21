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
$head = callAppsForceAPI($activeAppID, 'include/head');
$topbar = callAppsForcePostAPI($activeAppID, 'includeMenu/topbar', $string);
$leftbar = callAppsForcePostAPI($activeAppID, 'includeMenu/leftbar', $string);
$scripts = callAppsForceAPI($activeAppID, 'include/scripts');
$footer = callAppsForceAPI($activeAppID, 'include/footer');
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
        <link href="/mysurvey/resources/sass/survey.min.css" type="text/css" rel="stylesheet"/>
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

        <style>
        #chartdiv {
        width: 100%;
        height: 500px;
        }
        </style>

        <!-- Resources -->
        <script src="/mysurvey/resources/js/core.js"></script>
        <script src="/mysurvey/resources/js/charts.js"></script>
        <script src="/mysurvey/resources/js/animated.js"></script>
        <script src="/myadmin/resources/assets/global/plugins/amcharts/amcharts/amcharts.js"></script>
        <script src="/myadmin/resources/assets/global/plugins/amcharts/amcharts/radar.js"></script>
        <!-- Chart code -->
        <script>
        am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        /* Create chart instance */
        var chart = am4core.create("chartdiv", am4charts.RadarChart);

        /* Add data */
        chart.data = [
            <?php foreach ($data as $answ) {
                ?>
                {
                    "question": "<?php echo $answ[0]; ?>",
                    "avarage": "<?php echo $answ[1]; ?>",
                    "myanswers": "<?php echo $answ[2]; ?>"
                }, 
             <?php } ?>
        ];
        
        
        /* Create axes */
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "question";

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
       
        //valueAxis.renderer.gridType = "polygons";

        /* Create and configure series */
        var series2 = chart.series.push(new am4charts.RadarSeries());
        series2.dataFields.valueY = "myanswers";
        series2.dataFields.categoryX = "question";
        series2.name = "<?php echo trans ('surveys.radarmyanswers')?>"; 
        series2.stroke = am4core.color("#ff0000"); // line = red
        series2.strokeWidth = 3;
        series2.fill = am4core.color("#ff0000"); // fill = red
        series2.fillOpacity = 0.2;
    
        var series = chart.series.push(new am4charts.RadarSeries());
        series.dataFields.valueY = "avarage";
        series.dataFields.categoryX = "question";
        series.name = "<?php echo trans ('surveys.benchmark')?>";  
        series.strokeWidth = 3;
        series.fillOpacity = 0.2;
        
        /* Add legend */
        chart.legend = new am4charts.Legend();
        chart.legend.position = "bottom";

        }); 
        </script>   
      
    </body>
</html>

       

