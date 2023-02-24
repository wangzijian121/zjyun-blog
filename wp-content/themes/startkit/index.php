<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package startkit
 香港 新界 CN.HK.BGP
 */

get_header(); ?>
<div style="text-align:center;font-family: Microsoft YaHei;padding-top: 20px;">
	文章数：<?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?>,
	网站运行天数：<?php echo floor((time()-strtotime("2022-6-22"))/86400); ?>天,
	最近更新：<?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y-n-j', strtotime($last[0]->MAX_m));echo $last; ?>,
	当前线路：香港 新界 CN.HK.BGP
	</div>
	
<section  id="blog-content" class="section-padding">
	<div class="container">
		<div class="row">
			
			<!--Blog Detail-->
			<div class="<?php esc_attr(startkit_post_layout()); ?>" >
					<?php 
					$startkit_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					$args = array( 'post_type' => 'post','paged'=>$startkit_paged );	
					$loop = new WP_Query( $args );
					?>
					<?php if( $loop->have_posts() ): ?>
					
						<?php while( $loop->have_posts() ): $loop->the_post(); ?>
							 <?php get_template_part('template-parts/content','page-grid'); ?>
						<?php endwhile; ?>
				<?php endif; ?>
				 <div class="paginations">
					<?php									
					// Previous/next page navigation.
					the_posts_pagination( array(
					'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
					'next_text'          => '<i class="fa fa-angle-double-right"></i>',
					) ); ?>
				 </div>
			</div>
			<?php get_sidebar(); ?>
			<!--/End of Blog Detail-->
		</div>	
	</div>
</section>
<?php get_footer(); ?>
