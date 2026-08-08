<?php
error_reporting(0);

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$gender=$_POST['rad'];
$math=$_POST['math'];
$eng=$_POST['eng'];
$comp=$_POST['comp'];

$fullname=$fname." ".$lname;

if(isset($gender)==true && $gender=="m")
{  
    $gen="Male";
}   
elseif(isset($gender)==true && $gender=="f")
{  
    $gen="Female";
}
elseif(isset($gender)==true && $gender=="o")
{  
    $gen="Other";
}
else
{
    $gen="";
}

$tot=$math+$eng+$comp;

$avg=$tot/3;

if($avg>=90){
    $grade="A+";
}
elseif($avg>=80){
    $grade="A";
}
elseif($avg>=70){
    $grade="B+";
}
elseif($avg>=60){
    $grade="B";
}
elseif($avg>=50){
    $grade="C";
}
else{
    $grade="F";
}       

?>

<link rel="stylesheet" href="./form.css">
<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">


<div class="con">
    <div class="conrap">
        <form method="post">
            <table class="table">
                 <tr>
                    <th colspan="2"><h1 align="center">Result</h1></th>
                </tr>
                <tr>
                    <th>Full Name:</th>
                    <th><input type="text" id="fullname" class="form-control" value="<?php echo $fullname; ?>"></th>
                </tr>
                <tr>
                    <th>Gender:</th>
                    <th><input type="text" id="gender" class="form-control" value="<?php echo $gen; ?>"></th>
                </tr>
                <tr>
                    <th>Total:</th>
                    <th><input type="number" id="tot" class="form-control" value="<?php echo $tot; ?>"></th>
                </tr>
                <tr>
                    <th>Average:</th>
                    <th><input type="number" id="avg" class="form-control" value="<?php echo $avg; ?>"></th>
                </tr>
                <tr>
                    <th>Grade:</th>
                    <th><input type="text" id="grade" class="form-control" value="<?php echo $grade; ?>"></th>
                </tr>
            </table>
        </form>
    </div>
</div>


