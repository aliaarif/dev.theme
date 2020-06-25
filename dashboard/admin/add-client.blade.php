@extends('layouts.user')

@section('content')

<div class="col s6 m6 l12" style="float: left;">
<div class="card subscriber-list-card animate fadeUp">
<div class="card-content pb-1">
<h4 class="card-title mb-0">Add New Client</h4>
</div>


@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror


<form  action="{{ route('dashboard.admin.addNewUser') }}"  class="login-form" method="post">
@csrf

<div class="row margin">
<div class="input-field col s4">
<i class="material-icons prefix pt-2">title</i>
<input id="Client_name" type="text" class="form-control @error('Client_name') is-invalid @enderror" name="Client_name" required>
@error('Client_name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="Client_name">Client name</label>
</div>
<div class="input-field col s4">
<i class="material-icons prefix pt-2">title</i>
<input id="Client_Team" type="text" class="form-control @error('Client_Team') is-invalid @enderror" name="Client_Team" required>
@error('Client_Team')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="Client_Team">Client Team</label>
</div>

<div class="input-field col s4">
<i class="material-icons prefix pt-2">title</i>
<input id="Client_Email" type="text" class="form-control @error('Client_Email') is-invalid @enderror" name="Client_Email" required>
@error('Client_Email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="Client_Email">Client Email</label>
</div>
</div>


<div class="row margin">

<div class="input-field col s6">
<i class="material-icons prefix pt-2">title</i>
<input id="Client_Phone" type="text" class="form-control @error('Client_Phone') is-invalid @enderror" name="Client_Phone" required>
@error('Client_Phone')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="Client_Phone">Client Phone</label>
</div>

<div class="input-field col s6">
<i class="material-icons prefix pt-2">title</i>
<input id="Requester_Name" type="text" class="form-control @error('Requester_Name') is-invalid @enderror" name="Requester_Name" required>
@error('Requester_Name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="Requester_Name">Requester Name</label>
</div>

</div>


<br/>  

<div class="row">
<div class="input-field col s12">
<button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Add Client</button>
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
@endsection
@push('js')

<script>


</script>
@endpush