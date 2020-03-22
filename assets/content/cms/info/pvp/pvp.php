<?php
	/*
	echo '<div class="container bg-dark">';
		echo '<div class="row">';
			echo '<div class="col-md-12">';
				echo '<h2 class="title text-center text-white">PVP Rankings</h2>';
		echo '<form id="rankingsForm" name="rankingsForm" method="post" action="?'.$this->Setting->PAGE_PREFIX.'=RANK_CONTROLLER">';
			echo '<div class="row">';
			echo '<div class="col-md-12 text-center">';
			echo '<fieldset class="border">';
				echo '<legend>Level Range</legend>';
				echo '<select name="level" class="rankingsFormFilter" style="width:100px;">';
					echo '<option value="">Any</option>';
					echo '<option value="1">1 - 15</option>';
					echo '<option value="2">20 - 30</option>';
					echo '<option value="3">31 - Max</option>';
				echo '</select>';
			echo '</fieldset>';
			echo '<fieldset class="border">';
				echo '<legend>Class</legend>';
				echo '<select name="class" class="rankingsFormFilter" style="width:100px;">';
					echo '<option value="">Any</option>';
					echo '<option value="fighter">Fighter</option>';
					echo '<option value="defender">Defender</option>';
					echo '<option value="archer">Archer</option>';
					echo '<option value="ranger">Ranger</option>';
					echo '<option value="mage">Mage</option>';
					echo '<option value="priest">Priest</option>';
					echo '<option value="warrior">Warrior</option>';
					echo '<option value="guardian">Guardian</option>';
					echo '<option value="hunter">Hunter</option>';
					echo '<option value="assassin">Assassin</option>';
					echo '<option value="pagan">Pagan</option>';
					echo '<option value="oracle">Oracle</option>';
				echo '</select>';
			echo '</fieldset>';
			echo '<fieldset class="border">';
				echo '<legend>Faction</legend>';
				echo '<select name="faction" class="rankingsFormFilter" style="width:100px;">';
					echo '<option value="">Any</option>';
					echo '<option value="1">Alliance of Light</option>';
					echo '<option value="2">Union of Fury</option>';
				echo '</select>';
			echo '</fieldset>';
			echo '<fieldset class="border">';
				echo '<legend>Filter</legend>';
				echo '<input type="button" id="rankingsFormSubmit" value="Go!" style="width:50px;" />';
			echo '</fieldset>';
			echo '</div>';
			echo '</div>';
		echo '</form>';
		echo '</div>';
		echo '</div>';

		echo '<div class="row">';
			echo '<div class="col-md-12">';
				echo '<div id="div1"></div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	*/
	echo '<div class="container bg-dark">';
		echo '<div class="row">';
			echo '<div class="col-md-12">';
				echo '<h2 class="title text-center text-white">PVP Rankings</h2>';
				
			echo '</div>';
		echo '</div>';
#		echo '<div class="table-responsive">';
					require_once('rank.controller.php');
#				echo '</div>';
	echo '</div>';
?>
<script>
	$(document).ready(function(){
		$('.RankTable').DataTable({
			"scrollX": false,
			"pageLength":5,
			"bAutoWidth":false,
			initComplete:function(){
				this.api().columns([2,4,5,8]).every(function(){
			//	this.api().columns().every(function(){
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
//						var val = $('<div/>').html(d).text();
//						select.append('<option value="'+val+'">'+val+'</option>');
					});
				});
			},
		});
	});
/*
	$(document).ready(function(){
		$("#div1").load("assets/content/cms/info/pvp/rank.controller.php",function(responseTxt,statusTxt,xhr){
			if(statusTxt=="success"){
			//	alert("External content loaded successfully!");
			}
			if(statusTxt=="error"){
				alert("Error: "+xhr.status+":"+xhr.statusText);
			}
		});
	});
*/
</script>