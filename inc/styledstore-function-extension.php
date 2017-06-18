<?php

if ( ! function_exists( 'lojamissdaisy_social_links' ) ) :
/**
 * @author StyledThemes
 * @action_hook header_top_bar_social_links
 * @uses social media links with icon
*/

function lojamissdaisy_social_links() {

	if( get_theme_mod( 'styledstore_show_social_icon' ) != '' ) { ?>
		<div class="social-icons ">
			<p class="siga">SIGA A MISS</p>
			<?php if( get_theme_mod( 'facebook_uid') ) { ?>
				<li class="social-icon facebook">
					<a href="<?php echo esc_url( get_theme_mod( 'facebook_uid') ); ?>">
						<i class="fa fa-facebook" aria-hidden="true"></i>
					</a>
				</li>
			<?php }
			if( get_theme_mod( 'skype_uid' ) ) { ?>
				<li class="social-icon skype">
					<a href="skype:<?php echo get_theme_mod( 'skype_uid' );?>?call">
						<i class="fa fa-skype" aria-hidden="true"></i>
					</a>
				</li>
			<?php }
			if( get_theme_mod( 'twitter_uid' ) ) { ?>
				<li class="social-icon twitter">
					<a href="<?php echo esc_url( get_theme_mod( 'twitter_uid' ) ); ?>">
						<i class="fa fa-twitter" aria-hidden="true"></i>
					</a>
				</li>
			<?php }
			if( get_theme_mod( 'rss_uid' ) ) { ?>
				<li class="social-icon rss">
					<a href="<?php echo esc_url( get_theme_mod( 'rss_uid' ) ); ?>">
						<i class="fa fa-rss" aria-hidden="true"></i>
					</a>
				</li>
			<?php }
			//add extra social icon links
			do_action( 'styledstore_add_social_icon' );
			?>
		</div>
	<?php }
}
endif;

add_action( 'lojamissdaisy_header_top_bar_social_links', 'lojamissdaisy_social_links', 10 );



if ( ! function_exists( 'lojamissdaisy_navigation_menu' ) ) :
/**
 * @author StyledThemes
 * @action_hook styledstore_header_navigation_menu
 * @uses social media links with icon
*/

function lojamissdaisy_navigation_menu() { ?>

		<div class="navigation-menu sameheight col-xs-4 col-sm-6 col-md-12">
			<?php
				$styledstore_primary_nav = array(
					'theme_location'  => 'primary',
					'container'       => false,
					'menu_class'      => 'header-menu sm sm-mint',
					'menu_id'			=> 'main-menu',
					'fallback_cb'       => 'wp_page_menu'
				);
				wp_nav_menu( $styledstore_primary_nav );
			?>
		</div>

		<div class="mobile-navigation col-xs-4 col-sm-6 col-md-8">
		<div class="st-mobile-menu">
			<input id="main-menu-state" type="checkbox" />
				<label class="main-menu-btn" for="main-menu-state">
				<span class="main-menu-btn-icon"></span>
			</label>

			<?php
				$styledstore_primary_nav = array(
					'theme_location'  => 'mobile',
					'container'       => false,
					'menu_class'      => 'header-menu sm sm-mint',
					'menu_id'			=> 'main-menu',
					'fallback_cb'       => 'wp_page_menu',
				);
				wp_nav_menu( $styledstore_primary_nav );
			?>
		</div>
	</div>
	</div><!-- container class closed -->
</div><!-- header class closed -->

		<!-- mobile menu -->

<?php
}
endif;	//styledstore_navigation_menu

add_filter('wp_nav_menu_items','styledstore_add_search_form_with_navigation_menu', 10, 2);

if( ! function_exists( 'styledstore_add_search_form_with_navigation_menu' ) ) :
/**
 * @author StyledThemes
 * @action_hook wp_nav_menu_items
 * @return search form
 * @uses add woocommerce search form and wordpress search form with navigation menu. Amd YOu can customize this function simply by overwriting styledstore_add_search_form_with_navigation_menu() on child theme functions.php
 * @version 1.0
*/


function styledstore_add_search_form_with_navigation_menu( $items, $args ) {

	$form = '';
    if( $args->theme_location == 'primary' ) {
    	if ( styledstore_check_woocommerce_activation() ) :

    	$form = '<li class="st-search attach-with-menu"> <form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
			<label class="screen-reader-text" for="s">' . __( 'Search for:', 'styled-store' ) . '</label>
			<input type="text" value="' .esc_attr( get_search_query() ) . '" name="s" id="s" placeholder="'.esc_attr_x( 'Procurando por?', 'placeholder', 'styled-store' ).'" />
			<button class="btn" type="submit" value="'.esc_attr_x( 'Search', 'submit button', 'styled-store' ).'"><i class="fa fa-search"></i> </button>
			<input type="hidden" name="post_type" value="product" />
			</form>
			</li>';
		else :
			$form = '<li class="st-search attach-with-menu"><form role="search" id="searchform" method="get" class="search-form" action="'. esc_url( home_url( '/' ) ).'">
					  <input type="text" placeholder="'.esc_attr_x( 'search For', 'placeholder', 'styled-store' ).'" value="'.esc_attr( get_search_query() ).'" name="s" >

					  <button class="btn" type="submit" value="'.esc_attr_x( 'Search', 'submit button', 'styled-store' ).'"><i class="fa fa-search"></i></button>
				</form></li>';
		endif;
	}
    return $items.$form;
}
endif;

add_action( 'lojamissdaisy_header_navigation_menu', 'lojamissdaisy_navigation_menu', 10);
