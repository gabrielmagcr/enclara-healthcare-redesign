<?php





/* Template Name: About Page */





// Home page template

// becomes default WP home page template



get_header();



//will hold custom field vals

$fields = null;



//default page loop

if (have_posts()) : while (have_posts()) : the_post();

		$fields = get_fields($post->ID);

	endwhile;
endif;
wp_reset_postdata();

?>

<style>
	.about-hero--content h1 {
		color: #fff;
		font-size: 2.1em;
	}

	.about-hero--content {
		background: linear-gradient(0deg, #2a3754, #39466e 90%, rgba(10, 50, 84, 0) 100%);
	}

	@media (min-width: 426px) {
		.hero-bg {
			height: 500px;
		}
	}

	@media (min-width: 1023px) {
		.hero-bg {
			background: url('/wp-content/uploads/EnclaraHealthCareHero3-e1718999227732.webp') !important;
			background-size: cover !important;
			background-repeat: no-repeat !important;
			background-position: left !important;
		}

		.about-hero--content {
			background: linear-gradient(90deg, #39466e, #39466e 80%, rgba(10, 50, 84, 0) 100%);
			display: flex;
        flex-direction: column;
        justify-content: center;
		}
	}

	@media(min-width: 1200px) {
		.hero-bg {
			background-size: contain !important;
			background-position: right !important;
			height: 70vh;
		}
	}
</style>


<section class="">
	<div class="hero-bg-container">
		<div class="hero-bg" style="background: url('/wp-content/uploads/EnclaraHealthCareHero2.webp');  background-repeat: no-repeat; background-position: top; background-size: cover;"></div>
		<div class=" home-hero--content about-hero--content">

			<?php do_page_headline($fields['sub_headline'], $fields['main_headline']); ?>
			<?php echo $fields['intro_paragraph_text'] ?>
		</div>
	</div>
</section>



<section id="what-we-do" class="block-services home-services">

	<div class="inner">
		<hr class="divider divider--red">
	</div>

	<div class="inner inner--tagline">

		<div class="block-services--tagline">

			<h4><?php echo $fields['block_quote_section_title'] ?></h4>

			<blockquote><?php echo $fields['block_quote_section_text'] ?></blockquote>

		</div>

	</div>



	<div class="inner feature-cols">

		<?php

		if ($fields['what_we_do_columns']) {
			$count = 0;

			foreach ($fields['what_we_do_columns'] as $col) {
				$count++; ?>



				<div class="col-third">

					<div class="feature-col-content">

						<figure><?php get_template_part('partials/icons/' . $col['icon']) ?></figure>

						<h4><?php echo $col['title']; ?></h4>

						<p><?php echo $col['text']; ?></p>

					</div>

				</div>



		<?php	}
		} ?>

	</div>

</section>

<div class="inner block-divider">

	<hr>

</div>

<div class="page-default--intro">

	<h3 class="section--title"><?php echo $fields['code_conduct_title']; ?></h3>

	<p><?php echo $fields['code_conduct_para']; ?></p>

</div>

<div class="inner block-divider">

	<hr>

</div>



<section class="executive-section">

	<div class="inner">

		<div class="page-default--intro">

			<h3 class="section--title"><?php echo $fields['executive_team_title']; ?></h3>

			<p><?php echo $fields['executive_team_paragraph']; ?></p>

			<hr class="divider--red divider">

		</div>

	</div>





	<div class="inner executive-tiles">



		<?php

		$execquery = new WP_query(array(

			'post_type' => 'enclara-execteam',

			'posts_per_page' => -1,

			'order' => 'ASC'

		));



		if ($execquery->have_posts()) : while ($execquery->have_posts()) : $execquery->the_post();

				$fields = get_fields();

		?>

				<div class="exec-col">

					<div class="executive-card" data-bio-html='<?php echo $fields['executive_team_member_bio']; ?>'>

						<div class="card-wrapper">

							<div class="card-wrapper--inner">

								<h5><?php the_title(); ?></h5>

								<p><span><?php echo $fields['executive_team_member_title']; ?></span></p>

							</div>

						</div>

						<button>Read Full Bio</button>

					</div>

				</div>

		<?php endwhile;
		endif;
		wp_reset_postdata(); ?>



	</div>



	<div class="inner bod-section">

		<div class="bod-section--title">

			<h5 class="section--title-sm">Board of Directors</h5>

			<hr class="divider--red divider">

		</div>

	</div>



	<div class="inner executive-tiles bod-tiles">

		<?php

		$bodquery = new WP_query(array(

			'post_type' => 'enclara-bod',

			'posts_per_page' => -1,

			'order' => 'ASC'

		));

		if ($bodquery->have_posts()) : while ($bodquery->have_posts()) : $bodquery->the_post();

				$fields = get_fields();

		?>



				<div class="exec-col">

					<div class="executive-card" data-bio-html='<?php echo $fields['executive_team_member_bio']; ?>'>

						<div class="card-wrapper">

							<div class="card-wrapper--inner">

								<h5><?php the_title(); ?></h5>

								<p><span><?php echo $fields['executive_team_member_title']; ?></span></p>

							</div>

						</div>

						<button>Read Full Bio</button>

					</div>

				</div>



		<?php endwhile;
		endif;
		wp_reset_postdata(); ?>

	</div>

</section>



















<?php get_footer();
