@extends('layouts.user')
@section('content')
<manage-assignments></manage-assignments>
@endsection
@push('js')
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/scripts/form-file-uploads.js') }}"></script>
@endpush
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/flag-icon/css/flag-icon.min.css') }}">
@endpush
