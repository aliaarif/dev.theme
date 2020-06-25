@extends('layouts.user')
@section('content')
@php
$arrCount = count($languagePairRowExist);
$translatorUcode = Request::segment(5) ?? Auth::user()->ucode;
@endphp
<div class="row margin">
@if(Session::has('msg'))
<div class="card-alert card cyan lighten-5">
<div class="card-content cyan-text">
<p>Message : {{ Session::get('msg') }}</p>
</div>
<button type="button" class="close cyan-text" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
@endif
<div class="input-field col s12">
<table class="subscription-table responsive-table highlight">
<thead>
<tr>
<th>Language Direction</th>
<th>Current Score</th>
<th>Current Rating</th>
<th>Sign Contract</th>
</tr>
</thead>
<tbody>
@foreach ($languagePairRowExist as $languagePairEach)

@if($languagePairEach->contract_send == 1)
<tr id="myTableRow_{{ $languagePairEach->id }}">
<td>{{ $languagePairEach->name }}</td>
<td>{{ $languagePairEach->final_score }} / 500</td>
<td>{{ $languagePairEach->final_rating }} / 5</td>
<?php

$codeToupdateLP_details = $translatorUcode."XXX".$languagePairEach->id."XXX".$languagePairEach->name;
?>

@if($languagePairEach->contract_accept==1)
  <td>
  <i class="material-icons pink-text">done</i>
  <a
    class="openModalWithContactDetails1 waves-effect waves-light btn-small mb-1 float-right"
    data-ucode='{{ $codeToupdateLP_details }}'
    title="View Contract"
  >View Contract
  </a>
  
  </td>
  @else
  <td>
  <!-- @if($languagePairEach->final_rating >= 4.0) -->
  <a href="javascript:;" class="openModalWithContactDetails" data-ucode='{{ $codeToupdateLP_details }}' title="Sign Contract">Sign Contract Here</a>
  <!-- @else
  N/A
  @endif -->
  </td>
  @endif
  </tr>
  <!-- <a href="javascript:;" class="openModalWithContactDetails" data-ucode='{{ $codeToupdateLP_details }}' title="Sign Contract">Sign Contract Here</a> -->
  @endif
  @endforeach
  </tbody>
  </table>
  </div>
  </div>
  <div id="modal20" class="modal">
  <div class="modal-content">
  <div class="row">
  <div class="col s12 m12 l12">
  {{ Form::open(array('url' => route('dashboard.translator.acceptContract'), 'method'=>'post', 'id' => 'acceptContract', 'name' => 'acceptContract')) }}
  @csrf
  <input type="hidden" name="name" id="name" >
  <input type="hidden" name="ucode" id="ucode" >
  <input type="hidden" name="lp_id" id="lp_id" >
  <table class="highlight responsive-table">
  <tbody>
  <div id="lpWiseContract">

  <iframe id="ifrm1" src="" width="100%" height="100%" border="0" style="border:0; margin:0; padding:0"></iframe>

  <h6 align="center">Contract Details</h6>
  <p align="justify">Hi <span>{{ Auth::user()->profile->first_name }}</span>, We are happy to offer you the contract for below Language Direction, please read all mentioned details below.</p>
  </div>
  <tr>
  <td>Language Direction: </td>
  <td><span id="language_direction"></span></td>
  </tr>
  <tr>
  <td>Contract Flag: </td>
  <td><span id="contract_type"></span></td>
  </tr>
  <tr>
  <td>Final Rating: </td>
  <td><span id="final_rating"></span></td>
  </tr>
  <tr>
  <td>Translation price per word: </td>
  <td><strong>AED </strong><span id="translattion_price_per_word"></span></td>
  </tr>
  <tr>
  <td>Proofreading Eligibility: </td>
  <td><span id="proofreading_eligibility"></span></td>
  </tr>
  </tbody>
  </table>

  <div id="msg"></div>
  <button type="submit" id="agree" onclick="return confirm('Are you sure?')" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Accept Contract</button>
  </form>
  </div>
  </div>
  </div>
  </div>




  <div id="modal21" class="modal">
  <div class="modal-content">
  <div class="row">
  <div class="col s12 m12 l12">
  <table class="highlight responsive-table">
  <tbody>
  <div id="lpWiseContract2">

  
  <iframe id="ifrm2" src="" width="100%" height="100%" border="0" style="border:0; margin:0; padding:0"></iframe>

  <h6 align="center">Contract Details</h6>
  <p align="justify">Hi <span>{{ Auth::user()->profile->first_name }}</span>, We are happy to offer you the contract for below Language Direction, please read all mentioned details below.</p>
  </div>
  <tr>
  <td>Language Direction: </td>
  <td><span id="language_direction2"></span></td>
  </tr>
  <tr>
  <td>Contract Flag: </td>
  <td><span id="contract_type2"></span></td>
  </tr>
  <tr>
  <td>Final Rating: </td>
  <td><span id="final_rating2"></span></td>
  </tr>
  <tr>
  <td>Translation price per word: </td>
  <td><strong>AED </strong><span id="translattion_price_per_word2"></span></td>
  </tr>
  <tr>
  <td>Proofreading Eligibility: </td>
  <td><span id="proofreading_eligibility2"></span></td>
  </tr>

  </tbody>
  </table>
  </div>
  </div>
  </div>
  </div>


  </div>
  </div>
  @endsection

  @push('css')
  <style type="text/css">
