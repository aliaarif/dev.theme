@extends('layouts.user')
@section('content')
<?php $start_time = strtotime($test_exist->test_started_at);?>
<div id="attemptTestWrapper" class="col s12 m12 l12">
<div class="card subscriber-list-card animate  fadeUp">
<div class="card-content pb-1 customTestClass1">
@if(Session::has('success'))
{{ Session::get('success') }}
@elseif(Session::has('error'))
{{ Session::get('error') }}
@else
@endif
@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
{{ Form::open(array('url' => route('dashboard.translator.attemptTest'), 'files'=>'true', 'method'=>'post', 'id' => 'attemptTest', 'name' => 'attemptTest')) }}
@csrf
<input  type ="hidden" name="attempt_flag" value="{{ $test_attempt->attempt_flag ?? 0 }}">
<input  type ="hidden" name="test_id" value="{{ $test->id }}">
<input  type ="hidden" id="test_duration" name="test_duration" value="{{ $test_attempt->total_time ?? $test->test_duration }}">
<input  type ="hidden" id="dest_language" name="dest_language" value="{{ $test->target_language }}">
@if($test_exist->test_ended_at != null)  
<?php
$datetime1 = new DateTime($test_exist->test_started_at);
$datetime2 = new DateTime($test_exist->test_ended_at);
$interval = $datetime1->diff($datetime2);
//$time_taken =  $interval->format('%H:%i:%s');

?>

<div class="row">
<div class="input-field col m6 s12">
<select disabled >
<option  disabled selected>{{ $test->title }}</option>
</select>
<label>Test Title</label>
</div>
<div class="input-field col s6">
<label>Time Taken: H:M:S</label>
<input type="text" readonly value="{{ $interval->format('%H') }} Hour(s) and {{ $interval->format('%i') }} Minute(s)  and {{ $interval->format('%s') }} Second(s)" >
</div>
<div class="input-field col m6 s12">
<select disabled>
<option  disabled selected>{{ $test->source_language }}</option>
</select>
<label>Source Language</label>
</div>
<div class="input-field col m6 s12">
<select disabled>
<option  disabled selected>{{ $test->target_language }}</option>
</select>
<label>Target Language</label>
</div>
</div>


@else
<blockquote id="test_title" dir="ltr" lang="en">
{{ $test->title }}
<i id="modelInstructions" class="material-icons" style="position: relative; top: 5px; cursor: pointer;">info</i>
</blockquote>
@endif


@if($test_attempt == null) 
<div class="row">
<div class="col s6">
<h6 class="pl-2">Tests</h6>
<blockquote class="pl-2 pr-2 question blockquote-style" id="test_source_language" dir="{{ $test->source_language == 'English' ? 'ltr' : 'rtl' }}" lang="{{ $test->source_language == 'English' ? 'en' : 'ar' }}" >
<strong class="custom-strong">{!! html_entity_decode($test->description) !!}
</strong>  
</blockquote>
</div>
<div class="col s6">
<h6 class="pl-2">Answer</h6>
@if(!$test_exist->test_ended_at) 
@if(!$test_exist->test_ended_at )
<blockquote class="pl-2 pr-2 answer blockquote-style"   dir="{{ $test->target_language == 'English' ? 'ltr' : 'rtl' }}" lang="{{ $test->source_language == 'English' ? 'en' : 'ar' }}" >
@if($test_attempt != null)
<textarea class="customeAnswer" id="editor" name="ans_description"></textarea>

@else
{!! html_entity_decode($test_exist->answer) !!}

@endif
@else 
{!! html_entity_decode($test_exist->answer) !!}

@endif
</blockquote>
@else
<blockquote class="pl-2 pr-2 blockquote-style "  >
<strong>{!! html_entity_decode($test_exist->answer) !!}
</strong>
</blockquote>
@endif
</div> 
@else

