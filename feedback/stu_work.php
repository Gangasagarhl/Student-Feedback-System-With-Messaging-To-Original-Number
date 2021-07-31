<html>
    <head>
   <link rel="stylesheet" href="http://maxcd.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
                <script src="https://kit.fontawesome.com/7de9c8aa22.js" crossorigin="anonymous"></script>
   
  
    </head>

    <script>
    
    </script>
    <body >
    
     
        
      <!--
          
      ****************************************************
      It is the navigation bar with the background color black and with the white color
      ,which gives you complete information regarding the name of the guy(student)
      ***************************************************


    -->  
        
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
 
 //Extracting usn from url 
 $GLOBALS['usn']=$_GET['u'];

  //extracting first and last name from student
function extracting_credentials_of_student_from_usn($conn,$usn)
  {
    $sql="select fname,lname,semsec,admin from student where usn='$usn' ";
    $res=mysqli_query($conn,$sql);
    if($res->num_rows>0)
    {   
        while($rows=$res->fetch_assoc())
        {   
            $GLOBALS['fname'] = $rows['fname'];
            $GLOBALS['lname'] = $rows['lname'];
            $GLOBALS['semsec'] = $rows['semsec'];
            $GLOBALS['admin'] = $rows['admin'];   
        }
    }
  }
  extracting_credentials_of_student_from_usn($conn,$usn);
  


  
echo $fname." ".$lname."<span style='margin-left:8px'> ".$semsec."</span> <span style='margin-left:8px'>  ".$admin."</span>";


$conn->close();
?>

</span>

 
<span>
  <a href="student.php" style=" text-decoration:none; margin-left:40%; color:white ">
    Logout&nbsp;&nbsp;<i class="fas fa-sign-out-alt"></i>
  </a>
</span>
</div>
<div id="2" style="display:none">
        <center>
            <h1 style="font-size:40px;margin-top:10%">
                Please Be Patient!!! <br>
                Admin Has Not Permitted To give Feedback.
            </h1>
        </center>
    </div>


  <div id="1">          
  <!-- 
  ************************************************************************    
  this is used inorder to place the values the table ,by using the tables student,
  teachers and the teaching values
  ************************************************************************
   -->      
<!--this part is used inoreder to display the questions the stu_work-->

<?php

 $host="localhost";
 $dbusername="root";
 $dbpassword="";
 $dbname="wtc_project";
 $conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname);



 function check_to_display($conn,$admin){

  // used to extract feed_status  from admin
    $feed_status="";
    $sql="select feed_status from admin WHERE user='$admin'";
    $res=mysqli_query($conn,$sql);
    if($res->num_rows>0)
      {   
          while($rows=$res->fetch_assoc())
          {  
            $feed_status = $rows['feed_status'];   
          }
      }
  
      
      //
      if($feed_status != 'Y')// agrees when there is 'N', but we have 'Y','N','F'
      {
        echo 
        '
        <script>
          document.getElementById("1").style.display = "none";
          document.getElementById("2").style.display="block";
          
        </script>
        ';
      }
  
  }
check_to_display($conn,$admin);

//getting the count from rating
$cnt=-1;
$sql="select count('$usn') as cnt from rating where usn='$usn' and admin='$admin'";
$res=mysqli_query($conn,$sql);

if($res->num_rows>0){
  while ($rw=$res->fetch_assoc()) {
    
$cnt=$rw['cnt'];

  }
}

$cnt=(int)$cnt;

if($cnt==0)
{

$sql="select q1,q2,q3,q4,q5 from question where admin='$admin'";
$res=mysqli_query($conn,$sql);

$q1="";$q2="";$q3="";$q4="";$q5="";


if($res->num_rows>0){

  while ($rows=$res->fetch_assoc()) {
  $q1=$rows['q1'];
  $q2=$rows['q2'];
  $q3=$rows['q3'];
  $q4=$rows['q4'];
  $q5=$rows['q5'];
  }

// question table starts here
echo "

    <table>
      
<tr><th colspan=2 style='font-size:30px'>Question Table </th></tr>

      <tr style='background-color:#84E184;color:white'>
        <th>Sl.No</th>
        <th>Questions</th>
      </tr>
      
<tr>
        <td>
         1
        </td>

        <td>
         $q1
        </td>
</tr>
     <tr>
        <td>
        2
        </td>

        <td>
         $q2
        </td>
</tr>


<tr>
        <td>
         3
        </td>

        <td>
         $q3
        </td>
</tr>



<tr>
        <td>
        4
        </td>

        <td>
         $q4
        </td>
</tr>


<tr>
        <td>
         5
        </td>

        <td>
         $q5
        </td>
</tr>


    </table>

";


//question table ends here




}
else{
  echo "<script>alert('Admin has not Provided Any of the Questions')</script>";
}
}
?>

