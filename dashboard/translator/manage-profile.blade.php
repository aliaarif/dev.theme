@extends('layouts.user')
@section('content')
@php 
$ucode = Request::segment(4) ?? Auth::user()->ucode;
$user_id = Request::segment(5) ?? Auth::id();
if($_SERVER['HTTP_HOST'] == 'development.theezlab.info'){
	$bURL = 'http://development.theezlab.info/';
}else if($_SERVER['HTTP_HOST'] == 'testing.theezlab.info'){
	$bURL = 'http://testing.theezlab.info/';
}else{
	$bURL = 'http://dev.project/';
}
		
@endphp


<div id="showDocumentModal" class="modal">
	{{ Form::open(array('url' => route('dashboard.translator.updateDocument'), 'files'=>'true', 'method'=>'post', 'id' => 'updateDocument', 'name' => 'updateDocument')) }}
	@csrf
	<input type="hidden" name="form_type" value="document-update">

	<input type="hidden" name="docUcode" id="docUcode">
	<input type="hidden" name="docColName" id="docColName">
	<input type="hidden" name="docTableName" id="docTableName">
	<input type="hidden" name="docImage" id="docImage">
	<input type="hidden" name="docApproveFlag" id="docApproveFlag">


	<div class="modal-content">
		<div  class="case-slider__info">
			<div  class="row mb-4" >
				<div align="left" class="col s4" id="name_single"></div>
				<div align="center" class="col s4">Status:
					<span id="dynamicDocStatus" class="doc_status_single"></span>
				</div>
				<div align="right" class="col s4" id="doc_type_single"></div>
			</div>
		</div>
		<div align="center">
		
			<img  id="imgSrc_single" 
			src="{{ $bURL }}storage/doc-1.png"
			height="300"
			class="animate fadeUp"
			/>
		</div>
		<div class="case-slider__navigation" style="display:flex">
			<div  class="row mb-2 .case-slider__navigation" >
				<div align="center" class="col sm-6">
					<a 
					id="rejectSingle" 
					class="modal-action waves-effect waves-red btn-flat"
					onclick="rejectThis(0)"
					>Reject!</a>
				</div>

				<div align="center" class="col sm-4">
					<a 
					id="deleteSingle" 
					class="modal-action waves-effect waves-red btn-flat"
					onclick="reloadThis()"
					>Reload!</a>
				</div>
				<div align="center" class="col sm-6">
					<a
					id="aproveSingle" 
					class="modal-action waves-effect waves-green btn-flat"
					onclick="approveThis(1)"
					>Approve!</a>
				</div>
			</div>
		</div>
	</div>
</form>
</div>

