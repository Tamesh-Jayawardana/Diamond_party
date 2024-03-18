<?php
/**
 * Yacht rental Framework: Testimonial support
 *
 * @package	yacht_rental
 * @since	yacht_rental 1.0
 */

// Theme init
if (!function_exists('yacht_rental_testimonial_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_testimonial_theme_setup', 1 );
	function yacht_rental_testimonial_theme_setup() {
	
		// Add item in the admin menu
		add_filter('trx_utils_filter_override_options',		'yacht_rental_testimonial_add_override_options');

		// Save data from meta box
		add_action('save_post',				'yacht_rental_testimonial_save_data');

		// Meta box fields
		yacht_rental_storage_set('testimonial_override_options', array(
			'id' => 'testimonial-meta-box',
			'title' => esc_html__('Testimonial Details', 'yacht-rental'),
			'page' => 'testimonial',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				"testimonial_author" => array(
					"title" => esc_html__('Testimonial author',  'yacht-rental'),
					"desc" => wp_kses_data( __("Name of the testimonial's author", 'yacht-rental') ),
					"class" => "testimonial_author",
					"std" => "",
					"type" => "text"),
				"testimonial_position" => array(
					"title" => esc_html__("Author's position",  'yacht-rental'),
					"desc" => wp_kses_data( __("Position of the testimonial's author", 'yacht-rental') ),
					"class" => "testimonial_author",
					"std" => "",
					"type" => "text"),
				"testimonial_email" => array(
					"title" => esc_html__("Author's e-mail",  'yacht-rental'),
					"desc" => wp_kses_data( __("E-mail of the testimonial's author - need to take Gravatar (if registered)", 'yacht-rental') ),
					"class" => "testimonial_email",
					"std" => "",
					"type" => "text"),
				"testimonial_link" => array(
					"title" => esc_html__('Testimonial link',  'yacht-rental'),
					"desc" => wp_kses_data( __("URL of the testimonial source or author profile page", 'yacht-rental') ),
					"class" => "testimonial_link",
					"std" => "",
					"type" => "text")
				)
			)
		);
		
		// Add supported data types
		yacht_rental_theme_support_pt('testimonial');
		yacht_rental_theme_support_tx('testimonial_group');
		
	}
}


// Add meta box
if (!function_exists('yacht_rental_testimonial_add_override_options')) {
	function yacht_rental_testimonial_add_override_options($boxes = array()) {
        $boxes[] = array_merge(yacht_rental_storage_get('testimonial_override_options'), array('callback' => 'yacht_rental_testimonial_show_override_options'));
        return $boxes;
	}
}

// Callback function to show fields in meta box
if (!function_exists('yacht_rental_testimonial_show_override_options')) {
	function yacht_rental_testimonial_show_override_options() {
		global $post;

		// Use nonce for verification
		echo '<input type="hidden" name="override_options_testimonial_nonce" value="'.esc_attr(wp_create_nonce(admin_url())).'" />';
		
		$data = get_post_meta($post->ID, yacht_rental_storage_get('options_prefix').'_testimonial_data', true);
	
		$fields = yacht_rental_storage_get_array('testimonial_override_options', 'fields');
		?>
		<table class="testimonial_area">
		<?php
		if (is_array($fields) && count($fields) > 0) {
			foreach ($fields as $id=>$field) { 
				$meta = isset($data[$id]) ? $data[$id] : '';
				?>
				<tr class="testimonial_field <?php echo esc_attr($field['class']); ?>" valign="top">
					<td><label for="<?php echo esc_attr($id); ?>"><?php echo esc_attr($field['title']); ?></label></td>
					<td><input type="text" name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($meta); ?>" size="30" />
						<br><small><?php echo esc_attr($field['desc']); ?></small></td>
				</tr>
				<?php
			}
		}
		?>
		</table>
		<?php
	}
}


// Save data from meta box
if (!function_exists('yacht_rental_testimonial_save_data')) {
	function yacht_rental_testimonial_save_data($post_id) {
		// verify nonce
		if ( !wp_verify_nonce( yacht_rental_get_value_gp('override_options_testimonial_nonce'), admin_url() ) )
			return $post_id;

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// check permissions
		if ($_POST['post_type']!='testimonial' || !current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		$data = array();

		$fields = yacht_rental_storage_get_array('testimonial_override_options', 'fields');

		// Post type specific data handling
		if (is_array($fields) && count($fields) > 0) {
			foreach ($fields as $id=>$field) { 
				if (isset($_POST[$id])) 
					$data[$id] = stripslashes($_POST[$id]);
			}
		}

		update_post_meta($post_id, yacht_rental_storage_get('options_prefix').'_testimonial_data', $data);
	}
}

?>