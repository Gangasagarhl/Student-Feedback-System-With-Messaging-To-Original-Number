<html>
    <head>
      <link rel="stylesheet" href="http://maxcd.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
                <script src="https://kit.fontawesome.com/7de9c8aa22.js" crossorigin="anonymous"></script>
   
    </head>

<body >

   

   <!-- This divison for header bar -->
   <div style="background-color:black;color:white ;height: 30px">
    <span>Hi,</span>&nbsp;&nbsp;
    <span>Welcome </span>&nbsp;&nbsp;&nbsp;

<!--To display name in header bar-->   
<span>

<?php
 $host="localhost";
 $dbusername="root";
 $dbpassword="";
 $dbname="wtc_project";
 $conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname);

 //for main header block in black
 $GLOBALS['usn'] = $_GET['u'];

//extracing credentials of employee
 function extracting_credentials($conn,$usn)
 {
        $sql="select fname,lname,admin from employee where empid='$usn'";
        $res=mysqli_query($conn,$sql);
        if($res->num_rows>0)
        {
            while($rows=$res->fetch_assoc())
            {
                $GLOBALS['fname'] = $rows['fname'];
                $GLOBALS['lname'] = $rows['lname'];
                $GLOBALS['admin'] = $rows['admin'];
            }
        }

  }
  extracting_credentials($conn,$usn);


echo $fname." ".$lname;

$conn->close();
?>


</span>

<span>
    <a href="index.php" style="text-decoration:none;margin-left:60%;color:white">
        Logout &nbsp;
        <i class="fas fa-sign-out-alt"></i>
    </a>
</span>


</div>

<div id="2" style="display:none">
        <center>
            <h1 style="font-size:40px;margin-top:20%">
                Please Be Patient!!! <br>
                Feedback is going on.
            </h1>
        </center>
    </div>

   <div id="1">
<br>
<br>
        
    
<!--used inrder  to place the infromation in the form of tables
and this will inform you regarding the  employee results-->

<!--used generate a pdf after click of button-->
<input type="button" id="btnExport" value="Print PDF" style='background-color: #b30000;color:white;border-radius:10px;width=80%;font-size:20px;margin-left:93%' />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", "#btnExport", function () {
            html2canvas($('#tab')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("faculty-results.pdf");
                }
            });
        });
    </script>

<div id="tab"> 



    <table class="me" style='margin-top:5%'>
    <img src="img/logo.jpg" style='width:110px;height:100px;padding-left:270px'>
    <p><Center><h2 style='color:#ff0000;margin-top:-7%'> SAPTHAGIRI COLLEGE OF ENGINEERING </h2>
              <h4 style='color:#3498DB;margin-top:-1%'> (Affiliated to Visvesvaraya Technological University, Belagavi & Approved by AICTE, New Delhi) </h4>
              <h5 style='margin-top:-0.8%'>#14/5, Chikkasandra, Hesaraghatta Main Road, Bengaluru– 560 057. <br>
                     Web: www.sapthagiri.edu.in, Email: principal@sapthagiri.edu.in<br>
                            Phone:080-28 372800/1/2     Fax: 080-28 372797 </h5> 
              
