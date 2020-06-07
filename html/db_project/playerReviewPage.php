<!DOCTYPE HTML>
<!--
	Monochromed by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
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
		<?php
		session_start();
		$conn = new mysqli("localhost", "emawlrdl11", "project11*", "emawlrdl11");
		if($conn->connect_error){
		  die("Connection failed: " . $conn->connect_error);
		}
		$name = $_POST['search_name'];
		$sql = "SELECT * FROM player_table WHERE short_name LIKE '%$name%' ";

		$result = $conn->query($sql);
		// if($result->num_rows > 0){
		// 	while($row = $result->fetch_assoc()){ //여러개가 있더라도 하나만 받아오기
		$row = $result->fetch_assoc();
		$name = $row['short_name'];
		$birth = $row['birth_date'];
		$height = $row['height_cm'];
		$position = $row['position'];
		$weight_kgs = $row['weight_kgs'];
		$nationality = $row['nationality'];
		$preferred_foot = $row['preferred_foot'];
		$club_team = $row['club_team'];
		$club_backnumber = $row['club_backnumber'];
		$national_backnumber = $row['national_backnumber'];
		?>
	<!-- Header -->
		<div id="header">
			<div class="container">

				<ul class="style1">
				<li><a href="index.html" style="color:#000000;text-decoration:none">Homepage</a></li>
			</ul>

				<!-- Logo -->
					<div id="logo">
						<h2 class="search-title">선수검색하기</h2>
							<form name="search_form" method="post" action="">
								<input class="search-text-input" type="text" name="search_name" placeholder="이름으로 검색해주세요."/>
								<input class="search-find" type="submit" value="검색"/>
							</form>
					</div>

				<!-- Nav -->
					<!--<nav id="nav">
						<ul>
							<li><a href="index.html">Homepage</a></li>
							<li><a href="threecolumn.html">Two Sidebars</a></li>
							<li class="active"><a href="twocolumn1.html">Left Sidebar</a></li>
							<li><a href="twocolumn2.html">Right Sidebar</a></li>
							<li><a href="onecolumn.html">No Sidebar</a></li>
						</ul>
					</nav>-->

			</div>
		</div>
	<!-- Header -->

	<!-- Main -->
		<div id="main">
			<div class="container">
				<div class="row">

					<!-- Sidebar -->
						<div id="sidebar" class="4u">
							<section>
								<header>
									<h2><?php
									if($name == NULL)
										echo "해당하는 선수가 없습니다<br>\n다시검색해주세요";
									else
										echo $name;
									?></h2>
									<!-- $height = $row['height_cm'];
									$weight_kgs = $row['weight_kgs'];
									$nationality = $row['nationality'];
									$preferred_foot = $row['preferred_foot'];
									$club_team = $row['club_team'];
									$club_backnumber = $row['club_backnumber'];
									$national_backnumber = $row['national_backnumber']; -->
									<span class="byline"><?= $club_team?></span>
									<p><img src="images/messi.jpg" alt="Player pic" style="width:250px;height:300px;"></p>
								</header>
								<p>생년월일 :<?= $birth?></p>
								<p>키 :<?= $height?></p>
								<p>몸무게 :<?= $weight_kgs?></p>
								<p>선호 포지션 :<?= $position?></p>
								<p>클럽 :<?= $club_team	?></p>
								<p>국적 :<?= $nationality?></p>
								<p>선호하는 발 :<?= $preferred_foot?></p>
								<p>클럽 등번호 :<?= $club_backnumber?></p>
								<p>국가대표 등번호 :<?= $national_backnumber?></p>
								<p>에이전트 :<?= $birth?></p>
								<p>이적기록 :<?= $birth?></p>

								<!--<ul class="default">
									<li><a href="#">Pellentesque quis lectus gravida blandit.</a></li>
									<li><a href="#">Lorem ipsum consectetuer adipiscing elit.</a></li>
									<li><a href="#">Phasellus nec nibh pellentesque congue.</a></li>
									<li><a href="#">Cras aliquam risus pellentesque pharetra.</a></li>
									<li><a href="#">Duis non metus commodo euismod lobortis.</a></li>
									<li><a href="#">Lorem ipsum dolor adipiscing elit.</a></li>
								</ul>-->
							</section>
						</div>
					<!-- Sidebar -->

					<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<header>
									<h2>Review</h2>
									<span class="byline">자유로운 의견을 적어도 되지만, 심각한 인격모독은 자제 부탁드립니다!</span>
								</header>

								<p id="review">ID: handong123<br>
									메신. 축구 개잘함. 비교불가. 솔직히 바르셀로나 메시 은퇴하면 조금 걱정된다. 타격이 너무 클듯.</p>
								<p id="review">ID: handong789<br>
									근데 솔직히 그렇게 잘하는거 아니지 않음? 겁나 걸어 다니던데? 자기가 뛰고 싶을때만 뛰고 말이야. 팀 전체로 봤을때 별루인 선수라고 생각함.</p>
								<p id="review">ID: carmichael123<br>
									위 댓 글쓴이 축알못 인정하넼ㅋㅋㅋㅋ</p>
								<p id="review">ID: L.messi624<br>
									인정 내가 축구 잘하기는 함. </p>
							</section>

							<form action="/action_page.php">
								<label for="w3review">Review:</label>
								<textarea id="playerreview" name="playerreview" rows="7" cols="100"></textarea>
  							<br><br>
  							<input type="submit" value="Submit">
							</form>
						</div>
					<!-- /Content -->

				</div>

			</div>
		</div>
	<!-- Main -->

	<!-- Footer -->
		<!--<div id="footer">
			<div class="container">
				<div class="row">
					<div class="3u">
						<section>
							<ul class="style1">
								<li><img src="images/pics05.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero eget urna. </p>
									<p class="posted">August 11, 2014  |  (10 )  Comments</p>
								</li>
								<li><img src="images/pics06.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero eget urna. </p>
									<p class="posted">August 11, 2014  |  (10 )  Comments</p>
								</li>
								<li><img src="images/pics07.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero eget urna. </p>
									<p class="posted">August 11, 2014  |  (10 )  Comments</p>
								</li>
							</ul>
						</section>
					</div>
					<div class="3u">
						<section>
							<ul class="style1">
								<li class="first"><img src="images/pics08.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero eget urna. </p>
									<p class="posted">August 11, 2014  |  (10 )  Comments</p>
								</li>
								<li><img src="images/pics09.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero eget urna. </p>
									<p class="posted">August 11, 2014  |  (10 )  Comments</p>
								</li>
								<li><img src="images/pics10.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero eget urna. </p>
									<p class="posted">August 11, 2014  |  (10 )  Comments</p>
								</li>
							</ul>
						</section>
					</div>
					<div class="6u">
						<section>
							<header>
								<h2>Aenean elementum</h2>
							</header>
							<p>In posuere eleifend odio. Quisque semper augue mattis wisi. Maecenas ligula. Pellentesque viverra vulputate enim. Aliquam erat volutpat. Pellentesque tristique ante ut risus. Quisque dictum. Integer nisl risus, sagittis convallis, rutrum id, elementum congue, nibh. Suspendisse dictum porta lectus.</p>
							<ul class="default">
								<li><a href="#">Pellentesque quis lectus gravida blandit.</a></li>
								<li><a href="#">Lorem ipsum consectetuer adipiscing elit.</a></li>
								<li><a href="#">Phasellus nec nibh pellentesque congue.</a></li>
								<li><a href="#">Cras aliquam risus pellentesque pharetra.</a></li>
								<li><a href="#">Duis non metus commodo euismod lobortis.</a></li>
								<li><a href="#">Lorem ipsum dolor adipiscing elit.</a></li>
							</ul>
						</section>
					</div>
				</div>
			</div>
		</div> -->
	<!-- Footer -->

	<!-- Copyright -->
		<div id="copyright">
			<div class="container">
				Design: <a>SJH</a> Images: <a href="https://www.fifa.com/?nav=internal">FIFA</a>
			</div>
		</div>

	</body>
</html>
