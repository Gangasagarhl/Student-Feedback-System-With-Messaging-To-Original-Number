<html>
    <head>
        <style>
            span{
                font-size: 24px;
            }
        </style>
    </head>
    <body>
        
<div style="background-color:black;color:white">

    <span>Hi,</span><span style="color:transparent">hh</span>
    <span>Welcome </span>
    <span style="color:transparent">hhh</span>
<span>
<?php
 $host="localhost";
 $dbusername="root";
 $dbpassword="";
 $dbname="wtc_project";
 $conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname);

 $user="sri@gmail.com";
    
 $sql="select fname,lname from add_faculty where empid='$user'";

$res=mysqli_query($conn,$sql);

if($res->num_rows>0){
    while($rows=$res->fetch_assoc()){
        echo $rows['fname']." ".$rows['lname'];
    }
}



?>


</span>

<span><a href="index.php" style="text-decoration:none
;margin-left:50%;color:white">Logout</a></span>


</div>
        
    </body>
</html>