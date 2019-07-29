<?php
include "include/mainphp.php";
require(WP_HEADER_PATH); //wordpress	
goEnvir(($detect->isMobile() || $detect->isTablet()),'','');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>TR Zell Cell Therapy Anti-Aging and Beauty Products | Swiss Cell Therapy Anti Aging</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php include "include/mainscript.php"; ?>
<meta property="og:image" content="http://www.trzell.com/images/trzell-box-1.jpg" />
<meta property="og:title" content="TR Zell Cell Therapy Anti-Aging and Beauty Products | Swiss Cell Therapy Anti Aging"/>
<meta property="og:site_name" content="TR Zell"/>
<meta property="og:url" content="http://www.trzell.com/"/>
<meta property="og:description" content="TR Zell Swiss Sheep Cell Therapy for Anti Aging supplements are premium cell therapy soft gels. Developed in Switzerland, TR Zell’s natural ingredients enhance personal beauty, health, and performance"/>
<meta name="author" content="TR Zell" />
<meta name="description" content="TR Zell Swiss Sheep Cell Therapy for Anti Aging supplements are premium cell therapy soft gels. Developed in Switzerland, TR Zell’s natural ingredients enhance personal beauty, health, and performance." />
<meta name="keywords" content="tr zell, trzell, cell, therapy, sheep, placenta, anti-aging, swiss"/>
<link rel="stylesheet" href="js/swiperjs/css/swiper.min.css">
<script>
$(window).load(function(){
	$('.loader_pnl').fadeOut(1000);
    $('.mbody').fadeIn(1000,function(){
	   $('.banner').css("display","block");
       start_init();
    });
});
</script>

<!-- Facebook Pixel Code -->

<script>

!function(f,b,e,v,n,t,s)

{if(f.fbq)return;n=f.fbq=function(){n.callMethod?

n.callMethod.apply(n,arguments):n.queue.push(arguments)};

if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';

n.queue=[];t=b.createElement(e);t.async=!0;

t.src=v;s=b.getElementsByTagName(e)[0];

s.parentNode.insertBefore(t,s)}(window,document,'script',

'https://connect.facebook.net/en_US/fbevents.js');


fbq('init', '270959323324590'); 

fbq('track', 'PageView');

</script>

<noscript>

<img height="1" width="1" 

<src="https://www.facebook.com/tr?id=270959323324590&ev=PageView

&noscript=1"/>

</noscript>

<!-- End Facebook Pixel Code -->


