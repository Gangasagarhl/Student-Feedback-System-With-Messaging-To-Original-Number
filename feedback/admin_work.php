<html>
    <head>
        <title>Admin_workings</title>
      
      <link rel="stylesheet" href="http://maxcd.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
                <script src="https://kit.fontawesome.com/7de9c8aa22.js" crossorigin="anonymous"></script>

       
       
        
    </head>
    <body>
        
        
        
        
        
<!--
This part will provide you the information regarding the navigation bar
in navigation bar you will get the information regarding the name of the employee
and welcome and hi to the employee and also logout at the end
-->
        <div id="bar" >

    <span>Hi,</span>
    &nbsp;&nbsp;
    <span>Welcome </span>
    &nbsp;&nbsp;&nbsp;
<span>

<?php

// extracting user name from the header and placing it on the black bar
$GLOBALS['user'] = $_GET['u'];
$GLOBALS['time'] = $_GET['time'];
$GLOBALS['sent'] = $_GET['sent'];

 echo $user;

?>
</span>

<span><a href="index.php" id="logout" >Logout &nbsp;&nbsp;<i class="fas fa-sign-out-alt"></i></a></span>

</div>

<!--****************************************************************************************-->
<!--This ends head bar in this page-->
<!--Beggining of main body for admin works-->
<!--****************************************************************************************-->


<form method="POST">

<!--****************************************************************************************-->
<!--This Section is for inserting -->
<!--****************************************************************************************-->

<section >
    <div class="sec-div1" >
      
        <h3 style="background-color: #02FAB8">Insert</h3>
        


      <!--inserting New Student-->
      <div class="idivs1" >
        <input type="submit" value="Insert Student Record"   name="is"><br>
      </div>
      
      <!--Inserting New Teacher-->
      <div class="idivs1">
        <input type="submit" value="Insert Teacher Record"   name="it"><br>
      </div>

      <!--Inserting question-->
      <div class="idivs1">
        <input type="submit" value="Insert Question"   name="iq"><br>
      </div>

      <!--Inserting Timestamp for taking feedback-->
    
        <div class="idivs1" id="gfeed" >
        
          <span><input type="time"  name="ift" style="width: 45%; align:left " ></span>&nbsp;
          <span style="margin-left: 2%;"><input type="submit" value="Feedback Time"   name="isft" style="width: 47%; font-size:20px; background: rgba(93, 177, 149, 0.7)" ></span>
        
        </div>
     

    </div>

    <br><br><br>

  </div>
</section>
 





<section style="width: 32%">

  <div class="sec-div1">
    <center>
     <h3 style="background-color: #FA020A">Delete</h3>
     
<!--Delete Teacher from database completely-->
  <div style="margin-top: 9.7%">
 <input type="text" placeholder=" Enter The EMPID"  name="empid" ><br>
 <input type="submit" name="df" value="Delete Teacher Record"><br>

</div><br>

<!--Delete Student from database completley-->

<div>
  <div>
 <input type="text" placeholder=" Enter The USN"  name="usn" ><br>
</div>
  <input type="submit" value="Delete Student Record" name="ds" >
</div>
<br>
<div>
  
<input type="submit" name="das" value="Delete every student Record"><br><br><br>
<input type="submit" name="daf" value="Delete every Faculty Record"><br>
</center>
</div>
</section>



</form>
    


      </body>

      </html>
<!--Inserting the student-->

 <?php 

// credentials to connect to backend
$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="wtc_project";
$conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname);


// for changing status from "Yes" to "No"
date_default_timezone_set("Asia/Kolkata");
$current= date("Y-m-d H:i:s");//saving current time in that variable
$current=strtotime($current); //converting date(string) obtained to time
$time=strtotime($time); //converting date(string) obtained to time
$time=(int)( (int)($current) - (int)($time) ); // Differencing to determine whether current time is more than feedback dead time




/*if($res->num_rows>0)
	{
		while ($ro=$res->fetch_assoc()) 
		{
			$cn=$ro['c'];
		}
	}
*/
 // counting the number of row for a admin in a table, it only applies only when there is admin as its elements in table.
 function counting($table,$conn)
 {
    
      $check_number_of_rating = "SELECT COUNT(*) as cnt FROM $table WHERE admin='$_GET[u]'";
      $res = mysqli_query($conn,$check_number_of_rating);
      $cnt=-1;

      if($res)
      {

        while($row=$res->fetch_assoc())
        { 
          $cnt = $row['cnt'];
          $cnt = (int)$cnt;
       
         }
     
      }
      
      return $cnt;
    
  }

  $stu_count = counting('student',$conn);
  $emp_count = counting('employee',$conn); 

