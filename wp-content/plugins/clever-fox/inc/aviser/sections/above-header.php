<?php
	if ( ! function_exists( 'avril_above_header' ) ) :
	function avril_above_header() {
	?>
	<?php 
	$hide_show_social_icon 		= get_theme_mod( 'hide_show_social_icon','1'); 
	$social_icons 				= get_theme_mod( 'social_icons',avril_get_social_icon_default());
	$hs_hdr_time 				= get_theme_mod( 'hs_hdr_time','1');
	$hdr_time_icon 				= get_theme_mod( 'hdr_time_icon','fa-clock-o');
	$hdr_time_title 			= get_theme_mod( 'hdr_time_title','Opening Hours - 10 Am to 6 PM');
	$hs_hdr_welcome 			= get_theme_mod( 'hs_hdr_welcome','1');
	$hdr_welcome_icon 			= get_theme_mod( 'hdr_welcome_icon','fa-building-o');
	$hdr_welcome_ttl 			= get_theme_mod( 'hdr_welcome_ttl','Welcome to our Business Agency');
?>
        <!--===// Start: Header Above
        =================================-->
			<div id="above-header" class="header-above-info d-av-block d-none wow fadeInDown">
				<div class="header-widget">
					<div class="av-container">
						<div class="av-columns-area">
								<div class="av-column-5">
									<div class="widget-left text-av-left text-center">
										<?php if($hide_show_social_icon == '1') { ?>
											<aside class="widget widget_social_widget">
												<ul>
													<?php
														$social_icons = json_decode($social_icons);
														if( $social_icons!='' )
														{
														foreach($social_icons as $social_item){	
														$social_icon = ! empty( $social_item->icon_value ) ? apply_filters( 'avril_translate_single_string', $social_item->icon_value, 'Header section' ) : '';	
														$social_link = ! empty( $social_item->link ) ? apply_filters( 'avril_translate_single_string', $social_item->link, 'Header section' ) : '';
													?>
														<li><a href="<?php echo esc_url( $social_link ); ?>"><i class="fa <?php echo esc_attr( $social_icon ); ?>"></i></a></li>
													<?php }} ?>
												</ul>
											</aside>
										<?php } ?>
									</div>
								</div>
								<div class="av-column-7">
									<div class="widget-right text-av-right text-center"> 
										<?php if($hs_hdr_welcome == '1') { ?>
											<aside class="widget widget-contact wgt-6">
												<div class="contact-area">
													<div class="contact-icon">
													   <i class="fa <?php echo  esc_attr($hdr_welcome_icon); ?>"></i>
													</div>
													<a href="javascript:void(0)" class="contact-info">
														<span class="text"><?php echo esc_html($hdr_welcome_ttl); ?></span>
													</a>
												</div>
											</aside>
										<?php } ?>
										<?php if($hs_hdr_time == '1') { ?>
											<aside class="widget widget-contact wgt-5">
												<div class="contact-area">
													<div class="contact-icon">
													   <i class="fa <?php echo  esc_attr($hdr_time_icon); ?>"></i>
													</div>
													<a href="javascript:void(0)" class="contact-info">
														<span class="text"><?php echo esc_html($hdr_time_title); ?></span>
													</a>
												</div>
											</aside>
										<?php } ?>
									</div>	
								</div>
						</div>
					</div>
				</div>
			</div>	
        <!--===// End: Header Top
        =================================-->   
	<?php 
} endif;
add_action('avril_above_header', 'avril_above_header');
?>
