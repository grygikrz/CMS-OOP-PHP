<?php
include_once('include/header.php');
$odp = $comm->pobierzContent('comments');
if(isset($_GET['id']) && isset($_POST['OK'])) {
    $db->usunWiersz('comments', 'id', $_GET['id']);
     echo "<meta http-equiv='refresh' content='0'>";
}
if(isset($_POST['delete'])) {
    $db->usunWiersz('comments', 'id', $_POST['delete']);
}
if(isset($_GET['zatwierdz'])) {
    $db->aktualizujWiersz('comments', 'id', $_GET['id'], 'allow', '1');
}

if(isset($_POST['wybierz'])) {

if($_POST['select'] == 'usun') {

    $db->usunWiersz('comments','id',$_POST['checkboxvar']);
    echo "<meta http-equiv='refresh' content='1'>";   
    }
if($_POST['select'] == 'zatwierdz') {
    $db->aktualizujWiersz('comments', 'id', $_POST['checkboxvar'], 'allow', '1');
    echo "<meta http-equiv='refresh' content='1'>";   
    }
}
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Komentarze
            <small>Sprawdź/usuń dostępne komentarze ze strony</small>
          </h1>
            <?php $comm->nazwaStrony(basename(__FILE__, ".php")); ?>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
            <div class="col-xs-12">
           <?php if(isset($_GET['usun']) && !isset($_POST['anuluj']) && !isset($_POST['OK'])){ ?>
                <form action="comments.php?id=<?php echo $_GET['id'];?>" method="post">
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Czy napewno?</h4>
                    Czy napewno chcesz usunąć kategorię i przypisane do niej aktualności?
                  </div>
                <button type="submit" name="OK" class="btn btn-primary">OK</button><button name="anuluj" type="submit" class="btn btn-primary">Wróć</button>
                </form>
               <?php } if(isset($_POST['select']) == 'zatwierdz') {?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Zatwierdzono!</h4>
                    Zatwierdzono komentarz.</div>
                <?php } if(isset($_POST['select']) == 'usun' && isset($_POST['OK'])) {?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Usunięto!</h4>
                    Usunięto komentarz.</div>
                <?php }
                if(!isset($_GET['usun']) || !isset($_POST['delete'])){?>
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Dostępne komentarze</h3>
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
                    <form action="" method="post" enctype="multipart/form-data">
                 <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Imie/Nazwisko</th>
                        <th>Treść</th>
                        <th>Data komentarza</th>
                        <th>Status</th>
                        <th>Zaznacz</th>
                        <th>Modyfikuj</th>
                    </tr>
                      <?php while($table = $db->fetch_array($odp)){ ?>
                    <tr>
                      <td><?php echo $table['id']; ?></td>
                      <td><?php echo $table['name']; ?></td>
                      <td><?php echo $table['text']; ?></td>
                      <td><?php echo $table['data']; ?></td>
                        <td><?php if($db->pobierzDane('comments', 'id', $table['id'], 'allow') == 0) { echo "<div style=\"color:red;\">niezatwierdzone</div>";}else{echo "<div style=\"color:green;\">zatwierdzone</div>";}?></td>
                         <td><input value="<?php echo $table['id']; ?>" name="checkboxvar[<?php echo $table['id']; ?>]" type="checkbox"></td>
                        <td><div class="btn-group">
                      <button type="submit" value="<?php echo $table['id']; ?>" name="delete" class="btn btn-danger">Usuń</button>
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Podmenu</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="comments.php?id=<?php echo $table['id']; ?>&usun=<?php echo $table['name']; ?>">Usuń</a></li>
                        <?php if($db->pobierzDane('comments', 'id', $table['id'], 'allow') == 0) {?>
                        <li><a href="comments.php?id=<?php echo $table['id']; ?>&zatwierdz=<?php echo $table['name']; ?>">Zatwierdź</a></li>
                        <?php } ?>
                      </ul>
                                        </div>
                        </td>
                    </tr>
                      <?php } ?>
                  </table>
                </div><!-- /.box-body -->
                                    <div class="box-footer" style="display: block;">          
                <select name="select" class="form-control select2 select2-hidden-accessible" style="width: 50%;" tabindex="-1" aria-hidden="true">
                      <option value="usun" selected="selected">Usuń</option>
                      <option value="zatwierdz">Zatwierdź</option>
                    </select>
                  <button type="submit" name="wybierz" class="btn btn-primary">Wyślij</button>
             </form>
                  </div>
              </div><!-- /.box -->
             <?php } ?>
            </div>
          </div>
                    </section><!-- /.content -->
<?php
include_once('include/footer.php');
?>