<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <?php
    global $page, $paged;
    $title = wp_title('', false);
    if ($paged >= 2 || $page >= 2) {
        $title .= ' - ' . __('Página') . ' ' . max($paged, $page);
    }
    ?>
    <title><?php echo $title; ?></title>
</head>
<body id="blog" <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="page-wrap">
        <?php do_action('envo_shopper_before_topnav'); ?>
        <?php get_template_part('template-parts/template-part', 'topnav'); ?>
        <div id="site-content" class="container main-container" role="main">
            <div class="page-area">
                <?php do_action('envo_shopper_page_area'); ?>
