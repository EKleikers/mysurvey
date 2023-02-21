
<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/mysurvey/surveys";
$breadcrumb->add($b);
$breadcrumb->name = trans('surveys.surveyresults');

?>
@extends('layouts.report', ['selected' => 'home'])

@section('content')


@if ($survey->no_email == 1) 


<table class="table table-hover table-light" style="width:100%">

    <tr>
        <td style="width:40%" colspan="2">
        </div>
            <!-- <div style="font-size: 14px"if><strong>Bedankt voor het invullen van de vragenlijst!</strong></div> -->
        </td>
        <td>
       </td>
    <tr>
    <tr>
        <td colspan="2">
            <div style="font-size: 16px">
                U bent aan het einde gekomen van de  vragenlijst en rechts ziet u de uitslag van de ingevulde scan.
                <br/><br/>
                Wanneer u graag verder wil praten over deze uitslag of een vraag heeft voor ondersteuning kunt u zich 
                <br/>
                natuurlijk aanmelden bij het MKB Datalab Limburg. 
                <br/><br/>
                Studenten kunnen met uw vraag aan de slag of u kunt een training volgen om nog dieper in de materie te duiken.
                <br/>

                <br/><br/>
                <a href="https://www.brightlands.com/brightlands/mkb-datalab-limburg">mkb datalab limburg</a>
            </div>
        </td>
        <td style="width:60%; text-align:center" rowspan="3">
            <div style="font-size: 16px">Radar diagram data analyse volwassenheid</div>
            <div id="chartdiv"></div>
            <!-- <div>Gemiddelde score volwassenheid: {{ $average }}</div> -->
        </td>
        </tr>

        <form action="<?php echo url('/emailsave');?>" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
            {{ csrf_field() }}
            <tr>
                <td width = 20%>
                    <div style="font-size: 11px">
                        <!-- <input  style="height:25px;font-size:10pt;" name="email" id="email" type="text" class="form-control" placeholder="<?php echo trans('surveys.email'); ?>"> -->
                </div>
                </td>
                <td>
                    <div style="font-size: 11px">
                    <!-- <button type="submit" class="btn btn-success" ><?php echo trans('surveys.submit'); ?></button> -->
                </div>
                </td>
            </tr>
            

        </form>
        <tr>
        <td colspan="2">
            <div style="font-size: 11px">
                    <!-- Mocht je als bedrijf volwassener willen worden in de toepassing van data analyse dan biedt het MKB Datalab Limburg hiervoor een aantal diensten aan. Hiervoor verwijzen we je  graag naar onze website:  
                    <a href="https://www.brightlands.com/brightlands/mkb-datalab-limburg">link</a> -->
            </div>
        </td>
    </tr>
</table>
@else




<table class="table table-hover table-light" style="width:100%">
    <tr>
        <td style="width:40%" colspan="2">
            <div style="font-size: 14px"if><strong>Bedankt voor het invullen van de vragenlijst!</strong></div>
        </td>
        <td>
       </td>
    <tr>
    <tr>
        <td colspan="2">
            <div style="font-size: 11px">In het radar diagram aan de rechterzijde is weergegeven hoe je bedrijf scoort op verschillende onderdelen van de toepassing van data analyse. Per onderdeel wordt er een score gegeven tussen 1 en 4 en deze scores zijn een maat voor de volwassenheid op dat onderdeel (van laag naar hoog). Het gemiddelde van al deze scores is een indicatie van de volwassenheid van de toepassing van data analyse binnen je bedrijf: <br/> <br/>
                <strong>Score 1: Leek</strong><br/>
                Er is weinig of geen bewustzijn over de mogelijkheden van data analyse.<br/>
                <strong>Score 2: Beginner</strong><br/>
                Er wordt data verzameld en de mogelijkheden voor het toepassen van data analyse worden geïnventariseerd.<br/>
                <strong>Score 3: Gevorderd</strong><br/>
                Er is een overzicht van beschikbare data en er zijn (de eerste) succesvolle initiatieven van het toepassen van data analyse.<br/>
                <strong>Score 4: Expert</strong><br/>
                Er wordt structureel gebruik gemaakt van data analyse in de bedrijfsvoering en voor het nemen van beslissingen.<br/>
                <br/>
                Naast de score van je eigen bedrijf wordt er in het radar diagram ook voor elk onderdeel een gemiddelde score weergegeven. Dit laat zien hoe je scoort ten opzichte van andere MKB bedrijven die de vragenlijst hebben ingevuld (de benchmark). Omdat er in dit stadium nog weinig of geen bedrijven de vragenlijst hebben ingevuld, kunnen hier nog geen conclusies aan worden verbonden.<br/>
                <br/>
                Indien je geïnteresseerd bent in een benchmark van je bedrijf wanneer alle resultaten binnen zijn, dan kun je hier je e-mail achterlaten:
            </div>
        </td>
        <td style="width:60%; text-align:center" rowspan="3">
            <div>Radar diagram data analyse volwassenheid</div>
            <div id="chartdiv"></div>
            <div>Gemiddelde score volwassenheid: {{ $average }}</div>
        </td>
        </tr>

        <form action="<?php echo url('/emailsave');?>" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
            {{ csrf_field() }}
            <tr>
                <td width = 20%>
                    <div style="font-size: 11px">
                        <input  style="height:25px;font-size:10pt;" name="email" id="email" type="text" class="form-control" placeholder="<?php echo trans('surveys.email'); ?>">
                </div>
                </td>
                <td>
                    <div style="font-size: 11px">
                    <button type="submit" class="btn btn-success" ><?php echo trans('surveys.submit'); ?></button>
                </div>
                </td>
            </tr>
            

        </form>
        <tr>
        <td colspan="2">
            <div style="font-size: 11px">
                    Mocht je als bedrijf volwassener willen worden in de toepassing van data analyse dan biedt het MKB Datalab Limburg hiervoor een aantal diensten aan. Hiervoor verwijzen we je  graag naar onze website:  
                    <a href="https://www.brightlands.com/brightlands/mkb-datalab-limburg">mkb datalab limburg</a>
            </div>
        </td>
    </tr>
</table>
@endif

@endsection
