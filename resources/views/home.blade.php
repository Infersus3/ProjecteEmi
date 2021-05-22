@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
  <div class="wrapper-carousel">
      <h1>HPLC</h1>
      Previous
      Next



      HTML
      <!--Carousel Wrapper-->
      <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <div class="view">
              <img class="d-block w-100" src="{{ asset('img/detector_UV_HPLC.jpg') }}" alt="">
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive">Light mask</h3>
              <p>First text</p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="view">
              <img class="d-block w-100" src="{{ asset('img/columnas.jpg') }}" alt="">
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive">Light mask</h3>
              <p>First text</p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="view">
              <img class="d-block w-100" src="{{ asset('img/bomba_hplc.jpg') }}" alt="">
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive">Light mask</h3>
              <p>First text</p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="view">
              <img class="d-block w-100" src="{{ asset('img/cromatografo.jpg') }}" alt="">
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive">Light mask</h3>
              <p>First text</p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="view">
              <img class="d-block w-100" src="{{ asset('img/imagen_3.jpeg') }}" alt="">
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive">Light mask</h3>
              <p>First text</p>
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
@endsection

@section('style')
<style>
 
  body{
    background-color: white;
  }
  </style>
@endsection