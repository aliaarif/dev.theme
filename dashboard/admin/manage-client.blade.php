@extends('layouts.user')

@section('content')

<div class="row mb-4">
<div class="col s12 m6 l4">
<div class="card padding-4 animate fadeUp">
<div class="col s5 m5">
<h5 class="mb-0"></h5>
</div>
<div class="col s7 m7 right-align">
<i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">perm_identity</i>
<p class="mb-0">Total Clients</p>
</div>
</div>
</div>
<a href="{{ route('dashboard.admin.addNewClient') }}">
<div class="col s12 m6 l4">
<div class="card padding-4 animate fadeUp">
<div class="col s5 m5">
<i class="material-icons pink-text">add</i>
</div>
<div class="col s7 m7 right-align">
<i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">perm_identity</i>
<p class="mb-0">Add New Client</p>
</div>
</div>
</div></a>

<div class="col s12 m12 l12">
<div class="card subscriber-list-card animate fadeUp">
<div class="card-content pb-1">
<h4 class="card-title mb-0">All Clients <i class="material-icons float-right">more_vert</i></h4>
</div>
@if(Session::has('success'))
<div class="badge green lighten-5 green-text text-accent-4">
{{ Session::get('success') }}
</div>
@endif

<table class="subscription-table responsive-table highlight">
<thead>
<tr>
<th>Client</th>
<th>Client Team</th>
<th>Client Req. Name</th>
<th>Client Email</th>
<th>Client Phone</th>
<th>Action</th>
</tr>
</thead>
<tbody>



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