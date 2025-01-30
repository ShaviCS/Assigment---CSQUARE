<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Item Report</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"  href="http://localhost/assignment/bootstrap/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=sans-serif" rel="stylesheet">
<script src="http://localhost/assignment/bootstrap/bootstrap.min.js"></script>
<style>
body{
    font-family: sans-serif;
    align-content: center;
}
h2{
  text-align: center;
}
form{
  display:flex;
  justify-content: center;
}
label{
  margin-right: 5px;
  margin-left: 10px;
}
table{
  position: absolute;
  left: 20%;
  width: 60%;
}
td,th{
  padding: 4px;
  text-align: center;
}
</style>
</head>

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

    <h2>Item Report</h2>
    <br/>
    <br/>

    <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "assignment";
      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Query to retrieve invoice data based on date range
      $sql = "SELECT i.item_name, c.category, s.sub_category, i.quantity FROM item i INNER JOIN item_category c ON i.item_category = c.id INNER JOIN item_subcategory s ON i.item_subcategory = s.id ORDER BY i.item_name ASC";

      $result = $conn->query($sql);

      echo "<table border='1'>
        <tr>
        <th>Item Name</th>
        <th>Item Category</th>
        <th>Item Subcategory</th>
        <th>Quantity</th>
        </tr>";

      if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["item_name"]. "</td><td>" . $row["category"]. "</td><td>" . $row["sub_category"]. "</td><td>" . $row["quantity"]. "</td></tr>";
        }
        echo "</table>";
      } else {
        echo "No results found.";
      }

      $conn->close();
    ?>

  </div>



</body>
</html>
