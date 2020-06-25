@extends('layouts.user')
@section('content')
<div class="container  mb-5">
<div class="row">
<div class="col s12 m12 l12">
@if(Auth::user()->profile->personal_information_flag != 1)
<div class="card-alert card gradient-45deg-amber-amber">
<div class="card-content white-text">
<p>
<i class="material-icons">warning</i> WARNING : Please Complete you personal Information first!!!</p>
</div>
</div>
@endif
<div class="card subscriber-list-card animate  fadeUp">
<div class="card-content pb-1">
<h4 class="card-title mb-0">My Test List <i class="material-icons float-right"><button type="button" id="confirm-box1"  class="waves-effect waves-light btn gradient-45deg-red-pink">Evaluation Criteria</button>

<!-- <a onclick="window.location.href=this" title="Refresh" style="float:right; cursor: pointer;"><i class="material-icons">refresh</i></a> -->

</i></h4>
</div>
<table class="subscription-table responsive-table highlight">
<thead>
<tr>
<th>Title</th>
<th>Source</th>
<th>Target</th>
<th>Duration</th>
<th>Status</th>
<th>Test Score</th>
<th class="right-align">Action</th>
</tr>
</thead>
<tbody>
@foreach ($myAllPossibleTests as $key => $tests)
@php
$arr = explode('-', $key);
$lpStr =  $arr[0] .' to '.$arr[1];
$lpStrForEnableDisable = $arr[0] .'-'.$arr[1];
$showFlag = DB::table('language_pairs')->where('ucode', Auth::user()->ucode)->where('flag', 'language-pair')->where('name', $lpStrForEnableDisable)->first();
$testsShowFlag = $showFlag->showTest;
@endphp
<tr>
<th align="center" colspan="7" style="padding-left: 20px;"><strong>{{ $lpStr }}</strong>
<!-- <label id="myLangs" style="position: relative; top: 8px;" >
<input style="position: relative; right: 20px;" class="form-check-input" data-aaa="{{ $lpStrForEnableDisable }}" type="checkbox" @if($testsShowFlag == 1) checked @endif>
<span  data-aaa="{{ $lpStrForEnableDisable }}" class="enDis"></span>
</label> -->
</th>
</tr> 

@foreach ($tests as $test)
<!-- <tr class="@if($testsShowFlag == 0) {{ $lpStrForEnableDisable }} cusHide  @else {{ $lpStrForEnableDisable }}  @endif"> -->
<tr>
<td>{{ $test->title }}</td>
<td>{{ $test->source_language }}</td>
<td>{{ $test->target_language }}</td>
<td>{{ $test->test_duration }} (min.)</td>
@php
$test_attempt = DB::table('test_attempt')->where('lang_pair', $key)->where('ucode', $ucode)->where('test_id', $test->id)->first();
$lang_pairs = DB::table('language_pairs')->where('flag', 'language-pair')->where('name', $key)->where('ucode', $ucode)->first();
@endphp
<td>
@if($test_attempt && $test_attempt->test_ended_at != null)
<span class="badge green lighten-5 blue-text text-accent-4">Complete</span>
@else 
<span class="badge red lighten-5 blue-text text-accent-4">Pending</span> 
@endif
</td>
<td>
@if($test_attempt && $test_attempt->test_result != null)
<span class="badge green lighten-5 blue-text text-accent-4">{{ json_decode( $test_attempt->test_result, true )['total_score'] ?? 0 }}</span>
@else
<span class="badge green lighten-5 blue-text text-accent-4">-</span>
@endif

</td>
<td class="right-align">
@if($test_attempt && $test_attempt->test_ended_at != null )
<a  href="{{ route('dashboard.translator.showUserTestSingle', [$key, base64_encode($test->id) ]) }}">View Test</a>
@else
<a class="test-link" onclick="return goToTestLink(`{{ route('dashboard.translator.showUserTestSingle', [$key, base64_encode($test->id)]) }}, {{ $test->test_duration }}`);"  href="javascript:;">Start test</a>
@endif
</td>
</tr>
@endforeach
@endforeach
</tbody>
</table>
</div>
<div class="animate  fadeUp">
@if(Auth::user()->profile->profile_dlp_status >= 5) 
<a  class="waves-effect waves-dark btn btn-sm btn-primary customHidden left mb-4" type="button" href="/dashboard/translator/my-profile/professional-details" 
>Next</a>
@else
<a  class="waves-effect waves-dark btn btn-sm btn-primary customHidden left mb-4" type="button" href="javascript:;"  disabled
>Next</a>
@endif 
</div>
</div>

