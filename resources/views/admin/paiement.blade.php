@extends('admin.layouts.base')


@section('content')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Paiement</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Paiement</a></li>
          <li class="breadcrumb-item active">Paiement</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">





   
         

           





            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
              
              
              

                <div class="card-body">
                
                
      


                
                  <h5 class="card-title">Paiement <span>| {{$paiements->count()}}</span></h5>

                  <table class="table table-borderless datatable" id="monTableau">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Montant</th>
                        <th scope="col">Reference</th>
                        <th scope="col">IdPayeur</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                        <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
 
                      </tr>                  
                      @foreach ($paiements as $paiement)
                      <tr>
                        <th scope="row"><a href="#">#{{$paiement->id}}#</a></th>
                        <td>{{$paiement->amount_pay}}</td>
                        <td>{{$paiement->reference_pay}}</td>
                        <td>{{$paiement->id_client}}</td>
                        <td>{{$paiement->date_pay}}</td>
 
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->








        
        
        
        
        
        
        

      </div>
    </section>

  </main><!-- End #main -->
  
  
  
  
  
  
@stop
