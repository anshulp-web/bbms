<?php
	include("PHPReportsUtil.php");
	//require_once("scr_inc.php");
	require_once("../main/DBConnection.php");
	require_once("../main/Query.php");

	/******************************************************************************
	*                                                                             *
	*	PHPReportMaker                                                             *
	*	This is the main class of PHPReports                                       *
	*                                                                             *
	*	Use like this:                                                             *
	*	$oRpt = new PHPReportMaker();                                              *
	*	$oRpt->setXML("test.xml");                                                 *
	*	$oRpt->setXSLT("test.xsl");                                                *
	*	$oRpt->setUser("john");                                                    *
	*	$oRpt->setPassword("doe");                                                 *
	*	$oRpt->setConnection("mydatabaseaddr");                                    *
	*	$oRpt->setDatabaseInterface("oracle");                                     *
	*	$oRpt->setSQL("select * from mytable");                                    *
	*	$oRpt->run();                                                              *
	*                                                                             *
	******************************************************************************/
	class PHPReportMaker {
		var $_sPath;			// PHPReports path
		var $sXML;				// XML report file
		var $sXSLT;				// XSLT file
		var $sUser;				// user name
		var $sPass;				// password
		var $sCon;				// connection name
		var $sDataI;			// database interface
		var $sSQL;				// sql query command
		var $_oParm;			// parameters
		var $sDatabase;		// database
		var $sCodeOut;			// code output
		var $sOut;				// HTML result file
		var $bDebug;			// debug report
		var $_sNoDataMsg;		// no data message - NEW!!! on 0.2.0
		var $_sOutputPlugin;	// output plugin name - NEW!!! on 0.2.0
		var $_oOutputPlugin;	// output plugin - NEW!!! on 0.2.0 
		var $_sXMLOutputFile;// XML output file with the data
		var $_sSaveTo;			// save to file - NEW!!! 0.2.0
		var $_oProc;			// XSLT processor
		var $_aEnv;				// enviroment vars
		var $_sClassName;		// report class name to create
		var $_sTmp;				// temporary dir
		var $_oCon;				// database connection handle
		var $_oQuery;			// executed query
		var $_iPageSize;		// page size
		var $_aBench;			// benchmark registers
		var $_sLang;			// language
		var $_bBody;			// no HTML BODY shown on the report
		var $_bDeleteXML;		// if needs to delete the XML file after using it
		var $_oError;
		var $_oInput;			// input plugins

		/***************************************************************************
		*																									*
		*	Constructor - remember to set the PHPREPORTS										*
		*	environment variable																		*
		*																									*
		***************************************************************************/		
		function PHPReportMaker() {
			$this->_sPath				= getPHPReportsFilePath();
			$this->_sTmp				= getPHPReportsTmpPath();
			$this->sXML					= null;		
			$this->sXSLT				= $this->_sPath."/xslt/PHPReport.xsl";		
			$this->sUser				= null;		
			$this->sPass				= null;		
			$this->sCon					= null;		
			$this->sDataI				= null;	
			$this->sSQL					= null;		
			$this->_oParm				= Array();		
			$this->sDatabase			= null;
			$this->sCodeOut			= null;	
			$this->sOut					= null;		
			$this->bDebug				= false;
			$this->_sNoDataMsg		= "";
			$this->_sNoDataFunc		= "";
			$this->_sOutputPlugin	= "default";
			$this->_oOutputPlugin	= null;
			$this->_sSaveTo			= null;
			$this->_aEnv				= Array();
			$this->_sClassName		= "PHPReport";
			$this->_iPageSize			= 0;
			$this->_aBench				= Array();
			$this->_sLang				= "default";
			$this->_bBody				= true;
			$this->_bDeleteXML		= false;
			$this->_oError				= new PHPReportsErrorTr();
			$this->_oInput				= Array();
			
			$this->_ResultHide = false;

			/*
				Now we get the XSLT processor
				new code on the 0.2.8 version, because PHP5 have XSL
				support with libxslt, by default
			*/			
			$oProcFactory = new XSLTProcessorFactory();
			$this->_oProc = $oProcFactory->get();
			if(is_null($this->_oProc))
				$this->_oError->showMsg("NOXSLT");
				
			// check path stuff
			if(is_null(getPHPReportsFilePath()))
				$this->_oError->showMsg("NOPATH");
		}

		/******************************************************************************
		*																										*
		*	Create a quick report from a layout file and some parameters.					*
		*																										*
		******************************************************************************/
		function createFromTemplate($sTitle="NO DEFINED TITLE",$sFile=null,$oParms=null,$oDocument=null,$oGroups=null){
			$sPath	= getPHPReportsFilePath();
			$oError	= new PHPReportsErrorTr();
			$sIf		= $this->getDatabaseInterface();
			$sFile	= $sFile ? $sFile : realpath($sPath."/template.xml");

			// if the file does not exist
			if(!file_exists($sFile))
				$oError->showMsg("NOTEMPLATE",$sFile);

			// get the template contents
			$sFileContents = file_get_contents($sFile);

			// check if there are some parameters here ...
			if($oParms){
				$sParms = null;
				if(is_object($oParms))	$sParms = $oParms->write();
				if(is_string($oParms))	$sParms = $oParms;
				if($sParms)
					$sFileContents = str_replace("<REPLACE_WITH_PARAMETERS/>",$sParms,$sFileContents);
			}

			// if no groups info was specified, follow the default behaviour: all the fields from the query,
			// with no group break
			if(!$oGroups){
				// include the database interface and try to open the connection and execute the query	
				$sIfFile = realpath($sPath."/database/db_".$sIf.".php");
				if(!file_exists($sIfFile))
					$oError->showMsg("NOIF",$sIf);
				include_once $sIfFile; 

				// if the database connection is null, open it
				if(is_null($this->_oCon))
					$this->_oCon = @PHPReportsDBI::db_connect(Array($this->sUser,$this->sPass,$this->sCon,$this->sDatabase)) or $oError->showMsg("REFUSEDCON");

				// if there are some input filters ...
				if($this->_oInput){
					foreach($this->_oInput as $oFilter){
						$oFilter->setConnection($this->_oCon);
						$oFilter->setSQL(trim($this->sSQL));
						$this->sSQL = trim($oFilter->run());
					}
					// there is no need to run the filters again
					$this->_oInput = null;
				}

				// run the query
				$this->_oQuery = @PHPReportsDBI::db_query($this->_oCon,trim($this->sSQL)) or $oError->showMsg("QUERYERROR");

				// insert the column names
				$sNames				= "";
				$sReplacedNames	= "";
				$sTotals				= "";

				$iColNum = PHPREportsDBI::db_colnum($this->_oQuery);
				for($i=1; $i<=$iColNum; $i++){
					$sName				= PHPReportsDBI::db_columnName($this->_oQuery,$i);
					$sExtra				= isNumericType(PHPReportsDBI::db_columnType($this->_oQuery,$i))?" ALIGN=\"RIGHT\"":"";
					$sReplacedNames  .= "<COL CELLCLASS=\"bold\"$sExtra>".ucfirst(strtolower(str_replace("_"," ",$sName)))."</COL>";
					$sNames			  .= "<COL TYPE=\"FIELD\"$sExtra>$sName</COL>";
					
					if(isNumericType(PHPReportsDBI::db_columnType($this->_oQuery,$i)))
						$sTotals		  .= "\t\t\t<COL TYPE=\"EXPRESSION\" ALIGN=\"RIGHT\">\$this->getSum(\"$sName\");</COL>\n";
					else
						$sTotals		  .= "\t\t\t<COL></COL>\n";
				}

				// build the group info
				$sGroup			= "<GROUP REPRINT_HEADER_ON_PAGEBREAK='TRUE'><HEADER><ROW><REPLACE_WITH_REPLACED_COLUMN_NAMES/></ROW></HEADER><FIELDS><ROW><REPLACE_WITH_COLUMN_NAMES/></ROW></FIELDS></GROUP>";
				$sGroup			= str_replace("<REPLACE_WITH_REPLACED_COLUMN_NAMES/>",$sReplacedNames,$sGroup);
				$sGroup			= str_replace("<REPLACE_WITH_COLUMN_NAMES/>",$sNames,$sGroup);
				$sFileContents = str_replace("<REPLACE_WITH_GROUP_INFO/>",$sGroup,$sFileContents);

				// if no document info is set, make one
				if(!$oDocument)
					$oDocument = "<DOCUMENT>\n\t<FOOTER>\n\t\t<ROW>\n$sTotals\t\t</ROW>\t</FOOTER>\n</DOCUMENT>";
			}else{
				$sGroups = null;
				if(is_object($oGroups))	$sGroups	= $oGroups->write();
				if(is_string($oGroups))	$sGroups = $oGroups;
				if($sGroups)
					$sFileContents = str_replace("<REPLACE_WITH_GROUP_INFO/>",$sGroups,$sFileContents);
			}

			// check if there is some document info
			
			if($oDocument){
				$sDocument = null;
				if(is_object($oDocument))	$sDocument = $oDocument->write();
				if(is_string($oDocument))	$sDocument = $oDocument;
				if($sDocument)
				
					
					$sFileContents = str_replace("<REPLACE_WITH_DOCUMENT_INFO/>",$sDocument,$sFileContents);
			}

			// replace the report title
			$sFileContents = str_replace("<REPLACE_WITH_TITLE/>",$sTitle,$sFileContents);
			
			
			// print htmlspecialchars($sFileContents);

			// create the temporary XML file
			$sTemp = tempnam($this->_sTmp,"tempphprpt");

			// this is just for PHP4 compability
			$fHand = fopen($sTemp,"w");
			fwrite($fHand,$sFileContents);
			fclose($fHand);

			$this->_bDeleteXML	= true;		// flag to delete the temporary file
			$this->sXML				= $sTemp;	// the XML layout file is the temporary file now
		}

		/******************************************************************************
		*																										*
		*	Run report																						*
		*	Here is where things happens. :-)														*
		*																										*
		******************************************************************************/
		function run() {
			$iReportStart = time();

			// create the parameters array
			$aParm["user"     ]	= $this->sUser;			// set user
			$aParm["pass"     ]	= $this->sPass;			// set password
			$aParm["conn"     ]	= $this->sCon;				// set connection name
			$aParm["interface"]	= $this->sDataI;			// set database interface
			$aParm["database" ]	= $this->sDatabase;		// set database
			$aParm["classname"]	= $this->_sClassName;	// ALWAYS use this class to run the report
			$aParm["sql"      ]	= $this->sSQL;				// set the sql query
			$aParm["nodatamsg"]	= $this->_sNoDataMsg;	// no data msg
			$aParm["nodatafunc"] = $this->_sNoDataFunc;	// no data function
			$aParm["pagesize"]	= $this->_iPageSize>0?$this->_iPageSize:"";							
			$aParm["language"]	= $this->_sLang;

			// create the parameters keys array - with element numbers or element keys
			$aKeys = null;
			if(is_array($this->_oParm)){
				$aKeys = array_keys($this->_oParm);
				$iSize = sizeof($this->_oParm);
				for($i=0; $i<$iSize; $i++){
					$sOkey = $aKeys[$i];	// original key
					$sKey	 = $sOkey;		// reference key
				
					// check if its a numeric key - if so, add 1 to
					// it to keep the parameters based on 1 and not on 0
					if(is_numeric($sOkey)) 
						$sKey = intval($sOkey)+1;
			
					$aParm["parameter".($i+1)] = $this->_oParm[$sOkey];
					$aParm["reference".($i+1)] = $sKey;
				}
			}		

			// if there is not a file to create the code,
			// create it on the memory (faster, use file just for 
			// debugging stuff)
			if(is_null($this->sCodeOut)) {
				$sOut = null;
				$aParm["output_format"]="memory";
			}else{
				$sOut = $this->sCodeOut;		
				$aParm["output_format"]="file";
			}

			// XSLT processing
			$this->_aBench["code_start"] = time();
			$this->_oProc->setXML($this->sXML);
			$this->_oProc->setXSLT($this->sXSLT);
			$this->_oProc->setOutput($sOut);
			$this->_oProc->setParms($aParm);
			$sRst = $this->_oProc->run();
			$this->_aBench["code_end"] = time();

			$this->_aBench["code_eval_start"] = time();
			// if its created on the memory ...
			
			//echo $this->sXML;
			
			if(is_null($sOut))
			{
				//if ( $this->sXML == "report/dw_dtl_asper.xml")
				//{
				//	echo $sRst;
				//}
				
				//[COMPANY_NAME]
				
				$Cn = new EvClass(); 
				$Cn->getDataFromDB();
				
				$comp_nm = $Cn->E_comp_nm;
				$comp_add= $Cn->E_comp_add;
				
				$hcomp_nm = $Cn->H_comp_nm;
				$hcomp_add= $Cn->H_comp_add;
				
				$comp_city  = $Cn->E_comp_city;
				$hcomp_city = $Cn->H_comp_city;
				
				$comp_mpstno= $Cn->comp_mpstno;
				$comp_ml_no = $Cn->comp_ml_no;
				$comp_ph_no = $Cn->comp_ph_no;
				$comp_mob_no= $Cn->comp_mob_no;			
				
				$Cur_dt  = $Cn->getcurdate();
				$line    = $Cn->getline();			

				$sRst = str_replace("(&$_o","($_o",$sRst);
				
				$sRst = str_replace("[COMP_NM]",$comp_nm,$sRst);
				$sRst = str_replace("[COMP_ADD]",$comp_add,$sRst);
				$sRst = str_replace("[HCOMP_NM]",$hcomp_nm,$sRst);
				$sRst = str_replace("[HCOMP_ADD]",$hcomp_add,$sRst);
				$sRst = str_replace("[CUR_DATE]",$Cur_dt,$sRst);
				$sRst = str_replace("[LINE]",$line,$sRst);
				
				$sRst = str_replace("[COMP_CITY]",$comp_city,$sRst);
				$sRst = str_replace("[HCOMP_CITY]",$hcomp_city,$sRst);
				$sRst = str_replace("[COMP_TIN]",$comp_mpstno,$sRst);
				$sRst = str_replace("[COMP_MLNO]",$comp_ml_no,$sRst);
				
				$sRst = str_replace("[COMP_PHNO]",$comp_ph_no,$sRst);
				$sRst = str_replace("[COMP_MOBNO]",$comp_mob_no,$sRst);
				//$sRst = str_replace("&lt;","<",$sRst);

				//echo "**************************************************************************";
				//echo $sRst;
				
				eval($sRst);
				
				
				//print_r(error_get_last());
				//echo "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
				
			}	
			else {
			// include the generated classes, if it was created
				if(!file_exists($sOut))
					$this->_oError->showMsg("NOCODE",array($sOut));
				require_once($sOut);	
			}	
			$this->_aBench["code_eval_end"] = time();

			// include the generated class	
			//echo "\nClass Name:". $this->_sClassName;
			$oReport = new $this->_sClassName;
			//echo "[1]";
			// set the database connection handle, if there is one
			$oReport->setDatabaseConnection($this->_oCon);
			//echo "[2]";
			$oReport->setInputFilters($this->_oInput);
			//echo "[3]";
			$oReport->setQuery($this->_oQuery);
			//echo "[4]" . $this->_aEnv;

			// run the generated class
			
			if ($this->_ResultHide == true)
			{
				$this->_sXMLOutputFile = $oReport->run($this->_sXMLOutputFile,$this->_aEnv);
			}
			else
			{
				$this->_sXMLOutputFile = $oReport->run($this->_sXMLOutputFile,$this->_aEnv);
			}

			
			//echo "[5]". $this->_sXMLOutputFile;
			$this->_aBench = array_merge($this->_aBench,$oReport->getBenchmarks());
			//echo "[6]";

			// check if the XML file exists, we need data!
			if(!file_exists($this->_sXMLOutputFile))
				$this->_oError->showMsg("NOXML",array($this->_sXMLOutputFile));

			/*
				Now we have a XML file with the report contents ... what to to with it???
				Let's call the output plugin!
			*/	

			//	if there is no one, create a new default plugin
			//echo "[7]";
			$oOut = null;
			//echo "[8]";
			
			//echo "$this->_bBody";
			
			if(is_null($this->_oOutputPlugin)) {
			//echo "[9]";
			
				$oOut = $this->createOutputPlugin("default");
				
				
				
				//echo "[9.1]". $this->_sXMLOutputFile;
				$oOut->setInput ($this->_sXMLOutputFile);
				//echo "[9.2]";
				$oOut->setOutput($this->sOut);
				//echo "[9.3]";
				$oOut->setBody($this->_bBody);
				//echo "[9.4]";
				$this->setOutputPlugin($oOut);
				//echo "[9.5]";
			}else{
			//echo "[10]";
				$oOut = $this->_oOutputPlugin;
				$oOut->setBody($this->_bBody);
				$oOut->setInput($this->_sXMLOutputFile);
				if(!is_null($this->sOut))
					$oOut->setOutput($this->sOut);
			}
			
		
			// if need to save it
			if(!is_null($this->_sSaveTo))
				$this->save();

			// run 	
			
			if ($this->_ResultHide == true)
			{
				
				
			}
			else
			{
				$oOut->run();
			}
			
			
				//echo "[11]";
			//echo "[12]";
			
			//echo $iReportStart;
			$this->_aBench["output_end"] = time();
			$this->_aBench["report_start"] = $iReportStart;
			$this->_aBench["report_end"] = time();		

			// if needs to delete the XML file
			//echo "DELETE :" . $this->_bDeleteXML;
			if($this->_bDeleteXML)
				unlink($this->sXML);
			//echo "[13]";
			return $this->_sXMLOutputFile;
			
		}

		/******************************************************************************
		*	Return a (or all) benchmark index.														*
		******************************************************************************/
		function getBenchmark($sId=null){
			if(!$sId)
				return $this->_aBench;
			return $this->_aBench[$sId];
		}
		
		/******************************************************************************
		*	Set the page size (overrides XML value)												*
		******************************************************************************/
		function setPageSize($iSize=50){
			$this->_iPageSize=$iSize;
		}
		function getPageSize(){
			return $this->_iPageSize;
		}

		/******************************************************************************
		*																										*
		*	Set the XML file path																		*
		*	@param String file path																		*
		*																										*
		******************************************************************************/		
		function setXML($sXML_) {
			if(!file_exists($sXML_))
				$this->_oError->showMsg("NOXMLSET",array($sXML_));
			$this->sXML = $sXML_;
		}

		/******************************************************************************
		*																										*
		*	Returns the XML file path																	*
		*	@return String file path																	*
		*																										*
		******************************************************************************/		
		function getXML() {
			return $this->sXML;
		}
		
		/******************************************************************************
		*																										*
		*	Sets the XSLT file path																		*
		*	@param String file path																		*
		*																										*
		******************************************************************************/		
		function setXSLT($sXSLT_) {
			if(!file_exists($sXSLT_))
				$this->_oError->showMsg("NOXSLTSET",array($sXSLT_));
			$this->sXSLT = $sXSLT_;
		}

		/******************************************************************************
		*																										*
		*	Returns the XSLT file path																	*
		*	@return String file path																	*
		*																										*
		******************************************************************************/		
		function getXSLT() {
			return $this->sXSLT;
		}
		
		/******************************************************************************
		*																										*
		*	Set the user name																				*
		*	@param String user name																		*
		*																										*
		******************************************************************************/		
		function setUser($sUser_) {
			$this->sUser = $sUser_;
		}

		/******************************************************************************
		*																										*
		*	Returns the user name																		*
		*	@return String user name																	*
		*																										*
		******************************************************************************/		
		function getUser() {
			return $this->sUser;
		}

		/******************************************************************************
		*																										*
		*	Sets the password																				*
		*																										*
		******************************************************************************/		
		function setPassword($sPass_) {
			$this->sPass = $sPass_;
		}

		/******************************************************************************
		*																										*
		*	Returns the password																			*
		*																										*
		******************************************************************************/		
		function getPassword() {
			return $this->sPass;
		}

		/******************************************************************************
		*																										*
		*	Sets the database connection																*
		*																										*
		******************************************************************************/		
		function setConnection($sCon_) {
			$this->sCon = $sCon_;
		}

		/******************************************************************************
		*																										*
		*	Returns the password																			*
		*																										*
		******************************************************************************/		
		function getConnection() {
			return $this->sCon;
		}

		/******************************************************************************
		*																										*
		*	Sets the database interface																*
		*																										*
		******************************************************************************/		
		function setDatabaseInterface($sData_) {
			$this->sDataI = $sData_;
		}

		/******************************************************************************
		*																										*
		*	Returns the database interface															*
		*																										*
		******************************************************************************/		
		function getDatabaseInterface() {
			return $this->sDataI;
		}

		/******************************************************************************
		*																										*
		*	Sets the SQL query																			*
		*																										*
		******************************************************************************/		
		function setSQL($sSQL_) 
		{
			$this->sSQL = $sSQL_;
		}
		
		/******************************************************************************
		*																										*
		*	Returns the SQL query																		*
		*																										*
		******************************************************************************/		
		function getSQL() {
			return $this->sSQL;
		}

		/******************************************************************************
		*																										*
		*	Sets the parameters																			*
		*																										*
		******************************************************************************/		
		function setParameters($oParm_) {
			$this->_oParm = $oParm_;
		}

		/******************************************************************************
		*																										*
		*	Returns the parameters																		*
		*																										*
		******************************************************************************/		
		function getParameters() {
			return $this->_oParm;
		}

		/******************************************************************************
		*																										*
		*	Sets the database																				*
		*																										*
		******************************************************************************/		
		function setDatabase($sData_) {
			$this->sDatabase = $sData_;
		}

		/******************************************************************************
		*																										*
		*	Returns the database																			*
		*																										*
		******************************************************************************/		
		function getDatabase() {
			return $this->sDatabase;
		}

		/******************************************************************************
		*																										*
		*	Sets the code output file																	*
		*																										*
		******************************************************************************/		
		function setCodeOutput($sFile_) {
			$this->sCodeOut = $sFile_;
		}

		/******************************************************************************
		*																										*
		*	Returns the database																			*
		*																										*
		******************************************************************************/		
		function getCodeOutput() {
			return $this->sCodeOut;
		}

		/******************************************************************************
		*																										*
		*	Sets the output path																			*
		*																										*
		******************************************************************************/		
		function setOutput($sOut_) {
			$this->sOut = $sOut_;
		}

		/******************************************************************************
		*																										*
		*	Returns output path																			*
		*																										*
		******************************************************************************/		
		function getOutput() {
			return $this->sOut;
		}

		/******************************************************************************
		*																										*
		*	Sets if the report will generate debug info after it runs						*
		*																										*
		******************************************************************************/		
		function setDebug($bDesc) {
			$this->bDebug = $bDesc;
		}

		/******************************************************************************
		*																										*
		*	Returns if will debug																		*
		*																										*
		******************************************************************************/		
		function getDebug() {
			return $this->bDebug;
		}

		/******************************************************************************
		*																										*
		*	Sets message to be shown when no data returns from the query					*
		*	@param String message																		*
		*																										*
		******************************************************************************/		
		function setNoDataMsg($sMsg_="") {
			$this->_sNoDataMsg=$sMsg_;
		}

		/******************************************************************************
		*																										*
		*	Returns the no data message																*
		*	@return String message																		*
		*																										*
		******************************************************************************/		
		function getNoDataMsg() {
			return $this->_sNoDataMsg;
		}

		function setNoDataFunc($sFunc=""){
			$this->_sNoDataFunc=$sFunc;
		}

		function getNoDataFunc(){
			return $this->_sNoDataFunc;
		}

		/******************************************************************************
		*																										*
		*	Create the output plugin																	*
		*	@param name																						*
		*																										*
		******************************************************************************/		
		function createOutputPlugin($sName_) {
			$sFullPath = $this->_sPath."/output/$sName_/PHPReportOutput.php";
			
			// check if the required plugin exists
			if(!file_exists($sFullPath))
				$this->_oError->showMsg("NOPLUGIN",array($sName_,$sFullPath));
			include $sFullPath; 
			
			$oOut = new PHPReportOutput($this->sXML);
			
			return $oOut;
		}

		function addInputPlugin($sName_,$oGroupDesc_,$sGroupKey_,$oOptions_=null){
			$sName  = ucwords(strtolower($sName_));
			$sClass = "PHPReportInput$sName";
			$sFullPath = $this->_sPath."/input/PHPReportInput$sName.php";
			
			// check if the required plugin exists
			if(!file_exists($sFullPath))
				$this->_oError->showMsg("NOPLUGIN",array($sName_,$sFullPath));
			include $sFullPath; 

			$oIn = new $sClass($oGroupDesc_,$sGroupKey_,$oOptions_);
			array_push($this->_oInput,$oIn);
		}

		/******************************************************************************
		*																										*
		*	Output plugin for the final format														*
		*	@param plugin																					*
		*																										*
		******************************************************************************/		
		function setOutputPlugin($oPlugin_)
		{
			$this->_oOutputPlugin=$oPlugin_;
		}

		/******************************************************************************
		*																										*
		*	Returns the output plugin																	*
		*	@return plugin																					*
		*																										*
		******************************************************************************/		
		function getOutputPlugin() {
			return $this->_oOutputPlugin;
		}

		/******************************************************************************
		*																										*
		*	Set the XML output/data file																*
		*																										*
		******************************************************************************/		
		function setXMLOutputFile($sFile_=null){
			$this->_sXMLOutputFile=$sFile_;
		}

		/******************************************************************************
		*																										*
		*	Returns the XML output/data file															*
		*																										*
		******************************************************************************/		
		function getXMLOutputFile(){
			return $this->_sXMLOutputFile;
		}

		/******************************************************************************
		*																										*
		*	File path to save the report																*
		*	Please remember to use a writable path!												*
		*																										*
		******************************************************************************/		
		function saveTo($sFile_=null){
			if(is_null($sFile_))
				return;
			$this->_sSaveTo=$sFile_;	
		}

		/******************************************************************************
		*																										*
		*	Save report																						*
		*																										*
		******************************************************************************/		
		function save(){
			if(is_null($this->_sSaveTo))
				return;
			$sIn  = $this->_sXMLOutputFile;	
			$sMD5 = md5_file($sIn);		// calculate the md5 checksum
			$sMD5	= str_pad($sMD5,50);	// padding
			$sOut = "compress.zlib://".$this->_sSaveTo;
			$fIn	= fopen($sIn,"r");
			$fOut = fopen($sOut,"w");
			
			// write the md5sum 
			fwrite($fOut,$sMD5);
			
			while($sStr=fread($fIn,1024))
				fwrite($fOut,$sStr);
			fclose($fOut);
			fclose($fIn);				
		}
		
		function getReportData()
		{
			$sIn  = $this->_sXMLOutputFile;	
			$fIn	= fopen($sIn,"r");
			
			$ls_data="";
			while($sStr=fread($fIn,1024))
				$ls_data = $ls_data . $sStr;

			fclose($fIn);				
			return $ls_data;		
		}

		/******************************************************************************
		*																										*
		*	Preview report																					*
		*																										*
		******************************************************************************/		
		function preview($sXML_=null){
			if(is_null($sXML_))
				return;
				
			if(!file_exists($sXML_)){
				print "<b>The file $sXML_ doesn't exists.</b><br>";
				return;
			}
			
			$sPath  = getPHPReportsFilePath();
			$sXSLT  = "$sPath/xslt/PHPReportPreview.xsl";

			// XSLT processing
			$this->_oProc->setXML($sXML_);
			$this->_oProc->setXSLT($sXSLT);
			$val="";
			print $this->_oProc->run();
			//echo "save" .$val;
			
		}

		/******************************************************************************
		*																										*
		*	Put an object to the environment array.												*
		*	You can use this function to expose any kind of variable or class to your	*
		*	report (using <COL>$this->getEnv("id")</COL>). Note that for using objects	*
		*	returned by this function directly as													*
		*	<COL>$this->getEnv("id")->myFunction()</COL>											*
		*	you'll need PHP5.																				*
		*																										*
		******************************************************************************/		
		function putEnvObj($sKey_=null,$oObj_=null){
			if(is_null($sKey_) ||
				is_null($oObj_))
				return;
			$this->_aEnv[$sKey_]=$oObj_;	
		}

		/******************************************************************************
		*																										*
		*	Returns an object from the environment array.										*
		*																										*
		******************************************************************************/		
		function getEnvObj($sKey_){
			return $this->_aEnv[$sKey_];
		}

		/******************************************************************************
		*																										*
		*	Set the name of the class that will be created										*
		*	to run the report.																			*
		*	To see where this name is used, please check xslt/PHPReport.xsl				*
		*																										*
		******************************************************************************/		
		function setClassName($sClassName_="PHPReport"){
			$this->_sClassName=$sClassName_;
		}

		/******************************************************************************
		*																										*
		*	Returns the name of the class that will be created									*
		*	to run the report.																			*
		*																										*
		******************************************************************************/		
		function getClassName(){
			return is_null($this->_sClassName)?"PHPReport":$this->_sClassName;
		}

		/******************************************************************************
		*																										*
		*	Set the database connection handle														*
		*																										*
		******************************************************************************/
		function setDatabaseConnection(&$_oCon){
			$this->_oCon =& $_oCon;
		}		

		/******************************************************************************
		*																										*
		*	Set a valid query	made before																* 
		*																										*
		******************************************************************************/
		function setQuery($oQuery_){
			$this->_oQuery=$oQuery_;
		}

		/******************************************************************************
		*																										*
		*	Here's the deal: if the user have a session opened, the language will be	*
		*	stored there. If more than one user is using the system with different		*
		*	languages, each one will see the specified language (no way to run two		*
		*	reports with different languages for each user). If no session is opened,	*
		*	the language value is already there on GLOBALS, so we can retrieve from		*
		*	there, but this will allow just one language for all the reports.				*
		*																										*
		******************************************************************************/
		function setLanguage($sLang_="default"){
			$this->_sLang=$sLang_;
			$_SESSION["phpReportsLanguage"] = $sLang_;
			$GLOBALS["phpReportsLanguage"] = $sLang_;
		}

		function getLanguage(){
			return $this->_sLang;
		}

		function setBody($b=true){
			$this->_bBody=$b;
		}

		function getBody(){
			return $this->_bBody;
		}
		
		
		
	}

	class PHPReportTemplateElement {
		var $_aAttrs;
		var $_aChildren;
		var $_sType;

		function PHPReportTemplateElement($sType=null,$aAttrs=null){
			$this->_sType		= $sType;
			$this->_aChildren	= array();
			$this->_aAttrs		= $aAttrs ? $aAttrs : array();
		}

		function addAttr($sKey,$sValue){
			$this->_aAttrs[$sKey]=$sValue;
		}

		function addChild($oChild){
			array_push($this->_aChildren,$oChild);
		}

		function write(){
			if($this->_sType){
				$sStr = "<".$this->_sType;
				foreach($this->_aAttrs as $sKey=>$sValue)
					$sStr .= strtoupper($sKey)=="VALUE"?"":" $sKey=\"$sValue\" ";
				$sStr .= ">";
			}
			$sStr .= $this->_aAttrs["VALUE"];
			foreach($this->_aChildren as $oChild)
				$sStr .= $oChild->write();
			if($this->_sType)
				$sStr .= "</".$this->_sType.">";
			return $sStr;
		}
		
	}
	
	class EvClass
	{
		
		var $db;
		var $q;
		var $E_comp_nm;
		var $H_comp_nm;
		var $E_comp_add;
		var $H_comp_add;
		var $E_comp_city;
		var $H_comp_city;
		var $comp_mpstno;
		var $comp_ml_no;
		var $comp_ph_no;
		var $comp_mob_no;
		
		function EvClass()
		{
			$this->db = new DBConnection;
			$this->db->connect();
			$this->q = new Queries;
		}
		
		function getDataFromDB()
		{
			//session_start();
			
			//$ls_fact = trim($_SESSION["gfactory_cd"]);
			//if ($ls_fact == "")
			//{
			//	$ls_fact = "1";
			//}
			
			
			$sql="select comp_nm, hcomp_nm, ";
			$sql= $sql . "concat(trim(ifnull(complc_addr1,'')),' ', trim(ifnull(complc_addr2,'')),' ',trim(ifnull(complc_city,''))) as comp_add, ";
			$sql= $sql . "concat(trim(ifnull(comprg_addr1,'')),' ', trim(ifnull(comprg_addr2,'')),' ',trim(ifnull(comprg_city,''))) as hcomp_add, ";
			$sql= $sql . "complc_city, comprg_city, ";
			$sql= $sql . "complc_ph, complc_fax, comp_mpstno, comp_cstno ";
			//$sql= $sql . " from gnmscomp where ltrim(rtrim(factory_cd)) ='".$ls_fact."'";
			$sql= $sql . " from gnmscomp where db_nm =DATABASE()";
			$rs=$this->db->select($sql);
			while ($row = mysqli_fetch_array($rs))
			{
				$this->E_comp_nm   = $row["comp_nm"];
				$this->H_comp_nm   = $row["hcomp_nm"];
				$this->E_comp_add  = $row["comp_add"];
				$this->H_comp_add  = $row["hcomp_add"];
				$this->E_comp_city = $row["complc_city"];
				$this->H_comp_city = $row["comprg_city"];
				$this->comp_mpstno = $row["comp_mpstno"];
				$this->comp_ml_no  = $row["hcomp_nm"];
				$this->comp_ph_no  = $row["comp_cstno"];
				$this->comp_mob_no = $row["complc_fax"];
			}
		
		}
		
		function getExeSql($sql)
		{
			$ls_val = "";
			$rs=$this->db->select($sql);
			while ($row = mysqli_fetch_array($rs))
			{
				$ls_val = $row[0];
			}
			return $ls_val;
		}
	
		function getcompnm()
		{
			
			return "Evolve WebInfo Pvt. Ltd.";
		}
		function getcompadd()
		{
			return "F-5, MainaShree Complex, A.B. Road Daewas (MP)";
		}
		
		function getcurdate()
		{
			return 'Date : ' . date("d/m/Y");;
		}
		function getline()
		{
			return ".";
		}
		
		
		
	}
	
?>
