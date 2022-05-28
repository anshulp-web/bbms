<?php

error_reporting(E_ALL & E_STRICT); 

	class PHPReportsDBI {
         
         public $sDb, $ls_db;


		function db_connect($oArray) {
		    //$ls_db = $sDb;
		    
		    	//if(!is_null($oArray[3]))
		    	//{
		    	    $ls_db = $oArray[3];
		    	//}
		    	
		    	//echo 'host:' . $oArray[2];
		    	//echo 'user:' . $oArray[0];
		    	//echo 'pass:' . $oArray[1];
		    	//echo 'data:' . $oArray[3];
		    	
		    
		    $oCon = mysqli_connect($oArray[2], $oArray[0], $oArray[1], $oArray[3] ) ;
		    
		   // if (mysqli_connect_errno()) {
  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
  //}

		    
		    //echo 'CON:' .$oCon;
		    
		    if(!$oCon)
				die("could not connect");
				
					return $oCon;
					
					
		    /*
		    
			//$oCon = mysqli_connect($oArray[2], $oArray[0], $oArray[1]);

//echo '2:'.$oArray[2]; //local
//echo '0:'.$oArray[0]; //user
//echo '1:'.$oArray[1]; //pass
//echo '3:'.$oArray[3]; //database

		$oCon = mysqli_connect($oArray[2], $oArray[0], $oArray[1], $oArray[3]);

		//echo 'conret:' .print_r($oCon) .'<br>';

			if(!$oCon)
				die("could not connect");
			if(!is_null($oArray[3]))
				PHPReportsDBI::db_select_db($oArray[3]);
			return $oCon;
			*/
			
			
			
			
			
		}

		function db_select_db($sDatabase) {
		    
		    $sDb = $sDatabase;
		    //mysqli_select_db($sDatabase); 
			//error_reporting(1);

			//echo 'sandip'.$sDatabase;
			//mysqli_select_db($sDatabase);
			//mysqli_select_db($con, $sDatabase); 
		}

		function db_query($oCon,$sSQL) {
			
		//cho 'db_query';
			//$oStmt = mysqli_query($sSQL,$oCon);
			$oStmt = mysqli_query($oCon, $sSQL );
			return $oStmt;
			//return '';
		}

		function db_colnum($oStmt) {
			//echo 'db_colnum';
			//return mysqli_num_fields($oStmt);
			$ls_num = mysqli_num_fields($oStmt);
			//echo 'Num:'.$ls_num;
			return $ls_num;
			//return '';
		}

		function db_columnName($oStmt,$iPos) {
			//echo 'db_colnum';
			//return mysqli_field_name($oStmt,$iPos-1);
			//return mysqli_fetch_field_direct($oStmt,$iPos-1); 
			//return mysqli_field_name($oStmt,$iPos-1); 
			//return '';
			$finfo = mysqli_fetch_field_direct($oStmt,$iPos-1); 
			$ls_nm = $finfo->name;
			//echo 'Name:'.$ls_nm;
			
			return $ls_nm;
		}
		
		function db_columnType($oStmt,$iPos) {
			//echo 'db_columnType';
			//return mysqli_field_type($oStmt,$iPos-1);
			$finfo = mysqli_fetch_field_direct($oStmt,$iPos-1); 
			$ls_nm = $finfo->type;
			
			$mysqli_data_type_hash = array(
    1=>'tinyint',
    2=>'smallint',
    3=>'int',
    4=>'float',
    5=>'double',
    7=>'timestamp',
    8=>'bigint',
    9=>'mediumint',
    10=>'date',
    11=>'time',
    12=>'datetime',
    13=>'year',
    16=>'bit',
    //252 is currently mapped to all text and blob types (MySQL 5.0.51a)
    253=>'varchar',
    254=>'char',
    246=>'decimal'
);
			
			$ret = $mysqli_data_type_hash[$ls_nm];
			
			
			
			//echo 'Type:'.$ret;
			return 	$ret ;
			
			//return mysqli_field_type($oStmt,$iPos-1);
			//return '';
		}

		function db_fetch($oStmt) {
		//	echo 'db_fetch';
			//return mysqli_fetch_array($oStmt);
			return mysqli_fetch_array($oStmt);
			//return '';
		}

		function db_free($oStmt) {
			//echo 'db_free';
			//return mysqli_free_result($oStmt);
			return mysqli_free_result($oStmt);
			//return '';
		}

		function db_disconnect($oCon) {
			//echo 'db_disconnect';
			//return mysqli_close($oCon);
			return mysqli_close($oCon);
		//	return '';
		}
	}	
?>
