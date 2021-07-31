<?php 

echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hi Hello How are you?
</body>
</html>

';

// credentials to connect to backend
$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="wtc_project";
$GLOBALS['conn']=mysqli_connect($host,$dbusername,$dbpassword,$dbname) ;

//extracting admin value from the header
$GLOBALS['admin']=$_GET['u'];
$GLOBALS['time']=$_GET['time']
#$time = $_GET['time'];
$GLOBALS['sent']=$_GET['sent'];


//this fetches question updated by admin
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


//extracts the semsec handled b an employee, which are unique in nature.
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

// Extracting the subjects 
function extracting_subject_for_employee($conn,$user,$semsec)
{

    $sql="select distinct(subject) as c from teaching where empid='$user' and semsec='$semsec'";
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

// extracts the subject and number of student gave feedback to employee
function extracting_subjects_distinct_student_count_rated_to_employee($conn,$admin,$semsec,$empid)
{
    $sql = "select DISTINCT subject as sub,count(usn) as cnt FROM rating where empid = '$empid' and admin='$admin' and semsec='$semsec' GROUP BY subject";
    $res = mysqli_query($conn,$sql);
    $arr=array();
    $i=0;
    if($res->num_rows>0)
    {
        while($ro = $res->fetch_assoc())
        {
            $arr[$i][0] = $ro['sub'];
            $arr[$i][1] = $ro['cnt'];
            $i++;
        }

    }

    return $arr;
}


// returns unique employee id and phone for admin
function unique_empid_phone($conn,$admin)
{
	$sql = "SELECT distinct empid,Phone_Number from employee where admin='$admin'";
	$res=mysqli_query($conn,$sql);
  if($res->num_rows>0)
	{
    $empid_arr = array();
	$phone_arr=array();
	$count_semsec=array();
		$i=0;

		while($rows=$res->fetch_assoc())
		{  
			$empid_arr[$i] =  $rows['empid'] ;
			$phone_arr[$i] = $rows['Phone_Number'];
			#$count_semsec[$i] = counting_semsec_handling_by_user($conn, $rows['empid']); 
			
			$i+=1;
		}

	  // This is for summarising or combining all to an array	
	  $empid_phone=array
	  (
		$empid_arr,
		$phone_arr,
		#$count_semsec,

	  );
		return $empid_phone;
	}
}



//message sending
function sending_messge($message,$mobile_number)
{
    
	$fields = array
	(
		"sender_id" => "SCE",
		"message" => $message,
		"language" => "english",
		"route" => "p",
		"numbers" => $mobile_number,
	);

	$curl = curl_init();

	curl_setopt_array
	( $curl, array
		(
			CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($fields),
			CURLOPT_HTTPHEADER => array
			(
				"authorization:gHJHpdb7F2Jt018dm3H5wfC1k6eTj3IlfGPe64ntTXS6rnMvLidSWPQ4NDw",
				"accept: */*",
				"cache-control: no-cache",
				"content-type: application/json"
			),
		)
	);

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

    // message not sent
	if ($err) 
	{
		echo "cURL Error #:" . $err;
    } //messsage sent successsfully
    else 
	{   echo $message ;
		echo $response;
	}

}



//extracting average of employee
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

        // to produce for loop index values 
        $GLOBALS['count_with_avg']=$m;

        //print("<br><br>sum avearge with comments:<br>");
        //print($arr[0]['s1']);
        //print_r(array_count_values($arr[0]));

        //print("<br>sum avearge with comments:<br>");
        //print_r(array_count_values($arr[1]));

       

        return $arr;

}
/*
*****************************Message Body******************************
Empid:Value
(Ques) 1)Value 2)Value 3)Value ...   so on untill question is found.

%%%%%%%%%%% Repetitive  %%%%%%%%%%
Class:Value   Stdnt:Value   Sub:SAN  {Res}: 
1.Avg-Value  2.Avg-Value  3.Avg-Value .... so on untill quetion is found
Overall Percentage: Value.
%%%%%%%%%%% Repetitive  %%%%%%%%%%
%%%%%%%%%%% Repetitive  %%%%%%%%%%
Class:Value   Stdnt:Value   Sub:SAN  {Res}: 
1.Avg-Value  2.Avg-Value  3.Avg-Value .... so on untill quetion is found
Overall Percentage: Value.
%%%%%%%%%%% Repetitive  %%%%%%%%%%
..
..
..
The repetitive content moves untill the number of class he handles

*************************End Of Message Body ******************************

This is format how message will be sent to particuar number of particular employee.
*/

