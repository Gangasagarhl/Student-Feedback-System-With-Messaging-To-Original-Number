<!DOCTYPE html>
<html>
<head>
	<title>inserting through admin</title>
 <link rel="stylesheet" type="text/css" href="style.css"> 
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
    background: url(img/m2.jpg);
    background-size: cover;
    background-position: center;
    font-family: sans-serif;
      background-repeat: no-repeat;
  background-attachment: fixed;
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
  from {left: 0px;}
  to {left: 40%px;}
}

 </style>
</head>
<body>
	
 <div class="login-box">
    
        <h1>Insert Student Record</h1>
            <form method="POST">
            <p>First Name</p>
            <input type="text" name="f" placeholder=" Firstname" required>
            <p>Last Name</p>
            <input type="text" name="l" placeholder="Lastname" required>
            <p>USN</p>
            <input type="text" name="u" placeholder="USN" required>
            <p>Password</p>
            <input type="password" name="p" placeholder=" Password"  required>
            
            <p>Sem Section</p>
            <input type="text" name="s" placeholder=" Sem and  Section"  required>
                       
 
            <input type="submit" name="S" style="padding-top:7px;padding-bottom:7px; " value="Insert Student">

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
	$u=$_GET['u'];
  $GLOBALS['time'] = $_GET['time'];
  $GLOBALS['sent'] = $_GET['sent'];

header("location:admin_work.php?u=".$u."&time=".$time."&sent=".$sent);
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
 
 $s=$_POST['s']; 



$d=$_GET['u'];
 

$sql="insert into student values('$f','$l','$u','$p','$d','$s')";
$res=mysqli_query($conn,$sql);

if($res){

	echo "<script>alert('sucessfully inserted the record')</script>";
}

else{

    $msg = 'Unsuccessfull because of '.mysqli_error($conn);

	echo '<script> alert(\'Unsuccessfull Because of Duplicate Key\')</script>';
}

 //end if,will  be executed only if you find there was no records in the student table




$conn->close();
}



?>