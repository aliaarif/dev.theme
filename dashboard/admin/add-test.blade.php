@extends('layouts.user')

@section('content')

<div class="col s6 m6 l8" style="float: left;">
<div class="card subscriber-list-card animate fadeUp">
<div class="card-content pb-1">
<h4 class="card-title mb-0">Add New Test</h4>
</div>


@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror


<form  action="{{ route('dashboard.admin.addNewTest') }}"  class="login-form" method="post">
@csrf

<div class="row margin">
<div class="input-field col s4">
<i class="material-icons prefix pt-2">merge_type</i>
<select class="required form-control{{ $errors->has('test_type') ? ' is-invalid' : '' }}" name="test_type" id="test_type" required>
<option value=""></option>
<option value="text">Text</option>
<!--<option value="file">File</option> -->
</select>
<label for="test_type">Test Type</label>
</div>
<div class="input-field col s8">
<i class="material-icons prefix pt-2">title</i>
<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required>
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
<textarea id="instructions" class="form-control z-depth-1" name="instructions" rows="15" placeholder="Test Instructions" style="height: 106px !important" required></textarea>
</div>
</div>

<div class="row margin">
<div class="input-field col s6">
<i class="material-icons prefix pt-2">keyboard_arrow_right</i>
<select class="form-control{{ $errors->has('source_language') ? ' is-invalid' : '' }}" name="source_language" id="source_language" onchange="createEditor( this.value );" required>
<option value=""></option>
<option value="English">English</option>
<option value="Arabic">Arabic</option>
</select>
<label for="source_language">Source Language</label>
</div>
<div class="input-field col s6">
<i class="material-icons prefix pt-2">keyboard_arrow_left</i>
<select class="form-control{{ $errors->has('target_language') ? ' is-invalid' : '' }}" name="target_language" nid="target_language" required>
<option value=""></option>
<option value="English">English</option>
<option value="Arabic">Arabic</option>
</select>
<label for="target_language">Target Language</label>
</div>
</div>

<div class="row margin" style="margin-left: 41px !important; display: none;" id="text_type_area">
<div class="input-field col s12">
<textarea class="form-control z-depth-1" id="editor" name="description" rows="15" placeholder="Test description" style="height:auto !important" required>Test Content Here</textarea>
</div>
</div>



<div class="row margin" style="margin-left: 41px !important; display: none;" id="file_type_area">
<div class="input-field col s12">
<div class="btn">
<span>Upload Test Files</span>
<input type="file" id="" name="" accept="image/jpeg" class="validate" >
</div>
</div>
</div>

<br/>

<div class="row margin">
<div class="input-field col s6">
<i class="material-icons prefix pt-2">add_alarm</i>
<select class="form-control{{ $errors->has('test_duration') ? ' is-invalid' : '' }}" name="test_duration" required>
<option value=""></option>
<option value="30">30 Min</option>
<option value="60">1 Hour</option>
<option value="90">1.5 Hour</option>
<option value="120">2 Hours</option>
</select>
<label for="test_duration">Test Duration</label>
</div>
<div class="input-field col s6">
<i class="material-icons prefix pt-2">code</i>
<input id="word_count" type="text" class="form-control @error('word_count') is-invalid @enderror" name="word_count" required>
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
<button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Save Test</button>
</div>
</div>

</form>
</div>
</div>
@if(Session::has('error'))
<div class="badge pink lighten-5 pink-text text-accent-4">
{{ Session::get('error') }}
</div>
@endif
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

$(document).ready(function(){
  $("#test_type").change(function(){
    var selectedTestType = $(this).children("option:selected").val();
    
    if(selectedTestType === "text"){
      $("#text_type_area").show();
      $("#file_type_area").hide();
    }
    if(selectedTestType === "file"){
      $("#text_type_area").hide();
      $("#file_type_area").show();
    }
  });
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

// At page startup, load the default language:
createEditor( '' );


</script>
@endpush