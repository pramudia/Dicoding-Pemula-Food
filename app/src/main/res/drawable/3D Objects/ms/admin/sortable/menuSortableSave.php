<?php

	// Connect to DB
	include("dbconnect.inc.php");
	
	
	
	
	
	// Get the JSON string
	$jsonstring = $_GET['jsonstring'];
	
	// Decode it into an array
	$jsonDecoded = json_decode($jsonstring, true, 64);
	
	
	
	
	
	

	/* Function to parse the multidimentional array into a more readable array 
	 * Got help from stackoverflow with this one:
	 *    http://stackoverflow.com/questions/11357981/save-json-or-multidimentional-array-to-db-flat?answertab=active#tab-top
	*/
	function parseJsonArray($jsonArray, $parentID = 0)
	{
	  $return = array();
	  foreach ($jsonArray as $subArray) {
		 $returnSubSubArray = array();
		 if (isset($subArray['children'])) {
		   $returnSubSubArray = parseJsonArray($subArray['children'], $subArray['id']);
		 }
		 $return[] = array('id' => $subArray['id'], 'parentID' => $parentID);
		 $return = array_merge($return, $returnSubSubArray);
	  }

	  return $return;
	}
	
	
	
	
	// Dump the array to debug
	//var_dump(parseJsonArray($jsonDecoded));
	
	
	
	
	
	
	
	// Run the function above
	$readbleArray = parseJsonArray($jsonDecoded);
	
	
	
	// Loop through the "readable" array and save changes to DB
	foreach ($readbleArray as $key => $value) {
	
		// $value should always be an array, but we do a check
		if (is_array($value)) {
		
			// Update DB
			$result = mysql_query("UPDATE jadwal SET 
									rang='". $key ."', 
									parent_id='".$value['parentID']."' 
									WHERE id='".$value['id']."'") 
			or die(mysql_error());
		}
	}
	
	
	// Echo status message for the update
	echo "Data Telah Diupdate ".date("y-m-d H:i:s")."!";
	
?>