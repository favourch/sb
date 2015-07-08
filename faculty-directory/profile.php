<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<!-- <inc> -->
		<?php
			$this_dir = $_SERVER['REQUEST_URI'];
			$dev_dir  = '/development/sb/';
			$prod_dir = '/sb/';
			$is_dev = strpos($this_dir,$dev_dir);
			if($is_dev !== false) {
				$inc = $_SERVER['DOCUMENT_ROOT'] . $dev_dir . "inc/inc.php";
			} else {
				$inc = $_SERVER['DOCUMENT_ROOT'] . $prod_dir . "inc/inc.php";
			}
			include($inc);
		?>
	<!-- </inc> -->
	<!--site variables-->
		<?php
			$page_type       = 'second-level';
    		$page_cat        = 'sub'; // for site tagline logo container
			$second_level    = 'faculty-experts';

			$keywords          = "Stony Brook University,Undergraduate Admissions,Admissions,Majors,Minors,Special Programs,Visiting,About,Transfer Office,Transfer,Young Scholars Program,Honors,University Scholars,Admitted,International,Open House,Tour,Scholarships";
	        $page_title        = 'Faculty Directory at Stony Brook University, New York';
	        $page_title_sub    = '';
	        $page_title_full   = $page_title;

	        $og_title        = 'Stony Brook ' . $page_title_sub;
	        $og_description  = $page_description;
	        $og_url          = 'faculty-directory';

		    $page_to_top_link = false;
		    $page_to_top_loc   = 'splash-header';

		    $page_footerbar   = true;
		    $page_footer      = false;

		    //$audience_nav_selected_tab = 6;

		    $carousel 	      = false;
		    $carousel_3       = false;
		    $carousel_4       = false;

		    $lightbox 	      = false;
		    $live_filter      = true;
		    $text_filter      = false;

    		$search_style 	  = 'default';
    		$nav_type		  = 'default';

    		$motio  		  = false;

    		$page_loader      = true;

    		$page_scroll      = true;
	        $page_scroll_el   = '.splash-header';     //Options are audience-nav, logo, main-nav, bottom
	        $page_scroll_time = 0;
	        $page_scroll_mobile = false;

	        $live_filter_sticky = true;
		?>

	<!-- <head> -->
		<?php 
			$file  = $header;
			include($path . $file);
		?>
	<!-- </head> -->
    <body>
        <!-- <global> -->
			<?php 
				$file  = $global;
				include($path . $file);
			?>
		<!-- </global> -->

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
		        <div class="main-nav-container clearfix">
						<?php 
							include($path . 'site-nav.php');
						?>
		        </div>
		        <div class="main-container">
		            <div class="main clearfix">

		                <!-- <profile> -->
						    <?php
						    	$file = "faculty-directory/profile.php";
						    	include($path . $content . $secLv . $file);
						    ?>
						<!-- </profile> -->

		            </div> <!-- .main -->
		        </div> <!-- .main-container -->
		        <!-- <div.footer-container> -->
		        	<?php if($page_footer) {
						$file = "footers/for-students-footer.php";
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