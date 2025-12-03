<?php
/**
 * Sticky purchase box template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'product' => null,
	'price' => '',
	'sale_price' => '',
	'regular_price' => '',
	'wc_product_id' => 0,
	'is_purchased' => false,
) );

$discount = 0;
if ( $args['product'] && $args['sale_price'] && $args['regular_price'] ) {
	$discount = round( ( ( $args['regular_price'] - $args['sale_price'] ) / $args['regular_price'] ) * 100 );
}
?>

<div class="purchase-box-wrapper">
	<!-- Desktop Sticky Box -->
	<div class="hidden lg:block sticky top-8">
		<div class="card bg-white shadow-xl">
			<?php if ( $args['is_purchased'] ) : ?>
				<div class="text-center p-6">
					<div class="text-4xl mb-4">✅</div>
					<h3 class="text-xl font-bold text-gray-900 mb-2">
						شما این دوره را خریداری کرده‌اید
					</h3>
					<a href="#curriculum" class="btn btn-primary w-full mt-4">
						شروع یادگیری
					</a>
				</div>
			<?php else : ?>
				<?php if ( $discount > 0 ) : ?>
					<div class="bg-red-500 text-white text-center py-2 px-4 -mx-6 -mt-6 rounded-t-lg">
						<span class="font-bold">تخفیف <?php echo esc_html( $discount ); ?>٪</span>
					</div>
				<?php endif; ?>
				
				<div class="p-6">
					<div class="text-center mb-6">
						<?php if ( $args['sale_price'] && $args['regular_price'] ) : ?>
							<div class="flex items-center justify-center gap-3 mb-2">
								<span class="text-3xl font-bold text-codina-600">
									<?php echo esc_html( number_format( $args['sale_price'] ) ); ?> تومان
								</span>
								<span class="text-lg text-gray-400 line-through">
									<?php echo esc_html( number_format( $args['regular_price'] ) ); ?>
								</span>
							</div>
						<?php elseif ( $args['price'] ) : ?>
							<div class="text-3xl font-bold text-codina-600 mb-2">
								<?php echo wp_kses_post( $args['price'] ); ?>
							</div>
						<?php endif; ?>
					</div>
					
					<?php if ( $args['wc_product_id'] && function_exists( 'woocommerce_template_single_add_to_cart' ) ) : ?>
						<?php
						// Get WooCommerce product
						$product = wc_get_product( $args['wc_product_id'] );
						if ( $product ) :
							?>
							<form class="cart" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $args['wc_product_id'] ); ?>">
								<button type="submit" class="btn btn-primary w-full text-lg py-4 mb-4">
									خرید دوره
								</button>
							</form>
							
							<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="block text-center text-codina-600 hover:text-codina-700 font-medium">
								مشاهده سبد خرید
							</a>
						<?php endif; ?>
					<?php else : ?>
						<button disabled class="btn btn-secondary w-full text-lg py-4 mb-4 opacity-50 cursor-not-allowed">
							در دسترس نیست
						</button>
					<?php endif; ?>
					
					<div class="mt-6 pt-6 border-t border-gray-200 space-y-3 text-sm text-gray-600">
						<div class="flex items-center gap-2">
							<span>✅</span>
							<span>دسترسی مادام‌العمر</span>
						</div>
						<div class="flex items-center gap-2">
							<span>✅</span>
							<span>گواهی پایان دوره</span>
						</div>
						<div class="flex items-center gap-2">
							<span>✅</span>
							<span>پشتیبانی مربیان</span>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	
	<!-- Mobile Fixed Bottom CTA -->
	<?php if ( ! $args['is_purchased'] ) : ?>
		<div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-50 p-4">
			<div class="container">
				<div class="flex items-center justify-between gap-4">
					<div>
						<?php if ( $args['sale_price'] && $args['regular_price'] ) : ?>
							<div class="flex items-center gap-2">
								<span class="text-xl font-bold text-codina-600">
									<?php echo esc_html( number_format( $args['sale_price'] ) ); ?> تومان
								</span>
								<span class="text-sm text-gray-400 line-through">
									<?php echo esc_html( number_format( $args['regular_price'] ) ); ?>
								</span>
							</div>
						<?php elseif ( $args['price'] ) : ?>
							<div class="text-xl font-bold text-codina-600">
								<?php echo wp_kses_post( $args['price'] ); ?>
							</div>
						<?php endif; ?>
					</div>
					<?php if ( $args['wc_product_id'] && function_exists( 'woocommerce_template_single_add_to_cart' ) ) : ?>
						<?php
						$product = wc_get_product( $args['wc_product_id'] );
						if ( $product ) :
							?>
							<form class="cart" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $args['wc_product_id'] ); ?>">
								<button type="submit" class="btn btn-primary whitespace-nowrap">
									خرید دوره
								</button>
							</form>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>

