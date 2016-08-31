<?php
include_once('include/header.php');
new email($db);


if(isset($_POST['form-submit']) || isset($_POST['draft'])){

$_POST['name'] = "Admin";
$email[] = $_POST['name'];
$email[] = $_POST['subject']; 
$email[] = $_POST['email']; 
$email[] = $_POST['message'];

if(isset($_POST['draft'])){
  $email[] = "draft";    }else{
    $email[] = "sent";    }
    
email::addMessage($email);
    
}
if(isset($_POST['cancel'])){
    echo "<meta http-equiv='refresh' content='0; URL=mailbox.php'/>";
}
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Stwórz maila
            <small>Wyślijnowego maila</small>
          </h1>
 <?php $comm->nazwaStrony(basename(__FILE__, ".php")); ?>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <a href="mailbox.php" class="btn btn-primary btn-block margin-bottom">Wróć do skrz. odb.</a>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Foldery</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><i class="fa fa-inbox"></i> Odbiorcza <span class="label label-primary pull-right"><?php echo $comm->countStatistic('messages', 'WHERE type=""') ?></span></a></li>
                    <li><a href="mailbox-sent.php"><i class="fa fa-envelope-o"></i> Wysłane<span class="label label-primary pull-right"><?php echo $comm->countStatistic('messages', 'WHERE type="sent"') ?></span></a></li>
                    <li><a href="mailbox-draft.php"><i class="fa fa-file-text-o"></i> Robocze<span class="label label-primary pull-right"><?php echo $comm->countStatistic('messages', 'WHERE type="draft"') ?></span></a></li>
                    <li><a href="mailbox-spam.php"><i class="fa fa-filter"></i> Spam <span class="label label-primary pull-right"><?php echo $comm->countStatistic('messages', 'WHERE type="junk"') ?></span></a></li>
                    <li><a href="mailbox-delete.php"><i class="fa fa-trash-o"></i> Kosz<span class="label label-primary pull-right"><?php echo $comm->countStatistic('messages', 'WHERE type="trash"') ?></span></a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Etykiety</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
                <form action="" method="post" >
                <div class="box-header with-border">
                  <h3 class="box-title">Stwórz nową wiadomość</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <input class="form-control" name="email" placeholder="Do:">
                  </div>
                  <div class="form-group">
                    <input class="form-control" name="subject" placeholder="Temat:">
                  </div>
                  <div class="form-group">
                    <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px">
                      <h1><u>Heading Of Message</u></h1>
                      <h4>Subheading</h4>
                      <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee</p>
                      <ul>
                        <li>List item one</li>
                        <li>List item two</li>
                        <li>List item three</li>
                        <li>List item four</li>
                      </ul>
                      <p>Thank you,</p>
                      <p>John Doe</p>
                    </textarea>
                  </div>
                  <div class="form-group">
                    <div class="btn btn-default btn-file">
                      <i class="fa fa-paperclip"></i> Załącznik
                      <input type="file" name="attachment">
                    </div>
                    <p class="help-block">Max. 32MB</p>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="pull-right">
                    <button name ="draft" class="btn btn-default"><i class="fa fa-pencil"></i> Robocze</button>
                    <button type="submit" name="form-submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Wyślij</button>
                  </div>
                  <button name="cancel" class="btn btn-default"><i class="fa fa-times"></i> Anuluj</button>
                </div><!-- /.box-footer -->
             </form>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
<?php
include_once('include/footer.php');
?>