@extends('layouts.user')

@section('content')


{{ Form::open(array('url' => route('dashboard.admin.addNewAssignmentPost'), 'files'=>'true', 'method'=>'post', 'enctype'=>'multipart/form-data', 'id' => 'new-assignment', 'name' => 'new-assignment')) }}
@csrf
<input type="hidden" name="form_type" value="fileplusdata">



<div  class="row margin">
  <div class="file-field input-field col m12">
    <div class="btn">
      <span>File</span>
      <input type="file" id="assignment_file" name="assignment_file"   class="validate">
    </div>
    <div class="file-path-wrapper">
      <input class="file-path validate" type="text">
      <span class="error"><p id="assignment_file_error"></p></span>
    </div>
  </div>

  <div class="input-field col m9">
   <i class="material-icons prefix pt-2">title</i>
   <input id="assignment_name" type="text" class="form-control" name="assignment_name" value=" " readonly>
   @error('assignment_name')
   <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
  <label for="assignment_name">Assignment name</label>
</div>

<div class="input-field col s3">
  <i class="material-icons prefix pt-2">title</i>
  <input id="file_ext" type="text" class="form-control" name="file_ext" value=" " readonly>
  @error('file_ext')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
  <label for="file_ext">File Ext.</label>
</div>

<div class="input-field col s5">
  <i class="material-icons prefix pt-2">title</i>

  <select class="form-control" name="client_name" id="client_name" >
    <option value=""></option>
    @foreach ($getAllClients as $key => $value) {
    <option value="{{$value->id}}">{{$value->client_name}}</option>
    @endforeach
  </select>
  <label>Client Name</label>

</div>

<div class="input-field col s4">
  <i class="material-icons prefix pt-2">title</i>
  <input id="req_name" type="text" class="form-control" name="req_name">
  @error('req_name')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
  <label>Requester Name</label>
</div>

<div class="input-field col s3">
  <i class="material-icons prefix pt-2">title</i>
  <input id="charge_code" type="text" class="form-control" name="charge_code">
  @error('charge_code')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
  <label for="charge_code">Charge Code</label>
</div>

<div class="input-field col s4">
  <i class="material-icons prefix pt-2">title</i>
  <select class="form-control" name="service_type" id="service_type">
    <option value="Translation" selected>Translation</option>
    <option value="Proof Reading">Proof Reading</option>
    <option value="VGA">VGA</option>
  </select>
  <label>Service Type</label>
</div>

<div class="input-field col s4">
  <i class="material-icons prefix pt-2">title</i>
  <select class="form-control" name="service_type" id="service_type">
    <option value="Arabic" selected>Arabic</option>
    <option value="English">English</option>
  </select>
  <label>Source Language</label>
</div>

<div class="input-field col s4">
  <i class="material-icons prefix pt-2">title</i>
  <select class="form-control" name="source_lang" id="source_lang">
    <option value="English" selected>Arabic</option>
    <option value="Arabic">Arabic</option>
  </select>
  <label>Target Language</label>
</div>

<div class="input-field col s5">
  <i class="material-icons prefix pt-2">title</i>
  <select class="form-control" name="time_zone" id="time_zone">
    <option value="UTC +05:30">Asia/Kolkata</option>
    <option value="UTC +04:00">Asia/Dubai</option>
  </select>
  <label>Target Language</label>
</div>

<div class="input-field col s7">
  <input type="date" class="datepicker" id="deadline" name="deadline">
  <label for="deadline">Deadline</label>
</div>


<div class="input-field col s12">
  <textarea id="client_instructions" name="client_instructions" class="materialize-textarea"></textarea>
  <label for="client_instructions">Client Instructions</label>
</div>

<div class="input-field col s3">
  <i class="material-icons prefix pt-2">title</i>
  <input id="word_count" type="text" class="form-control" name="word_count" readonly>
  @error('word_count')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
  <label for="word_count">Word Count</label>
</div>

<div class="input-field col s3">
  <i class="material-icons prefix pt-2">title</i>
  <input id="page_count" type="text" class="form-control" name="page_count" readonly>
  @error('page_count')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
  <label for="page_count">Page Count</label>
</div>

<div class="input-field col s3">
  <i class="material-icons prefix pt-2">title</i>
  <input id="word_count_adj" type="text" class="form-control" name="word_count_adj" >
  @error('word_count_adj')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
  <label for="word_count_adj">Word Count Adj.</label>
</div>

<div class="input-field col s3">
  <i class="material-icons prefix pt-2">title</i>
  <input id="page_count_adj" type="text" class="form-control" name="page_count_adj" >
  @error('page_count_adj')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
  <label for="page_count_adj">Page Count Adj.</label>
</div>


<div class="input-field col s4">
  <input type="date" class="datepicker" id="translator_deadline" name="translator_deadline">
  <label for="translator_deadline">Translator Deadline</label>
</div>

<div class="input-field col s4">
  <input type="date" class="datepicker" id="proof_reader_deadline" name="proof_reader_deadline">
  <label for="proof_reader_deadline">Proof Reader Deadline</label>
</div>

<div class="input-field col s4">
  <input type="date" class="datepicker" id="vga_deadline" name="vga_deadline">
  <label for="vga_deadline">VGA Deadline</label>
</div>

</div>



<div class="row" >
  <div class="col m3 s12  mb-3  mt-1">
    <button id="savePaymentMethodBtn" class="waves-effect waves-dark btn btn-lg btn-primary"
    type="submit">Save</button>
  </div>
  <div class="col m9 s12  mb-2  mt-1" id="messageNewAssignment">
  </div>
</div>


</form>
@endsection
@push('js')
<script src="{{ asset('js/scripts/form-layouts.js') }}" type="text/javascript"></script>
<script>

 $(() => {
  var token = document.head.querySelector('meta[name="csrf-token"]');
  const config = {
    headers: { 
      'X-CSRF-TOKEN': token.content,
      'content-type': 'multipart/form-data'
    }
  }


  $("#assignment_file").change(function(e) {
   var assignment_name, file_ext;
   var assignment_name = e.target.files[0].name;
   file_ext = assignment_name.substr((assignment_name.lastIndexOf('.') + 1));
   assignment_name = assignment_name.substring(0, assignment_name.length - file_ext.length - 1);
   $('#assignment_name').val(assignment_name);
   $('#file_ext').val(file_ext);
   formData= new FormData();
   formData.append("image", file);


   const form = document.querySelector('#new-assignment');
   var formData = new FormData(form);
   axios.post(bURL+'dashboard/translator/update-profile', formData, config)
   .then(function (res) {
    console.log(res.data.message);
    if(res.data.message === true){
      var msg = `<div class="card-alert card  lighten-5">
      <div class="card-content green-text">
      <p>Success! Assignment saved successfully and notified to all translator</p>
      </div>
      </div>`;      
    }else{
      var msg = `<div class="card-alert card  lighten-5">
      <div class="card-content red-text">
      <p>Error! Have problem regarding save this assignment</p>
      </div>
      </div>`;
    }
    $('#messageNewAssignment').html(msg);
    $('#messageNewAssignment').empty().show().html(msg).delay(3000).fadeOut(300);
  })
   .catch(function (err) {
    console.log(err);            
  }); 
   
 });




  document.getElementById('new-assignment').addEventListener('submit', function(e){
    e.preventDefault();
    /* Form Validation Start Here... */
    if($('#bank_statement_hidden').val() == 1 && $('#cancelled_cheque_hidden').val() == 1){
      var names = ['bank_country', 'bank_name', 'bank_branch_address', 'beneficiary_name', 'beneficiary_account_number', 'ifsc_code'];
    }else if($('#bank_statement_hidden').val() == 1 && $('#cancelled_cheque_hidden').val() == 0){
      var names = ['bank_country', 'bank_name', 'bank_branch_address', 'beneficiary_name', 'beneficiary_account_number', 'ifsc_code', 'cancelled_cheque',];
    }else if($('#bank_statement_hidden').val() == 0 && $('#cancelled_cheque_hidden').val() == 1){
      var names = ['bank_country', 'bank_name', 'bank_branch_address', 'beneficiary_name', 'beneficiary_account_number', 'ifsc_code', 'bank_statement'];
    }else{
      var names = ['bank_country', 'bank_name', 'bank_branch_address', 'beneficiary_name', 'beneficiary_account_number', 'ifsc_code', 'bank_statement', 'cancelled_cheque'];
    }
    var errorCount = 0;
    names.forEach((el) => {
      var val = document.forms["new-assignment"][el].value;
      if (val == null || val == "") {
        document.getElementById(el + '_error').style = 'color:red';
        document.getElementById(el + '_error').focus();
        document.getElementById(el + '_error').textContent = 'Required!!!';
        ++errorCount;
      }else{
        document.getElementById(el + '_error').textContent = '';
      }
    });
    if (errorCount) return true;
    /* Form Validation End Here... */
    const form = document.querySelector('#new-assignment');
    var formData = new FormData(form);
    axios.post(bURL+'dashboard/translator/update-profile', formData, config)
    .then(function (res) {
      console.log(res.data.message);
      if(res.data.message === true){
        var msg = `<div class="card-alert card  lighten-5">
        <div class="card-content green-text">
        <p>Success! Assignment saved successfully and notified to all translator</p>
        </div>
        </div>`;      
      }else{
        var msg = `<div class="card-alert card  lighten-5">
        <div class="card-content red-text">
        <p>Error! Have problem regarding save this assignment</p>
        </div>
        </div>`;
      }
      $('#messageNewAssignment').html(msg);
      $('#messageNewAssignment').empty().show().html(msg).delay(3000).fadeOut(300);
    })
    .catch(function (err) {
      console.log(err);            
    });          
  });
});
</script>
@endpush