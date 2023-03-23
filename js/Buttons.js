$(document).ready(function(){
    $('#empid').keyup(function (e) {
      if (e.keyCode === 13) {
         showModal();
      }
    });
    $("#INAM").click(function(){
        $('#empid').focus();
        document.getElementById('Message').innerHTML ="";
        document.getElementById('LockMessage').innerHTML ="";
        document.getElementById('Fullname').innerHTML ="";
        document.getElementById('LINAM').innerHTML ="";
        document.getElementById('LOUTAM').innerHTML ="";
        document.getElementById('LINPM').innerHTML ="";
        document.getElementById('LOUTPM').innerHTML ="";
        document.getElementById('LBREAKOUT').innerHTML ="";
        document.getElementById('LBREAKIN').innerHTML ="";
        document.getElementById('LOVERTIMEIN').innerHTML ="";
        document.getElementById('LOVERTIMEOUT').innerHTML ="";
        $('#Picture').error();
        document.getElementById('buttonclick').innerHTML = document.getElementById('INAM').innerHTML;
         //document.getElementById('buttonclick').innerHTML = 'INAM';
        document.getElementById('btnclick').value = 'INAM';
        $("#OUTAM, #INPM, #OUTPM,#BREAKIN,#BREAKOUT,#INOT,#OUTOT,#INQUIRE").css({
            "color": "#fff",
            "background-color": "#0275d8",
            "border-color": "#fff"
        });
        $("#INAM").css({
            "color": "#fff",
            "background-color": "#CD2539",
            "border-color": "#0275d8"
        });
    });
    //======================================================================================================
    $("#OUTAM").click(function(){
        $('#empid').focus();
        document.getElementById('Message').innerHTML ="";
        document.getElementById('LockMessage').innerHTML ="";
        document.getElementById('Fullname').innerHTML ="";
        document.getElementById('LINAM').innerHTML ="";
        document.getElementById('LOUTAM').innerHTML ="";
        document.getElementById('LINPM').innerHTML ="";
        document.getElementById('LOUTPM').innerHTML ="";
        document.getElementById('LBREAKOUT').innerHTML ="";
        document.getElementById('LBREAKIN').innerHTML ="";
        document.getElementById('LOVERTIMEIN').innerHTML ="";
        document.getElementById('LOVERTIMEOUT').innerHTML ="";
        $('#Picture').error();
        document.getElementById('buttonclick').innerHTML = document.getElementById('OUTAM').innerHTML;
        // document.getElementById('buttonclick').innerHTML = 'OUTAM';
        document.getElementById('btnclick').value = 'OUTAM';

        $("#INAM, #INPM, #OUTPM,#BREAKIN,#BREAKOUT,#INOT,#OUTOT,#INQUIRE").css({
          "color": "#fff",
          "background-color": "#0275d8",
          "border-color": "#fff"
        });
        $("#OUTAM").css({
            "color": "#fff",
            "background-color": "#CD2539",
            "border-color": "#0275d8"
        });
    });
    //======================================================================================================
    $("#INPM").click(function(){
        $("#INAM, #OUTAM, #OUTPM,#BREAKIN,#BREAKOUT,#INOT,#OUTOT,#INQUIRE").css({
            "color": "#fff",
            "background-color": "#0275d8",
            "border-color": "#fff"
        });
        $("#INPM").css({
            "color": "#fff",
            "background-color": "#CD2539",
            "border-color": "#0275d8"
        });
        $('#empid').focus();
        document.getElementById('Message').innerHTML ="";
        document.getElementById('LockMessage').innerHTML ="";
        document.getElementById('Fullname').innerHTML ="";
        document.getElementById('LINAM').innerHTML ="";
        document.getElementById('LOUTAM').innerHTML ="";
        document.getElementById('LINPM').innerHTML ="";
        document.getElementById('LOUTPM').innerHTML ="";
        document.getElementById('LBREAKOUT').innerHTML ="";
        document.getElementById('LBREAKIN').innerHTML ="";
        document.getElementById('LOVERTIMEIN').innerHTML ="";
        document.getElementById('LOVERTIMEOUT').innerHTML ="";
        $('#Picture').error();
        document.getElementById('buttonclick').innerHTML = document.getElementById('INPM').innerHTML;
         // document.getElementById('buttonclick').innerHTML = 'INPM';
        document.getElementById('btnclick').value = 'INPM';
    });
    //======================================================================================================
    $("#OUTPM").click(function(){
        $("#INAM, #OUTAM, #INPM,#BREAKIN,#BREAKOUT,#INOT,#OUTOT,#INQUIRE").css({
        "color": "#fff",
        "background-color": "#0275d8",
        "border-color": "#fff"
      });
      $("#OUTPM").css({
            "color": "#fff",
            "background-color": "#CD2539",
            "border-color": "#0275d8"
        });
       $('#empid').focus();
        document.getElementById('Message').innerHTML ="";
      document.getElementById('LockMessage').innerHTML ="";
      document.getElementById('Fullname').innerHTML ="";
      document.getElementById('LINAM').innerHTML ="";
      document.getElementById('LOUTAM').innerHTML ="";
      document.getElementById('LINPM').innerHTML ="";
      document.getElementById('LOUTPM').innerHTML ="";
      document.getElementById('LBREAKOUT').innerHTML ="";
      document.getElementById('LBREAKIN').innerHTML ="";
      document.getElementById('LOVERTIMEIN').innerHTML ="";
      document.getElementById('LOVERTIMEOUT').innerHTML ="";
      $('#Picture').error();
        document.getElementById('buttonclick').innerHTML = document.getElementById('OUTPM').innerHTML;
        // document.getElementById('buttonclick').innerHTML = 'OUTPM';
        document.getElementById('btnclick').value = 'OUTPM';
    });
    //======================================================================================================
    $("#BREAKIN").click(function(){
        $("#INAM, #OUTAM, #INPM,#OUTPM,#BREAKOUT,#INOT,#OUTOT,#INQUIRE").css({
          "color": "#fff",
          "background-color": "#0275d8",
          "border-color": "#fff"
        });
        $("#BREAKIN").css({
              "color": "#fff",
              "background-color": "#CD2539",
              "border-color": "#0275d8"
          });
       $('#empid').focus();
       document.getElementById('Message').innerHTML ="";
      document.getElementById('LockMessage').innerHTML ="";
      document.getElementById('Fullname').innerHTML ="";
      document.getElementById('LINAM').innerHTML ="";
      document.getElementById('LOUTAM').innerHTML ="";
      document.getElementById('LINPM').innerHTML ="";
      document.getElementById('LOUTPM').innerHTML ="";
      document.getElementById('LBREAKOUT').innerHTML ="";
      document.getElementById('LBREAKIN').innerHTML ="";
      document.getElementById('LOVERTIMEIN').innerHTML ="";
      document.getElementById('LOVERTIMEOUT').innerHTML ="";
      $('#Picture').error();
        document.getElementById('buttonclick').innerHTML = document.getElementById('BREAKIN').innerHTML;
        // document.getElementById('buttonclick').innerHTML = 'BREAKIN';
        document.getElementById('btnclick').value = 'BREAKIN';
    });
    //======================================================================================================
    $("#BREAKOUT").click(function(){
       $("#INAM, #OUTAM, #INPM,#OUTPM,#BREAKIN,#INOT,#OUTOT,#INQUIRE").css({
          "color": "#fff",
          "background-color": "#0275d8",
          "border-color": "#fff"
        });
        $("#BREAKOUT").css({
              "color": "#fff",
              "background-color": "#CD2539",
              "border-color": "#0275d8"
          });
        $('#empid').focus();
        document.getElementById('Message').innerHTML ="";
      document.getElementById('LockMessage').innerHTML ="";
      document.getElementById('Fullname').innerHTML ="";
      document.getElementById('LINAM').innerHTML ="";
      document.getElementById('LOUTAM').innerHTML ="";
      document.getElementById('LINPM').innerHTML ="";
      document.getElementById('LOUTPM').innerHTML ="";
      document.getElementById('LBREAKOUT').innerHTML ="";
      document.getElementById('LBREAKIN').innerHTML ="";
      document.getElementById('LOVERTIMEIN').innerHTML ="";
      document.getElementById('LOVERTIMEOUT').innerHTML ="";
      $('#Picture').error();
         document.getElementById('buttonclick').innerHTML = document.getElementById('BREAKOUT').innerHTML;
         // document.getElementById('buttonclick').innerHTML = 'BREAKOUT';
         document.getElementById('btnclick').value = 'BREAKOUT';
    });
     //======================================================================================================
    $("#INOT").click(function(){
        $("#INAM, #OUTAM, #INPM,#OUTPM,#BREAKIN,#BREAKOUT,#OUTOT,#INQUIRE").css({
          "color": "#fff",
          "background-color": "#0275d8",
          "border-color": "#fff"
        });
        $("#INOT").css({
          "color": "#fff",
          "background-color": "#CD2539",
          "border-color": "#0275d8"
        });
        $('#empid').focus();
        document.getElementById('Message').innerHTML ="";
      document.getElementById('LockMessage').innerHTML ="";
      document.getElementById('Fullname').innerHTML ="";
      document.getElementById('LINAM').innerHTML ="";
      document.getElementById('LOUTAM').innerHTML ="";
      document.getElementById('LINPM').innerHTML ="";
      document.getElementById('LOUTPM').innerHTML ="";
      document.getElementById('LBREAKOUT').innerHTML ="";
      document.getElementById('LBREAKIN').innerHTML ="";
      document.getElementById('LOVERTIMEIN').innerHTML ="";
      document.getElementById('LOVERTIMEOUT').innerHTML ="";
      $('#Picture').error();
         document.getElementById('buttonclick').innerHTML = document.getElementById('INOT').innerHTML;
         // document.getElementById('buttonclick').innerHTML = 'INOT';
         document.getElementById('btnclick').value = 'INOT';
    });
     //======================================================================================================
    $("#OUTOT").click(function(){
         $("#INAM, #OUTAM, #INPM,#OUTPM,#BREAKIN,#BREAKOUT,#INOT,#INQUIRE").css({
          "color": "#fff",
          "background-color": "#0275d8",
          "border-color": "#fff"
        });
        $("#OUTOT").css({
          "color": "#fff",
          "background-color": "#CD2539",
          "border-color": "#0275d8"
        });
       $('#empid').focus();
       document.getElementById('Message').innerHTML ="";
      document.getElementById('LockMessage').innerHTML ="";
      document.getElementById('Fullname').innerHTML ="";
      document.getElementById('LINAM').innerHTML ="";
      document.getElementById('LOUTAM').innerHTML ="";
      document.getElementById('LINPM').innerHTML ="";
      document.getElementById('LOUTPM').innerHTML ="";
      document.getElementById('LBREAKOUT').innerHTML ="";
      document.getElementById('LBREAKIN').innerHTML ="";
      document.getElementById('LOVERTIMEIN').innerHTML ="";
      document.getElementById('LOVERTIMEOUT').innerHTML ="";
      $('#Picture').error();
        document.getElementById('buttonclick').innerHTML = document.getElementById('OUTOT').innerHTML;
        // document.getElementById('buttonclick').innerHTML = 'OUTOT';
        document.getElementById('btnclick').value = 'OUTOT';
    });
     //======================================================================================================
    $("#INQUIRE").click(function(){
         $("#INAM, #OUTAM, #INPM,#OUTPM,#BREAKIN,#BREAKOUT,#INOT,#OUTOT").css({
          "color": "#fff",
          "background-color": "#0275d8",
          "border-color": "#fff"
        });
        $("#INQUIRE").css({
          "color": "#fff",
          "background-color": "#CD2539",
          "border-color": "#0275d8"
        });
       $('#empid').focus();
        document.getElementById('Message').innerHTML ="";
      document.getElementById('LockMessage').innerHTML ="";
      document.getElementById('Fullname').innerHTML ="";
      document.getElementById('LINAM').innerHTML ="";
      document.getElementById('LOUTAM').innerHTML ="";
      document.getElementById('LINPM').innerHTML ="";
      document.getElementById('LOUTPM').innerHTML ="";
      document.getElementById('LBREAKOUT').innerHTML ="";
      document.getElementById('LBREAKIN').innerHTML ="";
      document.getElementById('LOVERTIMEIN').innerHTML ="";
      document.getElementById('LOVERTIMEOUT').innerHTML ="";
      $('#Picture').error();
        document.getElementById('buttonclick').innerHTML = document.getElementById('INQUIRE').innerHTML;
        // document.getElementById('buttonclick').innerHTML = 'OUTOT';
        document.getElementById('btnclick').value = 'INQUIRE';
    });
    // $('SCANNING_form').submit(function() 
    // {
    //     alert("HI");
    // }) 
});