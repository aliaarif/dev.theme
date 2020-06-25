@extends('layouts.user')
@section('content')
@php
$role = Auth::user()->role;
$status = Auth::user()->profile->profile_dlp_status;
$status_name = Auth::user()->profile->profile_dlp_status_name;
@endphp
@if($role == 'Translator' && $status_name == 'Complete Profile')
@include('common.status.complete-profile')
@elseif($role == 'Translator' && $status_name == 'Submit Test')
@include('common.status.submit-test')
@elseif($role == 'Translator' && $status_name == 'Awaiting Result')
@include('common.status.awaiting-result')
@elseif($role == 'Translator' && $status_name == 'Sign Contract')
@include('common.status.sign-contract')
@else
@php 
$ucode = Request::segment(5) ?? Auth::user()->ucode;
$user_id = Request::segment(6) ?? Auth::id();
$profile = App\Profile::where('ucode', $ucode)->first();
$disabled = $profile->profile_dlp_status; 

$banking_information_flag = ' &nbsp; <span id="banking_information_flag" style="color:red"> ( Information
to be filled )</span>';
$alternate_payment_method_flag = ' &nbsp; <span id="alternate_payment_method_flag" style="color:red"> ( Information
to be filled )</span>';

if($profile->banking_information_flag == 1){
	$banking_information_flag = ' &nbsp; <span id="banking_information_flag" style="color:green"> ( Information filled )</span>';
}	
if($profile->alternate_payment_method_flag == 1){
	$alternate_payment_method_flag = ' &nbsp; <span id="alternate_payment_method_flag" style="color:green"> ( Information filled )</span>';
}
@endphp
<div id="popout" class=" mb-5">
<div class="col s12">
<p class="ml-2" >Manage your payment information</p>
</div>
<div class="col s12">
<ul class="collapsible popout">
<li id="li1">
<div class="collapsible-header" tabindex="0"><i class="material-icons">radio_button_checked</i>Banking information {!! $banking_information_flag !!}</div>
<div class="collapsible-body" id="li1child">
<span>
{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'pm-banking-information', 'name' => 'pm-banking-information')) }}
@csrf
<input type="hidden" name="form_type" value="pm-banking-information" >
<input type="hidden" name="ucode" value="{{ $ucode }}">
<input type="hidden" name="user_id" value="{{ $user_id }}">
<br/>
<div class="step-content">
<div class="row">

<div class="input-field col m4 s12">
<label for="bank_name">Bank Name<span class="red-text">*</span></label>
<input @if($disabled >= 6) disabled @endif type="text" id="bank_name" name="bank_name" value="{{ $profile->bank_name ?? '' }}">
<span class="error"><p id="bank_name_error"></p></span>
</div>



<div class="input-field col m4 s12">
<label for="beneficiary_name">Beneficiary Name<span class="red-text">*</span></label>
<input @if($disabled >= 6) disabled @endif type="text" id="beneficiary_name" name="beneficiary_name" value="{{ $profile->beneficiary_name ?? '' }}">
<span class="error"><p id="beneficiary_name_error"></p></span>
</div>

<div class="input-field col m4 s12">
<label for="beneficiary_account_number">Beneficiary Account Number / IBAN<span class="red-text">*</span></label>
<input type="text" id="beneficiary_account_number" name="beneficiary_account_number" value="{{ $profile->beneficiary_account_number ?? '' }}">
<span class="error"><p id="beneficiary_account_number_error"></p></span>
</div>
</div>

<div class="row">
<div class="input-field col m4 s12">
<label for="ifsc_code">SWIFT/IFSC Code<span class="red-text">*</span></label>
<input @if($disabled >= 6) disabled @endif type="text" id="ifsc_code" name="ifsc_code" value="{{ $profile->ifsc_code ?? '' }}">
<span class="error"><p id="ifsc_code_error"></p></span>
</div>

