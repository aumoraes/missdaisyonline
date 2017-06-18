<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version 2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ( $rating_count > 0 ) : ?>

<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
	<div class="rate-wrap">
		<div class="rate">
			<a class="rate-link" href="#">
				<span class="lojamissdaisy-rate">
					<div class="rate-container">
						<div class="rate-value rate-count rate-enabled">
							<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong><?php printf( __( ' de %s5%s', 'styled-store' ), '<span itemprop="bestRating">', '</span>' ); ?>
							<div class="rate-sprite">
								<meta content="0" itemprop="worstRating">
								<span class="rate-symbols rate-sprite" style="width: <?php echo ( ( $average / 5 ) * 100 ); ?>%;"></span>
							</div>
					</div>
					<span>VEJA O COMENTÁRIO DE QUEM COMPROU</span>
						(<?php printf( '<span class="rate-count rate-enabled" itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>)
				</div>

			</a>
		</div>
	</div>
</div>

<?php endif; ?>
