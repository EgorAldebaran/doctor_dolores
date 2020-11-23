<?php

class Human
{
    public $name;
    public $number;

    public function set_name() {
        print <<< _html_
            <form method = "post" action="$_SERVER[PHP_SELF]">
        your name: <input type="text" name='name'>
            your number: <input type='number' name='number'>
            <input type='submit' value='send'>
        </form>
        _html_;
    }

    public function get_name() {
        echo "your name is ";
        echo $_POST['name'];
        echo '<br>';
        echo "your number is ";
        echo $_POST['number'];
    }

    public function set_db($servername, $dbname, $username, $password, $table_name) {
        $this-> servername = $servername;
        $this-> dbname = $dbname;
        $this-> username = $username;
        $this-> password = $password;
        $this-> table_name = $table_name;

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password );
            // set the PDO error mode to exception
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // sql to create table
            $sql = "CREATE TABLE IF NOT EXISTS $table_name (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL
)";


            // use exec() because no results are returned
            $conn -> exec($sql);
            echo '<br>';
            echo 'table this created successfully';
        }
        catch(PDOException $el) {
            echo $sql . '<br>' . $el -> getMessage();
        }
        $conn = null;
    }

    public function insert_db($server, $dbname, $user, $password, $table_name) {
        $this-> server = $server;
        $this-> dbname = $dbname;
        $this-> user = $user;
        $this-> password = $password;
        $this-> table_name = $table_name;
        $name = $_POST['name'];

        try {

            $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $password );
            // set the PDO error mode to exception
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO $table_name (name)
VALUES ('$name')";
            // use exec() because no resulta are returned
            $conn -> exec($sql);
            echo '<br>';
            echo 'new record created successfully ';

        }
        catch(PDOException $el) {
            echo $sql . '<br>' . $el -> getMessage();
        }
        $conn = null;

    }

}


$servername = 'localhost';
$dbname = 'test';
$username = 'testuser';
$password = 'ald123';
$table = 'new';


$queen = new Human;
$queen -> set_name();
$queen -> get_name();
$queen -> set_db($servername, $dbname, $username, $password, $table);
echo '<br>';

$queen -> insert_db($servername, $dbname, $username, $password, $table);
