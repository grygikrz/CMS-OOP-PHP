<?php

class content {
	
    
	function __construct($db){
	   
       $this->dbase = $db;
		
	}
	  
    function pobierzContent($tabela, $add=''){
        
        $zapytanie = "SELECT * FROM $tabela $add";
        $odpowiedz = $this->dbase->zapytanie($zapytanie);
        
        return $odpowiedz;
    }
    
        function ColumnContent($tabela,$column){
        
        $zapytanie = "SELECT $column FROM $tabela";
        $odpowiedz = $this->dbase->zapytanie($zapytanie);
        
        return $odpowiedz;
    }

	function szukajContent($search, $column){
        
        $zapytanie = "SELECT * FROM news WHERE $column LIKE '%$search%'";
        $odpowiedz = $this->dbase->zapytanie($zapytanie);
        
        return $odpowiedz;
    }
    
    function daneZpliku($file) {
        $plik = fopen($file, "r");
        $tresc = fread($plik, filesize($file));
        fclose($plik);
        return $tresc;
        
    }
    function zapiszPlik($dane,$file) {
        $fp = fopen($file, "w");
        fwrite($fp, $dane);
        fclose($fp);
        
    }
    function dodajPlikObrazka($file, $file_tmp) {
    $upldir = '../upload'; 

        if (!file_exists($upldir))
            {   mkdir($upldir, 0777, true); }
                
        move_uploaded_file($file_tmp, "$upldir/$file");
        return "./upload/$file";

    }
    
    function dodajKategorie($val1, $val2="Brak opisu") {
    $array = array($val1, $val2);
    $array = $this->dbase->real_escape_string($array);        
    $zapytanie = "INSERT INTO categories (title, text) VALUES ('$val1','$val2')";
    $odpowiedz = $this->dbase->zapytanie($zapytanie);
            
        }
    function aktualizujKategorie($title,$text,$id){
        $array = array($title,$text);
        $array = $this->dbase->real_escape_string($array);
        $zapytanie = "UPDATE categories SET title='$array[0]', text='$array[1]' WHERE id = '$id'";
        $this->dbase->zapytanie($zapytanie);
    }
    
    function sendMail($adress, $subject, $message) {
     $headers = 'From: postmaster@localhost' . "\r\n" .
    'Reply-To: postmaster@localhost' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();   
     mail($adress, $subject, $message, $headers);
    }

function nazwaStrony($strona) {
    
    switch ($strona) {
            
            case "comments":
           $strona = "Komentarze";
            break;
            case "news":
           $strona = "Aktualności";
            break; 
            case "categories":
           $strona = "Kategorie";
            break; 
            case "users":
           $strona = "Użytkownicy";
            break;
           case "addnews":
           $strona = "Dodaj Aktualność";
            break;
           case "calendar":
           $strona = "Kalendarz";
            break; 
           case "categoryadd":
           $strona = "Dodaj Kategorie";
            break; 
           case "customecss":
           $strona = "Wygląd Zaawansowany";
            break; 
           case "editview":
           $strona = "Wygląd podstawowy";
            break; 
           case "panel":
           $strona = "<<<";
            break; 
            case "mailbox":
           $strona = "Skrzynka Wiadomości";
            break; 
           case "usersadd":
           $strona = "Dodaj Użytkownika";
            break; 
           case "configuration":
           $strona = "Konfiguracja";
            break;
        default:
            $strona = "Tutaj";
    }
    
    return <<<END
    
<ol class="breadcrumb">
    <li><a href="./"><i class="fa fa-dashboard"></i>Panel Administracyjny</a></li>
    <li class="active"><a href="">$strona</a></li>
</ol>
    
END;
    
    }
    
    
    function breadCrumbsPage($strona, $post_title) {
        
        switch($strona){
                
                case "post":
                $link = '<li><div class=" bd-breadcrumbslink-9"><a href="categories.php" title="Kategorie">Kategorie</a></div></li>';
                $strona = $post_title;
                break;
                default:
                $link = '';
                $strona = $post_title;  
        }
        
        return <<<END
<div class=" bd-breadcrumbs-9">
    <div class="bd-container-inner">
        <ol class="breadcrumb">

            <li>
                <div class=" bd-breadcrumbslink-9"><a href="index.php" title="Home Page">Strona Główna</a></div>
            </li>
            $link
            <li class="active"><span class=" bd-breadcrumbstext-9"><span>$strona</span></span>
            </li>
        </ol>
    </div>
</div>   
END;
    }

    function pagination ($start, $count_per_page, $cat="") {
        
        if(!empty($cat)) { $cat = "WHERE category_id LIKE '%".serialize($cat)."%'"; }
        $qestion = "SELECT * FROM news $cat LIMIT $start, $count_per_page";
        $answ = $this->dbase->zapytanie($qestion);
        return $answ;
        
    } 
    
    function veryfication($ver, $backVer){
        
        
        switch($backVer) {

                case "Ile jest 4+5 ?":
                    $ques = ($ver == 9) ? true : false;
                    break;
                case "Ile jest 4+7 ?":
                    $ques = ($ver == 11) ? true : false;
                    break;
                case "Ile jest 3+5 ?":
                    $ques = ($ver == 8) ? true : false;
                    break;
                case "Ile jest 6+5 ?":
                    $ques = ($ver == 11) ? true : false;
                    break;
                case "Ile jest 2+5 ?":
                    $ques = ($ver == 7) ? true : false;
                    break;    
            }
        
        return $ques;
    }
    
        public function countStatistic($table, $where=''){
        $info = $this->dbase->zapytanie("SELECT * FROM $table $where");
        $licz = mysqli_num_rows($info);
        return $licz;
    }
    
    function addComments($val1,$val2,$val3){
        $zap = $this->dbase->zapytanie("INSERT INTO comments (id_post, name, text) VALUES ('$val1','$val2','$val3')");
    }
    function checkComment ($post_id){
        
        $zap = "SELECT c.name, c.text, c.data FROM comments c, messages m WHERE allow='1' AND m.id = '$post_id' AND m.id = c.id";
        $odpowiedz = $this->dbase->zapytanie($zap);
        return $odpowiedz;
    }
}