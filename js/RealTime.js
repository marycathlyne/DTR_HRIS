<script type="text/javascript">
	var offset = Math.round(new Date().getTime() / 1000);
	tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
	tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

	function GetClock(){
		var d=new Date();
		d.setSeconds(d.getSeconds() + <?php echo time(); ?> - offset);
		var nday=d.getDay(),nmonth=d.getMonth()+1,ndate=d.getDate(),nyear=d.getYear();
		if(nyear<1000) nyear+=1900;
		var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

		if(nhour==0){ap=" AM";nhour=12;}
			else if(nhour<12){ap=" AM";}
			else if(nhour==12){ap=" PM";}
			else if(nhour>12){ap=" PM";nhour-=12;}

			if(nmin<=9) nmin="0"+nmin;
				if(nsec<=9) nsec="0"+nsec;

				document.getElementById('clockbox').innerHTML=""+tday[nday]+"";
				document.getElementById('clockbox2').innerHTML=" "+[nmonth]+"/"+ndate+"/"+nyear+"   ";
				document.getElementById('clockbox3').innerHTML=""+nhour+":"+nmin+":"+nsec+ap+" ";
				// document.getElementById('clockbox').innerHTML=""+tday[nday]+" "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
			}

			window.onload=function(){
			GetClock();
			setInterval(GetClock,1000);
		}
</script>
