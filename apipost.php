
<?php
// check that all the values have been posted
print_r($_POST);

// echo("<p>get the item array</p>");
print_r($_POST["Items"]);


require_once ('FileMaker.php');

function integration()
{	
	$field["enquiryID"] = $_POST["enquiryID"];
	$field["FirstName"] = $_POST["FirstName"];
	$field["LastName"] =  $_POST["LastName"];
	$field["Address1"] = $_POST["Address1"];
	$field["Address2"] = $_POST["Address2"];
	$field["Address3"] = $_POST["Address3"];
	$field["Address4"]	 = $_POST["Address4"];
	$field["AddressPostCode"] = $_POST["AddressPostCode"];
	$field["AddressCountry"] = $_POST["AddressCountry"];
	// extract the values from the $_POST["Items"] array
	$field["ListItem1"] = $_POST["ListItem"][0]['Type'];
	$field["ListItem2"]	 = $_POST["ListItem"][1]['Type'];
	$field["ListItem3"]	 = $_POST["ListItem"][2]['Type'];
	$field["ItemCode1"]   = $_POST["ItemCode"][0]['Price'];
	$field["ItemCode2"]	 = $_POST["ItemCode"][1]['Price'];
	$field["ItemCode3"]	 = $_POST["ItemCode"][2]['Price'];]
	return $field;
}
 
// $field will be what is posted from the gravityform..
$field = integration();

$layoutname = "GravityForm";
$fm = new FileMaker('FormName','url','instance','test');
$newAdd = $fm->newAddCommand($layoutname, $field);
$result = $newAdd->execute();

?>