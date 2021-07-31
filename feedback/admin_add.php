<html>
    <head>
      <link rel="stylesheet" href="http://maxcd.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
                <script src="https://kit.fontawesome.com/7de9c8aa22.js" crossorigin="anonymous"></script>
  </head>

    <body>

<!--Creating the logout bar  
    <div style="background-color:black">
    <div style="color:whitesmoke;margin-left:80%;padding-top: 1%">
        <a href="index.php"><span style="text-decoration:none;color:white">Logout<span style="color: transparent;">ii</span><i class="fas fa-sign-out-alt"></i></span></span></a>
        <br> <br>

    </div>
    </div>
 -->
<center>
      
           <form  method= "post">
            <br>
        
           <div class = "login-box">

            <h1> SIGNUP </h1>


            
          <div class = "text-box">
          
              <i class="fas fa-user "></i>
            <input type="text"   placeholder= "Enter unique username" name="u" required  minlength="3" maxlength="10">
          </div>

                <div class = "text-box">
                  <i class="fas fa-lock "></i>
              
          <input type="password" placeholder="Enter Password" name="p" required minlength="7" maxlength="10">

         </div>

          <input class= "btn" type="submit"  value="SignUp" name="S">
    </div>
 
           

</form>
<br><br>

<a href="index.php">
  <input id="abort"
  type="submit" 
  value="Abort SignUp ">
</a> 
             

               
    </body>
</html>


<?php 


if(isset($_POST['S']))
{

  
$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="wtc_project";
$conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname); 

    
    

    
$u=$_POST['u'];
    
    
$p=$_POST['p'];

date_default_timezone_set("Asia/Kolkata");
$current= date("Y-m-d H:i:s");
 
$sql="INSERT into admin VALUES('$u','$p','F','$current','Y')";
$re=mysqli_query($conn,$sql);
if($re)
echo '<script>alert("username= '.$u.'\npassword= '.$p.'\nwas inserted succsessfully")</script>';
else
echo '<script>alert("Not Successfull.\n 
Because the user value has been inserted already. ")</script>';

$conn->close();
}

?>
      <style>
        a:link {
  text-decoration: none;
}

body{
  margin: 0;
  padding: 0;
  font-family: sans-serif;
  background: url(img/img.jpg) no-repeat;
  background-size: cover;
}


.login-box{
  width: 280px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-45%,-65%);
  color: white;
}
.login-box h1{
  float: left;
  font-size: 40px;
  border-bottom: 6px solid #ffc100;
  margin-bottom: 50px;
  padding: 13px 0;
}
.text-box{
  width: 97%;
  height: 23px;
  overflow: hidden;
  font-size: 20px;
  padding: 8px 0;
  padding-left: 8px;
  margin: 8px 0;
  border-bottom: 1px solid #ffc100;
}
.text-box i{
  width: 26px;
  height: 2px;
 float: left;
  text-align: center;
}
.text-box input{
  border: none;
  outline: none;
  background: none;
  color: white;
  font-size: 18px;
  width: 100%;
  float: left;
  margin: 0 10px;
  padding-left:30px
}


.btn{
  width: 94%;
  background: none;
  border: 2px solid #ffc100;
  color: white;
  padding: 5px;
  font-size: 18px;
  cursor: pointer;
  margin: 18px 0;
}

#abort{
  background-color: #FC3240;
  border:0;
  border-radius: 10px;
  margin-top: 27%;
  width: 19%;
  margin-left: 2%;
  height: 6%;
  font-size: 19px;
  color:white;
  
  
      }

        </style>
      
