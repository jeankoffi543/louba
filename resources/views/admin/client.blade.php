@extends('admin.layouts.base')


@section('content')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Client</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">client</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">





   
         

           





            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
              
              
              


                <div class="card-body">
                
                
                
   


                
                  <h5 class="card-title">Clients <span>| {{$clients->count()}}</span></h5>

                  <table class="table table-borderless datatable" id="monTableau">
                    <thead>
                      <tr  >
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Email</th>
                        <th scope="col">adresse</th>
                        <th scope="col">Acttion</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      
                      @foreach ($clients as $client)
                      <tr <?php if( $client->actif_client == 0 )echo "style='background:#fb9898'"; ?> >
                        <th scope="row"><a href="#">#{{$client->id}}#</a></th>
                        <td>{{$client->nom_client}}</td>
                        <td>{{$client->telephone_client}}</td>
                        <td>{{$client->email_client}}</td>
                        <td>{{$client->adresse_client}}</td>
                        <td>
                       
                       <a class="badge bg-success" href="/resetPasswordClient/{{$client->id}}" onclick='return confirm("Le mot de passe du compte {{$client->nom_client}} sera renitialiser ?")'>Renitialiser mot de passe</a>
                        
                        <form method="POST" action="/actifClient" id="form{{$client->id}}" >
                        @method('PUT')
                        @csrf
                        <input name="id" id="id{{$client->id}}" type="hidden" value="{{$client->id}}" >
                        <input name="actif" id="actif{{$client->id}}" type="hidden"  >
                    <div class="form-check form-switch">
<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked{{$client->id}}" <?php if($client->actif_client == 1) echo 'checked=""'; ?> onclick="activator{{$client->id}}()" >
                     
                    </div>
                    </form>
                    
                    <script>
function activator{{$client->id}}()
{
  var checkBox = document.getElementById("flexSwitchCheckChecked{{$client->id}}");

  if (checkBox.checked == true)
  {
  	 document.getElementById("actif{{$client->id}}").value = 1;
    document.getElementById("form{{$client->id}}").submit();
  } 
  else
  {
	  document.getElementById("actif{{$client->id}}").value = 0;
	  document.getElementById("form{{$client->id}}").submit(); 
  }
} 
                    </script>
                    
                    
                        </td>
                        
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
