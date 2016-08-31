<?php
include_once('include/header.php');
$odp = $comm->pobierzContent('categories');
if(isset($_GET['id']) && isset($_POST['OK'])) {
$db->usunWiersz('categories', 'id', $_GET['id']);
echo "<meta http-equiv='refresh' content='1'>";
}
if(isset($_POST['zmodyfikuj'])){
$content->aktualizujKategorie($_POST['nazwaKat'],$_POST['opisKat'], $_GET['id']);
echo "<meta http-equiv='refresh' content='1'>";
}
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Kategorie
            <small>Zmodyfikuj/usuń kategorie do aktualności ze strony</small>
          </h1>
 <?php $comm->nazwaStrony(basename(__FILE__, ".php")); ?>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php if(isset($_POST['zmodyfikuj'])) {?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i>Zmodyfikowano!</h4>
                    Zaktualizowano kategorie.
                </div>
                <?php } ?>
                <?php if(isset($_GET['usun']) && !isset($_POST['anuluj']) && !isset($_POST['OK'])){ ?>
                <form action="categories.php?id=<?php echo $_GET['id']; ?>" method="post">
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Czy napewno?</h4>
                    Czy napewno chcesz usunąć kategorię i przypisane do niej aktualności?
                  </div>
                <button type="submit" name="OK" class="btn btn-primary">OK</button><button name="anuluj" type="submit" class="btn btn-primary">Wróć</button>
                </form>
               <?php } if(isset($_POST['OK'])) {?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Usunięto!</h4>
                    Usunięto kategorie.
                </div>
                <?php } if(!isset($_GET['usun'])){?>
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Dostępne kategorie na stronie</h3>
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
                      <th>Nazwa kategorii</th>
                      <th>Opis</th>
                        <th>Modyfikuj</th>
                    </tr>
                      <?php while($table = $db->fetch_array($odp)){ ?>
                    <tr>
                      <td><?php echo $table['id']; ?></td>
                      <td><?php echo $table['title']; ?></td>
                      <td><?php echo $table['text']; ?></td>
                        <td><form action="categories.php?id=<?php echo $table['id']; ?>&usun=<?php echo $table['title']; ?>" method="post"><div class="btn-group">
                      <button type="submit" class="btn btn-danger">Usuń</button>
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Podmenu</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="categories.php?id=<?php echo $table['id']; ?>&usun=<?php echo $table['title']; ?>">Usuń</a></li>
                        <?php if($db->pobierzDane('comments', 'id', $table['id'], 'allow') == 0) {?>
                        <li><a href="categories.php?id=<?php echo $table['id']; ?>&modyfikuj=<?php echo $table['title']; ?>">Modyfikuj</a></li>
                        <?php } ?>
                      </ul>
                                        </div>
                            </form></td>
                    </tr>
                      <?php }?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
                <?php if(isset($_GET['modyfikuj'])) { $mod = $db->pobierzWiele($_GET['id'],'categories'); ?>
                <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Modyfikuj kategorie</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <form action="categories.php?id=<?php echo $_GET['id']; ?>&modyfikuj" method="post">
                              <div class="form-group">
                      <label>Nazwa kategorii</label>
                      <input type="text" name="nazwaKat" class="form-control" value="<?php echo $mod['title']; ?>">
                    </div>
                <div class="form-group">
                      <label>Opis</label>
                      <textarea class="form-control" name="opisKat" rows="3"><?php echo $mod['text']; ?></textarea>
                </div>

            </div><!-- /.box-body -->
            <div class="box-footer">
                              <div class="box-footer">
                    <button type="submit" name="zmodyfikuj" class="btn btn-primary">Zmodyfikuj</button>
                                   
                </div>
            </div><!-- /.box-footer-->
              </form>           
                    </div>
                <?php } }?>
            </div>
          </div>
                    </section><!-- /.content -->
<?php
include_once('include/footer.php');
?>