</tr>
</table>



<div id="dis">
<!--
*************
this is required to ,disappear the table if there exist some records for the guy
*************
-->


    <form method="post">
        
        <table class="me">
            <tr >
                <th>FACULTY NAME</th>
                <th>Employee id</th>
                <th>QUESTION 1</th>
                <th>QUESTION 2</th>
                <th>QUESTION 3</th>
                <th>QUESTION 4</th>
                <th>QUESTION 5</th>
            </tr>
            <tr>
              <td colspan="7"><br></td>

            </tr>
            <?php

            //connection in php
            $host="localhost";
            $dbusername="root";
            $dbpassword="";
            $dbname="wtc_project";
            $conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname);
      



            /*
            
            
            **********************************************************************
           //this snipet will fetch you the semsec of the student corresponding 
            ***********************************************************************
           

           */

            /*

            ****************************this fetches the resultant value in the faculty table ,that is fname 
            lname ,empid  from the semsec correspondance values and places the value in the table format
            ****************************
           
            */

        $sql="SELECT e.fname,e.lname,e.empid,t.subject from employee as e 
        INNER JOIN teaching as t ON e.empid = t.empid AND t.semsec='$semsec' where e.admin='$admin'";
            
            $i=0;   // for fetching empid, by giving this as numbering as name
            $j=11; // for fetching the marks alloted, by giving this numbering as name
            $zx = 1000; // for fetching subject for placing into rating table
            $res=mysqli_query($conn,$sql);

            if($res->num_rows>0){
            while ($rows=$res->fetch_assoc()) 
            {

                echo "<tr><td >"   .$rows['fname'].   " "    .$rows['lname'].   " ".
                "<input type='text' name=".($zx++)." value=".$rows['subject']." readonly  style='border:0' onkeypress=this.style.width = '((this.value.length + 1) * 8)' + 'px';/>".'</td>'.
                '<td ><input type="text" name='.$i.' value='.$rows['empid'].'  readonly style="border:0"></td>'.
                //for the first question
                '<td><select  name='.($j++).' >
                   <option >1</option>
                   <option >2</option>
                   <option >3</option>
                   <option >4</option>
                   <option >5</option>
                   <option >6</option>
                   <option >7</option>
                   <option >8</option>
                   <option >9</option>
                   <option selected>10</option>
                 

                 </select>
                </td>'.
                //for the second question
               '<td><select  name='.($j++).' >
                   <option >1</option>
                   <option >2</option>
                   <option >3</option>
                   <option >4</option>
                   <option >5</option>
                   <option >6</option>
                   <option >7</option>
                   <option >8</option>
                   <option >9</option>
                   <option selected>10</option>
                 

                 </select>
                </td>'.
                //for the third question
                '<td><select  name='.($j++).' >
                   <option >1</option>
                   <option >2</option>
                   <option >3</option>
                   <option >4</option>
                   <option >5</option>
                   <option >6</option>
                   <option >7</option>
                   <option >8</option>
                   <option >9</option>
                   <option selected>10</option>
                 

                 </select>
                </td>'.
                //for the fourth qestion
               '<td><select  name='.($j++).' >
                   <option >1</option>
                   <option >2</option>
                   <option >3</option>
                   <option >4</option>
                   <option >5</option>
                   <option >6</option>
                   <option >7</option>
                   <option >8</option>
                   <option >9</option>
                   <option selected>10</option>
                 

                 </select>
                </td>'.
                //for the fifth question
                '<td><select  name='.($j++).' >
                   <option >1</option>
                   <option >2</option>
                   <option >3</option>
                   <option >4</option>
                   <option >5</option>
                   <option >6</option>
                   <option >7</option>
                   <option >8</option>
                   <option >9</option>
                   <option selected>10</option>
                 

                 </select>
                </td>';
              
                $j="$j"+6;
                $i="$i"+1;// giving seperate names each and every time
            }
        }
        
        else{
            echo '<script>alert("no records")</script>';
        }
        $conn->close();
             ?> 
