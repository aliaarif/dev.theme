@if(request()->ajax())
<div class="row align-items-center options">
	<div class="col-sm-12">
		<h5 class="pt-2 pb-2 bg-primary text-center" style="color:#fff;">Extras</h5>
	</div>
	
	<div class="col-sm-4">
		<label class="form-control-label">Option</label>
		<input type="text" name="option[]" class="form-control" value="" placeholder="size">
	</div>
	<div class="col-sm-8">
		<label class="form-control-label">Values</label>
		<input type="text" name="values[]" class="form-control" placeholder="options1 | option2 | option3" />
		<label class="form-control-label">Additional Prices</label>
		<input type="text" name="prices[]" class="form-control" placeholder="price1 | price2 | price3" />
	</div>


	<div class="file-field input-field col m6 s12">
<div class="btn">
<span>Education Certificate</span>
  <input type="file" id="education_certificate" name="education_certificate" accept="image/jpeg" class="validate"  required>
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text">
</div>
</div>

<div class="file-field input-field col m6 s12">
<div class="btn">
<span>Professional Certificate</span>
  <input type="file" id="education_certificate" name="photo" accept="image/jpeg" class="validate"  required>
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text">
</div>
</div>
</div>
@else
<p class="alert alert-danger">You Can not Access Directly!!!!</p>
@endif