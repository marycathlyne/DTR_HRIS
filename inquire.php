<?php 

//- Variables - for your RPT and PDF 
echo "Print Report Test"; 
$my_report = "C:\\TestFolder\\SubFolder1\\MyWebReport.rpt"; // 
rpt source file 
$my_pdf = "C:\\TestFolder\\SubFolder1\\MyWebReport.pdf"; // RPT export to pdf file 
//-Create new COM object-depends on your Crystal Report version 
$ObjectFactory= new COM("CrystalReports115.ObjectFactory.1") or die ("Error on load"); // call COM port 
$crapp = $ObjectFactory-> CreateObject("CrystalDesignRunTime.Application"); // create an instance for Crystal 
$creport = $crapp->OpenReport($my_report, 1); // call rpt report 

// to refresh data before 

//- Set database logon info - must have 
$creport->Database->Tables(1)->SetLogOnInfo("servername", "DBname", "user", "password"); 

//- field prompt or else report will hang - to get through 
$creport->EnableParameterPrompting = 0; 

//- DiscardSavedData - to refresh then read records 
$creport->DiscardSavedData; 
$creport->ReadRecords(); 

    
//export to PDF process 
$creport->ExportOptions->DiskFileName=$my_pdf; //export to pdf 
$creport->ExportOptions->PDFExportAllPages=true; 
$creport->ExportOptions->DestinationType=1; // export to file 
$creport->ExportOptions->FormatType=31; // PDF type 
$creport->Export(false); 

//------ Release the variables ------ 
$creport = null; 
$crapp = null; 
$ObjectFactory = null; 

//------And Now -> Embed the report in the webpage ------ 
print "<embed src=\"C:\\TestFolder\\SubFolder1\\MyWebReport.pdf\" width=\"100%\" height=\"100%\">" 

    
    
?>

 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>