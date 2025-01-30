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
h2{
  text-align: center;
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

    <h2>Reports</h2>
    <br/>
    <br/>

    <div>  
      <div class="col-xs-4">
        <input onclick="window.location.href = 'invoice_report.php';" class="btn btn-primary btn-block btn-lg" name="invoice_report" value="Invoice Report">
      </div>
      <div class="col-xs-4">
        <input onclick="window.location.href = 'invoice_item_report.php';" class="btn btn-warning btn-block btn-lg" name="invoice_item_report" value="Invoice Item Report">
      </div>
      <div class="col-xs-4">
        <input onclick="window.location.href = 'item_report.php';" class="btn btn-danger btn-block btn-lg" name="item_report" value="Item Report">
      </div>
    </div>

  </div>



</body>
</html>
