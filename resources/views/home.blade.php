@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
  <div class="wrapper-carousel">
      <h1>Projecte HPLC</h1>
      <!--Carousel Wrapper-->
      <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <div class="view">
              <img class="d-block w-100" src="{{ asset('img/detector_UV_HPLC.jpg') }}" alt="">
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive">Detector UV HPLC</h3>     
            </div>
          </div>
          <div class="carousel-item">
            <div class="view">
              <img class="d-block w-100" src="{{ asset('img/columnas.jpg') }}" alt="">
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive">Columnes</h3>
            </div>
          </div>
          <div class="carousel-item">
            <div class="view">
              <img class="d-block w-100" src="{{ asset('img/imagen_3.jpeg') }}" alt="">
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive">Injector</h3>            
            </div>
          </div>
          <div class="carousel-item">
            <div class="view">
              <img class="d-block w-100" src="{{ asset('img/cromatografo.jpg') }}" alt="">
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive">Cromatògraf</h3>          
            </div>
          </div>
          <div class="carousel-item">
            <div class="view">
              <img class="d-block w-100" src="{{ asset('img/bomba_hplc.jpg') }}" alt="">
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive">Bomba HPLC</h3>           
            </div>
          </div>
        </div>
        <!--/.Slides-->
        <!--Controls-->
        <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <!--/.Carousel Wrapper-->

      </div>
</div>
</div>
<footer>
<div class="container footer-container">
  <div class="row justify-content-center wrapper-footer">
  <img class="vallbona" src="{{ asset('img/logo_vallbona.png') }}">
    <span class="developers">
    <h6> Desenvolupadors Web 2DAW (IES Carles Vallbona)</h6>
    <ul>
        <li> Saleamlak Secoruún </li>
        <li> David Morcillo </li>
        <li style="visibility: hidden;"> David Morcillo </li>
    </ul>
</span>
    <span class="quimics">
    <h6> Col·laboradors (Alumnes de Quimica del IES EMT)</h6>
    <ul>
        <li> Jonathan Aranda </li>
        <li> Alex Santiago </li>
        <li> Dalvin Melissa </li>
    </ul>
</span>
<img class="emt" src="{{ asset('img/logo_emi_footer.png') }}"> 
  </div>
  </div>
</footer>
@endsection

@section('style')
<style>
  body{
    background-color: white;
  }

  .py-4{
    padding-bottom: 0px!important;
  } 
  .wrapper-footer {
    text-align: center;
    position: relative;
  }

  footer {
    background-color: #343a40;
}

.footer-container {
    padding: 50px;
    margin-top: 150px;
}
  
  h6{
    color: white;
  }

  footer li {
    font-size: 13px;
    color: white;
    text-align: left;
  }

  .developers {
    display: inline-block;
    padding: 15px;
  }

  .quimics {
    display: inline-block;
    padding: 15px;
  }

  .vallbona {
    position: absolute;
    top: 20px;
    left: 0;
    width: 200px;
  }

  .emt {
    position: absolute;
    top: 20px;
    right: 0;
    width: 250px;
  }
  </style>
@endsection