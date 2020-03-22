<script>
var curday;
var secTime;
var ticker;
 
function getSeconds(){
 var currenttime='<?php print date("F d, Y H:i:s", time())?>';
 var nowDate=new Date(currenttime);
 var dy=0; //Sunday through Saturday, 0 to 6
 var countertime=new Date(nowDate.getFullYear(),nowDate.getMonth(),nowDate.getDate(),15,0,0); //20 out of 24 hours = 8pm
 
 var curtime=nowDate.getTime();
 var atime=countertime.getTime();
 var diff=parseInt((atime - curtime)/1000);
  if (diff>0){
    curday = dy - nowDate.getDay();
  }
  else{
   curday=dy-nowDate.getDay()-1;
  }
  if (curday<0){
   curday += 7;
  }
  if (diff<=0){
  diff += (86400 * 7);
  }
  startTimer (diff);
}
 
function startTimer(secs){
 secTime = parseInt(secs);
 ticker = setInterval("tick()",1000);
 tick();
}

function tick(){
 var secs = secTime;
 if (secs>0){
  secTime--;
 }
 else{
  clearInterval(ticker);
  getSeconds();
 }
 
 var days = Math.floor(secs/86400);
 secs %= 86400;
 var hours= Math.floor(secs/3600);
 secs %= 3600;
 var mins = Math.floor(secs/60);
 secs %= 60;
    var DispDays = 'Day(s)';
    var DispHours = 'Hours';
    var DispMins = 'Minutes';
    var DispSecs = 'Seconds';
 //update the time display
 /*document.getElementById("days1").innerHTML = curday+" "+DispDays+" "+hours+" "+DispHours+" "+mins+" "+DispMins+" "+secs+" "+DispSecs;
 document.getElementById("servertime1").innerHTML=curday+" "+hours;
 document.getElementById("hours").innerHTML = ((hours < 10 ) ? "0" : "" ) + hours;
 document.getElementById("minutes").innerHTML = ( (mins < 10) ? "0" : "" ) + mins;
 document.getElementById("seconds").innerHTML = ( (secs < 10) ? "0" : "" ) + secs;*/
 $('#timer').html(curday+" "+DispDays+" "+hours+" "+DispHours+" "+mins+" "+DispMins+" "+secs+" "+DispSecs);
}

$(document).ready(function(){
  getSeconds();
});
    
</script>