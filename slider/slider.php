<div class="slider">
    <div class="swiper">
        <div class="swiper-wrapper">
            <?php
            $slider_query = new WP_Query(array(
                'post_type' => 'slider',
                'number-posts' => 10,
            ));



            while ($slider_query->have_posts()) : $slider_query->the_post(); $postid = get_the_ID();?>
                    <!-- Slides -->
                    <div class="slide swiper-slide" data-id="<?= $postid?>" style="background-image: url('<?php the_post_thumbnail_url(); ?>');">
                        <h2><?php the_title(); ?></h2>
                    </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>

    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M15.293 3.293 6.586 12l8.707 8.707 1.414-1.414L9.414 12l7.293-7.293-1.414-1.414z"/></svg></div>
    <div class="swiper-button-next"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M15.293 3.293 6.586 12l8.707 8.707 1.414-1.414L9.414 12l7.293-7.293-1.414-1.414z"/></svg></div>
</div>

<div class="popup">
    <div class="popup-close">x</div>
    <div class="popup-description">Description</div>
    <div class="popup-content"></div>
</div>