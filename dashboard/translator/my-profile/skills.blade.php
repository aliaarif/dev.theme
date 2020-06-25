@extends('layouts.user')
@section('content')
@php 
$ucode = Request::segment(5) ?? Auth::user()->ucode;
$user_id = Request::segment(6) ?? Auth::id();
$profile = App\Profile::where('ucode', $ucode)->first();
$skills_language_proficiency_flag = ' &nbsp; <span id="skills_language_proficiency_flag" style="color:red"> ( Information
to be filled )</span>';
$skills_subject_matter_expertise_flag = ' &nbsp; <span id="skills_subject_matter_expertise_flag" style="color:red"> ( Information
to be filled )</span>';
$skills_software_and_tools_flag = ' &nbsp; <span id="skills_software_and_tools_flag" style="color:red"> ( Information
to be filled )</span>';
if($profile->skills_language_proficiency_flag == 1){
	$skills_language_proficiency_flag = ' &nbsp; <span id="skills_language_proficiency_flag" style="color:green"> ( Information filled )</span>';
}
if($profile->skills_subject_matter_expertise_flag == 1){
	$skills_subject_matter_expertise_flag = ' &nbsp; <span id="skills_subject_matter_expertise_flag" style="color:green"> ( Information filled )</span>';
}
if($profile->skills_software_and_tools_flag == 1){
	$skills_software_and_tools_flag = ' &nbsp; <span id="skills_software_and_tools_flag" style="color:green"> ( Information filled )</span>';
}
@endphp
<div id="popout" class=" mb-5  animate fadeUp">
<div class="col s12">
<p class="ml-2" align="justify">Manage your skills.</p>
</div>
<div class="col s12">
<ul class="collapsible popout">
<li id="li1">
<div class="collapsible-header" tabindex="0"><i class="material-icons">filter_drama</i>Language Proficiency {!! $skills_language_proficiency_flag !!}</div>
<div class="collapsible-body" id="li1child">
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
<?php 
$languageArr = [];

?>
@foreach($languages as $language)

<?php
array_push($languageArr, $language->name);
?>

<label id="myLangs" style="position: relative; top: -15px;">
<input style="position: relative; right: 20px;" class="filled-in" type="checkbox" value="{{ $language->name }}" name="language" id="language" checked {{ $language->name == 'Arabic' || $language->name == 'English' || $language->name == 'Hindi' || $language->name == 'Chinese' || $language->name == 'Japanese' || $language->name == 'Russian' || $language->name == 'Spanish' || $language->name == 'French' || $language->name == 'German' ? 'disabled' : '' }}>
<span>{{ $language->name }}</span>
</label>

@endforeach


<div class="input-field col m12 s12 mt-2">
<select id="languages" name="languages">
<option  disabled selected>---Choose One---</option>
@if(!in_array('Hindi', $languageArr))
<option id="Hindi" value="Hindi">Hindi</option>
@endif

@if(!in_array('Chinese', $languageArr))
<option id="Chinese" value="Chinese">Chinese</option>
@endif

@if(!in_array('Japanese', $languageArr))
<option id="Japanese" value="Japanese">Japanese</option>
@endif

@if(!in_array('Russian', $languageArr))
<option id="Russian" value="Russian">Russian</option>
@endif

@if(!in_array('Spanish', $languageArr))
<option id="Spanish" value="Spanish">Spanish</option>
@endif

@if(!in_array('French', $languageArr))
<option id="French" value="French">French</option>
@endif
@if(!in_array('German', $languageArr))
<option id="German" value="German">German</option>
@endif

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

<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next1" type="submit" >Next</button>

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
<li id="li2" >
<div class="collapsible-header" tabindex="0"><i class="material-icons">radio_button_checked</i>Subject Matter Expertise {!! $skills_subject_matter_expertise_flag !!}</div>
<div class="collapsible-body" id="li2child">
<span>

{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'skills-subject-matter-expertise', 'name' => 'skills-subject-matter-expertise')) }}
@csrf

<input type="hidden" name="form_type" value="skills-subject-matter-expertise">
<input type="hidden" name="ucode" value="{{ Request::segment(5) ?? Auth::user()->ucode }}">
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
<td class="custom-width">Legal</td>
<td class="custom-width">
<p>
<label>
<input name="legal" value="1" type="radio">
<span></span>
</label>
</p>
</td>
<td class="custom-width">
<p>
<label>
<input name="legal" value="2" type="radio"  >
<span></span>
</label>
</p>
</td>
<td class="custom-width">
<p>
<label>
<input name="legal" value="3" type="radio">
<span></span>
</label>
</p>
</td>
<td class="custom-width">
<p>
<label>
<input name="legal" value="4" type="radio" >
<span></span>
</label>
</p>
</td>
<td class="custom-width">
<p>
<label>
<input name="legal" value="5" type="radio" >
<span></span>
</label>
</p>
</td>
</tr>

