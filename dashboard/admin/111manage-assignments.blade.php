@extends('layouts.user')

@section('content')

<div class="row">
<a href="{{ route('dashboard.admin.addNewAssignment') }}">
<div class="col s12 m6 l4">
<div class="card padding-4 animate fadeUp">
<div class="col s5 m5">
<i class="material-icons pink-text">add</i>
</div>
<div class="col s7 m7 right-align">
<i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">perm_identity</i>
<p class="mb-0">New Assignement</p>
</div>
</div>
</div>
</a>

<div class="col s12 m6 l5">
<div class="card padding-4 animate fadeUp">
<div class="col s5 m5">
<h5 class="mb-0"></h5>
</div>
<div class="col s7 m7 right-align">
<i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">perm_identity</i>
<p class="mb-0">Today's Active Assignments</p>
</div>
</div>
</div>

<div class="col s12 m12 l12">
<div class="card subscriber-list-card animate fadeUp">
<div class="card-content pb-1">
<h4 class="card-title mb-0">All Assignments <i class="material-icons float-right">more_vert</i></h4>
</div>
@if(Session::has('success'))
<div class="badge green lighten-5 green-text text-accent-4">
{{ Session::get('success') }}
</div>
@endif

<table class="subscription-table responsive-table highlight">
<thead>
<tr>
<th>Assignment Code</th>
<th>Assignment Name</th>
<th>Assignment Duration</th>
<th>Client Name</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach ($getAllAssigments as $getAllAssigments_vals)
<tr id="myTableRow_{{ $getAllAssigments_vals->id }}">
<td>{{ $getAllAssigments_vals->acode }}</td>
<td>{{ $getAllAssigments_vals->assignment_name }}</td>
<td>{{ $getAllAssigments_vals->duration }}</td>
<td>{{ $getAllAssigments_vals->client_id }}</td>
<td class="left-align">
<a href="{{route('dashboard.admin.viewAssigment',$getAllAssigments_vals->acode)}}"><i class="material-icons pink-text">create</i></a>
</td>
</tr>
@endforeach


</tbody>
</table>
</div>
</div>
</div>
@endsection
@push('js')
<script type="text/javascript">

</script>
@endpush