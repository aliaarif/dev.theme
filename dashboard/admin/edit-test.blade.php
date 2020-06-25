@extends('layouts.user')

@section('content')

<div class="col s6 m6 l10">
<div class="card subscriber-list-card animate fadeUp">
<div class="card-content pb-1">
<h4 class="card-title mb-0">Edit Test</h4>
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


<form  action="{{ route('dashboard.admin.updateTest', $testDetails->id) }}"  class="login-form" method="post">
@csrf

<div class="row margin">
<div class="input-field col s4">
<i class="material-icons prefix pt-2">merge_type</i>
<select class="required form-control{{ $errors->has('test_type') ? ' is-invalid' : '' }}" name="test_type" id="test_type" disabled="true">
<option value=""></option>
<option value="text" {{ $testDetails->test_type=="text" ? "selected":""}}>Text</option>
<option value="file" {{ $testDetails->test_type=="file" ? "selected":""}}>File</option>
</select>
<label for="test_type">Test Type</label>
</div>
<div class="input-field col s8">
<i class="material-icons prefix pt-2">title</i>
<input id="title" type="text" value="{{ $testDetails->title ?? ''}}" class="form-control @error('title') is-invalid @enderror" name="title" required>
@error('title')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="title">Test Title</label>
</div>
</div>

<div class="row margin">
<div class="input-field col s12">
<i class="material-icons prefix pt-2">short_text</i>
<textarea id="instructions" class="form-control z-depth-1" name="instructions" rows="15" placeholder="Test Instructions" style="height: 106px !important" required>{{ $testDetails->instructions ?? ''}}</textarea>
</div>
</div>

<div class="row margin">
<div class="input-field col s6">
<i class="material-icons prefix pt-2">keyboard_arrow_right</i>
<select class="form-control{{ $errors->has('source_language') ? ' is-invalid' : '' }}" name="source_language" id="source_language"onchange="createEditor( this.value );" required>
<option value=""></option>
<option value="English" {{ $testDetails->source_language=="English" ? "selected":""}}>English</option>
<option value="Arabic" {{ $testDetails->source_language=="Arabic" ? "selected":""}}>Arabic</option>
</select>
<label for="source_language">Source Language</label>
</div>
<div class="input-field col s6">
<i class="material-icons prefix pt-2">keyboard_arrow_left</i>
<select class="form-control{{ $errors->has('target_language') ? ' is-invalid' : '' }}" name="target_language" id="target_language" required>
<option value=""></option>
<option value="English" {{ $testDetails->target_language=="English" ? "selected":""}}>English</option>
<option value="Arabic" {{ $testDetails->target_language=="Arabic" ? "selected":""}}>Arabic</option>
</select>
<label for="target_language">Target Language</label>
</div>
</div>

<div class="row margin" style="margin-left: 41px !important;">
<div class="input-field col s12">
<textarea class="form-control z-depth-1" id="editor" name="description" rows="15" placeholder="Test description" style="height:auto !important" required>{{ $testDetails->description ?? ''}}</textarea>
@error('description')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="row margin">
<div class="input-field col s6">
<i class="material-icons prefix pt-2">add_alarm</i>
<select class="form-control{{ $errors->has('test_duration') ? ' is-invalid' : '' }}" name="test_duration" required>
<option value=""></option>
<option value="30" {{ $testDetails->test_duration=="30" ? "selected":""}}>30 Min</option>
<option value="60" {{ $testDetails->test_duration=="60" ? "selected":""}}>1 Hour</option>
<option value="90" {{ $testDetails->test_duration=="90" ? "selected":""}}>1.5 Hour</option>
<option value="120" {{ $testDetails->test_duration=="120" ? "selected":""}}>2 Hours</option>
</select>
<label for="test_duration">Test Duration</label>
</div>
<div class="input-field col s6">
<i class="material-icons prefix pt-2">code</i>
<input id="word_count" type="text" class="form-control @error('word_count') is-invalid @enderror" name="word_count" value="{{ $testDetails->word_count ?? ''}}" required>
@error('word_count')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="word_count">Word Count</label>
</div>
</div>

<div class="row">
<div class="input-field col s12">
<button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Update Test</button>
</div>
</div>

</form>
</div>
</div>
<!-- <a href="#">
<div class="col s12 m6 l4">
<div class="card padding-4 animate fadeLeft">
<div class="col s5 m5">
<i class="material-icons pink-text">add</i>
</div>
<div class="col s7 m7 right-align">
<i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">perm_identity</i>
<p class="mb-0">Upload .CSV File</p>
</div>
</div>
</div>
</a> -->
@endsection
@push('js')
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>


var setCkDefault = 'en';
$(document).ready(function(){
  var selLangValue = $( "#source_language" ).val();
  
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
  //alert(languageCode);
  if ( editor )
  editor.destroy();
  
  // Replace the <textarea id="editor"> with an CKEditor
  // instance, using default configurations.
  editor = CKEDITOR.replace( 'editor', {
    language: languageCode,
    height: 200,
    
    on: {
      instanceReady: function () {
        // Wait for the editor to be ready to set
        // the language drop-down list.
        var languages = document.getElementById( 'languages' );
        languages.value = this.langCode;
        languages.disabled = false;
      }
    }
  } );
}
</script>
@endpush