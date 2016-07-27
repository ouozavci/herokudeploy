<?php
 header('Content-type: text/html; charset=utf8');

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["email"])) {
    $email = $_GET['email'];
 
    // get a product from products table
    $result = mysql_query("SELECT * FROM userinfo WHERE email = '$email' ");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
			$product = array();
            $product["name"] = $result["name"];
            $product["surname"] = $result["surname"];
			
			$name = $result["name"];
			$surname = $result["surname"];
			$diary = $result["Diary"];			
            
            // success
            $response["success"] = 1;
 
            // user node
            $response["product"] = array();
 
            array_push($response["product"], $product);

            // echoing JSON response
            echo "<h3 align='center'>Welcome to the page of <b>". $name ." ".$surname."</b></h3><p  align='center'>".$diary."</p>";
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found 1";
 
            // echo no users JSON
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found 2";
 
        // echo no users JSON
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
		header('Content-Type: text/html; charset=utf-8');
    // echoing JSON response
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
?>

