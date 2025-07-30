<?php
// Include content loader
require_once 'content-loader.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<meta name="description" content="Experience the pinnacle of luxury and cultural innovation with CHANEL x LEE JUN HO. Discover groundbreaking art, fashion, and technology initiatives shaping the future.">
	<meta name="keywords" content="CHANEL, Lee Jun Ho, luxury fashion, cultural innovation, partnership, art, K-pop, brand collaboration, high fashion, investment yield, global reach, creative industry, digital renaissance, premium design, futuristic web">
	<meta name="author" content="CHANEL x LEE JUN HO">
	<!-- Page Title -->
    <title>CHANEL x LEE JUN HO | Cultural Innovation Partnership - Elite Edition</title>
	<!-- Favicon Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="/images/logo/favicon.png">
	<!-- Google Fonts Css-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&amp;family=Jost:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet">
	<!-- Bootstrap Css -->
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<!-- SlickNav Css -->
	<link href="css/slicknav.min.css" rel="stylesheet">
	<!-- Swiper Css -->
	<link rel="stylesheet" href="css/swiper-bundle.min.css">
	<!-- Font Awesome Icon Css-->
	<link href="css/all.min.css" rel="stylesheet" media="screen">
	<!-- Animated Css -->
	<link href="css/animate.css" rel="stylesheet">
    <!-- Magnific Popup Core Css File -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Mouse Cursor Css File -->
	<link rel="stylesheet" href="css/mousecursor.css">
	<!-- Main Custom Css -->
	<link href="css/custom.css" rel="stylesheet" media="screen">
	<!-- Content Editor Css -->
	<link href="css/editor.css" rel="stylesheet" media="screen">
