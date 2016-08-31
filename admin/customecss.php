<?php
include_once('include/header.php');
$odp = $comm->daneZpliku('../assets/css/custom.css');
$odp2 = $comm->daneZpliku('dist/css/customadmin.css');
if(isset($_POST['write'])){
$comm->zapiszPlik($_POST['write'], '../assets/css/custom.css');   
}
if(isset($_POST['write2'])){
$comm->zapiszPlik($_POST['write2'], 'dist/css/customadmin.css');   
}
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Modyfikacja zaawansowana wyglądu
            <small>Zmodyfikuj wygląd za pomacą pliku css</small>
          </h1>
 <?php $comm->nazwaStrony(basename(__FILE__, ".php")); ?>
        </section>

        <!-- Main content -->
        <section class="content">
                        <?php if(isset($_POST['write']) || isset($_POST['write2'])){ ?>
            <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Zapisano!</h4>
                    Zapisano zmaiany w pliku!
                  </div>
                        <form action="customecss.php">
            <button type="submit" class="btn btn-primary">Wróć</button>
            </form>
            <?php }if(!isset($_POST['write']) && !isset($_POST['write2'])) {?>
            <div class="callout callout-info">
            <h4>Informacja!</h4>
            <p>Wprowadzony kod css w poniższych plikach nadpisuje obecny w stylach css na stronie i w panelu admin. Jeśli coś pójdzie nie tak skasuj wprowadzoną regułę lub właściwość lub wyczyść całą zawartość pliku poniżej.</p>
          </div>
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Modyfikacja strony głównej</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
                        <form action="customecss.php" method="post">
            <div class="box-body" style="display: block;">
              <div class="form-group">
                      <label>custom.css</label>
                      <textarea class="form-control" name="write" style="height: 300px;" rows="3" placeholder="Enter ..."><?php echo $odp;?></textarea>
                    </div>
            </div><!-- /.box-body -->
            <div class="box-footer" style="display: block;">
                    <button type="submit" class="btn btn-primary">Zmodyfikuj</button>
            </div><!-- /.box-footer-->
          </form>
        </div>
                    <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Modyfikacja strony administratora</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div> 
            <form action="customecss.php" method="post">
            <div class="box-body" style="display: block;">
              <div class="form-group">
                      <label>customadmin.css</label>
                      <textarea class="form-control" name="write2" style="height: 300px;" rows="3" placeholder="Enter ..."><?php echo $odp2;?></textarea>
                    </div>
            </div><!-- /.box-body -->
            <div class="box-footer" style="display: block;">
                    <button type="submit" class="btn btn-primary">Zmodyfikuj</button>
            </div><!-- /.box-footer-->
                </form>
        </div>
            <?php } ?>
        </section><!-- /.content -->
<?php
include_once('include/footer.php');
?>