<tr>
<td class="custom-width">Sports</td>
<td class="custom-width">
<p>
<label>
<input name="sports" value="1" type="radio"  >
<span></span>
</label>
</p>
</td>
<td class="custom-width">
<p>
<label>
<input name="sports" value="2" type="radio"  >
<span></span>
</label>
</p>
</td>
<td class="custom-width">
<p>
<label>
<input name="sports" value="3" type="radio">
<span></span>
</label>
</p>
</td>
<td class="custom-width">
<p>
<label>
<input name="sports" value="4" type="radio" >
<span></span>
</label>
</p>
</td>
<td class="custom-width">
<p>
<label>
<input name="sports" value="5" type="radio" >
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
<td class="custom-width">Business</td>
<td class="custom-width">
<p>
<label>
<input name="business" value="1" type="radio" >
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
<td class="custom-width">Technology</td>
<td class="custom-width">
<p>
<label>
<input name="technology" value="1" type="radio" >
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

<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" id="next2" type="submit" >Next</button>

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
<li id="li3">
<div class="collapsible-header" tabindex="0"><i class="material-icons">whatshot</i>Software And Tools {!! $skills_software_and_tools_flag !!}</div>
<div class="collapsible-body" id="li3child">
<span>

{{ Form::open(array('url' => route('dashboard.translator.updateProfile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'skills-software-and-tools', 'name' => 'skills-software-and-tools')) }}
@csrf


<input type="hidden" name="form_type" value="skills-software-and-tools">
<input type="hidden" name="ucode" value="{{ Request::segment(5) ?? Auth::user()->ucode }}">
<div class="step-content">
<div class="row">
<div class="input-field col m3 s12">
<div class="step-title waves-effect">CAT Tools </div>
<p>
<label>
<input class="filled-in" type="checkbox" name="cat_tool_MemoQ" id="cat_tool_MemoQ" value="{{ $profile->cat_tool_MemoQ ? 1 : 0 }}"   {{ $profile->cat_tool_MemoQ ? 'checked' : '' }}>
<span>MemoQ</span>
</label>
</p>
<p>
<label>
<input class="filled-in" type="checkbox" name="cat_tool_sds_trados" id="cat_tool_sds_trados" value="{{ $profile->cat_tool_sds_trados ? 1 : 0 }}"   {{ $profile->cat_tool_sds_trados ? 'checked' : '' }}>
<span>SDS Trados</span>
</label>
</p>
<p>
<label>
<input class="filled-in" type="checkbox" name="cat_tool_other" id="cat_tool_other" value="{{ $profile->cat_tool_other ? 1 : 0 }}"   {{ $profile->cat_tool_other ? 'checked' : '' }}>
<span>Other</span>
</label>
</p>
</div>

<div class="input-field col m3 s12">
<div class="step-title waves-effect">MS Office Tools </div>
<p>
<label>
<input class="filled-in" type="checkbox" name="ms_office_tool_powerPoint" id="ms_office_tool_powerPoint" value="{{ $profile->ms_office_tool_powerPoint ? 1 : 0 }}"   {{ $profile->ms_office_tool_powerPoint ? 'checked' : '' }}>
<span>MS PowerPoint</span>
</label>
</p>
<p>
<label>
<input class="filled-in" type="checkbox" name="ms_office_tool_Word" id="ms_office_tool_Word" value="{{ $profile->ms_office_tool_Word ? 1 : 0 }}"   {{ $profile->ms_office_tool_Word ? 'checked' : '' }}>
<span>MS Word</span>
</label>
</p>
<p>
<label>
<input class="filled-in" type="checkbox" name="ms_office_tool_Excel" id="ms_office_tool_Excel" value="{{ $profile->ms_office_tool_Excel ? 1 : 0 }}"   {{ $profile->ms_office_tool_Excel ? 'checked' : '' }}>
<span>MS Excel</span>
</label>
</p>
<p>
<label>
<input class="filled-in" type="checkbox" name="ms_office_tool_Visio" id="ms_office_tool_Visio" value="{{ $profile->ms_office_tool_Visio ? 1 : 0 }}"   {{ $profile->ms_office_tool_Visio ? 'checked' : '' }}>
<span>MS Visio</span>
</label>
</p>

</div>
</div>
<!-- @include('common.wizbtns') -->
<div class="step-actions">
<div class="row" >
<div class="col s4  mb-3  mt-1" >
<button id="saveSkillsSoftwareAndToolsBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
type="submit">Save</button>
<button  class="waves-effect waves-dark btn btn-lg btn-primary customHidden" type="submit" onclick="goToLink(`{{ route('dashboard.translator.myprofile.evaluation') }}`)">Next</button>
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
</ul>
</div>
</div>
</p>
</div>
</form>
</div>
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

function removeLanguageRow(lang){
	$('#lang-row-'+lang.value).remove();
	$('#lang-'+lang.value).remove();  
}


function goToLink(link){
	//let link = link;
	window.location.href = link;
}

$(() => {
	//$('#userFinalStatus').html(`Status : {{ Auth::user()->profile->finalStatus }}`);
	var token = document.head.querySelector('meta[name="csrf-token"]');
	const config = {
		headers: { 
			'X-CSRF-TOKEN': token.content,
			'content-type': 'multipart/form-data'
		}
	}
	
	// var favorite = [];
	// $.each($("input[name='language']:checked"), function(){
		// 	favorite.push($(this).val());
		// });
		// var favorite1 = favorite;
		
		//alert("My favourite languages are: " + favorite.join(", "));
		
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
					$filled =  ' &nbsp; <span id="skills_language_proficiency_flag" style="color:green"> ( Information filled )</span>'; 
					
					//if(res.data.status == true){
						//let status = `{{ Session::put('finalStatus', 'Test Pending') }}`
						//localStorage.setItem('finalStatus', 'Test Pending');
						//$('#userFinalStatus').html('Status : Test Pending');
						//}
						
					}else{
						var msg = `<div class="card-alert card  lighten-5">
						<div class="card-content red-text">
						<p>Error! Have problem regarding save language proficiency</p>
						</div>
						</div>`;
						$filled =  ' &nbsp; <span id="skills_language_proficiency_flag" style="color:red"> ( Information to be filled )</span>'; 
					}
					$('#skills_language_proficiency_flag').html($filled);
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
						$filled =  ' &nbsp; <span id="skills_subject_matter_expertise_flag" style="color:green"> ( Information filled )</span>';    
						
						//if(res.data.status == true){
							//let status = `{{ Session::put('finalStatus', 'Test Pending') }}`
							//localStorage.setItem('finalStatus', 'Test Pending');
							//$('#userFinalStatus').html('Status : Test Pending');
							//}
						}else{
							var msg = `<div class="card-alert card  lighten-5">
							<div class="card-content red-text">
							<p>Error! Have problem regarding save subject matter expertise</p>
							</div>
							</div>`;
							$filled =  ' &nbsp; <span id="skills_subject_matter_expertise_flag" style="color:red"> ( Information to be filled )</span>'; 
						}
						$('#skills_subject_matter_expertise_flag').html($filled);
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
							$filled =  ' &nbsp; <span id="skills_software_and_tools_flag" style="color:green"> ( Information filled )</span>';      
							//if(res.data.status == true){
								//let status = `{{ Session::put('finalStatus', 'Test Pending') }}`
								//localStorage.setItem('finalStatus', 'Test Pending');
								//$('#userFinalStatus').html('Status : Test Pending');
								//}
							}else{
								var msg = `<div class="card-alert card  lighten-5">
								<div class="card-content red-text">
								<p>Error! Have problem regarding save software and tools</p>
								</div>
								</div>`;
								$filled =  ' &nbsp; <span id="skills_software_and_tools_flag" style="color:red"> ( Information to be filled )</span>'; 
							}
							$('#skills_software_and_tools_flag').html($filled);
							$('#messageSkillsSoftwareAndTools').html(msg);
							$('#messageSkillsSoftwareAndTools').empty().show().html(msg).delay(3000).fadeOut(300);
						})
						.catch(function (err) {
							console.log(err);            
						});          
					});
					
					$('#languages').on('change', () => {
						var myStr = $('#languages').val();
						var language_count = $('#language_count').val();
						// localStorage.setItem('language_count', language_count);
						// language_count = localStorage.getItem('language_count')
						language_count++;   
						$('#language_count').val(language_count);
						
						var lang_val = language_count - 1;
						//alert(lang_val);
						sessionStorage.setItem('langRow', myStr);
						var myStr = sessionStorage.getItem('langRow');
						$('#myLangs').append(`<label id="lang-`+myStr+`">
						<input style="position: relative; right: 20px;" class="filled-in" type="checkbox" name="language" id="language" checked onChange="removeLanguageRow(`+myStr+`)">
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
				</script>
				@endpush      