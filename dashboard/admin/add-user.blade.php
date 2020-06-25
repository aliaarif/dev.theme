@extends('layouts.user')

@section('content')

<div class="col s6 m6 l6">
<div class="card subscriber-list-card animate fadeUp">
<div class="card-content pb-1">
<h4 class="card-title mb-0">Provide User Details</h4>
</div>

@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror


<form  action="{{ route('dashboard.admin.addNewUser') }}"  class="login-form" method="post">
@csrf


<div class="row margin">
<div class="input-field col s12">
<i class="material-icons prefix pt-2">lock_outline</i>
<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>
@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="email">Email</label>
</div>
</div>

<!--
<div class="row margin">
<div class="input-field col s12">
<i class="material-icons prefix pt-2">category</i>
<label for="type">Role</label>
<select class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role">
<option value=""></option>
<option value="Admin">Admin</option>
<option value="Translator">Translator</option>
<option value="Operation User">Operation</option>
<option value="Proof Reader">Proof Reader</option>
</select>
</div>
</div>
-->

<div class="row">
<div class="input-field col s12">
<button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Send Activation link</button>
</div>
</div>

</form>
</div>
@if(Session::has('success'))
<div class="badge green lighten-5 green-text text-accent-4">
{{ Session::get('success') }}
</div>
@endif
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