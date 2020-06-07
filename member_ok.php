<?php
session_start();
$conn = new mysqli("localhost", "emawlrdl11", "project11*", "emawlrdl11");
if($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}
$userid = $_POST['id'];
$email = $_POST['mail'];
$userpw = $_POST['pw'];
//$sql = "insert into member(name,pw,email)values('$userid','$userpw','$email')";
/*
$sql = "
  INSERT INTO member
    (name, pw, email)
    VALUES(
        '{$_POST['id']}',
        '{$_POST['pw']}',
        '{$_POST['mail']}',
        NOW()
    )
";
		mysqli_query($conn, $sql);
    */
/*
  $userid = $_POST['id'];
  $email = $_POST['mail'];
  $userpw = $_POST['pw'];
$sql = "INSERT INTO member VALUES('','{$userid}','{$userpw}','{$email}');";*/
$sql = "insert into member(name,pw,email) values('$userid','$userpw','$email')";
// if(!$conn->query($sql)){
// 	echo("insert error" . $conn->error);
// }else{
// 	echo '<script>alert("리뷰가 저장되었습니다");</script>';
// }
$conn->query($sql);

?>
<meta charset="utf-8" />
<script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
<?php echo("<script>location.href='login_resist_form.php';</script>"); ?>
