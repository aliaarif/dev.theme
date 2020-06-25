@extends('layouts.error')
@section('content')
<div class="row">
      <div class="col s12">
        <div class="container">
          <div class="section p-0 m-0 height-100vh section-500">
            <div class="row">
              <!-- 404 -->
              <div class="col s12 center-align white">
                <img src="{{ asset('images/gallery/error-2.png') }}" alt="" class="bg-image-500">
                <h1 class="error-code m-0">401</h1>
                <h6 class="mb-2">UNAUTHORIZED REQUEST</h6>
                <a class="btn waves-effect waves-light gradient-45deg-deep-purple-blue gradient-shadow mb-4" href="{{ route('dashboard') }}">Back TO Dashboard</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
