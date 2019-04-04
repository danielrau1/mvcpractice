<?php require 'C:\xampp\htdocs\mvcpractice\app\views\navbar.php'; ?>


    <h1>Login here</h1>
<?php


function createPdo()
{
    $host = 'localhost:3306'; //Make sure choose the good host
    $user = 'root';
    $password = '';
    $dbname = 'test';
    // Set DSN
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $pdo;
}

function logIn($name,$password){
    $pdo=createPdo();
    $sql = 'SELECT * FROM users WHERE (name=:name AND password=:password)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name'=>$name,'password'=>$password]);
    $found = $stmt->fetchAll();

    $names=[];
    foreach($found as $post){
        echo $post->name.' '.$post->password.'<br>';
        array_push($names,$post->name);
    }
    print_r($names);
    $pdo=null;
    if(sizeof($names)==0) echo "No such user";
    else header('Location: http://localhost/mvcpractice/views/page1');


}

?>


<form name="form2" method="post">
    Name <input type="text" name="name"><br>
    Password <input type="text" name="password"><br>

    <input type="submit" name="bt2" value="Login" >

</form>
    <a href="http://localhost/mvcpractice/Pages/users">Register</a>

<?php
if(isset($_POST['bt2'])) logIn($_POST['name'], $_POST['password']);



?>