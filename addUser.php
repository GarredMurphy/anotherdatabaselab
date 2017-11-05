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
     
     if (isset($_GET['addUser'])){
        $sql = "INSERT INTO heroku_e746fa7e355c8e7.user (firstName, lastName, email, phone, role, deptId) VALUES (:fname, :lname, :email, :phone, :role, :deptId)";
        $np = array();
        $np[':fname'] = $_GET['firstName'];
        $np[':lname'] = $_GET['lastName'];
        $np[':email'] = $_GET['email'];
        $np[':phone'] = $_GET['phone'];
        $np[':role'] = $_GET['role'];
        $np[':deptId'] = $_GET['deptId'];
        
        $statement = $dbConn->prepare($sql);
        $statement->execute($np);
        
        echo "user was added";
     }
     ?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/styles.css" rel ="stylesheet" type="text/css" />
        <title> Add User </title>
    </head>
    <body>
        <h1> Adding new user</h1>
        <form>
            First Name:<input type="text" name="firstName" />
            <br />
            Last Name:<input type="text" name="lastName"/>
            <br/>
            Email: <input type= "email" name ="email"/>
            <br/>
            Phone Number: <input type ="text" name= "phone"/>
            <br />
            Role:
            <select name="role">
                <option value=""> - Select One - </option>
                <option value="staff">Staff</option>
                <option value="student">Student</option>
                <option value="faculty">Faculty</option>
            </select>
            <br />
            Department:
            <select name="deptId">
                <option value="" > Select One </option>
                <?php
                $departments = departmentList();
                foreach($departments as $department){
                echo "<option value= '".$department['id']."'> ". $department['name'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" value="Add User" name="addUser">
        </form>
        <br />
        <a href= "admin.php">Return</a>
    </body>
</html>