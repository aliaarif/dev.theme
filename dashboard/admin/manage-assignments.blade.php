@extends('layouts.user')
@section('content')
<section>
    <div class="row mt-1" id="createAssignmentWrapper">
      <div class="col s4">
        <a  class="waves-effect waves-light btn-small" id="createAssignmentBtn">Create Assignment</a>
      </div>
      <div class="col s8">
        <input
          type="text"
          class="form-control"
          v-model="assignmen_search_term"
          placeholder="Search..."
        />
      </div>

      <div class="col s12 m6 l3">
        <div class="card animate fadeUp">
          <div class="col s5 m5 mt-1">Booked Capacity</div>
          <div class="col s7 m7 right-align">
            <a
              style="text-align:center"
              href="javascript:;"
              class="mt-5 mb-5 btn-floating waves-effect waves-light gradient-45deg-purple-amber gradient-shadow white-text"
            >
              <b>-</b>
            </a>
          </div>
        </div>
      </div>
      <div class="col s12 m6 l3">
        <div class="card animate fadeUp">
          <div class="col s5 m5 mt-1">Awaiting Approval</div>
          <div class="col s7 m7 right-align">
            <a
              style="text-align:center"
              href="javascript:;"
              class="mt-5 mb-5 btn-floating waves-effect waves-light gradient-45deg-purple-amber gradient-shadow white-text"
            >
              <b>-</b>
            </a>
          </div>
        </div>
      </div>
      <div class="col s12 m6 l3">
        <div class="card animate fadeUp">
          <div class="col s5 m5 mt-1">Active Assignments</div>
          <div class="col s7 m7 right-align">
            <a
              style="text-align:center"
              href="javascript:;"
              class="mt-5 mb-5 btn-floating waves-effect waves-light gradient-45deg-purple-amber gradient-shadow white-text"
            >
              <b>-</b>
            </a>
          </div>
        </div>
      </div>
      <div class="col s12 m6 l3">
        <div class="card animate fadeUp">
          <div class="col s5 m5 mt-6">Delivered</div>
          <div class="col s7 m7 right-align">
            <a
              style="text-align:center"
              href="javascript:;"
              class="mt-5 mb-5 btn-floating waves-effect waves-light gradient-45deg-purple-amber gradient-shadow white-text"
            >
              <b>-</b>
            </a>
          </div>
        </div>
      </div>


      @forelse($getAllAssigments as $assignment)
      <div class="col s12">
        <div class="card animate fadeUp">
          <div class="col s5 m5 mt-6">Delivered</div>
          <div class="col s7 m7 right-align">
            <a
              style="text-align:center"
              href="javascript:;"
              class="mt-5 mb-5 btn-floating waves-effect waves-light gradient-45deg-purple-amber gradient-shadow white-text"
            >
              <b>-</b>
            </a>
          </div>
        </div>
      </div>
      @empty
      <div class="col s12">
        <div class="card animate fadeUp">
          <div class="col s12 m12 mt-6">No Assignments were found in our recoreds at all</div>
        </div>
      </div>
      @endforelse
    </div>
   </div>
  </section>
@endsection
@push('js')
<script>
$(() => {
  var token = document.head.querySelector('meta[name="csrf-token"]');
    const config = {
    headers: { 
      'X-CSRF-TOKEN': token.content,
      'content-type': 'multipart/form-data'
    }
  }
  
  $('#createAssignmentBtn').on('click', () => {
    axios.get(bURL+'dashboard/admin/add-assignment')
    .then(function (res) {
      //console.log(res.data);
      window.location.href = bURL+'dashboard/admin/create-assignment-file/'+res.data
    });
  });

});
</script>
@endpush

