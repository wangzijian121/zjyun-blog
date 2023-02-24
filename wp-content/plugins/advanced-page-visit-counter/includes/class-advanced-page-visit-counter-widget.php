<?php

class Advanced_Page_Visit_Counter_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct( 'apvc_widget', __( 'Advanced Page Visit Counter Statistics', 'advanced-page-visit-counter' ) );
        add_action( 'widgets_init', function () {
            register_widget( 'Advanced_Page_Visit_Counter_Widget' );
        } );
    }
    
    public  $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div></div>',
    ) ;
    public function widget( $args, $instance )
    {
        echo  $args['before_widget'] ;
        if ( !empty($instance['title']) ) {
            echo  $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'] ;
        }
        echo  '<div class="textwidget">' ;
        global  $wpdb ;
        $apvc_table = APVC_DATA_TABLE;
        $currentDateFull = date( 'Y-m-d H:i:s', strtotime( '-10 minute' ) );
        $YesterDay = date( 'Y-m-d H:i:s', strtotime( '-1 day' ) );
        $visits_today = $wpdb->get_var( "SELECT COUNT(*) FROM {$apvc_table} WHERE date >= '{$YesterDay}'" );
        $total_visits = $wpdb->get_var( "SELECT COUNT(*) FROM {$apvc_table}" );
        $total_visitors = $wpdb->get_var( "SELECT COUNT(*) FROM {$apvc_table} GROUP BY ip_address" );
        $total_countries = $wpdb->get_var( "SELECT COUNT(*) FROM {$apvc_table} GROUP BY country" );
        ?>
		<ul class="apvc-widget-statistics">
			<li>
			<?php 
        _e( '今日访问量: ', 'advanced-page-visit-counter' );
        echo  esc_html( $visits_today ) ;
        ?>
			</li>
			<li>
			<?php 
        _e( '总访问量: ', 'advanced-page-visit-counter' );
        echo  esc_html( $total_visits ) ;
        ?>
			</li>
<!-- 			<li>
			<?php 
        _e( 'Total Visitors: ', 'advanced-page-visit-counter' );
        echo  esc_html( $total_visitors ) ;
        ?>
			</li>
			<li>
			<?php 
        _e( 'Total Countries: ', 'advanced-page-visit-counter' );
        echo  esc_html( $total_countries ) ;
        ?>
			</li> -->
		<?php 
        ?>
		</ul>

		<?php 
        echo  '</div>' ;
        echo  $args['after_widget'] ;
    }
    
    public function form( $instance )
    {
        $title = ( !empty($instance['title']) ? $instance['title'] : esc_html__( '', 'advanced-page-visit-counter' ) );
        ?>
		<p>
			<label for="<?php 
        echo  esc_attr( $this->get_field_id( 'title' ) ) ;
        ?>"><?php 
        echo  esc_html__( 'Title:', 'advanced-page-visit-counter' ) ;
        ?></label>
			<input class="widefat"
				   id="<?php 
        echo  esc_attr( $this->get_field_id( 'title' ) ) ;
        ?>"
				   name="<?php 
        echo  esc_attr( $this->get_field_name( 'title' ) ) ;
        ?>"
				   type="text" value="<?php 
        echo  esc_attr( $title ) ;
        ?>">
		</p>
		<?php 
    }
    
    public function update( $new_instance, $old_instance )
    {
        $instance = array();
        $instance['title'] = ( !empty($new_instance['title']) ? strip_tags( $new_instance['title'] ) : '' );
        return $instance;
    }

}
$apvc_widget = new Advanced_Page_Visit_Counter_Widget();