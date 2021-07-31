<html>
    <head>
      <link rel="stylesheet" href="http://maxcd.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
                <script src="https://kit.fontawesome.com/7de9c8aa22.js" crossorigin="anonymous"></script>
   
    </head>
<body>
   

  
        <div style="background-color:black;color:white ;height: 30px">

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

 //for main header block in black
 $usn='1sge01';
    
 $sql="select fname,lname from employee where empid='$usn'";

$res=mysqli_query($conn,$sql);

if($res->num_rows>0){
    while($rows=$res->fetch_assoc()){
        echo $rows['fname']." ".$rows['lname'];
    }
}



$conn->close();
?>


</span>

<span><a href="index.php" style="text-decoration:none
;margin-left:70%;color:white">Logout<span style="color: transparent;">ii</span><i class="fas fa-sign-out-alt"></i></a></span>


</div>
<br>
<br>
        
    




    <!--used inrder  to place the infromation in the form of tables
and this will inform you regarding the  employee results-->
<div>
    <table class="me">

        <?php
        //credentials
        $host="localhost";
        $dbusername="root";
        $dbpassword="";
        $dbname="wtc_project";
        $conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname);
           
        



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

    $sql="select semsec as c  from teaching where empid='$user'";
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

    */

        $sql1="select e.fname as n1 ,e.lname as n2,t.subject as sub,
        t.semsec as sem, t.empid as emp, count(distinct(r.usn)) as cnt 
        from employee e,teaching t,rating r 
        where t.empid='$empid' AND e.empid='$empid' and t.semsec='$sem' and t.semsec=r.semsec and r.empid='$empid'";
        $res1=mysqli_query($conn,$sql1);

        if($res1->num_rows>0)
        {
            $arr=array();

            while($rows1=$res1->fetch_assoc())
            {
        
                $arr['n1']=$rows1['n1'];
                $arr['n2']=$rows1['n2'];
                $arr['sub']=$rows1['sub'];
                $arr['sem']=$rows1['sem'];
                $arr['emp']=$rows1['emp'];
                $arr['cnt']=$rows1['cnt'];
            }
        }

        /*else
        {
             echo"<script>alert('There were no records found to the particular condition on database');
            </script>";

        }*/

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
        )";


        $res2=mysqli_query($conn,$sql2);

        if($res2->num_rows>0)
        {   
            $arr=array();
            while($rows2=$res2->fetch_assoc())
            {   
                // extracting sum and average of all feeddback given to employee by students for each question
                $arr['s1']=$rows2['s1'];    $arr['a1']=$rows2['a1'];
                $arr['s2']=$rows2['s2'];    $arr['a2']=$rows2['a2'];
                $arr['s3']=$rows2['s3'];    $arr['a3']=$rows2['a3'];
                $arr['s4']=$rows2['s4'];    $arr['a4']=$rows2['a4'];
                $arr['s5']=$rows2['s5'];    $arr['a5']=$rows2['a5'];
               
                
                $arr['total']=$rows2['total'];// extracting  overall sum
                $arr['percent']=$rows2['percent'];// extracting and average
                $arr['cmnt']=$rows2['comments'];// extracting generated comments
               
            }
        
        }

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
$user='1sge01'; 
#$cn=counting_semsec_handling_by_user($conn,$user);
//This fetches admin of employee or user
$admin=fetch_admin_of_employee_user($conn,$user);
//This fetches question array in numerical format 
$question = fetching_questions($conn,$admin);
//This fetches semsec in which employee works 
$semsec_employee=extracting_semsec_for_employee($conn,$user);




for($i=0;$i<count($semsec_employee); $i+=1)
{
    $sem = $semsec_employee[$i];
    $sum_average_feedback_with_comments = sum_average_feedback_with_comments($conn,$admin,$user,$sem);
    $cerdentials_extraction_for_employee = cerdentials_extraction_for_employee($conn,$user,$sem);
    $fetching_questions =  fetching_questions($conn,$admin);

    //template generation
    template_generation($conn,$sum_average_feedback_with_comments,$cerdentials_extraction_for_employee,$fetching_questions,$sem);

}



//if that employee teaching only one section then using sem and section is valid ,else 
//give for the sections 

?>
    </table>

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
th,td:hover{}

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


    .me tr:nth-child(4)
    {
        background: ;
    }
     .me tr:nth-child(5)
    {
        background:#F5F5F5;
    }
     .me tr:nth-child(6)
    {
        background: ;
    }
     .me tr:nth-child(7)
    {
        background: #F5F5F5;
    }
     .me tr:nth-child(8)
    {
        background: ;
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


    .me tr:nth-child(17)
    {
        background: ;
    }
     .me tr:nth-child(18)
    {
        background:#F5F5F5;
    }
     .me tr:nth-child(19)
    {
        background: ;
    }
     .me tr:nth-child(20)
    {
        background: #F5F5F5;
    }
     .me tr:nth-child(21)
    {
        background: ;
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

span{
  font-size: 20px;
}




        </style>