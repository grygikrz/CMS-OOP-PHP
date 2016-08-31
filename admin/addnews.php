<?php
include_once('include/header.php');

$odp2 = $comm->pobierzContent('categories');

if(isset($_POST['dodaj'])) {

    $a = new news($db);
	
	$a->post_title = $_POST['title'];
    $a->post_short_content = substr($_POST['editor1'], 0,400);
	$a->post_content = $_POST['editor1'];
    $a->post_category = $_POST['category'];
    $a->addNews();
}
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dodaj Wpis do Aktualności 
            <small>Możesz dodadać nowy wpis do aktualności</small>
          </h1>
 <?php $comm->nazwaStrony(basename(__FILE__, ".php")); ?>
        </section>

        <!-- Main content -->
                <section class="content">
                <?php if(isset($_POST['dodaj'])) {?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Zapisano!</h4>
                    Zapisano ustawienia.
                </div>
                <?php } ?>
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
                      <input name="title" type="text" class="form-control" placeholder="Enter ...">
                    </div>                     
                      <div class="form-group">
                    <label>Kategorie</label>
                    <select class="form-control select2 select2-hidden-accessible" multiple="multiple" data-placeholder="Wybierz jedną lub kilka kategorii" name="category[]" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      <?php while($cat = $db->fetch_array($odp2)) { 
                        echo "<option value=".$cat['id'].">".$cat['title']."</option>"; }?>
                    </select>
                  </div>
                    <textarea id="editor1" name="editor1" rows="10" cols="80">
                                            Tutaj wprowadź tekst nowej wiadomości.
                    </textarea>
                 
                </div>
                    <div class="box-footer" style="display: block;">
                    <button type="submit" name="dodaj" class="btn btn-primary">Dodaj</button>
                    </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col-->
          </div><!-- ./row -->
        </section><!-- /.content -->
              


<?php
include_once('include/footer.php');
?>