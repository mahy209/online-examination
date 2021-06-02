<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>EXAMIA</title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>

  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
 	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

<script>
$(function () {
    $(document).on( 'scroll', function(){
        console.log('scroll top : ' + $(window).scrollTop());
        if($(window).scrollTop()>=$(".logo").height())
        {
             $(".navbar").addClass("navbar-fixed-top");
        }

        if($(window).scrollTop()<$(".logo").height())
        {
             $(".navbar").removeClass("navbar-fixed-top");
        }
    });
});</script>
</head>

<body  style="background:#eee;">
<div class="header">
<div class="row">
<div class="col-lg-6" style="padding: 14px 16px;">
<span class="logo">EXAMIA</span></div>
<?php
 include_once 'dbConnection.php';
session_start();
$email=$_SESSION['email'];
  if(!(isset($_SESSION['email']))){
header("location:index.php");

}
else
{
$name = $_SESSION['email'];

include_once 'dbConnection.php';
echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="account.php" class="log log1">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
}?>

</div></div>
<!-- admin start-->

<!--navigation menu-->
<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dash.php?q=0"><b>Dashboard</b></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="dash.php?q=0">Home<span class="sr-only">(current)</span></a></li>
        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="dash.php?q=1">Students</a></li>
		<li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="dash.php?q=2">Ranking</a></li>
    <li><a href="dash.php?q=4">Add Exam</a></li>
		
        </li><li class="pull-right"> <a href="logout.php?q=account.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Sign out</a></li>
		
      </ul>
          </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--navigation menu closed-->
<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">
<!--home start-->

<?php if(@$_GET['q']==0) {

$result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
  $eid= $row['eid'];
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
  $time = $row['time'];
	$eid = $row['eid'];
$q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
$rowcount=mysqli_num_rows($q12);	

	echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
  .<td><a href="dash.php?delete='.$eid.'"class="pull-right btn sub1" style="margin:0px;background:#1791b1><span class="glyphicon glyphicon-new-window" aria-hidden="true" style="color:white;"></span>"</span>&nbsp;<span class="title1" style="color:white;"><i class="bi bi-trash"></i>Delete</a></td></tr>';
}
$c=0;
echo '</table></div></div>';

}
if(isset($_GET['delete'])){
  $id=$_GET['delete'];

  $q=mysqli_query($con,"DELETE FROM `quiz` WHERE  eid ='$id' " );
}

//ranking start
if(@$_GET['q']== 2) 
{
$q=mysqli_query($con,"SELECT * FROM rank  ORDER BY score DESC " )or die('Error223');
echo  '<div class="panel title"><div class="table-responsive">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>Rank</b></td><td><b>Name</b></td><td><b>Gender</b></td><td><b>College</b></td><td><b>Score</b></td></tr>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$e=$row['email'];
$s=$row['score'];
$q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
while($row=mysqli_fetch_array($q12) )
{
$name=$row['name'];
$dep=$row['dep'];
$level=$row['level'];
}
$c++;
echo '<tr><td style="color:#1791b1"><b>'.$c.'</b></td><td>'.$name.'</td><td>'.$dep.'</td><td>'.$level.'</td><td>'.$s.'</td><td>';
}
echo '</table></div></div>';}

?>


<!--home closed-->
<!--users start-->
<?php if(@$_GET['q']==1) {

$result = mysqli_query($con,"SELECT * FROM user") or die('Error');
echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Name</b></td><td><b>department</b></td><td><b>level</b></td><td><b>Email</b></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$name = $row['name'];
	$dep = $row['dep'];
  $email = $row['email'];
	$level = $row['level'];

	echo '<tr><td>'.$c++.'</td><td>'.$name.'</td><td>'.$dep.'</td><td>'.$level.'</td><td>'.$email.'</td>
	<td><a title="Delete User" href="update.php?demail='.$email.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
}
$c=0;
echo '</table></div></div>';

}?>
<!--user end-->

