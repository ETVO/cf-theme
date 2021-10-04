<?php

function blog_feed($attrs) {
    $attrs = shortcode_atts( array(
    ), $attrs );

    $title = 'Blog e notícias';

    

    $ppp = 4;
    $no_found_posts = true;
    $orderby = "date";
    $order = "DESC";

    // WP_Query arguments
    $args = array(
        'post_type'         => 'post',
        'post_status'       => array('publish'),
        'has_password'      => false,
        'posts_per_page'    => $ppp,
        'no_found_posts'    => $no_found_posts,
        
        
        // Order ASC first by 'menu_order', only after by 'title' or 'date'
        'orderby'                => array( 'menu_order' => 'ASC' , $orderby => $order ), 
    );

    $blog_link = get_permalink(get_option('page_for_posts'));
    $bg_image_url = get_theme_mod('cf_blog_feed_image');

    // The Query
    $query = new WP_Query($args);

    ob_start(); // Start HTML buffering

    if($query->have_posts()) {
        ?>

        <section class="blog_feed py-4">
            <div class="underlay">
                <img src="<?php echo $bg_image_url; ?>">
            </div>
            <div class="container col-md-11 col-lg-10 col-xl-9 py-5 mx-auto">
                <div class="title text-center mb-3">
                    <h2>
                        <?php echo $title; ?>
                    </h2>
                </div>
                
                <div class="items row g-3 py-4 justify-content-center">
                <?php
                    $i = 0;
                    while ($query->have_posts()) :
                        $i++;
                        $hide_class = '';
                        if($i == 4) $hide_class = 'd-none d-xl-block';
                        $query->the_post();
                        
                        $post = get_post();
                        
                        $permalink = esc_url(get_the_permalink());
                        
                        $image_url = get_the_post_thumbnail_url($post->ID, 'thumbnail');
                        $image_alt = get_the_post_thumbnail_caption();
                        
                        $post_title = get_the_title();
                        $excerpt = get_the_excerpt();
                        $date = get_the_date();

                        // Get the first tag name
                        $tag = get_the_tags()[0];

                        ?>
                        <div class="item col-12 col-sm-6 col-lg-4 col-xl-3 <?php echo $hide_class; ?>">
                            <div class="item-inner">
                                <div class="image clink" href="<?php echo $permalink; ?>">
                                    <img class="w-100" src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                                    <?php if($tag->name): ?>
                                    <div class="tag-overlay">
                                        <span>
                                            <?php echo $tag->name; ?>
                                        </span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="info text-start">
                                    <div class="upper-part">
                                        <h6 class="post-title">
                                            <a class="text-dark" href="<?php echo $permalink; ?>">
                                                <?php echo $post_title; ?>
                                            </a>
                                        </h6>
                                        <p class="excerpt">
                                            <?php echo $excerpt; ?>
                                        </p>
                                    </div>
                                    <div class="item-bottom d-flex">
                                        <div class="me-auto">
                                            <small class="date">
                                                <?php echo $date; ?>
                                            </small>
                                        </div>
                                        <div class="ms-auto">
                                            <a class="action" href="<?php echo $permalink; ?>">
                                                ver mais
                                                <span class="ms-2 bi bi-chevron-right"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    
                    endwhile;
                ?>
                </div>

                <div class="action-wrap mt-4">
                    <div class="action text-center">
                        <a href="<?php echo $blog_link; ?>" class="">
                            ver todos <span class="ms-2 bi bi-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        
        <?php
    }

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}