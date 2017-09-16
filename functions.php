<?php


require_once dirname( __FILE__ ) . '/inc/customizer-extension.php';
require_once dirname( __FILE__ ) . '/inc/styledstore-function-extension.php';

/**
 * Remove value from PAC when city igual São Paulo.
 * @param  Array $rate        Itens enable for pay.
 * @param  Int $instance_id Id of the kind of item for pay.
 * @return Array              Return null for options PAC just when city igual São Paulo.
 */
function custom_woocommerce_correios_shipping_methods( $rate,$instance_id ) {
	// Id for PAC in definition of form to pay
	$pac_city_id = 5;
	if ( $pac_city_id !== $instance_id ) {
		return $rate;
	}
	$rate['cost'] = 0;
	return $rate;
}
add_filter( 'woocommerce_correios_correios-pac_rate', 'custom_woocommerce_correios_shipping_methods', 10, 2 );


/**
 * Enqueue scripts and styles.
 */
function missdaisyonline_scripts() {
	wp_enqueue_style( 'missdaisyonline-main-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'missdaisyonline_scripts' );


/**
 * Set a label for PAC item when the price value is null,
 * work together with method custom_woocommerce_correios_shipping_methods.
 * @param  String $label  Value of PAC  method of pay.
 * @param  Object $method contem datas from payment
 * @return String         Get the actual label from PAC payment method and add ( free )
 */

function my_wc_custom_free_shipping_label( $label, $method ) {
	// Only apply when is free and not using the free shipping method.
	if ( '0.00' === $method->cost && 'free_shipping' !== $method->method_id ) {
		$label = sprintf( __( '%s: (Free)', 'text-domain' ), $label );
	}
	return $label;
}
add_filter( 'woocommerce_cart_shipping_method_full_label', 'my_wc_custom_free_shipping_label', 10, 2 );


/**
 * Remove other kinds of payment when free shipping is enable ( generaly by a value condition ).
 * @param  Array  $rates Contem data about payent methods.
 * @return Array        free_shipping if it's enable.
 */
function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );


add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
		add_theme_support( 'woocommerce' );
}

add_action('customize_register','lojamissdaisy_header_color');
/*
 * Add in our custom Header Color setting and control to be used in the Customizer in the Colors section
 *
 */
function lojamissdaisy_header_color( $wp_customize ) {
	$wp_customize->add_setting(
		'missdaisy_header_color', //give it an ID
		array(
		 'default' => '#712095', // Give it a default
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'missdaisy_custom_header_color', //give it an ID
			array(
				'label' => __( 'Cor do Header', 'missdaisy' ), //set the label to appear in the Customizer
				'section' => 'colors', //select the section for it to appear under
				'settings' => 'missdaisy_header_color' //pick the setting it applies to
			)
		)
	);
}


add_action( 'wp_head', 'missdaisy_customize_css' );
/*
 * Output our custom Accent Color setting CSS Style
 *
 */
function missdaisy_customize_css() {
 ?>
	<style type="text/css">
		#header { background-color:<?php echo get_theme_mod( 'missdaisy_header_color', '#712095' ); ?>; }
	</style>
<?php
}


//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


// Remove category slug from shop
add_action( 'pre_get_posts', 'remove_cat_from_shop_loop' );

function remove_cat_from_shop_loop( $q ) {

		if ( ! $q->is_main_query() ) return;
		if ( ! $q->is_post_type_archive() ) return;

		if ( ! is_admin() && is_shop() ) {

				$q->set( 'tax_query', array(array(
						'taxonomy' => 'product_cat',
						'field' => 'slug',
						'terms' => array( 'banner' ), // Change it to the slug you want to hide
						'operator' => 'NOT IN'
				)));

		}

		remove_action( 'pre_get_posts', 'remove_cat_from_shop_loop' );

}

if ( ! function_exists( 'lojamissdaisy_contact' ) ) :
/**
 * @author StyledThemes
 * @action_hook header_top_bar_social_links
 * @uses social media links with icon
*/

function lojamissdaisy_contact() {
	?>
	<div class="contact-itens ">
	<?php

	if( get_theme_mod( 'show_contato' ) != '' ) { ?>

			<?php if( get_theme_mod( 'sac_uid') ) { ?>
				<li class="contact-icon sac">
					<i class="fa fa-headphones" aria-hidden="true"></i>
					<p>
						SAC: <?php echo get_theme_mod( 'sac_uid'); ?>
					</p>
				</li>
			<?php }

			if( get_theme_mod( 'email_uid') ) { ?>
				<li class="contact-icon email">
					<i class="fa fa-envelope" aria-hidden="true"></i>
					<p>
						<?php echo get_theme_mod( 'email_uid'); ?>
						<span> | </span>
					</p>
				</li>
			<?php }
			//add extra social icon links
			do_action( 'styledstore_add_social_icon' );



		}
	?>
	<li class="contact-icon blog">
		<p> <a href="/blog-da-miss/" >Blog da Miss</a> </p>
	</li>
	</div>
	<?php
}
endif;
add_action( 'styledstore_header_top_bar_contacts', 'lojamissdaisy_contact', 10 );


?>
