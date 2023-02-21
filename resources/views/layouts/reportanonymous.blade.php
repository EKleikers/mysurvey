
<!doctype html>
<html>
    <head>
        <!--Copyright AppsForce Ltd.-->
        <meta charset="utf-8" />
        <title>Anonymous Graph</title>

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
        <link href="/myadmin/resources/assets/layouts/layout/css/theme1.css" rel="stylesheet" type="text/css" />                <link href="/mysurvey/resources/sass/survey.min.css" type="text/css" rel="stylesheet"/>

         <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body class="page-header-fixed page-footer-fixed navbar navbar-fixed-top page-content-white page-sidebar-fixed">
        <div class="page-logo">
            <a href="https://digitalewerkplaatsen.nl/">
            <?php
                $client = \DB::table('appsforce_client')->first();
                if ($client->logo == 'default') {
            ?>
                <img src="/myadmin/resources/assets/layouts/layout/img/AppsForceLogoB.png" alt="AppsForce"  width="100" style="margin-top: 10px"> </a>
            <?php } else {?>
                <img src="/myadmin/public/images/avatars/{{$client->logo}}" alt=""  width="130px" height="40px" style="object-fit: contain; margin-top: 5px"> </a>
                <!-- <img src="app/public/images/DWP_logo-long-black.png" alt=""  width="130px" height="40px" style="object-fit: contain; margin-top: 5px"> </a> -->
                <?php
                    }
                ?> 
        
                <label> Digitale Werkplaatsen Limburg </label>
        </div>    
        <div class="page-container">

            <div class="page-content-wrapper">
                <div class="page-content">
                   
                    @yield('content')
                </div>

             

        <style>
        #chartdiv {
        width: 100%;
        height: 500px;
        }
        </style>

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

       

