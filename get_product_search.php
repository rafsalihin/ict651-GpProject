<?php
$response = ['success' => false, 'message' => 'Error Occured'];
require_once "dbconnect.php"; // Connect to the database
$query = $_GET['query'];
$results=$conn->query("SELECT * FROM products WHERE Name like '%$query%'");

$response['products']=[];
if($results){
    $response['success']=true;
    $response['message']='product succefully retrieved';
    while($row=$results->fetch_assoc())
        $response['products'][]=[
            'id'=>$row['id'],
            'name'=>$row['name'],
            'description'=>$row['description'],
            'type'=>$row['category'],
            'price'=>'RM '.$row['price'],
            'img' => $row['img']
        ];
    
}
header("Content-Type: application/json");
die(json_encode($response));
?>
