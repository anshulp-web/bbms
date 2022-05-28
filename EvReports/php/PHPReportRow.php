<?php
	class PHPReportRow {
		var $_aCols;	// columns array

		function PHPReportRow() {
			$this->_aCols=Array(); 
		}

		/*
			Add a column in the row
		*/
		function addCol($oCol_) {
			array_push($this->_aCols,$oCol_);
		}

		function getCols() {
			return $this->_aCols;
		}

		/*
			Returns the XML open tag
		*/
		function getXMLOpen() {
			return "<R>";
		}
	
		
		/*
			Returns the XML close tag
		*/
		function getXMLClose() {
			return "</R>";
		}

		/**
			Prints the row (and all the columns inside of it)
			@param tabs - the tabs that must be inserted before this element
			@param row number - this row number
		*/
		function getRowValue($iRow_=0) {
			$sTabs=""; //"\t\t";
			$sStr	= $sTabs.$this->getXMLOpen(); // there was a \n here on the end
			$iSize=sizeof($this->_aCols);	
			$sSep1=""; // \t
			$sSep2=""; // \n
			
			$lb_s_blank = false;
			
			for($i=0;$i<$iSize;$i++) 
			{
				$oCol	 =& $this->_aCols[$i];
				$oVal    = $oCol->getColValue($iRow_);
				
				
				//echo "'" . $oVal ."'";
				$data_val="";
				$pos1 = strpos($oVal, ">");
				if ($pos1 > 0) 
				{
					$pos2 = strpos($oVal, "<", $pos1);
					if ($pos2 > 0) 
					{
						//echo '[['. $pos1 .",". $pos2;
						$data_val = substr($oVal, $pos1 + 2, $pos2 - $pos1 - 3);
						//echo 'val' . $data_val . "'";
						if (trim($data_val) == "#160")
						{
							//echo "blank";
						}
						else
						{
							//echo "not";
							$lb_s_blank = true;
						}
					}
				}
				
				
				//if ( == "[NULL]")
				//{
				//	$sStr .= "DONE";	
				//}
				$pos = strpos($oVal, "[ROWNULL]");
				if ($pos === false)  {}
				else
				return "";
				
				
				$pos1 = strpos($oVal, "[.]");
				if ($pos1 === false)  {}
				else
				{
					//echo substr($oVal, 1);
					$pos2 = strpos($oVal, 'CC="');
					$pos3 = strpos($oVal, '"',  $pos2 + 4);
					
					$oVal = substr_replace($oVal, " NOVIS", $pos3, 0);
					//echo substr($oVal, 1);
					//echo '['. $pos2 .",". $pos3 . ']';
				}
				
				//$sStr .= $oVal;
				$sStr .= $sSep1.$sTabs.$oVal.$sSep2;
				
				
				
			}
			$sStr.= $sTabs.$this->getXMLClose()."\n";
			
			if ($lb_s_blank == false)
			{
				$sStr = "";
			}
			
			//echo '[' . $sStr . ']';
			return $sStr;
		}

		/**
			Returns the row expression
		*/
		function getExpr(){
			$sStr = "";
			$iSize=sizeof($this->_aCols);	
			for($i=0;$i<$iSize;$i++) {
				$oCol	=& $this->_aCols[$i];
				$sStr .= $oCol->getExpr();
			}
			return $sStr;
		}

		function resetOldValue() {
			$iSize=sizeof($this->_aCols);	
			for($i=0;$i<$iSize;$i++) {
				$oCol	=& $this->_aCols[$i];
				$oCol->resetOldValue();	
			}
		}

		function debug() {
			$iSize=sizeof($this->_aCols);
			for($i=0;$i<$iSize;$i++) {
				$oCol =& $this->_aCols[$i];
				$oCol->debug();
			}
		}
	}
?>