<div id="popout" class=" mb-7  animate fadeUp">
	<div class="col s12">
		<p class="ml-2" align="justify">Manage the profile of {{ $profile->first_name }}</p>
	</div>
	<div class="col s12">
		<ul class="collapsible popout">
			<li id="li1" class="active">
				<div class="collapsible-header" tabindex="0"><i class="material-icons">radio_button_checked</i>Personal Information</div>
				<div class="collapsible-body" id="li1child" style="display: block;">
					<span>
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
									<input type="text" id="first_name" name="first_name" value="{{ $profile->first_name }}" >
									<span class="error" id="first_name_error"></span>
								</div>
								<div class="input-field col m2 s12">
									<label for="middle_name">Middle Name</label>
									<input type="text" id="middle_name" name="middle_name" value="{{ $profile->middle_name }}" >
									<span class="error" id="middle_name_error"></span>
								</div>
								<div class="input-field col m2 s12">
									<label for="last_name">Last Name<span class="red-text">*</span></label>
									<input type="text" id="last_name" name="last_name" value="{{ $profile->last_name }}" >
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
									</select>
									<label>Gender</label>
									<span class="error" id="gender_error"></span>
								</div>
								<div class="input-field col m3 s12">
									<label for="email">Email<span class="red-text">*</span></label>
									<input type="email"  name="email" id="email" value="{{ Request::segment(5) ? $profile->user->email : Auth::user()->email }}"  disabled>
									<span class="error" id="email_error"></span>
								</div>
							</div>
							<div class="row">
								<div class="input-field col m2 s12">
									<label for="nationality">Nationality<span class="red-text">*</span></label>
									<input type="text" id="nationality" name="nationality" value="{{ $profile->nationality }}" >
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
									<input type="text" id="mobile" value="{{ $profile->mobile ?? '' }}" name="mobile" >
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
									<input type="text"  name="whatsapp_mobile" id="whatsapp_mobile" value="{{ $profile->whatsapp_mobile ?? '' }}" >
									<span class="error" id="whatsapp_mobile_error"></span>
								</div>
							</div>
							<div class="step-actions">
								<div class="row" >
									<div class="col m3 s12  mb-3  mt-1">
										<button id="savePersonalInformationBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
										type="submit">Save</button>
										<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next1" type="submit" >Next</button>
									</div>
									<div class="col m9 s12  mb-2  mt-1" id="messagePersonalInformation"></div>
								</div>
							</div>
						</div>
					</form>
				</span>
			</div>
		</li>
		<li id="li2" class="">
			<div class="collapsible-header" tabindex="0"><i class="material-icons">radio_button_checked</i>Language Proficiency</div>
			<div class="collapsible-body" id="li2child" style="">
				<span>
					{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'skills-language-proficiency', 'name' => 'skills-language-proficiency')) }}
					@csrf
					<input type="hidden" name="form_type" value="skills-language-proficiency">
					<input type="hidden" name="ucode" value="{{ $ucode }}">
					<input type="hidden" name="user_id" value="{{ $user_id }}">
					<!--  <div class="step-title waves-effect">Personal Information</div> -->
					<br/>
					<div class="step-content">
						<div class="row">

							<table class="subscription-table responsive-table highlight">
								<thead>
									<tr>
										<th class="custome-width" align="center"> Language Proficency</th>
										<th class="custome-width" align="center">N/A</th>
										<th class="custome-width" align="center">Elementory</th>
										<th class="custome-width" align="center">Limited</th>
										<th class="custome-width" align="center">Professsional Working</th>
										<th class="custome-width" align="center">Full Professsional</th>
										<th class="custome-width" align="center">Native/Bilingual</th>
									</tr>
								</thead>

								<tbody id="tableHeading">
									@foreach($languages as $language)

									<label id="myLangs" style="position: relative; top: -15px;">
										<input style="position: relative; right: 20px;" class="form-check-input" type="checkbox" name="language" id="language" checked {{ $language->name == 'Arabic' || $language->name == 'English' || $language->name == 'Hindi' || $language->name == 'Chinese' || $language->name == 'Japanese' || $language->name == 'Russian' || $language->name == 'Spanish' || $language->name == 'French' || $language->name == 'German' ? 'disabled' : '' }}>
										<span>{{ $language->name }}</span>
									</label>

									@endforeach

									<div class="input-field col m12 s12 mt-2">
										<select id="languages" name="languages">
											<option  disabled selected>---Choose One---</option>
											<option id="Hindi" value="Hindi">Hindi</option>
											<option id="Chinese" value="Chinese">Chinese</option>
											<option id="Japanese" value="Japanese">Japanese</option>
											<option id="Russian" value="Russian">Russian</option>
											<option id="Spanish" value="Spanish">Spanish</option>
											<option id="French" value="French">French</option>
											<option id="German" value="German">German</option>
										</select>
										<label>Add More Language</label>
										<span class="error"><p id="first_name_error"></p></span>
									</div>



									@if(App\LanguagePair::where('ucode', Request::segment(5) ?? Auth::user()->ucode)->first())
									<input type="hidden" id="language_count" name="language_count" value="{{ count($languages) ? count($languages) : 0  }}">
									<input type="hidden" name="record_flag" value="update_record">
									@php 
									$counter = 0;
									@endphp



									@foreach($languages as $language)


									<tr>
										<td class="custom-width">{{ $language->name }}</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_{{ $counter }}" value="{{ $language->name }}_0" type="radio" {{ $language->proficiency == 0 ? 'checked' : '' }} >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_{{ $counter }}" value="{{ $language->name }}_1" type="radio" {{ $language->proficiency == 1 ? 'checked' : '' }} >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_{{ $counter }}" value="{{ $language->name }}_2" type="radio" {{ $language->proficiency == 2 ? 'checked' : '' }} >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_{{ $counter }}" value="{{ $language->name }}_3" type="radio" {{ $language->proficiency == 3 ? 'checked' : '' }} >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_{{ $counter }}" value="{{ $language->name }}_4" type="radio" {{ $language->proficiency == 4 ? 'checked' : '' }} >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_{{ $counter }}" value="{{ $language->name }}_5" type="radio" {{ $language->proficiency == 5 ? 'checked' : '' }} >
													<span></span>
												</label>
											</p>
										</td>
										<th><span  class="error"><p id="lang_{{ $counter }}_error"></p></span></th>

									</tr>
									@php $counter++; @endphp
									@endforeach

									@else

									<input type="hidden" name="record_flag" value="insert_record">
									<input type="hidden" id="language_count" name="language_count" value="2">
									<tr>
										<td class="custom-width">Arabic</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_0" value="Arabic_0" type="radio" checked  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_0" value="Arabic_1" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_0" value="Arabic_2" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_0" value="Arabic_3" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_0" value="Arabic_4" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_0" value="Arabic_5" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<th><span  class="error"><p id="lang_0_error"></p></span></th>

									</tr>


									<tr data-language="English">
										<td class="custom-width">English</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_1" value="English_0" type="radio" checked >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_1" value="English_1" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_1" value="English_2" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_1" value="English_3" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_1" value="English_4" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="lang_1" value="English_5" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<th><span  class="error"><p id="lang_1_error"></p></span></th>

									</tr>

									@endif



								</tbody>
							</table>


							<!-- @include('common.wizbtns') -->
							<div class="step-actions">
								<div class="row" >



									<div class="col m3 s12  mb-3  mt-1">
										<button id="saveSkillsLanguageProficiencyBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
										type="submit">Save</button>

										<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next2" type="submit" >Next</button>

									</div>
									<div class="col m9 s12  mb-2  mt-1" id="messageSkillsLanguageProficiency">

									</div>
								</div>
							</div>
						</div>
					</form>
				</span>
			</div>

		</li>
		<li id="li3" class="">
			<div class="collapsible-header" tabindex="0"><i class="material-icons">radio_button_checked</i>Subject Matter Expertise</div>
			<div class="collapsible-body" id="li3child" style="">
				<span>
					{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'skills-subject-matter-expertise', 'name' => 'skills-subject-matter-expertise')) }}
					@csrf
					<input type="hidden" name="form_type" value="skills-subject-matter-expertise">
					<input type="hidden" name="ucode" value="{{ Request::segment(4) ?? Auth::user()->ucode }}">
					<div class="step-content">

						<div class="row">





							<table class="subscription-table responsive-table highlight mb-5">
								<thead>
									<tr>
										<th class="custome-width" align="center"><strong>Expertise</strong></th>
										<th class="custome-width" align="center">1</th>
										<th class="custome-width" align="center">2</th>
										<th class="custome-width" align="center">3</th>
										<th class="custome-width" align="center">4</th>
										<th class="custome-width" align="center">5</th>
									</tr>
								</thead>

								<tbody id="tableHeading">
									@php
									$expertises = $profile->expertise ? json_decode($profile->expertise, true) : [];
									@endphp

									@forelse($expertises as $key => $val)

									<tr>
										<td class="custom-width">{{ ucwords(str_replace('_', ' / ', $key)) }}</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="{{ $key }}" value="1" type="radio" <?php if($val == 1){ echo 'checked'; }  ?> >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="{{ $key }}" value="2" type="radio" <?php if($val  == 2){ echo 'checked'; }  ?> >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="{{ $key }}" value="3" type="radio" <?php if($val == 3){ echo 'checked'; }  ?> >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="{{ $key }}" value="4" type="radio" <?php if($val == 4){ echo 'checked'; }  ?> >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="{{ $key }}" value="5" type="radio" <?php if($val == 5){ echo 'checked'; }  ?> >
													<span></span>
												</label>
											</p>
										</td>
									</tr>
									@empty
									<tr>
										<td class="custom-width">Business</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="business" value="1" type="radio">
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="business" value="2" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="business" value="3" type="radio">
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="business" value="4" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="business" value="5" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
									</tr>

									<tr>
										<td class="custom-width">Technology</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="technology" value="1" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="technology" value="2" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="technology" value="3" type="radio">
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="technology" value="4" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="technology" value="5" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
									</tr>

									<tr>
										<td class="custom-width">Finance</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="finance" value="1" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="finance" value="2" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="finance" value="3" type="radio">
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="finance" value="4" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="finance" value="5" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
									</tr>

									<tr>
										<td class="custom-width">Medical</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="medical" value="1" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="medical" value="2" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="medical" value="3" type="radio">
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="medical" value="4" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="medical" value="5" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
									</tr>

									<tr>
										<td class="custom-width">PR / Media</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="PR_media" value="1" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="PR_media" value="2" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="PR_media" value="3" type="radio">
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="PR_media" value="4" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="PR_media" value="5" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
									</tr>

									<tr>
										<td class="custom-width">Marketing</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="marketing" value="1" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="marketing" value="2" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="marketing" value="3" type="radio">
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="marketing" value="4" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="marketing" value="5" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
									</tr>

									<tr>
										<td class="custom-width">Literature</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="literature" value="1" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="literature" value="2" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="literature" value="3" type="radio">
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="literature" value="4" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="literature" value="5" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
									</tr>

									<tr>
										<td class="custom-width">Educational</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="educational" value="1" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="educational" value="2" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="educational" value="3" type="radio">
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="educational" value="4" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="educational" value="5" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
									</tr>

									<tr>
										<td class="custom-width">App / Software</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="app_software" value="1" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="app_software" value="2" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="app_software" value="3" type="radio">
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="app_software" value="4" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="app_software" value="5" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
									</tr>

									<tr>
										<td class="custom-width">General / Research</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="general_research" value="1" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="general_research" value="2" type="radio"  >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="general_research" value="3" type="radio">
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="general_research" value="4" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
										<td class="custom-width">
											<p>
												<label>
													<input name="general_research" value="5" type="radio" >
													<span></span>
												</label>
											</p>
										</td>
									</tr>


									@endforelse
								</tbody>
							</table>



						</div>
						<!-- @include('common.wizbtns') -->
						<div class="step-actions">
							<div class="row" >
								<div class="col m3 s12  mb-3  mt-1">
									<button id="saveSkillsSubjectMatterExpertiseBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
									type="submit">Save</button>
									<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next3" type="submit" >Next</button>
								</div>
								<div class="col m9 s12  mb-2  mt-1" id="messageSkillsSubjectMatterExpertise">
								</div>
							</div>
						</div>
					</div> 
				</form>
			</span>
		</div>

	</li>

	<li id="li4"  class="">
		<div class="collapsible-header" tabindex="0"><i class="material-icons">radio_button_checked</i>Software And Tools</div>
		<div class="collapsible-body" id="li4child"  style="">
			<span>
				{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'skills-software-and-tools', 'name' => 'skills-software-and-tools')) }}
				@csrf
				<input type="hidden" name="form_type" value="skills-software-and-tools">
				<input type="hidden" name="ucode" value="{{ Request::segment(4) ?? Auth::user()->ucode }}">
				<div class="step-content">

					<div class="row">



						<div class="input-field col m3 s12">
							<div class="step-title waves-effect">CAT Tools </div>
							<p>
								<label>
									<input class="form-check-input" type="checkbox" name="cat_tool_MemoQ" id="cat_tool_MemoQ" value="{{ $profile->cat_tool_MemoQ ? 1 : 0 }}"   {{ $profile->cat_tool_MemoQ ? 'checked' : '' }}>
									<span>MemoQ</span>
								</label>
							</p>
							<p>
								<label>
									<input class="form-check-input" type="checkbox" name="cat_tool_sds_trados" id="cat_tool_sds_trados" value="{{ $profile->cat_tool_sds_trados ? 1 : 0 }}"   {{ $profile->cat_tool_sds_trados ? 'checked' : '' }}>
									<span>SDS Trados</span>
								</label>
							</p>
							<p>
								<label>
									<input class="form-check-input" type="checkbox" name="cat_tool_other" id="cat_tool_other" value="{{ $profile->cat_tool_other ? 1 : 0 }}"   {{ $profile->cat_tool_other ? 'checked' : '' }}>
									<span>Other</span>
								</label>
							</p>
						</div>

						<div class="input-field col m3 s12">
							<div class="step-title waves-effect">MS Office Tools </div>
							<p>
								<label>
									<input class="form-check-input" type="checkbox" name="ms_office_tool_powerPoint" id="ms_office_tool_powerPoint" value="{{ $profile->ms_office_tool_powerPoint ? 1 : 0 }}"   {{ $profile->ms_office_tool_powerPoint ? 'checked' : '' }}>
									<span>MS PowerPoint</span>
								</label>
							</p>
							<p>
								<label>
									<input class="form-check-input" type="checkbox" name="ms_office_tool_Word" id="ms_office_tool_Word" value="{{ $profile->ms_office_tool_Word ? 1 : 0 }}"   {{ $profile->ms_office_tool_Word ? 'checked' : '' }}>
									<span>MS Word</span>
								</label>
							</p>
							<p>
								<label>
									<input class="form-check-input" type="checkbox" name="ms_office_tool_Excel" id="ms_office_tool_Excel" value="{{ $profile->ms_office_tool_Excel ? 1 : 0 }}"   {{ $profile->ms_office_tool_Excel ? 'checked' : '' }}>
									<span>MS Excel</span>
								</label>
							</p>
							<p>
								<label>
									<input class="form-check-input" type="checkbox" name="ms_office_tool_Visio" id="ms_office_tool_Visio" value="{{ $profile->ms_office_tool_Visio ? 1 : 0 }}"   {{ $profile->ms_office_tool_Visio ? 'checked' : '' }}>
									<span>MS Visio</span>
								</label>
							</p>

						</div>



					</div>
					<!-- @include('common.wizbtns') -->
					<div class="step-actions">
						<div class="row" >
							<div class="col m3 s12  mb-3  mt-1">
								<button id="saveSkillsSoftwareAndToolsBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
								type="submit">Save</button>
								<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next4" type="submit" >Next</button>
							</div>
							<div class="col m9 s12  mb-2  mt-1" id="messageSkillsSoftwareAndTools">
							</div>
						</div>
					</div>
				</div> 
			</form>
		</span>
	</div>