</head>
<body>

    <!-- Preloader Start -->
	<div class="preloader">
		<div class="loading-container">
			<div class="loading"></div>
			<div id="loading-icon">
                <img src="/images/logo/logo-chanel.png" alt="CHANEL x LEE JUN HO">
            </div>
		</div>
	</div>
	<!-- Preloader End -->

    <!-- Header Start -->
	<header class="main-header">
		<div class="header-sticky">
			<nav class="navbar navbar-expand-lg">
				<div class="container">
					<!-- Logo Start -->
					<a class="navbar-brand" href="index-dynamic.php">
                        <img src="/images/logo/logo-chanel.png" alt="CHANEL x LEE JUN HO" class="logo">
					</a>
					<!-- Logo End -->

					<!-- Main Menu Start -->
					<div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu">
                                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                                <li class="nav-item submenu"><a class="nav-link" href="#about">Partnership</a>
                                    <ul>
                                        <li class="nav-item"><a class="nav-link" href="#vision">The Collaboration</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#gallery">Partnership Gallery</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#beneficiaries">Our Team</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
                                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                                <li class="nav-item"><a class="nav-link" href="admin/login.php">Login</a></li>
                            </ul>
                        </div>

                        <!-- Header Btn Start -->
                        <div class="header-btn">
                            <a href="#contact" class="btn-default">get in touch</a>
                        </div>
                        <!-- Header Btn End -->
					</div>
					<!-- Main Menu End -->
					<div class="navbar-toggle"></div>
				</div>
			</nav>
			<div class="responsive-menu"></div>
		</div>
	</header>
	<!-- Header End -->

    <!-- Hero Section Start -->
    <div class="hero hero-video" id="home">
        <!-- Video Start -->
        <div class="hero-bg-video">
            <!-- Youtube Video Start -->
            <div id="herovideo" class="player" data-property="{videoURL:'<?php echo getYouTubeVideoId('hero-video-url', 'oo74I-aNlUw'); ?>',containment:'.hero-video', showControls:false, autoPlay:true, loop:true, vol:0, mute:false, startAt:0,  stopAt:296, opacity:1, addRaster:true, quality:'large', optimizeDisplay:true}"></div>
            <!-- Youtube Video End -->
        </div>
        <!-- Video End -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Hero Content Start -->
                    <div class="hero-content">
                        <!-- Section Title Start -->
                        <div class="section-title dark-section">
                            <h3 class="wow fadeInUp"><?php echo getContent('hero-subtitle', 'luxury redefined'); ?></h3>
                            <h1 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span><?php echo getContent('hero-title', 'CHANEL X LEE JUN HO'); ?></span></h1>
                            <p class="wow fadeInUp" data-wow-delay="0.4s"><?php echo getContent('hero-description', 'Where luxury meets innovation: CHANEL and Lee Jun Ho unite to redefine cultural boundaries, creating an unprecedented fusion of haute couture excellence and contemporary artistic vision that transcends traditional brand collaborations.'); ?></p>
                        </div>
                        <!-- Section Title End -->                        

                        <!-- Hero Body Start -->
                        <div class="hero-body wow fadeInUp" data-wow-delay="0.6s">
                            <!-- Hero Button Start -->
                            <div class="hero-btn">
                                <a href="#vision" class="btn-default btn-highlighted"><?php echo getContent('hero-btn-primary', 'Discover More'); ?></a>
                                <a href="#contact" class="btn-default"><?php echo getContent('hero-btn-secondary', 'Contact Us'); ?></a>
                            </div>
                            <!-- Hero Button End -->
                        </div>
                        <!-- Hero Body End -->
                    </div>
                    <!-- Hero Content End -->
                </div>
            </div>
        </div>
        <div class="down-arrow">
			<a href="#home-about"><i class="fa-solid fa-arrow-down-long"></i></a>
		</div>
    </div>
    <!-- Hero Section End -->

    <!-- About Us Section Start -->
    <div class="about-us" id="vision">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-7">
                    <!-- Section Tite Content Button Start -->
                    <div class="section-title-content-btn">
                        <!-- Section Tite Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp"><?php echo getContent('about-subtitle', 'the collaboration'); ?></h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><?php echo getContent('about-title', 'CHANEL x LEE JUN HO Partnership'); ?></h2>
                        </div>
                        <!-- Section Tite End -->

                        <!-- Section Button Start -->
                        <div class="section-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="#gallery" class="btn-default"><?php echo getContent('about-btn', 'explore collection'); ?></a>
                        </div>
                        <!-- Section Button End -->
                    </div>
                    <!-- Section Tite Content Button End -->
                </div>
                
                <div class="col-lg-5">
                    <!-- Section Title Content Start -->
                    <div class="section-title-content">
                        <p class="wow fadeInUp" data-wow-delay="0.4s"><?php echo getContent('about-description', 'Through this strategic partnership, CHANEL and Lee Jun Ho are launching exclusive collections, immersive digital experiences, and cultural initiatives that bridge the gap between haute couture excellence and contemporary pop culture. Their collaborative vision extends beyond fashion, encompassing art, technology, and social impact, setting new standards for brand collaborations in the luxury sector.'); ?></p>
                    </div>
                    <!-- Section Tite Content End -->
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- About Us Image Start -->
                    <div class="about-us-image">
                        <figure class="image-anime reveal">
                            <img src="/images/media/about.png" alt="CHANEL x LEE JUN HO Partnership">
                        </figure>
                    </div>
                    <!-- About Us Image End -->
                </div>

                <div class="col-lg-12">
                    <!-- About Counter Box Start -->
                    <div class="about-counter-box">
                        <!-- About Counter Item Start -->
                        <div class="about-counter-item">
                           <h2><span class="counter"><?php echo getContent('counter-1-value', '50'); ?></span>M+</h2>
                           <h3><?php echo getContent('counter-1-label', 'Social Media Reach'); ?></h3>
                        </div>
                        <!-- About Counter Item End -->
                        
                        <!-- About Counter Item Start -->
                        <div class="about-counter-item">
                            <h2>$<span class="counter"><?php echo getContent('counter-2-value', '25'); ?></span>M</h2>
                            <h3><?php echo getContent('counter-2-label', 'Partnership Value'); ?></h3>
                        </div>
                        <!-- About Counter Item End -->

                        <!-- About Counter Item Start -->
                        <div class="about-counter-item">
                            <h2><span class="counter"><?php echo getContent('counter-3-value', '8'); ?></span></h2>
                            <h3><?php echo getContent('counter-3-label', 'Exclusive Collections'); ?></h3>
                        </div>
                        <!-- About Counter Item End -->
                         
                        <!-- About Counter Item Start -->
                        <div class="about-counter-item">
                            <h2><span class="counter"><?php echo getContent('counter-4-value', '15'); ?></span></h2>
                            <h3><?php echo getContent('counter-4-label', 'Global Campaigns'); ?></h3>
                        </div>
                        <!-- About Counter Item End -->
                    </div>
                    <!-- About Counter Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- About Us Section End -->

    <!-- Our Beneficiaries Section Start -->
    <div class="our-team" id="beneficiaries">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp"><?php echo getContent('team-subtitle', 'partnership team'); ?></h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><?php echo getContent('team-title', 'CHANEL x LEE JUN HO Collaboration'); ?></h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <!-- Team Item Start -->
                    <div class="team-item wow fadeInUp">
                        <!-- Team Image Start -->
                        <div class="team-image">
                            <a href="#" data-cursor-text="View">
                                <figure>
                                    <img src="/images/team/1.png" alt="Rubi Holloway - Beneficiary Lead">
                                </figure>
                            </a>
                            
                            <!-- Team Social Icon Start -->
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <!-- Team Social Icon End -->
                        </div>	
                        <!-- Team Image End -->

                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3><a href="#"><?php echo getContent('team-member-1-name', 'Rubi Holloway'); ?></a></h3>
                            <p><?php echo getContent('team-member-1-role', 'CHANEL Creative Director'); ?></p>
                            <div class="yield-indicator"><?php echo getContent('team-member-1-indicator', 'Partnership Strategy Lead'); ?></div>
                        </div>
                        <!-- Team Content End -->
                    </div>
                    <!-- Team Item End -->
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <!-- Team Item Start -->
                    <div class="team-item wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Team Image Start -->
                        <div class="team-image">
                            <a href="#" data-cursor-text="View">
                                <figure>
                                    <img src="/images/team/2.jpg" alt="Connie Menn - Beneficiary Manager">
                                </figure>
                            </a>
                            
                            <!-- Team Social Icon Start -->
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <!-- Team Social Icon End -->
                        </div>	
                        <!-- Team Image End -->

                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3><a href="#"><?php echo getContent('team-member-2-name', 'Connie Menn'); ?></a></h3>
                            <p><?php echo getContent('team-member-2-role', 'Lee Jun Ho\'s Manager'); ?></p>
                            <div class="yield-indicator"><?php echo getContent('team-member-2-indicator', 'Global Brand Ambassador'); ?></div>
                        </div>
                        <!-- Team Content End -->
                    </div>
                    <!-- Team Item End -->
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <!-- Team Item Start -->
                    <div class="team-item wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Team Image Start -->
                        <div class="team-image">
                            <a href="#" data-cursor-text="View">
                                <figure>
                                    <img src="/images/team/3.jpg" alt="Lena Sofia - Cultural Innovator">
                                </figure>
                            </a>
                            
                            <!-- Team Social Icon Start -->
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <!-- Team Social Icon End -->
                        </div>	
                        <!-- Team Image End -->

                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3><a href="#"><?php echo getContent('team-member-3-name', 'Lena Sofia'); ?></a></h3>
                            <p><?php echo getContent('team-member-3-role', 'Partnership Coordinator'); ?></p>
                            <div class="yield-indicator"><?php echo getContent('team-member-3-indicator', 'Campaign Development'); ?></div>
                        </div>
                        <!-- Team Content End -->
                    </div>
                    <!-- Team Item End -->
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <!-- Team Item Start -->
                    <div class="team-item wow fadeInUp" data-wow-delay="0.6s">
                        <!-- Team Image Start -->
                        <div class="team-image">
                            <a href="#" data-cursor-text="View">
                                <figure>
                                    <img src="/images/team/4.jpg" alt="Ella Marie - Innovation Nexus Lead">
                                </figure>
                            </a>
                            
                            <!-- Team Social Icon Start -->
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <!-- Team Social Icon End -->
                        </div>	
                        <!-- Team Image End -->

                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3><a href="#"><?php echo getContent('team-member-4-name', 'Ella Marie'); ?></a></h3>
                            <p><?php echo getContent('team-member-4-role', 'Digital Innovation Lead'); ?></p>
                            <div class="yield-indicator"><?php echo getContent('team-member-4-indicator', 'Technology Integration'); ?></div>
                        </div>
                        <!-- Team Content End -->
                    </div>
                    <!-- Team Item End -->
                </div>

                <div class="col-lg-12">
                    <!-- Section Footer Button Start -->
                    <div class="section-footer-btn wow fadeInUp" data-wow-delay="0.8s">
                        <a href="#gallery" class="btn-default"><?php echo getContent('team-btn', 'explore partnership'); ?></a>
                    </div>
                    <!-- Section Footer Button End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Beneficiaries Section End -->

    <!-- Partnership Showcase Section Start -->
    <div class="intro-video">
        <div class="container-fluid">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp"><?php echo getContent('showcase-subtitle', 'partnership showcase'); ?></h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><?php echo getContent('showcase-title', 'Witness the fusion of luxury & innovation'); ?></h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row no-gutters">
                <div class="col-lg-12">
                    <!-- Partnership Showcase Box Start -->
                    <div class="intro-video-box">
                        <div class="intro-bg-image">
                            <a href="<?php echo getContent('showcase-video-url', 'https://www.youtube.com/watch?v=fVsbt8c4HWo'); ?>" class="popup-video" data-cursor-text="Watch">
                                <figure>
                                    <img src="images/media/partnership-2.png" alt>
                                </figure>
                            </a>                            
                        </div>
                        <!-- Video Play Button Start -->
                        <div class="video-play-button">
                            <a href="<?php echo getContent('showcase-video-url', 'https://www.youtube.com/watch?v=fVsbt8c4HWo'); ?>" class="popup-video" data-cursor-text="Watch">
                                <i class="fa-solid fa-play"></i>
                            </a>
                        </div>
                        <!-- Video Play Button End -->
                    </div>
                    <!-- Partnership Showcase Box End -->
                </div>                
            </div>
        </div>
    </div>
    <!-- Partnership Showcase Section End -->

    <!-- Our Gallery Section Start -->
    <div class="our-gallery" id="gallery">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp"><?php echo getContent('gallery-subtitle', 'partnership gallery'); ?></h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><?php echo getContent('gallery-title', 'A visual symphony of our collaboration'); ?></h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <!-- gallery section start -->
            <div class="row gallery-items page-gallery-box">
                <div class="col-lg-4 col-6">
                    <!-- image gallery start -->
                    <div class="photo-gallery wow fadeInUp">
                        <a href="images/collections/bleu-de-chanel-eau-de-toilette-spray-3-4fl-oz--packshot-default-107460-9564920184862.avif" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="images/collections/bleu-de-chanel-eau-de-toilette-spray-3-4fl-oz--packshot-default-107460-9564920184862.avif" alt="CHANEL x LEE JUN HO Exclusive Collection">
                            </figure>
                        </a>
                    </div>
                    <!-- image gallery end -->
                </div>

                <div class="col-lg-4 col-6">
                    <!-- image gallery start -->
                    <div class="photo-gallery wow fadeInUp" data-wow-delay="0.2s">
                        <a href="images/collections/1690923071641-10204538568734jpeg_600x600.webp" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="images/collections/1690923071641-10204538568734jpeg_600x600.webp" alt="CHANEL x LEE JUN HO Luxury Collection">
                            </figure>
                        </a>
                    </div>
                    <!-- image gallery end -->
                </div>

                <div class="col-lg-4 col-6">
                    <!-- image gallery start -->
                    <div class="photo-gallery wow fadeInUp" data-wow-delay="0.4s">
                        <a href="images/collections/1690923149624-10196617134110jpeg_600x600.webp" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="images/collections/1690923149624-10196617134110jpeg_600x600.webp" alt="CHANEL x LEE JUN HO Premium Collection">
                            </figure>
                        </a>
                    </div>
                    <!-- image gallery end -->
                </div>

                <div class="col-lg-4 col-6">
                    <!-- image gallery start -->
                    <div class="photo-gallery wow fadeInUp" data-wow-delay="0.6s">
                        <a href="images/collections/1690923306843-10198472359966jpeg_600x600.webp" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="images/collections/1690923306843-10198472359966jpeg_600x600.webp" alt="CHANEL x LEE JUN HO Signature Collection">
                            </figure>
                        </a>
                    </div>
                    <!-- image gallery end -->
                </div>

                <div class="col-lg-4 col-6">
                    <!-- image gallery start -->
                    <div class="photo-gallery wow fadeInUp" data-wow-delay="0.8s">
                        <a href="images/collections/bleu-de-chanel-eau-de-toilette-spray-3-4fl-oz--packshot-default-107460-9564920184862.avif" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="images/collections/bleu-de-chanel-eau-de-toilette-spray-3-4fl-oz--packshot-default-107460-9564920184862.avif" alt="CHANEL x LEE JUN HO Global Collection">
                            </figure>
                        </a>
                    </div>
                    <!-- image gallery end -->
                </div>

                <div class="col-lg-4 col-6">
                    <!-- image gallery start -->
                    <div class="photo-gallery wow fadeInUp" data-wow-delay="1s">
                        <a href="images/collections/1690923071641-10204538568734jpeg_600x600.webp" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="images/collections/1690923071641-10204538568734jpeg_600x600.webp" alt="CHANEL x LEE JUN HO Innovation Collection">
                            </figure>
                        </a>
                    </div>
                    <!-- image gallery end -->
                </div>
            </div>
            <!-- gallery section end -->
        </div>
    </div>
    <!-- Our Gallery Section End -->

    <!-- Our Testimonial Section Start -->
    <div class="our-testimonial parallaxie">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp"><?php echo getContent('testimonials-subtitle', 'industry insights'); ?></h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><?php echo getContent('testimonials-title', 'Voices from the luxury frontier'); ?></h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Testimonial Slider Start -->
                    <div class="testimonial-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper" data-cursor-text="Drag">
                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-quote">
                                            <img src="fonts/testimonial-quote.svg" alt>
                                        </div>
                                        <div class="testimonial-content">
                                            <p><?php echo getContent('testimonial-1-content', 'The CHANEL x LEE JUN HO promotional collaboration represents a revolutionary breakthrough in luxury brand partnerships. Their innovative approach to merging haute couture with contemporary pop culture has set unprecedented standards for the industry. This strategic alliance has created a cultural phenomenon that transcends traditional celebrity endorsements.'); ?></p>
                                        </div>
                                        <div class="author-info">
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    <img src="images/author-1.jpg" alt="Marco Bizzarri">
                                                </figure>
                                             </div>            
                                            <div class="author-content">
                                                <h3><?php echo getContent('testimonial-1-author', 'Marco Bizzarri / Luxury Industry Expert'); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-quote">
                                            <img src="fonts/testimonial-quote.svg" alt>
                                        </div>
                                        <div class="testimonial-content">
                                            <p><?php echo getContent('testimonial-2-content', 'This promotional collaboration transcends traditional boundaries between luxury fashion and global entertainment. The way CHANEL and Lee Jun Ho have integrated cultural innovation with premium branding creates an entirely new ecosystem for strategic partnerships. It\'s a masterclass in modern luxury brand collaboration that redefines industry standards.'); ?></p>
                                        </div>
                                        <div class="author-info">
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    <img src="images/author-2.jpg" alt="Dr. Elena Rodriguez">
                                                </figure>
                                            </div>            
                                            <div class="author-content">
                                                <h3><?php echo getContent('testimonial-2-author', 'Dr. Elena Rodriguez / Cultural Innovation Director'); ?></h3>
                                            </div>
                                        </div>                                    
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-quote">
                                            <img src="fonts/testimonial-quote.svg" alt>
                                        </div>
                                        <div class="testimonial-content">
                                            <p><?php echo getContent('testimonial-3-content', 'The digital renaissance CHANEL and Lee Jun Ho are spearheading through this promotional collaboration is remarkable. Their approach to blending haute couture with cutting-edge technology while maintaining cultural authenticity and luxury standards is exactly what the industry needs to evolve and thrive in the digital age.'); ?></p>
                                        </div>
                                        <div class="author-info">
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    <img src="images/author-2.jpg" alt="Alexander Kim">
                                                </figure>
                                            </div>            
                                            <div class="author-content">
                                                <h3><?php echo getContent('testimonial-3-author', 'Alexander Kim / Digital Innovation Strategist'); ?></h3>
                                            </div>
                                        </div>                                    
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->
                            </div>
                            <div class="testimonial-pagination"></div>
                        </div>
                    </div>
                    <!-- Testimonial Slider End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Testimonial Section End -->

    <!-- Our Blog Section Start -->
    <div class="our-blog">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp"><?php echo getContent('blog-subtitle', 'latest insights'); ?></h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><?php echo getContent('blog-title', 'Stay updated with our latest innovations'); ?></h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <!-- Post Item Start -->
                    <div class="post-item highlighted-post wow fadeInUp">
                        <!-- Post Featured Image Start-->
                        <div class="post-featured-image">
                            <a href="blog-single.html" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/post-1.jpg" alt="CHANEL x LEE JUN HO Fashion Week">
                                </figure>
                            </a>
                        </div>
                        <!-- Post Featured Image End -->

                        <!-- Post Item Body Start -->
                        <div class="post-item-body">
                            <!-- Post Item Content Start -->
                            <div class="post-item-content">
                                <h3><a href="blog-single.html"><?php echo getContent('blog-post-1-title', 'Exclusive: CHANEL x LEE JUN HO Debut Collection at Milan Fashion Week'); ?></a></h3>
                            </div>
                            <!-- Post Item Content End -->

                            <!-- Post Meta Start-->
                            <div class="post-meta">
                                <ul>
                                    <li><?php echo getContent('blog-post-1-author', 'Creative Team'); ?></li>
                                    <li><?php echo getContent('blog-post-1-date', '2 Feb 2025'); ?></li>
                                </ul>
                            </div>
                            <!-- Post Meta End-->
                        </div>
                        <!-- Post Item Body End -->
                    </div>
                    <!-- Post Item End -->
                </div>

                <div class="col-lg-6">
                    <!-- Latest Post Box Start -->
                    <div class="latest-post-box">
                        <!-- Post Item Start -->
                        <div class="post-item wow fadeInUp" data-wow-delay="0.2s">
                            <!-- Post Featured Image Start-->
                            <div class="post-featured-image">
                                <a href="blog-single.html" data-cursor-text="View">
                                    <figure class="image-anime">
                                        <img src="images/post-2.jpg" alt="Cultural Innovation Summit">
                                    </figure>
                                </a>
                            </div>
                            <!-- Post Featured Image End -->

                            <!-- Post Item Body Start -->
                            <div class="post-item-body">
                                <!-- Post Item Content Start -->
                                <div class="post-item-content">
                                    <h3><a href="blog-single.html"><?php echo getContent('blog-post-2-title', 'Behind the Scenes: CHANEL x LEE JUN HO Partnership Launch'); ?></a></h3>
                                </div>
                                <!-- Post Item Content End -->

                                <!-- Post Meta Start-->
                                <div class="post-meta">
                                    <ul>
                                        <li><?php echo getContent('blog-post-2-author', 'Innovation Team'); ?></li>
                                        <li><?php echo getContent('blog-post-2-date', '9 Feb 2025'); ?></li>
                                    </ul>
                                </div>
                                <!-- Post Meta End-->
                            </div>
                            <!-- Post Item Body End -->
                        </div>
                        <!-- Post Item End -->

                        <!-- Post Item Start -->
                        <div class="post-item wow fadeInUp" data-wow-delay="0.4s">
                            <!-- Post Featured Image Start-->
                            <div class="post-featured-image">
                                <a href="blog-single.html" data-cursor-text="View">
                                    <figure class="image-anime">
                                        <img src="images/post-3.jpg" alt="Digital Renaissance Project">
                                    </figure>
                                </a>
                            </div>
                            <!-- Post Featured Image End -->

                            <!-- Post Item Body Start -->
                            <div class="post-item-body">
                                <!-- Post Item Content Start -->
                                <div class="post-item-content">
                                    <h3><a href="blog-single.html"><?php echo getContent('blog-post-3-title', 'CHANEL x LEE JUN HO: Digital Innovation in Luxury'); ?></a></h3>
                                </div>
                                <!-- Post Item Content End -->

                                <!-- Post Meta Start-->
                                <div class="post-meta">
                                    <ul>
                                        <li><?php echo getContent('blog-post-3-author', 'Tech Team'); ?></li>
                                        <li><?php echo getContent('blog-post-3-date', '16 Feb 2025'); ?></li>
                                    </ul>
                                </div>
                                <!-- Post Meta End-->
                            </div>
                            <!-- Post Item Body End -->
                        </div>
                        <!-- Post Item End -->
                    </div>
                    <!-- Latest Post Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Blog Section End -->

    <!-- CTA Box Start -->
    <div class="cta-box">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <!-- Section Tite Start -->
                    <div class="section-title">
                        <h2 class="wow fadeInUp"><?php echo getContent('cta-title', 'Experience the CHANEL x LEE JUN HO collaboration'); ?></h2>
                    </div>
                    <!-- Section Tite End -->
                </div>
                
                <div class="col-lg-6 col-md-4">
                    <!-- Section Button Start -->
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                        <a href="#contact" class="btn-default"><?php echo getContent('cta-btn', 'connect with us'); ?></a>
                    </div>
                    <!-- Section Button End -->
                </div>
            </div>
        </div>
    </div>
    <!-- CTA Box End -->

    <!-- Footer Main Start -->
    <footer class="footer-main" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- About Footer start -->
                    <div class="about-footer">
                        <!-- Footer Logo Start -->
                        <div class="footer-logo">
                            <img src="/images/logo/logo-chanel.png" alt="CHANEL x LEE JUN HO">
                        </div>
                        <!-- Footer Logo End -->                        
                    </div>
                    <!-- About Footer End -->
                </div>

                <div class="col-lg-3 col-md-4">
                    <!-- Footer Links Start -->
                    <div class="footer-links footer-contact-box">
                        <h3>office</h3>                        
                        <ul>
                            <li><?php echo getContent('footer-address', 'Milan - Via del Babuino, 21, 00187 Roma RM, Italy'); ?></li>
                            <li><a href="mailto:<?php echo getContent('footer-email', 'partnership@chanel.com'); ?>"><?php echo getContent('footer-email', 'partnership@chanel.com'); ?></a></li>
                            <li><a href="tel:<?php echo getContent('footer-phone', '+39 012 345 6789'); ?>"><?php echo getContent('footer-phone', '+39 012 345 6789'); ?></a></li>
                        </ul>
                    </div>
                    <!-- Footer Links End -->
                </div>                

                <div class="col-lg-3 col-md-3">
                    <!-- Footer Links start -->
                    <div class="footer-links">
                        <h3>quick link</h3>
                        <ul>
                            <li><a href="#home">Home</a></li>
                            <li><a href="#vision">Our Vision</a></li>
                            <li><a href="#gallery">Partnership Gallery</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                    <!-- Footer Links end -->
                </div>

                <div class="col-lg-3 col-md-5">
                    <!-- Footer Links start -->
                    <div class="footer-links">
                        <h3>Newsletter</h3>
                        <p><?php echo getContent('footer-newsletter', 'Subscribe to our newsletter and be the first to know about exclusive CHANEL x LEE JUN HO collaboration updates, limited edition releases, and behind-the-scenes content.'); ?></p>
                        
                        <!-- Footer Newsletters Form Start -->
                        <div class="footer-newsletters-form">
                            <form id="newslettersForm" action="#" method="POST">
                                <div class="form-group">
                                    <i class="fa-regular fa-envelope"></i>
                                    <input type="email" name="mail" class="form-control" id="mail" placeholder="Enter your email" required>
                                    <button type="submit"><img src="fonts/arrow-white.svg" alt></button>
                                </div>
                            </form>
                        </div>
                        <!-- Footer Newsletters Form End -->
                    </div>
                    <!-- Footer Links end -->
                </div>

                <div class="col-lg-12">
                    <!-- Footer Copyright Section Start -->
                    <div class="footer-copyright">
                        <!-- Footer Copyright Start -->
                        <div class="footer-copyright-text">
                            <p><?php echo getContent('footer-copyright', 'Copyright © 2025 CHANEL x LEE JUN HO Partnership. All Rights Reserved.'); ?></p>
                        </div>
                        <!-- Footer Copyright End -->

                        <!-- Footer Social Link Start -->
                        <div class="footer-social-links">
                            <span>Follow us on social</span>
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            </ul>
                        </div>
                        <!-- Footer Social Link End -->
                    </div>
                    <!-- Footer Copyright Section End -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Main End -->

    <!-- Jquery Library File -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap js file -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Validator js file -->
    <script src="js/validator.min.js"></script>
    <!-- SlickNav js file -->
    <script src="js/jquery.slicknav.js"></script>
    <!-- Swiper js file -->
    <script src="js/swiper-bundle.min.js"></script>
    <!-- Counter js file -->
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <!-- Magnific js file -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <!-- SmoothScroll -->
    <script src="js/SmoothScroll.js"></script>
    <!-- Parallax js -->
    <script src="js/parallaxie.js"></script>
    <!-- MagicCursor js file -->
    <script src="js/gsap.min.js"></script>
    <script src="js/magiccursor.js"></script>
    <!-- Text Effect js file -->
    <script src="js/SplitText.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <!-- YTPlayer js File -->
    <script src="js/jquery.mb.YTPlayer.min.js"></script>
    <!-- Wow js file -->
    <script src="js/wow.min.js"></script>
    <!-- Main Custom js file -->
    <script src="js/function.js"></script>
	<script src="js/theme-panel.js"></script>
	<!-- Content Editor js file -->
	<script src="js/content-editor.js"></script>
	
	<!-- Partnership Animation Script -->
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Partnership Animation Script
			console.log('CHANEL x LEE JUN HO Partnership loaded successfully');
			
			// Smooth scrolling for navigation links
			const navLinks = document.querySelectorAll('a[href^="#"]');
			navLinks.forEach(link => {
				link.addEventListener('click', function(e) {
					e.preventDefault();
					const targetId = this.getAttribute('href');
					const targetSection = document.querySelector(targetId);
					
					if (targetSection) {
						targetSection.scrollIntoView({
							behavior: 'smooth',
							block: 'start'
						});
					}
				});
			});
		});
	</script>
</body>
</html> 