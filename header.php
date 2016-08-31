<?php
session_start();
require_once('config.php');

$content = new content($db);
$dane = $content->pobierzContent('categories');
?>
<!DOCTYPE html>
<html dir="ltr">
<head>
    
	<script>
    var themeHasJQuery = !!window.jQuery;
</script>
<script type="text/javascript" src="./assets/js/jquery.js"></script>
<script>
    window._$ = jQuery.noConflict(themeHasJQuery);
</script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./assets/css/bootstrap.min.css" media="screen" />
<script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
<link class="" href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,regular,italic,600,600italic,700,700italic,800,800italic&subset=latin' rel='stylesheet' type='text/css'>
<script src="./assets/js/CloudZoom.js"></script>
	
    <title>Home Page</title>
	<link rel="stylesheet" href="./assets/css/style.min.css">
	<script src="./assets/js/script.js"></script>
    <meta charset="utf-8">

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="./assets/css/style.ie.min.css">
    <script src="./assets/js/script.ie.js"></script>
    <![endif]-->
    
    
 <meta name="keywords" content="HTML, CSS, JavaScript">

    
 <style>a {
  transition: color 250ms linear;
}
</style>
</head>
<body class=" bootstrap bd-body-1 bd-pagebackground">
    
<header class=" bd-headerarea-1">
<?php 
    if ($user->authenticated)
    { ?>
    <nav role="navigation" class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="">Start</a></li>
                <li><a href="admin/panel.php">Panel</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
    <?php }?>
        <section class=" bd-section-4 bd-page-width bd-tagstyles" id="section4" data-section-title="">
    <div class="bd-section-inner">
        <div class="bd-section-align-wrapper">
            <div class=" bd-layoutbox-3 bd-background-width clearfix"  style="background-color:<?php echo $db->pobierzDane('config', 'option_name', '\'background_header_color\'', 'option_value'); ?>">
    <div class="bd-container-inner">
        
        <a class=" bd-logo-2" href="">
    <img class=" bd-imagestyles" src="<?php echo $db->pobierzDane('config', 'option_name', '\'logo_url\'', 'option_value'); ?>" alt="">
</a>
	
		
    
    <nav class=" bd-hmenu-1" data-responsive-menu="true" data-responsive-levels="">
        
            <div class=" bd-responsivemenu-11 collapse-button">
    <div class="bd-container-inner">
        <div class=" bd-menuitem-4">
            <a  data-toggle="collapse"
                data-target=".bd-hmenu-1 .collapse-button + .navbar-collapse"
                href="#" onclick="return false;">
                    <span>Menu</span>
            </a>
        </div>
    </div>
</div>
            <div class="navbar-collapse collapse">
            
            <div class=" bd-horizontalmenu-2 clearfix">
                <div class="bd-container-inner">
                    
                    <ul class=" bd-menu-3 nav nav-pills navbar-left">
                        
                        
                        
                        
                            
                            <li class=" bd-menuitem-6 
 bd-submenu-icon-only">
                                <a 
 class="active" title="Home Page" href="./index.php" >Strona Główna</a>
                                

                            </li>
                            
                            <li class=" bd-menuitem-6 ">
                                <a  title="About" href="./categories.php?page=1" >Kategorie</a>
                                <div class="bd-menu-4-popup">
                                    <ul class=" bd-menu-4">
                                        
                                        <?php 
                                            while ($row = $db->fetch_assoc($dane)){
                                            $id = $row['id'];
                                            $title = $row['title'];
    
                                        echo "<li class=\" bd-menuitem-7\">
                                            <a  title=\"Sub Page {$id}\" href=\"categories.php?page=1&cat={$id}\">{$title}</a></li>";
    
                                        }?>
                                        
                                    </ul>
                                </div>                                
                                    
                            
                            
                            </li>
                            
                            <li class=" bd-menuitem-6 ">
                                <a  title="Contacts" href="./contacts.php" >Kontakt</a>
                                
                                    
                            
                            
                            </li>
                        
                             <li class=" bd-menuitem-6 ">
                                <a  title="New Page" href="./aboutus.php" >O nas</a>
                                
                                    
                            
                            
                            </li>
                    </ul>
                    
                </div>
            </div>
            
        
            </div>
    </nav>
		<form id=tmp class=" bd-search-8 form-inline" action="search.php" method="post" name="searchform" xmlns="http://www.w3.org/1999/html">
    <div class="bd-container-inner">
        <div class="bd-search-wrapper">
            
                <input type="text" class=" bd-bootstrapinput-7 form-control input-sm" placeholder="Search" name="search">
                <a name="submit" onclick='document.getElementById("tmp").submit();' type="submit" class=" bd-icon-24" link-disable="true"></a>
        </div>
    </div>
</form>
    </div>
</div>
        </div>
    </div>
</section>
</header>