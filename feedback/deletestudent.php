<html>
<head>
   
    </head>
    <body >
        <div>
    
           
            <form method="GET" action="">
               
             
                <input type="text" placeholder=" Enter The USN"  name="usn" style="font-size: 20px"><label id="lb2" style="color: red ; "></label>
                <br><br>

             

           

            <input type="submit" value="Submit" name="Submit" style="font-size: 20px; padding-left: 50px;padding-right: 50px">
            </form>
        
            </div>

        
    </body>
</html>









<?php

if(isset($_GET['Submit']))
{
$value=$_GET['usn'];

$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="wtc_project";
$conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname);

$deleteratingofstudent="DELETE from rating where usn='$value'";
$res=mysqli_query($conn,$deleteratingofstudent);



if($res)
{

$s2="DELETE from student where usn='$value'";

$r1=mysqli_query($conn,$s2);

if($r1)
{
	echo "<script>alert('deleted the faculty with faculty id :$value')</script>";
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









