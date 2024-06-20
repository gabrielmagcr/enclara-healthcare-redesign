<?php

// single.php - default view for single posts


get_header();

if (have_posts()) : while (have_posts()) : the_post();

    $prevPost = get_adjacent_post(false, '', true);
    $nextPost = get_adjacent_post(false, '', false);
    ?>

    <section class="hero-default singlepost-hero">
        <div class="inner">
            <div class="inner-narrow">
                <div class="page-default--intro singlepost-intro">
                    <div class="news-meta">
                        <span><?php echo get_category_newslabel($post->ID); ?></span>
                        <span class="sep">|</span>
                        <span><?php echo get_the_date('F j, Y', $post->ID); ?></span>
                    </div>
                    <h1><?php the_title(); ?></h1>

                    <hr class="divider divider--red">
                </div>
            </div>
        </div>
    </section>

    <section class="singlepost-content">
        <div class="inner">
            <div class="inner-narrow">
                <article class="singlepost-article" role="article">
                    <?php the_content(); ?>
                </article>
            </div>
        </div>
    </section>

    <section class="singlepost-after">
        <div class="inner">

            <div class="inner-narrow singlepost-after--divider">
                <hr class="divider divider--red">
            </div>

            <div class="inner-narrow singlepost-after--social">
                <div class="singlepost-social">
                    <?php
                    //set up social sharing
                    $at_endpoint = 'http://api.addthis.com/oexchange/0.8/forward/';
                    $at_id = '&pubid=ra-55de0dd1bace84fc';
                    //sharing urls
                    $share_href = array(
                        'facebook' => $at_endpoint . 'facebook/offer?url=' . urlencode(get_the_permalink()) . $at_id,
                        'twitter' => $at_endpoint . 'twitter/offer?url=' . urlencode(get_the_permalink()) . $at_id . '&via=EnclaraHealth&text=' . urlencode($post->post_title),
                        'linkedin' => $at_endpoint . 'linkedin/offer?url=' . urlencode(get_the_permalink()) . $at_id . '&title=' . urlencode($post->post_title),
                        'gplus' => $at_endpoint . 'googleplus/offer?url=' . urlencode(get_the_permalink()) . $at_id . '&title=' . urlencode($post->post_title)
                    );
                    ?>
                    <ul>
                        <li>
                            <a class="btn-facebook btn-social" href="<?php echo $share_href['facebook']; ?>"
                               target="_blank">
                                <i class="iconsymbol-facebook"></i>
                                <span class="social-name">Facebook</span>
                            </a>
                        </li>
                        <li>
                            <a class="btn-linkedin btn-social" href="<?php echo $share_href['linkedin']; ?>"
                               target="_blank">
                                <i class="iconsymbol-linkedin"></i>
                                <span class="social-name">LinkedIn</span>
                            </a>
                        </li>
                        <li>
                            <a class="btn-twitter btn-social" href="<?php echo $share_href['twitter']; ?>"
                               target="_blank">
                                <i class="iconsymbol-twitter"></i>
                                <span class="social-name">Twitter</span>
                            </a>
                        </li>
                        <li>
                            <a class="btn-googleplus btn-social" href="<?php echo $share_href['gplus']; ?>"
                               target="_blank">
                                <i class="iconsymbol-gplus"></i>
                                <span class="social-name">Google</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="inner-narrow singlepost-after--prevnext">
                <div class="col-half article-adjacent article-adjacent_left">
                    <?php
                    if ($prevPost) { ?>
                        <article>
                            <small>Previous Article</small>
                            <h4>
                                <a href="<?php echo get_the_permalink($prevPost->ID); ?>"><?php echo truncator(get_the_title($prevPost->ID), 14); ?></a>
                            </h4>
                            <div class="posts-slider--leftarr adjacent--arr adjacent--leftarr">
                                <a href="<?php echo get_the_permalink($prevPost->ID); ?>">
                                    <span class="front"><i class="iconsymbol-left-open-big"></i></span>
                                    <span class="back"><i class="iconsymbol-left-open-big"></i></span>
                                </a>
                            </div>
                        </article>
                    <?php } ?>
                </div>
                <span class="adjacent-divider"></span>
                <div class="col-half article-adjacent article-adjacent_right">
                    <?php
                    if ($nextPost) { ?>
                        <article>
                            <small>Next Article</small>
                            <h4>
                                <a href="<?php echo get_the_permalink($nextPost->ID); ?>"><?php echo truncator(get_the_title($nextPost->ID), 14); ?></a>
                            </h4>
                            <div class="posts-slider--rightarr adjacent--arr adjacent--rightarr">
                                <a href="<?php echo get_the_permalink($nextPost->ID); ?>">
                                    <span class="front"><i class="iconsymbol-right-open-big"></i></span>
                                    <span class="back"><i class="iconsymbol-right-open-big"></i></span>
                                </a>
                            </div>

                        </article>
                    <?php } ?>
                </div>
            </div>
            <section class="back-button-container">
                <a class="button media-back" href="<?php echo get_site_url() . '/media' ?>">
                    Back
                </a>
            </section>
        </div>
    </section>

    <?php
endwhile; endif;
wp_reset_postdata();

get_footer();