<div id="modal6" class="modal bottom-sheet modal-content mt-n4" style=" height: 900px;">
<div id="responsive-table " class="card card card-default scrollspy">
<div class="card-content">
<h4 class="card-title">Evaluation Criteria <i class="material-icons right-align right modal-close">clear</i></h4>
<div class="row">
<div class="col s12">
<table class="black-text">
<thead>
<tr>
<th width="10%" data-field="id">Criteria</th>
<th width="55%" data-field="name">Explanation and deductible items</th>
<th width="5%" data-field="price">Score</th>
<th width="30%" data-field="total">For each mistake in any of the items under the criteria (designed for a text of 300-400 words)</th>
</tr>
</thead>
<tbody>
<tr>
<td>Semantics</td>
<td>The translator is able to convey the full meaning of SL into TL (no deletion, no addition, no change of meaning, no ambiguity.) Interpretation of TL is the same as that of SL.</td>
<td><b>150</b></td>
<td>Deduct 10 for each mistake.</td>
</tr>
<tr>
<td>Terminology</td>
<td>
<b>1)</b> Correct usages and choices of words as to convey the meaning correctly (ex: boy, man, male)<br/>
<b>2)</b> No lexical ambiguity<br/>
<b>3)</b> Using correct jargons when necessary that fit the context and the audience
</td>
<td><b>50</b></td>
<td>Deduct 5 for each mistake.</td>
</tr>
<tr>
<td>Syntax</td>
<td>- Correct and clear usage of:<br/>
<b>1)</b> Grammar (tenses, conditionality, modality.etc.)<br/>
<b>2)</b> Spelling, especially for Arabic: (lam Shamsia wal kamaria, ha’a wat aa marbota, tanween)<br/>
<b>3)</b> Punctuation<br/>
<b>4)</b> Sentence structure:<br/>
<b>a)</b> Making sure that there is no ambiguity in sentence structure<br/>
<b>b)</b> Using correct sentence structure in Arabic (like using verbal sentences whenever suitable)
<b>c)</b>Correct conjunctions</td>
<td><b>150</b></td>
<td>Deduct 10 for each
mistake. (if mistakes
are within the same
category, consider it
one)</td>
</tr>
<tr>
<td>Stylistic quality</td>
<td>
<b>1)</b> Suitable expressions<br/>
<b>2)</b> Correct usage of translation methods (literal, semantic..)<br/>
<b>3)</b> Correct usage of numbering and equivelances in Arabic (Abjad Hawaz) and text/slide direction<br/>
<b>4)</b> No repetition<br/>
<b>5)</b> Translation fits culture and audience (expert/inexpert). Marks will be deducted for expressions, terms, or style not suitable for the audience or culture.</td>
<td><b>100</b></td>
<td>Deduct 5 for each mistake. (if mistakes are within the same category, consider it one)</td>
</tr>
<tr>
<td>Stylistic beauty and cultural style</td>
<td>
- Beauty of text such as:<br/>
<b>1)</b> Text coherence, and connection of ideas<br/>
<b>2)</b> Readability and clarity<br/>
<b>3)</b> The translation sounds authentic in TL.<br/>
<b>4)</b> Style of translation fits the context (media,
legal. etc.)</td>
<td><b>50</b></td>
<td>Subjective evaluation</td>
</tr>
<tr>
<td colspan="4"><b>Total: 500</b></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<div id="modal2" class="modal">
<div class="modal-content">
<h4 align="center"><strong>Instructions</strong></h4>
<p align="justify"><strong>1. Duration of the test is 120 minutes or 2 hours from the moment of commencement. Once you start the test, the timer will start countdown and can not be reset.</strong></p>
<p align="justify"><strong>2. Once the test has begun, you are required to take the complete test. In case you leave the test without submitting, you shall be required to take the whole test again.</strong></p>
<p align="justify"><strong>3. A complete verification of personnel details shall be done by the ArabEasy team and only the individual who wishes to join ArabEasy shall take the test.</strong></p>
<p align="justify"><strong>4. Use of internet and obtaining any form of help from outside sources such as friends, family or vendors is not permissible.</strong></p>
</div>
<div class="modal-footer">
<a id="dynamicLink" href="javascript:;" class="modal-action waves-effect waves-green btn-flat">Start test now</a>
<a  href="javascript:;" class="modal-action modal-close waves-effect waves-red btn-flat ">Take later</a>
</div>
</div>
</div>
@endsection
@push('css')
<style>
.cusHide{
	display:none;
}
.modal.bottom-sheet {
	max-height: 90%;
}
</style>
@endpush
@push('js')
<script>

// function preventBack() { 
// 	alert(1);
// 	//window.history.forward(); 
// }
// setTimeout("preventBack()", 10);
// window.onunload = function () {
// 	alert(window.history());
// 	//alert(1);
// 	 null 
// };



function goToTestLink(link, test_duration){
	var piFlag = `{{ Auth::user()->profile->personal_information_flag }}`;
	// var piFlag = `{{ Auth::user()->profile->personal_information_flag }}`;
	// var piFlag = `{{ Auth::user()->profile->personal_information_flag }}`;
	// var piFlag = `{{ Auth::user()->profile->personal_information_flag }}`;

	if(piFlag != 1){
		window.location.href = '/dashboard/translator/my-profile/personal-information';
	}
	var str = link;
	var dynamicData = str.split(",");
	var dynamicLink = dynamicData[0];
	localStorage.setItem('t_id', dynamicLink.substring(dynamicLink.length - 4, dynamicLink.length));
	document.getElementById("dynamicLink").href=dynamicLink; 
	$("#modal2").modal('open', {
		dismissible: false,
	});  
}

$(() => {
	
	
	// if (sessionStorage.getItem('isLoaded') !== 'yes') {
		//   sessionStorage.setItem('isLoaded', 'yes');
		//   location.reload(true);
		// } 
		//$('#userFinalStatus').html(`Status : {{ $status ??  Auth::user()->profile->finalStatus }}`);
		$('#confirm-box1').on('click', () => {
			$("#modal6").modal('open', {
				dismissible: false,
			});
		});
	});
	</script>
	@endpush