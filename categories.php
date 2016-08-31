<?php 
include_once('header.php');
    $catnext = '';        
if(isset($_GET['cat'])) { 
    $cat = $_GET['cat']; 
    $catnext = "&cat=".$_GET['cat'];
    $catname = $db->pobierzWiele($_GET['cat'], 'categories');
}else{ 
    $cat = ''; }    
                
if(isset($_GET['page']) || isset($_GET['cat']) && is_int($_GET['cat'])) {  
                  
    $dane = $content->pobierzContent('news');            
    $count_post = $db->num_rows($dane);
    $post_per_page = 4;
    $page = $_GET['page']-1;

    $count_per_page = ceil($count_post/$post_per_page);
    $start = $count_per_page * $page;

    $dane2 = $content->pagination($start, $count_per_page, $cat);
?>
    <div class=" bd-stretchtobottom-2 bd-stretch-to-bottom" data-control-selector=".bd-content-12">
        <div class=" bd-content-12">
            <div class="bd-container-inner">

                <div class=" bd-htmlcontent-4" data-page-id="page.11">

                    <?php echo $content->breadCrumbsPage(basename(__FILE__, ".php"),'Kategorie'); ?>

                        <div class="bd-container-17 bd-tagstyles">
                            <?php $categoryname = (!isset($_GET['cat'])) ? "<h2>Aktualności z wszystkich kategorii</h2>" : "<h2>Aktualności z kategorii ".$catname['title']."</h2>"; 
         
         echo $categoryname; ?>
                        </div>

                        <?php           
      while ($row = mysqli_fetch_object($dane2)){ ?>

                            <div class="bd-grid-5">
                                <div class="separated-grid row">



                                    <div class="">
                                        <div class="bd-griditem-34">
                                            <article class="bd-article-3">
                                                <div class="bd-container-inner">
                                                    <h2 class="bd-postheader-3">
                            
                                                        <a href="post.php?postId=<?php echo $row->id; ?>">
                               <?php echo  $row->post_title; ?>
                            </a>
                                                    </h2>

                                                    <div class="bd-layoutbox-8 clearfix">
                                                        <div class="bd-container-inner">
                                                            <div class="bd-posticondate-4">
                                                                <span class="bd-icon-39"><?php echo substr($row->post_date, 0, 10); ?></span>
                                                            </div>

                                                            <div class="bd-posticonauthor-5">
                                                                <a class="bd-icon-41"><?php echo $row->post_author; ?></a>
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
                                                                        <?php echo $row->post_short_content; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="bd-layoutbox-12 clearfix">
                                                        <div class="bd-container-inner">
                                                            <div class="bd-posticontags-8">
                                                                <span class="bd-icon-45"></span>
                                                                <span>Tagi: <?php echo  $row->post_tags; ?></span>
                                                            </div>

                                                            <div class="bd-posticoncategory-7">
                                                                <span class="bd-icon-44"></span>
                                                                <span>Kategoria: 
                        
                    <?php if(!$row->category_id){echo "brak kategorii";}else{
                          $cat = unserialize($row->category_id);
                          foreach ($cat as $c):
                                 $category = $db->pobierzWiele($c, 'categories');
                                 echo $category['title'].', ';
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


                            <?php }  
         if(isset($_GET['cat'])) {        
        $dane = $content->szukajContent(serialize($cat), 'category_id');
        $count_post = $db->num_rows($dane);
        $count_per_page = ceil($count_post/$post_per_page);   }    ?>
                    
                                <div class=" bd-blogpagination-1 pagination">
                                    <ul class=" bd-pagination-12 pagination">
                                        <?php if( $_GET['page'] < 2 ){$disabled = "disabled"; $href="";} else { $disabled = ""; $href="categories.php?page=".($_GET['page']-1).$catnext; }?>
                                            <li class=" bd-paginationitem-12 <?php echo $disabled; ?>"><a href="<?php echo $href; ?>">Prev</a></li>
                                            
                                        <?php  for ($i=1; $i<$count_per_page; $i++){ 
                                            if($_GET['page'] == $i) { $active = "active"; }else{ $active = "";  } ?>
                                        
                                                <li class=" bd-paginationitem-12 <?php echo $active; ?>">
                                                    <a href="categories.php?page=<?php echo $i.$catnext; ?>">
                                                        <?php echo $i; ?>
                                                    </a>
                                                </li>
                                        
                                                <?php } $count = $count_per_page-1; if($count == $_GET['page'] || $count_per_page < 4){$disabled2 = "disabled"; $href="";} else { $disabled2 = ""; $href="categories.php?page=".($_GET['page']+1).$catnext;} ?>
                                        
                                                    <li class=" bd-paginationitem-12 <?php echo $disabled2; ?>"><a href="<?php echo $href; ?>">Next</a></li>
                                    </ul>
                                </div>
                                <?php }else{ echo "Brak aktualności"; } ?>
                </div>
            </div>
        </div>
    </div>

    <?php 
include_once('footer.php')
?>