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


$pd_identification_information_flag = ' &nbsp; <span id="pd_identification_information_flag" style="color:red"> ( Information
to be filled )</span>';
$pd_work_history_flag = ' &nbsp; <span id="pd_work_history_flag" style="color:red"> ( Information
to be filled )</span>';
$pd_work_schedule_flag = ' &nbsp; <span id="pd_work_schedule_flag" style="color:red"> ( Information
to be filled )</span>';
if($profile->pd_identification_information_flag == 1){
$pd_identification_information_flag = ' &nbsp; <span id="pd_identification_information_flag" style="color:green"> ( Information filled )</span>';
}
if($profile->pd_work_history_flag == 1){
$pd_work_history_flag = ' &nbsp; <span id="pd_work_history_flag" style="color:green"> ( Information filled )</span>';
}
if($profile->pd_work_schedule_flag == 1){
$pd_work_schedule_flag = ' &nbsp; <span id="pd_work_schedule_flag" style="color:green"> ( Information filled )</span>';
}
@endphp

<div id="popout" class=" mb-7" >
	<p class="ml-2" align="justify">Please enter your professional details.</p>
	<ul class="collapsible popout">
		<li id="li1">
			<div class="collapsible-header" tabindex="0"><i class="material-icons">filter_drama</i>Identification Information {!! $pd_identification_information_flag !!}</div>
			<div class="collapsible-body" id="li1child">
				<span>
					{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'pd-identification-information', 'name' => 'pd-identification-information')) }}
					@csrf
					<input type="hidden" name="form_type" value="pd-identification-information">
					<input type="hidden" name="ucode" value="{{ $ucode }}">
					<input type="hidden" name="user_id" value="{{ $user_id }}">
					<!--  <div class="step-title waves-effect">Personal Information</div> -->
					<br/>
					<div class="step-content">
						<div class="row">
						<div class="col s12 mb-4">

							Note: Please Provide JPG/PNG format only(Max Size – 2 MB)

						</div>	

							<div class="input-field col m3 s12">
								<select name="photo_id_type" @if($disabled >= 6) disabled @endif>
									<option disabled>Please select an option</option>
									<option value="National ID" {{ $profile->photo_id_type == 'National ID' ? 'selected' : '' }}>National ID</option>
									<option value="Passport" {{ $profile->photo_id_type == 'Passport' ?? 'selected' }}>Passport</option>
									<option value="Driver`s Licence" {{ $profile->photo_id_type == 'Driver`s Licence' ? 'selected' : '' }}>Driver's Licence</option>
									<option value="Other" {{ $profile->photo_id_type == 'Other' ? 'selected' : '' }}>Other</option>
								</select>
								<label>Photo ID Type</label>
								<span class="error"><p id="photo_id_type_error"></p></span>
							</div>
							<div class="file-field input-field col m8 s12">
								<div class="btn">
									<span>Upload</span>
									<input   type="file" id="photo_id" name="photo_id" accept="image/jpeg" value="{{ $profile->photo_id ?? '' }}" class="validate"  @if($disabled >= 6) disabled @endif>
								</div>
								<div class="file-path-wrapper">
									<input    @if($disabled >= 6) disabled @endif  class="file-path validate" type="text" value="{{ $profile->photo_id ?? '' }}">
									<input    @if($disabled >= 6) disabled @endif  id="photo_id_hidden"  type="hidden" value="{{ $profile->photo_id ? 1 : 0 }}">
									<span class="error"><p id="photo_id_error"></p></span>
								</div>
							</div>
							<div class="file-field input-field col m1 s12">
								@if ($profile->photo_id)
								<img src="{{ asset('/storage/'.$profile->photo_id) }}" width="50" height="50">
								@endif
							</div>
							<div class="input-field col m3 s12">
								<select name="address_proof_type"   @if($disabled >= 6) disabled @endif >

									<option disabled>Please select an option</option>

									<option value="Passport" {{ $profile->address_proof_type == 'Passport' ? 'selected' : '' }}>Passport</option>
									<option value="Rent Agreement" {{ $profile->address_proof_type == 'Rent Agreement' ? 'selected' : '' }}>Rent Agreement</option>
									<option value="Bank Document" {{ $profile->address_proof_type == 'Bank Document' ? 'selected' : '' }}>Bank Document</option>
									<option value="Other" {{ $profile->address_proof_type == 'Other' ? 'selected' : '' }}>Other</option>
								</select>
								<label>Address Proof Type</label>
								<span class="error"><p id="address_proof_type_error"></p></span>
							</div>
							<div class="file-field input-field col m8 s12">
								<div class="btn">
									<span>Upload</span>
									<input   @if($disabled >= 6) disabled @endif  type="file" id="address_proof" name="address_proof" accept="image/jpeg" value="{{ $profile->address_proof ?? '' }}" class="validate">
								</div>
								<div class="file-path-wrapper">
									<input   @if($disabled >= 6) disabled @endif  class="file-path validate" type="text" value="{{ $profile->address_proof ?? '' }}">
									<input   @if($disabled >= 6) disabled @endif  id="address_proof_hidden"  type="hidden" value="{{ $profile->address_proof ? 1 : 0 }}">
									<span class="error"><p id="address_proof_error"></p></span>
								</div>
							</div>
							<div class="file-field input-field col m1 s12">
								@if ($profile->address_proof)
								<img src="{{ asset('/storage/'.$profile->address_proof) }}" width="50" height="50">
								@endif
							</div>
						</div>
						<!-- @include('common.wizbtns') -->
						<div class="step-actions">
							<div class="row" >
								<div class="col m3 s12  mb-3  mt-1">
									<!-- evalutionsNextBtnPersonalInfoPayments -->
									@if($disabled == 5)
									<button id="savePdIdentificationInformationBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
									type="submit">Save</button>
									<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next1" type="submit" >Next</button>

									@else
									<!-- <button  
									class="waves-effect waves-dark btn btn-lg btn-primary" type="button"
									onclick="window.location.href=`{{ route('dashboard.translator.getHelp') }}`"> Get Help </button> -->
									<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next1" type="submit" >Next</button>
									@endif

								</div>
								<div class="col m9 s12  mb-2  mt-1" id="messagePdIdentificationInformation">
								</div>
							</div>
						</div>
					</div>
				</form>
			</span>
		</div>
	</li>
	<li id="li2">
		<div class="collapsible-header" tabindex="0"><i class="material-icons">radio_button_checked</i>Work History {!! $pd_work_history_flag !!}</div>
		<div class="collapsible-body" id="li2child">
			<span>
				{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'pd-work-history', 'name' => 'pd-work-history')) }}
				@csrf
				<input type="hidden" name="form_type" value="pd-work-history">
				<input type="hidden" name="ucode" value="{{ Request::segment(5) ?? Auth::user()->ucode }}">
				<div class="step-content">
					<div class="row">
						<div class="input-field col m3 s12">
							<select id="work_experience" name="work_experience">

								@if(!$profile->work_experience)
								<option value="" disabled selected>Please select an option</option>
								@endif

								
								<option value="I am a Fresher" {{ $profile->work_experience == 'I am a Fresher' ? 'selected' : '' }}>I am a Fresher</option>
								<option value="Less than 1 Year" {{ $profile->work_experience == 'Less than 1 Year' ? 'selected' : '' }}>Less than 1 Year</option>
								<option value="Between 1-2 Years" {{ $profile->work_experience == 'Between 1-2 Years' ? 'selected' : '' }}>Between 1-2 Years</option>
								<option value="Between 2-3 Years" {{ $profile->work_experience == 'Between 2-3 Years' ? 'selected' : '' }}>Between 2-3 Years</option>
								<option value="Between 3-4 Years" {{ $profile->work_experience == 'Between 3-4 Years' ? 'selected' : '' }}>Between 3-4 Years</option>
								<option value="More than 4 Years" {{ $profile->work_experience == 'More than 4 Years' ? 'selected' : '' }}>More than 4 Years</option>
							</select>
							<label>Number of years(Work Experience)</label>
							<span class="error" id="work_experience_error"></span>
						</div>
						<div class="input-field col m3 s12">
							<div class="step-title waves-effect">Type of experience </div>
							<p>
								<label>
									<input class="form-check-input" type="checkbox" name="translation" id="translation" value="{{ $profile->translation ? 1 : 0 }}"   {{ $profile->translation ? 'checked' : '' }}>
									<span>Translation</span>
								</label>
							</p>
							<p>
								<label>
									<input class="form-check-input" type="checkbox" name="proofreading" id="proofreading" value="{{ $profile->proofreading ? 1 : 0 }}"   {{ $profile->proofreading ? 'checked' : '' }}>
									<span>Proofreading</span>
								</label>
							</p>
							<p>
								<label>
									<input class="form-check-input" type="checkbox" name="quality_assurance" id="quality_assurance" value="{{ $profile->quality_assurance ? 1 : 0 }}"   {{ $profile->quality_assurance ? 'checked' : '' }}>
									<span>Quality Assurance</span>
								</label>
							</p>
						</div>



						@foreach($docs as  $doc)
						<div class="file-field input-field col m11 s12">

