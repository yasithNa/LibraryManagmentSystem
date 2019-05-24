<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body>
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Create Product</h1>
        </div>
      
    <!-- html form to create product will be here -->
          
<!-- PHP insert code will be here -->
 
<?php

if($_POST){
 


    // include database connection
    include('includes/config.php');
 
    try{
     
        // insert query
        $query = "INSERT INTO donation SET name=:name, description=:description, email=:email, created=:created";
 
        // prepare query for execution
        $query = $dbh->prepare($query);
 
        // posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $description=htmlspecialchars(strip_tags($_POST['description']));
        $email=htmlspecialchars(strip_tags($_POST['email']));
 
        // bind the parameters
        $query->bindParam(':name', $name);
        $query->bindParam(':description', $description);
        $query->bindParam(':email', $email);
         
        // specify when this record was inserted to the database
        $created=date('Y-m-d H:i:s');
        $query->bindParam(':created', $created);
         
        // Execute the query
        if($query->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
         
    }
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
	
}
?>



<!-- html form here where the product information will be entered -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Full Name</td>
            <td><input type='text' name='name' class='form-control' required />
            
	</td>
        </tr>
        <tr>
            <td>Donate Items</td>
            <td><textarea name='description' class='form-control' required ></textarea>
	      
	</td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td><input type='email' pattern="[^ @]*@[^ @]*" placeholder="Enter your email" name='email' class='form-control' required />
	     
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='DOindex.php' class='btn btn-danger'>Back to read donation</a>
            </td>
        </tr>
    </table>
</form>

    </div> <!-- end .container -->
      
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>