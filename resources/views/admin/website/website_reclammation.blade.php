@extends('admin.layouts.base')


@section('content')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Réclamations</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Réclamations</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">



         

           





            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
              


                <div class="card-body">
                
                
                
                
                  <h5 class="card-title">réclamations <span>| {{$reclammations->count()}}</span></h5>

                  <table class="table table-borderless datatable" id="monTableau">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Type de requetes</th>
                        <th scope="col">message</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date de Traitement</th>
                        <th scope="col">Traiter requete</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      
                      @foreach ($reclammations as $reclammation)
                      <tr>
                        <th scope="row"><a href="#">#{{$reclammation->id}}#</a></th>
                        <td>{{$reclammation->nom_prenom}}</td>
                        <td>{{$reclammation->email}}<br>{{$reclammation->telephone}}</td>
                        <td>{{$reclammation->sujet}}</td>
                        <td>{{$reclammation->message}}</td>
                        <td>{{$reclammation->date}}</td>
                        <td>{{$reclammation->status}}</td>
                        <td>{{$reclammation->date_traitement}}</td>
                        <td>
                        
                        
                        
                         <!-- Modal Dialog Scrollable -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable{{$reclammation->id}}">
                <i class="bi bi-save2"></i>Traiter
              </button>
              <div class="modal fade" id="modalDialogScrollable{{$reclammation->id}}" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><i class="bi bi-save2"></i>  Traiter requete</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <form method="POST" action="/traiterReclammation" >
                    @method('PUT')
                    @csrf
                    
                    

                
               

                    
                    <div class="modal-body">
                    
                    
                    
                                        <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Statuts</label>
                  <div class="col-sm-10">
                    <select name="status" required="" class="form-control">
                    <option value="En cours de traitement">En cours de traitement </option>
                     <option value="Terminer">Terminer</option>
                    </select>
                  </div>
                </div>
                    
                    
                         <div class="row mb-3">
		         
		          <div class="col-sm-10">
		            <input name="id" value="{{$reclammation->id}}" type="hidden" class="form-control">
		          </div>
		        </div>
		        

		        
	
		        
		        
                    
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                      <button type="submit" class="btn btn-primary">Valider le traitement</button>
                    </div>
                    
                    </form>
                    
                    
                  </div>
                </div>
              </div><!-- End Modal Dialog Scrollable-->
           
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
