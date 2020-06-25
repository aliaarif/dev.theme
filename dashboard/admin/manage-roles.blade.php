@extends('layouts.user')

@section('content')

<div class="row mb-4">
<div class="col s12 m12 l12">
<div class="card subscriber-list-card animate fadeUp">
<div class="card-content pb-1">
<h4 class="card-title mb-0" id="messageManageRoles">
<p class="green-text">Users Role(s)</p>
</h4>
</div>
<table class="subscription-table responsive-table highlight">
<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Admin</th>
<th>Translator</th>
<th>Operations</th>
<th>Quality Analyst</th>
<th>Client</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach ($users as $user)
{{ Form::open(array('url' => route('dashboard.admin.manageRolesAction'), 'method'=>'post', 'id' => 'manageRoles-'.$user->ucode, 'class' => 'manage-roles', 'name' => 'manageRoles', 'data-ucode' => $user->ucode )) }}
@csrf

<?php

$role_names = DB::table('roles')
->whereIn('id', DB::table('user_role')->where('user_id', $user->id)->pluck('role_id'))
->get('name');


$roles = [];

foreach ($role_names as $key => $value) {
  array_push($roles, $value->name);
}


// /dd($roles);







?>



<input type="hidden" name="ucode" value="{{ $user->ucode }}">


<tr id="myTableRow_{{ $user->ucode }}">
<td>{{ $user->profile->first_name }}</td>
<td>{{ $user->email }}</td>
<td>

<label>
<input class="form-check-input" type="checkbox" value="1" name="roles[]" 
{{ $user->hasAnyRoles($roles, 'Admin') ? 'checked' : '' }}>
<span></span>
</label>

</td>
<td>

<label>
<input class="form-check-input" type="checkbox"   value="2" name="roles[]" 
{{ $user->hasAnyRoles($roles, 'Translator') ? 'checked' : '' }}>
<span></span>
</label>

</td>
<td>

<label>
<input class="form-check-input" type="checkbox"  value="3" name="roles[]" 
{{ $user->hasAnyRoles($roles, 'Operations') ? 'checked' : '' }}>
<span></span>
</label>

</td>
<td>

<label>
<input class="form-check-input" type="checkbox"  value="4" name="roles[]" 
{{ $user->hasAnyRoles($roles, 'Quality Analyst') ? 'checked' : '' }}>
<span></span>
</label>

</td>
<td>

<label>
<input class="form-check-input" type="checkbox"  value="5" name="roles[]" 
{{ $user->hasAnyRoles($roles, 'Client') ? 'checked' : '' }}>
<span></span>
</label>

</td>
<td>
@if ($user->status === 1)
<span class="badge green lighten-5 green-text text-accent-4"> Active </span>
@else
<span class="badge pink lighten-5 pink-text text-accent-2"> Inactive </span>
@endif
</td>

<td class="left-align">
<button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12 manage-roles-btn">Assign Role(s)</button>


</td>


</tr>
</form>
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
  
  //var token = document.head.querySelector('meta[name="csrf-token"]');
  //window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
  
  var token = document.head.querySelector('meta[name="csrf-token"]');
  const config = {
    headers: { 
      'X-CSRF-TOKEN': token.content,
      'content-type': 'multipart/form-data'
    }
  }
  
  
  //console.log(token.content);
  
  // $('.aaa').on('click', function(){
    
    //   if (confirm('Are you sure ?')) {
      //     var id = $(this).data('ucode');
      //     axios.post('http://dev.project/dashboard/admin/deleteUser', {
        //       'id': id
        //     })
        //     .then(function (response) {
          //       if(response.data==="FAIL@"){
            //         alert('fail');
            //       }else{
              //         $('#myTableRow_'+response.data).remove();
              //         $('html, body').stop();
              //       }
              //         //console.log(response.data);
              //       })
              //     .catch(function (error) {
                //       console.log(error);
                //     });
                //   }
                // });
                
                $('.manage-roles').on('submit', function(e){
                  
                  const ucode = $(this).data("ucode");
                  
                  
                  //alert(ucode);
                  
                  e.preventDefault();
                  const form = document.querySelector('#manageRoles-'+ucode);
                  
                  //alert('#manageRoles-'+ucode);
                  
                  var formData = new FormData(form);
                  axios.post(bURL+'dashboard/admin/manage-roles', formData, config)
                  .then(function (res) {
                    console.log(res.data.message);
                    //if(res.data.message === true){
                      var msg = '<p class="green-text">'+res.data.message+'</p>';      
                      // }else{
                        //   var msg = `<p class="green-text">`+res.data.message+`</p>`;      
                        // }
                        $('#messageManageRoles').html(msg);
                        $('#messageManageRoles').empty().show().html(msg).delay(3000).fadeOut(300);
                        
                      })
                      .catch(function (err) {
                        console.log(err);            
                      });
                      
                      
                    });
                    
                    
                  });
                  </script>
                  @endpush