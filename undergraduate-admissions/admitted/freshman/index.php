<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<!-- <inc> -->
		<?php
			$inc = $_SERVER['DOCUMENT_ROOT'] . "/sb/inc/inc.php";
			include($inc);
		?>
	<!-- </inc> -->
	<!--site variables-->
		<?php
			$page_type       = 'second-level';
    		$page_cat        = 'sub'; // for site tagline logo container
			$second_level    = 'undergrad-admissions';
			$page_title_sub  = 'Undergraduate Admissions';
			$page_title_full = $page_title . (isset($page_title_sub) && $page_title_sub!='' ? ' | ' . $page_title_sub : '');

		    $og_title        = 'Stony Brook ' . $page_title_sub;
		    //$og_description  = 'Did you know? Stony Brook University generates more than $2.5 billion annually in regional economic impact and is one of the few campuses anywhere with a Vice President for Economic Development. Read more...';
		    $og_url          = 'undergraduate-admissions';

		    $page_to_top_link = true;

		    $page_footerbar   = true;
		    $page_footer      = true;

		    //$audience_nav_selected_tab = 6;

		    $carousel 	      = true;
		    $carousel_3       = true;

    		$search_type      = 'admissions';
    		$search_style 	  = 'stay-in-nav';
    		$nav_type		  = 'big-n-bold';
    		$social_sidebar   = 'admissions';

    		$inside_page = true;
		?>

	<!-- <site config> -->
		<?php 
			$file  = $site_config;
			include($path . $file);
		?>
	<!-- </site config> -->
	<!-- <head> -->
		<?php 
			$file  = $header;
			include($path . $file);
		?>
	<!-- </head> -->
    <body>
        <!--[if lt IE 8]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience. Thanks!</p>
        <![endif]-->

        <div class="sbu-wrapper clearfix">
        	<div class="sbu-sub-wrapper">

		        <div class="header-container">
		        	<div class="nav-elements-container">
			        	<!-- <quick-nav> -->
							<?php
								include($path . $quick_nav);
							?>
						<!-- </quick-nav> -->
			            <!-- <more-nav> -->
							<?php 
								include($path . $more_nav);
							?>
						<!-- </more-nav> -->
			            <!-- <audience-nav> -->
							<?php 
								include($path . $audience_nav);
							?>
						<!-- </audience-nav> -->
					</div>
					<!-- <logo-container> -->
						<?php 
							include($path . $logo_container);
						?>
					<!-- </logo-container> -->
		        </div>
		        <div class="main-nav-container">
		        	<!-- <site-nav> -->
						<?php 
							include($path . 'nav/admissions-nav.php');
						?>
					<!-- </site-nav> -->
		        </div>
		        <div class="main-container">
		            <div class="main clearfix">

		                <!-- <undergrad-admissions> -->
							<?php 
								$file = "undergraduate-admissions/info-for/admitted-students/admitted-students-freshman.php";
								include($path . $content . $secLv . $file);
							?>
						<!-- </undergrad-admissions> -->

		            </div> <!-- .main -->
		        </div> <!-- .main-container -->
		        <!-- <div.footer-container> -->
		        	<?php if($page_footer) {
						$file = "footers/undergrad-admissions-footer.php";
						include($path . $file);
					} ?>
					<?php if($page_footerbar) {
						$file = "footerbar.php";
						include($path . $file);
					} ?>
				<!-- </div.footer-container> -->
<!--
				<div class="left-fixed-sidebar-container">

				</div>

				<div class="right-fixed-sidebar-container">

				</div>
-->

				<!-- <to-top> -->
					<?php if($page_to_top_link) {
						$file = "to-top.php";
						include($path . $file);
					} ?>
				<!-- </to-top> -->

	        </div><!-- .sbu-sub-wrapper -->
	    </div><!-- .sbu-wrapper -->

	    <!-- <scripts> -->
			<?php 
				$file = "footer-scripts.php";
				include($path . $file);
			?>
		<!-- </scripts> -->

		<!-- <googleanalytics> -->
			<?php 
				$file = "site-analytics.php";
				include($path . $file); 
			?>
		<!-- </googleanalytics> -->
    </body>
</html>