@extends('layouts.cms.app')
@section('title', 'Drops')
@section('zone', 'CMS')
@section('content')
    {{-- @include('pages.cms.home.inc.page_bg') --}}
    @include('partials.cms.pageBorder')
    <header class="nk-header nk-header-opaque">
        @include('partials.cms.topNav')
      	@include('partials.cms.nav')
    </header>
    @include('partials.cms.rightNav')
		@include('partials.cms.mobileNav')
    <div class="nk-main">
			@include('partials.cms.pageHeader')
			@include('partials.cms.signForms')
    	<div class="nk-box bg-dark-1 text-white">
			<div class="nk-gap-4"></div>
			<div class="container">
			<h2 class="display-4 text-center">Shaiya Notorious Drop List</h2>
			<p class="text-center">Last Updated: March 13,2019.</p>
				<div class="row">
					<div class="col-md-8 offset-md-2">
						<div class="nk-accordion" id="accordion-3" role="tablist" aria-multiselectable="true">
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="accordion-3-1-heading">
									<a class="collapsed" data-toggle="collapse" data-parent="#accordion-3" href="#accordion-3-1" aria-expanded="false" aria-controls="accordion-3-1"><i class="fa float-right" aria-hidden="true"></i>
										Erina (Map 1 AoL)
									</a>
								</div>
								<div id="accordion-3-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-3-1-heading">
								<div class="nk-gap-1"></div>
									<table class="drops">
										<thead>
											<tr>
												<th>Mob Type</th>
												<th>Drop</th>
												<th>Rate</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td rowspan="4">Mobs</td>
											</tr>
											<tr>
												<td>Fortune Coin Lv1</td>
												<td>75%</td>
											</tr>
										</tbody>
									</table>
									<div class="nk-gap-1"></div>
								</div>
							</div>
							<!-- new panel -->
						</div>
					</div>
				</div>
			</div>
			<div class="nk-gap-4"></div>
    		<div class="nk-gap-4"></div>
		</div>
    </div>
@endsection