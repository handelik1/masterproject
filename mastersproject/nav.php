<?php
			//Navigation section
$out = '';
$out .='<body>';
$out .= '<div class="container">';
$out .= 	'<div class="row">';
$out .=  		'<div class="col-md-4">
					<section class="header-logo">
						<h1><a href = "index.php"><img src = "src/img/msu_logo.png" ></img></a></h1>
					</section>
  				</div>';

$out .= 		'<div class="col-md-8">
  			 		<div class="row">
  			 			<div class="col-md-12">

	  			 			<section class="global-nav"><nav>
								<ul>
								<li class = "hover"><a>Student Services</a></li>
								<li class = "hover"><a>Employee Services</a></li>
								<li class = "hover"><a>Library</a></li>
								<li class = "hover"><a>Newsroom</a></li>
								<li class = "hover"><a>Jobs</a></li>
								<li class = "hover"><a>Directory</a></li>
								<li class = "hover"><a>Quicklinks</a></li>';

								if(isset($_SESSION['user'])){
								$typeQuery = mysqli_query($con,"select user_type from users where username = '" . $_SESSION['user'] . "'");
								$row = mysqli_fetch_array($typeQuery);
								}

								if(isset($_SESSION['user']) && $row['user_type'] == 'admin'){
$out .=								'<li class = "hover"><a href="admin.php" class = "admin-link">Admin</a></li>';
								}
								if(isset($_SESSION['user'])){
$out .=								'<li class = "hover"><a id = "logout" href="logout.php">Logout</a></li>';
								}
$out .=								'</ul>
								</nav><form><input type="hidden"> <input type="hidden"><label style="display: block; position: absolute; top: -1000px; opacity: 0;">Search</label><input size="25" type="text"> <input value="Go" type="submit"></form>
							</section>

  			 			</div>

  			 		</div>
  			 		
  				</div>';
  			
$out .=	  '</div>';

?>