<hr/>
<blockquote class="pl-2 pr-2 question " id="test_source_language" dir="{{ $test->source_language == 'English' ? 'ltr' : 'rtl' }}" lang="{{ $test->source_language == 'English' ? 'en' : 'ar' }}" >
<strong class="custom-strong">{!! html_entity_decode($test->description) !!}</strong>  
</blockquote>
<hr/>
@if(!$test_exist->test_ended_at) 
@if(!$test_exist->test_ended_at )
<blockquote class="pl-2 pr-2 answer "   dir="{{ $test->target_language == 'English' ? 'ltr' : 'rtl' }}" lang="{{ $test->source_language == 'English' ? 'en' : 'ar' }}" >
@if($test_attempt != null)
<textarea class="customeAnswer" id="editor" name="ans_description" ></textarea>
@else
{!! html_entity_decode($test_exist->answer) !!}
@endif
@else 
{!! html_entity_decode($test_exist->answer) !!}
@endif
</blockquote>
@else
<blockquote class="pl-2 pr-2 "  >
<strong>{!! html_entity_decode($test_exist->answer) !!}</strong>
</blockquote>
@endif
@endif





 

</div>

@if($test_attempt != null)
<div class="row">
<div class="input-field col s12">
@if(!$test_exist->test_ended_at) 
<button type="button" id="testSbmtBtn" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12 mb-1">Submit</button>
@endif
</div>
</div> 
<input type="hidden" name="lang_pair" value="{{ $test->source_language.'-'.$test->target_language }}">    
@endif

<hr/>
<?php
$lp = DB::table('language_pairs')
->where('ucode', Auth::user()->ucode)
->where('flag', 'language-pair')
->where('name', $test->source_language.'-'.$test->target_language)
->first();
$data = DB::table('test_attempt')->where('test_id', $test->id)->where('ucode', Auth::user()->ucode)->first();

