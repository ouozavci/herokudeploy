<?php
 header('Content-Type: text/html; charset=utf-8');
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['fr'])) {
 
    $name = $_POST['name'];
    $surname = $_POST['surname'];
	$email = $_POST['email'];
    $password = $_POST['password'];
	$fr = $_POST['fr'];
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO userinfo(name, surname, email, password, fr) VALUES('$name', '$surname', '$email', '$password', '$fr')");
	
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