</li>

<li id="li5" class="">
	<div class="collapsible-header" tabindex="0">
		@if($profile->doc_status_photo_id == 1 && $profile->doc_status_address_proof == 1)
		<i class="material-icons green-text">radio_button_checked</i>
		@else
		<i class="material-icons red-text">radio_button_checked</i>
		@endif
		Identification Information
		@if($profile->doc_status_photo_id == 1 && $profile->doc_status_address_proof == 1)
		( <span class="green-text"><b>Approved!</b></span> )
		@endif
	</div>

	<div class="collapsible-body" id="li5child" style="">
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

					<div class="input-field col m3 s12">
						<select name="photo_id_type">
							<option value="National ID" {{ $profile->photo_id_type == 'National ID' ?? 'selected' }}>National ID</option>
							<option value="Passport" {{ $profile->photo_id_type == 'Passport' ?? 'selected' }}>Passport</option>
							<option value="Driver`s Licence" {{ $profile->photo_id_type == 'Driver`s Licence' ?? 'selected' }}>Driver's Licence</option>
							<option value="Other" {{ $profile->photo_id_type == 'Other' ?? 'selected' }}>Other</option>
						</select>
						<label>Photo ID Type</label>
						<span class="error"><p id="photo_id_type_error"></p></span>
					</div>




					<div class="file-field input-field col m8 s12">
						<div class="btn">
							<span>{{ $profile->photo_id ? 'UPDATE' : 'UPLOAD' }}</span>
							<input type="file" id="photo_id" name="photo_id" accept="image/jpeg" value="{{ $profile->photo_id ?? '' }}" class="validate">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" value="{{ $profile->photo_id ?? '' }}">
							<input id="photo_id_hidden"  type="hidden" value="{{ $profile->photo_id ? 1 : 0 }}">
							<span class="error"><p id="photo_id_error"></p></span>
						</div>
					</div>
					<div class="file-field input-field col m1 s12">
						@if ($profile->photo_id)
						<img
						class="modal-trigger custom-pointer"
						href="#showDocumentModal"
						onclick="showDocumentModal(`{{$profile->ucode ?? ''}}, {{$profile->first_name ?? ''}}, 'photo_id', {{$profile->photo_id ?? ''}}, {{$profile->doc_status_photo_id ?? ''}}, {{ $profile->photo_id_type ?? '' }}, 'profiles'`)"

						src="{{ asset('/storage/'.$profile->photo_id) }}" width="50" height="50" />
						@endif
					</div>






					<div class="input-field col m3 s12">
						<select name="address_proof_type">
							<option value="Passport" {{ $profile->address_proof_type == 'Passport' ?? 'selected' }}>Passport</option>
							<option value="Rent Agreement" {{ $profile->address_proof_type == 'Rent Agreement' ?? 'selected' }}>Rent Agreement</option>
							<option value="Bank Document" {{ $profile->address_proof_type == 'Bank Document' ?? 'selected' }}>Bank Document</option>
							<option value="Other" {{ $profile->address_proof_type == 'Other' ?? 'selected' }}>Other</option>
						</select>
						<label>Address Proof Type</label>
						<span class="error"><p id="address_proof_type_error"></p></span>
					</div>


					<div class="file-field input-field col m8 s12">
						<div class="btn">
							<span>{{ $profile->address_proof ? 'UPDATE' : 'UPLOAD' }}</span>
							<input type="file" id="address_proof" name="address_proof" accept="image/jpeg" value="{{ $profile->address_proof ?? '' }}" class="validate">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" value="{{ $profile->address_proof ?? '' }}">
							<input id="address_proof_hidden"  type="hidden" value="{{ $profile->address_proof ? 1 : 0 }}">
							<span class="error"><p id="address_proof_error"></p></span>
						</div>
					</div>
					<div class="file-field input-field col m1 s12">
						@if ($profile->address_proof)
						<img 
						class="modal-trigger custom-pointer"
						href="#showDocumentModal"
						onclick="showDocumentModal(`{{$profile->ucode ?? ''}}, {{$profile->first_name ?? ''}}, 'address_proof', {{$profile->address_proof ?? ''}}, {{$profile->doc_status_address_proof ?? ''}}, {{ $profile->address_proof_type ?? '' }}, 'profiles'`)"


						src="{{ asset('/storage/'.$profile->address_proof) }}" width="50" height="50">
						@endif
					</div>
				</div>
				<!-- @include('common.wizbtns') -->
				<div class="step-actions">
					<div class="row" >
						<div class="col m3 s12  mb-3  mt-1">
							<button id="savePdIdentificationInformationBtn" class="waves-effect waves-dark btn btn-sm btn-primary"
							type="submit">Save</button>
							<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next5" type="submit" >Next</button>
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

