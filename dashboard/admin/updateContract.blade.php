<?php
// echo '<pre>';
// print_r($languagePairRowExist);
$arrCount = count($languagePairRowExist);
//print_r($translatorDetails);
// die;
?>

<style type="text/css">

.modal {
  min-height: 80% !important;
}

.link_button {
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  border: solid 1px #20538D;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
  background: #4479BA;
  color: #FFF;
  padding: 8px 12px;
  text-decoration: none;
  float: right;
  margin-right: 30px;
  
}
</style>


@extends('layouts.user')

@section('content')

@php
$translatorUcode = Request::segment(4) ?? NULL;
@endphp

<?php
if($arrCount>0){
  ?>
  <div class="row margin mb-4">
  <div class="input-field col s4">
  @foreach ($translatorDetails as $translatorDetail)
  <blockquote class="pl-2 pr-2" id="test_source_language">
  Name: <strong class="custom-strong">{{ $translatorDetail->first_name}} {{ $translatorDetail->last_name}}</strong>  
  </blockquote>
  </div>
  <div class="input-field col s6">
  <a onclick="window.location.href=this" title="Refresh" style="float:right; cursor: pointer;"><i class="material-icons">refresh</i></a>
  </div>
  @endforeach
  </div>
  <div class="row margin">
  <div class="input-field col s12">
  <table class="subscription-table responsive-table highlight">
  <thead>
  <tr>
  <th>Language Direction</th>
  <th>Current Rating</th>
  <th>Status</th>
  <th>Contract Details</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($languagePairRowExist as $languagePairEach)
  <tr id="myTableRow_{{ $languagePairEach->id }}">
  <td>{{ $languagePairEach->name }}</td>
  <td>{{ $languagePairEach->final_rating }} / 5</td>
  <td>{{ $translatorDetails[0]->finalStatus }}</td>
  <?php
  $codeToupdateLP_details = $translatorUcode."XXX".$languagePairEach->id."XXX".$languagePairEach->name;
  ?>
  <td>
  @if($languagePairEach->final_score > 400)
  <a href="javascript:;" class="openModalWithLpDetails" data-ucode='{{$codeToupdateLP_details}}' title="Add/Update Details">Update Details</a>
  @else
  N/A
  @endif
  </td>
  
  
  <td>
  <?php
  $finalIDvalue_activate = $translatorUcode."-XX-".$languagePairEach->id."-XX-1";
  $finalIDvalue_deactivate = $translatorUcode."-XX-".$languagePairEach->id."-XX-0";
  ?>
  <?php
  if($languagePairEach->status == 1){
    ?>
    @if($languagePairEach->final_score > 400)
    <a href="javascript:;" class="LpAction" data-ucode='{{ $finalIDvalue_deactivate }}' title="Deactivate">Deactivate</a>
    @else
    N/A
    @endif
    <?php
  }else{
    ?>
    
    <a href="javascript:;" class="LpAction" data-ucode='{{ $finalIDvalue_activate }}' title="Activate">Activate</a>
    <?php
  }
  ?>
  </td>
  </tr>
  @endforeach
  </tbody>
  </table>
  </div>
  </div>
  
  <a id="SendStatusReport"  class="waves-effect waves-dark btn btn-lg btn-primary customHidden left mb-4" type="button" data-ucode='{{ $translatorUcode }}' title="Save" href="{{ route('dashboard.admin.updateContract', [Request::segment(4)]) }}">Save & Inform Translator</a>
  <?php
}else{
  ?>
  <div class="row margin">
  <div class="input-field col s4">
  @foreach ($translatorDetails as $translatorDetail)
  <blockquote class="pl-2 pr-2" id="">
  Name: <strong class="custom-strong">{{ $translatorDetail->first_name}} {{ $translatorDetail->last_name}}</strong>  
  </blockquote>
  </div>
  @endforeach
  </div>
  <div class="row margin">
  <div class="input-field col s4">
  <h6>Profile Details Incomplete</h6>
  </div>
  </div>
  <?php
}
?>

<!-- Modal Trigger -->

