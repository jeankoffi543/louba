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





 <h5 class="card-title">Actualiser articles <span> : {{$article->titre}} </span></h5>
 
 
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
                
                
                                <div class="row mb-3" style="display:none">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Paragraphe2</label>
                  <div class="col-sm-10">
                    <textarea name='paragraphe2' class="form-control" style="height: 100px">{{$article->paragraphe2}}</textarea>
                  </div>
                </div>

 <textarea name="paragraphe1">{{$article->paragraphe1}}</textarea>
 
  </div>
 
                      <button type="submit" class="btn btn-primary">Actualiser</button>
                    </form>
 
  <script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/ckeditor/ckeditor.js"></script>
 <script>
 CKEDITOR.replace( 'paragraphe1' );
CKEDITOR.on( 'instanceReady', function( evt )
  {
    var editor = evt.editor;
   
   editor.on('change', function (e) { 
    var contentSpace = editor.ui.space('contents');
    var ckeditorFrameCollection = contentSpace.$.getElementsByTagName('iframe');
    var ckeditorFrame = ckeditorFrameCollection[0];
    var innerDoc = ckeditorFrame.contentDocument;
    var innerDocTextAreaHeight = $(innerDoc.body).height();
    console.log(innerDocTextAreaHeight);
    });
 });

 </script>
 


                

               
               
               
               
                </div>

              </div>
            </div><!-- End Recent Sales -->








        
        
        
        
        
        
        

      </div>
    </section>

  </main><!-- End #main -->
  
  
  
  
  
  
@stop