<li id="li6" class="">
	<div class="collapsible-header" tabindex="0"><i class="material-icons">radio_button_checked</i>Work History
		<!-- @if($dStatus != null)
		<i class="material-icons right green-text">radio_button_checked</i> <span class="green-text"><b>Approved!</b></span>
		@endif -->
	</div>
	<div class="collapsible-body" id="li6child" style="">
		<span>
			{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'pd-work-history', 'name' => 'pd-work-history')) }}
			@csrf
			<input type="hidden" name="form_type" value="pd-work-history">
			<input type="hidden" id="updateFlag" name="updateFlag" value="0">

			<input type="hidden" name="ucode" value="{{ Request::segment(4) ?? Auth::user()->ucode }}">
			<div class="step-content">

				<div class="row">

					<div class="input-field col m3 s12">
						<select id="work_experience" name="work_experience">
							<option value="" disabled>Please select an option</option>
							<option value="I am a Fresher" {{ $profile->work_experience == 'I am a Fresher' ? 'selected' : '' }}>I am a Fresher</option>
							<option value="Less than 1 Year" {{ $profile->work_experience == 'Less than 1 Year' ? 'selected' : '' }}>Less than 1 Year</option>
							<option value="Between 1-2 Years" {{ $profile->work_experience == 'Between 1-2 Years' ? 'selected' : '' }}>Between 1-2 Years</option>
							<option value="Between 2-3 Years" {{ $profile->work_experience == 'Between 2-3 Years' ? 'selected' : '' }}>Between 2-3 Years</option>
							<option value="Between 3-4 Years" {{ $profile->work_experience == 'Between 3-4 Years' ? 'selected' : '' }}>Between 3-4 Years</option>
							<option value="More than 4 Years" {{ $profile->work_experience == 'More than 4 Years' ? 'selected' : '' }}>More than 4 Years</option>
						</select>
						<label>Number of years(Work Experience)</label>
						<span class="error"><p id="work_experience_error"></p></span> 
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
								<span>Quality Aassurance</span>
							</label>
						</p>
					</div>
					@foreach($docs as  $doc)
					<div class="file-field input-field col m11 s12">
<!-- <div class="btn">
<span>{{ $doc->doc_image ? 'UPDATE Proof of Experience  ' : 'Proof of Experience  ' }}</span>
<input type="file" class="test" id="proof_of_experience{{ $doc->doc_index }}" name="proof_of_experience{{ $doc->doc_index }}" multiple accept="image/jpeg" value="{{ $doc->doc_image ?? '' }}" class="validate">
</div> -->
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



<!-- <div class="file-field input-field col m12 s12">
<div class="btn">
<span>UPLOAD Proof of Experience</span>
<input type="file" class="test test1" id="proof_of_experience" name="proof_of_experience[]" multiple accept="image/jpeg"  class="validate">
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text">
<input id="proof_of_experience_hidden"  type="hidden">
<span class="error"><p id="proof_of_experience_error"></p></span>
</div>
</div> -->



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
<!-- @include('common.wizbtns') -->
<div class="step-actions">
	<div class="row" >
		<div class="col m3 s12  mb-3  mt-1">
			<button id="savePdWorkHistoryBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
			type="submit">Save</button>
			<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next6" type="submit" >Next</button>
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

<li id="li7" class="">
	<div class="collapsible-header" tabindex="0"><i class="material-icons">radio_button_checked</i>Work Schedule</div>
	<div class="collapsible-body" id="li7child" style="">
		<span>
			{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'pd-work-schedule', 'name' => 'pd-work-schedule')) }}
			@csrf
			<input type="hidden" name="form_type" value="pd-work-schedule">
			<input type="hidden" name="ucode" value="{{ Request::segment(4) ?? Auth::user()->ucode }}">
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
											<input name="sunday_check_2" value="2"  type="checkbox"  >
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
											<input name="sunday_check_4" value="4" type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="sunday_check_5" value="5"  type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="sunday_check_6" value="6"  type="checkbox" >
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
											<input name="monday_check_2" value="2"  type="checkbox"  >
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
											<input name="monday_check_4" value="4" type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="monday_check_5" value="5"  type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="monday_check_6" value="6"  type="checkbox" >
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
											<input name="tuesday_check_2" value="2"  type="checkbox"  >
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
											<input name="tuesday_check_4" value="4" type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="tuesday_check_5" value="5"  type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="tuesday_check_6" value="6"  type="checkbox" >
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
											<input name="wednesday_check_2" value="2"  type="checkbox"  >
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
											<input name="wednesday_check_4" value="4" type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="wednesday_check_5" value="5"  type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="wednesday_check_6" value="6"  type="checkbox" >
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
											<input name="thursday_check_2" value="2"  type="checkbox"  >
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
											<input name="thursday_check_4" value="4" type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="thursday_check_5" value="5"  type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="thursday_check_6" value="6"  type="checkbox" >
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
											<input name="friday_check_2" value="2"  type="checkbox"  >
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
											<input name="friday_check_4" value="4" type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="friday_check_5" value="5"  type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="friday_check_6" value="6"  type="checkbox" >
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
											<input name="saturday_check_2" value="2"  type="checkbox"  >
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
											<input name="saturday_check_4" value="4" type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="saturday_check_5" value="5"  type="checkbox" >
											<span></span>
										</label>
									</p>
								</td>
								<td class="custom-width">
									<p>
										<label>
											<input name="saturday_check_6" value="6"  type="checkbox" >
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
							<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next7" type="submit" >Next</button>
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

