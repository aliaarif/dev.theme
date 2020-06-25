@extends('layouts.user')

@section('content')
<manage-translators></manage-translators>
@endsection
@push('js')
<!-- <script src="{{ asset('vendors/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/scripts/form-file-uploads.min.js') }}"></script> -->
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script>
$(() => {
	//alert(sessionStorage.getItem("userRole"));
})

</script>
@endpush
@push('css')
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('vendors/dropify/css/dropify.min.css') }}"> -->
@endpush