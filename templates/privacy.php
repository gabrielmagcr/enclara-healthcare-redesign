<?php

/* Template Name: Privacy */

get_header();

$fields = null;

while ( have_posts() ) : the_post();
    $fields = get_fields( $post->ID );
endwhile;
wp_reset_postdata();
?>


    <section class="hero-default privacy-page">
        <div class="inner">
            <?php do_page_headline( $fields['sub_headline'], $fields['main_headline'] ); ?>
            <div class="introcopy--narrow">
                <?php echo $fields['privacy_page_hero_text']; ?>
            </div>
            <hr class="privacy-divider divider divider--red">
        </div>
    </section>

<?php // body1 is the default content of the careers page ?>
    <section class="main-content">
        <div class="values-list">
            <div class="inner">
                <?php foreach ( $fields['privacy_policy_items'] as $value ) { ?>
                    <div class="value-item">
                        <div class="value-title-container">
                            <h3>
                                <?php echo $value['policy_title'] ?>
                            </h3>
                            <span class="toggle-icon-container">
								<span class="toggle-icon"></span>
								<span class="toggle-icon"></span>
							</span>
                        </div>
                        <div class="value-hidden-container">
                            <?php echo $value['policy_text'] ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section><!-- end main-content -->

<?php
get_footer();
?>
