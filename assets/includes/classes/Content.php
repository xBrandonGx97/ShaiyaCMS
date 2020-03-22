<?php
	Class Content{
		public static function Banner(){
			if(Settings::$SiteTheme == 'shCMS'){
				# Header Image
				echo '<div class="header"><h1><img src="'.DOC_ROOT.'/assets/Themes/shCMS/images/logos/DK.png" alt="" width="150" height="150"> '.Settings::$SiteTitle.' </h1></div>';
			}
		}

		public static function Carousel(){
			if(Settings::$SiteTheme == 'shCMS'){
				echo '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">';
					echo '<ol class="carousel-indicators">';
						echo '<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>';
						echo '<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>';
						echo '<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>';
					echo '</ol>';
					echo '<div class="carousel-inner">';
						echo '<div class="carousel-item active">';
							echo '<img class="d-block w-100" src="'.DOC_ROOT.'/assets/Themes/shCMS/images/carousel/bg5.jpg" alt="First slide">';
						echo '</div>';
						echo '<div class="carousel-item">';
							echo '<img class="d-block w-100" src="'.DOC_ROOT.'/assets/Themes/shCMS/images/carousel/background.jpg" alt="Second slide">';
						echo '</div>';
						echo '<div class="carousel-item">';
							echo '<img class="d-block w-100" src="'.DOC_ROOT.'/assets/Themes/shCMS/images/carousel/SY-News_MonthlyJanuary_1.jpg" alt="Third slide">';
						echo '</div>';
					echo '</div>';
					echo '<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">';
						echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
						echo '<span class="sr-only">Previous</span>';
					echo '</a>';
					echo '<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">';
						echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
						echo '<span class="sr-only">Next</span>';
					echo '</a>';
				echo '</div>';
			}
		}

		public static function Jumbotron(){
			if(Settings::$SiteTheme == 'shCMS'){
				echo '<div class="jumbotron">';
					echo '<h1 class="display-4">Welcome to '.Settings::$SiteTitle.'</h1>';
						echo '<p class="lead">Some Information here</p>';
					echo '<hr class="my-4">';
					echo '<p class="lead">';
						echo '<a class="btn btn-dark btn-lg" href="'.DOC_ROOT.'/community/downloads" role="button">Download</a>';
					echo '</p>';
            	echo '</div>';
			}
		}

		public static function Header(){
			if(Settings::$SiteTheme == 'shCMS'){
			}
		}

		public static function Breadcrumb(){
			if(Settings::$PageZone == "Site"){
				if(Settings::$SiteTheme == 'shCMS'){
					# Breadcrumb
					echo '<nav aria-label="breadcrumb">';
						echo '<ol class="breadcrumb bg-dark">';
						if(Settings::$PageIndex != "home"){
							echo '<li class="breadcrumb-item"><a href="./home">'.Settings::$SiteTitle.'</a></li>';
							if(Settings::$PageSub){
								echo '<li class="breadcrumb-item active" aria-current="PAGE">'.Settings::$PageSub.'</li>';
							}
							if(Settings::$PageCat){
								echo '<li class="breadcrumb-item active" aria-current="page">'.Settings::$PageCat.'</li>';
							}
							echo '<li class="breadcrumb-item active" aria-current="PAGE">'.Settings::$PageTitle.'</li>';
						}
						else{
							echo '<li class="breadcrumb-item"><a href="./home">'.Settings::$SiteTitle.'</a></li>';
							echo '<li class="breadcrumb-item active" aria-current="PAGE"><a href="./home">Home</a></li>';
						}
						echo '</ol>';
					echo '</nav>';
				}
			}elseif(Settings::$PageZone == "ACP"){
				echo '<nav aria-label="breadcrumb">';
					echo '<ol class="breadcrumb bg-dark acp-bg acp-breadcrumb">';
						if(Settings::$PageIndex != "admin"){
							echo '<li class="breadcrumb-item"><a href="/admin">'.Settings::$SiteTitle.'</a></li>';
							echo '<li class="breadcrumb-item active" aria-current="page">'.Settings::$PageCat.'</li>';
							echo '<li class="breadcrumb-item active" aria-current="PAGE">'.Settings::$PageTitle.'</li>';
						}else{
							echo '<li class="breadcrumb-item"><a href="/admin">'.Settings::$SiteTitle.'</a></li>';
							echo '<li class="breadcrumb-item active" aria-current="PAGE">Dashboard</li>';
						}
					echo '</ol>';
				echo '</nav>';
			}
		}

		public static function initContent(){
			if(Settings::$PageZone == "Site"){
				if(Settings::$SiteTheme == 'shCMS'){
					# Start Preloader
					if(Settings::$PageIndex === "home"){
						if (Settings::$Preloader==1){
							echo '<div class="loading fadeout" id="loading">
							<div class="loading-text">
								<span class="loading-text-words">L</span>
								<span class="loading-text-words">O</span>
								<span class="loading-text-words">A</span>
								<span class="loading-text-words">D</span>
								<span class="loading-text-words">I</span>
								<span class="loading-text-words">N</span>
								<span class="loading-text-words">G</span>
								<br>
								<span class="loading-text-server">'.Settings::$SiteTitle.'</span>
							</div>
						</div>';
						}
					}
					# End Preloader

					Nav::NavTop();
					Nav::NavSide();

					echo '<div class="sectionHead text-center">';
						echo '<div class="container">';
						echo self::Breadcrumb();
						if(Settings::$PageIndex === "home"){
							echo '<div class="alert alert-lightgray alert-dismissible fade show" role="alert">';
								echo '<strong>Welcome, '.User::$UserLoginStatus.'</strong>  to '.Settings::$SiteTitle.'';
								echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
									echo '<span aria-hidden="true">&times;</span>';
								echo '</button>';
							echo '</div>';
						}
						# Jumbotron
						if(Settings::$Jumbotron==1){
							self::Jumbotron();
						}
						# Carousel
						if(Settings::$Carousel==1){
							self::Carousel();
							Template::Separator(10);
						}
						if(Settings::$LogoEnabled==1){
							echo self::Banner();
						}
						echo '</div>';
					echo '</div>';
				}elseif(Settings::$SiteTheme == 'OS'){

				}
			}elseif(Settings::$PageZone == "ACP"){
				Nav::NavTop();
				echo '<div id="wrapper">';
				Nav::NavSide();
				echo '<div id="content-wrapper">';
				echo '<div class="container-fluid">';
				self::Breadcrumb();
				Template::Separator(10);
			}
		}

		public static function initFooter(){
			if(Settings::$PageZone == "Site"){
				if(Settings::$SiteTheme == 'shCMS'){
					if(Settings::$FooterEnabled==1){
						echo '<footer id="footer" class="py-5">';
							echo '<div class="container py-5">';
								echo '<div class="row">';
									echo '<div class="col-6 col-md-6 col-lg-3 mb-2">';
										echo '<h6 class="text-uppercase">Affiliates</h6>';
										echo '<ul class="nav flex-column">';
											echo '<li><a class="text-white" href="https://elitepvpers.com/forum" target="_blank" title="Elitepvpers" alt="Elitepvpers"><img class="float-left" src="'.DOC_ROOT.'/assets/Themes/shCMS/images/logos/elite.png"></a></li>';
										echo '</ul>';
									echo '</div>';
									echo '<div class="col-6 col-md-6 col-lg-3 mb-2">';
										echo '<h6 class="text-uppercase">Server</h6>';
										echo '<ul class="nav flex-column">';
											echo '<span class="text-muted">'.Settings::$SiteFooter.'</span>';
											Template::Separator(10);
											if(Settings::$GRBEnabled==1){
												echo '<h6 class="text-uppercase">GRB Countdown</h6>';
													include('assets/Themes/shCMS/js/GRB_Time.php');
												echo '<div id="timer"></div>';
											}
										echo '</ul>';
									echo '</div>';
									echo '<div class="resources-footer col-12 col-md-12 col-lg-6 mb-2 text-right">';
										echo '<h6 class="text-uppercase">Resources</h6>';
										echo '<ul class="nav float-right">';
											echo '<li><a class="text-white mr" href="https://github.com/xBrandonGx97/ShaiyaCMS" title="Follow Project on GitHub!"><i class="fab fa-github"></i></a></li>';
											echo '<a class="scroll_top" href="#page-top"><i class="fas fa-angle-up"></i></a>';
										echo '</ul>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</footer>';
					}
				}
				Display::load_Javascript_Addons();
				echo '</body>';
            	echo '</html>';
			}elseif(Settings::$PageZone == "ACP"){
				echo '</div>'; #container fluid
				echo '<footer class="sticky-footer">';
					echo '<div class="container my-auto">';
						echo '<div class="copyright text-center my-auto">';
							echo '<p class="copyright text-center fs_20 fw_bold">&copy; 2018 <a href="?p=home">Template</a>. All Rights Reserved.<img src="'.DOC_ROOT.'/assets/Themes/shCMS/images/logos/elite.png"></p>';
							echo '<label class="badge badge-primary b_i fs_14">v'.Settings::$Version.'</label>';
						echo '</div>';
					echo '</div>';
				echo '</footer>';
				echo '</div>'; #content wrapper
				echo '</div>'; #wrapper
				Display::load_Javascript_Addons();
				echo '</body>';
            	echo '</html>';
			}
		}

		public static function _do_pre($data,$kill=false){
			if($data){
				echo '<pre>';
					var_dump($data);
				echo '</pre>';
				if($kill){
					switch($kill){
						case 1 : die();break;
						case 2 : exit();break;
					}
				}
			}
			else{
				echo 'No data to show...<br>';
			}
		}
	}
?>