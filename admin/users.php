<?php
include_once('include/header.php');
$odp = $comm->pobierzContent('users');

if(isset($_GET['id']) && isset($_POST['OK'])){
    $db->usunWiersz('users', 'id', $_GET['id']);
    echo "<meta http-equiv='refresh' content='1'>";
}
if(isset($_GET['id']) && isset($_POST['modyfikuj'])) {
    $user->aktualizujDane($_POST['username'], $_POST['haslo'], $_POST['imie'], $_POST['nazwisko'], $_POST['foto'], $_GET['id']);
    echo "<meta http-equiv='refresh' content='1'>";
}
if(isset($_GET['sprawdz'])){ 
    $odp2 = $db->pobierzWiele($_GET['id'], 'users');
}
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Użytkownicy
            <small>W tej sekcji możesz dodać/usunąć użytkownika</small>
          </h1>
 <?php $comm->nazwaStrony(basename(__FILE__, ".php")); ?>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php if(isset($_POST['modyfikuj'])) {?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Zmodyfikowano!</h4>
                    Zmodyfikowano użytkownika.
                </div>
                <?php } if(isset($_GET['usun']) && !isset($_POST['anuluj']) && !isset($_POST['OK'])){ ?>
                <form action="users.php?id=<?php echo $_GET['id']; ?>" method="post">
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Czy napewno?</h4>
                    Czy napewno chcesz usunąć użytkownika?
                  </div>
                <button type="submit" name="OK" class="btn btn-primary">OK</button><button name="anuluj" type="submit" class="btn btn-primary">Wróć</button>
                </form>
               <?php } if(isset($_POST['OK'])) {?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Usunięto!</h4>
                    Usunięto użytkownika.
                </div>
                <?php } if(!isset($_GET['usun'])){?>
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Dostępni użytkownicy</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Nazwa użytkownika</th>
                        <th>Imie</th>
                        <th>Nazwisko</th>
                        <th>Data rejestracji</th>
                        <th>Avatar</th>
                        <th>Usuń</th>
                    </tr>
                      <?php while($table = $db->fetch_array($odp)){ ?>
                    <tr>
                      <td><?php echo $table['id']; ?></td>
                      <td><?php echo $table['username']; ?></td>
                      <td><?php echo $table['name']; ?></td>
                      <td><?php echo $table['surname']; ?></td>
                      <td><?php echo $table['data']; ?></td>
                      <td><?php echo $table['foto']; ?></td>
                        <td><form action="users.php?id=<?php echo $table['id']; ?>&sprawdz" method="post"><div class="btn-group">
                      <button type="submit" class="btn btn-danger">Zmień</button>
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Podmenu</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="users.php?id=<?php echo $table['id']; ?>&usun">Usuń</a></li>
                        <li><a href="users.php?id=<?php echo $table['id']; ?>&sprawdz">Modyfikuj</a></li>
                      </ul>
                    </div></form></td>
                    </tr>
                      <?php }?>
                  </table>
                </div><!-- /.box-body -->
                  
              </div><!-- /.box -->
                <?php if(isset($_GET['sprawdz'])) { ?>
                <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Modyfikuj użytkownika</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <form action="users.php?id=<?php echo $_GET['id']; ?>&modyfikuj" method="post">
                    <div class="form-group">
                                <label>Email</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $odp2['username']; ?>"></input>
                                <label>Hasło</label>
                    <input type="text" name="haslo" class="form-control" value="<?php echo $odp2['password']; ?>">
                                <label>Hasło ponownie</label>
                    <input type="text" name="haslo2" class="form-control" value="<?php echo $odp2['password']; ?>">
                                <label>Imie</label>
                    <input type="text" name="imie" class="form-control" value="<?php echo $odp2['name']; ?>">
                                <label>Nazwisko</label>
                    <input type="text" name="nazwisko" class="form-control" value="<?php echo $odp2['surname']; ?>">
                                <label>Foto</label>
                    <input type="text" name="foto" class="form-control" value="<?php echo $odp2['foto']; ?>">
                    </div>

            </div><!-- /.box-body -->
            <div class="box-footer">
                              <div class="box-footer">
                    <button type="submit" name="modyfikuj" class="btn btn-primary">Zmień</button>
                                   
                        </div>
            </div><!-- /.box-footer-->
            </form> 
                    </div>
                                  <?php } } ?>
            </div>
          </div>
                    </section><!-- /.content -->
<?php
include_once('include/footer.php');
?>