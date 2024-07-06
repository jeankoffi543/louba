@extends('admin.layouts.base')


@section('content')

<style>
.modal {
  --bs-modal-zindex: 1055;
  --bs-modal-width: 90%;
  --bs-modal-padding: 1rem;
  --bs-modal-margin: 0.5rem;
  --bs-modal-color: ;
  --bs-modal-bg: #fff;
  --bs-modal-border-color: var(--bs-border-color-translucent);
  --bs-modal-border-width: 1px;
  --bs-modal-border-radius: 0.5rem;
  --bs-modal-box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
  --bs-modal-inner-border-radius: calc(0.5rem - 1px);
  --bs-modal-header-padding-x: 1rem;
  --bs-modal-header-padding-y: 1rem;
  --bs-modal-header-padding: 1rem 1rem;
  --bs-modal-header-border-color: var(--bs-border-color);
  --bs-modal-header-border-width: 1px;
  --bs-modal-title-line-height: 1.5;
  --bs-modal-footer-gap: 0.5rem;
  --bs-modal-footer-bg: ;
  --bs-modal-footer-border-color: var(--bs-border-color);
  --bs-modal-footer-border-width: 1px;
}
</style>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Articles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Siteweb</a></li>
          <li class="breadcrumb-item active">Article</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">





   
         

           





            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
              
              
              

                <div class="card-body">


                
                  <h5 class="card-title">Articles <span>|{{$articles->count()}}</span></h5>

                  <table class="table table-borderless datatable" id="monTableau">
                    <thead>
                      <tr>
                        <th scope="col">#Tag</th>
                        <th scope="col">Date mise a jour</th>
                        <th scope="col">Titre</th>
                        <th scope="col">contenu paragraphe1</th>
                        <th scope="col">contenu paragraphe2</th>
                        <th scope="col">image</th>
                         <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      
                      @foreach ($articles as $article)
                      <tr>
                        <th scope="row"><a href="#">#{{$article->tagdur}}#</a></th>
                        <td>{{$article->date_mise_a_jour}}</td>
                        <td>{{$article->titre}}</td>
                        <td>{{mb_strimwidth($article->paragraphe1, 0, 50)}}...</td>
                        <td>{{mb_strimwidth($article->paragraphe2, 0, 50)}}...</td>
                        <td><img style="width:100px" src="{{$article->image}}"></td>
                        
                        <td>
                        
                                         <!-- Modal Dialog Scrollable -->
                        <a class="badge bg-success"  data-bs-toggle="modal" data-bs-target="#actualiser{{$article->id}}" >Actualiser</a>
                        <br>
                        <a class="badge bg-success" href="/modifyArticle/{{$article->id}}" >Edition visuel</a>
                        
                      
   
   
   
   
   
   
  
               <div class="modal fade" id="actualiser{{$article->id}}" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable" >
                  <div class="modal-content" >
                    <div class="modal-header" >
                      <h5 class="modal-title">Actualiser article: #{{$article->tagdur}}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
         
         
       
                    
                    
                    
                    
                    <div class="card">
            <div class="card-body">
              <h5 class="card-title"># {{$article->tagdur}}</h5>

              <!-- Bordered Tabs Justified -->
              <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
              
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home{{$article->id}}" type="button" role="tab" aria-controls="home" aria-selected="false" tabindex="-1">Image Article</button>
                </li>
                
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile{{$article->id}}" type="button" role="tab" aria-controls="profile" aria-selected="true">Texte article</button>
                </li>
                
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact{{$article->id}}" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Tag</button>
                </li>
                
              </ul>
              <div class="tab-content pt-2" id="borderedTabJustifiedContent">
              
                <div class="tab-pane fade" id="bordered-justified-home{{$article->id}}" role="tabpanel" aria-labelledby="home-tab">
                  
                  <div style='text-align:center' >
                  <img src='{{$article->image}}' style='max-height:300px' >
                  </div>
                  
                            <form method="POST" action="/modifyimageArticle" enctype="multipart/form-data" >
                    <input name="id" type="hidden" value="{{$article->id}}"  >
                    @method('PUT')
                    @csrf    
                
                              <div class="modal-body">
                    
                 <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Nouvelle Image</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="newimage" required>
                  </div>
                </div>


		        
                    
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                      <button type="submit" class="btn btn-primary">Actualiser</button>
                    </div>
                    
                    </form>
                </div>
                
                
                
                
                
                
                
                
                <div class="tab-pane fade active show" id="bordered-justified-profile{{$article->id}}" role="tabpanel" aria-labelledby="profile-tab">
                
                  <form method="POST" action="/modifyArticle" >
                    <input name="id" type="hidden" value="{{$article->id}}" >
                    @method('PUT')
                    @csrf    
                
                              <div class="modal-body">
                    
                 <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Titre</label>
                  <div class="col-sm-10">
                    <input name="titre" value="{{$article->titre}}" class="form-control">
                  </div>
                </div>
                
				<div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Paragraphe1</label>
                  <div class="col-sm-10">
                    <textarea name='paragraphe1' class="form-control" style="height: 100px">{{$article->paragraphe1}}</textarea>
                  </div>
                </div>
                
                
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Paragraphe2</label>
                  <div class="col-sm-10">
                    <textarea name='paragraphe2' class="form-control" style="height: 100px">{{$article->paragraphe2}}</textarea>
                  </div>
                </div>

		        
                    
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                      <button type="submit" class="btn btn-primary">Actualiser</button>
                    </div>
                    
                    </form>
                    
                    
                    
                </div>
                
                
                <div class="tab-pane fade" id="bordered-justified-contact{{$article->id}}" role="tabpanel" aria-labelledby="contact-tab">
                  #{{$article->tagdur}}
                </div>
              </div><!-- End Bordered Tabs Justified -->

            </div>
          </div>

   
                    

        
                    
                    
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
