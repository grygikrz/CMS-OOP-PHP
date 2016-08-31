<?php
include_once('include/header.php');


$odp = $comm->pobierzContent('news');
$odp2 = $comm->columnContent('categories','title');


if(isset($_POST['modyfikuj'])) {

    $a = new news($db);
	
    $a->ID = $_GET['id'];
	$a->post_title = $_POST['title'];
	$a->post_content = $_POST['editor1'];
    $a->post_short_content = substr($_POST['editor1'], 0,400);
    $a->updateNews();
}


if(isset($_POST['wybierz'])) {

if($_POST['select'] == 'usun') {

    $db->usunWiersz('news','id',$_POST['checkboxvar']);
    echo "<meta http-equiv='refresh' content='1'>";   
}
    
}
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Przeglądaj aktualności
            <small>Sprawdź dostępne aktualności ze strony</small>
          </h1>
 <?php $comm->nazwaStrony(basename(__FILE__, ".php")); ?>
        </section>

        <!-- Main content -->
        <section class="content">
                      <?php if(isset($_POST['checkboxvar'])) {?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Zapisano!</h4>
                    Zapisano ustawienia.
                </div>
                <?php } ?>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Dostępne aktualności</h3>
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
                      <th>Numer</th>
                      <th>Tutuł Postu</th>
                      <th>Kategoria</th>
                      <th>Data</th>
                      <th>Autor</th>
                      <th>Liczba komentarzy</th>
                        <th>Zaznacz</th>
                        <th>Wykonaj</th>
                    </tr>
                      <?php while($table = $db->fetch_array($odp)){ ?>
                    <tr>
                      <td><?php echo $table['id']; ?></td>
                      <td><?php echo $table['post_title']; ?></td>
                    <td><?php 
                          $cat = unserialize($table['category_id']);
                          foreach ($cat as $c):
                                 $category = $db->pobierzWiele($c, 'categories');
                                 echo $category['title'].'<br>';
                            endforeach;?></td>
                      <td><?php echo $table['post_date']; ?></td>
                      <td><?php echo $table['post_author']; ?></td>
                      <td><?php echo $table['post_comment_count']; ?></td>

                        <td>
                            <input value="<?php echo $table['id']; ?>" name="checkboxvar[<?php echo $table['id']; ?>]" type="checkbox">
                    </td>
                        <td>
                      <div class="btn-group">
                      <button type="button" name="usun" class="btn btn-danger">Usuń</button>
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="news.php?id=<?php echo $table['id'];?>&usun">Usuń</a></li>
                        <li><a href="news.php?id=<?php echo $table['id'];?>&modyfikuj">Modyfikuj</a></li>
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
                    </select>
                  <button type="submit" name="wybierz" class="btn btn-primary">Wyślij</button>
                  </div>
                  </form>
              </div><!-- /.box -->
            </div>
          </div>
            <?php if(isset($_GET['modyfikuj'])) { 
            $row = $db->pobierzWiele($_GET['id'], 'news'); ?>
            <div class="row">
            <div class="col-md-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">CK Editor <small>Advanced and full of features</small></h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-body pad">
                  <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                      <label>Temat:</label>
                      <input type="text" name="title" class="form-control" placeholder="Enter ..." value="<?php echo $row['post_title'];?>">
                    </div>                     
                      <div class="form-group">
                    <label>Kategorie</label>
                    <select class="form-control select2 select2-hidden-accessible" multiple="multiple" data-placeholder="Wybierz jedną lub kilka kategorii" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      <?php while($cat = $db->fetch_array($odp2)) { 
                        echo "<option>".$cat['title']."</option>"; }?>
                    </select>
                  </div>
                    <textarea id="editor1" name="editor1" rows="10" cols="80">
                                            <?php echo $row['post_content'];?>
                    </textarea>
                 
                </div>
                    <div class="box-footer" style="display: block;">
                    <button type="submit" name="modyfikuj" class="btn btn-primary">Zmodyfikuj</button>
                    </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col-->
          </div><!-- ./row -->
            <?php } ?>
                    </section><!-- /.content -->
<?php
include_once('include/footer.php');
?>