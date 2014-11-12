<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<!-- <inc> -->
		<?php
			$this_dir = $_SERVER['REQUEST_URI'];
			$dev_dir = '/development/sb/';
			$is_dev = strpos($this_dir,$dev_dir);
			if($is_dev !== false) {
				$inc = $_SERVER['DOCUMENT_ROOT'] . "/development/sb/inc/inc.php";
			} else {
				$inc = $_SERVER['DOCUMENT_ROOT'] . "/sb/inc/inc.php";
			}
			include($inc);
		?>
	<!-- </inc> -->
	<!--site variables-->
		<?php
			$page_type       = 'second-level';
			$page_title_sub  = 'Economic Development';
			$page_title_full = $page_title . (isset($page_title_sub) && $page_title_sub!='' ? ' | ' . $page_title_sub : '');

		    $og_title        = 'Stony Brook ' . $page_title_sub;
		    $og_description  = 'Did you know? Stony Brook University generates more than $2.5 billion annually in regional economic impact and is one of the few campuses anywhere with a Vice President for Economic Development. Read more...';
		    $og_url          = 'http://www.stonybrook.edu/economic-development';

		    $page_to_top_link = true;

		    $page_footerbar   = true;
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

		<?php
			$date_string = $item->date;
			if( ($comma_pos = strpos($date_string, ',')) !== FALSE ) {
				$date_string = substr($date_string, $comma_pos + 1);
			}
			$date_string = strtotime($date_string);
			$date_out = date('l, F j, Y', $date_string);
			echo $date_out;
		?>

		<?php
			ini_set('display_errors', '1');
			parse_str($_SERVER['QUERY_STRING']);

			if (!isset($rss))
				$rss = "http://sb.cc.stonybrook.edu/news/_resources/rss/all.rss";

			if (!isset($start))
				$start = 0;

			if (!isset($end))
				$end = 20;

			if (!isset($count))
				$count = 20;

			if (!isset($category))
				$category = "general";

			if (!isset($callback))
				$callback = "";

			$queryCategories = explode(",", $category);
			$rssFeed = simplexml_load_file($rss);
			$html = '<div class="home-item-wrapper">';

			foreach ($rssFeed->channel->item as $item){
				$ns = $item->getNamespaces(true);
				$ous = $item->children($ns['ou']);
				$itemCategories = explode(",", $ous->categories);

				foreach($queryCategories as $category){
					if(in_array(strtolower($category), $itemCategories) && strlen($item->title) > 1){
						if($start == 0){
							
							$date_string = $item->pubDate;
							if( ($comma_pos = strpos($date_string, ',')) !== FALSE ) {
								$date_string = substr($date_string, $comma_pos + 1);
							}
							$date_string = strtotime($date_string);
							$date_out = date('F j, Y', $date_string);
							
							$html .= '<div class="home-item-story">';
							$html .= '<a class="home-item-title" href="'.$item->link.'" title="'.$item->title.'" target="_blank">'.$item->title.'</a>';
							$html .= '<span class="home-item-date">'.$date_out.'</span>';
							$html .= '<span class="home-item-date">'.$item->description.'</span>';
							$html .= '</div>';	
							$count--;
						}
						else
							$start--;

						break;
					}
				}

				if($count == 0)
					break;
			}

			$html = '</div>';

			if(strlen($callback) > 1){
				header("Content-Type: application/javascript");
				$html = "{$callback}({\"html\":" . json_encode($html) . "});";
			}

			echo $html;

		?>



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
		        	<!-- <site-nav> -->
						<?php 
							include($path . $site_nav);
						?>
					<!-- </site-nav> -->
		        </div>
		        <div class="main-container">
		            <div class="main clearfix">

		                <!-- <economic-development> -->
							<?php 
								$file = "main-content-styles-playground.php";
								include($path . $content . $test . $file);
							?>
						<!-- </economic-development> -->

		            </div> <!-- .main -->
		        </div> <!-- .main-container -->
		        <!-- <div.footer-container> -->
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
			<?php /*
				$file = "site-analytics.php";
				include($path . $file); */
			?>
		<!-- </googleanalytics> -->
    </body>
</html>