<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update Customers</title>
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
$title="";
$first_name="";
$middle_name="";
$last_name="";
$contact_no="";
$district="";

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
	$data[0]=$_POST['id'];
	$data[1]=$_POST['title'];
	$data[2]=$_POST['first_name'];
	$data[3]=$_POST['middle_name'];
	$data[4]=$_POST['last_name'];
  	$data[5]=$_POST['contact_no'];
  	$data[6]=$_POST['district'];
	return $data;
}
//search
if(isset($_POST['search']))
{
	$info = getData();
	$search_query="SELECT * FROM customer WHERE id = '$info[0]'";
	$search_result=mysqli_query($conn, $search_query);
		if($search_result)
		{
			if(mysqli_num_rows($search_result))
			{
				while($rows = mysqli_fetch_array($search_result))
				{
					$id = $rows['id'];
					$title = $rows['title'];
					$first_name = $rows['first_name'];
					$middle_name = $rows['middle_name'];
					$last_name = $rows['last_name'];
					$contact_no = $rows['contact_no'];
					$district = $rows['district'];

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
	$insert_query="INSERT INTO `customer`(`title`, `first_name`, `middle_name`, `last_name`,`contact_no`,`district`) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]','$info[5]','$info[6]')";
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
	$delete_query = "DELETE FROM `customer` WHERE id = '$info[0]'";
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
	$district_id = $_POST['district'];
	$query = "SELECT * FROM `district` WHERE `id`='$district_id'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$update_query="UPDATE `customer` SET `title`='$info[1]',first_name='$info[2]',middle_name='$info[3]',last_name='$info[4]',contact_no='$info[5]',district='$info[6]' WHERE id = '$info[0]'";
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
	<h1>ID Number (Use to Search Student data)</h1>
  	<input type="number" name="id"  class="form-control" placeholder="ID No.(Enetr No. to Search)" value="<?php echo($id);?>">
	<div class="form-group row">
		<div class="col-xs-6">
			<h1>Title</h1>
			<input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo($title);?>" >
		</div>
		<div class="col-xs-6">
			<h1>First Name</h1>
			<input type="text" name="first_name" class="form-control" placeholder="Enter First Name" value="<?php echo($first_name);?>" >
		</div>
  	</div>

	<div class="form-group row">
		<div class="col-xs-6">
		<h1>Middle Name</h1>
			<input type="text" name="middle_name" class="form-control" placeholder="Enter Middle Name" value="<?php echo($middle_name);?>">
		</div>
		<div class="col-xs-6">
		<h1>Last Name</h1>
		<input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" value="<?php echo($last_name);?>" >
		</div>
  	</div>

	<h1>Contact no. (10-digit)</h1>
	<input type="tel" pattern="^\d{10}$" class="form-control" name="contact_no"  placeholder="Enter Contact Number" value="<?php echo($contact_no);?>">

  	<h1>District</h1>
  	<select name="district">
		<option>Select District</option>
		<?php
			$query = "SELECT id,district FROM `district`";
			$result = mysqli_query($conn, $query);
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='" . $row['id'] . "'>" . $row['district'] . "</option>";
			}
		?>
  </select>

  <br/>
  <br/>

		<div class="form-group row">
		<hr/>
		<div class="col-xs-4">
				<input type="submit" class="btn btn-primary btn-block btn-lg" name="search" value="Find">
			</div>
			<div class="col-xs-4">
					<input type="submit" class="btn btn-warning btn-block btn-lg" name="update" value="Update">
				</div>
				<div class="col-xs-4">
		<input type="submit" class="btn btn-danger btn-block btn-lg" name="delete" value="Delete">
	</div>
</div>
</form>
</div>

    <div class="col-lg-8">
			<h2>Student Data Update | Delete </h2>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id,title,first_name,middle_name,last_name,contact_no,district FROM customer";
$result = $conn->query($sql);

echo "<table border='1'>
<tr>
<th>Search ID</th>
<th>Title</th>
<th>First Name</th>
<th>Middle Name</th>
<th>Last Name</th>
<th>Contact_no</th>
<th>District</th>

</tr>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['title'] . "</td>";
echo "<td>" . $row['first_name'] . "</td>";
echo "<td>" . $row['middle_name'] . "</td>";
echo "<td>" . $row['last_name'] . "</td>";
echo "<td>" . $row['contact_no'] . "</td>";
echo "<td>" . $row['district'] . "</td>";

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
