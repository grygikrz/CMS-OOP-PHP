<?php
include_once('include/header.php');
if(isset($_POST['zapisz'])) {
    $values[] = $_POST;
    $db->aktualizujWiele($values, 'config', 'option_value', 'option_name');
    if(!empty($_FILES['plikDoWgrania']['tmp_name'])) {
        $p = new content($db);
    $fileUrl = $p->dodajPlikObrazka($_FILES['plikDoWgrania']['name'], $_FILES['plikDoWgrania']['tmp_name']);
    $db->aktualizujWiersz('config', 'option_name', "'background_url'", 'option_value', "'$fileUrl'");
    }
    if(!empty($_FILES['logo']['tmp_name'])) {
    $p = new content($db);
    $fileUrl = $p->dodajPlikObrazka($_FILES['logo']['name'], $_FILES['logo']['tmp_name']);
    $db->aktualizujWiersz('config', 'option_name', "'logo_url'", 'option_value', "'$fileUrl'");
    }
echo "<meta http-equiv='refresh' content='1'>";
}
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Zmien wygląd strony głównej
            <small>Edytuj kolory strony głównej, zmień logo lub wstaw obrazek w tło</small>
          </h1>
 <?php $comm->nazwaStrony(basename(__FILE__, ".php")); ?>
        </section>

        <!-- Main content -->
        <section class="content">
                            <!-- Tutaj treść -->
          <?php if(isset($_POST['zapisz'])) {?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Zapisano!</h4>
                    Zapisano ustawienia.
                </div>
                <?php } ?>
          <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#tab_1-1" data-toggle="tab">Strona Główna</a></li>
                  <li><a href="#tab_2-2" data-toggle="tab">Boxy</a></li>
                  <li><a href="#tab_3-2" data-toggle="tab">Podstrony</a></li>
                  
                  <li class="pull-left header"><i class="fa fa-th"></i> Custom Tabs</li>
                </ul>
                <div class="tab-content">
                    
                  <div class="tab-pane active" id="tab_1-1">
                      <form action="" method="post" enctype="multipart/form-data"> 
                       <label>Kolor tła</label>
                      <div class="input-group demo2">
                    <input name="background_body_color" type="text" value="<?php echo $db->pobierzDane('config', 'option_name', '\'background_body_color\'', 'option_value'); ?>" class="form-control" />
                    <span class="input-group-addon"><i></i></span>
                    </div>
                    <div class="form-group">
                       <div class="form-group">
                      <label>Url tła obrazka</label>
                      <input name="background_url" type="text" class="form-control" value="<?php echo $db->pobierzDane('config', 'option_name', '\'background_url\'', 'option_value'); ?>">
                    </div>
                      <label for="exampleInputFile">Wgraj obrazek</label>
                      <input type="file" name="plikDoWgrania" id="plikDoWgrania">
                      <p class="help-block">Example block-level help text here.</p>
                    </div>
                    
                      <div class="form-group">
                      <label>Url logo</label>
                      <input name="logo_url" type="text" class="form-control" value="<?php echo $db->pobierzDane('config', 'option_name', '\'logo_url\'', 'option_value'); ?>">
                      <label for="exampleInputFile">File input</label>
                      <input type="file" name="logo" id="exampleInputFile">
                      <p class="help-block">Example block-level help text here.</p>
                    </div>
                      <label>Kolor tła nagłównka</label>
                      <div class="input-group demo2">
                    <input name="background_header_color" type="text" value="<?php echo $db->pobierzDane('config', 'option_name', '\'background_header_color\'', 'option_value'); ?>" class="form-control" />
                    <span class="input-group-addon"><i></i></span>
                    </div>
                   <div class="box-footer">
                    <button type="submit" name="zapisz" class="btn btn-primary">Zapisz</button>
                    </div>
                    </form> 
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2-2">
                      <form action="" method="post" enctype="multipart/form-data"> 
                     <label>Kolor tła</label>
                      <div class="input-group demo2">
                      
                    <input type="text" name="background_color_aboutus" value="<?php echo $db->pobierzDane('config', 'option_name', '\'background_color_aboutus\'', 'option_value'); ?>" class="form-control" />
                    <span class="input-group-addon"><i></i></span>
                     </div> 
                      <label>Kolor czcionki</label>
                    <div class="input-group demo2">    
                       
                    <input type="text" name="font_color_aboutus" value="<?php echo $db->pobierzDane('config', 'option_name', '\'font_color_aboutus\'', 'option_value'); ?>" class="form-control" />
                    <span class="input-group-addon"><i></i></span>
                    </div>
                                             <div class="box-footer">
                    <button type="submit" name="zapisz" class="btn btn-primary">Zapisz</button>
                    </div>
                    </form> 
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3-2">
                      <form action="" method="post" enctype="multipart/form-data"> 
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting,
                    remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                    sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                    like Aldus PageMaker including versions of Lorem Ipsum.
                    <div class="box-footer">
                    <button type="submit" name="zapisz" class="btn btn-primary">Zapisz</button>
                    </div>
                    </form>               
                          </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div>  
                      
        </section><!-- /.content -->
<?php
include_once('include/footer.php');
?>