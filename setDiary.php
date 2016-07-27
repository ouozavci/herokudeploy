<?php
 header('Content-Type: text/html; charset=utf-8');
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['email']) && isset($_POST['Diary'])) {
 

	$email = $_POST['email'];
    $diary = $_POST['Diary'];
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	
 
    // mysql inserting a new row
    $result = mysql_query("UPDATE userinfo SET Diary = '$diary' where email = '$email'");
	
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Product successfully created.";
 
        // echoing JSON response
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response,JSON_UNESCAPED_UNICODE);
}
?>
