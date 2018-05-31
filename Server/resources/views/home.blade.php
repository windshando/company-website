@extends('layouts.app')

@section('content')
<div class="content-container">
    <div class="card" style="padding: 0; margin: 4px; width: 400px;">
      <!--Card image-->
      <a href="{{ url('./content/') }}"> 
        <img class="img-fluid" src="{{ url('./image/content.jpg') }}" alt="Setup site content">
      </a>
      <!--Card content-->
      <div class="card-body">
          <!--Title-->
          <h4 class="card-title">Setup site content</h4>
          <!--Text-->
          <p class="card-text">Here you can setup content to show on your site. Press the button below to do this.</p>
          <a href="{{ url('./content/') }}" class="btn btn-primary" 
            style="background-color: #404040; border-color: #191919; width: 100%;">
            Setup
          </a>
      </div>
    </div>
</div> 
@endsection