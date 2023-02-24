<?php

function apvc_advanced_metaboxes() {

	$pts = get_post_types();

	foreach ( $pts as $pt ) {
		add_meta_box(
			'advanced-page-visit-counter-boxes',
			__( 'Advanced Page Visit Counter Settings', 'advanced-page-visit-counter' ),
			'apvc_advanced_metaboxes_callback',
			$pt,
			"side",
			"high",
			''
		);
	}
}

function get_alltimes_data_ind( $article_id ) {
	global $wpdb;
    
    if( empty( $article_id ) ){
        return 0;
    }

	$tbl_history = $wpdb->prefix . "avc_page_visit_history";

	$today = current_time( 'mysql' );

	$allPages = $wpdb->get_results( "SELECT COUNT(*) AS count FROM {$tbl_history} WHERE article_id=$article_id" );

	return $allPages[0]->count;
}

function get_todays_data_ind( $article_id ) {
	global $wpdb;

    if( empty( $article_id ) ){
        return 0;
    }

	$tbl_history = $wpdb->prefix . "avc_page_visit_history";

	$today = current_time( 'mysql' );

	$allPages = $wpdb->get_results( "SELECT COUNT(*) as count FROM {$tbl_history} WHERE DATE(date) = CURDATE() AND article_id=$article_id" );

	return $allPages[0]->count;
}

function get_weekly_data_ind( $article_id ) {
	global $wpdb;

    if( empty( $article_id ) ){
        return 0;
    }

	$tbl_history = $wpdb->prefix . "avc_page_visit_history";

	$previous_week0 = strtotime( "0 week +1 day" );
	$start_week0    = strtotime( "last sunday midnight", $previous_week0 );
	$end_week0      = strtotime( "next saturday", $start_week0 );

	$start_week0 = date( "Y-m-d H:m:s", $start_week0 );
	$end_week0   = date( "Y-m-d H:m:s", $end_week0 );

	$allPages = $wpdb->get_results( "SELECT COUNT(*) as count FROM {$tbl_history} WHERE `date`>='$start_week0' AND `date`<='$end_week0' AND article_id=$article_id" );

	$Week0         = [];
	$Week0['week'] = date( "M-d", strtotime( $start_week0 ) ) . ' - ' . date( "M-d", strtotime( $end_week0 ) );

	return $allPages[0]->count;
}

function get_monthly_data_ind( $article_id ) {
	global $wpdb;

    if( empty( $article_id ) ){
        return 0;
    }

	$tbl_history = $wpdb->prefix . "avc_page_visit_history";

	$previous_Month0 = strtotime( "-0 months +1 day" );
	$start_Month0    = strtotime( "first day of this month", $previous_Month0 );
	$end_Month0      = strtotime( "last day of this month", $start_Month0 );

	$start_Month0 = date( "Y-m-d", $start_Month0 );
	$end_Month0   = date( "Y-m-d", $end_Month0 );

	$allPages = $wpdb->get_results( "SELECT COUNT(*) as count FROM {$tbl_history} WHERE `date`>='$start_Month0' AND `date`<='$end_Month0' AND article_id=$article_id" );

	return $allPages[0]->count;
}

function apvc_advanced_metaboxes_callback() {

    $post_id = ( isset( $_GET['post'] ) ) ? sanitize_text_field($_GET['post']) : 0;
	$active       = get_post_meta( $post_id, "apvc_active_counter", TRUE );
	$base_count   = get_post_meta( $post_id, "count_start_from", TRUE );
	$widget_label = get_post_meta( $post_id, "widget_label", TRUE );
	?>
    <style type="text/css">
        .apvc_meta_box_fields, .apvc_meta_box_fields p {
            font-size: 14px;
        }

        table.apvc_stats {
            width: 100%;
            text-align: center;
            margin-top: 10px;
            background: gray;
            color: #fff;
            padding: 10px;
        }
    </style>
    <div class="apvc_meta_box_fields">
        <div class="apvc_start_cnt">
            <p><?php echo __( "Active Page Visit Counter for this Article?" ); ?></p>
            <input type="radio" value="Yes" <?php if ( $active == "Yes" ) {
				echo "checked";
			} ?> name="apvc_active_counter"><?php echo __( "Yes" ); ?>
            <input type="radio" value="No" <?php if ( $active == "No" ) {
				echo "checked";
			} ?> name="apvc_active_counter"><?php echo __( "No" ); ?>
        </div>
        <div class="apvc_reset_cnt">
            <p><?php echo __( "Are you want to reset count for this article?" ); ?></p>
            <input type="radio" value="Yes"
                   name="apvc_reset_cnt"><?php echo __( "Yes" ); ?>
            <input type="radio" value="No"
                   name="apvc_reset_cnt"><?php echo __( "No" ); ?>
        </div>
        <div class="apvc_base_count">
            <p><?php echo __( "Start Counting from. Enter any number from where you want to start counting." ); ?></p>
            <input style="width: 100%" type="number" name="count_start_from"
                   value="<?php echo $base_count; ?>"
                   placeholder="Enter Base Count to start">
        </div>
        <div class="apvc_label">
            <p><?php echo __( "Widget Label" ); ?></p>
            <input style="width: 100%" type="text" name="widget_label"
                   value="<?php echo $widget_label; ?>"
                   placeholder="Enter Label for Widget">
        </div>
        <div class="apvc_total_visits">
            <table class="apvc_stats">
                <thead>
                <tr>
                    <th colspan="2"><?php echo __( "Total Visits" ); ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <p><?php echo __( "Today" ); ?>
                            <br/><strong><?php echo get_todays_data_ind( $post_id ); ?></strong>
                        </p>
                    </td>
                    <td>
                        <p><?php echo __( "This Week" ); ?>
                            <br/><strong><?php echo get_weekly_data_ind( $post_id ); ?></strong>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><?php echo __( "This Month" ); ?>
                            <br/><strong><?php echo get_monthly_data_ind( $post_id ); ?></strong>
                        </p>
                    </td>
                    <td>
                        <p><?php echo __( "All Time" ); ?>
                            <br/><strong><?php echo get_alltimes_data_ind( $post_id ); ?></strong>
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
	<?php
}

add_action( 'add_meta_boxes', 'apvc_advanced_metaboxes' );

?>