


<h1>Users here</h1>
<?php
session_start();

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

function insertIntoTable($name,$password){
    $pdo=createPdo();
    $sql = 'SELECT * FROM users WHERE (name=:name OR password=:password)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name'=>$name,'password'=>$password]);
    $found = $stmt->fetchAll();

    $names=[];
    $passwords=[];
    foreach($found as $post){
        array_push($names,$post->name);
        array_push($passwords,$post->password);
    }
if(in_array($name,$names)) echo "such name already exists";
    elseif(in_array($password,$passwords)) echo "such password already exists";

    else {
        $sql = 'INSERT INTO users(name,password) VALUES(:name, :password)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $name, 'password' => $password]);
        //echo 'User Registered';

        $pdo = null;
        $_SESSION['currentUser']=$name;
header('Location: http://localhost/mvcpractice/views/page1');
    }
}

//function showAll($name,$password){
//    $pdo=createPdo();
//    $sql = 'SELECT * FROM users WHERE (name=:name OR password=:password)';
//    $stmt = $pdo->prepare($sql);
//    $stmt->execute(['name'=>$name,'password'=>$password]);
//    $found = $stmt->fetchAll();
//
//    $names=[];
//    foreach($found as $post){
//        echo $post->name.' '.$post->password.'<br>';
//        array_push($names,$post->name);
//    }
//    print_r($names);
//
//    $pdo=null;
//}



?>

<form name="form1" method="post">
    Name <input type="text" name="name"><br>
    Password <input type="text" name="password"><br>

    <input type="submit" name="bt1" value="Register" >

</form>

<?php
if(isset($_POST['bt1'])) insertIntoTable($_POST['name'], $_POST['password']);
//if(isset($_POST['bt1'])) showAll($_POST['name'], $_POST['password']);


?>
