<?php
	/*	
	*	Gravity Form Submission to Filemaker
	*	---------------------------------------------------------------------
	*	---------------------------------------------------------------------
	*/
	
	// Submit Form to FileMaker
	add_action('gform_after_submission', 'post_to_third_party', 10, 2);
	function post_to_third_party($entry, $form) {
		// if you are working with Gravity list fields  - unserialize list array
	 $item_values = unserialize($entry[22]); //depending on the setup it can also be $item_values = unserialize($entry, [22]);

	 // post to script file for matching data with filemaker fields and establishing connection
		$post_url = 'http://www.fixationuk.com/apipost.php';

		// create an array of form input values
		$body = array(
			'enquiryID' => rgar($entry, '1'),
			'FirstName' => rgar($entry, '2'),
			'LastName' => rgar($entry, '3'),
			// the gravity address field array splits into the inputs easily with .-notation
			'Address1' => rgar($entry, '4.1'),
			'Address2' => rgar($entry, '4.2'),
			'Address3' => rgar($entry, '4.3'),
			'Address4' => rgar($entry, '4.4'),
			'AddressPostCode' => rgar($entry, '4.5'),
			'AddressCountry' => rgar($entry, '4.6'),
			'Phone1' => rgar($entry, '34'),
			'Phone2' => rgar($entry, '13'),
			'Email' => rgar($entry, '14'),
			'Items' => $item_values
		);
		// create a new instance of WordPress
		$request = new Wp_Http();
		// send the array of collected value to script for further processing
		$response = $request->post($post_url, array('method' => 'POST', 'body'=>$body));
		var_dump($response);
	}


	