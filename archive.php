<?php

//Archive Template 
//this is set up to handle categories, tags, author archives

get_header(); ?>


<section class="hero-default hero-archive">
	<div class="inner">
		
		<div class="hero-news--content">
				<h1>
				<?php 
				if (is_category()) {
					echo '<span>Viewing Posts in Category:</span>';
					single_cat_title();
				} else if (is_tag()) {
					echo 'Viewing Posts Tagged: '; 
					single_tag_title();
				} else if (is_author()) {
					global $post;
					echo 'Viewing Posts by: '; 
					the_author_meta('display_name', $post->post_author);
				} ?>
				</h1>
		</div>

	</div>
</section>


<?php
get_template_part('partials/news-nav'); ?>



<section class="news-body">
	<div class="inner">
	
	<div class="news-ajaxbody">
		<div class="news-postgrid">
			<?php

			$paged =  get_query_var('paged') ? get_query_var('paged') : 1;

			if (have_posts()) : while (have_posts()) : the_post(); 
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
				<span class="news-loadmore-done">Showing All Posts From <?php single_cat_title(); ?> </span>
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




<?php get_footer();
