<?php

function address_map($attrs, $content) {
    $attrs = shortcode_atts( array(
    ), $attrs );

    $address = get_theme_mod('cf_address', 'CF Negócios Imobiliários');

    $single_line_address = strip_tags($address);
    $map_address = str_replace(' ', '+', $single_line_address);

    $map_url_sm = "https://maps.google.com/maps?q=" . $map_address 
    . "&t=m&mrt=yp&z=15&output=embed&iwloc=addr&msa=0";
    
    $map_url_lg = "https://maps.google.com/maps?q=" . $map_address 
    . "&t=m&mrt=yp&z=15&ll=-27.59384,-48.5656637&output=embed&iwloc=addr&msa=0";

    $directions_url = "https://www.google.com/maps/dir//$map_address";
    
    $logo = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $logo , 'full' );
    $image_url = $image[0];

    $show_address = get_theme_mod('cf_show_address', $address);
    $show_address = nl2br($show_address);
    
    ob_start(); // Start HTML buffering
    
    if($address):
    ?>

        <section class="address_map">
            <div class="overlay d-flex">
                <div class="m-auto">
                    <div class="logo mb-4">
                        <img src="<?php echo $image_url; ?>" alt="">
                    </div>
                    <div class="address my-5">
                        <?php echo $show_address; ?>
                    </div>
                    <div class="action text-center">
                        <a href="<?php echo $directions_url; ?>" target="_blank">
                            como chegar
                        </a>
                    </div>
                </div>
            </div>

            <iframe class="d-block d-md-none" frameborder="0" scrolling="yes" marginheight="0" marginwidth="0" src="<?php echo $map_url_sm; ?>" title="<?php echo $map_address; ?>" aria-label="<?php echo $address ?>">
            </iframe>
            <iframe class="d-none d-md-block" frameborder="0" scrolling="yes" marginheight="0" marginwidth="0" src="<?php echo $map_url_lg; ?>" title="<?php echo $map_address; ?>" aria-label="<?php echo $address ?>">
            </iframe>
        </section>

    <?php
    endif;

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}