@extends('layouts.user')
@section('content')
@php 
$ucode = Request::segment(5) ?? Auth::user()->ucode;
$user_id = Request::segment(6) ?? Auth::id();
@endphp
<div class="container mb-5  animate fadeUp" id="popout">
<div class="row ">
<div class="col s12">
<p align="justify">Manage your personal information</p>
<span id="messagePersonalInformation"></span>
</div>
<div class="col s12 m12 l12">
{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'personalInformation', 'name' => 'personalInformation')) }}
@csrf
<input type="hidden" name="form_type" value="personal_information">
<input type="hidden" name="ucode" value="{{ $ucode }}">
<input type="hidden" name="user_id" value="{{ $user_id }}">
<input type="hidden" id="nextBtnClickFlag" name="nextBtnClickFlag" value="0">
<br/>
<div class="step-content">
<div class="row">
<div class="input-field col m2 s12">
<label for="first_name">First Name<span class="red-text">*</span></label>
<input type="text" id="first_name" placeholder="&nbsp;" name="first_name" value="{{ $profile->first_name }}" >
<span class="error" id="first_name_error"></span>
</div>
<div class="input-field col m2 s12">
<label for="middle_name">Middle Name</label>
<input type="text" id="middle_name"  placeholder="&nbsp;" name="middle_name" value="{{ $profile->middle_name }}" >
<span class="error" id="middle_name_error"></span>
</div>
<div class="input-field col m2 s12">
<label for="last_name">Last Name<span class="red-text">*</span></label>
<input type="text" id="last_name"  placeholder="&nbsp;" name="last_name" value="{{ $profile->last_name }}" >
<span class="error" id="last_name_error"></span>
</div>
<div class="input-field col m3 s12">
<select name="gender" id="gender" >
@if(!$profile->gender)
<option value="" disabled selected>---Select---</option>
@endif
<option value="Male" {{ $profile->gender == 'Male' ?? 'selected' }}>Male</option>
<option value="Female" {{ $profile->gender == 'Female' ?? 'selected' }}>Female</option>
<option value="Prefer not to say" {{ $profile->gender == 'Prefer not to say' ?? 'selected' }}>Prefer not to say</option>
<option value="Other" {{ $profile->gender == 'Other' ?? 'selected' }}>Other</option>
</select>
<label>Gender</label>
<span class="error" id="gender_error"></span>
</div>
<div class="input-field col m3 s12">
<label for="email">Email<span class="red-text">*</span></label>
<input type="email"  placeholder="&nbsp;"  name="email" id="email" value="{{ Request::segment(5) ? $profile->user->email : Auth::user()->email }}"  disabled>
<span class="error" id="email_error"></span>
</div>
</div>
<div class="row">
<div class="input-field col m2 s12">
<label for="nationality">Nationality<span class="red-text">*</span></label>
<input type="text"  placeholder="&nbsp;" id="nationality" name="nationality" value="{{ $profile->nationality }}" >
<span class="error" id="nationality_error"></span>
</div>
<div class="input-field col m2 s12">
<select name="country" id="country" >
<option value="" disabled selected>---Select---</option>
@foreach($countries as $country)
<option value="{{ $country->name ?? '' }}" @if($profile->country == $country->name) selected @endif >{{ $country->name  ?? '' }}</option> == 
@endforeach
</select>
<label  for="country">Country of Residence</label>
<span class="error" id="country_error"></span>
</div>
<div class="input-field col m2 s12">
<select name="country_phonecode_mobile" id="country_phonecode_mobile" >
<option value="" disabled selected>---Select---</option>
@foreach($countriesPhoneCodes as $country)
<option value="{{ $country->phonecode }}" @if($profile->country_phonecode_mobile == $country->phonecode)  selected  @endif >+{{ $country->phonecode }}</option>
@endforeach
</select>
<label  for="country_phonecode_mobile">Phonecode</label>
<span class="error" id="country_phonecode_mobile_error"></span>
</div>
<div class="input-field col m2 s12">
<label for="mobile">Mobile<span class="red-text">*</span></label>
<input type="text"  placeholder="&nbsp;" id="mobile" value="{{ $profile->mobile ?? '' }}" name="mobile" >
<span class="error" id="mobile_error"></span>
</div>
<div class="input-field col m2 s12">
<select name="country_phonecode_whatsapp" id="country_phonecode_whatsapp" >
<option value="" disabled selected>---Select---</option>
@foreach($countriesPhoneCodes as $country)
<option value="{{ $country->phonecode }}" 
@if($profile->country_phonecode_whatsapp == $country->phonecode) selected @endif>
+{{ $country->phonecode }}
</option>
@endforeach
</select>
<label>Whatsapp Phonecode</label>
<span class="error" id="country_phonecode_whatsapp_error"></span>
</div>
<div class="input-field col m2 s12">
<label for="whatsapp_mobile">WhatsApp Mobile</label>
<input type="text"  placeholder="&nbsp;"  name="whatsapp_mobile" id="whatsapp_mobile" value="{{ $profile->whatsapp_mobile ?? '' }}" >
<span class="error" id="whatsapp_mobile_error"></span>
</div>
</div>
<div class="step-actions">
<div class="row" >
<div class="col s12  mb-12  mt-1" >
<button id="nextBtn1" class="waves-effect waves-dark btn btn-lg btn-primary" type="submit"
id="savePersonalInformationBtn" >Save</button>
<button id="nextBtn2"  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" type="submit">Next</button>
</div>
<!-- <div class="col s8  mb-10" id="messagePersonalInformation"></div> -->  
</div>
</div>
</div>
</form>
</div>
</div>
</div>



  <!-- Modal content -->
  <div  id="myModal" class="modal modal-content">
    <span class="close">&times;</span>
    <h1 align="center">Welcome to ArabEasy</h1>
    <h3>Please complete the steps below</h3>
    <div class="modal-text-container mt-4  mb-10">
    <div class="modal-text card gradient-shadow white border-radius-3 animate fadeUp">
        <h5>Step 1</h5>
       <p>Go to My profile and fill <br> up Personal Information<br> and skills</p>
    </div>
   
   
    <div class="modal-text card gradient-shadow white border-radius-3 animate fadeUp">
        <h5>Step 2</h5>
        <p>Go to Evaluation Section <br>and Take the tests for<br> Desired language pairs</p>
     </div>
   
     <div class="modal-text card gradient-shadow white border-radius-3 animate fadeUp">
        <h5>Step3</h5>
        <p>Pass the evaluation and <br>complete your profile</p>
     </div>

   </div>
  </div>