<br> 
  

        <?php
        //credentials
        $host="localhost";
        $dbusername="root";
        $dbpassword="";
        $dbname="wtc_project";
        $conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname);

        if($GLOBALS['admin']=='CSE')
        {
            $department = 'Department of Computer Science & Engineering';
            
            
        }
        
         else if($GLOBALS['admin']=='MEC')
        {
            $department = 'Department of Mechanical Engineering';
        }
        echo "<h2 style='color: #C70039;margin-top:-2%'>  $department </h2>";


        //return the count of rows with employee.
        function counting($table,$conn,$admin)
        {
           
             $check_number_of_rating = "SELECT COUNT(*) as cnt FROM '$table' WHERE admin='$admin'";
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

           
        

        function check_to_display($conn,$admin)
        {
        
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
            if($feed_status != 'N') // condition agrees when Y;   N,Y,F
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

//used in order to fetch the  count semsec value from teaching table

function counting_semsec_handling_by_user($conn,$user):int
{
	$sql="select count(semsec) as c  from teaching where empid='$user'";
	$res=mysqli_query($conn,$sql);

	$cn="";
	if($res->num_rows>0)
	{
		while ($ro=$res->fetch_assoc()) 
		{
			$cn=$ro['c'];
		}
	}
	return $cn;
}



// This gets all the sem sec that an employee is working on.
function extracting_semsec_for_employee($conn,$user)
{

    $sql="select distinct(semsec) as c  from teaching where empid='$user'";
	$res=mysqli_query($conn,$sql);

	if($res->num_rows>0)
    {   $arr=array();
        $i=0;
		while ($ro=$res->fetch_assoc()) 
		{   
            $arr[$i]=$ro['c'];
			$i+=1;
		}
    }
    
	return $arr;    


}

function extracting_subject_for_employee($conn,$user)
{

    $sql="select distinct(subject) as c from teaching where empid='$user'";
	$res=mysqli_query($conn,$sql);

	if($res->num_rows>0)
    {   $arr=array();
        $i=0;
		while ($ro=$res->fetch_assoc()) 
		{   
            $arr[$i]=$ro['c'];
			$i+=1;
		}
    }
    
	return $arr;    


}

function counting_sum_of_all_semsec_handled_by_employee($conn,$user)
{
    $sql = "select count(distinct semsec,subject) as count from teaching where empid='$user'";
    $res=mysqli_query($conn,$sql);
    $count = 0;

	if($res->num_rows>0)
    {   
        while ($ro=$res->fetch_assoc()) 
		{   
            $count = $ro['count'];
			
		}
    }
    $count = (int)$count;

	return $count;    
}






//used this ,inorder to fetch the admin        
function fetch_admin_of_employee_user($conn,$user)
{
    $admin="";
    $sql ="select admin from employee where empid='$user'";
    $res=mysqli_query($conn,$sql);

    if($res->num_rows>0)
    {
        while ($rows=$res->fetch_assoc()) 
        {
            $admin=$rows['admin'];
        }
    }
    return $admin;
}




//fetching the question, what admin posted
function fetching_questions($conn,$admin)
{
        $sql="select q1,q2,q3,q4,q5 from question where admin='$admin'";
        $res=mysqli_query($conn,$sql);
        $q1="";$q2="";$q3="";$q4="";$q5="";

        if($res->num_rows>0)
        {
            while($rows=$res->fetch_assoc())
            {

            $q1=$rows['q1'];
            $q2=$rows['q2'];
            $q3=$rows['q3'];
            $q4=$rows['q4'];
            $q5=$rows['q5'];
       

            }
        }
        $questions = array($q1,$q2,$q3,$q4,$q5);

        return $questions;
}

function cerdentials_extraction_for_employee($conn,$empid,$sem)
{

    /*
        $n1="";//first name
        $n2="";//last name
        $sub="";//subject they are teaching 
        $sem="";//semsec value
        $emp="";// empid
        $cnt="";// number of students given feedback
        
        #$empid="$user";
        #$sem="$s1";

   

        $sql1="select e.fname as n1 ,e.lname as n2,t.subject as sub,
        t.semsec as sem, t.empid as emp, count(distinct(r.usn)) as cnt 
        from employee e,teaching t,rating r 
        where t.empid='$empid' AND e.empid='$empid' and t.semsec='$sem' and t.semsec=r.semsec and r.empid='$empid'";
     */

        $sql1 = "select e.fname as n1 ,e.lname as n2,t.subject as sub,
        t.semsec as sem, t.empid as emp, count(distinct(r.usn)) as cnt 
        from employee e,teaching t,rating r 
        where t.empid='$empid' AND e.empid='$empid' and t.semsec='$sem' and t.semsec=r.semsec and r.empid='$empid'
        GROUP BY t.subject";
        
        $res1=mysqli_query($conn,$sql1);
        $arr=array();
        $m=0;
        if($res1->num_rows>0)
        {
            

            while($rows1=$res1->fetch_assoc())
            {
        
                $arr[$m]['n1']=$rows1['n1'];
                $arr[$m]['n2']=$rows1['n2'];
                $arr[$m]['sub']=$rows1['sub'];
                $arr[$m]['sem']=$rows1['sem'];
                $arr[$m]['emp']=$rows1['emp'];
                $arr[$m]['cnt']=$rows1['cnt'];                

                $m += 1;
            }
        }

        /*else
        {
             echo"<script>alert('There were no records found to the particular condition on database');
            </script>";

        }*/
        
       // print("<br><br>Extracting the credentials:<br>");
        //print_r(array_count_values($arr[0]));

        //print("<br>Extracting the credentials:<br>");
        //print_r(array_count_values($arr[1]));

        return $arr;

}

function sum_average_feedback_with_comments($conn,$admin,$user,$sem)
{

        $sql2="select sum(q1) as s1 ,avg(q1)*10 as a1, 
        sum(q2) as s2,avg(q2)*10 as a2 , 
        sum(q3) as s3 ,avg(q3)*10 as a3, 
        sum(q4) as s4,avg(q4)*10 as a4 , 
        sum(q5) as s5 ,avg(q5)*10 as a5, 
        (sum(q1)+sum(q2)+sum(q3)+sum(q4)+sum(q5)) as total, 
        ((avg(q1)+avg(q2)+avg(q3)+avg(q4)+avg(q5))/5)*10 as percent, 
        case 

        when ((avg(q1)+avg(q2)+avg(q3)+avg(q4)+avg(q5))/5)*10 >=90 
            then 'You Are Doing Great! Keep It Up ' 

        when (((avg(q1)+avg(q2)+avg(q3)+avg(q4)+avg(q5))/5)*10)>80 and (((avg(q1)+avg(q2)+avg(q3)+avg(q4)+avg(q5))/5)*10)<90 
        then 'Doing Good!,Get one Step Ahead' 

        else 'Improvisation is required' 
        end as comments 

        from rating 
        where admin='$admin' and empid='$user' and usn in ( 

        select distinct(usn) from rating where semsec='$sem'
        ) GROUP BY subject";

        $m = 0;
        $res2=mysqli_query($conn,$sql2);
        $arr=array();
        if($res2->num_rows>0)
        {   
            
            while($rows2=$res2->fetch_assoc())
            {   
                // extracting sum and average of all feeddback given to employee by students for each question
                $arr[$m]['s1']=$rows2['s1'];    $arr[$m]['a1']=$rows2['a1'];
                $arr[$m]['s2']=$rows2['s2'];    $arr[$m]['a2']=$rows2['a2'];
                $arr[$m]['s3']=$rows2['s3'];    $arr[$m]['a3']=$rows2['a3'];
                $arr[$m]['s4']=$rows2['s4'];    $arr[$m]['a4']=$rows2['a4'];
                $arr[$m]['s5']=$rows2['s5'];    $arr[$m]['a5']=$rows2['a5'];
               
                
                $arr[$m]['total']=$rows2['total'];// extracting  overall sum
                $arr[$m]['percent']=$rows2['percent'];// extracting and average
                $arr[$m]['cmnt']=$rows2['comments'];// extracting generated comments
                
                $m+=1;
               
            }
        
        }

        //print("<br><br>sum avearge with comments:<br>");
        //print($arr[0]['s1']);
        //print_r(array_count_values($arr[0]));

        //print("<br>sum avearge with comments:<br>");
        //print_r(array_count_values($arr[1]));

       

        return $arr;

}

function template_generation($conn,$sum_average_feedback_with_comments,$cerdentials_extraction_for_employee,$fetching_questions,$sem)
{       /*
            1.$sum_average_feedback_with_comments   has -> sum:s1,s2,s3,s4,s5     average:a1,a2,a3,a4,a5      overall:total,percent,comments 
            2.$cerdentials_extraction_for_employee  has -> n1,n2,sub,emp,cnt
            3.$fetching_questions   has-> $q1,$q2,$q3,$q4,$q5
        
        */
        $array1 = $sum_average_feedback_with_comments;
        $array2 = $cerdentials_extraction_for_employee;
        $question = $fetching_questions;

        echo "
        <tr><th  colspan='2' style='color:white'>Name:$array2[n1]" ."   "." $array2[n2]</th>
        <th style='color:white'>Subject :$array2[sub]</th></tr>"
        ."<tr><th style='color:white'>Sem & Sec :$sem</th>
        <th style='color:white'>Empid :$array2[emp]</th>
        <th style='color:white'>No.Of Students :$array2[cnt]</th>
        </tr> 
        
        <tr><td colspan=3><br><br></td></tr>
        
        <tr><th>Questions</th><th>Total</th><th>Percentage</th></tr>
        <tr>
        <th>$question[0]</th>  <td>$array1[s1]</td><td>$array1[a1]</td>
        
        </tr>

        <tr>
        <th>$question[1]</th>  <td>$array1[s2]</td><td>$array1[a2]</td>
        </tr>
        
        <tr>
        <th>$question[2]</th>  <td>$array1[s3]</td><td>$array1[a3]</td>
        </tr>
        
        <tr>
        <th>$question[3]</th>  <td>$array1[s4]</td><td>$array1[a4]</td>
        </tr>
        
        <tr>
        <th>$question[4]</th>  <td>$array1[s5]</td><td>$array1[a5]</td>
        </tr>
        
        <tr>
           
        </tr>

        <tr>
        <th></th>  <td>$array1[total]</td><td>$array1[percent]</td>
        
        </tr>

    <tr>
    <th><br>Comments:</th><th colspan='2'><br>$array1[cmnt]</th>

    </tr>
    <tr>
    <td><br><br></td>
    </tr>";

}


// minimum requirements to perform the functions well

//gets user or employee
$user=$_GET['u']; 
#$cn=counting_semsec_handling_by_user($conn,$user);
//This fetches admin of employee or user
$admin=fetch_admin_of_employee_user($conn,$user);
//This fetches question array in numerical format 
$question = fetching_questions($conn,$admin);
//This fetches semsec in which employee works 
$semsec_employee=extracting_semsec_for_employee($conn,$user);

// extracting the subjects of employee taught to different semsec
$subject_employee = extracting_subject_for_employee($conn,$user);
$count = counting_sum_of_all_semsec_handled_by_employee($conn,$user);


/*print("No of Subjects handled by employee:");
print(count($subject_employee));
print("No of Subjects handled by employee:");
print(count($semsec_employee));
*/
error_reporting(0);// to stop or preventing to print error on page.
$max=0;
for($i=0;$i<count($semsec_employee); $i+=1) # it runs for 4 times for 1SGE04, distinct is 2 times
{   
    $sem = $semsec_employee[$i];
    $cerdentials_extraction_for_employee = cerdentials_extraction_for_employee($conn,$user,$sem);
    $sum_average_feedback_with_comments = sum_average_feedback_with_comments($conn,$admin,$user,$sem);
    $fetching_questions =  fetching_questions($conn,$admin);

    
        for($j=0;$j<count($subject_employee);$j+=1)
        { $max +=1 ;
            //template generation
            if($max > $count)
            {
                break;
            }
           try
           {
                if($sum_average_feedback_with_comments[$j]  && $cerdentials_extraction_for_employee[$j])
                {
                    template_generation($conn,$sum_average_feedback_with_comments[$j],$cerdentials_extraction_for_employee[$j],$fetching_questions,$sem);
                }
            }
            catch(Exception $e)
            {
                //just to make it pass.
            }
        }
}




//if that employee teaching only one section then using sem and section is valid ,else 
//give for the sections 

?> 
</table>
</div>
</div>

<div id='exra' style="display:none">
</div>
</body>
</html>

 <style>
        table{
            width: 80%;
            margin-left: 10%;
            margin-right: 10%;
        }
        table,tr,th{
            border: 1px ;
            border-collapse: collapse;
            text-align: center;
            font-size: 20px;
        }

  .me tr:nth-child(1)
    {
        background:  #84E184;
    }
    .me tr:nth-child(2)
    {
        background: #84E184;
    }

.me tr:nth-child(3)
    {
        background: #F5F5F5;
    }

     .me tr:nth-child(5)
    {
        background:#F5F5F5;
    }

.me tr:nth-child(7)
    {
        background: #F5F5F5;
    }

.me tr:nth-child(9)
    {
        background: #F5F5F5;
    }
.me tr:nth-child(12)
    {
        background: #919bd7;
    }
.me tr:nth-child(14)
    {
        background:  #84E184;
    }
.me tr:nth-child(15)
    {
        background: #84E184;
    }
.me tr:nth-child(16)
    {
        background: #F5F5F5;
    }
.me tr:nth-child(18)
    {
        background:#F5F5F5;
    }
.me tr:nth-child(20)
    {
        background: #F5F5F5;
    }
.me tr:nth-child(22)
    {
        background: #F5F5F5;
    }
.me tr:nth-child(23)
    {
        background: #919bd7;
    }
.me tr:nth-child(25)
    {
        background: #919bd7;
    }


    .me tr:nth-child(27)
    {
        background:  #84E184;
    }
    .me tr:nth-child(28)
    {
        background: #84E184;
    }

.me tr:nth-child(29)
    {
        background: #F5F5F5;
    }

     .me tr:nth-child(31)
    {
        background:#F5F5F5;
    }

.me tr:nth-child(33)
    {
        background: #F5F5F5;
    }

.me tr:nth-child(35)
    {
        background: #F5F5F5;
    }
.me tr:nth-child(38)
    {
        background: #919bd7;
    }

    .me tr:nth-child(40)
    {
        background:  #84E184;
    }
    .me tr:nth-child(41)
    {
        background: #84E184;
    }

.me tr:nth-child(42)
    {
        background: #F5F5F5;
    }

     .me tr:nth-child(44)
    {
        background:#F5F5F5;
    }

.me tr:nth-child(46)
    {
        background: #F5F5F5;
    }

.me tr:nth-child(48)
    {
        background: #F5F5F5;
    }
.me tr:nth-child(51)
    {
        background: #919bd7;
    }






span{
  font-size: 20px;
    }
        </style>