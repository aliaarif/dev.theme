@extends('layouts.user')

@section('content')

<div class="row mb-4">
<div class="col s12 m6 l4">
<div class="card padding-4 animate fadeUp">
<div class="col s5 m5">
<h5 class="mb-0">{{ $user_count}}</h5>
</div>
<div class="col s7 m7 right-align">
<i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">perm_identity</i>
<p class="mb-0">Total Users</p>
</div>
</div>
</div>
<a href="{{ route('dashboard.admin.addUser') }}">
<div class="col s12 m6 l4">
<div class="card padding-4 animate fadeUp">
<div class="col s5 m5">
<i class="material-icons pink-text">add</i>
</div>
<div class="col s7 m7 right-align">
<i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">perm_identity</i>
<p class="mb-0">Invite New User</p>
</div>
</div>
</div></a>

<div class="col s12 m12 l12">
<div class="card subscriber-list-card animate fadeUp">
<div class="card-content pb-1">
<h4 class="card-title mb-0">Users List <i class="material-icons float-right">more_vert</i></h4>
</div>
<table class="subscription-table responsive-table highlight">
<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Type</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach ($users as $user)
<tr id="myTableRow_{{ $user->ucode }}">
<td>{{ $user->profile->first_name }}</td>
<td>{{ $user->email }}</td>
<td>{{ $user->profile->mobile }}</td>
<td><span class="badge blue lighten-5 blue-text text-accent-4">{{ $user->role }}</span></td>
<td>
@if ($user->status === 1)
<span class="badge green lighten-5 green-text text-accent-4"> Active </span>
@else
<span class="badge pink lighten-5 pink-text text-accent-2"> Inactive </span>
@endif
</td>
<td class="left-align">
<a href="{{ route('dashboard.translator.manageProfile', [$user->ucode]) }}" ><i class="material-icons pink-text">create</i></a>
<a href="javascript:;" class="aaa" data-ucode='{{ $user->ucode }}'><i class="material-icons pink-text">clear</i></a>
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

$(() => {
  
  var token = document.head.querySelector('meta[name="csrf-token"]');
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
  
  //console.log(token.content);
  
  $('.aaa').on('click', function(){
    
    if (confirm('Are you sure ?')) {
      var id = $(this).data('ucode');
      axios.post(bURL+'dashboard/admin/deleteUser', {
        'id': id
      })
      .then(function (response) {
        if(response.data==="FAIL@"){
          alert('fail');
        }else{
          $('#myTableRow_'+response.data).remove();
          $('html, body').stop();
        }
        //console.log(response.data);
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  });
  
});
</script>
@endpush