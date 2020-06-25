@extends('layouts.user')
@section('content')

<div class="row">
{{ Form::open(array('url' => route('dashboard.translator.getHelpProcess'), 'method'=>'post', 'id' => 'get-help', 'name' => 'get-help')) }}
@csrf
<div class="input-field col s12">
<textarea id="query" name="query" class="materialize-textarea"  style="height: 250px;" placeholder="Enter Your Query Here..."></textarea>
<label for="client_instructions">Please provide your query here...</label>
<span class="error"><p id="query_error"></p></span>
</div>
<div class="col m3 s12  mb-3  mt-1">
<button id="saveQueryBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
type="submit">Submit</button>
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
