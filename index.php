
<!DOCTYPE html>
<?php
session_start();
function loginProcess() {
    if (isset($_POST['loginForm'])) 
     {
         
     
    
    include 'database.php';
    $dbConn = getDatabaseConnection();
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    
    $sql = "SELECT * from heroku_e746fa7e355c8e7.admin WHERE userName = :username AND password = :password";
//    $sql = "SELECT * from heroku_e746fa7e355c8e7.admin WHERE 1";
    $named_parameters = array();
    $named_parameters[':username'] = $username;
    $named_parameters[':password'] = $password;
    $statement = $dbConn->prepare($sql);
    
    
        $statement->execute($named_parameters);
    
        $record = $statement->fetch();
    //    $record = $statement->fetchALL();
        if (empty($records)) {
            echo "Wrong username or password <br /> ";
            //print_r($records);
        }
        else
        {
            $_SESSION['username'] = $record['username'];
            $_SESSION['adminName'] = $record['firstName'] . " " . $record['lastName'];
            //print_r($record);
            header("Location: admin.php");
        }
     }    
}
    /*
    function displayDeviceList() {
        
        
        $name_parameters = array();
        
        if (isset($_GET['submit']))
        {
            if (!empty($_GET['device-name']))
            {
                $sql .= " AND deviceName LIKE :deviceName";
                $named_parameters[":deviceName"] = "%" . $_GET['device-name'] . "%";
                
            }
            if (!empty($_GET['device-type']))
            {
                $sql .= " AND deviceType = '". $_GET['device-type'] . "'";
            }
            
            if (isset($_GET['available']))
            {
                $sql .= " AND status = 'available'";
            }
            
            if (isset($_GET['order-by']))
            {
                $sql .= " ORDER BY " .$_GET['order-by'];
            }
            else {
                $sql .= " ORDER BY deviceName";
            }
            
            
        }
        
        
        $dbConn = getDatabaseConnection();
    
    
        
    
        $statement = $dbConn->prepare($sql);
    
        $statement->execute($named_parameters);
    
        $records = $statement->fetchAll();
    
        foreach($records as $record) {
            echo $record["deviceName"]. " ".$record["deviceType"]." ".$record["price"]." ".$record["status"]."<br />";
        }
    
    }
    
    function getDeviceTypes()
    {
        
        $dbConn = getDatabaseConnection();
        $sql = "SELECT DISTINCT(deviceType) from heroku_e746fa7e355c8e7.device";
        $statement = $dbConn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll();
        foreach($records as $record) {
            echo "<option value ='". $record["deviceType"] . "'>". $record["deviceType"]."</option>";
        }
    }
    */
?>
<html>
    <link href="css/styles.css" rel ="stylesheet" type="text/css" />
    <title> Admin Login </title>
    <body>
        <h1> Admin Login </h1>
        <form method="post">
            Username: <input type="text" name = "username"/>
            
            <br />
            
            Password: <input type="password" name = "password"/>
            
            <br />
            <input type="submit" name="loginForm" value ="Login!">
        
        </form>
        <?=loginProcess()?>
    </body>
</html>