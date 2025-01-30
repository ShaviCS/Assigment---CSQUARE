<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice Report</title>
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

  <div class="form">

    <h2>Invoice Report</h2>
    <br/>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="start_date">Start Date:</label>
      <input type="date" name="start_date" required>
      <label for="end_date">End Date:</label>
      <input type="date" name="end_date" required>
      &nbsp;&nbsp;
      <input type="submit" name="search" value="Search">
	  </form>
    <br/>
    <br/>

  </div>

  <div class="container-fluid">
    <?php
      if(isset($_POST['search'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "assignment";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Query to retrieve invoice data based on date range
        $sql = "SELECT i.invoice_no, i.date, c.first_name, d.district, i.item_count, i.amount FROM customer=c INNER JOIN invoice=i ON c.id = i.customer INNER JOIN district=d ON c.district = d.id WHERE i.date BETWEEN '$start_date' AND '$end_date' ORDER BY i.date ASC";

        $result = $conn->query($sql);

        echo "<table border='1'>
          <tr>
          <th>Invoice No</th>
          <th>Date</th>
          <th>Customer</th>
          <th>Customer District</th>
          <th>Item Count</th>
          <th>Amount</th>
          </tr>";

        if ($result->num_rows > 0) {
          
          while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["invoice_no"]. "</td><td>" . $row["date"]. "</td><td>" . $row["first_name"]. "</td><td>" . $row["district"]. "</td><td>" . $row["item_count"]. "</td><td>" . $row["amount"]. "</td></tr>";
          }
          echo "</table>";
        } else {
          echo "No results found.";
        }

        $conn->close();
      }
    ?>
  </div>



</body>
</html>
