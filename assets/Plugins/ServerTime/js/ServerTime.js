<script type="text/javascript">
	var currenttime = '<?php print date("F d,Y h:i:s A", time())?>'
	var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
	var serverdate=new Date(currenttime)
	function padlength(what){
		var output=(what.toString().length==1)?"0"+what:what
		return output
	}
	function displaytime(){
		serverdate.setSeconds(serverdate.getSeconds()+1)
		var datestring=montharray[serverdate.getMonth()]+" "+padlength(serverdate.getDate())+", "+serverdate.getFullYear()
		var timestring=padlength(serverdate.getHours())+":"+padlength(serverdate.getMinutes())+":"+padlength(serverdate.getSeconds())
		document.getElementById("server_date").innerHTML=datestring
		document.getElementById("server_time").innerHTML=timestring
	}
	window.onload=function(){
		setInterval("displaytime()", 1000)
	}
</script>