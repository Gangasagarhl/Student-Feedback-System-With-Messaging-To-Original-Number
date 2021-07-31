
<html>
<head>
	<title>inserting the question through admin</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 

</head>
<body>

<div class="login-box" id="di">
<h1>Insert Questions</h1>
<form method="POST">
<p>Question 1</p>	
<input type="text" name="1" placeholder="question 1 " required>
<p>Question 2</p>
<input type="text" name="2" placeholder="question 2 " required>
<p>Question 3</p>
<input type="text" name="3" placeholder="question 3 " required>
<p>Question 4</p>
<input type="text" name="4" placeholder="question 4 " required>
<p>Question 5</p>
<input type="text" name="5" placeholder="question 5 " required><br><br>
<input type="submit" name="s"  style="padding: 5px" value="Insert Questions">

<br><br>

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
if (isset($_POST['s'])) {
	 
    $s="localhost";
    $u="root";
    $p="";
    $dbname="wtc_project";
    $conn=mysqli_connect($s,$u,$p,$dbname);



	$q1=$_POST['1'];
    $q2=$_POST['2'];
    $q3=$_POST['3'];
    $q4=$_POST['4'];
    $q5=$_POST['5'];

    $u=$_GET['u'];
$cnt=-1;
    $sql="select count(*) as c from question where admin='$u'";
    $res=mysqli_query($conn,$sql);

    if ($res->num_rows>0){
 
while ($row=$res->fetch_assoc()) {
	# code...
$cnt=$row['c'];


}

    }

$cnt = (int)$cnt;


if($cnt==0)
{

    $sql="insert into question values('$q1','$q2','$q3','$q4','$q5','$u')";
    $res=mysqli_query($conn,$sql);
   
    if($res)
    {
    	echo "<script>alert('inserted the questions successfully')</script>";
    }
    else 
    {
    	echo "<script>alert('Non successfull insertion')</script>".mysqli_error($conn);
    }
}

else
{
  echo "<script>alert('You are now updating the values in question')</script>";

  $sql="update question set  q1='$q1',q2='$q2',q3='$q3',q4='$q4',q5='$q5' where admin='$u'";
      $res=mysqli_query($conn,$sql);
      if($res){
      	echo "<script>alert('inserted the questions successfully')</script>";
      }
      else 
      {
      	echo "<script>alert('Non successfull insertion')</script>".mysqli_error($conn);
      }
}

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
    background: url(img/question-mark-2492009_1280.jpg);
    background-size: cover;
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
  from {display: none;
    width: 0px;
height: 200%;}
  to {

    width:  100%;
height: 100%}
}

 </style>