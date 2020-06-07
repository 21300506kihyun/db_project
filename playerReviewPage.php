<!DOCTYPE HTML>
<!--
	Monochromed by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<?php
session_start();
if( isset( $_SESSION['mail'] ) ) {
	$jb_login = TRUE;
}
?>
<html>
	<head>
		<title>Player Page</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body>
	<!-- Header -->
	<div id="header">
		<?php
      if($jb_login){
        $name = $_SESSION['name'];
        echo "<a href ='logout.php' class='login'> <b> $name </b> 님 </a>";
      }else{
    		echo("<a href=\"login_resist_form.php\" class=\"login\">login / register</a>");
			}
			?>
		<div class="container">

			<!-- Logo -->
				<div id="logo">
					<h1><a href="mainpage.php">SC.GG </a></h1>

				</div>
				<div class ="search">
					<form name="search_form" method="post" action="">
						<input type = "text" name ="search_name" placeholder= "선수명을 입력하세요">
						<button type="submit" class="mybutton">검색</button>
					</form>
				</div>
		</div>
	</div>
	<!-- Header -->

	<!-- Main -->
		<div id="main">
			<div class="container">
				<div class="row">
					<?php
					 // connect
						session_start();
						$conn = new mysqli("localhost", "emawlrdl11", "project11*", "emawlrdl11");
						if($conn->connect_error){
							die("Connection failed: " . $conn->connect_error);
						}

						// review값 받기
						$review = $_POST['playerreview'];

						// 선수 정보 가져오기
						if($_POST['search_name'] != NULL){
							$search_name = $_POST['search_name'];
							$sql = "SELECT * FROM player_table WHERE full_name LIKE '%$search_name%' ";

							$result = $conn->query($sql);
							if($result->num_rows > 0){
						// 	while($row = $result->fetch_assoc()){ //여러개가 있더라도 하나만 받아오기
								$row = $result->fetch_assoc();

								$_SESSION['player_id'] = $row['player_id'];
								$_SESSION['player_name'] = $row['short_name'];
								$_SESSION['birth'] = $row['birth_date'];
								$_SESSION['height'] = $row['height_cm'];
								$_SESSION['position'] = $row['position'];
								$_SESSION['weight_kgs'] = $row['weight_kgs'];
								$_SESSION['nationality'] = $row['nationality'];
								$_SESSION['preferred_foot'] = $row['preferred_foot'];
								$_SESSION['club_team'] = $row['club_team'];
								$_SESSION['club_backnumber'] = $row['club_backnumber'];
								$_SESSION['national_backnumber'] = $row['national_backnumber'];
								$_SESSION['img'] = $row['player_image'];

								$p_id = (int)$_SESSION['player_id'];
								$sql_agency = "SELECT * FROM agency_table WHERE player_id = $p_id";
								$result_agency = $conn->query($sql_agency);

								$row_agency = $result_agency->fetch_assoc();
								$_SESSION['agency'] = $row_agency['agency_name'];

								$sql_trans = "SELECT *
									FROM (transfer_record_table JOIN club_table ON transfer_record_table.club_id = club_table.club_id)
									WHERE player_id = $p_id;";

								$result_trans = $conn->query($sql_trans);

								if($result_trans->num_rows > 0){
									while($row_trans = $result_trans->fetch_assoc()) {
	 									 //echo($row_trans['club_involved_name']);
	 									 if(strcmp($row_trans['transfer_movement'],'out') == 0){
											 $before_club = $row_trans['club_name'];
											 break;
										 }
	 							 }
						 	}
								//$_SESSION['trans_before'] = $row_trans['agency_name'];

						}else{
							echo '<script>alert("해당선수가 존재하지 않습니다 다시 검색해주세요");</script>';
						}
					}

				// 해당선수에 대한 review정보 받아오기
				if($_SESSION['player_name'] != NULL){
					 $p_id = (int)$_SESSION['player_id'];
					 $list_cnt = 0; // reivew 갯수
					 $meeting_list = array(); // reivew담을 array

					 $sql_review = "SELECT * FROM review_table WHERE player_id = $p_id";
					 $result_review = $conn->query($sql_review);
					 //echo($_SESSION['player_id']);
					 if ($result_review->num_rows > 0) {
					 		 while($row = $result_review->fetch_assoc()) {
									 echo($row['reivew']);
									 array_push($meeting_list, $row);
									 $list_cnt += 1;
							 }
							//print_r($xx);
							//$str_tok = explode("-",$meeting_list[1]['time']);
					 } else {
							$num_review = "zero";
					 }
				 }

				 //리뷰값 db에 저장하기
						if($_SESSION['player_name'] != NULL && $review != NULL){ // 검색선주가 존재하고, 그 선수에 대한 리뷰를 작성했을 때
							$u_id = (int)$_SESSION['u_id'];
							$p_id = $_SESSION['player_id'];
							$sql = "insert into review_table(review,player_id,user_id) values('$review',$p_id,$u_id)";
							if(!$conn->query($sql)){
								echo("insert error" . $conn->error);
							}else{
								echo '<script>alert("리뷰가 저장되었습니다");</script>';
								echo '<script>location.href="playerReviewPage.php";</script>';
							}
						}

					?>

					<!-- Sidebar -->
						<div id="sidebar" class="4u">
							<section>
								<header>
									<h2><?php
									if($_SESSION['player_name'] == NULL)
										echo "해당하는 선수가 없습니다<br>\n다시검색해주세요";
									else
										echo $_SESSION['player_name'];
									?></h2>
									<!-- $height = $row['height_cm'];
									$weight_kgs = $row['weight_kgs'];
									$nationality = $row['nationality'];
									$preferred_foot = $row['preferred_foot'];
									$club_team = $row['club_team'];
									$club_backnumber = $row['club_backnumber'];
									$national_backnumber = $row['national_backnumber']; -->
									<span class="byline"><?= $_SESSION['club_team']?></span>
									<p><img src= "<?php echo $_SESSION['img']?>" alt="Player pic" style="width:250px;height:300px;"></p>

								</header>
								<p>생년월일 :<?= $_SESSION['birth']?></p>
								<p>키 :<?= $_SESSION['height']?></p>
								<p>몸무게 :<?= $_SESSION['weight_kgs']?></p>
								<p>선호 포지션 :<?= $_SESSION['position']?></p>
								<p>클럽 :<?= $_SESSION['club_team']	?></p>
								<p>국적 :<?= $_SESSION['nationality']?></p>
								<p>선호하는 발 :<?= $_SESSION['preferred_foot']?></p>
								<p>클럽 등번호 :<?= $_SESSION['club_backnumber']?></p>
								<p>국가대표 등번호 :<?= $_SESSION['national_backnumber']?></p>
								<p>에이전트 :<?= $_SESSION['agency']?></p>
								<p>이적기록 :<?php echo($before_club . " ==> " . $_SESSION['club_team']) ?></p>
							</section>
						</div>
					<!-- Sidebar -->

					<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<header>
									<h2>Review</h2>
									<span class="byline">자유로운 의견을 적어도 되지만, 심각한 인격모독은 자제 부탁드립니다!</span>
									<div style="font-size: 130%; ">
										<?php
											if(isset($_GET['page'])) {
												$page = $_GET['page'];
											} else {
												$page = 0;
											}
										?>

										<?php
											if($page > 0){
												$pagedown  = $page -1;
												echo("<a style=\"float: left; text-decoration: none; color: #58666e;\" href=\" playerReviewPage.php?page=$pagedown\">◀ Prev  </a>"); //<!--Previous week-->
											}
											if($list_cnt > ($page+1)*3){
												$pageup = $page + 1;
												echo("<a style=\"float: right; text-decoration: none; color: #58666e;\" href=\" playerReviewPage.php?page=$pageup\">Next ▶</a>"); //<!--Next week-->
											}
										?>
									</div>
								</header>

								<?php
									for($j = $page*3 ; $j <= $page*3 + 2; $j++){  // 해당 주차에 정보가 있는지 없는지 확인
										$u_id = (int)$meeting_list[$j]['user_id'];
										$sql_u_id = "SELECT * FROM member WHERE member_id = $u_id";
										$result_u_id = $conn->query($sql_u_id);

										$row_u_id = $result_u_id->fetch_assoc();
										$u_name = $row_u_id['name'];

										echo("<p id=\"review\">ID:" . $u_name ."<br>");
										echo($meeting_list[$j]['review']. "</p>");
										}
								?>
							</section>

							<form name="search_form" method="post" action="">
								<label for="w3review">Review:</label>
								<textarea id="playerreview" name="playerreview" rows="7" cols="100"></textarea>
								<button type="submit" class="mybutton">댓글 달기</button>
							</form>
						</div>
					<!-- /Content -->

				</div>

			</div>
		</div>

	<!-- Copyright -->
		<div id="copyright">
			<div class="container">
				Design: <a>SJH</a> Images: <a href="https://www.fifa.com/?nav=internal">FIFA</a>
			</div>
		</div>

	</body>
</html>
