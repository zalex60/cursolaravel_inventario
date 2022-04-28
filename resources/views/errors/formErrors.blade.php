@if($errors->any())
<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<ul>
		@foreach ($errors->all() as $error)
		<li><p>{!! $error !!}</p></li>
		@endforeach
	</ul>
</div>
@endif
@if(Session::has('message_danger'))
<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<ul>
		<li><p>{{ Session::get('message_danger') }}</p></li>
	</ul>
</div>
@endif
@if(Session::has('message_success'))
<div class="alert alert-success alert-dismissible" id="message_infoSucces">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<ul>
		<li><p>{{ Session::get('message_success') }}</p></li>
	</ul>
</div>
@endif
@if(Session::has('message_info'))
<div class="alert alert-info alert-dismissible" id="message_infoSucces">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<ul>
		<li><p>{{ Session::get('message_info') }}</p></li>
	</ul>
</div>
@endif
