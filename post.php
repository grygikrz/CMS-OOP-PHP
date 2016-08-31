<?php 
include_once('header.php');
$row = $db->pobierzWiele($_GET['postId'], 'news');
$odp = $content->checkComment($_GET['postId']);

$question = ['Ile jest 4+5 ?','Ile jest 4+7 ?','Ile jest 3+5 ?','Ile jest 6+5 ?','Ile jest 2+5 ?'];
$numquest = rand(0, count($question)-1);
$quest = $question[$numquest];

if(isset($_POST['form-submit'])){ 

    (int)$_POST['human'];
    
    if(is_numeric($_POST['human'])){
    
    $ques = $content->veryfication($_POST['human'], $_POST['human-back-quest']);       
    
    if ($ques) { 
        $content->addComments($_GET['postId'],$_POST['login'],$_POST['comment']);
?>
 <div class="alert alert-success">
  <strong>Wysłano!</strong> Pomyślnie wysłano komentarz. Poczekaj na zatwierdzenie przez administratora.
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


		<div class=" bd-stretchtobottom-2 bd-stretch-to-bottom" data-control-selector=".bd-content-12"><div class=" bd-content-12">
    <div class="bd-container-inner">
        
            <div class=" bd-htmlcontent-4" data-page-id="page.11">
                
<?php echo $content->breadCrumbsPage(basename(__FILE__, ".php"),$row['post_title']); ?>
                
    <?php  if(isset($_GET['postId'])) { ?>
                
    <div class="bd-grid-5">
            <div class="separated-grid row">
                
                    
                        
                        <div class="">
                            <div class="bd-griditem-34">
                                <article class="bd-article-3">
    <div class="bd-container-inner">
        <h2 class="bd-postheader-3">
    <a href="..Blog">
       <?php echo  $row['post_title']; ?>
    </a>
</h2>
	
		<div class="bd-layoutbox-8 clearfix">
    <div class="bd-container-inner">
        <div class="bd-posticondate-4">
    <span class="bd-icon-39"><?php echo  substr($row['post_date'], 0, 10); ?></span>
</div>
	
		<div class="bd-posticonauthor-5">
    <a class="bd-icon-41"><?php echo  $row['post_author']; ?></a>
</div>
	
		<div class="bd-posticonedit-6">
    <span class="bd-icon-43">Edit</span>
</div>
    </div>
</div>
	
		<div class="bd-layoutbox-10 clearfix">
    <div class="bd-container-inner">
        <div class="bd-postcontent-2 bd-tagstyles clearfix">
    
        <div class="bd-htmlcontent-2" data-page-id="post.11">
    <div class="bd-textblock-33 bd-tagstyles">
    <?php echo $row['post_content']; ?>
</div>
</div>
</div>
    </div>
</div>
	
		<div class="bd-layoutbox-12 clearfix">
    <div class="bd-container-inner">
        <div class="bd-posticontags-8">
    <span class="bd-icon-45"></span>
    <span>Tagi: <?php echo  $row['post_tags']; ?></span>
</div>
	
		<div class="bd-posticoncategory-7">
    <span class="bd-icon-44"></span>
    <span>Kategorie: <?php 
                                                if(!$row['category_id']){echo "brak kategorii";}else{
                          $cat = unserialize($row['category_id']);
                          foreach ($cat as $c):
                                 $category = $db->pobierzWiele($c, 'categories');
                                 echo $category['title'].'<br>';
                            endforeach;}?></span>
        </div>
    </div>
</div>
        
    </div>
</article>
                                
                            </div>
                        </div>
            </div>
        </div>
                
                
                
       <?php }else{
                    echo "BRAK POSTU";
                } ?>  
                
          
          <div class="container bootstrap snippet">
    <div class="row">
		    <div class="blog-comment">
				<h3 class="text-success">Komenatrze</h3>
                <hr/>
				<ul class="comments">
              <?php while($table = $db->fetch_array($odp)){ ?>      
				<li class="clearfix">
				  <img src="http://bootdey.com/img/Content/user_1.jpg" class="avatar" alt="">
				  <div class="post-comments">
				      <p class="meta">Dnia: <?php echo $table['data']; ?><a href="#"> <?php echo $table['name']; ?></a> napisał: <i class="pull-right"><a href="#"><small>Odpowiedz</small></a></i></p>
				      <p>
				          <?php echo $table['text']; ?>
				      </p>
				  </div>
				</li>
             <?php } ?>
				<li class="clearfix">
				  <img src="http://bootdey.com/img/Content/user_2.jpg" class="avatar" alt="">
				  <div class="post-comments">
				      <p class="meta">Dec 19, 2014 <a href="#">JohnDoe</a> says : <i class="pull-right"><a href="#"><small>Reply</small></a></i></p>
				      <p>
				          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				          Etiam a sapien odio, sit amet
				      </p>
				  </div>
				
				  <ul class="comments">
				      <li class="clearfix">
				          <img src="http://bootdey.com/img/Content/user_3.jpg" class="avatar" alt="">
				          <div class="post-comments">
				              <p class="meta">Dec 20, 2014 <a href="#">JohnDoe</a> says : <i class="pull-right"><a href="#"><small>Reply</small></a></i></p>
				              <p>
				                  Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				                  Etiam a sapien odio, sit amet
				              </p>
				          </div>
				      </li>
				  </ul>
				</li>
				</ul>
			</div>
	</div>
</div>      

                        <form method="post" action="post.php?postId=<?php echo $_GET['postId'] ?>">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="login" class="h4">Imie</label>
                    <input type="text" name="login" class="form-control" id="subject" placeholder="Wprowadź imie" required>
                </div>
            </div>
            <div class="form-group">
                <label for="comment" class="h4">Komentarz</label>
                <textarea id="comment" name="comment" class="form-control" rows="5" placeholder="Wprowadź komentarz" required></textarea>
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
        </div>
    </div>
</div></div>
<link rel="stylesheet" href="./assets/css/comments.css" media="screen" />		
<?php 
include_once('footer.php')
?>