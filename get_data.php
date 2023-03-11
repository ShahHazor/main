<?php
// Include database connection code
$con = mysqli_connect("localhost", "root", "", "charts");
$result = mysqli_query($con, "SELECT * FROM contribution");
$rows = array();
while ($row = mysqli_fetch_array($result)) {
  $rows[] = array($row['student'], (int)$row['contribution']);
}
echo json_encode($rows);
