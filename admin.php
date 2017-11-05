<?php

include 'database.php';
session_start();
    
if (!isset($_SESSION['username']))
{
    header("Location: index.php");
    echo $_SESSION['username'];
    echo "<br />";
}



function userList()
{
    $dbConn = getDatabaseConnection();
    $sql = "SELECT * from heroku_e746fa7e355c8e7.user ORDER BY firstName, lastName";
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
        <title> Admin Main Page </title>
        
        <script>
            
            function confirmDelete(){
                return confirm("Are you sure you want to delete this user?")
            }
        </script>
    </head>
    <body>
        <h1> admin main </h1>
        <h1> welcome <?=$_SESSION['adminName']?></h1>
        
        <form action = "logout.php">
            <input type="submit" value = "Logout" />
        </form>
        
        <br/>
        
        <form action = "addUser.php">
            <input type="submit" value = "Add new user" />
        </form>
        
        <br/>
        <?php
        $users = userList();
        
        foreach($users as $user)
        {
            echo $user['id'] . " " . $user['firstName'] . " " . $user['lastName'];
            echo "[<a href= 'updateUser.php?userId=". $user['id']. "'> Update </a>]";
            echo "[<a onclick='return confirmDelete()' href= 'deleteUser.php?userId=". $user['id']. "'> Delete </a>] <br />";
        }
        
        
        ?>
    </body>
</html>