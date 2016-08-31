<?php

class sql {
	
    var $polacz; // musimy stworzyc zmienna

	public function polaczenie($host, $user, $pass, $dbase){

		$this->polacz = mysqli_connect($host, $user, $pass);

        
		if (mysqli_connect_errno()){
			echo "Błąd połączenia! Sprawdź ustawienia....";
		}
	
            	if (!$this->polacz)
            		{
            		return false;
                    }elseif (!mysqli_select_db($this->polacz,$dbase))
		{
			return false;
            		}else{
            		  return $this->polacz;
            		}
		
	}
    
	public function zapytanie($zapytanie, $suppress_errors = false){

       $zapytanie = mysqli_query($this->polacz,$zapytanie); // musi byc $this->polacz bo wymaga tego funkcja zapytania do bazy
       
       if (!$zapytanie)
		{
			if (!$suppress_errors) echo "SQL query failed: ".mysqli_error($this->polacz);
			return false;
		}
		else
		{
			return $zapytanie;
		}
	}
	    
        function fetch_array($zapytanie)
    {
        $zapytanie = mysqli_fetch_array($zapytanie);
        
            return $zapytanie;
    }
        
    
    
        function fetch_assoc($zapytanie)
    {
        $zapytanie = mysqli_fetch_assoc($zapytanie);
        
            return $zapytanie;
    }
        
    
        function real_escape_string($array)
    {
            foreach ( $array as $k=>$v ) {
            $array[mysqli_real_escape_string( $this->polacz, $k )] = mysqli_real_escape_string( $this->polacz, $v );}
            return $array;
    }
    
    
        function one_real_escape_string($val)
    {
            
        $val = mysqli_real_escape_string( $this->polacz, $val );
        return $val;
    }
    
        function num_rows($zapytanie){
        
        $zapytanie = mysqli_num_rows($zapytanie);
        return $zapytanie;
    }
        
    
        function pobierzDane($table, $row, $key, $column){
        
        $pytanie = "SELECT * FROM $table WHERE $row = '$key'";
        $odp = $this->zapytanie($pytanie);
        $dane = $this->fetch_array($odp);
        
            return $dane[$column];
    }
        
        
        function pobierzWiele($id,$table){
            
        $zapytanie = "SELECT * FROM $table WHERE id = $id ";                
        $odp = $this->zapytanie($zapytanie);        
        $zapytanie = $this->fetch_assoc($odp);
            
        if(!$zapytanie){
			echo "SQL query failed: ".mysqli_error($this->polacz);
			return false;
        }
        else
        {
            return $zapytanie;
        }
    }
    
        function usunWiersz($table, $row, $key){
        
            if (is_array($key)){
                foreach($key as $k){
                    $zapytanie = "DELETE FROM $table WHERE $row = $k";
                    $this->zapytanie($zapytanie); 
                    }
                }else{
            $zapytanie = "DELETE FROM $table WHERE $row = $key";
            $this->zapytanie($zapytanie); 
            }
        }
    
    
        function aktualizujWiersz($table, $row, $key, $updtbl, $updval){
            if (is_array($key)){
                foreach($key as $k){
                    $zapytanie = "UPDATE $table SET $updtbl = $updval WHERE $row = $k";
                    $this->zapytanie($zapytanie); 
                    }
                }else{
        $zapytanie = "UPDATE $table SET $updtbl = $updval WHERE $row = $key";
        $this->zapytanie($zapytanie);
            }
        }
    
    
        function aktualizujWiele ($values, $table, $column, $updcolumn) {
        
        foreach($values[0] as $value => $v) {
            
            if($value != 0 || $value != 'zapisz') {
                $zapytanie = "UPDATE $table SET $column = '$v' WHERE $updcolumn = '$value'";
                $this->zapytanie($zapytanie);
                }        

            }
        }
}