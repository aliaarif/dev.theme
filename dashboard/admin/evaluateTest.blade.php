@extends('layouts.user')

@section('content')
<div class="row mb-10">
<div class="col s12  ">
<div class="card subscriber-list-card animate fadeUp">
<div class="card-content pb-1">
<h4 class="card-title mb-0">Evaluate Test</h4>
</div>

<div class="alert alert-success" role="alert">
@if(Session::has('success'))
{{ Session::get('success') }}
@elseif(Session::has('error'))
{{ Session::get('error') }}
@else
@endif
</div>


@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror

{{ Form::open(array('url' => route('dashboard.admin.submitEval'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'testevalForm', 'name' => 'testevalForm')) }}
@csrf


<?php
// echo '<pre>';
// print_r($userTestAttmpDetails);
// die;
?>


@foreach ($userTestAttmpDetails as $userTestAttmpDetail)

<div class="row margin">
<div class="input-field col s6">
<input id="title" type="text" value="{{ $userTestAttmpDetail->title ?? ''}}" class="form-control @error('title') is-invalid @enderror" name="title" required disabled="true">
@error('title')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="title">Test Title</label>
</div>

<div class="input-field col s6">
<label for="test_type">Time Taken</label>
<?php $expArrForDuration = explode(':', $duration); ?>
<label for="time_taken">Time Taken</label>
<input type="text" id="time_taken" value="{{  $duration ? $expArrForDuration[0] .' Hour(s) and '. substr($expArrForDuration[1], 0, 2) .' Minute(s)' : '00:00'  }}" >
</div>


</div>

<div class="row margin">
<div class="input-field col s6">
<!-- <i class="material-icons prefix pt-2">keyboard_arrow_right</i> -->
<select class="form-control{{ $errors->has('source_language') ? ' is-invalid' : '' }}" name="source_language" id="source_language"onchange="createEditor( this.value );" required disabled="true">
<option value=""></option>
<option value="English" {{ $userTestAttmpDetail->source_language=="English" ? "selected":""}}>English</option>
<option value="Arabic" {{ $userTestAttmpDetail->source_language=="Arabic" ? "selected":""}}>Arabic</option>
</select>
<label for="source_language">Source Language</label>
</div>
<div class="input-field col s6">
<!-- <i class="material-icons prefix pt-2">keyboard_arrow_left</i> -->
<select class="form-control{{ $errors->has('target_language') ? ' is-invalid' : '' }}" name="target_language" id="target_language" required disabled="true">
<option value=""></option>
<option value="English" {{ $userTestAttmpDetail->target_language=="English" ? "selected":""}}>English</option>
<option value="Arabic" {{ $userTestAttmpDetail->target_language=="Arabic" ? "selected":""}}>Arabic</option>
</select>
<label for="target_language">Target Language</label>
</div>

</div>

<div class="row">
<div class="col s6">
<h6 class="pl-2">Test Description</h6>

<blockquote class="pt-2 pr-2  pb-2 pl-2 blockquote-style" id="test_source_language" dir="{{ $userTestAttmpDetail->source_language == 'English' ? 'ltr' : 'rtl' }}" lang="{{ $userTestAttmpDetail->source_language == 'English' ? 'en' : 'ar' }}" >
<strong class="custom-strong">{!! html_entity_decode($userTestAttmpDetail->description) !!}</strong>  
</blockquote>
</div>

<div class="col s6">
<h6 class="pl-2">Evaluate Tests</h6>
<blockquote class="pt-2 pr-2  pb-2 pl-2 blockquote-style"   dir="{{ $userTestAttmpDetail->target_language == 'English' ? 'ltr' : 'rtl' }}" lang="{{ $userTestAttmpDetail->source_language == 'English' ? 'en' : 'ar' }}" >
{!! html_entity_decode($userTestAttmpDetail->answer) !!}
</blockquote>
</div>
</div>


<input type="hidden" name="user_ucode" value="{{ $userTestAttmpDetail->ucode}}">
<input type="hidden" name="user_attempt_id" value="{{ $userTestAttmpDetail->id}}"> 
<input type="hidden" name="user_lang_pair" value="{{ $userTestAttmpDetail->lang_pair}}">


@endforeach
<div class="row margin">
<div class="input-field col s2">
<label for="">Evaluation Scores</label>
</div>
</div>

<br/>

<?php
$scoreBreakUp = json_decode($userTestAttmpDetail->test_score, true);
?>

<div class="row margin">
<div class="input-field col s2">
<input id="semantics" type="number" min="0" max="150"  value="{{ $scoreBreakUp['scores']['semantics'] ?? ''}}" class="form-control @error('semantics') is-invalid @enderror" name="semantics" required>150
@error('semantics')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="semantics">Semantics</label>
</div>

<div class="input-field col s2" style="margin-left: 20px;">

<input id="terminology" type="number" min="0" max="50"  value="{{ $scoreBreakUp['scores']['terminology'] ?? ''}}" class="form-control @error('terminology') is-invalid @enderror" name="terminology" required>50
@error('terminology')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="terminology">Terminology</label>
</div>

<div class="input-field col s2" style="margin-left: 20px;">

<input id="syntax" type="number" min="0" max="150"  value="{{ $scoreBreakUp['scores']['syntax'] ?? ''}}" class="form-control @error('syntax') is-invalid @enderror" name="syntax" required>150
@error('syntax')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="syntax">Syntax</label>
</div>

<div class="input-field col s2">

<input id="stylistic_quality" type="number" min="0" max="100"  value="{{ $scoreBreakUp['scores']['stylistic_quality'] ?? ''}}" class="form-control @error('stylistic_quality') is-invalid @enderror" name="stylistic_quality" required>100
@error('stylistic_quality')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="stylistic_quality">Stylistic Quality</label>
</div>

<div class="input-field col s3" style="margin-left: 20px;">

<input id="stylistic_beauty" type="number" min="0" max="50" value="{{ $scoreBreakUp['scores']['stylistic_beauty'] ?? ''}}" class="form-control @error('stylistic_beauty') is-invalid @enderror" name="stylistic_beauty" required>50
@error('stylistic_beauty')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="stylistic_beauty">Stylistic Beauty and Cultural Style</label>
</div>
</div>

<div class="col s12 mb-1 center card-alert lighten-5 mb-1"  style="display:none;" id="message">
</div>

<div class="col s6 left mb-2">
<button type="submit" class="btn waves-effect waves-light  gradient-45deg-purple-deep-orange col s12">Submit Scores</button>
</div>


<div class="col s6 right mb-2" >
<a href="{{ route('dashboard.admin.evalTests', [$userTestAttmpDetail->ucode]) }}" class="btn waves-effect waves-light gradient-45deg-purple-deep-orange col s12">Evaluate Other Tests</a>
</div>
</div>   


<div class="col s12 mb-10 center" id="progressBar" style="display:none">
<div class="progress" v-if="postLoader">
<div class="indeterminate"></div>
</div>




</form>
</div>
</div>
</div>
@endsection

@push('css')
<style type="text/css">
.blockquote-style{
  border:0;
}
</style>
@endpush

@push('js')
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
$(() => {
  var token = document.head.querySelector('meta[name="csrf-token"]');
  const config = {
    headers: { 
      'X-CSRF-TOKEN': token.content,
      'content-type': 'multipart/form-data'
    }
  }
  const basicForm = document.getElementById('#testevalForm');
  document.getElementById('testevalForm').addEventListener('submit', function(e){
    let msg1 = `<div class="progress">
              <div class="indeterminate"></div>
            </div>`;
            $('#message').show().html(msg1);

    e.preventDefault();
    var names = ['semantics', 'terminology', 'syntax', 'stylistic_quality', 'stylistic_beauty'];
    const form = document.querySelector('#testevalForm');
    var formData = new FormData(form);
    axios.post(bURL+'dashboard/admin/submitEval', formData, config)
    .then(function (res) {
      console.log(res.data);
      let msg = `<div class="card-content green-text">
      <p>Test Result saved</p>
      </div>`;
      $('#message').addClass('green');
      $('#message').empty().show().html(msg).delay(3000).fadeOut(300);
    })
    .catch(function (err) {
      console.log(err.message);            
    });          
  });
});
</script>
@endpush