function preparing_and_send_message($conn,$admin,$time)
{
    $main_msg="";
    $concatenating_msg ="";
    $near_intermediate="";
    $average_result="";
    $mobile_number="";

    $all_employee_for_an_admin = unique_empid_phone($conn,$admin);
    $questions_by_admin = fetching_questions($conn,$admin);
    $count=1; /* the no. of messages to be sent, starting from i-1th empid to (i-1+count)th empid*/
    
    //concatenating questions to a message format
    //questions in message format: 1.Question_value, ......  
    $question_count = count($questions_by_admin);
    


    //this prepares the message for each and every employee, from the index-1 given in loop
    for($i=4;$i<count($all_employee_for_an_admin[0]);$i+=1)
    {   
        $concatenating_msg="";//temporary
        $empid = $all_employee_for_an_admin[0][$i];// only one particular empid
        $mobile_number = $all_employee_for_an_admin[1][$i];//Respective phone number of empid
        $semec_of_employee = extracting_semsec_for_employee($conn,$empid);//Extracts the semsec of a particular employee

        // concatenating question to message 
        for($j=0; $j<$question_count; $j+=1)
        $main_msg = $main_msg." ".($j+1) . "." . $questions_by_admin[$j];

        //attaching the header, fixed message part to main message
        $main_msg = " Empid:".$empid."  #Ques#: ".$main_msg."  ";



        //This extracts semsec of employee(Ex: FOR 1SGE04)
        for($k=0;$k < count($semec_of_employee); $k+=1)
        {
            $semsec = $semec_of_employee[$k];//semsec of employee
            #$number_of_students_given_feedback = number_of_students_given_feedback_to_an_employee($conn,$empid,$semsec);
            $average_extraction = sum_average_feedback_with_comments($conn,$admin,$empid,$semsec);// rating 1 to 10 to the question
            #$subject_handling_by_employee_in_semsec = extracting_subject_for_employee($conn,$empid,$semsec);
            $subjects_and_count_rated = extracting_subjects_distinct_student_count_rated_to_employee($conn,$admin,$semsec,$empid);

            
            //inner message to remove redundancy of code 
            $average_result="";
            
            //This is used for accessing the number of subjects handled by employee in each semester
            for($zk=0; $zk < count($subjects_and_count_rated); $zk++)
            {

                for($l=0; $l<$question_count; $l+=1)
                {   $associative_index = "a".($l+1);
                    $average_result = $average_result." ".($l+1).")".$average_extraction[$zk][$associative_index].'  ';
                }

                $average_result = $average_result."  Overall Percent: ".$average_extraction[$zk]['percent'] ; 

                //intermediate message to remove redundancy of code
                
                
                $concatenating_msg = $concatenating_msg."       Cls:" .$semsec . "   Stu:".$subjects_and_count_rated[$zk][1]."  Sub:".$subjects_and_count_rated[$zk][0]."  ";
                $average_result='   {RES}:'.$average_result."   " ;
                $concatenating_msg = $concatenating_msg.$average_result."********";
                $near_intermediate = $near_intermediate.$concatenating_msg ;
                $average_result="";
                $concatenating_msg="";
                
                
            }//closing loop for number of subjects in each class

                
            

        }// closed for loo to each semsec of employee
        //final message
        $main_msg = $main_msg. $near_intermediate;
        $near_intermediate ="";

    
    

        $message =$main_msg;
        #$mobile_number ='9035471539';
        #$api_key = "0K73zE2MYSWGcOmb5L8kd6CQxP4jeIJgAvqy1XhoiuU9ZnBNtDmfJbIF73nah5ld6kKWjHgBOViPR1zZ";
        #sending_messge($message,$mobile_number);


        echo($message);
        print("<br><br>");

        $main_msg="";

        if($count >= 1)
            {
                break;
            }// end for if, used for controlled message sending

        $count++;

    }//closing for loop for each different employee

    
    //updating sent to "Y",to inform already message sent
    $updating_status = "update admin  set sent='Y' where user='$admin' ";
    $res=mysqli_query($conn,$updating_status);

    //redirecting to admin_work.php
   /*  if($res)
    {
        header("location:admin_work.php?u=".$admin."&time=".$time."&sent=Y");
    }

   else
    {
        echo("Unable to Set feed_status,check properly,Check the connection Properly.");
    } */  

    header("location:admin_work.php?u=".$admin."&time=".$time."&sent=Y");
    
}//closed for function
preparing_and_send_message($conn,$admin,$time);


?>