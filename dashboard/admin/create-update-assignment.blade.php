@extends('layouts.user')
@section('content')
@php 
$api = `{{ Request::segment(5) }}`;
$book_capacity = `{{ Request::segment(6) }}`;
@endphp
<section>
<div class="row mt-1" id="createAssignmentBoxDetails">
    
    <form method="post" enctype="multipart/form-data" id="update-assignment">
    @csrf
        <div class="col s12 m12 l12 mb-10">
        @if(Request::segment(5) == 1 && Request::segment(6) == 0)
        <img src="{{ asset("images/ext/".substr($assignment->file, -4)) }}.png" width="20" />
        @endif
        <div class="card subscriber-list-card animate fadeUp">
          <div class="card-content pb-1">
            <h4 class="card-title mb-0">
            <div align="center" class="btn">
            <span>Upload File</span>
            <input
              type="file"
              id="file1"
              name="file1"
              accept="application/docx"
              class="validate"
             
            />
            <div id="file_tracker"></div>
          </div>
        
              <a
                class="dropdown-settings waves-effect waves-light breadcrumbs-btn float-right"
                href="javascript:;"
                data-target="dropdown2"
              >
                <i class="material-icons right">close</i>
              </a>
              <input
                class="col s12"
                type="text"
                v-model="searchByEmail"
                placeholder="Search Here By Email..."
              />
            </h4>
          </div>

          <table class="subscription-table highlight">
            <thead>
              <tr>
                <th class="custom-pointer">Assignment Part(s)</th>
                <th class="custom-pointer">Est. Word Count</th>
                <th class="custom-pointer">Details</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>

      </form>
      <form method="post" id="hit_wc_api" name="hit_wc_api" style="display:none" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="file_name" id="file_name">

        <input type="hidden" name="s3_path" id="s3_path">

        <input type="hidden" name="source_language" id="source_language">

        <input type="hidden" name="translation_language" id="translation_language">

        <input type="hidden" name="assignment_id" id="assignment_id">

        <input type="hidden" name="file_type" id="file_type">
        
        

      </form>
    </div>
  </section>
@endsection
@push('js')
<script>
$(() => {
  var bURL = 'http://dev.project/';
  
 

  
  var token = document.head.querySelector('meta[name="csrf-token"]');
    const config = {
    headers: { 
      'X-CSRF-TOKEN': token.content,
      'content-type': 'multipart/form-data'
    }
  }

  if(api == 1 && book_capacity == 0){
  
  var file_name = `{{ substr($assignment->file, -12) }}`
  var s3_path = config('app.AWS_URL').`{{ $assignment->file }}`
  var source_language = `{{ $assignment->source }}`
  var translation_language = `{{ $assignment->target }}`
  var assignment_id = `{{ $assignment->id }}`
	var file_type = `{{ substr($assignment->file, -4) }}`
  
  
  $('#file_name').val(file_name);
  $('#s3_path').val(s3_path);
  $('#source_language').val(source_language);
  $('#translation_language').val(translation_language);
  $('#assignment_id').val(assignment_id);
  $('#file_type').val(file_type);

    $('#file_tracker').html('<div class="progress"><div class="indeterminate"></div></div>');
    const form = document.querySelector('#hit_wc_api');
    var formData = new FormData(form);
    axios.post(bURL+'dashboard/admin/get-file-api-data', formData, config)
    .then(function (res) {
      console.log(res)
      //$('#file_tracker').remove();
    })
  }           
});
</script>
@endpush

