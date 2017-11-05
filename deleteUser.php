<!DOCTYPE html>
<?php
session_start();
    
if (!isset($_SESSION['username']))
{
    header("Location: index.php");
    echo $_SESSION['username'];
    echo "<br />";
}



    include 'database.php';
    $dbConn = getDatabaseConnection();
    
    if ($_GET['confirmation'] == "confirm")
    {
        $sql = "DELETE FROM heroku_e746fa7e355c8e7.user WHERE id = :id";
    
    $np = array();
        $np[':id'] = $_GET['userId'];
    $statement = $dbConn->prepare($sql);
    $statement->execute($np);
    echo "attempting to delete";
    header("Location: admin.php");
    }
    if ($_GET['confirmation'] == "go back")
    {
    header("Location: admin.php");
    }
    
?>

<body>
    
</body>

<html>
    <head>
        <link href="css/styles.css" rel ="stylesheet" type="text/css" />
    </head>
    <h1>are you sure you want to delete this user?</h1>
    
    <form>
        <input type ="hidden" name ="userId" value = <?= $_GET['userId']  ?> >
        <input type="submit" name="confirmation" value ="confirm">
        <input type="submit" name="confirmation" value ="go back">
    </form>
    
</html>
