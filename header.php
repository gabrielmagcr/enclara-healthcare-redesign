<?php


//site root
$root = get_template_directory_uri();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="utf-8">

    <title><?php wp_title(''); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <script src="<?php echo "$root/assets/js/modernizr.js"; ?>"></script>

    <link rel="shortcut icon" href="<?php echo "$root/assets/img/favicon.png"; ?>">
    <link rel="apple-touch-icon" href="<?php echo "$root/assets/img/apple-touch-icon.png"; ?>">

    <link rel="stylesheet" media="screen,projection" href="<?php echo "$root/assets/css/screen.css"; ?>">
    <link rel="stylesheet" media="print" href="<?php echo "$root/assets/css/print.css"; ?>">

    <!--Font Awesome-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

    <!--[if lt IE 9]>
    <link rel="stylesheet" media="print" href="<?php echo " $root/assets/css/ie.css"; ?>">
    <script type="text/javascript" src="<?php echo "$root/assets/js/polyfill/respond.js"; ?>"></script>
    <script type = "text/javascript" src="<?php echo "$root/assets/js/polyfill/selectivizr-min.js"; ?>" ></script>
    <![endif]-->

    <?php wp_head(); ?>
    <script>
        window.themeConfig = {
            root: '<?php echo get_template_directory_uri(); ?>',
            siteRoot: '<?php echo get_site_url(); ?>'
        };
        !window.jQuery && document.write('<script src="<?php echo "$root/assets/js/jquery-1.11.1.min.js"; ?>"><\/script>');
    </script>

    <script>
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
     })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
     ga('create', 'UA-21588815-7', 'auto');
     ga('send', 'pageview');
    </script>
    <style>
	    .home-companies .inner {
			display: -webkit-box;
			display: -ms-flexbox;		    
		    display: flex;
			-webkit-box-orient: vertical;
    		-webkit-box-direction: normal;
        	-ms-flex-flow: column;
            flex-flow: column;
			-webkit-box-pack: center;
	        -ms-flex-pack: center;
            justify-content: center;			
	    }
	    
	    @media (min-width: 767px) {
		    .home-companies .inner {
				-webkit-box-orient: vertical;
    			-webkit-box-direction: normal;			    
			    -ms-flex-flow: row nowrap;
			    flex-flow: row nowrap;
		    }
	    }
    </style>

</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<svg id="svg-icon-defs">
    <defs>
        <linearGradient id="icongradient" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#5391c0 "/>
            <stop offset="35%" stop-color="#5391c0 "/>
            <stop offset="100%" stop-color="#526b9a "/>
        </linearGradient>
    </defs>
</svg>

<div id="site-container">

    <header id="header" class="site-header" itemscope itemtype="http://schema.org/WPHeader">
        <div class="inner">
            <div class="site-header_left">
                <div class="group-liner">
                    <a id="site-title" href="<?php echo get_site_url(); ?>">
                        <span><?php echo bloginfo('site_title'); ?></span>
                    </a>
                    <button id="main-nav-toggle" class="mobile-toggle">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span class="mttext">Menu</span>
                        <span class="mt-top"></span><span class="mt-mid"></span><span class="mt-bot"></span>
                    </button>
                </div>
            </div>
            <div class="site-header_right">
              <nav id="main-nav" class="primary-nav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
                <ul>
                    <li class="<?php if (is_page_template('templates/about.php')) { echo 'is-current-page'; } ?>">
                        <a href="<?php echo get_site_url() . '/about'; ?>">About</a>
                    </li>
                    <li class="<?php if (is_page_template('templates/companies.php')) {echo 'is-current-page';} ?>">
                        <a href="<?php echo get_site_url() . '/companies'; ?>">Companies</a>
                    </li>
                    <li class="<?php if (is_page_template('templates/contact.php')) {echo 'is-current-page';} ?>">
                        <a href="<?php echo get_site_url() . '/contact'; ?>">Contact Us</a>
                    </li>
                </ul>
              </nav>
            </div>
        </div>
    </header>

    <main id="main" role="mainContentofPage">
