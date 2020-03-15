@extends('layouts.app')
@section('content')
    @include('home.inc.page_bg')
    @include('home.inc.page_border')
    <header class="nk-header nk-header-opaque">
        @include('inc.cms.topNav')
        @include('inc.cms.nav')
    </header>
    @include('inc.cms.rightNav')
    @include('inc.cms.mobileNav')
    <div class="nk-main">
		@include('inc.cms.signForms')
    	<div class="container text-xs-center">
    		<div class="nk-gap-6"></div>
    		<div class="nk-gap-2"></div>
    		<div class="container">
    			@if (isset($_POST['SC']))
    				@if(count($data['dropfinder']->fet) > 0)
    					<form method="POST">
    						<div class="table-responsive">
    							<table class="table table-sm table-dark2">
    								<thead>
										<tr>
											<th align="middle">Item Name</th>
											<th align="middle">Select</th>
										</tr>
									</thead>
									<tbody>
										@foreach($data['dropfinder']->fet as $fet)
											<tr>
												<td>{{$fet[0]}}</td>
												<td><input align="middle" type="radio" name="ItemID" value="{{$fet['ItemID']}}"></td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<button type="submit" class="nk-btn nk-btn-color-main-1" name="SCI" style="margin-left:10px;">Submit</button>
						</form>
						@else
							<h1 class="display-7">No Item's Found!!</h1>
    				@endif
    				@elseif (isset($_POST['SCI']))
    					@if (!isset($_POST['ItemID']))
    						@php die('You didn\'t select an item!'); @endphp
    					@endif
    					@if(count($data['dropfinder']->fet) > 0)
    						<form method="POST">
    							<div class="table-responsive">
    								<table class="table table-sm table-dark2">
    									<thead>
											<tr>
												<th>MobName</th>
												<th>Mob Ele</th>
												<th>Mob Level</th>
												<th>Map Name</th>
												<th>Drop Rate</th>
											</tr>
										</thead>
										<tbody>
											@foreach($data['dropfinder']->fet as $fet)
												<tr>
													<td>{{$fet['MobName']}}</td>
													<td><img src="/resources/themes/core/images/dropfinder/ele_{{$fet['Attrib']}}.png"></td>
													<td>{{$fet['Level']}}</td>
													<td>{{$data['dropfinder']->getMaps($fet['MapID'])}}</td>
													<td>
														@php
															$DropRate=$fet['DropRate'];
															if ($fet['ItemOrder']>5){
																$DropRate=($DropRate/100);
															}if ($DropRate>100){
																$DropRate=100;
															}
															echo (($DropRate)." %");
														@endphp
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</form>
							@else
								<h1 class="display-7">No Drops Found!!</h1>
    					@endif
    				@else
    					<form method="POST">
    						<div class="form-group row">
    							<div class="col-md-4 hidden-sm-down"></div>
    							<div class="input-group col-md-4 col-sm-12">
    								<input type="text" placeholder="Item Name" class="form-control tac b_i" name="item" />
    								<div class="input-group-append">
    									<button type="submit" class="nk-btn nk-btn-color-main-1" name="SC" style="margin-left:10px;">Submit</button>
									</div>
								</div>
							</div>
						</form>
						@php Separator(10); @endphp
    			@endif
			</div>
		</div>
		@php Separator(120); @endphp
    </div>
@endsection