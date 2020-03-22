<?php
	# Content
	Template::_start_mainSection();
		Template::Separator(20);
		Template::_do_pageHead("PvP Rankings");
			require_once('rank.controller.php');
		Template::_do_pageFooter();
		Template::Separator(20);
	Template::_end_mainSection();
?>
<script>
	$(document).ready(function(){
		$('.RankTable').DataTable({
			"scrollX": false,
			"pageLength":25,
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