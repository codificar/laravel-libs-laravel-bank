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
	<createbank
		index-route = "{{ URL::Route('bank_panel.index') }}"
		store-route = "{{ URL::Route('bank_panel.store') }}"	
		panel-route = "{{ URL::Route('PanelBank') }}"	

		is-edit = "{{ false }}"		
		>
	</createbank>
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
<script src="{{ elixir('vendor/codificar/bank/bank.vue.js') }}"> </script> 
@stop