<!--feedback reading portion start-->
<?php if(@$_GET['fid']) {
echo '<br />';
$id=@$_GET['fid'];
$result = mysqli_query($con,"SELECT * FROM feedback WHERE id='$id' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$name = $row['name'];
	$subject = $row['subject'];
	$date = $row['date'];
	$date= date("d-m-Y",strtotime($date));
	$time = $row['time'];
	$feedback = $row['feedback'];
	
echo '<div class="panel"<a title="Back to Archive" href="update.php?q1=2"><b><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span></b></a><h2 style="text-align:center; margin-top:-15px;font-family: "Ubuntu", sans-serif;"><b>'.$subject.'</b></h1>';
 echo '<div class="mCustomScrollbar" data-mcs-theme="dark" style="margin-left:10px;margin-right:10px; max-height:450px; line-height:35px;padding:5px;"><span style="line-height:35px;padding:5px;">-&nbsp;<b>DATE:</b>&nbsp;'.$date.'</span>
<span style="line-height:35px;padding:5px;">&nbsp;<b>Time:</b>&nbsp;'.$time.'</span><span style="line-height:35px;padding:5px;">&nbsp;<b>By:</b>&nbsp;'.$name.'</span><br />'.$feedback.'</div></div>';}
}?>
<!--Feedback reading portion closed-->

<!--add exam start-->
<?php
if(@$_GET['q']==4 && !(@$_GET['step']) ) {
  echo ' 
  <div class="row">
  <span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Exam Details</b></span><br /><br />
   <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action="update.php?q=addquiz"  method="POST">
  <fieldset>
  
  
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="name"></label>  
    <div class="col-md-12">
    <input id="name" name="name" placeholder="Enter subject name" class="form-control input-md" type="text">
      
    </div>
  </div>

  <!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="diff_level"></label>
  <div class="col-md-12">
    <select id="diff_level" name="diff_level" placeholder="Enter diffulty level" class="form-control input-md" >
   <option >Select diffuclty level</option>
  <option value="easy">easy</option>
  <option value="intermediate">intermediate</option> 
  <option value="diffcult">diffcult</option>
  </select>
  </div>
</div>
  
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="total"></label>  
    <div class="col-md-12">
    <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number">
      
    </div>
  </div>
  
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="sahi"></label>  
    <div class="col-md-12">
    <input id="right" name="right" placeholder="Enter marks for each question" class="form-control input-md" min="0" type="number">
      
    </div>
  </div>
  
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="wrong"></label>
    <div class="col-md-12">
    <input id="wrong" name="wrong" placeholder="Enter minus marks on wrong answer" class="form-control input-md" min="0" type="number">
      
    </div>
  </div>
  
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="time"></label>  
    <div class="col-md-12">
    <input id="time" name="time" placeholder="Enter time limit for test in minute" class="form-control input-md" min="1" type="number">
      
    </div>
  </div>
  
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="tag"></label>  
    <div class="col-md-12">
    <input id="tag" name="tag" placeholder="Enter #tag which is used for searching" class="form-control input-md" type="text">
      
    </div>
  </div>
  
  
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="desc"></label>  
    <div class="col-md-12">
    <textarea rows="8" cols="8" name="desc" class="form-control" placeholder="Write description here..."></textarea>  
    </div>
  </div>

<div class="row">
    <div class="col-md-offset-2 col-md-8">
<h2>Set New Timer</h2>
<form action="" method="post">
<div class="col-sm-3">
                <label for="min" >mintues</label>
                <input type="digit" class="form-control input-group-lg reg_name" name="min" placeholder="min" Required>
            </div>
<div class="col-sm-3">
                <label for="second" >Seconds</label>
                <input type="digit" class="form-control input-group-lg reg_name" name="sec" placeholder="Sec" Required>
            </div><br>

<form>
</div></div>


<div class="form-group">
  <label class="col-md-12 control-labe"l" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" name="addquiz" style="margin-left:45%" class="btn btn-primary btn-lg" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';
}
?>
<?php
// if(isset($_POST['addquiz'])){
// @$min = $_POST['min'];
// @$sec = $_POST['sec'];
// $timer = $min.':'.$sec;
// $fetchqry3 = "UPDATE `quiz` SET `time`='$timer' WHERE`id`=1";
// $result3 = mysqli_query($con,$fetchqry3);
// if($result3==TRUE){
// 	echo "The timer currently set to $timer";
// }
// }
?>


<!--add exam end-->

<!--add exam step2 start-->
<?php
if(@$_GET['q']==4 && (@$_GET['step'])==2 ) {
echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="update.php?q=addqns&n='.@$_GET['n'].'&eid='.@$_GET['eid'].'&ch=4 "  method="POST">
<fieldset>
';
 
 for($i=1;$i<=@$_GET['n'];$i++)
 {
echo '<b>Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..."></textarea>  
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'1"></label>  
  <div class="col-md-12">
  <input id="'.$i.'1" name="'.$i.'1" placeholder="Enter option a" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'2"></label>  
  <div class="col-md-12">
  <input id="'.$i.'2" name="'.$i.'2" placeholder="Enter option b" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'3"></label>  
  <div class="col-md-12">
  <input id="'.$i.'3" name="'.$i.'3" placeholder="Enter option c" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'4"></label>  
  <div class="col-md-12">
  <input id="'.$i.'4" name="'.$i.'4" placeholder="Enter option d" class="form-control input-md" type="text">
    
  </div>
</div>
<br />
<b>Correct answer</b>:<br />
<select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="form-control input-md" >
   <option value="a">Select answer for question '.$i.'</option>
  <option value="a">option a</option>
  <option value="b">option b</option>
  <option value="c">option c</option>
  <option value="d">option d</option> </select><br /><br />'; 
 }
    
echo '<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';
}
?>
<!--add exam step 2 end-->
</div><!--container closed-->
</div></div>
</body>
</html>
