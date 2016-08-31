<?php
class news {
        
    
    function __construct($db) {
        
        $this->db = $db;
    }
    
    
    function updateNews()
        {
            $pytanie = sprintf(
                "UPDATE news SET 
                post_title='%s', 
                post_content='%s',
                post_short_content='%s'
                WHERE ID=%d",
                $this->post_title,
                $this->post_content,
                $this->post_short_content,
                $this->ID
            );
        $this->db->zapytanie($pytanie);
        }
    
        function addNews()
        {
            $title = $this->db->one_real_escape_string($this->post_title);
            $content = $this->db->one_real_escape_string($this->post_content);
            $short_content = substr($content, 0,400);
            $categorys= serialize($this->post_category);
            $pytanie = sprintf(
                "INSERT INTO news (post_title,post_content,post_short_content,category_id)
                VALUES ('%s', '%s', '%s', '%s')",
                $title,
                $content,
                $short_content,
                $categorys
            );
        $this->db->zapytanie($pytanie);
        }
    }

?>