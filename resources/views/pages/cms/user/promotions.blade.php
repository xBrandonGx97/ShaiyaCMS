@extends('layouts.cms.app')
@section('title', 'Promotions')
@section('zone', 'CMS')
@section('headerTitle', 'Promotions')
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
        <div class="container text-xs-center">
            @Separator(80)
            <h2 class="display-4">Promotions</h2>
            @if (!$data['User']['LoginStatus']==true)
                <p>Please login to continue.</p>
            @else
                <form method="post">
                    <div class="form-group row">
                        <div class="col-md-4 hidden-sm-down"></div>
                        <div class="input-group col-md-4 col-sm-12">
                            <input type="text" placeholder="Promotion Code" class="form-control" name="code"/>
                        </div>
                    </div>
                    <button type="submit" class="nk-btn nk-btn-color-main-1" name="Promo" style="margin-left:10px;">
                            Submit
                    </button>
                </form>
                @if (isset($_POST['Promo']))
                    @if(count($data['promotions']->getPromotions()) === 0)
                        Code not found.
                    @else
                        @foreach($data['promotions']->getPromotions() as $promotions)
                            @if($promotions->NumOfUses==$promotions->MaxUses || $promotions->NumOfUses>$promotions->MaxUses)
                                Code has reached maximum number of uses.
                            @else
                                @php $data['promotions']->validations($promotions->NumOfUses,$_POST['code']); @endphp
                                Successfully redeemed code: {{$promotions->Code}}
                                for {{$promotions->Points}} Donation Points.
                            @endif
                        @endforeach
                    @endif
                @endif
            @endif
        </div>
        @Separator(40)
        @Separator(80)
        @include('layouts.cms.footer')
    </div>
@endsection