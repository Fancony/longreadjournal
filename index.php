
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php bloginfo('name'); ?> - <?php if( is_home() ) : echo bloginfo( 'description' ); endif; ?><?php wp_title( '', true ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" type="text/css" href="<?PHP echo get_template_directory_uri() ?>/style.css" media="screen" />
<?php wp_head(); ?>
<!-- Load scripts -->
<script src="<?PHP echo get_template_directory_uri() ?>/js/less-1.7.4.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?skin=sunburst"></script>
</head>
<!-- Load Body -->
<body <?php body_class(); ?>>
<div id="sitewrapper">
	<nav class="st-menu st-effect-2" id="menu-2">
		<h2>Menu</h2>
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</nav>
	<!-- Push Menu -->
	<div class="st-pusher">
		<div class="st-content"><!-- this is the wrapper for the content -->
			<div class="st-content-inner"><!-- extra div for emulating position:fixed of the menu -->
				<div class="main clearfix"></div>
<?php
/*-----------------------------------------------------------------------------------*/
/* Start theme header 
/*-----------------------------------------------------------------------------------*/
if( is_home() || is_archive() || is_search()) {	?>
<header style="position:relative !important;" id="masthead" class="site-header" role="banner">
<a href="<?php get_home_url(); ?>"><img class="front-logo-top" src="<?PHP echo get_template_directory_uri() ?>/images/responsive_logo.png" alt=""/></a>
		<div id="brand">
			<div id="site-title">
				<a href="<?php get_home_url(); ?>"><img class="desktop-logo" src="<?PHP echo get_template_directory_uri() ?>/images/frontpagelogo.png" alt=""/></a>
			</div>
			<!-- NOT CURRENTLY USED. REMOVE ARROWS TO DISPLAY DESCRIPTION
				<div id="site-description">
				<?php echo get_bloginfo('description') ?>
			</div> -->
		<div style="width:100%;margin-bottom:80px;">
			<nav role="navigation" class="site-navigation">
				<div class="menu-container">
					<!-- .site-navigation .main-navigation -->
					<?php wp_nav_menu( array( 'theme_location' => 'frontpage-menu' ) ); ?>
				</div>
			</nav>
		</div>
		<div class="clear">
		</div>
	</div>		
<div style="clear:both"></div>
</header><!-- #masthead .site-header -->
<?php } ?>

<?PHP if( is_single() ) { ?>
<div style="margin-top:20px;padding-right:20px;width:100%;position:absolute;z-index:10;clear:both !important;text-align:right;" id="st-trigger-effects">
	<button style="background:url('<?PHP echo get_template_directory_uri() ?>/images/rmenuicon.png');width:40px;height:40px;z-index:10;border:none;" data-effect="st-effect-2"></button>
</div>
<?PHP } 
/*-----------------------------------------------------------------------------------*/
/* Home loop
/*-----------------------------------------------------------------------------------*/	
if( is_home() || is_archive() || is_search()) {	?>
<div style="clear:both"></div>
<div class="container">
<div id="primary">
	<div id="content" role="main">
		<?php if ( have_posts() ) : ?>
			<?php if(is_archive()) { ?>
			<div class="content-container">
				<div class="cat-name"><?php less_current_category($cat); ?></div>
			</div>
				<?php }?>
				<?php if(is_search()) { ?>
			<div class="content-container">
				<div class="cat-name"><?php the_search_query(); ?></div>
			</div>
				<?php }?>
				<?php while ( have_posts() ) : the_post(); ?>
				<article class="post">
					<div class="content-container">
						<h1 class="title">
							<a href="<?php the_permalink(); ?>">
								<?php the_title() ?>
							</a>
						</h1>					
					</div>
					<div class="the-content front-page">
						<p><?php if($post->post_excerpt)
  						$myExcerpt = get_the_excerpt();$tags = array("<p>", "</p>");$myExcerpt = str_replace($tags, "", $myExcerpt);echo $myExcerpt;?></p>
					</div>				
					<div class="meta-container">
						<div class="content-container">
							On <?php less_entry_date(); ?> in <?php less_post_category(); ?>						
							<?php lrj_article_reading_time(); ?>
							<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link"> &sdot; ', '</span>' ); ?>			
						</div> <!-- /post-meta -->
					</div>
				</article>
				<?php endwhile; ?>
				<div class="content-container">				
				<div id="pagination" class="clearfix">
					<div class="past-page"><?php previous_posts_link( 'Newer &raquo;' ); ?></div>
					<div class="next-page"><?php next_posts_link( ' &laquo; Older' ); ?></div>
				</div><!-- /pagintation -->
				</div>
				<?php else : ?>
				<article class="post error">
					<?php if(is_search()) { ?>
						<h1 class="404">There's nothing that matches your search query</h1>						
					<?php } else { ?>
						<h1 class="404">Page not found (error 404)</h1>	
					<?php } ?>
				</article>

			<?php endif; ?>
<?php } //end is_home(); 
/*-----------------------------------------------------------------------------------*/
/* Post
/*-----------------------------------------------------------------------------------*/	
if( is_single() ) { ?>							
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); 
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				<div class="featured-image" style="background-image:url(<?php echo"$feat_image"; ?>);">
					<img class="logo-top" src="<?PHP echo get_template_directory_uri() ?>/images/featured-image-logo.png" alt=""/>
					<img class="r-logo-top" src="<?PHP echo get_template_directory_uri() ?>/images/responsive_logo.png" alt=""/>
					<div class="overlay">
						<div class="title-container">
		 					<div class="feat-title"><?php the_title() ?>
		 					</div>
		 				</div>	
		 				<div class="sub-title-container">					
		 					<div class="feat-subtitle">
		 						<?php if($post->post_excerpt)
  								$myExcerpt = get_the_excerpt();$tags = array("<p>", "</p>");$myExcerpt = str_replace($tags, "", $myExcerpt);echo $myExcerpt;?>
  							</div>
		 				</div>
		 				
		 			</div>
				</div>

				<div style="clear:both;"></div>				
				<div class="container">
					<div id="primary">
						<div id="content" role="main">					
							<article class="post">
								<div class="the-content single-post">
									<?php the_content( 'Read full post...' ); ?>							
									<?php wp_link_pages(); ?>
								</div><!-- the-content -->
								<div style="clear:both">
								</div>
								<div class="content-container">
									<div class="post-meta">
										On <?php less_entry_date(); ?> in <?php less_post_category(); ?>
										<?php lrj_article_reading_time(); ?>
										<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link"> &sdot; ', '</span>' ); ?>			
									</div><!--/post-meta -->
								</div>
							</article>
							<!-- //
								UNCOMMENT TO ADD SOCIAL SHARE, IE TWITTER AND FACEVBOOK
								<div class="social-media">
								<a href="https://twitter.com/share" class="twitter-share-button" data-via="YOUR_TWITTER_USERNAME">Tweet</a>
								<div class="fb-like" data-width="40" data-height="20" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false" data-send="false">
								</div> 
							// -->
							</div>
							<div class="content-container">
							<div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'longreadjournal'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
    </div>
							<div id="fb-root"></div>
							<script>(function(d, s, id) {
					 		 var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) return;
					  		js = d.createElement(s); js.id = id;
					  		js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=YOUR_APP_ID";
					  		fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					<?php endwhile; ?>
					<?php else : ?>
					<article class="post error">
						<h1 class="404">Page not found (error 404)</h1>					 
				 		<p>Don't know what you're looking for but it ain't here.</p>
					</article>

					<?php endif; ?>
			<?php } //end is_single(); 
/*-----------------------------------------------------------------------------------*/
/* Page
/*-----------------------------------------------------------------------------------*/	
if(is_page()) {?>
<div class="container">
<div id="primary">
	<div id="content" role="main">
	<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post();
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				<div class="featured-image" style="background-image:url(<?php echo"$feat_image"; ?>);">
					<img class="logo-top" src="<?PHP echo get_template_directory_uri() ?>/images/featured-image-logo.png" alt=""/>
					<img class="r-logo-top" src="<?PHP echo get_template_directory_uri() ?>/images/responsive_logo.png" alt=""/>
					<div class="overlay">
						<div class="title-container">
		 					<div class="feat-title"><?php the_title() ?>
		 					</div>
		 				</div>			 				
		 			</div>
				</div>				
	</article>
	<?php endwhile; ?>
<?php else : ?>
	<article class="post error">
		<h1 class="404">Page not found (error 404)</h1>					 
		<p>Don't know what you're looking for but it ain't here.</p>
	</article>
<?php endif; ?>
<?php 
} // end is_page(); ?>

<?php
/*-----------------------------------------------------------------------------------*/
/* 404 page
/*-----------------------------------------------------------------------------------*/
if ( is_404() ) {    
    ?>  
    <div class="container">
<div id="primary">
	<div id="content" role="main">        
    <article class="post error">
		<h1 class="404">Page not found (error 404)</h1>					 
	 	<p>Don't know what you're looking for but it ain't here.</p>
	</article>
<?php
} // end 404 page
?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->
</div><!-- / container-->

<?php
/*-----------------------------------------------------------------------------------*/
/* Footer
/*-----------------------------------------------------------------------------------*/
?>
<footer class="site-footer" role="contentinfo">
	<div class="site-info container">
		<?php do_action( 'break_credits' ); ?>		
		Powered by <a href="http://wordpress.org" target="_blank">Wordpress</a>. <a href="https://github.com/Fancony/longreadjournal" target="_blank">Longread Journal Thene</a> by <a href="https://twitter.com/jfanc" target="_blank">@jfanc</a>
	</div>
</footer><!-- #colophon .site-footer -->

<?php wp_footer(); ?>
					</div><!-- /st-content-inner -->				
				</div><!-- /st-content -->
			</div><!-- /st-pusher -->
</div><!-- Sitewrapper -->
<script src="<?PHP echo get_template_directory_uri() ?>/js/classie.js"></script>
<script src="<?PHP echo get_template_directory_uri() ?>/js/sidebarEffects.js"></script>
<script src="<?PHP echo get_template_directory_uri() ?>/js/modernizr.custom.js"></script>
</body>
</html>