if($data){
  $test_scores = json_decode($data->test_score, true);
  //$exp_test_scores = explode(',', $data->test_score);
  if($test_scores){?>
<div class="row">
<div class="input-field col s2">
<label>Syntax</label>
<input type="text" disabled value="{{ $test_scores['scores']['syntax'] ?? 0 }}" >
150
</div>

<div class="input-field col s2">
<label>Semantics</label>
<input type="text" disabled value="{{ $test_scores['scores']['semantics'] ?? 0 }}" >
150
</div>

<div class="input-field col s2">
<label>Terminology</label>
<input type="text" disabled value="{{ $test_scores['scores']['terminology'] ?? 0 }}" >
50
</div>

<div class="input-field col s3">
<label>Stylistic Beauty</label>
<input type="text" disabled value="{{ $test_scores['scores']['stylistic_beauty'] ?? 0 }}" >
50
</div>  

<div class="input-field col s3">
<label>Stylistic Quality</label>
<input type="text" disabled value="{{ $test_scores['scores']['stylistic_quality'] ?? 0 }}" >
100
</div>



</div>



    <div class="row">
    <div class="input-field col s12">
      <!-- <blockquote class="pl-2 pr-2" id="test_target_language" >
      <strong>   : {{ $lp->final_score ?? 0 }}/500</strong>
      <br/>
      Syntax: {{ $test_scores['scores']['syntax'] ?? 0 }}/150
      <br/>
      Semantics: {{ $test_scores['scores']['semantics'] ?? 0 }}/150
      <br/>
      Terminology: {{ $test_scores['scores']['terminology'] ?? 0 }}/50
      <br/>
      Stylistic Beauty: {{ $test_scores['scores']['stylistic_beauty'] ?? 0 }}/50
      <br/>
      Stylistic Quality: {{ $test_scores['scores']['stylistic_quality'] ?? 0 }}/100
      <br/>
      </blockquote> -->
    </div>
    </div> 
    <?php } } ?>
    <div id="modal2" class="modal">
    <div class="modal-content">
    <p align="center"><strong>You are trying to redirect to another screen but you have not submitted the test yet. If you proceed, you will be awarded a Zero score for this test.</strong></p>
    </div>
    <div class="modal-footer">
    <center>
    <a id="proceedBtn" href="javascript:;" class="modal-action waves-effect waves-green btn-flat">Proceed</a>
    <a  href="javascript:;" class="modal-action modal-close waves-effect waves-red btn-flat ">Cancel</a>
    </center>
    </div>
    </div>
    <div id="modal3" class="modal">
    <div class="modal-content">
    <h4 align="center"><strong>Instructions</strong></h4>
    <p align="justify"><strong>1. Duration of the test is 120 minutes or 2 hours from the moment of commencement. Once you start the test, the timer will start countdown and can not be reset.</strong></p>
    <!-- <p align="justify"><strong>2. Test duration: <span id="dynamicTestDuration">0</span> min.</strong></p> -->
    <p align="justify"><strong>2. Once the test has begun, you are required to take the complete test. In case you leave the test without submitting, you shall be required to take the whole test again.</strong></p>
    <p align="justify"><strong>3. A complete verification of personnel details shall be done by the ArabEasy team and only the individual who wishes to join ArabEasy shall take the test.</strong></p>
    <p align="justify"><strong>4. Use of internet and obtaining any form of help from outside sources such as friends, family or vendors is not permissible.</strong></p>
    </div>
    </div>
    </form>
    </div>
    <div id="modal4" class="modal" style="width:400px;">
    <div class="modal-content">
    <p align="center">
    <strong>
    Your test has been successfully submitted.<br/>
    You will receive the results of the test in 1 week.
    </strong>
    </p>
    </div>
    <div align="center" class="modal-footer">
    <center>
    <a style="text-align:center" id="testSbmtBtn2" href="javascript:;" class="modal-action waves-effect waves-green btn-flat">Ok</a>
    </center>
    </div>
    </div>
    </div>
    @endsection
    @push('css')
    <style>
    .marker{
      background-color: #FFFF00;
    }
    .custom-strong{
      font-weight:bold;
      font-size:16px;
    }
    .blockquote-style{
      /* border:1px solid #9c27b0; */
      border:0;
    }
    </style>
    @endpush
    @push('js')
 
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
    var token = document.head.querySelector('meta[name="csrf-token"]');
    const config = {
      headers: { 
        'X-CSRF-TOKEN': token.content,
        'content-type': 'multipart/form-data'
      }
    }


    function startTimer(duration, display) {
      var timer = duration, hours, minutes, seconds;
      var attempt_flag = `{{ $test_attempt->attempt_flag ?? 0}}`;
      if(attempt_flag >= 0){
        setInterval(function (attempt_flag) {
          seconds = timer;
          minutes = seconds / 60;
          hours = minutes / 60;
          hours = parseInt(hours);
          minutes = parseInt(minutes % 60);
          seconds = parseInt(seconds % 60);
          hours = hours < 10 ? "0" + hours : hours;
          minutes = minutes < 10 ? "0" +  minutes : minutes;
          seconds = seconds < 10 ? "0" +  seconds : seconds;
          display.text(hours + ":" + minutes + ":" + seconds);
          timer = timer - 1;
          if (timer <= 0 ) {
            const form = document.querySelector('#attemptTest');
            var formData = new FormData(form);
            axios.post(`{{ route('dashboard.translator.attemptTest') }}`, formData, config)
            .then(function (res) {
              $('.answer').remove();
              $('#testSbmtBtn').remove();
              $('.customeTimerOnHeader2').html('The Test is closed')
              $('.customeTimerOnHeader1').remove();
            })
            .catch(function (err) {
              console.log(err);            
            });   
          }
        }, 1000);
      }
    }
    function timeExe(){
      let test_id = `{{ $test->id }}`;
      if(localStorage.getItem('time') > 0 && localStorage.getItem('test_id') == test_id){
        $("#startTest").remove();
        localStorage.setItem('time', localStorage.getItem('time'));
        var time1 = localStorage.getItem('time'),
        display = $('#time');
        var attempt_status = `{{ $test_attempt->attempt_status ?? 'notDone'}}`;
        if(attempt_flag > 0 && attempt_flag == 1 && attempt_status != 'done'){
          startTimer(time1, display); 
        }
      }else if(localStorage.getItem('time') == 0){
        alert("Timeup! Test will be evaluated in X Time");
        $('#attemptTest').submit();
      }else{
        let time = `{{ $test_attempt->total_time ?? 60 * $test->test_duration }}`;
        localStorage.setItem('time', time);
      }
    }
    var setCkDefault = 'en';
    $(() => {
      $('#modelInstructions').on('click', () => {
        $("#modal3").modal('open', {
          dismissible: false,
        }); 
      });

  var a = `{{ Request::segment(3) }}`;
  var b = `{{ Request::segment(4) }}`;
  var c = `{{ Request::segment(5) }}`;
  var attempt_status = `{{ $test_attempt->attempt_status ?? '' }}`;

  if(a == 'test' && b != null && c != null && attempt_status == 'notDone' ){
    $('.custom-disabled-class').attr("href", 'javascript:;');
    window.history.pushState(null, "", window.location.href);        
      window.onpopstate = function() {
          window.history.pushState(null, "", window.location.href);
      };

  }
 

      $(document).click(function(event) {
        //event.prevent(); 
        $target = $(event.target);
        var attempt_flag = `{{ $test_attempt->attempt_flag ?? 0}}`;
        var attempt_status = `{{ $test_attempt->attempt_status ?? '' }}`;
        if(!$target.closest('#attemptTestWrapper').length && $('#attemptTestWrapper').is(":visible") && attempt_flag == 0 && attempt_status == 'notDone' ) {
          $("#modal2").modal('open', {
            dismissible: false,
          });
          $('#proceedBtn').on('click', () => {
            const form = document.querySelector('#attemptTest');
            var formData = new FormData(form);
            axios.post(`{{ route('dashboard.translator.attemptTest') }}`, formData, config)
            .then(function (res) {
              window.location.href = `{{ route('dashboard.translator.myprofile.evaluation') }}`;
            })
            .catch(function (err) {
              console.log(err);            
            });  
          })
        }        
      });
      
      var attempt_flag = `{{ $test_attempt->attempt_flag ?? 0 }}`;
      var attempt_status = `{{ $test_attempt->attempt_status ?? 'notDone'}}`;
      if(attempt_flag > 0 && attempt_flag == 1 && attempt_status == 'done'){
        $('#attemptTest').submit();
      }
      $('#testSbmtBtn2').on('click', () => {
        $('#attemptTest').submit();
      });
      $('#testSbmtBtn').on('click', () => {
        $("#modal4").modal('open', {
          dismissible: false,
        }); 
      });
      localStorage.setItem('time', localStorage.getItem('time'));
      var time1 = `{{ $test_attempt->total_time ?? 0 }}`,
      display = $('#time');
      if(attempt_status == 'notDone'){
        startTimer(time1, display);
      }
      var selLangValue = $( "#dest_language" ).val();
      if(selLangValue=="Arabic"){
        setCkDefault = "ar";
      }
      // At page startup, load the default language:
      createEditor(setCkDefault);
    });
    var editor;
    function createEditor( languageCode ) {
      if(languageCode=="Arabic"){
        languageCode = 'ar';
      }
      if ( editor )
      editor.destroy();
      editor = CKEDITOR.replace( 'editor', {
        language: languageCode,
        height: 200,
        on: {
          instanceReady: function () {
            var languages = document.getElementById('languages');
            languages.value = this.language;
            languages.disabled = false;
          }
        }
      });
    }
    </script>
    @endpush