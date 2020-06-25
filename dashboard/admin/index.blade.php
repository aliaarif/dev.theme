@extends('layouts.user')

@section('content')

<div class="row">
<div class="col s12 m6 l3">
<div class="card padding-4 animate fadeUp">
<div class="col s5 m5">
<h5 class="mb-0">{{ count($users) }}</h5>
</div>
<div class="col s7 m7 right-align">
<i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">assignment</i>
</div>
<p class="mb-0">Total users</p>
</div>
</div>
<div class="col s12 m6 l3">
<div class="card padding-4 animate fadeUp">
<div class="col s5 m5">
<h5 class="mb-0">{{ count($users) }}</h5>
</div>
<div class="col s7 m7 right-align">
<i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">assignment</i>
</div>
<p class="mb-0">Total Translators</p>
</div>
</div>
<div class="col s12 m6 l3">
<div class="card padding-4 animate fadeUp">
<div class="col s5 m5">
<h5 class="mb-0">{{ count($users) }}</h5>
</div>
<div class="col s7 m7 right-align">
<i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">assignment</i>
</div>
<p class="mb-0">Total Assignments</p>
</div>
</div>
<div class="col s12 m6 l3">
<div class="card padding-4 animate fadeUp">
<div class="col s5 m5">
<h5 class="mb-0">{{ count($users) }}</h5>
</div>
<div class="col s7 m7 right-align">
<i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">assignment</i>
</div>
<p class="mb-0">Total users</p>
</div>
</div>
</div>

</div>
@endsection
@push('js')
<script type="text/javascript">

$(() => {
  
  var token = document.head.querySelector('meta[name="csrf-token"]');
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
  
  //console.log(token.content);
  
  $('.aaa').on('click', function(){
    
    if (confirm('Are you sure ?')) {
      var id = $(this).data('ucode');
      axios.post(bURL+'dashboard/admin/deleteUser', {
        'id': id
      })
      .then(function (response) {
        if(response.data==="FAIL@"){
          alert('fail');
        }else{
          $('#myTableRow_'+response.data).remove();
          $('html, body').stop();
        }
        //console.log(response.data);
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  });
  
});
</script>
@endpush