@extends('layouts.user')
@section('content')

<div class="row">
{{ Form::open(array('url' => route('dashboard.admin.importExcel'), 'method'=>'post', 'id' => 'importExcel', 'enctype'=>'multipart/form-data',  'name' => 'importExcel')) }}
@csrf

@if(session('errors'))
    @foreach($errors as $error)
        <li class="ml-1 red-text" style="list-style:none"> {{ $error }} </li>
    @endforeach
@endif

@if(session('success'))
    {{ session('success') }}
@endif

<br>
<br>

<div class="file-field input-field col s12">
	<div class="btn mb-1">
		<span>SELECT EXCEL FILE TO IMPORT </span>
		<input type="file"  name="file" >
	</div>
	<div class="file-path-wrapper">
		<input class="file-path validate" type="text">
	</div>
</div>
<div class="col m3 s12  mb-3  mt-1">
<button id="saveQueryBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
type="submit">Start Import Process</button>
</div>
<div class="col m9 s12  mb-2  mt-1" id="messageGetHelp">
</div>
</form>
</div>
@endsection
@push('css')
<style>
.red{
  color:red;
}
.custom-width{
  width:15%;
}
</style>
@endpush

@push('js')
<script type="text/javascript">
$(() => {
  var token = document.head.querySelector('meta[name="csrf-token"]');
  const config = {
    headers: { 
      'X-CSRF-TOKEN': token.content,
      'content-type': 'multipart/form-data'
    }
  }
  
  
  document.getElementById('get-help').addEventListener('submit', function(e){
    e.preventDefault();
    /* Form Validation Start Here... */
    var names = ['query'];
    var errorCount = 0;
    names.forEach((el) => {
      var val = document.forms["get-help"][el].value;
      if (val == null || val == "" || val == 0) {
        document.getElementById(el + '_error').style = 'color:red';
        document.getElementById(el + '_error').focus();
        document.getElementById(el + '_error').textContent = 'Please Enter your query!!!';
        ++errorCount;
      }else{
        document.getElementById(el + '_error').textContent = '';
      }
    });
    if (errorCount) return false;
    
    
    /* Form Validation End Here... */
    const form = document.querySelector('#get-help');
    var formData = new FormData(form);
    axios.post(bURL+'dashboard/translator/get-help', formData, config)
    .then(function (res) {
      console.log(res.data.message);
      if(res.data.message === true){
        var msg = `<div class="card-alert card  lighten-5">
        <div class="card-content green-text">
        <p>Success! Your query sent!</p>
        </div>
        </div>`;      
        
      }else{
        var msg = `<div class="card-alert card  lighten-5">
        <div class="card-content red-text">
        <p>Error! Have problem regarding sending your query</p>
        </div>
        </div>`;
        
      }
      
      $('#messageGetHelp').html(msg);
      $('#messageGetHelp').empty().show().html(msg).delay(3000).fadeOut(300);
    })
    .catch(function (err) {
      console.log(err);            
    });          
  });
});
</script>
@endpush
