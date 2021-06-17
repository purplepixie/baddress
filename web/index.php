<!DOCTYPE html>
  <html>
  <head>
    <title>Baddress - worst address book</title>
    <style type="text/css">
      body { font: sans-serif; }
    </style>
  </head>
  <body>
    <h1>Baddress</h1>
<?php

$sql = mysqli_connect("localhost","root","root", "baddress") or die("MySQL Cannot connect!");

if (isset($_REQUEST['addrecordaction']))
{
  mysqli_query($sql,"INSERT INTO person(`name`,`address`,`telephone`) VALUES('".$_REQUEST['name']."','".$_REQUEST['address']."','".$_REQUEST['phone']."')");
  echo mysqli_error($sql);
  echo "<h3>Person Added</h3>";
}

?>

<form action="http://127.0.0.1:8888/QUB/Teaching/2020-21/Projects/MSc%20Seminar/baddress/web/index.php" method="POST">
  <input type="hidden" name="search" value="1">
  <b>Search: </b> <input type="text" name="searchstring" placeholder="Search..."> <input type="submit" value="Search">
</form>
<br />

<?php
if (isset($_REQUEST['search']))
{
  echo "<table>";
  echo "<tr><th>Name</th><th>Address</th><th>Phone</th></tr>";
  $res = mysqli_query($sql,"SELECT * FROM person WHERE name LIKE '%".$_REQUEST['searchstring']."%'");
  while ($row = mysqli_fetch_assoc($res))
  {
    echo "<tr><td>".$row['name']."</td><td>".$row['address']."</td><td>".$row['telephone']."</td></tr>";
  }
  echo "</table>";
}
else
{
  echo "<table>";
  echo "<tr><th>Name</th><th>Address</th><th>Phone</th></tr>";
  $res = mysqli_query($sql,"SELECT * FROM person");
  while ($row = $res->fetch_assoc())
  {
    echo "<tr><td>".$row['name']."</td><td>".$row['address']."</td><td>".$row['telephone']."</td></tr>";
  }
  echo "</table>";
}
?>

<h2>Add Record</h2>
<form action="index.php" method="get">
  <input type="hidden" name="addrecordaction" value="1">
  <input type="text" name="name" placeholder="Name"><br />
  <input type="text" name="address" placeholder="Address"><br />
  <input type="text" name="phone" placeholder="Phone"><br />
  <input type="submit" value="Add Record">
</form>

</body>
</html>