.modal {
  height: 500px; //set a desired number
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



  @endpush

  @push('js')
  <script type="text/javascript">
  $(() => {
    var token = document.head.querySelector('meta[name="csrf-token"]');
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    $('.openModalWithContactDetails').on('click', function(){
      var id = $(this).data('ucode');
      axios.post(bURL+'dashboard/translator/ModalWithLpDetails', {
        'id': id
      })
      .then(function (response) {
        if(response.data==="FAIL@"){
          console.log(0);
        }else{
          
          $("#modal20").modal('open', {
            dismissible: false,
          });
          //console.log(1);
          //console.log(response.data);
          var str = response.data;
          var array = str.split("X-X"); 
          var el = document.getElementById('ifrm1');
          // if(array[11].substr(0, 8) != 'contract'){
          //   el.src = window.bURL+'storage/contracts/'+array[11];
          // }else{
          //   el.src = window.bURL+'storage/'+array[11];
          // }
          el.src = window.bURL+'storage/'+array[11];
          



          //alert(array[11].substr(0, 8));

          $("#final_rating").html(array[0]);
          $("#contract_flag").html(array[1]);
          $("#contract_type").html(array[2]);
          $("#fixed_quota").html(array[5]);
          if(array[3] == 1){
            $("#proofreading_eligibility").html('Yes');  
          }else{
            $("#proofreading_eligibility").html('No');
          }
          $("#translattion_price_per_word").html(array[4]);
          $("#translation_wd").html(array[6]);
          $("#proofreading_wd").html(array[7]);
          $("#language_pair_id").html(array[9]);
          $("#language_direction").html(array[10]);
          $("#name").val(array[10]);
          $("#ucode").val(array[8]);
          $("#lp_id").val(array[9]);
          
        }
      })
      .catch(function (error) {
        console.log(error);
      });
    });


    $('.openModalWithContactDetails1').on('click', function(){
      var id = $(this).data('ucode');
      axios.post(bURL+'dashboard/translator/ModalWithLpDetails', {
        'id': id
      })
      .then(function (response) {
        if(response.data==="FAIL@"){
          console.log(0);
        }else{
          
          $("#modal21").modal('open', {
            dismissible: false,
          });
          //console.log(1);
          //console.log(response.data);
          var str = response.data;
          var array = str.split("X-X"); 
          var el = document.getElementById('ifrm2');
          // if(array[11].substr(0, 8) != 'contract'){
          //   el.src = window.bURL+'storage/contracts/'+array[11];
          // }else{
          //   el.src = window.bURL+'storage/'+array[11];
          // }
          
          el.src = window.bURL+'storage/'+array[11];



          //alert(array[11].substr(0, 8));

          $("#final_rating2").html(array[0]);
          $("#contract_flag2").html(array[1]);
          $("#contract_type2").html(array[2]);
          $("#fixed_quota2").html(array[5]);
          if(array[3] == 1){
            $("#proofreading_eligibility2").html('Yes');  
          }else{
            $("#proofreading_eligibility2").html('No');
          }
          $("#translattion_price_per_word2").html(array[4]);
          $("#translation_wd2").html(array[6]);
          $("#proofreading_wd2").html(array[7]);
          $("#language_pair_id2").html(array[9]);
          $("#language_direction2").html(array[10]);
          $("#name2").val(array[10]);
          $("#ucode2").val(array[8]);
          $("#lp_id2").val(array[9]);
          
        }
      })
      .catch(function (error) {
        console.log(error);
      });
    });


    $('#agree').on('click', () => {
      $('#msg').html(`<div class="progress"><div class="indeterminate"></div></div>`);
    });
    
  });
  
  </script>
  @endpush
  
  