@endsection
@push('css')
<style>

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
 /* background-color: rgb(0,0,0); /* Fallback color */
 /* background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
 background: #fff;
 max-height: 82.7%;
}

/* Modal Content */
.modal-content {
  
  background-color: rgba(0,0,0,0.7);
    margin-left: 200px !important;
    padding: 20px;
    border: 1px solid #888;
    width: 85.5%;
    overflow-y: hidden;
    height: 100%;
    text-align: center;
    color: #fff;
    margin-top:64px;
}


/* The Close Button */
.close {
  position:relative;
  top:-35px;
  right:-15px;
  color: #fff;
  float: right;
  font-size: 40px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
  }

  .modal-text {
    background:#fff;
    min-height: 200px;
    float: left;
    padding: 20px;
    margin: 15px;
    text-align: center;
    color: #000;
    border-radius:10px;
    -moz-border-radius:10px;
}
.modal-text p{
  font-size: 18px;
}
  .modal-text-container {
    display: flex;
    justify-content: space-around;
}
h1, h3{
  color:white;
}
</style>
@endpush
@push('js')
<script type="text/javascript">
$(() => {
  
  $('#nextBtn1').on('click', () => {
    var nextBtnClickFlag = $('#nextBtnClickFlag').val(0);
  });
  
  $('#nextBtn2').on('click', () => {
    var nextBtnClickFlag = $('#nextBtnClickFlag').val(1);
  });
  
  //$('#userFinalStatus').html(`Status : {{ Auth::user()->profile->finalStatus }}`);
  
  
  var token = document.head.querySelector('meta[name="csrf-token"]');
  const config = {
    headers: { 
      'X-CSRF-TOKEN': token.content,
      'content-type': 'multipart/form-data'
    }
  }
  document.getElementById('personalInformation').addEventListener('submit', function(e){
    e.preventDefault();
    //var nextBtnClickFlag = document.getElementById('nextBtnClickFlag').value;
    
    /* Form Validation Start Here... */
    var names = ['first_name', 'last_name', 'gender', 'nationality', 'country', 'country_phonecode_mobile', 'mobile'];
    var errorCount = 0;
    names.forEach((el) => {
      var val = document.forms["personalInformation"][el].value;
      if (val == null || val == "" || val == 0) {
        document.getElementById(el + '_error').style = 'color:red';
        document.getElementById(el + '_error').focus();
        document.getElementById(el + '_error').textContent = 'Required!!!';
        ++errorCount;
      }else{
        document.getElementById(el + '_error').textContent = '';
      }
      
      
    });
    if (errorCount) return false;
    /* Form Validation End Here... */
    const form = document.querySelector('#personalInformation');
    var formData = new FormData(form);
    axios.post(bURL+'dashboard/translator/update-profile', formData, config)
    .then(function (res) {
      console.log(res.data.status);
      if(res.data.message === true){
        var msg = `<div class="card-alert card  lighten-5">
        <div class="card-content green-text">
        <p>Success! Profile data saved successfuly</p>
        </div>
        </div>`; 
        
        //if(res.data.status == true){
          //let status = `{{ Session::put('finalStatus', 'Test Pending') }}`
          //localStorage.setItem('finalStatus', 'Test Pending');
          //$('#userFinalStatus').html('Status : Test Pending');
          //}
          
          if($('#nextBtnClickFlag').val() == 1){
            window.location.href = `/dashboard/translator/my-profile/skills`
          }
          
          
        }else{
          var msg = `<div class="card-alert card  lighten-5">
          <div class="card-content red-text">
          <p>Error! Have problem regarding save profile data</p>
          </div>
          </div>`;
          //console.log(res.data.status);
          
          //localStorage.setItem('status', 'Test Pending');
          //$('#userFinalStatus').html('Status : '+localStorage.getItem('status'));
          
          
          
        }
        $('#messagePersonalInformation').html(msg);
        
        $('#messagePersonalInformation').empty().show().html(msg).delay(3000).fadeOut(300);
      })
      .catch(function (err) {
        console.log(err);            
      });          
    });
  });

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
onload = function() {
  var firstTimePopUpFlag = `{{  Auth::user()->profile->firstTimePopUpFlag }}`;
  if(firstTimePopUpFlag == 1){
    modal.style.display = "block";
  }
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  axios.get(bURL+'dashboard/translator/closePopup')
    .then(function (res) {
      console.log(res.data);
        modal.style.display = "none";
    });
}

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }
  </script>
  @endpush      