<div class="file-path-wrapper">
	<input  type="text" value="{{ $doc->doc_image ?? '' }}" readonly>
	<input id="doc_image_hidden{{ $doc->doc_image }}"  type="hidden" value="{{ $doc->doc_image ? 1 : 0 }}">
	<span class="error"><p id="doc_image_error"></p></span>
</div>
</div>
<div class="file-field input-field col m1 s12">
	@if ($doc->doc_image)
	<img 
	class="modal-trigger custom-pointer"
	href="#showDocumentModal"
	onclick="showDocumentModal(`{{$profile->ucode ?? ''}}, {{$profile->first_name ?? ''}}, 'doc_type', {{$doc->doc_image ?? ''}}, {{$doc->doc_status ?? ''}}, {{ $doc->doc_type ?? '' }}, 'documents'`)"
	src="{{ asset('/storage/'.$doc->doc_image) }}" width="50" height="50">
	@endif
</div>
@endforeach




<div class="file-field input-field col s12">
	<div class="btn mb-1">
		<span>Upload</span>
		<input type="file"  name="proof_of_experience[]" >
	</div>
	<div class="file-path-wrapper">
		<input class="file-path validate" type="text">
	</div>
</div>
<div class="col s12">
	<button  

	class="waves-effect waves-dark btn btn-lg btn-primary add_more" type="button"> Add </button>