<!-- Modal Structure -->
<div id="modal1" class="modal">
<div class="modal-content">
<h6>Update Contract Details</h6>
{{ Form::open(array('url' => route('dashboard.admin.saveModalDetails'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'ModalWithLpDetails', 'name' => 'ModalWithLpDetails')) }}
@csrf

<div class="row margin">
<div class="input-field col s6" id="dynamicData" style="display: none;">
<div>
<label for="contract_flag">Contract Flag</label>
<select name="contract_flag" id="contract_flag">
<option value="">Choose</option>
<option value="pipeline">Pipeline</option>
<option value="pilot">Pilot</option>
<option value="seasoned">Seasoned</option>
</select>

</div> 
</div>


<div class="input-field col s6" id="viewOnlydata">
<div>
<label for="selected_cflag">Contract Flag</label>
<input id="selected_cflag" type="text" value="" class="form-control" name="selected_cflag" disabled><a href="#" id="change">Change</a>

</div>
</div>



<div class="input-field col s6" id="dynamicData_type" style="display: none;">
<div>
<label for="contract_type">Contract Type</label>
<select name="contract_type" id="contract_type">
<option value="">Choose</option>
<option value="freelancer">Freelancer</option>
<option value="inhouse">In-house</option>
</select>
</div> 
</div>


<div class="input-field col s6" id="viewOnlydata_type">
<div>
<label for="selected_ctype">Contract Type</label>
<input id="selected_ctype" type="text" value="" class="form-control" name="selected_ctype" disabled><a href="#" id="change_type">Change</a>
</div>
</div>

</div>
<div class="row margin">
<div class="input-field col s4">
<label for="edit_rating">Edit Rating</label>
<input id="edit_rating" type="text" placeholder="" value="" class="form-control" name="edit_rating" required>
</div>

<div class="input-field col s4">
<input id="fixed_rate" type="text" placeholder="" value="" class="form-control" name="fixed_rate" required>
@error('fixed_rate')
@enderror
<label for="fixed_rate">Fixed (if any)</label>
</div>

<div class="input-field col s4">
<input id="quota_rate" type="text" placeholder=""  value="" class="form-control" name="quota_rate" required>
@error('quota_rate')
@enderror
<label for="quota_rate">Quota (if any)</label>
</div>
</div>

<div class="row margin">

<div class="input-field col s4">
<label class="checkbox-label">
<input type="checkbox" name="proofreader" id="proofreader">
<span>Proofreader</span>
</label>
</div>

<div class="input-field col s4">
<input id="translation_wc" type="text" placeholder=""  value="" class="form-control @error('translation_wc') is-invalid @enderror" name="translation_wc" required>
@error('translation_wc')
@enderror
<label for="translation_wc">Translation/wd</label>
</div>

<div class="input-field col s4">
<input id="proofreading_wc" type="text" placeholder=""  value="" class="form-control @error('proofreading_wc') is-invalid @enderror" name="proofreading_wc" required>
@error('proofreading_wc')
@enderror
<label for="proofreading_wc">Proofreading/wd</label>
</div>
</div>

<div class="row">
<div class="input-field col s6">
<button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Evaluate</button>
</div>
<div class="col s3">
<div style="display:none; float: right; margin-top: 19px; color: green;" id="message">Done</div>
<div style="display:none; float: right; margin-top: 19px; color: red;" id="message_err">Error, Try Again!!</div>
</div>
</div>

<input type="hidden" name="dyn_ucode" id="dyn_ucode" value="">
<input type="hidden" name="dyn_lpid" id="dyn_lpid" value=""> 
<input type="hidden" name="dyn_lpname" id="dyn_lpname" value="">


</form>

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
  
  $('.LpAction').on('click', function(){
    if (confirm('Are you sure ?')) {
      var id = $(this).data('ucode');
      axios.post('http://dev.project/dashboard/admin/updateContractLP', {
        'id': id
      })
      .then(function (response) {
        if(response.data==="FAIL@"){
          
        }else{
          location.reload(true);
        }
        //console.log(response.data);
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  });
  
  $('.openModalWithLpDetails').on('click', function(){
    var id = $(this).data('ucode');
    axios.post(bURL+'dashboard/admin/ModalWithLpDetails', {
      'id': id
    })
    .then(function (response) {
      if(response.data==="FAIL@"){
        console.log(response.data);
      }else{
        console.log(response.data);
        var str = response.data;
        var array = str.split("X-X");
        
        $("#edit_rating").val(array[0]);
        
        
        
        if(array[1]){
          $("#selected_cflag").val(array[1]);
        }else{
          $('#dynamicData').show();
          $('#viewOnlydata').hide();
          
        }
        
        if(array[2]){
          $("#selected_ctype").val(array[2]);
        }else{
          $('#dynamicData_type').show();
          $('#viewOnlydata_type').hide();
        }
        
        
        if(array[3]==1){
          $("#proofreader").prop("checked", true);
        }else{
          $("#proofreader").prop("checked", false);
        }
        
        $("#fixed_rate").val(array[4]);
        $("#quota_rate").val(array[5]);
        $("#translation_wc").val(array[6]);
        $("#proofreading_wc").val(array[7]);
        
        $("#dyn_ucode").val(array[8]);
        $("#dyn_lpid").val(array[9]);
        $("#dyn_lpname").val(array[10]);
        
        $(".modal").modal('open', {
          dismissible: false,
        })
      }
    })
    .catch(function (error) {
      console.log(error);
    });
  });
  
  $('#SendStatusReport').on('click', function(){
    if (confirm('Are you sure ?')) {
      var id = $(this).data('ucode');
      axios.post(bURL+'dashboard/admin/sendStatusReport', {
        'id': id
      })
      .then(function (response) {
        if(response.data==="FAIL@"){
          console.log(response.data);
        }else{
          console.log(response.data);
        }
        //console.log(response.data);
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  });
  
  
  $("#change").click(function(){
    $('#dynamicData').show();
    $('#viewOnlydata').hide();
  });
  
  $("#change_type").click(function(){
    $('#dynamicData_type').show();
    $('#viewOnlydata_type').hide();
  });
  
  
  
  
  const basicForm = document.getElementById('#ModalWithLpDetails');
  document.getElementById('ModalWithLpDetails').addEventListener('submit', function(e){
    e.preventDefault();
    const form = document.querySelector('#ModalWithLpDetails');
    var formData = new FormData(form);
    axios.post(bURL+'dashboard/admin/saveModalDetails', formData)
    .then(function (res) {
      console.log(res.data);
      if(res.data==="OKK"){
        $('#message').show();
        $('#message_err').hide();
      }else{
        $('#message_err').show();
        $('#message').hide();
      }
    })
    .catch(function (err) {
      console.log(res.data);          
    });          
  });
  
});

</script>
@endpush