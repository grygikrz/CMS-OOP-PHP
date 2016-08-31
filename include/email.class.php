<?php
class email {

 private static $instance;
    
    function __construct($db){
        self::$instance = $db;
    }
    
    public static function addMessage($array){
        
        $array = self::$instance->real_escape_string($array);
        $shortmess = substr($array[3], 0,200);
        $dodaj = "INSERT INTO messages (id, subject, short_message, message, adress, author, type) VALUES ('','$array[1]','$shortmess','$array[3]','$array[2]','$array[0]','$array[4]')";
        self::$instance->zapytanie($dodaj);
        
    }
}

?>