<!DOCTYPE html>
<html>
<head>
	<title>inserting through admin</title>
	 <link rel="stylesheet" type="text/css" href="style.css">   

 



</head>
<body>

 <div class="login-box" id="di">
 <h1>Insert Faculty Record</h1>
            <form method="POST">
            <p>First Name</p>
            <input type="text" name="f" placeholder="Firstname" required>
            <p>Last Name</p>
            <input type="text" name="l" placeholder=" Lastname" required>
            <p>EmpID</p>
            <input type="text" name="u" placeholder="USN" required>
            <p>Password</p>
            <input type="password" name="p" placeholder=" Password"  required>
           
             <p>Subject</p>
            <input type="text" name="sub" placeholder="Subject"  required>
             
             <p>Sem & Sec</p>
            <input type="text" name="s" placeholder="Sem and Section"  required>

            <p>Mobile Number</p>
            <input type="text" name="pn" placeholder="Sem and Section"  required>
                       
 
            <input type="submit" name="S" style="padding: 5px">

            </form>
  <form method="POST">
       <button type =" submit" style="width: 50% ;float: left;
        background-color: #8DFC2C;
        color: white;border: 0;
        padding-top:5px;padding-bottom:5px;
        border-radius: 10px;
        font-size: 18px;
          "
name="ac" 
        >Previous Page</button>
</form>
        <?php
if(isset($_POST['ac'])){
  $admin=$_GET['u'];
  $GLOBALS['time'] = $_GET['time'];
  $GLOBALS['sent'] = $_GET['sent'];

header("location:admin_work.php?u=".$admin."&time=".$time."&sent=".$sent);
}

        ?>
<a href="index.php" ><button style="width: 50% ;float: left;
background-color: #FF4949;
border:0;
 padding-top:5px;padding-bottom:5px;
        border-radius: 10px;
         font-size: 18px;
         color: white;

">Logout</button></a>


</div>
</body>

</html>

<?php

if (isset($_POST['S'])) {
	

 $s="localhost";
 $us="root";
 $p="";
 $d="wtc_project";
 $conn=mysqli_connect($s,$us,$p,$d);


 $f=$_POST['f'];
 $l=$_POST['l'];
 $u=$_POST['u'];
 $p=$_POST['p'];
 $d=$_GET['u'];
 $s=$_POST['s']; 
 $pn=$_POST['pn'];

$sub=$_POST['sub'];



 

$sql="insert into employee values('$f','$l','$u','$p','$d','$pn')";
$res=mysqli_query($conn,$sql);
//inserting employee
if($res)
{


$sql="insert into teaching values('$u','$sub','$s','$d')";
$res=mysqli_query($conn,$sql);
// to teaching
if($res)
{

	echo "<script>alert('sucessfully inserted the record')</script>";
}

else{
echo '<script>alert("Unsuccessfull")</script>'.mysqli_error($conn);
	
}
}

else{

  $sql="insert into teaching values('$u','$sub','$s','$d')";
  $res=mysqli_query($conn,$sql);
	echo '<script>alert("Unsuccessfull insertion to employee but to Teaching successfull")</script>';//.mysqli_error($conn);
}

 //end if,will  be executed only if you find there was no records in the student table




$conn->close();
}



?>

<style type="text/css">
  button{
    margin-top: 10px;
  }
  p{
    margin: 15px;
  }

  body{
    margin: 0;
    padding: 0;
    background: url(img/abstract-phone-wallpaper.jpg);
    background-size: cover;
    width: 100%;
    height: 100%;
    background-position: center;
    font-family: sans-serif;
}


div {
  width: 380px;
  height: auto;
  background-color: red;
  font-weight: bold;
  position: relative;
 
  animation: mymove 1.5s;
}
#div1 {animation-timing-function: linear;}

@keyframes mymove {
  from {top: 0px;}
  to {top: 60%;}
}

 </style>