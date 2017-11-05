<?php
session_start();
    include 'database.php';
if (!isset($_SESSION['username']))
{
    header("Location: index.php");
}



function userList()
{
    $dbConn = getDatabaseConnection();
    $sql = "SELECT * from heroku_e746fa7e355c8e7.user WHERE 1";
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $records;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/styles.css" rel ="stylesheet" type="text/css" />
        <title> Amdmin Main Page </title>
    </head>
    <body>
        <h1> admin main </h1>
        <h1> welcome <?=$_SESSION['adminName']?></h1>
        
        
        
        <br/>
        
        <form action = "adduser.php">
            <input type="submit" value = "Add new user" />
        </form>
        
        <br/>
        <?php
        $users = userList();
        
        foreach($users as $user)
        {
            echo $user['firstName'] . " " . $user['lastName'];
        }
        
        
        ?>
    </body>
</html>