<html>
<head>

         <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
         <title>Index Page</title>
    <style type="text/css">
      section{

        background-repeat: no-repeat;
        background-size: 100% 100%;
        border: 0.09px solid ;
        border-color: #0AFD43;
        border-radius: 5px;

      }
a{
  margin-top:50% ;
  text-align: center;
  text-decoration: none;
  font-size: 40%;
}

h1{
  text-align: center;
  margin-top: 35%;
  font-size: 990%;
  color:#0fd7e7;

}

    </style>


     </head>

<!--**********************************************************
  body has the background sliding image
**************************************************************-->
      <body class="container">
        
       
<!--used in order to create screening effect-->
        <div style="background:rgba(0,0,0,0.7);width: 100%;height: 100%" >

              
<!--heading lines are mentioned here-->
               <div> 
<span style="margin-left:23%;font-size: 60px;color:white; text-align:center;margin-right: 20%;color:#0B5C92"> Sapthagiri &nbsp; College &nbsp; Of &nbsp; Engineering </span>
 <span style="margin-left:43%;font-size: 30px;color:white; text-align:center;color:#AC0618">Creating  &nbsp; Tomorrow</span><br><br><br><br><br>

      <span style="margin-left:26%;font-size: 50px;color:white; text-align:center;color:#8FE96B"> Welcome  &nbsp; To &nbsp; Faculty &nbsp; Feedback &nbsp;System </span>


               </div>



<!--this a-->
               <div style="margin-top: 10%">
              
              <!--getting a section for admin login-->
        <div >      
              
            <a href="admin.php">
              <section style="background-image: url(img/d3.jpg);width: 20%;height: 25%;float: left;margin-left: 10%;opacity: 0.9">
              <div style="width: 100%;height: 100% ; ">
                 <h1 style="margin-top:20%">Admin</h1>
              </div>
              </section >
            </a>
            
             



              <!--getting a section for Faculty login-->

              <a href="faculty.php ">
              <section style="background-image: url(img/image.jpg);width: 20%;height: 25%; float: left;margin-left: 10%">
              <div style="width: 100%;height: 100%">
              <h1 style="margin-top:20%">Faculty</h1>
              </div>
              </section>
            </a>





              <!--getting a section for Student login-->
              
              <a href="student.php">
              <section style="background-image: url(img/d1.jpg);width: 20%;height: 25%;float: left ;margin-left: 3% ;margin-left:10% " >
              <div style="width: 100%;height: 100%">
                 <h1 style="margin-top:20%">Student</h1>
              </div>
              </section>
            
              </a>



          </div>
               </div>
             
        </div>
      </body>





<style>
body
{
  margin:0;
  padding:0;
  height:100%;
  width:100%;
}


.container
{
height:100%;
width: 100%;

background-size:cover;
background-position:center; 
background-repeat: repeat;
transition: 5s;

animation-name: animate;
animation-direction: alternate-reverse;
animation-duration: 15s ;
animation-fill-mode: forwards; ;
animation-iteration-count: infinite;
animation-play-state: running;
animation-timing-function: ease-in;
}


@keyframes animate
{
 
  0%
  {
    background-image: url(img/download.jpg);
   
  }
  20%
  {
    background-image: url(img/images.jpg);
  }
  40%
  {
    background-image: url(img/img2.jpg);
  }
  60%
  {
    background-image: url(img/img3.jpg);
  }
  80%
  {
  	background-image: url(img/img06.jpeg);
  }
  100%
  {
  	background-image: url(img/img08.jpg);
  }

  
  }

</style>



</html>


