<meta charset="utf-8" />
<?php
session_start();
$conn = new mysqli("localhost", "emawlrdl11", "project11*", "emawlrdl11");
if($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}


  $userpw = $_POST['pw'];
  $userid = $_POST['mail'];

  $sql = "SELECT * FROM member WHERE email = '{$userid}' AND pw = '{$userpw}'";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $_SESSION['u_id'] = $row['member_id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['mail'] = $row["email"];
    $_SESSION['pw'] = $row["pw"];
    echo("<script>alert('로그인되었습니다.'); location.href='/db_project/mainpage.php';</script>");
  }
  else{
    echo "<script>alert('아이디 혹은 비밀번호를 확인하세요.');</script>";
    echo "<script>location.href=\"login_resist_form.php\";</script>";
  }

?>
