<html>
    <head>
        <title>Faculty</title>
    <link rel="stylesheet" href="http://maxcd.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
                <script src="https://kit.fontawesome.com/7de9c8aa22.js" crossorigin="anonymous"></script>
      
    </head>
    
    <body >
    
    <div class = "login-box">

<h1> FACULTY  </h1>
                <form method="get">
               
         	<div class = "text-box">
               <i class="fas fa-user "></i>

<input input type="text" placeholder="Enter Employee ID"; name="user" required>
</div>
                <div class = "text-box">

 <i class="fas fa-lock "></i>
         	<input input type="password" placeholder="Enter password" name="pass"; required>
         </div>
                    
                    
                     <!--****************************************************************************please inser a new text box with the placeholder "Admin -username" *******************************************88888*******************  -->
                
         <input type="submit" value="LOGIN" name="Submit" class="btn">
                
                
                
                </form>
             

              <a href="index.php"><input style="background-color: #FC3240;border:0;border-radius: 10px;margin-top: -%" class= "btn" type="submit" value="Abort Login "></a> 
            
        </div>  
        
    </body>
    
</html>




<?php
if(isset($_GET['Submit']))
{
$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="wtc_project";



$conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname) or die("there was something error");

 $user=$_GET['user'] ;
$pass=$_GET['pass'] ;
 
$sql="select * from employee where empid='$user' and password='$pass' ";
    
$res=mysqli_query($conn,$sql);
$cnt = mysqli_num_rows($res);    
$conn->close();
    if($cnt == 1){
        $seconds = 5 + time();
		setcookie(loggedin, date("F jS - g:i a"), $seconds);
		header("location:faculty_result.php?u=$user");
    
		
    }

    else
echo '<script>alert("username or password is wrong ");</script>';

}

?>


      <style>

 body{
  margin: 0;
  padding: 0;
  font-family: sans-serif;
  background: url(img/teacher.jpg) no-repeat;
  background-size: cover;
}

.login-box{
  width: 280px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-105%,-55%);
  color: white;
}
.login-box h1{
  float: left;
  font-size: 40px;
  border-bottom: 6px solid #000000;
  margin-bottom: 50px;
  padding: 13px 0;
}
.text-box{
  width: 100%;
  overflow: hidden;
  font-size: 20px;
  padding: 8px 0;
  margin: 8px 0;
  border-bottom: 1px solid #000000;
}
.text-box i{
  width: 26px;
  float: left;
  text-align: center;
}
.text-box input{
  border: none;
  outline: none;
  background: none;
  color: white;
  font-size: 18px;
  width: 80%;
  float: left;
  margin: 0 10px;
}
.btn{
  width: 100%;
  background: none;
  border: 2px solid #000000;
  color: white;
  padding: 5px;
  font-size: 18px;
  cursor: pointer;
  margin: 12px 0;
}
 
        </style>