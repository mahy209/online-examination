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
$name = $_SESSION['name'];

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
      <a class="navbar-brand" href="admin_dash.php?q=0"><b>Dashboard</b></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-left">
                    <li <?php if (@$_GET['q'] == 0) echo 'class="active"'; ?>><a href="admin_dash.php?q=0">Home<span class="sr-only">(current)</span></a></li>
                    <li <?php if (@$_GET['q'] == 20) echo 'class="active"'; ?>><a href="admin_dash.php?q=20">Professor</a></li>
                    <li <?php if (@$_GET['q'] == 2) echo 'class="active"'; ?>><a href="admin_dash.php?q=2">Subject</a></li>
                    <li class="dropdown <?php if (@$_GET['q'] == 4 || @$_GET['q'] == 5) echo 'active"'; ?>">
                    <li><a href="admin_dash.php?q=4">Add Department</a></li>
                    <li><a href="admin_dash.php?q=10">Add Subject</a></li>
                    <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="admin_dash.php?q=3"> students Feedback</a></li>
                </ul>
          </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--navigation menu closed-->
<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">
<!--home start-->

<?php if (@$_GET['q'] == 0) {
                    $q=mysqli_query($con,"SELECT * FROM quiz  ORDER BY date DESC " )or die('Error223');
                    echo  '<div class="panel title"><div class="table-responsive">
                    <table class="table table-striped title1" >
                    <tr"><td><center><b>Q.N</b></center></td><td><center><b>Name</b></center></td><td><center><b>Approve</b></center></td><td><center><b>UnApprove</b></center></td><td><center><b>Delete</b></center></td></tr>';
                    $c=0;
                    while($row=mysqli_fetch_array($q) )
                    {
                        $q_id=$row['eid'];
                        $t=$row['title'];
                        $s=$row['status'];
                        $c++;
                        echo '<tr><td style="color:#1791b1"><center><b>'.$c.'</b></center></td><td><center>'.$t.'</center></td><td><center><a href="admin_dash.php?approve='.$q_id.'">Approve</a></center></td></td><td><center> <a href="admin_dash.php?unapprove='.$q_id.'">Un Approve</a></center></td><td><center> <a href="admin_dash.php?delete='.$q_id.'">Delete Exam</a></center></td>';
                    }
                    echo '</table></div></div>';
                
                   

                }

                if (@$_GET['q'] == 2) {
                    $q = mysqli_query($con, "SELECT * FROM subject ") or die('Error223');
                    echo  '<div class="panel title"><div class="table-responsive">
                    <table class="table table-striped title1" >
                    <tr style="color:#1791b1"><td><center><b>S.N</b></center></td><td><center><b>Subject Name</b></center></td><td><center><b>Subject Code</b></center></td><td><center><b>Subject Department</b></center></td><td><center><b>Subject Hours</b></center></td><td><center><b>Subject Level</b></center></td><td><center><b>Subject Professor</b></center></td><td><center><b>ِActions</b></center></td></tr>';
                    $c = 0;
                    while ($row = mysqli_fetch_array($q)) {
                        $sid = $row['id'];
                        $prof_id=$row['prof_id'];
                        $dep_id = $row['dep_id'];
                        $hour = $row['hour'];
                        $code = $row['code'];
                        $Stitle = $row['name'];

                        $level = $row['level'];
                        $q12 = mysqli_query($con, "SELECT * FROM dep WHERE id='$dep_id' ") or die('Error232');
                        while ($row = mysqli_fetch_array($q12)) {
                            
                            $Dtitle = $row['name'];
                            $q13 = mysqli_query($con, "SELECT * FROM prof WHERE id='$prof_id' ") or die('Error233');
                            while ($row = mysqli_fetch_array($q13)) {
                                $prof_name=$row['name'];
                            }


                            
                        }
                        $c++;
                        echo '<tr><td style="color:#1791b1"><center><b>' . $c . '</b></center></td><td><center>' . $Stitle . '</center></td><td><center>' . $code . '</center></td><td><center>' . $Dtitle . '</center></td><td><center>' . $hour . 'H</center></td><td><center> ' . $level . '</center></td><td><center>' . $prof_name . '</center></td><td><center><a href="update.php?subject='.$sid.'" style=color:#1791b1>Edit</a></center></td>';
                    }
                    echo '</table></div></div>';
                }

                if(isset($_GET['delete'])){
                    $the_quiz_id = $_GET['delete'];
                    $sql_delete = " DELETE FROM `quiz` WHERE `eid` = '$the_quiz_id' ";
                    $deleteQuiz=mysqli_query($con, $sql_delete);
                    ;
                }

                if(isset($_GET['approve'])){
                    $the_quiz_id = $_GET['approve'];
                    $sql_approve= " UPDATE `quiz` SET  `status` = 'approved'  WHERE `eid` = '$the_quiz_id' ";
                    $approvequiz=mysqli_query($con, $sql_approve);
                    
                }

                if(isset($_GET['unapprove'])){
                    $the_quiz_id = $_GET['unapprove'];
                    $sql_unapprove= " UPDATE `quiz` SET   `status` = 'unapproved'  WHERE `eid` = '$the_quiz_id' ";
                    $unapprovequiz=mysqli_query($con, $sql_unapprove);
                    
                }

                ?>
                <?php
                if (@$_GET['q'] == 20) {
                    $result = mysqli_query($con, "SELECT * FROM `prof`") or die('Error');
                    echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
                        <tr><td><center><b>P.N.</b></center></td><td><center><b>Name</b></center></td><td><center><b>Email</b></center></td><td><center><b>Action</b></center></td></tr>';
                    $c = 0;
                    while ($row = mysqli_fetch_array($result)) {

                        $name = $row['name'];
                        $id = $row['id'];
                        $email = $row['email'];
                        $c++;
                        
                        echo '<tr><td><center>' . $c . '</center></td><td><center>' . $name . '</center></td><td><center>' . $email . '</center></td><td><center><a title="Delete User" href="update.php?demail=' . $email . '"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></center></td></tr>';
                    }

                    echo '</table></div></div>';
                }
                ?>

                <?php
                if (@$_GET['q'] == 4 && !(@$_GET['step'])) {
                    echo '<div class="row"><span class="title1" style="margin-left:40%;font-size:30px;color:#fff;"><b>Add Department</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6">   
                        <form class="form-horizontal title1" name="form" action="update.php?q=addDep"  method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="name"></label>  
                                    <div class="col-md-12">
                                        <input id="name" name="name" placeholder="Enter Department title" class="form-control input-md" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-12 control-label" for="total"></label>  
                                <div class="col-md-12">
                                    <input id="total" name="total" placeholder="Enter number of subjects" class="form-control input-md" type="number">
                                </div>
                            </div>

                                
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for=""></label>
                                    <div class="col-md-12"> 
                                        <input  type="submit" name="addDep" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
                                    </div>
                                </div>

                            </fieldset>
                        </form></div>';
                }
                ?>

                <?php
                if (@$_GET['q'] == 10) {
                    
                    echo '<div class="row"><span class="title1" style="margin-left:40%;font-size:30px;color:#fff;"><b>Add Subject</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6">   
                        <form class="form-horizontal title1" name="form" action="update.php?q=addsub"  method="POST">
                            <fieldset>

                            <div class="form-group">
                            <label class="col-md-12 control-label" for="name"></label>  
                            <div class="col-md-12">';
                            
                                echo'<select id="name" name="dep" placeholder="Enter Department title" class="form-control input-md" type="text">
                                <option>Choose Department</option>';
                                $q = mysqli_query($con, "SELECT * FROM dep");
                                while ($row = mysqli_fetch_array($q)) {
                                    $dep_id=$row['id'];
                                    $title = $row['name'];
                                    echo' <option value="'.$dep_id.'">'.$title.'</option>';
                                };
                                echo '</select>';
                            
                            echo'</div>
                        </div>


                        <div class="form-group">
                        <label class="col-md-12 control-label" for="name"></label>  
                        <div class="col-md-12">';
                        
                            echo'<select id="name" name="prof" placeholder="Enter Department title" class="form-control input-md" type="text">
                            <option>Choose Professor Name</option>';
                            $q = mysqli_query($con, "SELECT * FROM prof ");
                            while ($row = mysqli_fetch_array($q)) {
                                $prof_id=$row['id'];
                                $name = $row['name'];
                                echo' <option value="'.$prof_id.'">'.$name.'</option>';
                            };
                            echo '</select>';
                        
                        echo'</div>
                    </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="name"></label>  
                                    <div class="col-md-12">
                                        <input id="name" name="name" placeholder="Enter subject title" class="form-control input-md" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="name"></label>  
                                    <div class="col-md-12">
                                        <input id="code" name="code" placeholder="Enter subject code" class="form-control input-md" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="name"></label>  
                                    <div class="col-md-12">
                                        <input id="level" name="level" placeholder="Enter subject Level" class="form-control input-md" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                <label class="col-md-12 control-label" for="total"></label>  
                                <div class="col-md-12">
                                    <input id="total" name="hour" placeholder="Enter hour of subjects" class="form-control input-md" type="number">
                                </div>
                            </div>

                                
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for=""></label>
                                    <div class="col-md-12"> 
                                        <input  type="submit" name="addsub" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
                                    </div>
                                </div>

                            </fieldset>
                        </form></div>';
                }
                ?>






<!--feedback start-->
<?php if(@$_GET['q']==3) {
$result = mysqli_query($con,"SELECT * FROM `feedback` ORDER BY `feedback`.`date` DESC") or die('Error');
echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Subject</b></td><td><b>Email</b></td><td><b>Date</b></td><td><b>Time</b></td><td><b>By</b></td><td></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$date = $row['date'];
	$date= date("d-m-Y",strtotime($date));
	$time = $row['time'];
	$subject = $row['subject'];
	$name = $row['name'];
	$email = $row['email'];
	$id = $row['id'];
	 echo '<tr><td>'.$c++.'</td>';
	echo '<td><a title="Click to open feedback" href="admin_dash.php?q=3&fid='.$id.'">'.$subject.'</a></td><td>'.$email.'</td><td>'.$date.'</td><td>'.$time.'</td><td>'.$name.'</td>
	<td><a title="Open Feedback" href="admin_dash.php?q=3&fid='.$id.'"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></td>';
	echo '<td><a title="Delete Feedback" href="update.php?fdid='.$id.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td>

	</tr>';
}
echo '</table></div></div>';
}
?>
<!--feedback closed-->

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


</div><!--container closed-->
</div></div>
</body>
</html>
