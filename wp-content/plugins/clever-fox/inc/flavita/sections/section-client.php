<?php  
	$client_hs 				= get_theme_mod('client_hs','1');
	$client_title 			= get_theme_mod('client_title','We are <span class="primary-color">Working With</span>');
	$client_description		= get_theme_mod('client_description','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'); 
	$client_contents		= get_theme_mod('client_contents',gradiant_get_client_default());
	if($client_hs=='1'):
?>
<section id="client-section" class="client-section av-py-default client-home" data-roller="start:0.5">
	<div class="av-container">
		<?php if(!empty($client_title)  || !empty($client_description)): ?>
			<div class="av-columns-area">
				<div class="av-column-12">
					<div class="heading-default heading-white text-center wow fadeInUp">
						<?php if(!empty($client_title)): ?>
							<h3><?php echo wp_kses_post($client_title); ?></h3>
							<span class="separator"><span><span></span></span></span>
						<?php endif; ?>
						<?php if(!empty($client_description)): ?>
							<p><?php echo wp_kses_post($client_description); ?></p>
						<?php endif; ?>	
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="av-columns-area">
			<div class="av-column-12">
				<div class="partner-carousel owl-carousel owl-theme">
					<?php
						if ( ! empty( $client_contents ) ) {
						$client_contents = json_decode( $client_contents );
						foreach ( $client_contents as $client_item ) {
							$title = ! empty( $client_item->title ) ? apply_filters( 'gradiant_translate_single_string', $client_item->title, 'Client section' ) : '';
							$subtitle = ! empty( $client_item->subtitle ) ? apply_filters( 'gradiant_translate_single_string', $client_item->subtitle, 'Client section' ) : '';
							$link = ! empty( $client_item->link ) ? apply_filters( 'gradiant_translate_single_string', $client_item->link, 'Client section' ) : '';
							$image = ! empty( $client_item->image_url ) ? apply_filters( 'gradiant_translate_single_string', $client_item->image_url, 'Client section' ) : '';
					?>
						<div class="single-partner">
							<div class="inner-partner">
								<a href="<?php echo esc_url($link); ?>">
									<?php if(!empty($image)): ?>
										<img src="<?php echo esc_url($image); ?>">
									<?php endif; ?>
									<?php if(!empty($title) || !empty($subtitle)): ?>
										<span class="client-name"><?php echo esc_html($title); ?> <strong><?php echo esc_html($subtitle); ?></strong></span>
									<?php endif; ?>
								</a>
							</div>
						</div>
					<?php } } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>