@php
	use App\Http\Controllers\TableauController;
@endphp

@extends('admin.layouts.base')


@section('content')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Tableau de bord</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">





   
         

           





            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
              
              
              

                <div class="card-body">
                
          



<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
</figure>


<script>
Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Nombre de demande'
    },
    subtitle: {
        text: ' '
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Nombre de demande'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [
    
    {
        name: 'Rendez-vous pris',
        data: [<?php
for($i=1;  $i<=12;$i++){
	if( strlen($i."")==1 )$ii="0".$i;
	else $ii = $i;
	echo TableauController::statMonthStatut($ii,"ALL").",";
	
}
?>]
    }, 
    
    {
        name: 'Rendez-vous en attente',
        data: [<?php
for($i=1;  $i<=12;$i++){
	if( strlen($i."")==1 )$ii="0".$i;
	else $ii = $i;
	echo TableauController::statMonthStatut($ii,"0").",";
	
}
?>]
    },
    
        {
        name: 'Rendez-vous acquitter',
        data: [<?php
for($i=1;  $i<=12;$i++){
	if( strlen($i."")==1 )$ii="0".$i;
	else $ii = $i;
	echo (TableauController::statMonthStatut($ii,"1")+TableauController::statMonthStatut($ii,"-1")).",";
	
}
?>]
    },
    
    
    
    ]
});

</script>

                
                
                
                





<figure class="highcharts-figure">
    <div id="container3"></div>
</figure>
      
                
 <script>
 // Data retrieved from https://netmarketshare.com
Highcharts.chart('container3', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Proportion de rendez-vous, Annee : {{date('Y')}}'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [
        
        {
            name: 'Rendez-vou pris',
            y: {{TableauController::statAnneeStatut(date('Y'),"ALL")}},
            sliced: true,
            selected: true
        }, 
        
        {
            name: 'Rendez-vous en attente',
            y: {{TableauController::statAnneeStatut(date('Y'),"0")}}
        }, 
        
         {
            name: 'rendez-vous acquitter',
            y: {{TableauController::statAnneeStatut(date('Y'),"1")+TableauController::statAnneeStatut(date('Y'),"-1")}}
        }, 
        

        ]
    }]
});

 </script>              
                
   
   
   
   
   
             
                
 <figure class="highcharts-figure">
    <div id="container31"></div>
</figure>
      
                
 <script>
 // Data retrieved from https://netmarketshare.com
Highcharts.chart('container31', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Stat par point d enrollement: {{date('Y')}}'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [
        
        @foreach( $pointenrollements as $pointenrollement )
        {
            name: '{{$pointenrollement->nom_pe}}',
            y: {{
                        TableauController::stat_AnneeStatutPointenrolement(date('Y'),"-1",$pointenrollement->id_pe) + 
            			TableauController::stat_AnneeStatutPointenrolement(date('Y'),"1",$pointenrollement->id_pe) +
            			TableauController::stat_AnneeStatutPointenrolement(date('Y'),"2",$pointenrollement->id_pe) +
            			TableauController::stat_AnneeStatutPointenrolement(date('Y'),"-2",$pointenrollement->id_pe) +
             			TableauController::stat_AnneeStatutPointenrolement(date('Y'),"0",$pointenrollement->id_pe)
            }},
            sliced: true,
            selected: true
        }, 
        @endforeach  
        


        ]
    }]
});

 </script>              
                
                  
                
                
                
                
                
                
                
                
                
                
     
     
     
     
 
 

<figure class="highcharts-figure">
    <div id="container5"></div>
    
</figure>
               
                
                
                
  <script>              
             Highcharts.chart('container5', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: 'Statistique'
    },
    xAxis: {
        categories: [

            @foreach( $pointenrollements as $pointenrollement )
            '{{$pointenrollement->nom_pe}}',
            @endforeach
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rainfall (mm)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Rdv pris',
        <?php $valeurC = 10; ?>
        data: [
        	@foreach( $pointenrollements as $pointenrollement )
            {{ 
            TableauController::stat_AnneeStatutPointenrolement(date('Y'),"-1",$pointenrollement->id_pe) + 
            TableauController::stat_AnneeStatutPointenrolement(date('Y'),"1",$pointenrollement->id_pe) +
             TableauController::stat_AnneeStatutPointenrolement(date('Y'),"0",$pointenrollement->id_pe) + $valeurC 
             }},
            @endforeach
            ]

    }, {
        name: 'En attente',
        data: [
        	@foreach( $pointenrollements as $pointenrollement )
            {{ TableauController::stat_AnneeStatutPointenrolement(date('Y'),"0",$pointenrollement->id_pe) + $valeurC  }},
            @endforeach
            ]

    },
    
    {
        name: 'Acquites',
        data: [
            @foreach( $pointenrollements as $pointenrollement )
            {{ 
            TableauController::stat_AnneeStatutPointenrolement(date('Y'),"-1",$pointenrollement->id_pe) + 
            TableauController::stat_AnneeStatutPointenrolement(date('Y'),"1",$pointenrollement->id_pe) + $valeurC 
             }},
            @endforeach
            ]

    }
    
    ]
});
</script>   
                
                
                
                </div>

              </div>
            </div><!-- End Recent Sales -->








        
        
        
        
        
        
        

      </div>
    </section>

  </main><!-- End #main -->
  
  
  
  
  
  
@stop
