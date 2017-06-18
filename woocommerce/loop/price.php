<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$numero_parcelas = PARCELAS;
$valor_produto = $product->get_price();
$valor_parcelado = $valor_produto / $numero_parcelas;
$valor_parcelado = round( $valor_parcelado, 2 );
?>

<div class="shop">
	<div class="swp_in_cash_price single">
		<p class="price fswp_calc">
			<span class="fswp_in_cash_prefix">por</span>
			<span class="woocommerce-Price-amount amount">
				<span class="woocommerce-Price-currencySymbol">R$</span>
				<?php echo $valor_produto; ?>
			</span>
		</p>
	</div>

	<div class="fswp_installments_price single">
		<p class="price fswp_calc">
			<span class="fswp_installment_prefix">
				ou até
				<span class="woocommerce-Price-amount amount">
					<?php echo $numero_parcelas ?>x
				</span>
				<span class="woocommerce-Price-amount amount">
					<span class="woocommerce-Price-currencySymbol">R$</span>
					<?php echo $valor_parcelado; ?>
				</span>
			</span>
		</p>
	</div>
</div>
