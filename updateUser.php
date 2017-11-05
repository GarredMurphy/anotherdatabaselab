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

function departmentList(){
         global $dbConn;
         
         $sql = "SELECT * FROM heroku_e746fa7e355c8e7.departments ORDER BY name";
         $statement = $dbConn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
         return $records;
     }
     
if (isset($_GET['updateUser'])){
    echo "record has been updated! <br />";
    $sql = "UPDATE heroku_e746fa7e355c8e7.user SET
    firstName = :fname,
    lastName = :lname,
    email = :email,
    phone = :phone,
    role = :role,
    deptId = :deptId
    WHERE id = :id";
    
    $np = array();
        $np[':fname'] = $_GET['firstName'];
        $np[':lname'] = $_GET['lastName'];
        $np[':email'] = $_GET['email'];
        $np[':phone'] = $_GET['phone'];
        $np[':role'] = $_GET['role'];
        $np[':deptId'] = $_GET['deptId'];
        $np[':id'] = $_GET['userId'];
    $statement = $dbConn->prepare($sql);
    $statement->execute($np);
    
    echo "record has been updated! <br />";
    
    
    
    
}

if (isset($_GET['userId']))
{
    $userInfo = getUserInfo();
    
    print_r($userInfo);
}

function getUserInfo(){
    global $dbConn;
    
    $sql = "SELECT * from heroku_e746fa7e355c8e7.user WHERE id =" . $_GET['userId'];
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $record = $statement->fetch(PDO::FETCH_ASSOC);
    return $record;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/styles.css" rel ="stylesheet" type="text/css" />
        <title> Update User </title>
    </head>
    <body>
        <h1> Update User </h1>
        
        <form>
        id:  <?=$userInfo['id']?>  <input type="hidden" name="userId" value = "<?=$userInfo['id']?>" />
        <br />  
        First Name:<input type="text" name="firstName" value = "<?=$userInfo['firstName']?>" />
        <br />
        Last Name:<input type="text" name="lastName" value = "<?=$userInfo['lastName']?>" />
        <br/>
        Email: <input type= "email" name ="email" value = "<?=$userInfo['email']?>" />
        <br/>
        Phone Number: <input type ="text" name= "phone" value = "<?=$userInfo['phone']?>" />
        <br />
        Role:
        <select name="role">
            <option value=""> - Select One - </option>
            <option value="staff"  <?=($userInfo['role'] == 'staff')?" selected":"" ?>  >Staff</option>
            <option value="student"  <?=($userInfo['role'] == 'student')?" selected":"" ?>  >Student</option>
            <option value="faculty"  <?=($userInfo['role'] == 'faculty')?" selected":"" ?>  >Faculty</option>
            </select>
        <br />
        Department:
        <select name="deptId">
        <option value="" > Select One </option>
              
                <?php
                $departments = departmentList();
                foreach($departments as $department){
                    if ($userInfo['deptId'] == $department['id']){
                        echo "<option value= '".$department['id']."' selected> ". $department['name'] . "</option>";
                    }
                    else {
                        echo "<option value= '".$department['id']."' > ". $department['name'] . "</option>";
                    }
                }
            ?>
            </select>
        <input type="submit" value="Update User" name="updateUser">
        </form>
        
        <br />
        <a href= "admin.php">Return</a>
    </body>
</html>