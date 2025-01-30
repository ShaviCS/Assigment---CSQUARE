<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Items</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"  href="http://localhost/assignment/bootstrap/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=sans-serif" rel="stylesheet">
<script src="http://localhost/assignment/bootstrap/bootstrap.min.js"></script>
<style>
body{
    font-family: sans-serif;
}
.submit{
  background-color: purple;
  color:white;
  text-size:24px;
  padding: 6px;
  border-radius: 5px;
  border:1px solid white;
  font-size: 24px;
}
.submit:hover{
  background-color: white;
  color: purple;
  box-shadow: 0px 0px 20px white;
}
h1{
	font-size: 14px;
}

td,th{
  padding: 4px;
  text-align: center;
}
</style>
</head>
<?php
$servername = "localhost";
$username="root";
$password="";
$dbname="assignment";
$id="";
$item_code="";
$item_category="";
$item_subcategory="";
$item_name="";
$quantity="";
$unit_price="";


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//connect to mysql database
try{
	$conn =mysqli_connect($servername,$username,$password,$dbname);
}catch(MySQLi_Sql_Exception $ex){
	echo("error in connecting");
}
//get data from the form
function getData()
{
	$data = array();

	$data[1]=$_POST['item_code'];
	$data[2]=$_POST['item_category'];
	$data[3]=$_POST['item_subcategory'];
  $data[4]=$_POST['item_name'];
  $data[5]=$_POST['quantity'];
  $data[6]=$_POST['unit_price'];
	return $data;
}
//search
if(isset($_POST['search']))
{
	$info = getData();
	$search_query="SELECT * FROM item WHERE id = '$info[0]'";
	$search_result=mysqli_query($conn, $search_query);
		if($search_result)
		{
			if(mysqli_num_rows($search_result))
			{
				while($rows = mysqli_fetch_array($search_result))
				{
					$id = $rows['id'];
					$item_code = $rows['item_code'];
					$item_category = $rows['item_category'];
					$item_subcategory = $rows['item_subcategory'];
          $item_name = $rows['item_name'];
          $quantity = $rows['quantity'];
          $unit_price = $rows['unit_price'];

				}
			}else{
				echo("no data are available");
			}
		} else{
			echo("result error");
		}

}
//insert
if(isset($_POST['insert'])){
	$info = getData();
  $item_category_id = $_POST['item_category'];
  $query1 = "SELECT * FROM `item_category` WHERE `id`='$item_category_id'";
  $result1 = mysqli_query($conn, $query1);
  $row = mysqli_fetch_array($result1);
  $item_subcategory_id = $_POST['item_subcategory'];
  $query2 = "SELECT * FROM `item_subcategory` WHERE `id`='$item_subcategory_id'";
  $result2 = mysqli_query($conn, $query2);
  $row = mysqli_fetch_array($result2);
	$insert_query="INSERT INTO `item`(`item_code`,`item_category`, `item_subcategory`,`item_name`,`quantity`,`unit_price`) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]','$info[5]','$info[6]')";
	try{
		$insert_result=mysqli_query($conn, $insert_query);
		if($insert_result)
		{
			if(mysqli_affected_rows($conn)>0){
				echo("data inserted successfully");

			}else{
				echo("data are not inserted");
			}
		}
	}catch(Exception $ex){
		echo("error inserted".$ex->getMessage());
	}
}
//delete
if(isset($_POST['delete'])){
	$info = getData();
	$delete_query = "DELETE FROM `item` WHERE id = '$info[0]'";
	try{
		$delete_result = mysqli_query($conn, $delete_query);
		if($delete_result){
			if(mysqli_affected_rows($conn)>0)
			{
				echo("data deleted");
			}else{
				echo("data not deleted");
			}
		}
	}catch(Exception $ex){
		echo("error in delete".$ex->getMessage());
	}
}
//edit
if(isset($_POST['update'])){
	$info = getData();
  $item_category_id = $_POST['item_category'];
  $query1 = "SELECT * FROM `item_category` WHERE `id`='$item_category_id'";
  $result1 = mysqli_query($conn, $query1);
  $row = mysqli_fetch_array($result1);
  $item_subcategory_id = $_POST['item_subcategory'];
  $query2 = "SELECT * FROM `item_subcategory` WHERE `id`='$item_subcategory_id'";
  $result2 = mysqli_query($conn, $query2);
  $row = mysqli_fetch_array($result2);
	$update_query="UPDATE `item` SET `item_code`='$info[1]',item_category='$info[2]',item_subcategory='$info[3]',item_name='$info[4]',quantity='$info[5]',unit_price='$info[6]' WHERE id = '$info[0]'";
	try{
		$update_result=mysqli_query($conn, $update_query);
		if($update_result){
			if(mysqli_affected_rows($conn)>0){
				echo("data updated");
			}else{
				echo("data not updated");
			}
		}
	}catch(Exception $ex){
		echo("error in update".$ex->getMessage());
	}
}

