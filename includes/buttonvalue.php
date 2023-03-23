<?php 
  if(isset($_POST['submit'])) 
  {
    if($_POST['btnclick']=='INAM' )
    {
      echo "<script>
        $(document).ready(function(){
        $('#empid').focus();
        document.getElementById('buttonclick').innerHTML = document.getElementById('INAM').innerHTML;
        document.getElementById('btnclick').value = 'INAM';
        $('#OUTAM, #INPM, #OUTPM,#BREAKIN,#BREAKOUT,#INOT,#OUTOT,#INQUIRE').css({
          'color': '#fff',
          'background-color': '#0275d8',
          'border-color': '#fff'
        });
        $('#INAM').css({
          'color': '#fff',
          'background-color': '#CD2539',
          'border-color': '#0275d8'
        });
      });

      </script>";
    }
    else if($_POST['btnclick']=='OUTAM')
    {
      echo "<script>
        $(document).ready(function(){
          $('#empid').focus();
          document.getElementById('buttonclick').innerHTML = document.getElementById('OUTAM').innerHTML;
          document.getElementById('btnclick').value = 'OUTAM';
          $('#INAM, #INPM, #OUTPM,#BREAKIN,#BREAKOUT,#INOT,#OUTOT,#INQUIRE').css({
          'color': '#fff',
          'background-color': '#0275d8',
          'border-color': '#fff'
        });
        $('#OUTAM').css({
          'color': '#fff',
          'background-color': '#CD2539',
          'border-color': '#0275d8'
        });
      });
      </script>";
    }
     else if($_POST['btnclick']=='INPM')
    {
      echo "<script>
        $(document).ready(function(){
          $('#empid').focus();
          document.getElementById('buttonclick').innerHTML = document.getElementById('INPM').innerHTML;
          document.getElementById('btnclick').value = 'INPM';
          $('#INAM, #OUTAM, #OUTPM,#BREAKIN,#BREAKOUT,#INOT,#OUTOT,#INQUIRE').css({
          'color': '#fff',
          'background-color': '#0275d8',
          'border-color': '#fff'
        });
        $('#INPM').css({
          'color': '#fff',
          'background-color': '#CD2539',
          'border-color': '#0275d8'
        });
      });
      </script>";
    }
     else if($_POST['btnclick']=='BREAKIN')
    { 
      echo "<script>
        $(document).ready(function(){
          $('#empid').focus();
          document.getElementById('buttonclick').innerHTML = document.getElementById('BREAKIN').innerHTML;
          document.getElementById('btnclick').value = 'BREAKIN';
          $('#INAM, #OUTAM, #OUTPM,#INPM,#BREAKOUT,#INOT,#OUTOT,#INQUIRE').css({
          'color': '#fff',
          'background-color': '#0275d8',
          'border-color': '#fff'
        });
        $('#BREAKIN').css({
          'color': '#fff',
          'background-color': '#CD2539',
          'border-color': '#0275d8'
        });
      });
      </script>";
    }
    else if($_POST['btnclick']=='BREAKOUT')
    {
      echo "<script>
        $(document).ready(function(){
        $('#empid').focus();
        document.getElementById('buttonclick').innerHTML = document.getElementById('BREAKOUT').innerHTML;
        document.getElementById('btnclick').value = 'BREAKOUT';
        $('#INAM, #OUTAM, #OUTPM,#INPM,#BREAKIN,#INOT,#OUTOT,#INQUIRE').css({
        'color': '#fff',
        'background-color': '#0275d8',
        'border-color': '#fff'
        });
        $('#BREAKOUT').css({
          'color': '#fff',
          'background-color': '#CD2539',
          'border-color': '#0275d8'
        });
      });
      </script>"; 
    }
    else if($_POST['btnclick']=='OUTPM')
    {
      echo "<script>
        $(document).ready(function(){
          $('#empid').focus();
          document.getElementById('buttonclick').innerHTML = document.getElementById('OUTPM').innerHTML;
          document.getElementById('btnclick').value = 'OUTPM';
          $('#INAM, #OUTAM, #BREAKOUT,#INPM,#BREAKIN,#INOT,#OUTOT,#INQUIRE').css({
          'color': '#fff',
          'background-color': '#0275d8',
          'border-color': '#fff'
        });
        $('#OUTPM').css({
          'color': '#fff',
          'background-color': '#CD2539',
          'border-color': '#0275d8'
        });
      });
      </script>";
    }
    else if($_POST['btnclick']=='INOT')
    {
      echo "<script>
        $(document).ready(function(){
          $('#empid').focus();
          document.getElementById('buttonclick').innerHTML = document.getElementById('INOT').innerHTML;
          document.getElementById('btnclick').value = 'INOT';
          $('#INAM, #OUTAM, #BREAKOUT,#INPM,#BREAKIN,#OUTPM,#OUTOT,#INQUIRE').css({
          'color': '#fff',
          'background-color': '#0275d8',
          'border-color': '#fff'
          });
          $('#INOT').css({
            'color': '#fff',
            'background-color': '#CD2539',
            'border-color': '#0275d8'
          });
        });
      </script>";
    }
    else if($_POST['btnclick']=='OUTOT')
    {
      echo "<script>
        $(document).ready(function(){
          $('#empid').focus();
          document.getElementById('buttonclick').innerHTML = document.getElementById('OUTOT').innerHTML;
          document.getElementById('btnclick').value = 'OUTOT';
          $('#INAM, #OUTAM, #BREAKOUT,#INPM,#BREAKIN,#OUTPM,#INOT,#INQUIRE').css({
          'color': '#fff',
          'background-color': '#0275d8',
          'border-color': '#fff'
          });
          $('#OUTOT').css({
            'color': '#fff',
            'background-color': '#CD2539',
            'border-color': '#0275d8'
          });
        });
      </script>";
    }
    else if($_POST['btnclick']=='INQUIRE')
    {
      echo "<script>
        $(document).ready(function(){
          $('#empid').focus();
          document.getElementById('buttonclick').innerHTML = document.getElementById('INQUIRE').innerHTML;
          document.getElementById('btnclick').value = 'INQUIRE';
          $('#INAM, #OUTAM, #BREAKOUT,#INPM,#BREAKIN,#OUTPM,#INOT,#OUTOT').css({
          'color': '#fff',
          'background-color': '#0275d8',
          'border-color': '#fff'
          });
          $('#INQUIRE').css({
            'color': '#fff',
            'background-color': '#CD2539',
            'border-color': '#0275d8'
          });
        });
      </script>";
    }
  }
  ?>
   <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>