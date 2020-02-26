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
        <div class="nk-box bg-dark-1">
            <div class="container text-xs-center">
                <div class="nk-gap-6"></div>
                <div class="nk-gap-2"></div>
                <h2 class="nk-title h1 text-center">PvP Rankings</h2>
                <div class="container">
                    @php require_once(APPROOT.'/views/community/rankings/rank.controller.php'); @endphp
                </div>
            </div>
        @php Separator(120); @endphp
        </div>
    </div>
    <script>
	$(document).ready(function(){
		$('.RankTable').DataTable({
			"scrollX": false,
			"pageLength":15,
			"bAutoWidth":false,
			"language": {
    			"paginate": {
      				"previous": "&#8592;",
      				"next": "&#8594;"
    			}
  			},
			initComplete:function(){
				this.api().columns([2,4,5,8]).every(function(){
					var column = this;
					var select = $('<select class="form-control"><option value="">Show all</option></select>')
						.appendTo($(column.footer()).empty())
						.on('change',function(){
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);

							column.search(val?'^'+val+'$':'',true,false).draw();
						});

					column.data().unique().sort().each(function(d,j){
						select.append( '<option value="'+d+'">'+d+'</option>' )
					});
				});
			},
		});
		$('.pagination a').addClass('custom_pagination');
	});
</script>
@endsection