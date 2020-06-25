@extends('layouts.user')
@section('content')
@php
$role = Auth::user()->role;
$status = Auth::user()->profile->profile_dlp_status;
$status_name = Auth::user()->profile->profile_dlp_status_name;
@endphp
@if($role == 'Translator' && $status_name == 'Complete Profile')
@include('common.status.complete-profile')
@elseif($role == 'Translator' && $status_name == 'Submit Test')
@include('common.status.submit-test')
@elseif($role == 'Translator' && $status_name == 'Awaiting Result')
@include('common.status.awaiting-result')
@elseif($role == 'Translator' && $status_name == 'Sign Contract')
@include('common.status.sign-contract')
@else
<div class="row">
<div class="col s12">
<p align="justify">Your Public Profile Goes Here... </p>
</div>
<div class="col s12 m12 l12">
<div class="card subscriber-list-card animate fadeRight">
<div class="card-content pb-1">
<h4 class="card-title mb-0">Profile View Heading Goes Here... </h4>
Public Profile View Goes Here...
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endif
@endsection
@push('css')
<style></style>
@endpush
@push('js')
<script>
$(() => {});
</script>
@endpush