</div>




</div>
<div class="step-actions">
	<div class="row" >
		<div class="col m3 s12  mb-3  mt-1">
			<button id="savePdWorkHistoryBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
			type="submit">Save</button>
			<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next2" type="submit" >Next</button>
		</div>
		<div class="col m9 s12  mb-2  mt-1" id="messagePdWorkHistory">
		</div>
	</div>
</div>
</div> 
</form>
</span>
</div>
</li>
<li id="li3">
	<div class="collapsible-header" tabindex="0"><i class="material-icons">whatshot</i>Work Schedule {!! $pd_work_schedule_flag !!}</div>
	<div class="collapsible-body" id="li3child">
		<span>
			{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'pd-work-schedule', 'name' => 'pd-work-schedule')) }}
			@csrf
			<input type="hidden" name="form_type" value="pd-work-schedule">
			<input type="hidden" name="ucode" value="{{ Request::segment(5) ??Auth::user()->ucode }}">
			<div class="step-content">
				<div class="row">
					<table class="subscription-table responsive-table highlight mb-5">
						<thead>
							<tr>
								<th class="custome-width" align="center"><strong>Available Days</strong></th>
								<th class="custome-width" align="center">08:00 AM - 12:00 PM</th>
								<th class="custome-width" align="center">12:00 PM - 04:00 PM</th>
								<th class="custome-width" align="center">04:00 PM - 08:00 PM</th>
								<th class="custome-width" align="center">08:00 PM - 12:00 AM</th>
								<th class="custome-width" align="center">12:00 AM - 04:00 AM</th>
								<th class="custome-width" align="center">04:00 AM - 08:00 AM</th>
							</tr>
						</thead>
						@php $arrSunday = json_decode($profile->sunday); @endphp
						@php $arrMonday = json_decode($profile->monday); @endphp
						@php $arrTuesday = json_decode($profile->tuesday); @endphp
						@php $arrWednesday = json_decode($profile->wednesday); @endphp
						@php $arrThursday = json_decode($profile->thursday); @endphp
						@php $arrFriday = json_decode($profile->friday); @endphp
						@php $arrSaturday = json_decode($profile->saturday); @endphp
						<tbody id="tableHeading">
							<tr>
								<td class="custom-width">Sunday</td>
								@if($profile->sunday)
								@foreach($arrSunday as $key => $val)
								<td class="custom-width">
									<p>
										<label>
											<input name="{{ $key }}" value="{{ substr($key, -1) }}" {{ $val == 1 ? 'checked' : '' }}  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								@endforeach
								@else 
								<td class="custom-width">
									<p>
										<label>
											<input name="sunday_check_1" value="1"  type="checkbox">
											<span></span>

										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="sunday_check_2" value="2"  type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="sunday_check_3" value="3"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="sunday_check_4" value="4" type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="sunday_check_5" value="5"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="sunday_check_6" value="6"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								@endif
							</tr>
							<tr>
								<td class="custom-width">Monday</td>
								@if($profile->monday)
								@foreach($arrMonday as $key => $val)
								<td class="custom-width">
									<p>
										<label>
											<input name="{{ $key }}" value="{{ substr($key, -1) }}" {{ $val == 1 ? 'checked' : '' }}  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								@endforeach
								@else 
								<td class="custom-width">
									<p>
										<label>
											<input name="monday_check_1" value="1"  type="checkbox">
											<span></span>

										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="monday_check_2" value="2"  type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="monday_check_3" value="3"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="monday_check_4" value="4" type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="monday_check_5" value="5"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="monday_check_6" value="6"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								@endif
							</tr>
							<tr>
								<td class="custom-width">Tuesday</td>
								@if($profile->tuesday)
								@foreach($arrTuesday as $key => $val)
								<td class="custom-width">
									<p>
										<label>
											<input name="{{ $key }}" value="{{ substr($key, -1) }}" {{ $val == 1 ? 'checked' : '' }}  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								@endforeach
								@else 
								<td class="custom-width">
									<p>
										<label>
											<input name="tuesday_check_1" value="1"  type="checkbox">
											<span></span>

										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="tuesday_check_2" value="2"  type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="tuesday_check_3" value="3"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="tuesday_check_4" value="4" type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="tuesday_check_5" value="5"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="tuesday_check_6" value="6"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								@endif
							</tr>
							<tr>
								<td class="custom-width">Wednesday</td>
								@if($profile->wednesday)
								@foreach($arrWednesday as $key => $val)
								<td class="custom-width">
									<p>
										<label>
											<input name="{{ $key }}" value="{{ substr($key, -1) }}" {{ $val == 1 ? 'checked' : '' }}  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								@endforeach
								@else 
								<td class="custom-width">
									<p>
										<label>
											<input name="wednesday_check_1" value="1"  type="checkbox">
											<span></span>

										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="wednesday_check_2" value="2"  type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="wednesday_check_3" value="3"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="wednesday_check_4" value="4" type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="wednesday_check_5" value="5"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="wednesday_check_6" value="6"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								@endif
							</tr>
							<tr>
								<td class="custom-width">Thursday</td>
								@if($profile->thursday)
								@foreach($arrThursday as $key => $val)
								<td class="custom-width">
									<p>
										<label>
											<input name="{{ $key }}" value="{{ substr($key, -1) }}" {{ $val == 1 ? 'checked' : '' }}  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								@endforeach
								@else 
								<td class="custom-width">
									<p>
										<label>
											<input name="thursday_check_1" value="1"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="thursday_check_2" value="2"  type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="thursday_check_3" value="3"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="thursday_check_4" value="4" type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="thursday_check_5" value="5"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="thursday_check_6" value="6"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								@endif
							</tr>
							<tr>
								<td class="custom-width">Friday</td>
								@if($profile->friday)
								@foreach($arrFriday as $key => $val)
								<td class="custom-width">
									<p>
										<label>
											<input name="{{ $key }}" value="{{ substr($key, -1) }}" {{ $val == 1 ? 'checked' : '' }}  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								@endforeach
								@else 
								<td class="custom-width">
									<p>
										<label>
											<input name="friday_check_1" value="1"  type="checkbox">
											<span></span>

										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="friday_check_2" value="2"  type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="friday_check_3" value="3"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="friday_check_4" value="4" type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="friday_check_5" value="5"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="friday_check_6" value="6"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								@endif
							</tr>
							<tr>
								<td class="custom-width">Saturday</td>
								@if($profile->saturday)
								@foreach($arrSaturday as $key => $val)
								<td class="custom-width">
									<p>
										<label>
											<input name="{{ $key }}" value="{{ substr($key, -1) }}" {{ $val == 1 ? 'checked' : '' }}  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								@endforeach
								@else 
								<td class="custom-width">
									<p>
										<label>
											<input name="saturday_check_1" value="1"  type="checkbox">
											<span></span>

										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="saturday_check_2" value="2"  type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="saturday_check_3" value="3"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="saturday_check_4" value="4" type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="saturday_check_5" value="5"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="saturday_check_6" value="6"  type="checkbox">
											<span></span>
										</label>
									</p>
								</td>
								@endif
							</tr>
						</tbody>
					</table>
				</div>
				<!-- @include('common.wizbtns') -->
				<div class="step-actions">
					<div class="row" >
						<div class="col m3 s12  mb-3  mt-1">
							<button id="savePdWorkScheduleBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
							type="submit">Save</button>
							<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" type="submit" onclick="window.location.href='/dashboard/translator/my-profile/payment-method'">Next</button>
							</div>
						<div class="col m9 s12  mb-2  mt-1" id="messagePdWorkSchedule">
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
</p>
</div>
</form>
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



		$('.add_more').click(function(e){
			//e.preventDefault();
			$(this).before(
				`<div class="file-field input-field">
				<div class="btn mb-1">
				<span>Upload</span>
				<input type="file"  name="proof_of_experience[]" >
				</div>
				<div class="file-path-wrapper">
				<input class="file-path validate" type="text">
				</div>
				</div>`
				);
		});

		
		
	// $('.addProof').click(function(e){
		// 	e.preventDefault();
		// 	$(this).before(
			// 		"<input class='validate' name='proof_of_experience[]' type='file'/>");
			// });
			
			
			$('#next1').on('click', function(){
				$('#li1').removeClass('active');
				$('#li1child').css({'display': 'none'});
				$('#li2').addClass('active');
				$('#li2child').css({'display': 'block'});
			});
			
			$('#next2').on('click', function(){
				$('#li2').removeClass('active');
				$('#li2child').css({'display': 'none'});
				$('#li3').addClass('active');
				$('#li3child').css({'display': 'block'});
			});
			
			document.getElementById('pd-identification-information').addEventListener('submit', function(e){
				e.preventDefault();
				/* Form Validation Start Here... */
				var names = ['photo_id_type', 'photo_id', 'address_proof_type', 'address_proof'];
				
				if($('#photo_id_hidden').val() == 1 && $('#address_proof_hidden').val() == 1){
					var names = ['photo_id_type', 'address_proof_type'];
				}else if($('#photo_id_hidden').val() == 1 && $('#address_proof_hidden').val() == 0){
					var names = ['photo_id_type', 'address_proof_type', 'address_proof'];
				}else if($('#photo_id_hidden').val() == 0 && $('#address_proof_hidden').val() == 1){
					var names = ['photo_id_type', 'photo_id', 'address_proof_type'];
				}else{
					var names = ['photo_id_type', 'photo_id', 'address_proof_type', 'address_proof'];
				}
				
				var errorCount = 0;
				names.forEach((el) => {
					var val = document.forms["pd-identification-information"][el].value;
					if (val == null || val == "") {
						document.getElementById(el + '_error').style = 'color:red';
						document.getElementById(el + '_error').focus();
						document.getElementById(el + '_error').textContent = 'Required!!! (upload only png/jpg images with Max Size – 2 MB)';
						++errorCount;
					}else{
						document.getElementById(el + '_error').textContent = '';
					}
				});
				if (errorCount) return false;
				/* Form Validation End Here... */
				const form = document.querySelector('#pd-identification-information');
				var formData = new FormData(form);
				axios.post(bURL+'dashboard/translator/update-profile', formData, config)
				.then(function (res) {
					console.log(res.data);
					if(res.data.message === true){
						var msg = `<div class="card-alert card  lighten-5">
						<div class="card-content green-text">
						<p>Success! Identification Information data saved successfuly</p>
						</div>
						</div>`;     
						$filled =  ' &nbsp; <span id="pd_identification_information_flag" style="color:green"> ( Information filled )</span>';  
					}else{
						var msg = `<div class="card-alert card  lighten-5">
						<div class="card-content red-text">
						<p>Error! Have problem regarding save Identification Information</p>
						</div>
						</div>`;
						$filled =  ' &nbsp; <span id="pd_identification_information_flag" style="color:red"> ( Information to be filled )</span>'; 
					}
					$('#pd_identification_information_flag').html($filled);
					$('#messagePdIdentificationInformation').html(msg);
					$('#messagePdIdentificationInformation').empty().show().html(msg).delay(3000).fadeOut(300);
				})
				.catch(function (err) {
					console.log(err);            
				});          
			});
			
			
			document.getElementById('pd-work-history').addEventListener('submit', function(e){
				e.preventDefault();
				/* Form Validation Start Here... */
				var names = ['work_experience'];
				var errorCount = 0;
				names.forEach((el) => {
					var val = document.forms["pd-work-history"][el].value;
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
				
				
				var $fileUpload = $("input[type='file']");
				if (parseInt($fileUpload.get(0).files.length) > 3){
					alert("You are only allowed to upload a maximum of 3 files");
				}
				
				
				/* Form Validation End Here... */
				const form = document.querySelector('#pd-work-history');
				var formData = new FormData(form);
				axios.post(bURL+'dashboard/translator/update-profile', formData, config)
				.then(function (res) {
					console.log(res.data);
					if(res.data.message === true){
						var msg = `<div class="card-alert card  lighten-5">
						<div class="card-content green-text">
						<p>Success! Work history data saved successfuly</p>
						</div>
						</div>`;      
						$filled =  ' &nbsp; <span id="pd_work_history_flag" style="color:green"> ( Information filled )</span>'; 
					}else{
						var msg = `<div class="card-alert card  lighten-5">
						<div class="card-content red-text">
						<p>Error! Have problem regarding save work history</p>
						</div>
						</div>`;
						$filled =  ' &nbsp; <span id="pd_work_history_flag" style="color:red"> ( Information to be filled )</span>'; 
					}
					$('#pd_work_history_flag').html($filled);
					$('#messagePdWorkHistory').html(msg);
					$('#messagePdWorkHistory').empty().show().html(msg).delay(3000).fadeOut(300);
				})
				.catch(function (err) {
					console.log(err);            
				});          
			});
			
			
			document.getElementById('pd-work-schedule').addEventListener('submit', function(e){
				e.preventDefault();
				const form = document.querySelector('#pd-work-schedule');
				var formData = new FormData(form);
				axios.post(bURL+'dashboard/translator/update-profile', formData, config)
				.then(function (res) {
					console.log(res.data.message);
					if(res.data.message === true){
						var msg = `<div class="card-alert card  lighten-5">
						<div class="card-content green-text">
						<p>Success! Your availability saved successfuly</p>
						</div>
						</div>`;      
						$filled =  ' &nbsp; <span id="pd_work_schedule_flag" style="color:green"> ( Information filled )</span>'; 
					}else{
						var msg = `<div class="card-alert card  lighten-5">
						<div class="card-content red-text">
						<p>Error! Have problem regarding save your availability</p>
						</div>
						</div>`;
						$filled =  ' &nbsp; <span id="pd_work_schedule_flag" style="color:red"> ( Information to be filled )</span>'; 
					}
					$('#pd_work_schedule_flag').html($filled);
					$('#messagePdWorkSchedule').html(msg);
					$('#messagePdWorkSchedule').empty().show().html(msg).delay(3000).fadeOut(300);
				})
				.catch(function (err) {
					console.log(err);            
				});          
			});
			
		});
	</script>
	@endpush      