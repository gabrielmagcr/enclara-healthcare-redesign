<?php

/* Template Name: Homepage */

$root = get_template_directory_uri();

// Home page template
// becomes default WP home page template

get_header(); 


//will hold custom field vals
$fields = null;

//Link variable
$link = null;

// Target blank if external link
$target_blank = false;

//default page loop
if (have_posts()) : while (have_posts()) : the_post();
	$fields = get_fields($post->ID);
endwhile; endif; wp_reset_postdata();
?>


<section class="block-hero home-hero">
	<div class="inner">
		<div class="home-hero--content">
			<figure>
				<img class="home-page-logo" src="<?php echo $root . '/assets/img/ehc-white-rev.png' ?>" alt="Enclara Healthcare Logo">
			</figure>
			<h3 class="mega"><?php the_field('hero_mainheading', $post->ID); ?></h3>
			<p><?php the_field('hero_bodytext', $post->ID); ?></p>

			<!--	Look for external links, if the link is external, echo target blank		-->
<!--			<a href="-->
<?php //$link = ($fields['hero_link_internal']) ? $fields['hero_internal_link_values'] : $fields['hero_external_link']; $target_blank = true; echo $link?>
<!--" class="button" --><?php //$target_blank = ($target_blank) ? $target_blank = 'target="_blank"' : false; echo $target_blank ?><!--><?php //the_field('hero_buttontext', $post->ID); ?><!--</a>-->
			<a class="button learn-more" href="<?php echo $fields['hero_external_link']?>"><?php echo $fields['hero_buttontext']?></a>
			<!--<div class="home-hero--downarr">
				<a href="#what-we-do" class="downarr" data-scroll data-scroll-offset="-30">
					<span class="downarr--line"></span>
					<span class="downarr--arrow"></span>
				</a>
			</div>-->

		</div>
	</div>
	<div class="block-coverbg"></div>
</section>





<section id="what-we-do" class="block-services home-services">
	<div class="inner"><hr class="divider divider--red" data-in-view></div>
	<div class="inner inner--tagline" data-in-view>
		<div class="block-services--tagline">
			<h4>What We Do</h4>
			<blockquote><?php echo $fields['what_we_do']?></blockquote>
		</div>
	</div>
  
	<div class="inner feature-cols">
		<?php 
		if ($fields['wwd_cols']) { $count=0;
			foreach ($fields['wwd_cols'] as $col) { $count++; ?>
			
			<div class="col-third" data-in-view>
				<div class="feature-col-content">
					<figure><img src="<?php echo "$root/assets/img/icon-service-".$count.".png"; ?>"></figure>
					<h4><?php echo $col['title']; ?></h4>
					<p><?php echo $col['text']; ?></p>
				</div>
			</div>

		<?php	}
		} ?>
	</div>

	<div class="enc-swirly"></div>
</section>



<?php //company listing block ?>
<section class="block-companies home-companies">
	<div class="inner company-cols" data-equalize-parent=>
	
	<?php

	$coquery = new WP_query(array(
		'post_type' => 'enclara-companies',
		'posts_per_page' => -1,
		'order' => 'ASC'
	));
	if ($coquery->have_posts()) : while ($coquery->have_posts()) : $coquery->the_post();
		$co = get_fields();
		?>

		<div class="col-third" data-in-view>
			<div class="companies--item companies--<?php echo $post->post_name; ?>">
				<div class="companies--logo">
					<h3 class="sr-only"><?php the_title(); ?></h3>
					<figure><img src="<?php echo $co['white-logo']['url']; ?>" alt="<?php the_title(); ?> Logo"></figure>
				</div>
				<div class="companies--item-desc" data-equalize-item>
					<p data-equalize-measure><?php echo $co['short_description']; ?></p>
				</div>
				<div class="companies--item-btn">
					<a href="<?php echo $co['website_url']; ?>" class="button" target="_blank">Learn More</a>
				</div>
			</div>
		</div>

	<?php endwhile; endif; wp_reset_postdata(); ?>
	
	</div>
</section>
<?php //company listing block ?>









<?php

get_footer();