<li id="li8" class="">
	<div class="collapsible-header" tabindex="0">
		@if($profile->doc_status_proof_of_bank == 1)
		<i class="material-icons green-text">radio_button_checked</i>
		@else
		<i class="material-icons red-text">radio_button_checked</i>
		@endif
		Payment Method
		@if($profile->doc_status_proof_of_bank == 1)
		( <span class="green-text"><b>Approved!</b></span> )
		@endif
	</div>
	<div class="collapsible-body" id="li8child" style="">
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
						<input type="text" id="bank_name" name="bank_name" value="{{ $profile->bank_name ?? '' }}">
						<span class="error"><p id="bank_name_error"></p></span>
					</div>



					<div class="input-field col m4 s12">
						<label for="beneficiary_name">Beneficiary Name<span class="red-text">*</span></label>
						<input type="text" id="beneficiary_name" name="beneficiary_name" value="{{ $profile->beneficiary_name ?? '' }}">
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
						<input type="text" id="ifsc_code" name="ifsc_code" value="{{ $profile->ifsc_code ?? '' }}">
						<span class="error"><p id="ifsc_code_error"></p></span>
					</div>

					<div class="input-field col m8 s12">
						<label for="bank_branch_address">Bank Branch Address<span class="red-text">*</span></label>
						<input type="text" id="bank_branch_address" name="bank_branch_address" value="{{ $profile->bank_branch_address ?? '' }}">
						<span class="error"><p id="bank_branch_address_error"></p></span>
					</div>

				</div>

				<div class="row">

					<div class="input-field col m4 s12">
						<select id="proof_of_bank_type" name="proof_of_bank_type">
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
						<span>{{ $profile->proof_of_bank ? 'UPDATE' : 'UPLOAD' }}</span>
						<input type="file" id="proof_of_bank" name="proof_of_bank" accept="image/jpeg" value="{{ $profile->proof_of_bank ?? '' }}" class="validate">
					</div>
					
					
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text" value="{{ $profile->proof_of_bank ?? '' }}">
						<input id="proof_of_bank_hidden"  type="hidden" value="{{ $profile->proof_of_bank ? 1 : 0 }}">
						<span class="error"><p id="proof_of_bank_error"></p></span>
					</div>
				</div>
				<div class="file-field input-field col m1 s12">
					@if ($profile->proof_of_bank)
					<img 
					
					class="modal-trigger custom-pointer"
					href="#showDocumentModal"
					onclick="showDocumentModal(`{{$profile->ucode ?? ''}}, {{$profile->first_name ?? ''}}, 'proof_of_bank', {{$profile->proof_of_bank ?? ''}}, {{$profile->doc_status_proof_of_bank ?? ''}}, {{ $profile->proof_of_bank_type ?? '' }}, 'profiles'`)"
					
					src="{{ asset('/storage/'.$profile->proof_of_bank) }}" width="50" height="50">
					@endif
				</div>
				<!-- @include('common.wizbtns') -->
				<div class="step-actions">
					<div class="row" >
						<div class="col m3 s12  mb-3  mt-1">
							
							<button id="savePMBankingInformationBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
							type="submit">Save</button>
							<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next8" type="submit" >Next</button>
							
							
							
							
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

<li id="li9">
	<div class="collapsible-header" tabindex="0"><i class="material-icons">radio_button_checked</i>Alternate Payment
	Method</div>
	<div class="collapsible-body" id="li9child">
		<span>
			{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'pm-alternate-payment', 'name' => 'pm-alternate-payment')) }}
			@csrf
			<input type="hidden" name="form_type" value="pm-alternate-payment">
			<input type="hidden" name="ucode" value="{{ Request::segment(5) ?? Auth::user()->ucode }}">
			<div class="step-content">
				<div class="row">
					<div class="input-field col m12 s12">
						<label for="paypal_email">Alternate Payment Method (Paypal Email ID)</label>
						<input type="text" id="paypal_email" name="paypal_email" value="{{ $profile->paypal_email ?? '' }}">
						<span class="error"><p id="paypal_email_error"></p></span>
					</div>
				</div>
				<div class="step-actions">
					<div class="row" >
						<div class="col m3 s12  mb-3  mt-1">
							<button id="savePaymentMethodBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
							type="submit">Save</button>
							<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next9" type="submit" >Next</button>
						</div>
						<div class="col m9 s12  mb-2  mt-1" id="messagePaymentMethod">
						</div>
					</div>
				</div>
			</div> 
		</form>
	</span>
</div>
</li>

<li id="li10">
	<div class="collapsible-header" tabindex="0"><i class="material-icons">radio_button_checked</i>Edit Contarct</div>
	<div class="collapsible-body" id="li10child">
		<div class="step-content">
			<div id="popout" class="animate fadeUp">
				<ul class="collapsible popout">
					@foreach($dlps  as $key => $dlp)
					<li id="li11{{ $key }}"  class="custom-class-for-localStorage">
						<div class="collapsible-header" tabindex="0"><i class="material-icons">radio_button_checked</i>{{ $dlp['name'] }}</div>
						<div class="collapsible-body" id="li11{{ $key }}child">
							{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'editContract-'.$key, 'name' => 'editContract-'.$key)) }}
							@csrf
							<input type="hidden" name="form_type" value="edit-contarct">
							<input type="hidden" name="ucode" value="{{ $ucode }}">
							<input type="hidden" name="dlp_id" value="{{ $dlp['id'] }}">
							<br/>
							<div class="step-content">
								<div class="modal-content">
									<div class="clearfix row">
									File Type must be pdf and max 2 MB
										<div class="file-field input-field col s11">
											<div class="btn">
												<span>{{ $dlp['document'] ? 'UPDATE CONTRACT' : 'UPLOAD CONTRACT' }}</span>
												<input  type="file" id="document-{{ $key }}" name="document" accept="application/pdf" value="{{ $dlp['document'] ?? '' }}" class="validate"  >
											</div>
											<div class="file-path-wrapper">
												<input   class="file-path validate" type="text" value="{{ $dlp['document'] ?? '' }}">
											</div>
										</div>
										<div class="file-field input-field col s1">
											@if ($dlp['document'])
											<embed type="application/pdf" src="{{ asset('/storage/'.$dlp['document']) }}" width="50" height="50">
												@endif
											</div>


											<div class="input-field  col s3">
												<select id="contract_flag-{{ $key }}" name="contract_flag" >
													<option disabled>---Contract Flag---</option>
													<option value="pipeline" {{ $dlp['contract_flag'] == 'pipeline' ?? 'selected' }}>Pipeline</option>
													<option value="pilot" {{ $dlp['contract_flag'] == 'pilot' ?? 'selected' }}>Pilot</option>
													<option value="seasoned" {{ $dlp['contract_flag'] == 'seasoned' ?? 'selected' }}>Seasoned</option>
												</select>
												<span class="error"><p id="contract_flag_error"></p></span>
											</div>

											<div class="input-field  col s3">
												<select id="contract_type-{{ $key }}" name="contract_type" onchange="customeAction1(this.value, `{{ $key }}`)">
													<option disabled>---Contract Type---</option>
													<option value="freelancer" {{ $dlp['contract_type'] == 'freelancer' ?? 'selected' }}>Freelancer</option>
													<option value="inhouse" {{ $dlp['contract_type'] == 'inhouse' ?? 'selected' }}>In-House</option>
												</select>
												<span class="error"><p id="contract_type_error"></p></span>
											</div>

											
											<div class="input-field col s2">
												<label for="fixed_rate">Fixed Income</label>
												<input  type="number"  id="fixed_rate-{{ $key }}" class="form-control mt-n4" placeholder="Fixed Income" name="fixed_rate" value="{{ $dlp['fixed_rate'] }}" @if($dlp['contract_type'] == 'freelancer') disabled @endif >
											</div>


											<div class="input-field col s2">
												<label for="final_rating">Rating</label>
												<input type="text" id="final_rating" class="form-control mt-n4" placeholder="Rating" name="final_rating" value="{{ $dlp['final_rating'] }}" readonly>
											</div>

											<div class="input-field col s2">
												<p>
													<label>
														<input
														type="checkbox"
														name="proofreader"
														id="proofreader-{{ $key }}"
														class="filled-in"
														onchange="customeAction2(this.checked, `{{ $key }}`)"
														@if($dlp['proofreader'] == 1) checked @endif
														/>
														<span>Proofreader</span>
													</label>
												</p>
												
											</div>
										</div>


										
										<fieldset class="row margin">
											<legend>Quota</legend>

											<div class="input-field col s6">
												<label for="translation_wc">Translation</label>
												<input
												type="text"
												value="{{ $dlp['translation_wc'] }}" 
												name="translation_wc"
												id="translation_wc-{{ $key }}"
												class="form-control"
												placeholder="No. of Words for Translation"
												@if($dlp['contract_type'] == 'freelancer')
												 disabled 
												 @endif
												/>
												<small style="position:relative; top:-5px;" class="black-text">No. of Words for Translation</small>
											</div>
											<div class="input-field col s6">
												<label for="proofreading_wc">Proofreading</label>
												<input
												type="text"
												value="{{ $dlp['proofreading_wc'] }}" 
												name="proofreading_wc"
												id="proofreading_wc-{{ $key }}"
												class="form-control"
												placeholder="No. of Words for Proofreading"
												@if($dlp['contract_type'] == 'freelancer') 
												disabled
												@elseif($dlp['contract_type'] == 'inhouse' && $dlp['proofreader'] != 1)
												disabled
												@endif
												/>
												<small style="position:relative; top:-5px;" class="black-text">No. of Words for Proofreading</small>
											</div>
										</fieldset>

										<fieldset class="row margin">
											<legend>Incentive / Price per Word</legend>

											<div class="input-field col s6">
												<label for="translation_ppw">Translation</label>
												<input
												type="number" step="0.01" pattern="^\d*(\.\d{0,2})?$"
												value="{{ $dlp['translation_ppw'] }}" 
												name="translation_ppw"
												id="translation_ppw-{{ $key }}"
												class="form-control"
												placeholder="For Translation"
												
												/>
												<small style="position:relative; top:-5px;" class="black-text">For Translation</small>
											</div>
											<div class="input-field col s6">
												<label for="proofreading_ppw">Proofreading</label>
												<input
												type="number" step="0.01" pattern="^\d*(\.\d{0,2})?$"
												value="{{ $dlp['proofreading_ppw'] }}" name="proofreading_ppw"
												id="proofreading_ppw-{{ $key }}"
												class="form-control"
												placeholder="For Proofreading"
												@if($dlp['proofreader'] != 1)
												disabled
												@endif
												/>
												<small style="position:relative; top:-5px;" class="black-text">For Proofreading</small>
											</div>
										</fieldset>



										<div class="row margin">
											<div style="display:none" class="col s12  mb-1  mt-1" id="editContract-{{ $key }}-progressBar">
												<div class="progress">
													<div class="indeterminate"></div>
												</div>
											</div>
											<div align="center" class="col s12  mb-1  mt-1" id="editContract-{{ $key }}-message">

											</div>
											<div align="left" class="input-field col s6">
												<a
												onclick="saveContract('editContract-'+`{{$key}}`, 0, `{{$dlp['document']}}`)"
												class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange"
												>
												<i class="material-icons left">save</i>Save Details
											</a>
										</div>
										<div align="right" class="input-field col s6">
											<a
											onclick="saveContract('editContract-'+`{{$key}}`, 1, `{{$dlp['document']}}`)"
											class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange"
											>
											<i class="material-icons left">mail_outline</i>Inform Translator
										</a>
									</div>
								</div>

							</div>
						</form>
					</span>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div> 
