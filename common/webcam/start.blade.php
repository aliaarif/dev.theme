
@extends('layouts.guest')
@section('content')
<div id="my_camera"></div>
<input type=button value="Take Snapshot" onClick="take_snapshot()">
<a href="javascript:void(take_snapshot())">Take Snapshot</a>
 
<div id="results" ></div>
 
@endsection

@push('css')
 <!-- CSS -->
 <style>
#my_camera{
 width: 320px;
 height: 240px;
 border: 1px solid black;
}
</style>
@endpush

@push('js')
<!-- Webcam.min.js -->
<script type="text/javascript" src="{{ asset('js/webcam.min.js') }}"></script>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
 Webcam.set({
  width: 320,
  height: 240,
  image_format: 'jpeg',
  jpeg_quality: 90,
  force_flash: true
 });
 Webcam.attach( '#my_camera' );

<!-- Code to handle taking the snapshot and displaying it locally -->
function take_snapshot() {
 
 // take snapshot and get image data
 Webcam.snap( function(data_uri) {
  // display results in page
  document.getElementById('results').innerHTML = 
  '<img src="'+data_uri+'"/>';
  } );
}
</script>
@endpush


