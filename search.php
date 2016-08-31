<?php 
include_once('header.php');
$dane = $content->szukajContent($_POST['search'], 'post_content');
$ile = $db->num_rows($dane);
?>
		<div class=" bd-stretchtobottom-2 bd-stretch-to-bottom" data-control-selector=".bd-content-12"><div class=" bd-content-12">
    <div class="bd-container-inner">
        
            <div class=" bd-htmlcontent-4" 
 data-page-id="page.11">
    <div class=" bd-breadcrumbs-9">
    <div class="bd-container-inner">
        <ol class="breadcrumb">
            
                

                
                
                    
                    <li><div class=" bd-breadcrumbslink-9"><a href="../home.html" title="Home Page">Strona Główna</a></div></li>
            <li class="active"><span class=" bd-breadcrumbstext-9"><span>Szukaj</span></span></li>
        </ol>
    </div>
</div>
    <?php  if($ile != 0 && !empty($_POST['search'])){ ?>
    <h1>Znaleziono <?php echo $ile." dopasowania dla: ".$_POST['search'];?></h1>
   <?php while($szukaj = $db->fetch_array($dane)) { ?>   
	
		<div class=" bd-pagetitle-5">
    <div class="bd-container-inner">
        <h2><?php echo $szukaj['post_title']; ?></h2>
    </div>
</div>
	
		<div class="bd-separator-8  bd-separator-center bd-separator-content-center clearfix">
    <div class="bd-container-inner">
        <div class="bd-separator-inner">
            
        </div>
    </div>
</div>
	
		<p class=" bd-textblock-16 bd-content-element">
<?php echo substr($szukaj['post_content'], 0,400)."..."; ?>
</p> <?php }}elseif( $ile == 0 && !empty($_POST['search'])) { ?>
    
    <h1></h1>
		<div class=" bd-pagetitle-5">
    <div class="bd-container-inner">
        <h2>Nic nie znaleziono.</h2>
    </div>
</div>
	
		<div class="bd-separator-8  bd-separator-center bd-separator-content-center clearfix">
    <div class="bd-container-inner">
        <div class="bd-separator-inner">
            
        </div>
    </div>
</div>
	
		<p class=" bd-textblock-16 bd-content-element">Podaj inne dane...</p>
    
    
<?php }elseif(empty($_POST['search'])){ ?>
                
         <h1></h1>
		<div class=" bd-pagetitle-5">
    <div class="bd-container-inner">
        <h2>Wyszukaj coś...</h2>
    </div>
</div>
	
		<div class="bd-separator-8  bd-separator-center bd-separator-content-center clearfix">
    <div class="bd-container-inner">
        <div class="bd-separator-inner">
            
        </div>
    </div>
</div>
	
		<p class=" bd-textblock-16 bd-content-element"></p>       
                <?php }?>
</div>
    </div>
</div></div>
	
<?php 
include_once('footer.php')
?>