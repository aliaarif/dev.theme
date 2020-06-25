@extends('layouts.user')

@section('content')
<template>
<div class="container">
<div class="row">
<div class="col s12 m12 l12">
Information Goes Here...
</div>
</div>
</div>
</template>
@endsection

@push('css')
<style type="text/css">
.modal {
	max-height: 90%;
	color:white;
	
}
.txtWhite{
	color: #FFFFFF;
}
</style>
@endpush

@push('js')
<!-- <script src="{{ asset('js/app.js') }}" type="text/javascript"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.5/vue.min.js" integrity="sha256-GOrA4t6mqWceQXkNDAuxlkJf2U1MF0O/8p1d/VPiqHw=" crossorigin="anonymous"></script>



<script>
const app = new Vue({
	el: '#liveFeed',
	data :{
		
		modalCounter:1,
		
	},
	created() {
		
		localStorage.setItem('modalCounter', this.modalCounter);
		
		//alert('Vue js lib is working!');
		
	},          
	methods:{
		
	},
	mounted:function(){
		var element = document.getElementById('intro');
		if(localStorage.getItem('modalCounter') > 1){
			element.parentNode.removeChild(element);
		} 
	},
});
</script>
@endpush
