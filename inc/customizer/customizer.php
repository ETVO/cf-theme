<?php
/**
 * Customizer controls and options
 * 
 * @package WordPress
 * @subpackage CF-Theme
 */
    
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}


class CF_Customizer {

    /**
     * Construct class functions and constants
     * 
     * @since 1.0
     */
    public function __construct()
    {

        // Register all the customizer options and sections 
        add_action('customize_register', array($this, 'register_options'));
    }

    /**
     * Register all customizer options
     * 
     * @since 1.0
     */
    public function register_options($wp_customize)
    {

        /**
         * Panel
         */
        $panel = 'cf_panel';
        $wp_customize->add_panel(
            $panel,
            array(
                'title'    => __('Opções CF'),
                'priority' => 10,
            )
        );
        

        /**
         * ------------------- Section ----------------
         */
        $section = 'cf_contact';
        $wp_customize->add_section(
            $section,
            array(
                'title'    => __('Contatos'),
                'priority' => 10,
                'panel'    => $panel,
            )
        );

        /**
         *  WhatsApp No.
         */
        $wp_customize->add_setting(
            'cf_whatsapp',
            array(
                'default' => ''
            )
        );
       
        Kirki::add_field( 
            'title_whatsapp',
            array(
                'type'      => 'custom',
                'settings'  => 'title_whatsapp',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('WhatsApp') 
                    . '</h3>'
            )
        );

        Kirki::add_field( 'cf_whatsapp', [
            'type'     => 'text',
            'settings' => 'cf_whatsapp',
            'label'    => esc_html__('Número WhatsApp para exibição'),
            'section'  => $section
        ] );

        $wp_customize->add_setting(
            'cf_whatsapp_number',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'cf_whatsapp_number', [
            'type'     => 'text',
            'settings' => 'cf_whatsapp_number',
            'label'    => esc_html__('Número WhatsApp completo (com +55)'),
            'section'  => $section
        ] );
       
        Kirki::add_field( 
            'title_phone',
            array(
                'type'      => 'custom',
                'settings'  => 'title_phone',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('Telefone') 
                    . '</h3>'
            )
        );

        /**
         *  Phone No.
         */
        $wp_customize->add_setting(
            'cf_phone',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'cf_phone', [
            'type'     => 'text',
            'settings' => 'cf_phone',
            'label'    => esc_html__('Número Telefone para exibição'),
            'section'  => $section
        ] );

        $wp_customize->add_setting(
            'cf_phone_number',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'cf_phone_number', [
            'type'     => 'text',
            'settings' => 'cf_phone_number',
            'label'    => esc_html__('Número Telefone completo (com +55)'),
            'section'  => $section
        ] );
       
        Kirki::add_field( 
            'title_address',
            array(
                'type'      => 'custom',
                'settings'  => 'title_address',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('Endereço') 
                    . '</h3>'
            )
        );

        /**
         *  Address
         */
        $wp_customize->add_setting(
            'cf_address',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'cf_address', [
            'type'     => 'text',
            'settings' => 'cf_address',
            'label'    => esc_html__('Endereço'),
            'section'  => $section
        ] );
        
        /**
        * Social Icons
        */
       $wp_customize->add_setting(
           'cf_social_icons', 
           array(
               'default' => ''
           )
       );
       
       Kirki::add_field( 
           'title_social_icons',
           array(
               'type'      => 'custom',
               'settings'  => 'title_social_icons',
               'section'   => $section,
               'default'   => '<h3 class="customize-section-title">' 
                   . __('Ícones Sociais') 
                   . '</h3>'
                   . '<div style="padding: 5px;">'
                   . __('Consulte') . ': <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>'
                   . '</div>'
           )
       );

       Kirki::add_field( 'cf_social_icons', [
           'type'        => 'repeater',
           'section'     => $section,
           'settings'     => 'cf_social_icons',
        //    'label'       => esc_html__('Ícones de Redes Sociais'),
           'row_label' => [
               'type'  => 'field',
               'value' => esc_html__('Ícone'),
               'field' => 'label',
           ],
           'button_label' => esc_html__('Adicionar novo'),
           'default'      => [
               [
                   'icon' => 'facebook',
                   'url'  => 'https://www.facebook.com/',
               ],
               [
                   'icon' => 'instagram',
                   'url'  => 'https://www.instagram.com/',
               ],
           ],
           'fields' => [
               'icon' => [
                   'type' => 'text',
                   'label' => __('Ícone a mostrar'),
                   'description' => __('Utilize os ícones do') . ' Bootstrap Icons',
               ],
               'url'  => [
                   'type' => 'text',
                   'label' => __('Link do ícone'),
               ],
           ]
       ] );

        

        /**
         * ------------------- Section ----------------
         */
        $section = 'cf_footer';
        $wp_customize->add_section(
            $section,
            array(
                'title'    => __('Rodapé'),
                'priority' => 20,
                'panel'    => $panel,
            )
        );

        /**
         *  Footer logo
         */
        $wp_customize->add_setting(
            'cf_footer_logo',
            array(
                'default' => ''
            )
        );
        
        Kirki::add_field( 'cf_footer_logo', [
            'type'        => 'image',
            'settings'    => 'cf_footer_logo',
            'label'       => esc_html__('Logo Rodapé'),
            'section'     => $section,
            'default'     => '',
        ] );
        

        /**
         * ------------------- Section ----------------
         */
        $section = 'cf_options';
        $wp_customize->add_section(
            $section,
            array(
                'title'    => __('Opções'),
                'priority' => 30,
                'panel'    => $panel,
            )
        );

       
        Kirki::add_field( 
            'title_empre',
            array(
                'type'      => 'custom',
                'settings'  => 'title_empre',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('Empreendimentos') 
                    . '</h3>'
            )
        );

        /**
         *  Empre Archive Link
         */
        $wp_customize->add_setting(
            'cf_empre_link',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'cf_empre_link', [
            'type'     => 'text',
            'settings' => 'cf_empre_link',
            'label'    => esc_html__('Link da página de Empreendimentos'),
            'section'  => $section
        ] );

        /**
         *  Morar ou Alugar picture
         */
        $wp_customize->add_setting(
            'cf_moa_img',
            array(
                'default' => ''
            )
        );
        
        Kirki::add_field( 'cf_moa_img', [
            'type'        => 'image',
            'settings'    => 'cf_moa_img',
            'label'       => esc_html__('Imagem Morar ou Alugar'),
            'section'     => $section,
            'default'     => '',
        ] );

        /**
         *  Logo Studio Mooka
         */
        $wp_customize->add_setting(
            'cf_mooka_logo',
            array(
                'default' => ''
            )
        );
        
        Kirki::add_field( 'cf_mooka_logo', [
            'type'        => 'image',
            'settings'    => 'cf_mooka_logo',
            'label'       => esc_html__('Logo Studio Mooka'),
            'section'     => $section,
            'default'     => '',
        ] );

       
        Kirki::add_field( 
            'title_form',
            array(
                'type'      => 'custom',
                'settings'  => 'title_form',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('Formulário') 
                    . '</h3>'
            )
        );


        /**
         *  Form Shortcode
         */
        $wp_customize->add_setting(
            'cf_form',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'cf_form', [
            'type'     => 'text',
            'settings' => 'cf_form',
            'label'    => esc_html__('Shortcode do Formulário'),
            'description'    => esc_html__('Do plugin Contact Form 7'),
            'section'  => $section
        ] );


        /**
         *  Form Image
         */
        $wp_customize->add_setting(
            'cf_form_image',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'cf_form_image', [
            'type'     => 'image',
            'settings' => 'cf_form_image',
            'label'    => esc_html__('Fundo do Formulário'),
            'section'  => $section
        ] );

       
        Kirki::add_field( 
            'title_blog',
            array(
                'type'      => 'custom',
                'settings'  => 'title_blog',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('Blog') 
                    . '</h3>'
            )
        );


        /**
         *  Form Image
         */
        $wp_customize->add_setting(
            'cf_blog_feed_image',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'cf_blog_feed_image', [
            'type'     => 'image',
            'settings' => 'cf_blog_feed_image',
            'label'    => esc_html__('Fundo dos bloco de posts recentes'),
            'section'  => $section
        ] );
        
    }
}

new CF_Customizer();