</form>
</div>
</li>
</ul>
</div>
</div>
@endsection
@push('css')
<style>
	.custom-pointer {
		cursor: pointer;
	}
	.red{
		color:red;
	}
	.custom-width{
		width:15%;
	}
	.case-slider__navigation {
		width: 100%;
	}
	.prev {
		float: left;
	}
	.next {
		float: right;
	}
	h5 {
		margin: 0px;
	}
</style>
@endpush

@push('js')

<script type="text/javascript">
	
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

	
	function removeLanguageRow(lang){
		$('#lang-row-'+lang.value).remove();
		$('#lang-'+lang.value).remove();  
	}
	
	function showDocumentModal(str){
		var data = str.split(",");
		var docUcode = data[0] ? data[0] : '';
		var name = data[1] ? data[1] : '';
		var docColName = data[2].replace(/'/g,'');
		var docStatus = data[4] == 1 ? 'Approved!' : 'Rejeced!';
		var docType = data[5] ? data[5] : '';
		var docTableName = data[6].replace(/'/g,'');
		
		$("#name_single").html(name);
		$(".doc_status_single").html(docStatus);
		$("#doc_type_single").html(docType);
		
		var imageSrc = bURL+'storage/'+data[3].replace(/ /g,'');
		console.log(imageSrc);
		document.getElementById("imgSrc_single").setAttribute("src", imageSrc);
		$("#docUcode").val(docUcode);
		$("#docColName").val(docColName);
		$("#docTableName").val(docTableName);
		$("#docApproveFlag").val(docApproveFlag);
		$("#docImage").val(imageSrc);
		
	}
	
	function rejectThis(val){
		//$('#docApproveFlag').val(0);
		$('#docApproveFlag').val('reject');
		const form = document.querySelector('#updateDocument');
		var formData = new FormData(form);
		axios.post(bURL+'dashboard/translator/update-profile/document', formData, config)
		.then(function (res) {
			console.log(res);
			$('#dynamicDocStatus').html('<span class="red-text" >Rejected!</span>');
		})
		.catch(function (err) {
			console.log(err);            
		});          
	}

	function reloadThis(val){
		location.reload();
	}
	
	function approveThis(val){
		//alert(val);
		$('#docApproveFlag').val(1);
		const form = document.querySelector('#updateDocument');
		var formData = new FormData(form);
		axios.post(bURL+'dashboard/translator/update-profile/document', formData, config)
		.then(function (res) {
			console.log(res);
			$('#dynamicDocStatus').html('<span class="green-text" >Approved!</span>');
		})
		.catch(function (err) {
			console.log(err);            
		});          
	}
	
	
	function onDocumentChange(e) {
		let files = e.target.files || e.dataTransfer.files;
		if (!files.length) return;
		//this.uploadImage();
		createImage(files[0]);
		//this.uploadImage();
	}
	
	function createImage(file) {
		//this.uploadImage();
		let reader = new FileReader();
		let vm = this;
		reader.onload = e => {
			vm.document = e.target.result;
		};
		reader.readAsDataURL(file);
	}
	
	function saveContract(id, flag, oldDoc){
		
		var dynamicId = id;
		var dynamicFlag = flag;
		var oldDoc = oldDoc;
		//alert(oldDoc);
		$('#'+dynamicId+'-progressBar').css('display', 'block');
		const form = document.querySelector('#'+dynamicId);
		var formData = new FormData(form);
		formData.append('informFlag', dynamicFlag);
		formData.append('oldDoc', oldDoc);
		axios.post(bURL+'dashboard/translator/update-profile', formData, config)
		.then(function (res) {
			$('#'+dynamicId+'-progressBar').css('display', 'none');
			if(res.data.status === true){
				var msg = `<div class="card-alert card  lighten-5">
				<div class="card-content green-text">
				<p>Success! `+res.data.message+`</p>
				</div>
				</div>`;      
			}else{
				var msg = `<div class="card-alert card  lighten-5">
				<div class="card-content red-text">
				<p>Error! Have problem regarding save contarct info</p>
				</div>
				</div>`;
			}
			$('#'+dynamicId+'-message').html(msg);
			$('#'+dynamicId+'-message').empty().show().html(msg).delay(3000).fadeOut(300);
		})
		.catch(function (err) {
			$('#'+dynamicId+'-progressBar').css('display', 'none');
			console.log(err.response.data.errors.document[0]);        

			var msg = `<div class="card-alert card  lighten-5">
			<div class="card-content red-text">
			<p>Error! `+err.response.data.errors.document[0]+`</p>
			</div>
			</div>`;
			
			$('#'+dynamicId+'-message').html(msg);
			$('#'+dynamicId+'-message').empty().show().html(msg).delay(3000).fadeOut(300);    
		});
		
	}
	
	
	$(() => {

		 //customeAction1(1, 2);

		//var dynamicId = 0;
		
		
		
		var token = document.head.querySelector('meta[name="csrf-token"]');
		const config = {
			headers: { 
				'X-CSRF-TOKEN': token.content,
				'content-type': 'multipart/form-data'
			}
		}
		
		
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
		
		$('#next3').on('click', function(){
			$('#li3').removeClass('active');
			$('#li3child').css({'display': 'none'});
			$('#li4').addClass('active');
			$('#li4child').css({'display': 'block'});
		});
		
		$('#next4').on('click', function(){
			$('#li4').removeClass('active');
			$('#li4child').css({'display': 'none'});
			$('#li5').addClass('active');
			$('#li5child').css({'display': 'block'});
		});
		
		$('#next5').on('click', function(){
			$('#li5').removeClass('active');
			$('#li5child').css({'display': 'none'});
			$('#li6').addClass('active');
			$('#li6child').css({'display': 'block'});
		});
		
		$('#next6').on('click', function(){
			$('#li6').removeClass('active');
			$('#li6child').css({'display': 'none'});
			$('#li7').addClass('active');
			$('#li7child').css({'display': 'block'});
		});
		
		$('#next7').on('click', function(){
			$('#li7').removeClass('active');
			$('#li7child').css({'display': 'none'});
			$('#li8').addClass('active');
			$('#li8child').css({'display': 'block'});
		});
		
		$('#next8').on('click', function(){
			$('#li8').removeClass('active');
			$('#li8child').css({'display': 'none'});
			$('#li9').addClass('active');
			$('#li9child').css({'display': 'block'});
		});
		
		$('#next9').on('click', function(){
			$('#li9').removeClass('active');
			$('#li9child').css({'display': 'none'});
			$('#li10').addClass('active');
			$('#li10child').css({'display': 'block'});
		});
		
		/* Edit Contracts */ 
		$('#next110').on('click', function(){
			$('#li110').removeClass('active');
			$('#li110child').css({'display': 'none'});
			$('#li100').addClass('active');
			$('#li100child').css({'display': 'block'});
		});
		
		$('#next111').on('click', function(){
			$('#li111').removeClass('active');
			$('#li111child').css({'display': 'none'});
			$('#li110').addClass('active');
			$('#li110child').css({'display': 'block'});
		});
		
		$('#next112').on('click', function(){
			$('#li112').removeClass('active');
			$('#li112child').css({'display': 'none'});
			$('#li110').addClass('active');
			$('#li110child').css({'display': 'block'});
		});
		
		$('#next113').on('click', function(){
			$('#li113').removeClass('active');
			$('#li113child').css({'display': 'none'});
			$('#li120').addClass('active');
			$('#li120child').css({'display': 'block'});
		});
		
		$('#next114').on('click', function(){
			$('#li114').removeClass('active');
			$('#li114child').css({'display': 'none'});
			$('#li130').addClass('active');
			$('#li130child').css({'display': 'block'});
		});
		
		$('#next115').on('click', function(){
			$('#li115').removeClass('active');
			$('#li115child').css({'display': 'none'});
			$('#li140').addClass('active');
			$('#li140child').css({'display': 'block'});
		});
		
		$('#next116').on('click', function(){
			$('#li116').removeClass('active');
			$('#li116child').css({'display': 'none'});
			$('#li150').addClass('active');
			$('#li150child').css({'display': 'block'});
		});
		
		$('#next117').on('click', function(){
			$('#li117').removeClass('active');
			$('#li117child').css({'display': 'none'});
			$('#li160').addClass('active');
			$('#li160child').css({'display': 'block'});
		});
		
		
		document.getElementById('personalInformation').addEventListener('submit', function(e){
			e.preventDefault();
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
				console.log(res.data.message);
				if(res.data.message === true){
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content green-text">
					<p>Success! Profile data saved successfuly</p>
					</div>
					</div>`;      
				}else{
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content red-text">
					<p>Error! Have problem regarding save profile data</p>
					</div>
					</div>`;
				}
				$('#messagePersonalInformation').html(msg);
				$('#messagePersonalInformation').empty().show().html(msg).delay(3000).fadeOut(300);
			})
			.catch(function (err) {
				console.log(err);            
			});          
		});
		
		
		document.getElementById('skills-language-proficiency').addEventListener('submit', function(e){
			e.preventDefault();
			const form = document.querySelector('#skills-language-proficiency');
			var formData = new FormData(form);
			axios.post(bURL+'dashboard/translator/update-profile', formData, config)
			.then(function (res) {
				console.log(res.data.message);
				if(res.data.message === true){
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content green-text">
					<p>Success! Language proficiency data saved successfuly</p>
					</div>
					</div>`;      
				}else{
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content red-text">
					<p>Error! Have problem regarding save language proficiency</p>
					</div>
					</div>`;
				}
				$('#messageSkillsLanguageProficiency').html(msg);
				$('#messageSkillsLanguageProficiency').empty().show().html(msg).delay(3000).fadeOut(300);
			})
			.catch(function (err) {
				console.log(err);            
			});          
		});
		
		
		document.getElementById('skills-subject-matter-expertise').addEventListener('submit', function(e){
			e.preventDefault();
			const form = document.querySelector('#skills-subject-matter-expertise');
			var formData = new FormData(form);
			axios.post(bURL+'dashboard/translator/update-profile', formData, config)
			.then(function (res) {
				console.log(res.data);
				if(res.data.message === true){
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content green-text">
					<p>Success! Subject matter expertise data saved successfuly</p>
					</div>
					</div>`;      
				}else{
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content red-text">
					<p>Error! Have problem regarding save subject matter expertise</p>
					</div>
					</div>`;
				}
				$('#messageSkillsSubjectMatterExpertise').html(msg);
				$('#messageSkillsSubjectMatterExpertise').empty().show().html(msg).delay(3000).fadeOut(300);
			})
			.catch(function (err) {
				console.log(err);            
			});          
		});
		
		
		document.getElementById('skills-software-and-tools').addEventListener('submit', function(e){
			e.preventDefault();
			const form = document.querySelector('#skills-software-and-tools');
			var formData = new FormData(form);
			axios.post(bURL+'dashboard/translator/update-profile', formData, config)
			.then(function (res) {
				console.log(res.data.message);
				if(res.data.message === true){
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content green-text">
					<p>Success! Software and tools saved successfuly</p>
					</div>
					</div>`;      
				}else{
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content red-text">
					<p>Error! Have problem regarding save software and tools</p>
					</div>
					</div>`;
				}
				$('#messageSkillsSoftwareAndTools').html(msg);
				$('#messageSkillsSoftwareAndTools').empty().show().html(msg).delay(3000).fadeOut(300);
			})
			.catch(function (err) {
				console.log(err);            
			});          
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
					document.getElementById(el + '_error').textContent = 'Required!!!';
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
				console.log(res.data.message);
				if(res.data.message === true){
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content green-text">
					<p>Success! Identification information data saved successfuly</p>
					</div>
					</div>`;      
				}else{
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content red-text">
					<p>Error! Have problem regarding save identification information</p>
					</div>
					</div>`;
				}
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
			//var names = ['work_experience'];
			//var names = ['work_experience', 'proof_of_experience'];
			var names = [];
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
				}else{
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content red-text">
					<p>Error! Have problem regarding save work history</p>
					</div>
					</div>`;
				}
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
				}else{
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content red-text">
					<p>Error! Have problem regarding save your availability</p>
					</div>
					</div>`;
				}
				$('#messagePdWorkSchedule').html(msg);
				$('#messagePdWorkSchedule').empty().show().html(msg).delay(3000).fadeOut(300);
			})
			.catch(function (err) {
				console.log(err);            
			});          
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
				}else{
					var msg = `<div class="card-alert card  lighten-5">
					<div class="card-content red-text">
					<p>Error! Have problem regarding save your banking information </p>
					</div>
					</div>`;
				}
				$('#messagePMBankingInformation').html(msg);
				$('#messagePMBankingInformation').empty().show().html(msg).delay(3000).fadeOut(300);
			})
			.catch(function (err) {
				//console.log(err);       

				console.log(err.response.data);        

				var msg = `<div class="card-alert card  lighten-5">
				<div class="card-content red-text">
				<p>Error! `+err.response.data.errors.proof_of_bank[0]+`</p>
				</div>
				</div>`;
				
				$('#messagePMBankingInformation').html(msg);
				$('#messagePMBankingInformation').empty().show().html(msg).delay(3000).fadeOut(300);               
			});          
		});
		
		$('.test').on('change', () => {
			$('#updateFlag').val(1);
		});
		$('.test1').on('change', () => {
			$('#updateFlag').val(0);
		});



		
		$('#languages').on('change', () => {
			var myStr = $('#languages').val();
			var language_count = $('#language_count').val();
			language_count++;   
			$('#language_count').val(language_count);
			var lang_val = language_count - 1;
			sessionStorage.setItem('langRow', myStr);
			var myStr = sessionStorage.getItem('langRow');
			$('#myLangs').append(`<label id="lang-`+myStr+`">
				<input style="position: relative; right: 20px;" class="form-check-input" type="checkbox" name="language" id="language1" checked onChange="removeLanguageRow(`+myStr+`)">
				<span>`+myStr+`</span>
				</label>`);
			
			
			$('#tableHeading').append(`
				<tr data-language="`+myStr+`" id="lang-row-`+myStr+`">
				<td class="custom-width">`+myStr+`</td>
				<td class="custom-width">
				<p>
				<label>
				<input name="lang_`+lang_val+`" value="`+myStr+`_0" type="radio" checked>
				<span></span>
				</label>
				</p>
				</td>
				<td class="custom-width">
				<p>
				<label>
				<input name="lang_`+lang_val+`" value="`+myStr+`_1" type="radio" >
				<span></span>
				</label>
				</p>
				</td>
				<td class="custom-width">
				<p>
				<label>
				<input name="lang_`+lang_val+`" value="`+myStr+`_2" type="radio" >
				<span></span>
				</label>
				</p>
				</td>
				<td class="custom-width">
				<p>
				<label>
				<input name="lang_`+lang_val+`" value="`+myStr+`_3" type="radio" >
				<span></span>
				</label>
				</p>
				</td>
				<td class="custom-width">
				<p>
				<label>
				<input name="lang_`+lang_val+`" value="`+myStr+`_4" type="radio" >
				<span></span>
				</label>
				</p>
				</td>
				<td class="custom-width">
				<p>
				<label>
				<input name="lang_`+lang_val+`" value="`+myStr+`_5" type="radio" >
				<span></span>
				</label>
				</p>
				</td>
				</tr>
				`);  
		});

		
		
	});


	

		


	

