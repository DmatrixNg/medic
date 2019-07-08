<?php
include "connection.php";
include 'header.php';

$id = $_GET['id'];
$result = $db->query('SELECT * FROM template_drug WHERE drug_id = '.$id.'');
$sql = "SELECT * FROM drug WHERE id = '$id' ";
$result2 = $db->query($sql);
?>
<div id="main" class="sidebar-none">


  <div class="main-gradient"></div>
  <div class="wf-wrap">
    <div class="wf-container-main">
      <?php  for ($i = 1; $row2 = $result2->fetchArray(); $i++) {
    ?>

<h2>Drug #<?php echo $row2['name'];} ?></h2>


    <div id="content" class="content" role="main">


<table class="table table-responsive">
  <thead>
  <tr>
<th scope="col">DRUG TYPE</th>
<th scope="col">DRUG STRENGTH</th>
<th scope="col">DRUG DOSE</th>
<th scope="col">DRUG DURATION</th>
<th scope="col">DRUG ADVICE</th>
</tr>
</thead>
<tbody>

<?php
for ($i = 1; $row = $result->fetchArray(); $i++) {?>

<tr>
<td><?php echo $row['drug_type']; ?></td>
<td><?php echo $row['drug_strength']; ?></td>
<td><?php echo $row['drug_dose']; ?></td>
<td><?php echo $row['drug_duration']; ?></td>
<td><?php echo $row['drug_advice']; ?></td>
</tr>
<?php }
 ?>
</tbody>
</table>

<!-- !Footer -->
<?php include 'footer.php'; ?>
