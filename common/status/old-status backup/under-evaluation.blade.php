@if(!Request::segment(3)  ||  Request::segment(4) == 'active-assignments'  ||  Request::segment(4) == 'live-feed'   ||  Request::segment(4) == 'contracts' )
<div id="intro">
<div id="img-modal" class="modal modal1 modalA black darken-1" style="position: fixed; top: 65px !important; left: 250px !important;  width: auto !important;  height: auto !important; max-height: 100% !important; background-color: #000000;">
<div class="modal-content">
<h4 align="center" class="mt-5 white-text" >Welcome to ArabEasy</h4>
<h5 align="center" class="mt-5 white-text">Please complete the steps below</h5>
<div class="carousel carousel-slider center intro-carousel" >
<div class="carousel-fixed-item center middle-indicator" style="height: 110px;">
<div class="left">
<button class=" movePrevCarousel middle-indicator-text btn btn-flat white-text waves-effect waves-light btn-prev">
<span class="white-text">Prev</span>
</button>
</div>
<div class="right">
<button class=" moveNextCarousel middle-indicator-text btn btn-flat white-text waves-effect waves-light btn-next">
<span class="white-text">Next</span>
</button>
</div>
</div>
<div class="carousel-item slide-1">
<h5 class="intro-step-title mt-5 center animated fadeInUp white-text">Go to My profile > Evaluation</h5>
<h5 class="intro-step-title mt-5 center animated fadeInUp white-text">
<a href="{{ route('dashboard.translator.myprofile.evaluation') }}" class="waves-effect waves-dark btn btn-lg btn-primary">Go to the Section</a>
</h5>
</div>
<div class="carousel-item slide-2">
<h5 class="intro-step-title mt-5 center animated fadeInUp white-text">Take the tests for the Direction of Language pairs you wish to work in</h5>
<h5 class="intro-step-title mt-5 center animated fadeInUp white-text">
<a  href="{{ route('dashboard.translator.myprofile.evaluation') }}" class="waves-effect waves-dark btn btn-lg btn-primary">Go to the Section</a>
</h5>
</div>
<div class="carousel-item slide-3">
<h5 class="intro-step-title mt-5 center animated fadeInUp white-text">Pass the evaluation and complete your profile</h5>
<h5 class="intro-step-title mt-5 center animated fadeInUp white-text">
<a  href="{{ route('dashboard.translator.myprofile.evaluation') }}" class="waves-effect waves-dark btn btn-lg btn-primary">Go to the Section</a>
</h5>

</div>
</div>
</div>
</div>
</div>

@endif

@push('js')
<script type="text/javascript">
$(() => {
    $('#intro').removeClass();
    $("#modal1").modal('open', {
        dismissible: false,
    }); 
    $('#img-modal').removeClass('black');
    $('#img-modal').addClass('black1');
    
});
</script>
@endpush