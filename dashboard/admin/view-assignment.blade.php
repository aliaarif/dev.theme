@extends('layouts.user')

@section('content')

<div class="col s6 m6 l12 mb-4 float-left">
<div class="card subscriber-list-card animate fadeUp">
<div class="card-content pb-1">

</div>
@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror


<form  action="{{ route('dashboard.admin.addNewAssignmentPost') }}"  class="login-form" method="post">
@csrf

<div class="row">
<div class="col s12">
<ul class="tabs">
<li class="tab col m3"><a class="active" href="#test1">View Assigment</a></li>
<li class="tab col m3"><a href="#test2">View Bids</a></li>
</ul>
</div>
</div>

<div id="test1" class="col s12">
<div class="row margin">
<div class="input-field col s3">
<input type="file" id="assignment_file" name="assignment_file" title="Upload Assigment" accept="image/jpeg" class="validate btn" >
</div>
</div>

<div class="row margin">
<div class="input-field col s3">
<i class="material-icons prefix pt-2">title</i>

<input id="Requester_Name" type="text" class="form-control @error('Requester_Name') is-invalid @enderror" name="Requester_Name" value="{{ $assigment_details[0]->client_id ?? ''}}" readonly required>
<label for="client_name">Client Name</label>

</div>

<div class="input-field col s3">
<i class="material-icons prefix pt-2">title</i>
<input id="client_team" type="text" class="form-control @error('client_team') is-invalid @enderror" name="client_team" value="{{ $assigment_details[0]->client_team_id ?? ''}}">
@error('client_team')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="client_team">Client Team</label>
</div>

<div class="input-field col s3">
<i class="material-icons prefix pt-2">title</i>
<input id="Requester_Name" type="text" class="form-control @error('Requester_Name') is-invalid @enderror" name="Requester_Name" value="{{ $assigment_details[0]->client_requester_name ?? ''}}" required>
@error('Requester_Name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="Requester_Name">Requester Name</label>
</div>

</div>

<div class="row margin">
<div class="input-field col s3">
<i class="material-icons prefix pt-2">title</i>
<input id="assignment_name" type="text" class="form-control @error('assignment_name') is-invalid @enderror" name="assignment_name" value="{{ $assigment_details[0]->assignment_name ?? ''}}" required>
@error('assignment_name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="assignment_name">Assignment name</label>
</div>

<div class="input-field col s3">
<i class="material-icons prefix pt-2">title</i>
<input id="word_count" type="text" class="form-control @error('word_count') is-invalid @enderror" name="word_count" value="{{ $assigment_details[0]->word_count ?? ''}}" required>
@error('word_count')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="word_count">Word Count</label>
</div>

<div class="input-field col s3">
<i class="material-icons prefix pt-2">title</i>
<input id="page_count" type="text" class="form-control @error('page_count') is-invalid @enderror" name="page_count" value="{{ $assigment_details[0]->page_count ?? ''}}" required>
@error('page_count')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="page_count">Page Count</label>
</div>
</div>

<div class="row margin">

<div class="input-field col s3">
<i class="material-icons prefix pt-2">title</i>
<input id="assignment_duration" type="text" class="form-control @error('assignment_duration') is-invalid @enderror" name="assignment_duration" value="{{ $assigment_details[0]->duration ?? ''}}" required>
@error('assignment_duration')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="assignment_duration">Assignment Duration</label>
</div>

<div class="input-field col s3">
<i class="material-icons prefix pt-2">keyboard_arrow_right</i>
<select class="form-control{{ $errors->has('source_language') ? ' is-invalid' : '' }}" name="source_language" id="source_language" onchange="createEditor( this.value );" required>
<option value=""></option>
<option value="English">English</option>
<option value="Arabic">Arabic</option>
</select>
<label for="source_language">Source Language</label>
</div>

<div class="input-field col s3">
<i class="material-icons prefix pt-2">keyboard_arrow_left</i>
<select class="form-control{{ $errors->has('target_language') ? ' is-invalid' : '' }}" name="target_language" nid="target_language" required>
<option value=""></option>
<option value="English">English</option>
<option value="Arabic">Arabic</option>
</select>
<label for="target_language">Target Language</label>
</div>  
</div>

<div class="row margin">
<div class="input-field col s9">
<i class="material-icons prefix pt-2">short_text</i>
<textarea id="client_instructions" class="form-control z-depth-1" name="client_instructions" rows="15" placeholder="Client's Instructions" style="height: 106px !important" required>{{ $assigment_details[0]->comment ?? ''}}</textarea>
</div> 
</div>

<div class="row">
<div class="input-field col s9">
<button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Update Assigment</button>
</div>
</div>

</div>
</form>


<div id="test2" class="col s12">

<table class="subscription-table responsive-table highlight">
<thead>
<tr>
<th>Translator Name</th>
<th>Current Rating</th>
<th>Current Rate</th>
<th>Assign</th>
</tr>
</thead>
<tbody>
<tr>
<td>ABC</td>
<td>4.3</td>
<td>1.4</td>
<td><i class="material-icons prefix pt-2">check_circle_outline</i></td>
</tr>
</tbody>
</table>

</div>

<div style="display: none;">
<div class="row margin">
<div class="input-field col s3">
<i class="material-icons prefix pt-2">keyboard_arrow_left</i>
<select class="form-control{{ $errors->has('assign_translator') ? ' is-invalid' : '' }}" name="assign_translator" nid="assign_translator" required>
<option value="">Choose..</option>
</select>
<label for="assign_translator">Assign Translator</label>
</div>

<div class="input-field col s6">
<i class="material-icons prefix pt-2">short_text</i>
<textarea id="translator_instructions" class="form-control z-depth-1" name="translator_instructions" rows="15" placeholder="Translator Instructions" style="height: 106px !important"></textarea>
</div> 
</div>


<div class="row margin">
<div class="input-field col s3">
<i class="material-icons prefix pt-2">keyboard_arrow_left</i>
<select class="form-control{{ $errors->has('assign_qa') ? ' is-invalid' : '' }}" name="assign_qa" nid="assign_qa" required>
<option value="">Choose..</option>
</select>
<label for="assign_qa">Assign QA</label>
</div>

<div class="input-field col s6">
<i class="material-icons prefix pt-2">short_text</i>
<textarea id="qa_instructions" class="form-control z-depth-1" name="qa_instructions" rows="15" placeholder="QA Instructions" style="height: 106px !important"></textarea>
</div>
</div>

<div class="row margin">
<div class="input-field col s3">
<i class="material-icons prefix pt-2">keyboard_arrow_left</i>
<select class="form-control{{ $errors->has('assign_pfr') ? ' is-invalid' : '' }}" name="assign_pfr" nid="assign_pfr" required>
<option value="">Choose..</option>
</select>
<label for="assign_pfr">Assign Proof Reader</label>
</div>

<div class="input-field col s6">
<i class="material-icons prefix pt-2">short_text</i>
<textarea id="prf_instructions" class="form-control z-depth-1" name="prf_instructions" rows="15" placeholder="Proof Reader Instructions" style="height: 106px !important"></textarea>
</div>
</div>

<br/>  

<div class="row">
<div class="input-field col s9">
<button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Add Assignment</button>
</div>
</div>
</div>

</div>
</div>
@if(Session::has('error'))
<div class="badge pink lighten-5 pink-text text-accent-4">
{{ Session::get('error') }}
</div>
@endif
@endsection
@push('js')

<script>


</script>
@endpush