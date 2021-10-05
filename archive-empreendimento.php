<?php
/**
 * Index template
 * 
 * @package WordPress
 * @subpackage CF-Theme
 */


$empre_link = get_theme_mod('cf_empre_link');
// Redirect to the defined page for Empreendimentos
header("Location: $empre_link");
