<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
		 echo get_the_password_form();
		 return;
	 }
?>
<div itemscope <?php post_class('clearfix'); ?>>
	<div class="col-sm-6 col-md-6 st-product-image">
		<?php wc_get_template( 'single-product/product-image.php' ); ?>
	</div>
	<div class="col-sm-6 col-md-6 st-product-sale">
			<?php
			/**
			 * woocommerce_single_product_summary hook.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			// remove woocommerce_template_single_meta hook
			/**/
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', '40' );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', '20' );

			do_action( 'woocommerce_single_product_summary' );
		?>
		<?php
			/**
			 * Product Description
			 * woocommerce product review
			 *
			 * @hooked woocommerce_output_related_products - 20
			 */

			$publico = get_post_meta( get_the_ID(), 'publico', true );
			$composicao = get_post_meta( get_the_ID(), 'composicao', true );
			$outras_informacoes = get_post_meta( get_the_ID(), 'outras_informacoes', true );
			$composicao_array = explode(",", $composicao);
			$outras_informacoes_array = explode(",", $outras_informacoes);

		?>


		<meta itemprop="url" content="<?php the_permalink(); ?>" />
	</div><!-- .summary -->

	<div class="col-sm-12 col-md-12 st-product-detail">
		<!-- product description -->

	<div class="especificacoes espec col-sm-12 col-md-9">

		<div class="productDescription detail-description">
			<h2>Conheça o porduto</h2>
			<?php the_excerpt(); ?>
		</div>
		<div class="productDescription detail-description">
			<h2>Modo de usar</h2>
			<?php the_content(); ?>
		</div>

		<div class="productDescription detail-description">
			<h2>Composição</h2>
			<?php if( ! empty( $composicao ) ){ ?>
			<div class="composicao">
					<ul>
						<?php foreach ($composicao_array as $value) {	?>
						 <li>
						<?php echo $value; ?>
						</li>
						<?php } ?>
					</ul>
			</div>
			<?php } ?>
		</div>

		<?php if( ! empty( $publico ) || ! empty( $outras_informacoes ) ): ?>
		<div class="especificacao espec">
			<h2>Especificação do produto</h2>
			<div id="caracteristicas">
				<table cellspacing="0" class="group Caracteristicas">
					<tbody>
						<?php if( ! empty( $publico ) ){ ?>
						<tr>
							<th class="name-field publico">Público</th>
							<td class="value-field publico"><?php echo $publico; ?></td>
						</tr>
						<?php } ?>
						<?php if( ! empty( $outras_informacoes ) ){ ?>
						<tr>
							<th class="name-field informacoes-importantes">Informações importantes</th>
							<td class="value-field informacoes-importantes">
								<ul>
									<?php foreach ( $outras_informacoes_array as $value) {	?>
									 <li>
									<?php echo $value; ?>
									</li>
									<?php } ?>
								</ul>
							</td>
						</tr>
						<?php } ?>


					</tbody>
				</table>

			</div>
		</div>
	<?php endif; ?>

		<!-- product review TODO-->

		<!-- <div class="cometarios coments">
			<h2>Veja os comentários</h2>
		</div> -->
		<?php //comments_template( 'woocommerce/single-product-reviews' ); ?>

	</div>

	</div>

</div><!-- #product-<?php the_ID(); ?> -->

<div class="st-woocommerce-related-product">
	<?php
		/**
		* @return upsells products
		* @since @version 1.5.5
		*/

	//TODO habilitar cenda cruzada
		//woocommerce_upsell_display();

		// display related products
		if ( ! function_exists( 'woocommerce_output_related_products' ) ) {
				require_once '/includes/wc-template-functions.php';
		}

		$result = woocommerce_output_related_products();
	?>
</div>
<?php do_action( 'woocommerce_after_single_product' ); ?>
