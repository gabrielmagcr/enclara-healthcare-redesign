<?php

/* Template Name: News */

get_header(); 


$fields = null;

while (have_posts()) : the_post();
	$fields = get_fields($post->ID);
endwhile; wp_reset_postdata();

$feature_id = $fields['featured_post']->ID;
$feature_cats = get_the_category($feature_id); 


$paged =  get_query_var('paged') ? get_query_var('paged') : 1;
?>

<section class="hero-default hero-news">
	<div class="inner">
		
		<div class="hero-news--content">
			<?php if ($paged === 1) { ?>
			<div class="news-meta">
				<span><?php echo get_category_newslabel($feature_id); ?></span>
				<span class="sep">|</span>
				<span><?php echo get_the_date('F j, Y', $feature_id); ?></span>
			</div>
			<h1>
				<a href="<?php echo get_the_permalink($feature_id); ?>">
				<?php echo truncator(get_the_title($feature_id), 18); ?>
				</a>
			</h1>
			<div class="hero-news--readmore">
				<a class="button" href="<?php echo get_the_permalink($feature_id); ?>">Read More</a>
			</div>
			<?php } else { ?>
			<div class="hero-news--subpage-heading">
				<h1>Enclara Healthcare News</h1>
				<p>Page <?php echo $paged ?> of <span id="news-max-pages-num"></span></p>
			</div>
			<?php } ?>

		</div>

	</div>
</section>


<?php get_template_part('partials/news-nav'); ?>


<section class="news-body">
	<div class="inner">
	
	<div class="news-ajaxbody">
		<div class="news-postgrid">
			<?php

			$paged =  get_query_var('paged') ? get_query_var('paged') : 1;

			$wp_query = new WP_query(array(
				'post_type' => 'post',
				'posts_per_page' => 6,
				'paged' => $paged,
				'post__not_in' => array($feature_id)
				));

			if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); 

			?>

			<article class="news-article" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
				<div class="news-article--liner">
					<div class="news-meta">
						<span><?php echo get_category_newslabel($post->ID); ?></span>
						<span class="sep">|</span>
						<span><?php echo get_the_date('F j, Y', $post->ID); ?></span>
					</div>
					<h3 class="news-article_headline" itemprop="headline">
						<a href="<?php the_permalink(); ?>">
							<?php echo truncator(get_the_title(), 12); ?>
						</a>
					</h3>
					<div class="news-article_content" itemprop="text">
						<?php the_excerpt(); ?>
					</div>
					<div class="news-article_readmore">
						<a class="button" href="<?php the_permalink(); ?>">Read More</a>
					</div>
				</div>
			</article>

			<?php 
			endwhile; endif; ?>
			
		</div><!--/end news-postgrid-->

		<div class="news-nextpage" data-paged="<?php echo $paged; ?>">
			<?php if ($paged >= $wp_query->max_num_pages) { ?>
				<span class="news-loadmore-done">Showing All News</span>
			<?php } else { ?>
				<div class="news-loadmore-outer">
					<a class="news-loadmore-btn" href="<?php echo get_site_url().'/media/page/'.($paged+1); ?>">
						<span>Load More</span>
						<i class="fa fa-caret-down"></i>
						<i class="fa fa-caret-down"></i>
					</a>
				</div>
			<?php } ?>
		</div>
		
		<div class="news-ajaxtarget"></div>
		<?php wp_reset_postdata(); ?>
	</div>


	</div>
</section>




<?php
get_footer();
