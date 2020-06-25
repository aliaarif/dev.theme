@extends('layouts.user')
@section('content')
<section>
    <div class="row mt-1" id="createAssignmentBox">
    
    {{ Form::open(array('url' => route('dashboard.admin.updateAssignmentFile'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'update_temp_assignment_with_file', 'name' => 'update_temp_assignment_with_file')) }}
    @csrf
    <input type="hidden" id="id_with_file" name="id_with_file" value="{{ $assignment->id }}">
      <div class="col s5 ml-2 mr-2 left " style="border:dashed 1px blue; padding-top:50px; padding-bottom:50px;">
        <div class="input-field col s6 mb-4">
          <select id="source_with_file" name="source_with_file" >
            <option disabled selected>---Select---</option>
            <option value="arabic">Arabic</option>
            <option value="english">English</option>
          </select>
          <label>Source Language <span class="red-text">*</span></label>
          <span class="error" id="source_with_file_error"></span>
        </div>
        <div class="input-field  col s6  mb-4">
          <select id="target_with_file" name="target_with_file" >
            <option disabled selected>---Select---</option>
            <option value="arabic">Arabic</option>
            <option value="english">English</option>
          </select>
          <label>Target Language <span class="red-text">*</span></label>
          <span class="error" id="target_with_file_error"></span>
        </div>
        <div align="center"  class="file-field  col s12" style="text:align:center">
          <div  class="btn">
            <span>Upload / Drop File(s)</span>
            <input  type="file" id="file" name="file" accept="application/docx" class="validate"/>
          </div>
        </div>
        <span class="error ml-4" id="file_error"></span>
      </div>
      <!-- <button type="submit" id="fileSubmitBtn"  ></button> -->
      </form>

      <form method="post" id="update_temp_assignment_with_book_capacity"  name="update_temp_assignment_with_book_capacity">
    @csrf
    <input type="hidden" id="temp_assignment_id_from_book_capacity" name="temp_assignment_id_from_book_capacity" value="{{ $assignment->id }}">
      <div class="col s6 ml-2 mr-2 right" style="border:dashed 1px blue; padding-top:20px; padding-bottom:20px;">
      <div class="input-field col s6">
          <select id="source_with_book_capacity" name="source_with_book_capacity" >
            <option disabled selected>---Select---</option>
            <option value="Arabic">Arabic</option>
            <option value="English">English</option>
          </select>
          <label>Source Language</label>
          <span class="error" id="source_with_book_capacity_error"></span>
        </div>
        <div class="input-field  col s6">
          <select id="target_with_book_capacity" name="target_with_book_capacity" >
            <option disabled selected>---Select---</option>
            <option value="Arabic">Arabic</option>
            <option value="English">English</option>
          </select>
          <label>Target Language</label>
          <span class="error" id="target_with_book_capacity_error"></span>
        </div>

        <div class="input-field  col s6">
          <label for="words" class="active">
            Est. Word Count
            <span class="red-text">*</span>
          </label>
          <input
            type="text"
            placeholder="Enter Est. Word Count Here..."
            id="words"
            name="words"
          />
          <span class="error" id="words_error"></span>
        </div>
        <div class="input-field  col s6">
          <label for="pages" class="active">
            Est. Page Count
            <span class="red-text">*</span>
          </label>
          <input
            type="text"
            placeholder="Enter Est. Page Count Here..."
            id="pages"
            name="pages"
          />
          <span class="error" id="pages_error"></span>
        </div>
        <div class="input-field col s12">
          <select
            id="no_of_sub_assignments"
            name="no_of_sub_assignments"
          >
            <option value disabled selected>---Select---</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
          <label for='no_of_sub_assignments'>No of Sub Assignments</label>
          <span class="error" id="no_of_sub_assignments_error"></span>
        </div>
      </div>
      </form>
    </div>
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
  $('#file').on('change', (event) => {
    
    if (!event || !event.target || !event.target.files || event.target.files.length === 0) {
    return;
  }
  const name = event.target.files[0].name;
  const lastDot = name.lastIndexOf('.');
  const fileName = name.substring(0, lastDot);
  const ext = name.substring(lastDot + 1);

  // if($('#source_with_file').val() == ""){
  //     $('#source_with_file_error').css('color', 'red');
  //     $('#source_with_file').focus();
  //     $('#source_with_file_error').text('Required!!!');
  //     return false;
  //   } 

  //   if($('#target_with_file').val() == ""){
  //     $('#target_with_file_error').css('color', 'red');
  //     $('#target_with_file').focus();
  //     $('#target_with_file_error').text('Required!!!');
  //     return false;
  //   }

  if(ext != "doc" && ext != "docx"){
      $('#file_error').css('color', 'red');
      $('#file').focus();
      $('#file_error').text('Required!!!');
      return false;
    }
    
    $('#update_temp_assignment_with_file').trigger('submit');

});


  document.getElementById('file').addEventListener('change', function(e){

//     if($('#source_with_file').val() == ""){
//       document.getElementById('source_with_file_error').style = 'color:red';
//       document.getElementById('source_with_file').focus();
//       document.getElementById('source_with_file_error').textContent = 'Required!!!';
//       return false;
//     } 

//     if($('#target_with_file').val() == ""){
//       document.getElementById('target_with_file_error').style = 'color:red';
//       document.getElementById('target_with_file').focus();
//       document.getElementById('target_with_file_error').textContent = 'Required!!!';
//       return false;
// } 



  // if($('#source_with_file').val() == ""){
  //     $('#source_with_file_error').css('color', 'red');
  //     $('#source_with_file').focus();
  //     $('#source_with_file_error').text('Required!!!');
  //     return false;
  //   } 

  //   if($('#target_with_file').val() == ""){
  //     $('#target_with_file_error').css('color', 'red');
  //     $('#target_with_file').focus();
  //     $('#target_with_file_error').text('Required!!!');
  //     return false;
  //   }


       //e.preventDefault();
    var names = ['source_with_file', 'target_with_file'];
    var errorCount = 0;
    names.forEach((el) => {
      var val = document.forms["update_temp_assignment_with_file"][el].value;
      if (val == null || val == "" || val == 0) {
        document.getElementById(el + '_error').style = 'color:red';
        document.getElementById(el).focus();
        document.getElementById(el + '_error').textContent = 'Required!!!';
        ++errorCount;
      }else{
        document.getElementById(el + '_error').textContent = '';
      }
    });
    if (errorCount) return false;


    const form = document.querySelector('#update_temp_assignment_with_file');
    var formData = new FormData(form);
    axios.post(bURL+'dashboard/admin/update-assignment-file', formData, config)
    .then(function (res) {
      console.log(res);
      
      var id = res.data.id;
      var api = res.data.api;
      var book_capacity = res.data.book_capacity;
      // console.log(id);
      // console.log(api);
      // console.log(book_capacity);
        window.location.href = bURL+'dashboard/admin/create-update-assignment/'+id+'/'+api+'/'+book_capacity
      })
      .catch((err) => {
        if(err.response.data.errors.source_with_file){
          $('#source_with_file_error').css('color', 'red');
          $('#source_with_file_error').text('Required!!!');
          return false;
        }
        if(err.response.data.errors.target_with_file){
          $('#target_with_file_error  ').css('color', 'red');
          $('#target_with_file_error').text('Required!!!');
          return false;
        }
        //window.location.href = bURL+'dashboard/admin/create-update-assignment/'+id+'/'+api+'/'+book_capacity
      })
    });
});
</script>
@endpush

