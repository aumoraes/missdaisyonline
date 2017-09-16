<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package styledstore - lojamissdaisy child
 */

?>
<footer id="footer">
	<!-- get sidebar footer top for  -->
	<?php get_sidebar( 'footer-top');?>
	<!-- add payment links  -->
	<div class="footer-bottom">
		<?php do_action( 'styledstore_add_payment_links' ); ?>
	</div>
		<div class="footer-bottombar">
			<div class="container">

				<?php
				if  ( get_theme_mod( 'styledstore_show_footer_text' ) != '1' ) {?>
					<div class="copyright footer-itens">
						<?php
						$footer_itens = "Miss Daisy Cosméticos | ".
														"Progressivas | ".
														"Máscaras | ".
														"Linha de tratamento completa para manter a cor dos cabelos | ".
														"Compre produtos de Tratamento para Cabelos Rebeldes na Miss Daisy | ".
														"Aqui é o melhor lugar para comprar produtos Miss Daisy.";
						 esc_html_e( $footer_itens, 'footer-itens' ); ?>
						 <br />
						 <p class="miss-daisy-copyright">
							 <?php esc_html_e( '© 2017 | Loja Miss Daisy Professional', 'miss-daisy' ); ?>
						 </p>

					</div>
				<?php } ?>

				<div class="footer-menu">

					<?php $styledstore_primary_nav = array(
						'theme_location'	=> 'footer',
						'container'	=> false,
						'menu_class'	=> 'sm',
						'menu_id'	=> 'footer-menu',
						'depth'	=> 1,
						'fallback_cb' => false
					);
					wp_nav_menu( $styledstore_primary_nav ); ?>

				</div>
			</div>
		</div>
</footer>

<script language="JavaScript" type="text/javascript">
TrustLogo("https://missdaisyonline.com.br/wp-content/uploads/2017/06/comodo_secure_seal_76x26_transp.png", "CL1", "none");
</script>
<a  href="https://www.positivessl.com/" id="comodoTL">Positive SSL</a>

<?php wp_footer(); ?>
</body>
</html>