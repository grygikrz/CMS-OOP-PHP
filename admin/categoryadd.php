<?php
include_once('include/header.php');
if(isset($_POST['dodaj'])){
$comm->dodajKategorie($_POST['nazwaKat'],$_POST['opisKat']);
echo "<meta http-equiv='refresh' content='1'>";
}
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dodaj kategorię
            <small>Dodaj nową kategorię do aktualności</small>
          </h1>
 <?php $comm->nazwaStrony(basename(__FILE__, ".php")); ?>
        </section>

        <!-- Main content -->
        <section class="content">
                            <?php if(isset($_POST['dodaj'])) {?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Dodano!</h4>
                    Dodano kategorie.
                </div>
                <?php } ?>
                     <div class="box-header with-border">
              <h3 class="box-title">Dodaj nową kategorie</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <form action="categoryadd.php" method="post">
                              <div class="form-group">
                      <label>Nazwa kategorii</label>
                      <input type="text" name="nazwaKat" class="form-control" placeholder="Wprowadź dane...">
                    </div>
                <div class="form-group">
                      <label>Opis</label>
                      <textarea class="form-control" name="opisKat" rows="3" placeholder="Wprowadz dane..."></textarea>
                </div>

            </div><!-- /.box-body -->
            <div class="box-footer">
                              <div class="box-footer">
                    <button type="submit" name="dodaj" class="btn btn-primary">Dodaj</button>
                                   
                </div>
            </div><!-- /.box-footer-->
              </form>           
                    </div>                   <!-- Tutaj treść -->
            
        </section><!-- /.content -->
<?php
include_once('include/footer.php');
?>