<?php  
	$service_hs 			= get_theme_mod('service_hs','1');
	$service_title 			= get_theme_mod('service_title','Our <span class="primary-color">Expertise</span>');
	$service_description	= get_theme_mod('service_description','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'); 
	$service_contents		= get_theme_mod('service_contents',gradiant_get_service_default());
	if($service_hs=='1'){
?>	
<section id="features-section" class="features-section av-py-default shapes-section service-home">
	<div class="av-container">
		<?php if(!empty($service_title)  || !empty($service_description)): ?>
			<div class="av-columns-area">
				<div class="av-column-12">
					<div class="heading-default text-center wow fadeInUp">
						<?php if(!empty($service_title)): ?>
							<h3><?php echo wp_kses_post($service_title); ?></h3>
							<span class="separator"><span><span></span></span></span>
						<?php endif; ?>
						<?php if(!empty($service_description)): ?>
							<p><?php echo wp_kses_post($service_description); ?></p>
						<?php endif; ?>	
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="av-columns-area wow fadeInUp service-contents">
			<?php
				if ( ! empty( $service_contents ) ) {
				$service_contents = json_decode( $service_contents );
				foreach ( $service_contents as $service_item ) {
					$title = ! empty( $service_item->title ) ? apply_filters( 'gradiant_translate_single_string', $service_item->title, 'Service section' ) : '';
					$text = ! empty( $service_item->text ) ? apply_filters( 'gradiant_translate_single_string', $service_item->text, 'Service section' ) : '';
					$button = ! empty( $service_item->text2 ) ? apply_filters( 'gradiant_translate_single_string', $service_item->text2, 'Service section' ) : '';
					$link = ! empty( $service_item->link ) ? apply_filters( 'gradiant_translate_single_string', $service_item->link, 'Service section' ) : '';
					$image = ! empty( $service_item->image_url ) ? apply_filters( 'gradiant_translate_single_string', $service_item->image_url, 'Service section' ) : '';
					$icon = ! empty( $service_item->icon_value ) ? apply_filters( 'gradiant_translate_single_string', $service_item->icon_value, 'Service section' ) : '';
			?>
			<div class="av-column-4 av-sm-column-6 tilter">
				<div class="tilter__figure">
					<div class="features-item">
						<div class="features-inner tilter__caption">
							<?php if(!empty($icon)): ?>
								<div class="features-icon">
									<i class="fa <?php echo esc_attr($icon); ?>"></i>
								</div>
							<?php else: ?>	
								<div class="features-icon">
									<img src="<?php echo esc_url($image); ?>" />
								</div>
							<?php endif; ?>

							<?php if(!empty($title)  || !empty($text)): ?>
								<div class="features-content">
									<h6 class="features-title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h6>
									<p><?php echo esc_html($text); ?></p>
								</div>
							<?php endif; ?>

							<?php if(!empty($icon)): ?>
								<div class="modern-icon"><i class="fa <?php echo esc_attr($icon); ?>"></i></div>
							<?php endif; ?>
						</div>
						<div class="tilter__deco--lines"></div>
					</div>
				</div>
			</div>
		<?php } } ?>
		</div>
	</div>
	<div class="shape1 bg-elements"><img src="<?php echo esc_url(CLEVERFOX_PLUGIN_URL); ?>inc/gradiant/images/service/clipArt/shape1.png" alt="image"></div>
	<div class="shape2 bg-elements"><img src="<?php echo esc_url(CLEVERFOX_PLUGIN_URL); ?>inc/gradiant/images/service/clipArt/shape2.png" alt="image"></div>
	<div class="shape3 bg-elements"><img src="<?php echo esc_url(CLEVERFOX_PLUGIN_URL); ?>inc/gradiant/images/service/clipArt/shape3.png" alt="image"></div>
	<div class="shape4 bg-elements"><img src="<?php echo esc_url(CLEVERFOX_PLUGIN_URL); ?>inc/gradiant/images/service/clipArt/shape4.png" alt="image"></div>
</section>
<?php } ?>