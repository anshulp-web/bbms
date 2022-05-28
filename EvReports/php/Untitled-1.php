<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
// An array to store the benchmarks var $_aBench; // And a function to return it function getBenchmarks(){ return $this->_aBench; } // A pre-existing database connection to use instead of connecting // to the database ourselves var $_oCon = NULL; var $_oQuery = NULL; var $_oFilters = NULL; function setDatabaseConnection(&$_oCon){ $this->_oCon =& $_oCon; } 
<?php 

function setQuery(&$_oQuery)
{
 $this->_oQuery =& $_oQuery; 
}

 function setInputFilters(&$_oFilters)
 { $this->_oFilters =& $_oFilters; } 
 
 function run($sXMLOutputFile=null,$aEnv_=null) 
 {
 
  $sPath = getPHPReportsFilePath(); 
  if(is_null($sPath)) exit("I can't find the paths needed to run. Please refer to the PDF manual to see how to set it."); 
  include_once $sPath."/php/PHPReportEvent.php"; 
  include_once $sPath."/php/PHPReportRpt.php"; 
  include_once $sPath."/php/PHPReportXMLElement.php";
   include_once $sPath."/php/PHPReportForm.php";
    include_once $sPath."/php/PHPReportRow.php"; 
	include_once $sPath."/php/PHPReportColParm.php"; 
	include_once $sPath."/php/PHPReportLink.php"; 
	include_once $sPath."/php/PHPReportBookmark.php"; 
	include_once $sPath."/php/PHPReportImg.php"; 
	include_once $sPath."/php/PHPReportCol.php"; 
	include_once $sPath."/php/PHPReportField.php"; 
	include_once $sPath."/php/PHPReportGroup.php";
	 include_once $sPath."/php/PHPReportPage.php"; 
	 
	 $oReport = new PHPReportRpt($aEnv_); 
 
 // create a default error object for translation, if needed 
 $oError = new PHPReportsErrorTr(); $oParameters = Array(); 
 $oParameters[0] = null;
  // nothing here 
  $oReport->setParameters($oParameters); // no data found message // no data found function // connecting to the database 
  $sSQL = ""; 
  $sUser = ""; 
  $sPass = ""; 
  $sConn = ""; 
  $sData = ""; 
  $sIf = ""; 
  $sSQL = "select item_cd, item_nm, hitem_nm, a.grp_cd, ac_cd, item_rate, b.grp_nm from itemmst a, itemgrpmst b where a.grp_cd = b.grp_cd order by ac_cd"; 
  $sUser = "root"; 
  $sConn = "localhost"; 
  $sData = "evanajmandi"; 
  $sIf = "mysql"; 
  
  // include the database interface file 
  $sIfFile = realpath($sPath."/database/db_".$sIf.".php"); 
  if(!file_exists($sIfFile)) 
  $oError->showMsg("NOIF",$sIf); 
  include_once $sIfFile; // open database connection 
  if(is_null($this->_oCon)) $oCon = @PHPReportsDBI::db_connect(Array($sUser,$sPass,$sConn,$sData)) or $oError->showMsg("REFUSEDCON"); else $oCon = $this->_oCon; if(!is_resource($oCon) && !is_array($oCon)) $oError->showMsg("INVALIDCON"); // input filters 
  
  if($this->_oFilters)
  { 
    foreach($this->_oFilters as $oFilter)
	{
		 $oFilter->setConnection($oCon); 
		 $oFilter->setSQL(trim($sSQL)); 
		 $sSQL = trim($oFilter->run()); } } $this->_aBench["sql_start"] = time(); if(is_null($this->_oQuery)) $oStmt = @PHPReportsDBI::db_query($oCon,trim($sSQL)) or $oError->showMsg("QUERYERROR"); else $oStmt = $this->_oQuery; $this->_aBench["sql_end"] = time(); // get info about the fields $oFields = Array(); $iColNum = @PHPReportsDBI::db_colnum($oStmt); // if no columns were returned, weird! if($iColNum<=0){ @PHPReportsDBI::db_free($oStmt); $oError->showMsg("NOCOLUMNS"); } for($i=1;$i<=$iColNum;$i++) $oFields[PHPReportsDBI::db_columnName($oStmt,$i)]=new PHPReportField(PHPReportsDBI::db_columnName($oStmt,$i),PHPReportsDBI::db_columnType($oStmt,$i)); // create a default page element $oPage = null; // document layer $oDoc = new PHPReportGroup("DOCUMENT LAYER"); $oDoc->setFields($oFields); $oDoc->setReport(&$oReport); $oGroup =& $oDoc; $oReport->setTitle("Sales Report"); $oReport->setBackgroundColor("#FFFFFF"); $oReport->addCSS("phpreports.css"); // inserting here the page element ... $oPage = new PHPReportPage($sXMLOutputFile); $oPage->setReport(&$oReport); $oPage->setLimit($oReport->getMaxRowBuffer()); // page attributes $oPage->setSize(25); $oPage->setWidth(500); $oPage->setCellPadding(5); $oPage->setCellSpacing(0); $oPage->setBorder(1); $oGroup =& $oPage; $oHeader = Array(); // adding a new row ... $oRow = new PHPReportRow(); // creating a new column here - column 1 of 16 $oCol1=new PHPReportCol(); $oCol1->setType(""); $oCol1->addParm(new PHPReportColParm("COLSPAN","4")); $oCol1->addParm(new PHPReportColParm("CELLCLASS","PAGE_LAYER")); $oCol1->addParm(new PHPReportColParm("TEXTCLASS","BOLD")); $oCol1->setExpr("Evolve Web Info"); $oCol1->setGroup(&$oGroup); $oRow->addCol(&$oCol1); array_push($oHeader,$oRow); // adding a new row ... $oRow = new PHPReportRow(); // creating a new column here - column 2 of 16 $oCol2=new PHPReportCol(); $oCol2->setType(""); $oCol2->addParm(new PHPReportColParm("COLSPAN","4")); $oCol2->addParm(new PHPReportColParm("CELLCLASS","PAGE_LAYER")); $oCol2->addParm(new PHPReportColParm("TEXTCLASS","BOLD")); $oCol2->setExpr("Sales Report"); $oCol2->setGroup(&$oGroup); $oRow->addCol(&$oCol2); array_push($oHeader,$oRow); $oPage->setHeader($oHeader); $oFooter = Array(); // adding a new row ... $oRow = new PHPReportRow(); // creating a new column here - column 3 of 16 $oCol3=new PHPReportCol(); $oCol3->setType(""); $oCol3->addParm(new PHPReportColParm("ALIGN","RIGHT")); $oCol3->addParm(new PHPReportColParm("COLSPAN","3")); $oCol3->addParm(new PHPReportColParm("CELLCLASS","PAGE_LAYER")); $oCol3->setExpr("page total"); $oCol3->setGroup(&$oGroup); $oRow->addCol(&$oCol3); // creating a new column here - column 4 of 16 $oCol4=new PHPReportCol(); $oCol4->setType("EXPRESSION"); $oCol4->addParm(new PHPReportColParm("ALIGN","LEFT")); $oCol4->addParm(new PHPReportColParm("CELLCLASS","PAGE_LAYER")); $oCol4->addParm(new PHPReportColParm("TEXTCLASS","BOLD")); $oCol4->setNumberFormatEx(2); $oCol4->setExpr("return ;"); $oCol4->setGroup(&$oGroup); $oRow->addCol(&$oCol4); array_push($oFooter,$oRow); $oPage->setFooter($oFooter); $oReport->setPage($oPage); // creating a new group here ... $oGrp_grp_cdgroup=new PHPReportGroup("grp_cdgroup"); $oGrp_grp_cdgroup->setReport($oReport); $oGrp_grp_cdgroup->setFields($oFields); $oGrp_grp_cdgroup->setPageBreak(""); $oGrp_grp_cdgroup->setBreakExpr("grp_cd"); $oGrp_grp_cdgroup->setReprintHeader(""); $oGrp_grp_cdgroup->setResetSuppress(""); $oGroup =& $oGrp_grp_cdgroup; $oGrpMain_ =& $oGrp_grp_cdgroup; $oHeader = Array(); // adding a new row ... $oRow = new PHPReportRow(); // creating a new column here - column 5 of 16 $oCol5=new PHPReportCol(); $oCol5->setType(""); $oCol5->addParm(new PHPReportColParm("CELLCLASS","GROUP_LAYER")); $oCol5->setExpr("Item Group:"); $oCol5->setGroup(&$oGroup); $oRow->addCol(&$oCol5); // creating a new column here - column 6 of 16 $oCol6=new PHPReportCol(); $oCol6->setType("EXPRESSION"); $oCol6->addParm(new PHPReportColParm("CELLCLASS","GROUP_LAYER")); $oCol6->addParm(new PHPReportColParm("TEXTCLASS","BOLD")); $oCol6->addParm(new PHPReportColParm("COLSPAN","3")); $oCol6->setExpr("return \$this->getValue(\"grp_nm\");"); $oCol6->setGroup(&$oGroup); $oRow->addCol(&$oCol6); array_push($oHeader,$oRow); // adding a new row ... $oRow = new PHPReportRow(); // creating a new column here - column 7 of 16 $oCol7=new PHPReportCol(); $oCol7->setType(""); $oCol7->addParm(new PHPReportColParm("CELLCLASS","GROUP_LAYER")); $oCol7->setExpr("item_cd"); $oCol7->setGroup(&$oGroup); $oRow->addCol(&$oCol7); // creating a new column here - column 8 of 16 $oCol8=new PHPReportCol(); $oCol8->setType(""); $oCol8->addParm(new PHPReportColParm("CELLCLASS","GROUP_LAYER")); $oCol8->setExpr("item_nm"); $oCol8->setGroup(&$oGroup); $oRow->addCol(&$oCol8); // creating a new column here - column 9 of 16 $oCol9=new PHPReportCol(); $oCol9->setType(""); $oCol9->addParm(new PHPReportColParm("CELLCLASS","GROUP_LAYER")); $oCol9->setExpr("hitem_nm"); $oCol9->setGroup(&$oGroup); $oRow->addCol(&$oCol9); // creating a new column here - column 10 of 16 $oCol10=new PHPReportCol(); $oCol10->setType(""); $oCol10->addParm(new PHPReportColParm("CELLCLASS","GROUP_LAYER")); $oCol10->setExpr("$"); $oCol10->setGroup(&$oGroup); $oRow->addCol(&$oCol10); array_push($oHeader,$oRow); $oGrp_grp_cdgroup->setHeader($oHeader); $oFooter = Array(); // adding a new row ... $oRow = new PHPReportRow(); // creating a new column here - column 11 of 16 $oCol11=new PHPReportCol(); $oCol11->setType(""); $oCol11->addParm(new PHPReportColParm("ALIGN","RIGHT")); $oCol11->addParm(new PHPReportColParm("COLSPAN","3")); $oCol11->addParm(new PHPReportColParm("CELLCLASS","GROUP_LAYER")); $oCol11->setExpr("total"); $oCol11->setGroup(&$oGroup); $oRow->addCol(&$oCol11); // creating a new column here - column 12 of 16 $oCol12=new PHPReportCol(); $oCol12->setType("EXPRESSION"); $oCol12->addParm(new PHPReportColParm("ALIGN","LEFT")); $oCol12->addParm(new PHPReportColParm("CELLCLASS","GROUP_LAYER")); $oCol12->addParm(new PHPReportColParm("TEXTCLASS","BOLD")); $oCol12->setNumberFormatEx(2); $oCol12->setExpr("return \$this->getSum(\"item_rate\") ;"); $oCol12->setGroup(&$oGroup); $oRow->addCol(&$oCol12); array_push($oFooter,$oRow); $oGrp_grp_cdgroup->setFooter($oFooter); // here starts the sql fields rows ... $oFieldRows = Array(); // adding a new row ... $oRow = new PHPReportRow(); // creating a new column here - column 13 of 16 $oCol13=new PHPReportCol(); $oCol13->setType("FIELD"); $oCol13->addParm(new PHPReportColParm("CELLCLASS","GROUP_LAYER")); $oCol13->setExpr("item_cd"); $oCol13->setGroup(&$oGroup); $oRow->addCol(&$oCol13); // creating a new column here - column 14 of 16 $oCol14=new PHPReportCol(); $oCol14->setType("FIELD"); $oCol14->addParm(new PHPReportColParm("CELLCLASS","GROUP_LAYER")); $oCol14->setExpr("item_nm"); $oCol14->setGroup(&$oGroup); $oRow->addCol(&$oCol14); // creating a new column here - column 15 of 16 $oCol15=new PHPReportCol(); $oCol15->setType("FIELD"); $oCol15->addParm(new PHPReportColParm("CELLCLASS","GROUP_LAYER")); $oCol15->setExpr("hitem_nm"); $oCol15->setGroup(&$oGroup); $oRow->addCol(&$oCol15); // creating a new column here - column 16 of 16 $oCol16=new PHPReportCol(); $oCol16->setType("FIELD"); $oCol16->addParm(new PHPReportColParm("CELLCLASS","GROUP_LAYER")); $oCol16->setNumberFormatEx(2); $oCol16->setExpr("item_rate"); $oCol16->setGroup(&$oGroup); $oRow->addCol(&$oCol16); array_push($oFieldRows,$oRow); $oGrp_grp_cdgroup->setFieldRows($oFieldRows); // if there is a form if($oForm) $oDoc->setForm($oForm); // there must be a PAGE element here if(is_null($oPage)) $oError->showMsg("NOPAGE"); // if dinamically defined the page size (this overrides the XML value) ... $oPage->setFields($oFields); $oPage->setGroups(&$oGrpMain_); $oDoc->setReport($oReport); $oDoc->addChild($oGrpMain_); $oPage->setDocument(&$oDoc); $oPage->eventHandler(REPORT_OPEN); $oDoc->eventHandler(REPORT_OPEN); $bFound=false; $this->_aBench["output_start"] = time(); // looping on the sql result here ... while($aResult=PHPReportsDBI::db_fetch($oStmt)) { $bFound=true; $oPage->eventHandler(PUT_DATA,$aResult); $oDoc->eventHandler(PROCESS_DATA,$aResult); } $oDoc->eventHandler(REPORT_CLOSE); $oPage->eventHandler(REPORT_CLOSE); PHPReportsDBI::db_free($oStmt); PHPReportsDBI::db_disconnect($oCon); // no data found if(!$bFound){ if(strlen($sNoDataFoundFunc)>0) eval($sNoDataFoundFunc.";"); else{ if(strlen($sNoDataFoundMsg)>0) new PHPReportsError(strlen($sNoDataFoundMsg)>0?$sNoDataFoundMsg:"NO DATA FOUND"); else $oError->showMsg("NODATA"); } } return $oPage->getFileName(); } 
 
 ?>
<body>
</body>
</html>
