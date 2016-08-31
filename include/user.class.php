<?php

class user
{

    public $authenticated;


    function __construct($db)
        // Musimy wywołać konstruktor (auto wywołanie) by zainicjować połączenie/dostęp do bazy w klasie
    {
        $this->dbase = $db; // Używamy $this->dbase po to by móc to przekazać dalej do innej funkcji w tej klasie
        
        if (isset($_SESSION['user_id'])) {
            $this->authenticate($_SESSION['user_id']);
        }
    }

    public function logowanie($login, $password)
    {

        $password = md5($password);
        $zapytanie = sprintf("SELECT * FROM users WHERE username='%s'", $login);

        $zap = $this->dbase->zapytanie($zapytanie);
        $odp = $this->dbase->fetch_array($zap);


        if ($odp['password'] == $password) {

            $this->authenticate($odp['id']); // jeśli password się zgadza wepchnij to do funkcji authentykacja z Id zapytania.

            return true;

        } else {

            return false;

        }
    }

    // Set user as authenticated
    function authenticate($id)
    {
        $sql = sprintf("SELECT * FROM users 
		WHERE id=%d", $id);

        $zap = $this->dbase->zapytanie($sql);
        $odp = $this->dbase->fetch_array($zap);

        session_regenerate_id();
        $_SESSION['user_id'] = $id;
        $this->user_id = $id;
        $this->authenticated = true;
        $this->username = $odp['username'];
    }
    
    function unathenticate($id)
    {
        $this->authenticated = false;
        unset($_SESSION['user_id']);
		unset($this->user_id);
		unset($this->username);
    }
    
    function checkIfExist($email) {
        
        $odp = $this->dbase->pobierzDane('users', 'username', $email, 'id');
        if (empty($odp)) {return false;}else{return $odp;}
    }
    
    function addUser($email, $password, $name, $surname)
    {
        $array = array($email, $password, $name, $surname);
        $array = $this->dbase->real_escape_string($array);
        $array[1] = md5($array[1]);
        $zapytanie = "INSERT INTO users VALUES (NULL, '$array[0]', '$array[1]', '$array[2]', '$array[3]', NULL, NULL)";
        $this->dbase->zapytanie($zapytanie);
    }
    
    function aktualizujDane($username, $password, $name, $surname, $foto, $id){
        $array = array($username, $password, $name, $surname);
        $array = $this->dbase->real_escape_string($array);
        $array[1] = md5($array[1]);
        $zapytanie = "UPDATE users SET username='$array[0]', password='$tarray[1]', name='$array[2]', surname='$array[3]' WHERE id = '$id'";
        echo $zapytanie;
        $this->dbase->zapytanie($zapytanie);
    }

}
