@extends('layout.master')

@section('breadcrumbs')
<div class="row page-titles">
	<div class="col-md-6 col-8 align-self-center">
		<h3 class="text-themecolor m-b-0 m-t-0">{{ trans("customize.Request") }}</h3>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans("dashboard.home") }}</a></li>
			<li class="breadcrumb-item active">{{ trans("customize.Request") }}</li>
		</ol>
	</div>
</div>	
@stop
@section('content')
<div id="VueJs" class="col-lg-12">
	<bankpanel
		index-route = "{{ URL::Route('banks.index') }}"
		countries-route = "{{ URL::Route('Countries') }}"
		filter-route = "{{ URL::Route('BankPanelFilter') }}"
		create-route = "{{ URL::Route('CreateBank') }}"		
		update-route = "{{ URL::Route('UpdateBank', '') }}"	
		delete-route = "{{ URL::Route('banks.destroy', '') }}"
		>
	</bankpanel>
</div>
@stop

@section('styles')
@stop

@section('javascripts')
<!--Autocomplete-->
<script type="text/javascript">
    var translate = [];
    translate["reviews.loading"] = "{{trans('reviews.loading') }}";
    translate["user_provider_web.rate"] = "{{ trans('user_provider_web.rate') }}";
</script>
<script src="/js/lang.trans/requests,dashboard,provider"> </script> 
<script src="/libs/lang.trans/bank"> </script> 
<script src="{{ asset('vendor/codificar/bank/bank.vue.js') }}"> </script> 
<script> window.locale = '{{ app()->getLocale() }}' </script>
@stop

