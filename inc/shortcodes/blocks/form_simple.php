<?php

function form_simple($attrs) {
    $attrs = shortcode_atts( array(
        'show_title' => 1,
        'title' => 'Ficou com alguma dúvida?',
        'subtitle' => 'entre em contato conosco!',
    ), $attrs );

    $shortcode = get_theme_mod('cf_form'); 

    $title = $attrs['title'];
    $subtitle = $attrs['subtitle'];
    $bg_image_url = get_theme_mod('cf_form_image');

    ob_start(); // Start HTML buffering
    
    ?>

    <section class="form_simple py-5">
        <div class="underlay">
            <img src="<?php echo $bg_image_url; ?>">
        </div>
        <div class="form-inner m-auto text-center">
            <?php if($attrs['show_title']): ?>
                <div class="title">
                    <h2 class="mb-0"><?php echo $title; ?></h2>
                </div>
                <div class="subtitle mb-3">
                    <h4><?php echo $subtitle; ?></h4>
                </div>
            <?php endif; ?>
            <div class="form text-start">
                <?php 
                    echo do_shortcode($shortcode);
                ?>     
            </div>
        </div>

    </section>

    <script>
        document.getElementsByClassName('departamentos')[0].style = 'display:none';
        var input = document.getElementsByName('departamentos')[0];

        input.setAttribute('type', 'hidden');
        input.value = 'Geral';
    </script>

    <?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}