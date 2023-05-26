<?php
	
	$the_wp_fitness_first_theme_color = get_theme_mod('the_wp_fitness_first_theme_color');
	$the_wp_fitness_second_theme_color = get_theme_mod('the_wp_fitness_second_theme_color');

	$the_wp_fitness_custom_css = '';

	if($the_wp_fitness_first_theme_color != false){
		$the_wp_fitness_custom_css .=' #sidebar .tagcloud a:hover, .nav-menu ul ul a, .woocommerce .cart .button, .woocommerce .cart input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce button.button.alt, .woocommerce a.button.alt, .woocommerce input.button.alt, h1.page-title, h1.search-title, .trainerbox h3:hover, .testbutton a:hover , #footer input[type="submit"], .read-more a, .pagination a:hover, .pagination .current , span.meta-nav , .woocommerce span.onsale, .title-box, #sidebar .tagcloud a:hover, #footer .tagcloud a:hover, .tags a:hover, #comments a.comment-reply-link, .back-to-top, .blogbtn a, .woocommerce-product-search button, a.button:hover, #slider .carousel-indicators .active {';
			$the_wp_fitness_custom_css .='background-color: '.esc_attr($the_wp_fitness_first_theme_color).';';
		$the_wp_fitness_custom_css .='}';
	}
	if($the_wp_fitness_first_theme_color != false){
		$the_wp_fitness_custom_css .='a, code, nav-menu ul li a:active, .nav-menu ul li a:hover, #header .logo a, .widget_calendar caption, .nav-menu ul ul a:hover, .nav-menu a:hover, .social-media i:hover, #header .logo p,   .woocommerce-message, .woocommerce-message::before,  h1.woocommerce-products-header__title,  .blog-sec h3 a, testbutton a,  #footer h3, .footerinner ul li a:hover, .read-more a:hover, .carousel-control-next-icon, .carousel-control-prev-icon, span.post-title, .testbutton a:hover,  .tags a i, #comments a.comment-reply-link:hover, #comments input[type="submit"].submit:hover, #header .logo a, #wrapper .related-posts h2.related-posts-main-title, #wrapper .related-posts h3 a, .woocommerce ul.products li.product span.woocommerce-Price-amount.amount, a.button {';
			$the_wp_fitness_custom_css .='color: '.esc_attr($the_wp_fitness_first_theme_color).';';
		$the_wp_fitness_custom_css .='}';
	}
	if($the_wp_fitness_first_theme_color != false){
		$the_wp_fitness_custom_css .=' 
		@media screen and (max-width:1000px){
		.nav-menu .current_page_item > a, .nav-menu .current-menu-item > a, .nav-menu .current_page_ancestor > a, .nav-menu ul li a:hover {';
			$the_wp_fitness_custom_css .='color: '.esc_attr($the_wp_fitness_first_theme_color).';';
		$the_wp_fitness_custom_css .='} }';
	}
	if($the_wp_fitness_first_theme_color != false){
		$the_wp_fitness_custom_css .=' .woocommerce-message, .testbutton a, .pagination .current, .pagination a:hover, .nav-menu ul ul, .nav-menu ul ul a:hover, hr.images_border, #sidebar .tagcloud a:hover, #footer .tagcloud a:hover, .tags a:hover, a.button, a.button:hover  {';
			$the_wp_fitness_custom_css .='border-color: '.esc_attr($the_wp_fitness_first_theme_color).';';
		$the_wp_fitness_custom_css .='}';
	}
	if($the_wp_fitness_first_theme_color != false){
		$the_wp_fitness_custom_css .='  .back-to-top::before{';
			$the_wp_fitness_custom_css .='border-bottom-color: '.esc_attr($the_wp_fitness_first_theme_color).';';
		$the_wp_fitness_custom_css .='}';
	}

	if($the_wp_fitness_second_theme_color != false){
		$the_wp_fitness_custom_css .='.bradcrumbs a, input[type="submit"], a.button, #comments input[type="submit"].submit, #sidebar input[type="submit"], #header, .woocommerce ul.products li.product .button:hover, .woocommerce button.button.alt:hover, .woocommerce a.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .inner, .read-more a:hover, .nav-menu ul ul a:hover, #comments a.comment-reply-link:hover, .blogbtn a:hover, .testbutton a:hover, #slider .carousel-indicators li {';
			$the_wp_fitness_custom_css .='background-color: '.esc_attr($the_wp_fitness_second_theme_color).';';
		$the_wp_fitness_custom_css .='}';
	}
	if($the_wp_fitness_second_theme_color != false){
		$the_wp_fitness_custom_css .='.pagination span, .pagination a, nav.woocommerce-MyAccount-navigation ul li a, h1.page-title, h1.search-title, .trainerbox h3 , #trainer h2 , .read-more a, .carousel-control-next-icon:hover, .carousel-control-prev-icon:hover, .about h3, .blog-sec h2 a, #sidebar h3, .pagination .current, #sidebar a.rsswidget, #sidebar .widget_calendar caption, #sidebar td#prev a, .testbutton a, #sidebar .tagcloud a:hover, #footer .tagcloud a:hover,  #sidebar ul li a:hover, #wrapper h1, span.meta-nav, #wrapper p a, .comment-meta.commentmetadata a, p.woocommerce-result-count, .woocommerce select.orderby, .woocommerce span.onsale, .woocommerce .cart .button, .woocommerce .cart input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, h2.woocommerce-loop-product__title, span.woocommerce-Price-amount.amount , .woocommerce ul.products li.product a, .woocommerce div.product .product_title, .woocommerce button.button.alt, .woocommerce a.button.alt, .woocommerce input.button.alt, .woocommerce span a, .woocommerce table.shop_table td a, a.showcoupon, .blogbtn a, .woocommerce-product-search button{';
			$the_wp_fitness_custom_css .='color: '.esc_attr($the_wp_fitness_second_theme_color).';';
		$the_wp_fitness_custom_css .='}';
	}
	if($the_wp_fitness_second_theme_color != false){
		$the_wp_fitness_custom_css .='nav.woocommerce-MyAccount-navigation ul li,  .blog-sec, #sidebar form, #sidebar h3 , #wrapper, .pagination span, .pagination a, #sidebar aside, #wrapper, .woocommerce select.orderby{';
			$the_wp_fitness_custom_css .='border-color: '.esc_attr($the_wp_fitness_second_theme_color).';';
		$the_wp_fitness_custom_css .='}';
	}
	if($the_wp_fitness_second_theme_color != false){
		$the_wp_fitness_custom_css .=' a:focus, input:focus, textarea:focus {';
			$the_wp_fitness_custom_css .='outline-color: '.esc_attr($the_wp_fitness_second_theme_color).';';
		$the_wp_fitness_custom_css .='}';
	}
	if($the_wp_fitness_second_theme_color != false){
		$the_wp_fitness_custom_css .='  .back-to-top::after{';
			$the_wp_fitness_custom_css .='border-bottom-color: '.esc_attr($the_wp_fitness_second_theme_color).';';
		$the_wp_fitness_custom_css .='}';
	}

	// Layout Options
	$the_wp_fitness_theme_layout = get_theme_mod( 'the_wp_fitness_theme_layout_options','Default Theme');
    if($the_wp_fitness_theme_layout == 'Default Theme'){
		$the_wp_fitness_custom_css .='body{';
			$the_wp_fitness_custom_css .='max-width: 100%;';
		$the_wp_fitness_custom_css .='}';
	}else if($the_wp_fitness_theme_layout == 'Container Theme'){
		$the_wp_fitness_custom_css .='body{';
			$the_wp_fitness_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$the_wp_fitness_custom_css .='}';
		$the_wp_fitness_custom_css .='.page-template-custom-front-page .menu-sec{';
			$the_wp_fitness_custom_css .='right:0;';
		$the_wp_fitness_custom_css .='}';
	}else if($the_wp_fitness_theme_layout == 'Box Container Theme'){
		$the_wp_fitness_custom_css .='body{';
			$the_wp_fitness_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$the_wp_fitness_custom_css .='}';
		$the_wp_fitness_custom_css .='.page-template-custom-front-page .menu-sec{';
			$the_wp_fitness_custom_css .='right:0;';
		$the_wp_fitness_custom_css .='}';
		$the_wp_fitness_custom_css .='#header .logo{';
			$the_wp_fitness_custom_css .='padding:10px 15px 10px 25px;';
		$the_wp_fitness_custom_css .='}';
	}


	/*-------------- Slider Opacity ----------------*/

	$the_wp_fitness_slider_layout = get_theme_mod( 'the_wp_fitness_slider_opacity_color','0.7');
	if($the_wp_fitness_slider_layout == '0'){
		$the_wp_fitness_custom_css .='#slider img{';
			$the_wp_fitness_custom_css .='opacity:0';
		$the_wp_fitness_custom_css .='}';
	}else if($the_wp_fitness_slider_layout == '0.1'){
		$the_wp_fitness_custom_css .='#slider img{';
			$the_wp_fitness_custom_css .='opacity:0.1';
		$the_wp_fitness_custom_css .='}';
	}else if($the_wp_fitness_slider_layout == '0.2'){
		$the_wp_fitness_custom_css .='#slider img{';
			$the_wp_fitness_custom_css .='opacity:0.2';
		$the_wp_fitness_custom_css .='}';
	}else if($the_wp_fitness_slider_layout == '0.3'){
		$the_wp_fitness_custom_css .='#slider img{';
			$the_wp_fitness_custom_css .='opacity:0.3';
		$the_wp_fitness_custom_css .='}';
	}else if($the_wp_fitness_slider_layout == '0.4'){
		$the_wp_fitness_custom_css .='#slider img{';
			$the_wp_fitness_custom_css .='opacity:0.4';
		$the_wp_fitness_custom_css .='}';
	}else if($the_wp_fitness_slider_layout == '0.5'){
		$the_wp_fitness_custom_css .='#slider img{';
			$the_wp_fitness_custom_css .='opacity:0.5';
		$the_wp_fitness_custom_css .='}';
	}else if($the_wp_fitness_slider_layout == '0.6'){
		$the_wp_fitness_custom_css .='#slider img{';
			$the_wp_fitness_custom_css .='opacity:0.6';
		$the_wp_fitness_custom_css .='}';
	}else if($the_wp_fitness_slider_layout == '0.7'){
		$the_wp_fitness_custom_css .='#slider img{';
			$the_wp_fitness_custom_css .='opacity:0.7';
		$the_wp_fitness_custom_css .='}';
	}else if($the_wp_fitness_slider_layout == '0.8'){
		$the_wp_fitness_custom_css .='#slider img{';
			$the_wp_fitness_custom_css .='opacity:0.8';
		$the_wp_fitness_custom_css .='}';
	}else if($the_wp_fitness_slider_layout == '0.9'){
		$the_wp_fitness_custom_css .='#slider img{';
			$the_wp_fitness_custom_css .='opacity:0.9';
		$the_wp_fitness_custom_css .='}';
	}

	/*--------------Slider Content Layout ---------------*/

	$the_wp_fitness_slider_layout = get_theme_mod( 'the_wp_fitness_slider_alignment_option','Right Align');
    if($the_wp_fitness_slider_layout == 'Left Align'){
		$the_wp_fitness_custom_css .='#slider .carousel-caption{';
			$the_wp_fitness_custom_css .='text-align:left;';
		$the_wp_fitness_custom_css .='}';
		$the_wp_fitness_custom_css .='#slider .carousel-caption{';
		$the_wp_fitness_custom_css .='left:15%; right:50%;';
		$the_wp_fitness_custom_css .='}';
		$the_wp_fitness_custom_css .='@media screen and (max-width: 1000px){
			#slider .carousel-caption{';
			$the_wp_fitness_custom_css .='right:40%;';
		$the_wp_fitness_custom_css .='} }';

	}else if($the_wp_fitness_slider_layout == 'Center Align'){
		$the_wp_fitness_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$the_wp_fitness_custom_css .='text-align:center;';
		$the_wp_fitness_custom_css .='}';
		$the_wp_fitness_custom_css .='#slider .carousel-caption{';
		$the_wp_fitness_custom_css .='left:30%; right:30%;';
		$the_wp_fitness_custom_css .='}';
		$the_wp_fitness_custom_css .='@media screen and (max-width: 1000px){
			#slider .carousel-caption{';
			$the_wp_fitness_custom_css .='right:15%; left:15%;';
		$the_wp_fitness_custom_css .='} }';

	}else if($the_wp_fitness_slider_layout == 'Right Align'){
		$the_wp_fitness_custom_css .='#slider .carousel-caption{';
			$the_wp_fitness_custom_css .='text-align:right;';
		$the_wp_fitness_custom_css .='}';
		$the_wp_fitness_custom_css .='#slider .carousel-caption{';
		$the_wp_fitness_custom_css .='left:50%; right:15%;';
		$the_wp_fitness_custom_css .='}';
		$the_wp_fitness_custom_css .='@media screen and (max-width: 1000px){
			#slider .carousel-caption{';
			$the_wp_fitness_custom_css .='left:40%;';
		$the_wp_fitness_custom_css .='} }';
	}

	/*--------- Preloader Color Option -------*/
	$the_wp_fitness_preloader_color = get_theme_mod('the_wp_fitness_preloader_color');

	if($the_wp_fitness_preloader_color != false){
		$the_wp_fitness_custom_css .=' .tg-loader{';
			$the_wp_fitness_custom_css .='border-color: '.esc_attr($the_wp_fitness_preloader_color).';';
		$the_wp_fitness_custom_css .='} ';
		$the_wp_fitness_custom_css .=' .tg-loader-inner, .preloader .preloader-container .animated-preloader, .preloader .preloader-container .animated-preloader:before{';
			$the_wp_fitness_custom_css .='background-color: '.esc_attr($the_wp_fitness_preloader_color).';';
		$the_wp_fitness_custom_css .='} ';
	}

	$the_wp_fitness_preloader_bg_color = get_theme_mod('the_wp_fitness_preloader_bg_color');

	if($the_wp_fitness_preloader_bg_color != false){
		$the_wp_fitness_custom_css .=' #overlayer, .preloader{';
			$the_wp_fitness_custom_css .='background-color: '.esc_attr($the_wp_fitness_preloader_bg_color).';';
		$the_wp_fitness_custom_css .='} ';
	}

	/*------------ Button Settings option-----------------*/

	$the_wp_fitness_top_button_padding = get_theme_mod('the_wp_fitness_top_button_padding');
	$the_wp_fitness_bottom_button_padding = get_theme_mod('the_wp_fitness_bottom_button_padding');
	$the_wp_fitness_left_button_padding = get_theme_mod('the_wp_fitness_left_button_padding');
	$the_wp_fitness_right_button_padding = get_theme_mod('the_wp_fitness_right_button_padding');
	if($the_wp_fitness_top_button_padding != false || $the_wp_fitness_bottom_button_padding != false || $the_wp_fitness_left_button_padding != false || $the_wp_fitness_right_button_padding != false){
		$the_wp_fitness_custom_css .='.blogbtn a, .read-more a, .testbutton a, #comments input[type="submit"].submit{';
			$the_wp_fitness_custom_css .='padding-top: '.esc_attr($the_wp_fitness_top_button_padding).'px; padding-bottom: '.esc_attr($the_wp_fitness_bottom_button_padding).'px; padding-left: '.esc_attr($the_wp_fitness_left_button_padding).'px; padding-right: '.esc_attr($the_wp_fitness_right_button_padding).'px; display:inline-block;';
		$the_wp_fitness_custom_css .='}';
	}

	$the_wp_fitness_button_border_radius = get_theme_mod('the_wp_fitness_button_border_radius',0);
	$the_wp_fitness_custom_css .='.blogbtn a, .read-more a, .testbutton a, #comments input[type="submit"].submit{';
		$the_wp_fitness_custom_css .='border-radius: '.esc_attr($the_wp_fitness_button_border_radius).'px;';
	$the_wp_fitness_custom_css .='}';

	/*----------- Copyright css -----*/
	$the_wp_fitness_copyright_top_padding = get_theme_mod('the_wp_fitness_top_copyright_padding');
	$the_wp_fitness_copyright_bottom_padding = get_theme_mod('the_wp_fitness_bottom_copyright_padding');
	if($the_wp_fitness_copyright_top_padding != false || $the_wp_fitness_copyright_bottom_padding != false){
		$the_wp_fitness_custom_css .='.inner{';
			$the_wp_fitness_custom_css .='padding-top: '.esc_attr($the_wp_fitness_copyright_top_padding).'px; padding-bottom: '.esc_attr($the_wp_fitness_copyright_bottom_padding).'px; ';
		$the_wp_fitness_custom_css .='}';
	} 

	$the_wp_fitness_copyright_alignment = get_theme_mod('the_wp_fitness_copyright_alignment', 'center');
	if($the_wp_fitness_copyright_alignment == 'center' ){
		$the_wp_fitness_custom_css .='#footer .inner p{';
			$the_wp_fitness_custom_css .='text-align: '. $the_wp_fitness_copyright_alignment .';';
		$the_wp_fitness_custom_css .='}';
	}elseif($the_wp_fitness_copyright_alignment == 'left' ){
		$the_wp_fitness_custom_css .='#footer .inner p{';
			$the_wp_fitness_custom_css .=' text-align: '. $the_wp_fitness_copyright_alignment .';';
		$the_wp_fitness_custom_css .='}';
	}elseif($the_wp_fitness_copyright_alignment == 'right' ){
		$the_wp_fitness_custom_css .='#footer .inner p{';
			$the_wp_fitness_custom_css .='text-align: '. $the_wp_fitness_copyright_alignment .';';
		$the_wp_fitness_custom_css .='}';
	}

	$the_wp_fitness_copyright_font_size = get_theme_mod('the_wp_fitness_copyright_font_size');
	$the_wp_fitness_custom_css .='#footer .inner p{';
		$the_wp_fitness_custom_css .='font-size: '.esc_attr($the_wp_fitness_copyright_font_size).'px;';
	$the_wp_fitness_custom_css .='}';

	/*------ Slider Show/Hide ------*/
	$the_wp_fitness_slider = get_theme_mod('the_wp_fitness_slider_hide');
	if($the_wp_fitness_slider == false ){
		$the_wp_fitness_custom_css .='.page-template-custom-front-page .menu-sec{';
			$the_wp_fitness_custom_css .='position: static; ';
		$the_wp_fitness_custom_css .='}';
	}

	/*------ Topbar padding ------*/
	$the_wp_fitness_top_topbar_padding = get_theme_mod('the_wp_fitness_top_topbar_padding');
	$the_wp_fitness_bottom_topbar_padding = get_theme_mod('the_wp_fitness_bottom_topbar_padding');
	if($the_wp_fitness_top_topbar_padding != false || $the_wp_fitness_bottom_topbar_padding != false){
		$the_wp_fitness_custom_css .='#header .header-top{';
			$the_wp_fitness_custom_css .='padding-top: '.esc_attr($the_wp_fitness_top_topbar_padding).'px; padding-bottom: '.esc_attr($the_wp_fitness_bottom_topbar_padding).'px; ';
		$the_wp_fitness_custom_css .='}';
	}

	/*------ Woocommerce ----*/
	$the_wp_fitness_product_border = get_theme_mod('the_wp_fitness_product_border',false);

	if($the_wp_fitness_product_border == true){
		$the_wp_fitness_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$the_wp_fitness_custom_css .='border: 1px solid #dcdcdc;';
		$the_wp_fitness_custom_css .='}';
	}

	$the_wp_fitness_product_top = get_theme_mod('the_wp_fitness_product_top_padding', 10);
	$the_wp_fitness_product_bottom = get_theme_mod('the_wp_fitness_product_bottom_padding', 10);
	$the_wp_fitness_product_left = get_theme_mod('the_wp_fitness_product_left_padding', 10);
	$the_wp_fitness_product_right = get_theme_mod('the_wp_fitness_product_right_padding', 10);
	$the_wp_fitness_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
		$the_wp_fitness_custom_css .='padding-top: '.esc_attr($the_wp_fitness_product_top).'px; padding-bottom: '.esc_attr($the_wp_fitness_product_bottom).'px; padding-left: '.esc_attr($the_wp_fitness_product_left).'px; padding-right: '.esc_attr($the_wp_fitness_product_right).'px;';
	$the_wp_fitness_custom_css .='}';

	$the_wp_fitness_product_border_radius = get_theme_mod('the_wp_fitness_product_border_radius');
	$the_wp_fitness_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
		$the_wp_fitness_custom_css .='border-radius: '.esc_attr($the_wp_fitness_product_border_radius).'px;';
	$the_wp_fitness_custom_css .='}';

	/*----- WooCommerce button css --------*/
	$the_wp_fitness_product_button_top = get_theme_mod('the_wp_fitness_product_button_top_padding',10);
	$the_wp_fitness_product_button_bottom = get_theme_mod('the_wp_fitness_product_button_bottom_padding',10);
	$the_wp_fitness_product_button_left = get_theme_mod('the_wp_fitness_product_button_left_padding',15);
	$the_wp_fitness_product_button_right = get_theme_mod('the_wp_fitness_product_button_right_padding',15);
	$the_wp_fitness_custom_css .='.woocommerce ul.products li.product .button, .woocommerce div.product form.cart .button, a.button.wc-forward, .woocommerce .cart .button, .woocommerce .cart input.button, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, button.woocommerce-button.button.woocommerce-form-login__submit, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled]{';
		$the_wp_fitness_custom_css .='padding-top: '.esc_attr($the_wp_fitness_product_button_top).'px; padding-bottom: '.esc_attr($the_wp_fitness_product_button_bottom).'px; padding-left: '.esc_attr($the_wp_fitness_product_button_left).'px; padding-right: '.esc_attr($the_wp_fitness_product_button_right).'px;';
	$the_wp_fitness_custom_css .='}';

	$the_wp_fitness_product_button_border_radius = get_theme_mod('the_wp_fitness_product_button_border_radius');
	$the_wp_fitness_custom_css .='.woocommerce ul.products li.product .button, .woocommerce div.product form.cart .button, a.button.wc-forward, .woocommerce .cart .button, .woocommerce .cart input.button, a.checkout-button.button.alt.wc-forward, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, button.woocommerce-button.button.woocommerce-form-login__submit{';
		$the_wp_fitness_custom_css .='border-radius: '.esc_attr($the_wp_fitness_product_button_border_radius).'px;';
	$the_wp_fitness_custom_css .='}';

	/*----- WooCommerce product sale css --------*/
	$the_wp_fitness_product_sale_top = get_theme_mod('the_wp_fitness_product_sale_top_padding');
	$the_wp_fitness_product_sale_bottom = get_theme_mod('the_wp_fitness_product_sale_bottom_padding');
	$the_wp_fitness_product_sale_left = get_theme_mod('the_wp_fitness_product_sale_left_padding');
	$the_wp_fitness_product_sale_right = get_theme_mod('the_wp_fitness_product_sale_right_padding');
	$the_wp_fitness_custom_css .='.woocommerce span.onsale {';
		$the_wp_fitness_custom_css .='padding-top: '.esc_attr($the_wp_fitness_product_sale_top).'px; padding-bottom: '.esc_attr($the_wp_fitness_product_sale_bottom).'px; padding-left: '.esc_attr($the_wp_fitness_product_sale_left).'px; padding-right: '.esc_attr($the_wp_fitness_product_sale_right).'px;';
	$the_wp_fitness_custom_css .='}';

	$the_wp_fitness_product_sale_border_radius = get_theme_mod('the_wp_fitness_product_sale_border_radius',50);
	$the_wp_fitness_custom_css .='.woocommerce span.onsale {';
		$the_wp_fitness_custom_css .='border-radius: '.esc_attr($the_wp_fitness_product_sale_border_radius).'px;';
	$the_wp_fitness_custom_css .='}';

	$the_wp_fitness_menu_case = get_theme_mod('the_wp_fitness_product_sale_position', 'Right');
	if($the_wp_fitness_menu_case == 'Right' ){
		$the_wp_fitness_custom_css .='.woocommerce ul.products li.product .onsale{';
			$the_wp_fitness_custom_css .=' left:auto; right:0;';
		$the_wp_fitness_custom_css .='}';
	}elseif($the_wp_fitness_menu_case == 'Left' ){
		$the_wp_fitness_custom_css .='.woocommerce ul.products li.product .onsale{';
			$the_wp_fitness_custom_css .=' left:-10px; right:auto;';
		$the_wp_fitness_custom_css .='}';
	}

	$the_wp_fitness_product_sale_font_size = get_theme_mod('the_wp_fitness_product_sale_font_size',13);
	$the_wp_fitness_custom_css .='.woocommerce span.onsale {';
		$the_wp_fitness_custom_css .='font-size: '.esc_attr($the_wp_fitness_product_sale_font_size).'px;';
	$the_wp_fitness_custom_css .='}';

	/*---- Slider Image overlay -----*/
	$the_wp_fitness_slider_image_overlay = get_theme_mod('the_wp_fitness_slider_image_overlay',true);
	if($the_wp_fitness_slider_image_overlay == false){
		$the_wp_fitness_custom_css .='#slider img {';
			$the_wp_fitness_custom_css .='opacity: 1;';
		$the_wp_fitness_custom_css .='}';
	}

	$the_wp_fitness_slider_overlay_color = get_theme_mod('the_wp_fitness_slider_overlay_color');
	if($the_wp_fitness_slider_overlay_color != false){
		$the_wp_fitness_custom_css .='#slider  {';
			$the_wp_fitness_custom_css .='background-color: '.esc_attr($the_wp_fitness_slider_overlay_color).';';
		$the_wp_fitness_custom_css .='}';
	}

	/*---- Comment form ----*/
	$the_wp_fitness_comment_width = get_theme_mod('the_wp_fitness_comment_width', '100');
	$the_wp_fitness_custom_css .='#comments textarea{';
		$the_wp_fitness_custom_css .=' width:'.esc_attr($the_wp_fitness_comment_width).'%;';
	$the_wp_fitness_custom_css .='}';

	$the_wp_fitness_comment_submit_text = get_theme_mod('the_wp_fitness_comment_submit_text', 'Post Comment');
	if($the_wp_fitness_comment_submit_text == ''){
		$the_wp_fitness_custom_css .='#comments p.form-submit {';
			$the_wp_fitness_custom_css .='display: none;';
		$the_wp_fitness_custom_css .='}';
	}

	$the_wp_fitness_comment_title = get_theme_mod('the_wp_fitness_comment_title', 'Leave a Reply');
	if($the_wp_fitness_comment_title == ''){
		$the_wp_fitness_custom_css .='#comments h2#reply-title {';
			$the_wp_fitness_custom_css .='display: none;';
		$the_wp_fitness_custom_css .='}';
	}

	/*------ Footer background css -------*/
	$the_wp_fitness_footer_bg_color = get_theme_mod('the_wp_fitness_footer_bg_color');
	if($the_wp_fitness_footer_bg_color != false){
		$the_wp_fitness_custom_css .='#footer{';
			$the_wp_fitness_custom_css .='background-color: '.esc_attr($the_wp_fitness_footer_bg_color).';';
		$the_wp_fitness_custom_css .='}';
	}

	$the_wp_fitness_footer_bg_image = get_theme_mod('the_wp_fitness_footer_bg_image');
	if($the_wp_fitness_footer_bg_image != false){
		$the_wp_fitness_custom_css .='#footer{';
			$the_wp_fitness_custom_css .='background: url('.esc_attr($the_wp_fitness_footer_bg_image).');';
		$the_wp_fitness_custom_css .='}';
	}

	/*----- Featured image css -----*/
	$the_wp_fitness_feature_image_border_radius = get_theme_mod('the_wp_fitness_feature_image_border_radius');
	if($the_wp_fitness_feature_image_border_radius != false){
		$the_wp_fitness_custom_css .='.blog-sec img{';
			$the_wp_fitness_custom_css .='border-radius: '.esc_attr($the_wp_fitness_feature_image_border_radius).'px;';
		$the_wp_fitness_custom_css .='}';
	}

	$the_wp_fitness_feature_image_shadow = get_theme_mod('the_wp_fitness_feature_image_shadow');
	if($the_wp_fitness_feature_image_shadow != false){
		$the_wp_fitness_custom_css .='.blog-sec img{';
			$the_wp_fitness_custom_css .='box-shadow: '.esc_attr($the_wp_fitness_feature_image_shadow).'px '.esc_attr($the_wp_fitness_feature_image_shadow).'px '.esc_attr($the_wp_fitness_feature_image_shadow).'px #aaa;';
		$the_wp_fitness_custom_css .='}';
	}

	/*------ Sticky header padding ------------*/
	$the_wp_fitness_top_sticky_header_padding = get_theme_mod('the_wp_fitness_top_sticky_header_padding');
	$the_wp_fitness_bottom_sticky_header_padding = get_theme_mod('the_wp_fitness_bottom_sticky_header_padding');
	$the_wp_fitness_custom_css .=' .fixed-header{';
		$the_wp_fitness_custom_css .=' padding-top: '.esc_attr($the_wp_fitness_top_sticky_header_padding).'px; padding-bottom: '.esc_attr($the_wp_fitness_bottom_sticky_header_padding).'px';
	$the_wp_fitness_custom_css .='}';

	/*------ Related products ---------*/
	$the_wp_fitness_related_products = get_theme_mod('the_wp_fitness_single_related_products',true);
	if($the_wp_fitness_related_products == false){
		$the_wp_fitness_custom_css .=' .related.products{';
			$the_wp_fitness_custom_css .='display: none;';
		$the_wp_fitness_custom_css .='}';
	}

	/*-------- Menu Font Size --------*/
	$the_wp_fitness_menu_font_size = get_theme_mod('the_wp_fitness_menu_font_size',14);
	if($the_wp_fitness_menu_font_size != false){
		$the_wp_fitness_custom_css .='.nav-menu li a{';
			$the_wp_fitness_custom_css .='font-size: '.esc_attr($the_wp_fitness_menu_font_size).'px;';
		$the_wp_fitness_custom_css .='}';
	}

	$the_wp_fitness_menu_font_weight = get_theme_mod('the_wp_fitness_menu_font_weight');
	$the_wp_fitness_custom_css .='.nav-menu li a{';
		$the_wp_fitness_custom_css .='font-weight: '.esc_attr($the_wp_fitness_menu_font_weight).';';
	$the_wp_fitness_custom_css .='}';

	$the_wp_fitness_menu_case = get_theme_mod('the_wp_fitness_menu_case', 'uppercase');
	if($the_wp_fitness_menu_case == 'uppercase' ){
		$the_wp_fitness_custom_css .='.nav-menu li a{';
			$the_wp_fitness_custom_css .=' text-transform: uppercase;';
		$the_wp_fitness_custom_css .='}';
	}elseif($the_wp_fitness_menu_case == 'capitalize' ){
		$the_wp_fitness_custom_css .='.nav-menu li a{';
			$the_wp_fitness_custom_css .=' text-transform: capitalize;';
		$the_wp_fitness_custom_css .='}';
	}

	// Social Icons Font Size
	$the_wp_fitness_social_icons_font_size = get_theme_mod('the_wp_fitness_social_icons_font_size', '16');
	$the_wp_fitness_custom_css .='.social-media i{';
		$the_wp_fitness_custom_css .='font-size: '.esc_attr($the_wp_fitness_social_icons_font_size).'px;';
	$the_wp_fitness_custom_css .='}';

	// Featured image header
	$header_image_url = the_wp_fitness_banner_image( $image_url = '' );
	$the_wp_fitness_custom_css .='#page-site-header{';
		$the_wp_fitness_custom_css .='background-image: url('. esc_url( $header_image_url ).'); background-size: cover;';
	$the_wp_fitness_custom_css .='}';

	$the_wp_fitness_post_featured_image = get_theme_mod('the_wp_fitness_post_featured_image', 'in-content');
	if($the_wp_fitness_post_featured_image == 'banner' ){
		$the_wp_fitness_custom_css .='.single #wrapper h1, .page #wrapper h1, .page #wrapper img, .page .title-box{';
			$the_wp_fitness_custom_css .=' display: none;';
		$the_wp_fitness_custom_css .='}';
		$the_wp_fitness_custom_css .='#page-site-header{';
			$the_wp_fitness_custom_css .=' margin-bottom: 20px;';
		$the_wp_fitness_custom_css .='}';
		$the_wp_fitness_custom_css .='.page-template-custom-front-page #page-site-header{';
			$the_wp_fitness_custom_css .=' display: none;';
		$the_wp_fitness_custom_css .='}';
	}

	// Woocommerce Shop page pagination
	$the_wp_fitness_shop_page_navigation = get_theme_mod('the_wp_fitness_shop_page_navigation',true);
	if ($the_wp_fitness_shop_page_navigation == false) {
		$the_wp_fitness_custom_css .='.woocommerce nav.woocommerce-pagination{';
			$the_wp_fitness_custom_css .='display: none;';
		$the_wp_fitness_custom_css .='}';
	}

	/*---- Slider Height ------*/
	$the_wp_fitness_slider_height = get_theme_mod('the_wp_fitness_slider_height');
	$the_wp_fitness_custom_css .='#slider img{';
		$the_wp_fitness_custom_css .='height: '.esc_attr($the_wp_fitness_slider_height).'px;';
	$the_wp_fitness_custom_css .='}';
	$the_wp_fitness_custom_css .='@media screen and (max-width: 768px){
		#slider img{';
		$the_wp_fitness_custom_css .='height: auto;';
	$the_wp_fitness_custom_css .='} }';

	/*----- Blog Post display type css ------*/
	$the_wp_fitness_blog_post_display_type = get_theme_mod('the_wp_fitness_blog_post_display_type', 'blocks');
	if($the_wp_fitness_blog_post_display_type == 'without blocks' ){
		$the_wp_fitness_custom_css .='.blog .blog-sec, .blog #sidebar .widget{';
			$the_wp_fitness_custom_css .='border: 0; box-shadow: none;';
		$the_wp_fitness_custom_css .='}';
	}

	/*---------- Responsive style ---------*/
	if (get_theme_mod('the_wp_fitness_hide_topbar_responsive',true) == true && get_theme_mod('the_wp_fitness_top_header',false) == false) {
		$the_wp_fitness_custom_css .='.header-top{';
			$the_wp_fitness_custom_css .=' display: none;';
		$the_wp_fitness_custom_css .='} ';
	}
	if (get_theme_mod('the_wp_fitness_hide_topbar_responsive',true) == false) {
		$the_wp_fitness_custom_css .='@media screen and (max-width: 575px){
			.header-top{';
			$the_wp_fitness_custom_css .=' display: none;';
		$the_wp_fitness_custom_css .='} }';
	} else if(get_theme_mod('the_wp_fitness_hide_topbar_responsive',true) == true){
		$the_wp_fitness_custom_css .='@media screen and (max-width: 575px){
			.header-top{';
			$the_wp_fitness_custom_css .=' display: block;';
		$the_wp_fitness_custom_css .='} }';
	}

	// Metabox Seperator
	$the_wp_fitness_metabox_seperator = get_theme_mod('the_wp_fitness_metabox_seperator');
	if($the_wp_fitness_metabox_seperator != '' ){
		$the_wp_fitness_custom_css .='.post-info span:after{';
			$the_wp_fitness_custom_css .=' content: "'.esc_attr($the_wp_fitness_metabox_seperator).'"; padding-left:10px;';
		$the_wp_fitness_custom_css .='}';
		$the_wp_fitness_custom_css .='.post-info span:last-child:after{';
			$the_wp_fitness_custom_css .=' content: none;';
		$the_wp_fitness_custom_css .='}';
	}

	// Site title Font Size
	$the_wp_fitness_site_title_font_size = get_theme_mod('the_wp_fitness_site_title_font_size', '30');
	$the_wp_fitness_custom_css .='#header .logo h1, #header .logo p.site-title{';
		$the_wp_fitness_custom_css .='font-size: '.esc_attr($the_wp_fitness_site_title_font_size).'px;';
	$the_wp_fitness_custom_css .='}';

	// Site tagline Font Size
	$the_wp_fitness_site_tagline_font_size = get_theme_mod('the_wp_fitness_site_tagline_font_size', '14');
	$the_wp_fitness_custom_css .='#header .logo p{';
		$the_wp_fitness_custom_css .='font-size: '.esc_attr($the_wp_fitness_site_tagline_font_size).'px;';
	$the_wp_fitness_custom_css .='}';