<tr>
    <td colspan="3" style="font-size:30px; ">
      <br>
    <input type="submit" name="s" value="Submit" style="border-radius: 5px;color: white;font-size: 20px;
    background-color: #6254e8;border: 0"></td>
<td></td>
    <td colspan="3"><br><br><a href="index.php"><input type="button" value="Home"
    style="border-radius: 5px;color: white;font-size: 20px;
    background-color: #4ABEB2;border: 0"
      ></a></td>
</tr>


<!--
******************
ending of dispalying table inside the table
******************
-->

</table>
</form><!--form uses post -->

<br><br><br>
<center><span><b>Note:</b></span><span>  0 indicates Minimum &nbsp;&nbsp; &nbsp;   10 indicates Maximum</span>
</center>

</div>




</div>
    </body>
</html>

<?php
//credentials to connect to db
$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="wtc_project";
$conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname);

//Extracting count in order to check whether given feedback or not,
// if 0 then not given, else given
$sql="select count(*) as c from rating where usn='$usn'";
$res=mysqli_query($conn,$sql);
$cnt=-1;


if($res->num_rows>0)
{
  while($rows=$res->fetch_assoc())
  {
    $cnt=$rows['c'];
  }
}
$cnt=(int)$cnt;



if($cnt==0)
{
  
if(isset($_POST['s']))
{

/*

***********************
this fetches the count from the rating that, if the values are exited the that guy is nota allowed to
Give the feedback  ,else then only the guy is allowed to give the feedback 
included in starting
***********************

*/ 
/*

*********
this is used to get the count 0 ,only if there are no existing values present in the rating table
for the particular value of usn
*********

*/

/*

*************
this fetches the admon and semsec from student table in database
*************

*/


     $query = "SELECT count(*) as c FROM teaching where semsec='$semsec' and admin='$admin'"; 
     $row=0;

    // Execute the query and store the result set 
    $result = mysqli_query($conn, $query); 
      if($result->num_rows>0)
      {
        while ($r=$result->fetch_assoc()) 
        {
            $row=$r['c'];
        }
      }

$counting=0;

$j=11;
/*
*********
this get the value in each and every row and the cell of the table for the particular 
empid and also the marks associated with that empid and that student 
*********
*/
$row=(int)$row;
$zx=1000;
for($i=0;$i<$row;$i++){

//getting the values forcontents in table 
$em=$_POST[$i];
$q1=$_POST[$j++];
$q2=$_POST[$j++];
$q3=$_POST[$j++];
$q4=$_POST[$j++];
$q5=$_POST[$j++];
$subject = $_POST[$zx++];// fetches all the subject values from

//inserting the values fetched to the rating tables 
$sql="insert into rating(empid,usn,q1,q2,q3,q4,q5,admin,semsec,subject)
 values('$em','$usn','$q1','$q2','$q3','$q4','$q5','$admin','$semsec','$subject')";
$res=mysqli_query($conn,$sql);


if(!$res )
{
   
    echo "<script>alert('Not Successfull')</script>";
    die();
}
$counting++;


  $j="$j"+6;

}//ending for loop


if($row==$counting){
    echo "<script>alert('Successfully recorded $row record for feedback,Thank you')</script>";
}
else{
  echo "<script>alert('Error in recording feedback')</script>";
}


// checking whether number of rows are equl to the $i 
//if $i and the $rows values are same then every values were inserted successfully
//else there was something error in inserrting

$conn->close();
//checks whether every values were inserted to the rating table successfully or not
}
}
//ending if,for if(number of records in rating for that particular usn == zero)

//if already 
else{

echo "<script>


document.getElementById('dis').style.display='none';

  </script>";


echo "
<div style='text-align:center'>

<h1 style='margin-botttom:5px'>you have already submited the feedback</h1>

<h1 style='margin-botttom:5px'>Your feedback are valueable</h1>
<h1 style='margin-botttom:5px'> Thank you, You can Logout</h1>

</div>
"

  ;
$conn->close();
}


?>


 <style>
      table,tr,th,td{
          border: 1px solid transparent;
          border-collapse: collapse;
      }
        
        input{
            width: 100%;
            height: 100%;
        }
        
    select{
      width: 100%;
      height: 100%;
      border: 0;
    }

table{
  margin-left: 10%;
  width: 80%;
  margin-right: 10%;
  margin-top: 2%;
}
td,input{
  text-align: center;
}

.me tr:nth-child(1)
    {
        background:  #84E184;
    }
    
span{
  font-size: 20px;
}


    </style>