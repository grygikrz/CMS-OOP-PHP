<?php
include_once('include/header.php');

if(isset($_POST['add'])) {
$user->addUser($_POST['email'], $_POST['password'], $_POST['name'], $_POST['surname']);
}
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Użytkownicy
            <small>Tutaj możesz dodać użytkownika</small>
          </h1>
 <?php $comm->nazwaStrony(basename(__FILE__, ".php")); ?>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php if(isset($_POST['add'])) {?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Dodano!</h4>
                    Dodano użytkownika.
                </div>
                <?php } ?>
        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Dodaj użytkownika</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                  <div class="box-body">
        <div class="register-box-body">
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
            <div class="form-group has-feedback">
            <input type="text" name="name" class="form-control" placeholder="Imie">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
          <div class="form-group has-feedback">
            <input type="text" name="surname" class="form-control" placeholder="Nazwisko">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Hasło">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="repassword" class="form-control" placeholder="Powtórz hasło">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="add" class="btn btn-primary btn-block btn-flat">Rejestruj</button>
            </div><!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- LUB -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Zarejestruj się za pomocą Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Zarejestruj się za pomocą Google+</a>
        </div>
      </div>
                  </div><!-- /.box-body -->

              </div>
        </section><!-- /.content -->
<?php
include_once('include/footer.php');
?>