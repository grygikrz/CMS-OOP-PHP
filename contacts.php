<?php 
include_once('header.php');

$question = ['Ile jest 4+5 ?','Ile jest 4+7 ?','Ile jest 3+5 ?','Ile jest 6+5 ?','Ile jest 2+5 ?'];
$numquest = rand(0, count($question)-1);
$quest = $question[$numquest];
new email($db);

if(isset($_POST['form-submit'])){

$email[] = $_POST['name'];
$email[] = $_POST['subject']; 
$email[] = $_POST['email']; 
$email[] = $_POST['message'];
$email[] = '';    

    (int)$_POST['human'];
    
    if(is_numeric($_POST['human'])){
    
    $ques = $content->veryfication($_POST['human'], $_POST['human-back-quest']);       
    
    if ($ques) { 
        /* $comm->sendMail($_POST['email'],$_POST['subject'],$_POST['message']); */
        email::addMessage($email);
?>

 <div class="alert alert-success">
  <strong>Wysłano!</strong> Pomyślnie wysłano wiadomość.
</div>   
    
 <?php }else{ ?> 

<div class="alert alert-danger">
  <strong>Błąd!</strong> Podałeś zły wynik weryfikacji.
</div>

<?php } }else{ ?>

<div class="alert alert-danger">
  <strong>Błąd!</strong> Podałeś błędne dane.
    </div>

<?php } }?>

    <div class=" bd-stretchtobottom-2 bd-stretch-to-bottom" data-control-selector=".bd-content-12">
        <div class=" bd-content-12">
            <div class="bd-container-inner">
                <div class=" bd-htmlcontent-9" data-page-id="page.13">
                    <section class=" bd-section-6 bd-tagstyles" id="section4" data-section-title="Map Two Thirds">
                        <div class="bd-section-inner">
                            <div class="bd-section-align-wrapper">
                                <div class=" bd-layoutcontainer-5">
                                    <div class="bd-container-inner">
                                        <div class="container-fluid">
                                            <div class="row bd-row-flex bd-row-align-middle">
                                                <div class=" bd-layoutcolumn-col-7 col-sm-16">
                                                    <div class="bd-layoutcolumn-7">
                                                        <div class="bd-vertical-align-wrapper">
                                                            <div class="bd-imagestyles bd-googlemap-2 ">
                                                                <div class="embed-responsive" style="height: 100%; width: 100%;">
                                                                    <iframe class="embed-responsive-item" src="//maps.google.com/maps?output=embed&amp;q=Saint Louis, MO&amp;z=16&amp;t=m&amp;hl=English"></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class=" bd-layoutcolumn-col-11 col-sm-8">
                                                    <div class="bd-layoutcolumn-11">
                                                        <div class="bd-vertical-align-wrapper">
                                                            <h1 class=" bd-textblock-7 bd-content-element">Contacts</h1>

                                                            <p class=" bd-textblock-9 bd-content-element">
                                                                2081 Blane Street
                                                                <br> Saint Louis, MO 63108
                                                                <br>
                                                                <br> P: +1 (123) 456 - 7890
                                                                <br> E: contact@themler.com
                                                                <br>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            <section class=" bd-section-6 bd-tagstyles" id="section5">
                <form method="post" action="contacts.php">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="name" class="h4">Imie/Nazwisko</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Wprowadź imie lub nazwisko" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="email"  class="h4">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Wprowadź adres email" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="subject" class="h4">Temat</label>
                    <input type="text" name="subject" class="form-control" id="subject" placeholder="Wprowadź temat" required>
                </div>
            </div>
            <div class="form-group">
                <label for="message" class="h4">Wiadomość</label>
                <textarea id="message" name="message" class="form-control" rows="5" placeholder="Wprowadź wiadomość" required></textarea>
            </div>
            <div class="form-group">
                <label for="human" class="col-sm-2 control-label"><?php echo $quest ?></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="human" name="human" placeholder="Twoja odpowidź" required>
                    <input type="text" class="form-control hidden" value="<?php echo $quest ?>" id="human-back-quest" name="human-back-quest" placeholder="Twoja odpowidź">
                </div>
            </div>
            <button type="submit" name="form-submit" id="form-submit" class="btn btn-danger btn-lg pull-right ">Wyślij</button>
                </form>
            </section>
        </div>
    </div>
</div>
<?php 
include_once('footer.php')
?>