</head>
<body class='mbody' <?php  if($showlang) echo "onload='openPop()'"; elseif ($shownewspopup) echo "onload='openPop_news()'"; ?>>
<div id="main_cont">
	<?php include "include/header.php"; ?>
	<div id='slidepanel-pnl'>
		<div class='loader_pnl'>
			<div class='loader_img_pnl'>
				<img src='images/trzell-loading.gif'/>
			</div>
		</div>
		<div class="swiper-container banner">
		    <div class="swiper-wrapper">
		        <div class="swiper-slide"><div class='slide-img' style="background-image:url('images/trzell-home-slider-1.jpg')">&nbsp;</div></div>
		        <div class="swiper-slide"><div class='slide-img' style="background-image:url('images/trzell-home-slider-2.jpg')">&nbsp;</div></div>
		        <div class="swiper-slide"><div class='slide-img' style="background-image:url('images/trzell-home-slider-3.jpg')">&nbsp;</div></div>
			</div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
	<div class='mbodycont-exp blue-back'>
		<div class='mbodycont-sec'>
			<div id="middle-h-middlecont-exp">
				<h1 class='h2-h-middle-title-exp white-txt'>TR Zell P-Centa "Improved &amp; Stronger Formula"</h1>
				<div class='h-middle-txt-b white-txt'>
				 TR Zell P-Centa delivers all the benefits of cell therapy within an effortless daily dose softgel. Taken before breakfast, TR Zell P-Centa regenerates your body, enhances skin, and provides energy to live TRue. 
				</div>
				<hr class='hr-line-white'/>
				<h2 class='h2-h-middle-title-exp white-txt'>Cell Therapy</h2>
				<div class='h-middle-txt-b white-txt'>
				 Cell therapy is a specialized treatment that uses live cells to heal damaged organs throughout the body. This painless and natural remedy has been used for decades by celebrities and historical figures, and is now available to the public. 
				</div>
			</div>
		</div>
	</div>
	<div class='mbodycont-exp gray-back'>
		<div class='mbodycont-sec'>
			<div id="h-middlecont-exp">
				<h2 class='light-black-txt h2-h-middleicon-pnl-title-exp'>Benefits</h2>
				<div class="btable">
					<div class="brow">
						<div class="bodycell h-middleicon-cell">
							<div class='h-middleicon-block'>
								<img class='middleicon-img' src='images/trzell-health-logo.png' alt='TR Zell Cell Therapy Health Benefits'/>
								<div class='light-black-txt middleicon-title'>Health</div>
								<div class='light-black-txt middleicon-txt-b'>Strengthens the immune system while rebuilding cells.</div>
							</div>
						</div>
						<div class="bodycell h-middleicon-cell">
							<div class='h-middleicon-block'>
								<img class='middleicon-img' src='images/trzell-beauty-icon.png' alt='TR Zell Cell Therapy Beauty Benefits'/>
								<div class='light-black-txt middleicon-title'>Beauty</div>
								<div class='light-black-txt middleicon-txt-b'>Increases collagen which improves skin elasticity for a more attractive, youthful appearance.</div>
							</div>
						</div>
						<div class="bodycell h-middleicon-cell">
							<div class='h-middleicon-block'>
								<img class='middleicon-img' src='images/trzell-performance-icon.png' alt='TR Zell Cell Therapy Performance Benefits'/>
								<div class='middleicon-title light-black-txt'>Performance</div>
								<div class='light-black-txt middleicon-txt-b'>Increases daily energy and promotes an ideal sleep cycle. </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class='mbodycont-blog'>
    	<div class='mbodycont-sec'>
			<div id="hh-middlecont-blog">
				<h2 class='black-txt h2-h-middleicon-pnl-title-exp'>Live TRue Blog</h2>
				<!--BLOG PARTS-->
                <?php
                // $args = array( 'posts_per_page' => 5, 'offset'=> 1, 'category' => 1 );
                $count=1;
                $posts = get_posts('numberposts=5&order=DESC');
                foreach ($posts as $post) : setup_postdata( $post );
                $rcount=$count%2;
                if($rcount==0)
                	echo "<hr class='post_line'/>";
                ?>
				<div class='post_block'>
					<div class='post_title'><a class='post_title_link' href='<?php the_permalink() ?>' target="_blank"><?php echo the_title(); ?></a></div>
					<div class='post_date'><?php echo the_time('n.j.y'); ?></div>
				</div>
				<?php
				$count++;
                endforeach;
                wp_reset_postdata();
                ?>
				<!--END OF BLOG PARTS-->
			</div>
		</div>
    </div>
    <div class='mbodycont-exp' style="background-color:#f4f4f4">
		<div class='mbodycont-sec'>
			<div id="middle-h-middlecont-exp">
				<h2 class='h2-h-middle-title-exp black-txt'>Approved Licenses</h2>
				<div class='btable'>
					<div class='brow's>
						<!-- <div class="bodycell hlabel-cell"><img src="images/trzell-certifications-4.png" alt='FDA Compliance'/><br/><a class='hlabel-cell-link black-txt' href='http://www.fda.gov/' target='_blank'>FDA Compliance</a></div> -->
						<div class="bodycell hlabel-cell"><img src="images/trzell-certification-1.png" alt='Islamic Service of America (Halal)'/><br/><a class='hlabel-cell-link black-txt' href='http://www.isahalal.org/' target='_blank'>Islamic Service of <br/>America (Halal)</a></div>
						<div class="bodycell hlabel-cell"><img src="images/trzell-certifications-5.png" alt='New Zealand Food Safety Authority'/><br/><a class='hlabel-cell-link black-txt' href='http://www.foodsafety.govt.nz/' target='_blank'>New Zealand <br/>Food Safety Authority</a></div>
						<div class="bodycell hlabel-cell"><img src="images/trzell-certifications-2.png" alt='Current Good Manufacturing Practice'/><br/><a class='hlabel-cell-link black-txt' href='http://www.fda.gov/Food/GuidanceRegulation/CGMP/default.htm' target='_blank'>Current Good <br/>Manufacturing Practice</a></div>
					</div>
				</div>
				<br/>
				<div style="text-align:center"><img src="images/trzell-certifications-3.png" alt='New Zealand Govt. BSE Free Certification'/><br/><a class='hlabel-cell-link black-txt' href='http://www.mpi.govt.nz/' target='_blank'>New Zealand Govt. <br/>BSE Free Certification</a></div>
				<h2 class='h2-h-middle-title-exp black-txt'>Certifications</h2>
				<div class='btable'>
					<div class='brow's>
						<div class="bodycell hlabel-cell"><img src="images/trzell-certification-logo.png" alt='All purpose Certificate'/><br/><a class='hlabel-cell-link black-txt' href='http://www.trzell.com/images/all-purpose-fsc1-410005-2.jpg' target='_blank'>All Purpose Certificate</a></div>
						<div class="bodycell hlabel-cell"><img src="images/trzell-certification-logo.png" alt='All purpose Certificate'/><br/><a class='hlabel-cell-link black-txt' href='http://www.trzell.com/images/manufacturer-certificate-food.jpg' target='_blank'>GMP Certificate</a></div>
						<div class="bodycell hlabel-cell"><img src="images/trzell-certification-logo.png" alt='All purpose Certificate'/><br/><a class='hlabel-cell-link black-txt' href='http://www.trzell.com/images/isa-halal-certificate-eckhart 2014.jpg' target='_blank'>Halal Certification</a></div>
						<div class="bodycell hlabel-cell"><img src="images/trzell-certification-logo.png" alt='All purpose Certificate'/><br/><a class='hlabel-cell-link black-txt' href='http://www.trzell.com/images/pages-from 051117-qmsc-2.jpg' target='_blank'>Secretary of State <br/>California</a></div>
			</div>
		</div>
	</div>

	<div class='mbodycont-video'>
		<div class='mbodycont-sec'>
			<div id="h-middlecont-exp">
				<div id='image-video-pnl'>
					<img src="images/trzell-video.jpg" alt='TR Zell Cell Therapy Youtube Introduction Video'/>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfooter"></div>
</div>
<?php
include "include/footer.php"; 
?>
<script src="js/swiperjs/js/swiper.jquery.min.js"></script>
</body>
</html>