<?php
include "connection.php";
$id =$_GET['id'];
$q = $id;
$sql = "SELECT * FROM drug WHERE name like '%$q%' ";
$result = $db->query($sql);?>
<table class="table table-responsive">
  <caption>List of drugs</caption>
<thead>
  <tr>

<th scope="col">NAME</th>
<th scope="col">GENERIC NAME</th>
<th scope="col">NOTE</th>
<th scope="col">ACTION</th>
</tr>
</thead>
<tbody><?php
while ($row = $result->fetchArray()){
  ?>
  <tr>
  <td><?php echo $row['name']; ?></td>
  <td><?php echo $row['genric_name']; ?></td>
  <td><?php echo $row['note']; ?></td>

  <td><a href="view_drug.php?id=<?php echo $row['id']; ?>">View</a></td>
  </tr>
  <?php

 }


   ?>
  </tbody>
  </table>
