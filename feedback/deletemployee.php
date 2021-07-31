<html>
<head>
   
    </head>
    <body >
        <div>
    
           
            <form method="GET" action="">
               
             
                <input type="text" placeholder=" Enter The EMPID"  name="empid" style="font-size: 20px"><label id="lb2" style="color: red ; "></label>
                <br><br>

             

           

            <input type="submit" value="Submit" name="Submit" style="font-size: 20px; padding-left: 50px;padding-right: 50px">
            </form>
        
            </div>

        
    </body>
</html>









<?php

if(isset($_GET['Submit']))
{
$value=$_GET['empid'];

$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="wtc_project";
$conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname);

$deleteratingofteacher="delete from rating where empid='$value'";
$res=mysqli_query($conn,$deleteratingofteacher);


if($res)
{

$sql = "DELETE FROM teaching WHERE empid='$value' ";
$r=mysqli_query($conn,$sql);



if($r)
{
$s2="delete from employee where empid='$value'";
$r1=mysqli_query($conn,$s2);



if($r1)
{
	echo "<script>alert('deleted the faculty with faculty id' . '$value')</script>";
}



else
{
	echo "<script>alert('Error while deleting ')</script>".mysqli_error($conn);
}

}
else
{
    echo "<script>alert('Error while deleting ')</script>".mysqli_error($conn);
}

}
else
{
    echo "<script>alert('Error while deleting ')</script>".mysqli_error($conn);
}


$conn->close();
}
?>









