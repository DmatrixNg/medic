<?php
require_once('includes/config.php');
//require_once('includes/functions.php');
$title ='Search';
//if not logged in redirect to login page
$location ="Search";
if (!$user->is_logged_in()) {header('Location: login?l='.$_SESSION['location'].'');}
include 'header.php';
?>

<aside class="app-aside">
  <!-- .aside-content -->
  <div class="aside-content">
<?php include 'left_sidebar.php'; ?>
</div></aside>
<main class="app-main">

<!-- .wrapper -->
<div class="wrapper">
  <!-- .page -->
  <div class="page has-sidebar">
    <div class="sidebar-backdrop"></div>
    <header class="zx message-header d-xl-none">
  <div class="notif_tab">
        <?php include 'menu.php'; ?>
  </div>
                      <h4 class="message-title"> </h4>
                      <div class="message-header-actions">

                        <button type="button" class="btn btn-light d-xl-none" data-toggle="sidebar">
                          <i class="fa fa-angle-double-left"></i>
                        </button>
                      </div>
                    </header>
    <div class="page-inner" >
			  <div id="all_rows">
					<section class="card card-fluid">
<h6 class="border-bottom border-gray pb-2 mb-0">Results</h6>
<?php
if(isset($_GET['q'])){
	$q = $_GET['q'];

/* check connection */
$q = mysqli_real_escape_string($conn, $q);

$sql = "SELECT * FROM calebite WHERE username like '%$q%' or firstname like '%$q%'
or lastname like '%$q%' or college like '%$q%' or department like '%$q%' or course like '%$q%' or level like '%$q%' ";

$result = mysqli_query($conn, $sql);
$queryResult = mysqli_num_rows($result);
$following = following($conn,$_SESSION['memberID']);
echo "There are ".$queryResult." result!";
if ($queryResult > 0) {
	while ($list = mysqli_fetch_assoc($result)) {

$pstmt = $db->query('SELECT * FROM profile WHERE user_id="'.$list['memberID'].'"');
$prow = $pstmt->fetch();
$name = $db->query('SELECT firstname, lastname FROM calebite WHERE memberID="'.$list['memberID'].'"');
$name = $name->fetch();
$users = show_user($conn,$list['memberID']);
foreach ($users as $key => $value){

    if (in_array($key,$following)){
			?>
				<div class="card-body">
				            <div class="media align-items-center">
				<?php if (!isset($prow['profilepic'])) {?>
			<img src="<?php echo''.DIR.'images/noavatar92.png'?>" class="user-avatar user-avatar-lg mr-3">
			<?php }else { ?>
					<img
					src="<?php echo''.DIR.'profile/picture/s/'.$prow['username'].''?>" class="user-avatar user-avatar-lg mr-3">
				<?php  } ?>
				<div class="media-body">
					<h3 class="card-title text-truncate">
					<?php  echo '<a href="'.DIR.'calebite/posts/'.$list['username'].'">'.$name['firstname'].' '.$name['lastname'].'</a></strong></p>';?>
				</h3>
				<h6 class="card-subtitle text-muted">
				<?php echo '<span class="d-block">@'.$list['username'].'</span>
					<span class="d-block"><b>College:</b> '.$list['college'].'</span>
					<span class="d-block"><b>Department:</b> '.$list['department'].'</span>
					<span class="d-block"><b>Course:</b> '.$list['course'].'</span>';?>
				</h6>
			</div>
			<?php if ($list['username'] == $_SESSION['username']) {
				echo' <a href="'.DIR.'calebite/posts/'.$list['username'].'"></a>';
			} else {?><?php echo '
			<a href="'.DIR.'calebite/posts/'.$list['username'].'" class="btn btn-secondary circle">Following</a>
			';}?>
</div></div>
			<?php
}else {?>

	<div class="card-body">
							<div class="media align-items-center">
	<?php if (!isset($prow['profilepic'])) {?>
<img src="<?php echo''.DIR.'images/noavatar92.png'?>" class="user-avatar user-avatar-lg mr-3">
<?php }else { ?>
		<img
		src="<?php echo''.DIR.'profile/picture/s/'.$prow['username'].''?>" class="user-avatar user-avatar-lg mr-3">
	<?php  } ?>
	<div class="media-body">
		<h3 class="card-title text-truncate">
		<?php  echo '<a href="'.DIR.'calebite/posts/'.$list['username'].'">'.$name['firstname'].' '.$name['lastname'].'</a></strong></p>';?>
	</h3>
	<h6 class="card-subtitle text-muted">
	<?php echo '<span class="d-block">@'.$list['username'].'</span>
		<span class="d-block"><b>College:</b> '.$list['college'].'</span>
		<span class="d-block"><b>Department:</b> '.$list['department'].'</span>
		<span class="d-block"><b>Course:</b> '.$list['course'].'</span>';?>
	</h6>
</div>
<?php if ($list['username'] == $_SESSION['username']) {
	echo' <a href="'.DIR.'calebite/posts/'.$list['username'].'">Thats Me</a>';
} else {?>
<div id='follow<?php echo''.$list['memberID'].''?>'>
<button type="button" onclick="follow('<?php echo DIR.'action?id='.$key.'&do=follow&l='.$_SESSION['location'].''?>',<?php echo''.$list['memberID'].''?>)" class="btn btn-primary circle">Follow</button>
</div>
<?php } ?>

</div></div>
<?php
}
}


}

?>


<?php $lastID = $list['id'];
//echo 'firs'.$lastID;
?></section>
<div class="load-more" lastID="<?php echo $lastID; ?>" style="display: none;">
        <img src="<?php echo ''.DIR.''?>images/loading.gif"/>
    </div>
<?php
}else{
?>
<p><b>There is no result found!
</b></p>
<?php
}}
?>  <?php include 'right_sidebar.php';
?>

</div>

</div></div></div></main>
<div class="app-backdrop"></div>
<div class="app-backdrop"></div>
<?php include 'footer.php' ?>