function customeAction1(val, key){
	
	var contract_type = val;
	var proofreader = $('#proofreader-'+key).is(":checked");


	var fixed_rate = $('#fixed_rate-'+key);

	var translation_wc = $('#translation_wc-'+key);
	var proofreading_wc = $('#proofreading_wc-'+key);

	var translation_ppw = $('#translation_ppw-'+key);
	var proofreading_ppw = $('#proofreading_ppw-'+key);




	if(contract_type == 'inhouse' && proofreader == true){
		fixed_rate.prop("disabled", false);
		
		translation_wc.prop("disabled", false);
		translation_ppw.prop("disabled", false);

		proofreading_wc.prop("disabled", false);
		proofreading_ppw.prop("disabled", false);

	}else if(contract_type != 'inhouse' && proofreader == true){
		
		fixed_rate.prop("disabled", true);
		
		translation_wc.prop("disabled", true);
		translation_ppw.prop("disabled", false);

		proofreading_wc.prop("disabled", true);
		proofreading_ppw.prop("disabled", false);
		
	}else if(contract_type == 'inhouse' && proofreader == false){
		
		fixed_rate.prop("disabled", false);
		
		translation_wc.prop("disabled", false);
		translation_ppw.prop("disabled", false);

		proofreading_wc.prop("disabled", true);
		proofreading_ppw.prop("disabled", true);
		
	}else if(contract_type != 'inhouse' && proofreader == false){
		
		fixed_rate.prop("disabled", true);
		
		translation_wc.prop("disabled", true);
		translation_ppw.prop("disabled", false);

		proofreading_wc.prop("disabled", true);
		proofreading_ppw.prop("disabled", true);
		
	}







};

