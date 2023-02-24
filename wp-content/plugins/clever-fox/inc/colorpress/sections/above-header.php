<?php
	if ( ! function_exists( 'gradiant_above_header' ) ) :
	function gradiant_above_header() {
		$hs_hdr_icon_menu 			= get_theme_mod( 'hs_hdr_icon_menu','1');
		$hdr_top_icon_menu 			= get_theme_mod( 'hdr_top_icon_menu',gradiant_get_icon_menu_default());
		$hide_show_cntct_details 	= get_theme_mod( 'hide_show_cntct_details','1'); 
		$hide_show_email_details 	= get_theme_mod( 'hide_show_email_details','1');
		$hide_show_mbl_details 		= get_theme_mod( 'hide_show_mbl_details','1');
		if($hs_hdr_icon_menu =='1' || $hide_show_cntct_details =='1' || $hide_show_email_details =='1' || $hide_show_mbl_details =='1'):
		?>
			<div id="above-header" class="header-above-info d-av-block d-none">
				<div class="header-widget">
					<div class="av-container">
						<div class="av-columns-area">
							<div class="av-column-6">
								<div class="widget-left text-av-left text-center">
									<?php if($hs_hdr_icon_menu =='1'): ?>
										<aside class="widget widget_nav_menu">
											<div class="menu-pages-container">
												<ul id="menu-footer-menu" class="menu">
													<?php
														if ( ! empty( $hdr_top_icon_menu ) ) {
														$hdr_top_icon_menu = json_decode( $hdr_top_icon_menu );
														foreach ( $hdr_top_icon_menu as $icon_menu_item ) {
															$title = ! empty( $icon_menu_item->title ) ? apply_filters( 'gradiant_translate_single_string', $icon_menu_item->title, 'Header section' ) : '';
															$icon = ! empty( $icon_menu_item->icon_value ) ? apply_filters( 'gradiant_translate_single_string', $icon_menu_item->icon_value, 'Header section' ) : '';
															$link = ! empty( $icon_menu_item->link ) ? apply_filters( 'gradiant_translate_single_string', $icon_menu_item->link, 'Header section' ) : '';
													?>
														<li class="menu-item"><a href="<?php echo esc_url($link); ?>" class="nav-link"><i class="fa <?php echo esc_attr($icon); ?>"></i> <?php echo esc_html($title); ?></a></li>
												 <?php } } ?>
												</ul>   
											</div>
										</aside>
									<?php endif; ?>	
								</div>
							</div>
							<div class="av-column-6">
								<div class="widget-right text-av-right text-center">                                
									<?php do_action('gradiant_abv_hdr_contact_info'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; 
} endif;
add_action('gradiant_above_header', 'gradiant_above_header');
?>
