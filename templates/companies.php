<?php


/* Template Name: Companies */

get_header(); 

$fields = null;

while (have_posts()) : the_post();
	$fields = get_fields($post->ID);
endwhile; wp_reset_postdata();
?>


<section class="hero-default">
	<div class="inner">
		<?php do_page_headline($fields['sub_headline'],$fields['main_headline'], $fields['paragraph']); ?>
	</div>
</section>
<section>

	<?php 
		$coquery = new WP_query(array(
			'post_type' => 'enclara-companies',
			'posts_per_page' => -1,
			'orderby' => 'meta_value_num',
			'meta_key' => 'order',
			'order' => 'ASC'
		));

		if ($coquery->have_posts()) : while ($coquery->have_posts()) : $coquery->the_post();
		$co = get_fields();
		?>

		<div class="inner company-block">
			<div class="inner-narrow">
				<div class="col-third">
					<div class="companies--logo">
						<figure class="figure-logo"><img src="<?php echo $co['logo']['url']; ?>" alt="<?php the_title(); ?> Logo"></figure>
					</div>
				</div>
				<div class="col-three-fourths">
					<div class="companies--item-desc">
						<p><?php echo $co['short_description']; ?></p>
					</div>
					<div class="companies--item-btn">
						<a href="<?php echo $co['website_url']; ?>" class="button" target="_blank">Learn More</a>
					</div>
				</div>
			</div>
		</div>
		<div class="inner block-divider companies-divider">
			<div class="inner-narrow"><hr></div>
		</div>
	<?php endwhile; endif; wp_reset_postdata(); ?>

</section>








<?php
get_footer();