function customeAction2(val, key){
	var proofreader = val;
	//alert(val);
	var contract_type = $('#contract_type-'+key).val();

	var fixed_rate = $('#fixed_rate-'+key);

	var translation_wc = $('#translation_wc-'+key);
	var proofreading_wc = $('#proofreading_wc-'+key);

	var translation_ppw = $('#translation_ppw-'+key);
	var proofreading_ppw = $('#proofreading_ppw-'+key);




	if(contract_type == 'inhouse' && proofreader == true){
		fixed_rate.prop("disabled", false);
		
		translation_wc.prop("disabled", false);
		translation_ppw.prop("disabled", false);

		proofreading_wc.prop("disabled", false);
		proofreading_ppw.prop("disabled", false);

	}else if(contract_type != 'inhouse' && proofreader == true){
		
		fixed_rate.prop("disabled", true);
		
		translation_wc.prop("disabled", true);
		translation_ppw.prop("disabled", false);

		proofreading_wc.prop("disabled", true);
		proofreading_ppw.prop("disabled", false);
		
	}else if(contract_type == 'inhouse' && proofreader == false){
		
		fixed_rate.prop("disabled", false);
		
		translation_wc.prop("disabled", false);
		translation_ppw.prop("disabled", false);

		proofreading_wc.prop("disabled", true);
		proofreading_ppw.prop("disabled", true);
		
	}else if(contract_type != 'inhouse' && proofreader == false){
		
		fixed_rate.prop("disabled", true);
		
		translation_wc.prop("disabled", true);
		translation_ppw.prop("disabled", false);

		proofreading_wc.prop("disabled", true);
		proofreading_ppw.prop("disabled", true);
		
	}


};






</script>
@endpush      