?>
<body>
	<div class="container-fliud">
        <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
      <a class="navbar-brand" href="http://localhost/assignment/">ERP System</a>
    </div>
     <div class="collapse navbar-collapse" id="nav">
    <ul class="nav navbar-nav">
      <li class="active"><a href="http://localhost/assignment">Home</a></li>
      <li><a href="http://localhost/assignment/customer.php">Customers</a></li>
      <li><a href="http://localhost/assignment/item.php">Items</a></li>
      <li><a href="http://localhost/assignment/report.php">Reports</a></li>
   </ul>
  </div>
</div>
</nav>
      </div>
	<div class="container-fluid">
	  <div class="row">
	    <div class="col-lg-4">

<form method ="post"   action="">
  <div class="form-group row">
    <div class="col-xs-6">
      <h1>ID Number</h1>
      <input type="number" name="id"  class="form-control" placeholder="ID No." value="<?php echo($id);?>" disabled>
    </div>
    <div class="col-xs-6">
      <h1>Item Code</h1>
	    <input type="text" name="item_code" class="form-control" placeholder="Enter Item Code" value="<?php echo($item_code);?>"required>
    </div>
  </div>
	
  <div class="form-group row">
    <div class="col-xs-6">
      <h1>Item Category</h1>
      <select name="item_category">
        <option>Select Category</option>
        <?php
        $query = "SELECT * FROM `item_category`";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result)) {
          echo "<option value='" . $row['id'] . "'>" . $row['category'] . "</option>";
        }
        ?>
      </select>
    </div>
    <div class="col-xs-6">
      <h1>Item Subcategory</h1>
      <select name="item_subcategory">
        <option>Select Subcategory</option>
        <?php
        $query = "SELECT * FROM `item_subcategory`";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result)) {
          echo "<option value='" . $row['id'] . "'>" . $row['sub_category'] . "</option>";
        }
        ?>
      </select>
    </div>
  </div>

  <h1>Item Name</h1>
	<input type="text" name="item_name" class="form-control" placeholder="Enter Item Name" value="<?php echo($item_name);?>"required>
  
  <h1>Quantity</h1>
	<input type="number" name="quantity" class="form-control" placeholder="Enter Quantity" value="<?php echo($quantity);?>"required>
  
  <h1>Unit Price</h1>
	<input type="number" name="unit_price" class="form-control" placeholder="Enter Unit Price" value="<?php echo($unit_price);?>"required>
  
  
</br>
</br>
		<input type="submit" class="btn btn-success btn-block btn-lg" name="insert" value="Add">
    <a href="http://localhost/assignment/updateitemdata.php"<button class="btn btn-info btn-block btn-lg">Update | Delete | Find</button></a>

</form>
</div>

    <div class="col-lg-8">
			<h2>Item Data</h2>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT i.id,i.item_code,c.category,s.sub_category,i.item_name,i.quantity,i.unit_price FROM item i INNER JOIN item_category c ON i.item_category = c.id INNER JOIN item_subcategory s ON i.item_subcategory = s.id";
$result = $conn->query($sql);

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Item Code</th>
<th>Item Category</th>
<th>Item Subcategory</th>
<th>Item Name</th>
<th>Quantity</th>
<th>Unit Price</th>


</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['item_code'] . "</td>";
      echo "<td>" . $row['category'] . "</td>";
      echo "<td>" . $row['sub_category'] . "</td>";
      echo "<td>" . $row['item_name'] . "</td>";
      echo "<td>" . $row['quantity'] . "</td>";
      echo "<td>" . $row['unit_price'] . "</td>";


echo "</tr>";


    }
} else {
    echo "0 results";
}

$conn->close();
?>
</div>
</div>
</body>
</html>
