@extends('layouts.user')

@section('content')

<div class="row mb-4">
<div class="col s12 m12 l12">
<div class="card subscriber-list-card animate fadeUp">
<div class="card-content pb-1">
<h4 class="card-title mb-0">Test Attempts<i class="material-icons float-right">more_vert</i></h4>
</div>
@if(Session::has('success'))
<div class="card-alert card gradient-45deg-green-teal">
<div class="card-content white-text">
<p>
<i class="material-icons">check</i> SUCCESS : {{ Session::get('success') }}</p>
</div>
</div>
@endif

@if(Session::has('error'))
<div class="card-alert card gradient-45deg-red-pink">
<div class="card-content white-text">
<p>
<i class="material-icons">check</i> OOPS : {{ Session::get('error') }}</p>
</div>
</div>
@endif


<table class="subscription-table responsive-table highlight">
<thead>
<tr>
<th>Test</th>
<th>Origin Language</th>
<th>Translate Langauge</th>
<th>Score</th>
<!-- <th>Rating</th> -->
<th>Test Type</th>
<th>Evaluate</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php
$finalGivenTestArr = array();
foreach ($userTests as $test){
  $finalGivenTestArr[$test->lang_pair][] = $test;
}
?>

<?php foreach ($finalGivenTestArr as $key_LP => $tests){ ?>
  <th align="center" colspan="7">{{ $key_LP }}</th>
  <?php foreach ($tests as $test){ ?>
    <tr id="myTableRow_{{ $test->id }}">
    <td>{{ $test->title }}</td>
    <td>{{ $test->source_language }}</td>
    <td>{{ $test->target_language }}</td>
    <td>
    @if($test->test_result != null)
    <span class="badge green lighten-5 blue-text text-accent-4">{{ json_decode( $test->test_result, true )['total_score'] ?? 0 }}/500</span>
    @else
    <span class="badge green lighten-5 blue-text text-accent-4">---</span>
    @endif
    </td>
    <!-- <td>
    @if($test->test_result != null)
    <span class="badge green lighten-5 blue-text text-accent-4">{{ json_decode( $test->test_result, true )['total_rating'] ?? 0 }}/5</span>
    @else
    <span class="badge green lighten-5 blue-text text-accent-4">---</span>
    @endif
    </td> -->
    
    <td>
    @if ($test->test_type === "text")
    <span class="badge blue lighten-5 blue-text text-accent-4"> Text </span>
    @else
    <span class="badge blue lighten-5 blue-text text-accent-4"> File </span>
    @endif
    </td>
    <?php
    //dd($test);
    $userTestID = $test->ucode."@@".$test->id."@@".$test->lang_pair."@@".$test->test_id;
    if($test->test_score){
      Session::put('StatusOf'.$test->source_language.'-'.$test->target_language, 1);
      ?>
      <td>
      <i class="material-icons pink-text">done</i></a>
      </td>
      <td> 
      <!--   <a href="{{ route('dashboard.translator.showUserTestSingle', [$test->source_language.'-'.$test->target_language, base64_encode($test->id), $test->ucode]) }}" title="View Test">View Test</a> -->
      <a href="{{ route('dashboard.admin.viewTest', [$userTestID]) }}" title="View Test">View</a> ||
      <a href="javascript:;" title="Reset Test" onclick="resetTheTest(`{{ $userTestID }}`)">Reset</a>
      </td>
      <?php
    }else{
      Session::put('StatusOf'.$test->source_language.'-'.$test->target_language, 1);
      ?>
      <td>
      <a href="{{ route('dashboard.admin.evaluateTest', [$userTestID]) }}" title="Evaluate"><i class="material-icons pink-text">rate_review</i></a>
      </td>
      <td> 
      <!--   <a href="{{ route('dashboard.translator.showUserTestSingle', [$test->source_language.'-'.$test->target_language, base64_encode($test->id), $test->ucode]) }}" title="View Test">View Test</a> -->
      ---
      </td>
      <?php
    }
    ?>
    
    
    </tr>
    
    
    <?php
  }
}
?>

</tbody>
</table>
</div>
<!-- <a  class="waves-effect waves-dark btn btn-lg btn-primary customHidden left mb-4" type="button" href="{{ route('dashboard.admin.updateContract', [Request::segment(4)]) }}">Edit Contract</a> -->
</div>



<div id="accountPasswordModal" class="modal" style="width:450px;">
<div class="modal-content" >
<h6 align="center">To Reset Test, Please Enter account Password</h6>
<p>
<input type="password" id="password" placeholder="Password..." />
<span id="passwordError" class="red-text"></span>
</p>
</div>
<div class="modal-footer">


<a id="cancelReset"  
href="javascript:;"
class="modal-action modal-close  waves-effect waves-red btn-flat left"
>Cancel</a>

<a id="checkPassword" 
href="javascript:;"
class="modal-action  waves-effect waves-green btn-flat right"
>Reset Test</a>
<input id="dataID" type="hidden" value="">
</div>
</div>


</div>
@endsection
@push('js')
<script type="text/javascript">
function resetTheTest(id){
  // var str = id;
  // var dynamicData = str.split("@@");
  // var dynamicLink = dynamicData[0];
  // localStorage.setItem('t_id', dynamicLink.substring(dynamicLink.length - 4, dynamicLink.length));
  // document.getElementById("dynamicLink").href=dynamicLink; 
  $('#dataID').val(id);
  $("#accountPasswordModal").modal('open', {
    dismissible: false,
  });  
}
$(() => {
  
  var token = document.head.querySelector('meta[name="csrf-token"]');
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
  

  $('#cancelReset').on('click', () => {
    $('#password').val('');
  });
  
  $('#checkPassword').on('click', () => {
    let customParams = $('#dataID').val();
    if($('#password').val() == ''){
      $('#password').focus();
      $('#passwordError').text('Please Provide your password!!!');
    }else{
      var password = $('#password').val();
    }
    axios.get(`/check-password/${password}`)
    .then((res) => {
      //alert(res.data.status);
      if(res.data.status == true){
        window.location.href = `/dashboard/admin/resetTest/${customParams}`;
      }
    });
    
  });
  
  $('.deleteT').on('click', function(){
    
    if (confirm('Are you sure ?')) {
      var id = $(this).data('ucode');
      axios.post(bURL+'dashboard/admin/deleteTest', {
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