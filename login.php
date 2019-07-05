<?php
include "connection.php";
    include 'header.php';
        //process login form if submitted
        if(isset($_POST['submit'])){

          $username = trim($_POST['username']);
          $password = trim($_POST['password']);
    $persist = isset($_POST['persist']); //will be true or false
          if($user->login($username,$password,$persist)){

             header('Location: ./');
            exit;

          } else {
            $message = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Oops!</strong> Wrong username or password<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
          }

        }//end if submit

        ?>
        <div id="main" class="sidebar-none">


      		<div class="main-gradient"></div>
      		<div class="wf-wrap">
      			<div class="wf-container-main">




      			<div id="content" class="content" role="main">



                <form class="auth-form" autocomplete="yes" method="post">
                  <!-- .form-group -->
                    <?php  if(isset($message)){ echo $message; }?>
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" id="inputUser" name="username" class="form-control" required="" autofocus="">
                      <label for="inputUser">Username</label>
                    </div>
                  </div>
                  <!-- /.form-group -->
                  <!-- .form-group -->
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="password" id="inputPassword" name="password" class="form-control" required="">
                      <label for="inputPassword">Password</label>
                    </div>
                  </div>
                  <!-- /.form-group -->
                  <!-- .form-group -->
                  <div class="form-group">
                    <button class="btn btn-lg btn-block" name="submit"  type="submit">Sign In</button>
                  </div>
                  <!-- /.form-group -->
                  <!-- .form-group -->
                  <div class="form-group text-center">
                    <div class="custom-control custom-control-inline custom-checkbox">
                      <input type="checkbox" name='persist' class="custom-control-input" id="remember-me" checked>
                      <label class="custom-control-label" for="remember-me">Keep me sign in</label>
                    </div>
                  </div>
                  <!-- /.form-group -->
                  <!-- recovery links -->
                  <div class="text-center pt-3">
                    <a href="#" class="link">Forgot Username?</a>
                    <span class="mx-2">·</span>
                    <a href="forgot-password" class="link">Forgot Password?</a>
                  </div>
                  <!-- /recovery links -->
                </form>

  <?php include 'footer.php';   ?>