if($stu_count > 0 && $emp_count > 0)
{

  if($time > 0)
  {
    $updating_status = "update admin  set feed_status='N' where user='$user' ";// if yes then update feed_status to N
    $res=mysqli_query($conn,$updating_status);

    if($sent == 'N')
    {
      // If feedback message to teachers are not sent , then send

      //calling seding_message.php to send feedback results message to every teachers
      header("location:sending_message.php?u=".$user."&time=".$time."&sent=".$sent);
      
      

    }
  }



}






            
//if insert student has been pressed.
if (isset($_POST['is'])) {
    
    header("location:insert_through_admin_student.php?u=".$user."&time=".$time."&sent=".$sent);
}
   

//<!--Inserting the teachers or Faculties-->

     
if (isset($_POST['it'])) {
    
    header("location:insert_through_admin_teaching.php?u=".$user."&time=".$time."&sent=".$sent);
}
  

//<!--Inserting the question-->

 
if (isset($_POST['iq'])) {
    
    header("location:insert_through_admin_question.php?u=".$user."&time=".$time."&sent=".$sent);
}

// Inserting timestamp t


//<!--Admin Overview Through Sem Section-->

if(isset($_POST['s'])){
  $s=$_POST['t'];

  header("location:admin_overview.php?u=".$user."&s=".$s."&time=".$time."&sent=".$sent);
}

// Implacing Feedback Time to admin table.
if(isset($_POST['isft']))
{

  $deleteratingofteacher="delete from rating where admin='$user' ";
  $res=mysqli_query($conn,$deleteratingofteacher);
  if($res){
  echo "<script>alert('refreshing previous ratings')</script>";
  }

$datetimes = new DateTime('tomorrow');
$tomorrow = $datetimes->format('Y-m-d');
$timings=$_POST['ift'];
$timings = $tomorrow." ".$timings;
#$timings = strtotime($timings);


$feedback_time_fix_sql = "update admin 
                          set feed_status='Y', time_within = '$timings', sent='N'
                          where user='$user' 
                          ";
$res=mysqli_query($conn,$feedback_time_fix_sql);

  if($res){
    echo "<script>alert('Feedback Time updated,\n Feedback must be done within: $timings ')</script>";
    }


  }


//Delete every Faculty content

if(isset($_POST['daf']))
{


$deleteratingofteacher="delete from rating where admin= '$user' ";
$res=mysqli_query($conn,$deleteratingofteacher);


if($res)
{

$sql = "DELETE FROM teaching where admin= '$user' ";
$r=mysqli_query($conn,$sql);



if($r)
{
$s2="delete from employee where admin= '$user'";
$r1=mysqli_query($conn,$s2);



if($r1)
{
  echo "<script>alert('deleted every  faculty record')</script>";
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



}







//<!--Delete Faculty-->


if(isset($_POST['df']))
{
$value=$_POST['empid'];



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
  echo "<script>alert('deleted the faculty with faculty id $value')</script>";
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



}


//delete Every student

if(isset($_POST['das']))
{



$deleteratingofstudent="DELETE from rating where admin= '$user'";
$res=mysqli_query($conn,$deleteratingofstudent);


if($res)
{

$s2="DELETE from student where admin= '$user'";
$r1=mysqli_query($conn,$s2);

if($r1)
{
  echo "<script>alert('deleted all the student record')</script>";
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











//<!--Delete Student-->


if(isset($_POST['ds']))
{
$value=$_POST['usn'];



$deleteratingofstudent="DELETE from rating where usn='$value' ";
$res=mysqli_query($conn,$deleteratingofstudent);


if($res)
{

$s2="DELETE from student where usn='$value'";
$r1=mysqli_query($conn,$s2);

if($r1)
{
  echo "<script>alert('deleted the student with USN:$value')</script>";
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



$conn->close();
?>


     <style>
          body{
            background-image: url(img/i.jpg);

            background-size: cover; 
          }
            
       input{
        width: 100%;
        font-size: 10px;
        border-radius: 5px;
        background-color:transparent;
        border:0px;
        font-size: 25px;
        color: white;

       }     
          
         section{
          margin-top:3%;
          float: left;
          width: 31%;
          height:80%;
          margin-left:12.5% ;
          
         }

div{
  border-radius: 2px;
}
span{
  font-size: 20px;
}

div{
  background:rgba(0,0,0,0.5);
  animation: mymove 1.5s;
}



div {
  width: 380px;
  height: auto;

  font-weight: bold;
  position: relative;
 
  
}



#div1 {animation-timing-function: linear;}

@keyframes mymove 
{
  from {
    display: none;
    width: 0px;
    height: 200%;
        }
  
  to {
  width:  100%;
  height: 100%
    }
}

h3{
  color: white;
  text-align: center;
  font-size: 30px;
}
hr
{
border: 3px solid ;  
}

#bar{

        background-color:black;
        color:white ;
        height: 30px;
        width: 100%;
       
    }

#logout{

  text-decoration:none;
  margin-left:65%;
  color:white;
}

.sec-div1{
    width: 100%;
    height: 100%;
  }

  .idivs1{
    width: 100%;
    margin-top: 10%;

  }

  #gfeed{
    
  }
        </style>