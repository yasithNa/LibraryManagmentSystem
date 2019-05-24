<?php
// include database connection
include('includes/config.php');
 
try {
     
    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
    // delete query
    $query = "DELETE FROM donation WHERE id = ?";
    $query = $dbh->prepare($query);
    $query->bindParam(1, $id);
     
    if($query->execute()){
        // redirect to read records page and 
        // tell the user record was deleted
        header('Location: DOindex.php?action=deleted');
    }else{
        die('Unable to delete record.');
    }
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>