<div class="input-field col m8 s12">
<label for="bank_branch_address">Bank Branch Address<span class="red-text">*</span></label>
<input @if($disabled >= 6) disabled @endif type="text" id="bank_branch_address" name="bank_branch_address" value="{{ $profile->bank_branch_address ?? '' }}">
<span class="error"><p id="bank_branch_address_error"></p></span>
</div>

</div>

<div class="row">

<div class="input-field col m4 s12">
<select @if($disabled >= 6) disabled @endif id="proof_of_bank_type" name="proof_of_bank_type">
<option disabled>Please select an option</option>

<option value="Cancelled cheque" {{ $profile->proof_of_bank_type == 'Cancelled cheque' ?? 'selected' }}>Cancelled cheque</option>
<option value="Bank Letter" {{ $profile->proof_of_bank_type == 'Bank Letter' ?? 'selected' }}>Bank Letter</option>
<option value="Bank statement
(Latest)" {{ $profile->proof_of_bank_type == 'Bank statement
	(Latest)' ?? 'selected' }}>Bank statement
	(Latest)</option>
	</select>
	<label>Proof of Bank Type</label>
	<span class="error"><p id="proof_of_bank_type_error"></p></span>
	</div>
	
	<div class="file-field input-field col m7 s12">
	<div class="btn">
	<span>Upload</span>
	<input @if($disabled >= 6) disabled @endif type="file" id="proof_of_bank" name="proof_of_bank" accept="image/jpeg" value="{{ $profile->proof_of_bank ?? '' }}" class="validate">
	</div>
	
	
	<div class="file-path-wrapper">
	<input @if($disabled >= 6) disabled @endif class="file-path validate" type="text" value="{{ $profile->proof_of_bank ?? '' }}">
	<input @if($disabled >= 6) disabled @endif id="proof_of_bank_hidden"  type="hidden" value="{{ $profile->proof_of_bank ? 1 : 0 }}">
	<span class="error"><p id="proof_of_bank_error"></p></span>
	</div>
	</div>
	<div class="file-field input-field col m1 s12">
	@if ($profile->proof_of_bank)
	<img src="{{ asset('/storage/'.$profile->proof_of_bank) }}" width="50" height="50">
	@endif
	</div>
	<!-- @include('common.wizbtns') -->
	<div class="step-actions">
	<div class="row" >
	<div class="col m3 s12  mb-3  mt-1">
	<!-- evalutionsNextBtnPersonalInfoPayments -->
	@if($disabled == 5)
	<button id="savePMBankingInformationBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
	type="submit">Save</button>
	<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next1" type="submit" >Next</button>
	@else
	
	<!-- <button  
	class="waves-effect waves-dark btn btn-lg btn-primary" type="button"
	onclick="window.location.href=`{{ route('dashboard.translator.getHelp') }}`"> Get Help </button> -->
	<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next1" type="submit" >Next</button>
	@endif
	</div>
	<div class="col m9 s12  mb-2  mt-1" id="messagePMBankingInformation"></div>
	</div>
	</div>
	</div>
	</div>
	</form>
	</span>
	</div>
	</li>
	
	<li id="li2">
	<div class="collapsible-header" tabindex="0"><i class="material-icons">radio_button_checked</i>Alternate Payment
	Method{!! $alternate_payment_method_flag !!}</div>
	<div class="collapsible-body" id="li2child">
	<span>
	{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'pm-alternate-payment', 'name' => 'pm-alternate-payment')) }}
	@csrf
	<input type="hidden" name="form_type" value="pm-alternate-payment">
	<input type="hidden" name="ucode" value="{{ Request::segment(5) ?? Auth::user()->ucode }}">
	<div class="step-content">
	<div class="row">
	<div class="input-field col m12 s12">
	<label for="paypal_email">Alternate Payment Method (Paypal Email ID)</label>
	<input @if($disabled >= 6) disabled @endif type="text" id="paypal_email" name="paypal_email" value="{{ $profile->paypal_email ?? '' }}">
	<span class="error"><p id="paypal_email_error"></p></span>
	</div>
	</div>
	<!-- @include('common.wizbtns') -->
	<div class="step-actions">
	<div class="row" >
	<div class="col m3 s12  mb-3  mt-1">
	
	@if($disabled == 5)
	<button id="savePMAlternatePaymentBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
	type="submit">Save</button>
	@else
	<!-- <button  
	class="waves-effect waves-dark btn btn-lg btn-primary" type="button"
	onclick="window.location.href=`{{ route('dashboard.translator.getHelp') }}`"> Get Help </button> -->
	@endif
	</div>
	<div class="col m9 s12  mb-2  mt-1" id="messagePMAlternatePayment">
	</div>
	</div>
	</div>
	</div>
	</form>
	</span>
	</div>
	</li>
	</ul>
	</div>
	</div>
	@endif
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
		//alert(token.content);
		$('#next1').on('click', function(){
			$('#li1').removeClass('active');
			$('#li1child').css({'display': 'none'});
			$('#li2').addClass('active');
			$('#li2child').css({'display': 'block'});
		});
		
		document.getElementById('pm-banking-information').addEventListener('submit', function(e){
			e.preventDefault();
			if($('#proof_of_bank_hidden').val() == 1){
				var names = ['bank_name', 'beneficiary_name', 'beneficiary_account_number', 'ifsc_code', 'bank_branch_address'];
			}else{
				var names = ['bank_name', 'beneficiary_name', 'beneficiary_account_number', 'ifsc_code', 'bank_branch_address', 'proof_of_bank_type', 'proof_of_bank'];
			}
			var errorCount = 0;
			names.forEach((el) => {
				var val = document.forms["pm-banking-information"][el].value;
				if (val == null || val == "") {
					document.getElementById(el + '_error').style = 'color:red';
					document.getElementById(el + '_error').focus();
					document.getElementById(el + '_error').textContent = 'Required!!!';
					++errorCount;
				}else{
					document.getElementById(el + '_error').textContent = '';
				}
			});
			if (errorCount) return true;		
			const form = document.querySelector('#pm-banking-information');
			var formData = new FormData(form);
			var config2 = config;
			axios.post(bURL+'dashboard/translator/update-profile', formData, config2)
			.then(function (res) {
				console.log(res.data);
				if(res.data.message === true){
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content green-text">
					<p>Success! Your banking information data saved successfuly</p>
					</div>
					</div>`;
					$filled =  ' &nbsp; <span id="banking_information_flag" style="color:green"> ( Information filled )</span>';     
				}else{
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content red-text">
					<p>Error! Have problem regarding save your banking information </p>
					</div>
					</div>`;
					$filled =  ' &nbsp; <span id="banking_information_flag" style="color:red"> ( Information to be filled )</span>'; 
				}
				$('#banking_information_flag').html($filled);
				$('#messagePMBankingInformation').html(msg);
				$('#messagePMBankingInformation').empty().show().html(msg).delay(3000).fadeOut(300);
			})
			.catch(function (err) {
				console.log(err);            
			});          
		});
		
		
		document.getElementById('pm-alternate-payment').addEventListener('submit', function(e){
			e.preventDefault();
			const form = document.querySelector('#pm-alternate-payment');
			var formData = new FormData(form);
			axios.post(bURL+'dashboard/translator/update-profile', formData, config)
			.then(function (res) {
				console.log(res.data);
				if(res.data.message === true){
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content green-text">
					<p>Success! Alternate payment method data saved successfuly</p>
					</div>
					</div>`;
					$filled =  ' &nbsp; <span id="alternate_payment_method_flag" style="color:green"> ( Information filled )</span>';     
				}else{
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content red-text">
					<p>Error! Have problem regarding save alternate payment method</p>
					</div>
					</div>`;
					$filled =  ' &nbsp; <span id="alternate_payment_method_flag" style="color:red"> ( Information to be filled )</span>'; 
				}
				$('#alternate_payment_method_flag').html($filled);
				$('#messagePMAlternatePayment').html(msg);
				$('#messagePMAlternatePayment').empty().show().html(msg).delay(3000).fadeOut(300);
			})
			.catch(function (err) {
				console.log(err);            
			});          
		});
		
		
	});
	</script>
	@endpush      