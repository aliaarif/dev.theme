@extends('layouts.user')
@section('content')



<?php
//echo '<pre>';
//print_r($userDetails);

//die;

?>

<div class="row mb-4">

<div class="col s12 m12 l12">
<div class="card subscriber-list-card animate fadeUp">
<div class="card-content pb-1">
<h4 class="card-title mb-0">{{ $userDetails->name }} Details <i class="material-icons float-right">more_vert</i></h4>
</div>
<table class="subscription-table responsive-table highlight">
<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Type</th>
<th>Status</th>

</tr>
</thead>
<tbody>

<tr id="myTableRow_{{ $userDetails->ucode }}">
<td>{{ $userDetails->name }}</td>
<td>{{ $userDetails->email }}</td>
<td>{{ $userDetails->mobile }}</td>
<td><span class="badge blue lighten-5 blue-text text-accent-4">{{ $userDetails->role }}</span></td>
<td>
@if ($userDetails->status === 1)
<span class="badge green lighten-5 green-text text-accent-4"> Active </span>
@else
<span class="badge pink lighten-5 pink-text text-accent-2"> Inactive </span>
@endif
</td>

</tr>



</tbody>
</table>
</div>
</div>
</div>
@endsection