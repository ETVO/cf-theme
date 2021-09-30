<?php

function nossos_empre($attrs) {
    $attrs = shortcode_atts( array(
        'max' => 2,
    ), $attrs );
    
    $post_type = 'empre';
    $orderby = 'title';
    $order = 'ASC';
    $no_found_posts = true;
    
    // Posts Per Page (-1 means it shows all)
    $ppp = 2;

    // WP_Query arguments
    $args = array(
        'post_type'              => $post_type,
        'post_status'            => array('publish'),
        'has_password'           => false,
        'posts_per_page'         => $ppp,
        'no_found_posts'         => $no_found_posts,
        
        // Order ASC first by 'menu_order', only after by 'title' or 'date'
        'orderby'                => array( 'menu_order' => 'ASC' , $orderby => $order ), 
    );

    // The Query
    $query = new WP_Query($args);
    
    $title = "Nossos empreendimentos";
    $notice = "Nenhum registro foi encontrado";
    
    ob_start(); // Start HTML buffering

    if($query->have_posts()) {
        ?>

        <section class="nossos_empre pt-2">
            <div class="wrapper">
                <div class="title text-center pb-4">
                    <h2>
                        <?php echo $title; ?>
                    </h2>
                </div>

                <div class="content">
                <?php if($query->have_posts()) { ?>
                    <div class="row w-100 p-0 m-0">
                        <?php
                        while($query->have_posts()):
                            $query->the_post();

                            $post = get_post();
                            
                            $permalink = esc_url(get_the_permalink());
                            
                            $image_url = get_the_post_thumbnail_url();
                            $image_alt = get_the_post_thumbnail_caption();
                            
                            $name = get_the_title();
                            $logo = get_field('logomarca');

                            ?>

                            <div class="item col-12 col-md-6" title="<?php echo $name; ?>">
                                <div class="image">
                                    <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                                </div>
                                <div class="item-inner d-flex flex-column">
                                    <div class="logo mb-auto">
                                        <img src="<?php echo $logo['url']; ?>" alt="<?php echo $name; ?>">
                                    </div>
                                    <div class="action mt-auto">
                                        <a href="<?php echo $permalink; ?>">Saber Mais</a>
                                    </div>
                                </div>
                            </div>

                            <?php
                        endwhile;
                        ?>
                    </div>
                <?php } else { ?>
                    <div class="notice">
                        <?php echo $notice; ?>
                    </div>
                <?php } ?>
                </div>
            </div>
        </section>
        
        <?php
    }

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}