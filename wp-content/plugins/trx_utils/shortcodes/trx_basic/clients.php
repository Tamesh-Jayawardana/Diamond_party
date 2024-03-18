<?php

// Registar shortcodes [trx_clients] and [trx_clients_item] in the shortcodes list
if (function_exists('yacht_rental_exists_visual_composer') && yacht_rental_exists_visual_composer())
    add_action('yacht_rental_action_shortcodes_list',		'yacht_rental_clients_reg_shortcodes');
    add_action('yacht_rental_action_shortcodes_list_vc','yacht_rental_clients_reg_shortcodes_vc');






// ---------------------------------- [trx_clients] ---------------------------------------

/*
[trx_clients id="unique_id" columns="3" style="clients-1|clients-2|..."]
	[trx_clients_item name="client name" position="director" image="url"]Description text[/trx_clients_item]
	...
[/trx_clients]
*/
if ( !function_exists( 'yacht_rental_sc_clients' ) ) {
    function yacht_rental_sc_clients($atts, $content=null){
        if (yacht_rental_in_shortcode_blogger()) return '';
        extract(yacht_rental_html_decode(shortcode_atts(array(
            // Individual params
            "style" => "clients-1",
            "columns" => 4,
            "slider" => "no",
            "slides_space" => 0,
            "controls" => "no",
            "interval" => "",
            "autoheight" => "no",
            "custom" => "no",
            "ids" => "",
            "cat" => "",
            "count" => 4,
            "offset" => "",
            "orderby" => "title",
            "order" => "asc",
            "title" => "",
            "subtitle" => "",
            "description" => "",
            "link_caption" => esc_html__('Learn more', 'trx_utils'),
            "link" => '',
            "scheme" => '',
            // Common params
            "id" => "",
            "class" => "",
            "animation" => "",
            "css" => "",
            "width" => "",
            "height" => "",
            "top" => "",
            "bottom" => "",
            "left" => "",
            "right" => ""
        ), $atts)));

        if (empty($id)) $id = "sc_clients_".str_replace('.', '', mt_rand());
        if (empty($width)) $width = "100%";
        if (!empty($height) && yacht_rental_param_is_on($autoheight)) $autoheight = "no";
        if (empty($interval)) $interval = mt_rand(5000, 10000);

        $class .= ($class ? ' ' : '') . yacht_rental_get_css_position_as_classes($top, $right, $bottom, $left);

        $ws = yacht_rental_get_css_dimensions_from_values($width);
        $hs = yacht_rental_get_css_dimensions_from_values('', $height);
        $css .= ($hs) . ($ws);

        if (yacht_rental_param_is_on($slider)) yacht_rental_enqueue_slider('swiper');

        $columns = max(1, min(12, $columns));
        $count = max(1, (int) $count);
        if (yacht_rental_param_is_off($custom) && $count < $columns) $columns = $count;
        yacht_rental_storage_set('sc_clients_data', array(
                'id'=>$id,
                'style'=>$style,
                'counter'=>0,
                'columns'=>$columns,
                'slider'=>$slider,
                'css_wh'=>$ws . $hs
            )
        );

        $output = '<div' . ($id ? ' id="'.esc_attr($id).'_wrap"' : '')
            . ' class="sc_clients_wrap'
            . ($scheme && !yacht_rental_param_is_off($scheme) && !yacht_rental_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '')
            .'">'
            . '<div' . ($id ? ' id="'.esc_attr($id).'"' : '')
            . ' class="sc_clients sc_clients_style_'.esc_attr($style)
            . ' ' . esc_attr(yacht_rental_get_template_property($style, 'container_classes'))
            . (!empty($class) ? ' '.esc_attr($class) : '')
            .'"'
            . ($css!='' ? ' style="'.esc_attr($css).'"' : '')
            . (!yacht_rental_param_is_off($animation) ? ' data-animation="'.esc_attr(yacht_rental_get_animation_classes($animation)).'"' : '')
            . '>'
            . (!empty($subtitle) ? '<h6 class="sc_clients_subtitle sc_item_subtitle">' . trim(yacht_rental_strmacros($subtitle)) . '</h6>' : '')
            . (!empty($title) ? '<h2 class="sc_clients_title sc_item_title' . (empty($description) ? ' sc_item_title_without_descr' : ' sc_item_title_without_descr') . '">' . trim(yacht_rental_strmacros($title)) . '</h2>' : '')
            . (!empty($description) ? '<div class="sc_clients_descr sc_item_descr">' . trim(yacht_rental_strmacros($description)) . '</div>' : '')
            . (yacht_rental_param_is_on($slider)
                ? ('<div class="sc_slider_swiper swiper-slider-container'
                    . ' ' . esc_attr(yacht_rental_get_slider_controls_classes($controls))
                    . (yacht_rental_param_is_on($autoheight) ? ' sc_slider_height_auto' : '')
                    . ($hs ? ' sc_slider_height_fixed' : '')
                    . '"'
                    . (!empty($width) && yacht_rental_strpos($width, '%')===false ? ' data-old-width="' . esc_attr($width) . '"' : '')
                    . (!empty($height) && yacht_rental_strpos($height, '%')===false ? ' data-old-height="' . esc_attr($height) . '"' : '')
                    . ((int) $interval > 0 ? ' data-interval="'.esc_attr($interval).'"' : '')
                    . ($columns > 1 ? ' data-slides-per-view="' . esc_attr($columns) . '"' : '')
                    . ($slides_space > 0 ? ' data-slides-space="' . esc_attr($slides_space) . '"' : '')
                    . ' data-slides-min-width="' . ($style=='clients-1' ? 100 : 220) . '"'
                    . '>'
                    . '<div class="slides swiper-wrapper">')
                : ($columns > 1
                    ? '<div class="sc_columns columns_wrap">'
                    : '')
            );

        if (yacht_rental_param_is_on($custom) && $content) {
            $output .= do_shortcode($content);
        } else {
            global $post;

            if (!empty($ids)) {
                $posts = explode(',', $ids);
                $count = count($posts);
            }

            $args = array(
                'post_type' => 'clients',
                'post_status' => 'publish',
                'posts_per_page' => $count,
                'ignore_sticky_posts' => true,
                'order' => $order=='asc' ? 'asc' : 'desc',
            );

            if ($offset > 0 && empty($ids)) {
                $args['offset'] = $offset;
            }

            $args = yacht_rental_query_add_sort_order($args, $orderby, $order);
            $args = yacht_rental_query_add_posts_and_cats($args, $ids, 'clients', $cat, 'clients_group');

            $query = new WP_Query( $args );

            $post_number = 0;

            while ( $query->have_posts() ) {
                $query->the_post();
                $post_number++;
                $args = array(
                    'layout' => $style,
                    'show' => false,
                    'number' => $post_number,
                    'posts_on_page' => ($count > 0 ? $count : $query->found_posts),
                    "descr" => yacht_rental_get_custom_option('post_excerpt_maxlength'.($columns > 1 ? '_masonry' : '')),
                    "orderby" => $orderby,
                    'content' => false,
                    'terms_list' => false,
                    'columns_count' => $columns,
                    'slider' => $slider,
                    'tag_id' => $id ? $id . '_' . $post_number : '',
                    'tag_class' => '',
                    'tag_animation' => '',
                    'tag_css' => '',
                    'tag_css_wh' => $ws . $hs
                );
                $post_data = yacht_rental_get_post_data($args);
                $post_meta = get_post_meta($post_data['post_id'], yacht_rental_storage_get('options_prefix') . '_post_options', true);
                $thumb_sizes = yacht_rental_get_thumb_sizes(array('layout' => $style));
                $args['client_name'] = $post_meta['client_name'];
                $args['client_position'] = $post_meta['client_position'];
                $args['client_image'] = $post_data['post_thumb'];
                $args['client_link'] = yacht_rental_param_is_on('client_show_link')
                    ? (!empty($post_meta['client_link']) ? $post_meta['client_link'] : $post_data['post_link'])
                    : '';
                $output .= yacht_rental_show_post_layout($args, $post_data);
            }
            wp_reset_postdata();
        }

        if (yacht_rental_param_is_on($slider)) {
            $output .= '</div>'
                . '<div class="sc_slider_controls_wrap"><a class="sc_slider_prev" href="#"></a><a class="sc_slider_next" href="#"></a></div>'
                . '<div class="sc_slider_pagination_wrap"></div>'
                . '</div>';
        } else if ($columns > 1) {
            $output .= '</div>';
        }

        $output .= (!empty($link) ? '<div class="sc_clients_button sc_item_button">'.yacht_rental_do_shortcode('[trx_button link="'.esc_url($link).'"]'.esc_html($link_caption).'[/trx_button]').'</div>' : '')
            . '</div><!-- /.sc_clients -->'
            . '</div><!-- /.sc_clients_wrap -->';

        // Add template specific scripts and styles
        do_action('yacht_rental_action_blog_scripts', $style);

        return apply_filters('yacht_rental_shortcode_output', $output, 'trx_clients', $atts, $content);
    }
    add_shortcode('trx_clients', 'yacht_rental_sc_clients');
}


if ( !function_exists( 'yacht_rental_sc_clients_item' ) ) {
    function yacht_rental_sc_clients_item($atts, $content=null) {
        if (yacht_rental_in_shortcode_blogger()) return '';
        extract(yacht_rental_html_decode(shortcode_atts( array(
            // Individual params
            "name" => "",
            "position" => "",
            "image" => "",
            "link" => "",
            // Common params
            "id" => "",
            "class" => "",
            "animation" => "",
            "css" => ""
        ), $atts)));

        yacht_rental_storage_inc_array('sc_clients_data', 'counter');

        $id = $id ? $id : (yacht_rental_storage_get_array('sc_clients_data', 'id') ? yacht_rental_storage_get_array('sc_clients_data', 'id') . '_' . yacht_rental_storage_get_array('sc_clients_data', 'counter') : '');

        $descr = trim(chop(do_shortcode($content)));

        $thumb_sizes = yacht_rental_get_thumb_sizes(array('layout' => yacht_rental_storage_get_array('sc_clients_data', 'style')));

        if ($image > 0) {
            $attach = wp_get_attachment_image_src( $image, 'full' );
            if (isset($attach[0]) && $attach[0]!='')
                $image = $attach[0];
        }
        $image = yacht_rental_get_resized_image_tag($image, $thumb_sizes['w'], $thumb_sizes['h']);

        $post_data = array(
            'post_title' => $name,
            'post_excerpt' => $descr
        );
        $args = array(
            'layout' => yacht_rental_storage_get_array('sc_clients_data', 'style'),
            'number' => yacht_rental_storage_get_array('sc_clients_data', 'counter'),
            'columns_count' => yacht_rental_storage_get_array('sc_clients_data', 'columns'),
            'slider' => yacht_rental_storage_get_array('sc_clients_data', 'slider'),
            'show' => false,
            'descr'  => 0,
            'tag_id' => $id,
            'tag_class' => $class,
            'tag_animation' => $animation,
            'tag_css' => $css,
            'tag_css_wh' => yacht_rental_storage_get_array('sc_clients_data', 'css_wh'),
            'client_position' => $position,
            'client_link' => $link,
            'client_image' => $image
        );
        $output = yacht_rental_show_post_layout($args, $post_data);
        return apply_filters('yacht_rental_shortcode_output', $output, 'trx_clients_item', $atts, $content);
    }
    add_shortcode('trx_clients_item', 'yacht_rental_sc_clients_item');
}
// ---------------------------------- [/trx_clients] ---------------------------------------



// Add [trx_clients] and [trx_clients_item] in the shortcodes list
if (!function_exists('yacht_rental_clients_reg_shortcodes')) {
    function yacht_rental_clients_reg_shortcodes() {
        if (yacht_rental_storage_isset('shortcodes')) {

            $users = yacht_rental_get_list_users();
            $members = yacht_rental_get_list_posts(false, array(
                    'post_type'=>'clients',
                    'orderby'=>'title',
                    'order'=>'asc',
                    'return'=>'title'
                )
            );
            $clients_groups = yacht_rental_get_list_terms(false, 'clients_group');
            $clients_styles = yacht_rental_get_list_templates('clients');
            $controls 		= yacht_rental_get_list_slider_controls();

            yacht_rental_sc_map_after('trx_chat', array(

                // Clients
                "trx_clients" => array(
                    "title" => esc_html__("Clients", 'trx_utils'),
                    "desc" => wp_kses_data( __("Insert clients list in your page (post)", 'trx_utils') ),
                    "decorate" => true,
                    "container" => false,
                    "params" => array(
                        "title" => array(
                            "title" => esc_html__("Title", 'trx_utils'),
                            "desc" => wp_kses_data( __("Title for the block", 'trx_utils') ),
                            "value" => "",
                            "type" => "text"
                        ),
                        "subtitle" => array(
                            "title" => esc_html__("Subtitle", 'trx_utils'),
                            "desc" => wp_kses_data( __("Subtitle for the block", 'trx_utils') ),
                            "value" => "",
                            "type" => "text"
                        ),
                        "description" => array(
                            "title" => esc_html__("Description", 'trx_utils'),
                            "desc" => wp_kses_data( __("Short description for the block", 'trx_utils') ),
                            "value" => "",
                            "type" => "textarea"
                        ),
                        "style" => array(
                            "title" => esc_html__("Clients style", 'trx_utils'),
                            "desc" => wp_kses_data( __("Select style to display clients list", 'trx_utils') ),
                            "value" => "clients-1",
                            "type" => "select",
                            "options" => $clients_styles
                        ),
                        "columns" => array(
                            "title" => esc_html__("Columns", 'trx_utils'),
                            "desc" => wp_kses_data( __("How many columns use to show clients", 'trx_utils') ),
                            "value" => 4,
                            "min" => 2,
                            "max" => 6,
                            "step" => 1,
                            "type" => "spinner"
                        ),
                        "scheme" => array(
                            "title" => esc_html__("Color scheme", 'trx_utils'),
                            "desc" => wp_kses_data( __("Select color scheme for this block", 'trx_utils') ),
                            "value" => "",
                            "type" => "checklist",
                            "options" => yacht_rental_get_sc_param('schemes')
                        ),
                        "slider" => array(
                            "title" => esc_html__("Slider", 'trx_utils'),
                            "desc" => wp_kses_data( __("Use slider to show clients", 'trx_utils') ),
                            "value" => "no",
                            "type" => "switch",
                            "options" => yacht_rental_get_sc_param('yes_no')
                        ),
                        "controls" => array(
                            "title" => esc_html__("Controls", 'trx_utils'),
                            "desc" => wp_kses_data( __("Slider controls style and position", 'trx_utils') ),
                            "dependency" => array(
                                'slider' => array('yes')
                            ),
                            "divider" => true,
                            "value" => "no",
                            "type" => "checklist",
                            "dir" => "horizontal",
                            "options" => $controls
                        ),
                        "slides_space" => array(
                            "title" => esc_html__("Space between slides", 'trx_utils'),
                            "desc" => wp_kses_data( __("Size of space (in px) between slides", 'trx_utils') ),
                            "dependency" => array(
                                'slider' => array('yes')
                            ),
                            "value" => 0,
                            "min" => 0,
                            "max" => 100,
                            "step" => 10,
                            "type" => "spinner"
                        ),
                        "interval" => array(
                            "title" => esc_html__("Slides change interval", 'trx_utils'),
                            "desc" => wp_kses_data( __("Slides change interval (in milliseconds: 1000ms = 1s)", 'trx_utils') ),
                            "dependency" => array(
                                'slider' => array('yes')
                            ),
                            "value" => 7000,
                            "step" => 500,
                            "min" => 0,
                            "type" => "spinner"
                        ),
                        "autoheight" => array(
                            "title" => esc_html__("Autoheight", 'trx_utils'),
                            "desc" => wp_kses_data( __("Change whole slider's height (make it equal current slide's height)", 'trx_utils') ),
                            "dependency" => array(
                                'slider' => array('yes')
                            ),
                            "value" => "no",
                            "type" => "switch",
                            "options" => yacht_rental_get_sc_param('yes_no')
                        ),
                        "custom" => array(
                            "title" => esc_html__("Custom", 'trx_utils'),
                            "desc" => wp_kses_data( __("Allow get team members from inner shortcodes (custom) or get it from specified group (cat)", 'trx_utils') ),
                            "divider" => true,
                            "value" => "no",
                            "type" => "switch",
                            "options" => yacht_rental_get_sc_param('yes_no')
                        ),
                        "cat" => array(
                            "title" => esc_html__("Categories", 'trx_utils'),
                            "desc" => wp_kses_data( __("Select categories (groups) to show team members. If empty - select team members from any category (group) or from IDs list", 'trx_utils') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "divider" => true,
                            "value" => "",
                            "type" => "select",
                            "style" => "list",
                            "multiple" => true,
                            "options" => yacht_rental_array_merge(array(0 => esc_html__('- Select category -', 'trx_utils')), $clients_groups)
                        ),
                        "count" => array(
                            "title" => esc_html__("Number of posts", 'trx_utils'),
                            "desc" => wp_kses_data( __("How many posts will be displayed? If used IDs - this parameter ignored.", 'trx_utils') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "value" => 4,
                            "min" => 1,
                            "max" => 100,
                            "type" => "spinner"
                        ),
                        "offset" => array(
                            "title" => esc_html__("Offset before select posts", 'trx_utils'),
                            "desc" => wp_kses_data( __("Skip posts before select next part.", 'trx_utils') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "value" => 0,
                            "min" => 0,
                            "type" => "spinner"
                        ),
                        "orderby" => array(
                            "title" => esc_html__("Post order by", 'trx_utils'),
                            "desc" => wp_kses_data( __("Select desired posts sorting method", 'trx_utils') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "value" => "title",
                            "type" => "select",
                            "options" => yacht_rental_get_sc_param('sorting')
                        ),
                        "order" => array(
                            "title" => esc_html__("Post order", 'trx_utils'),
                            "desc" => wp_kses_data( __("Select desired posts order", 'trx_utils') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "value" => "asc",
                            "type" => "switch",
                            "size" => "big",
                            "options" => yacht_rental_get_sc_param('ordering')
                        ),
                        "ids" => array(
                            "title" => esc_html__("Post IDs list", 'trx_utils'),
                            "desc" => wp_kses_data( __("Comma separated list of posts ID. If set - parameters above are ignored!", 'trx_utils') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "value" => "",
                            "type" => "text"
                        ),
                        "link" => array(
                            "title" => esc_html__("Button URL", 'trx_utils'),
                            "desc" => wp_kses_data( __("Link URL for the button at the bottom of the block", 'trx_utils') ),
                            "value" => "",
                            "type" => "text"
                        ),
                        "link_caption" => array(
                            "title" => esc_html__("Button caption", 'trx_utils'),
                            "desc" => wp_kses_data( __("Caption for the button at the bottom of the block", 'trx_utils') ),
                            "value" => "",
                            "type" => "text"
                        ),
                        "width" => yacht_rental_shortcodes_width(),
                        "height" => yacht_rental_shortcodes_height(),
                        "top" => yacht_rental_get_sc_param('top'),
                        "bottom" => yacht_rental_get_sc_param('bottom'),
                        "left" => yacht_rental_get_sc_param('left'),
                        "right" => yacht_rental_get_sc_param('right'),
                        "id" => yacht_rental_get_sc_param('id'),
                        "class" => yacht_rental_get_sc_param('class'),
                        "animation" => yacht_rental_get_sc_param('animation'),
                        "css" => yacht_rental_get_sc_param('css')
                    ),
                    "children" => array(
                        "name" => "trx_clients_item",
                        "title" => esc_html__("Client", 'trx_utils'),
                        "desc" => wp_kses_data( __("Single client (custom parameters)", 'trx_utils') ),
                        "container" => true,
                        "params" => array(
                            "name" => array(
                                "title" => esc_html__("Name", 'trx_utils'),
                                "desc" => wp_kses_data( __("Client's name", 'trx_utils') ),
                                "divider" => true,
                                "value" => "",
                                "type" => "text"
                            ),
                            "position" => array(
                                "title" => esc_html__("Position", 'trx_utils'),
                                "desc" => wp_kses_data( __("Client's position", 'trx_utils') ),
                                "value" => "",
                                "type" => "text"
                            ),
                            "link" => array(
                                "title" => esc_html__("Link", 'trx_utils'),
                                "desc" => wp_kses_data( __("Link on client's personal page", 'trx_utils') ),
                                "divider" => true,
                                "value" => "",
                                "type" => "text"
                            ),
                            "image" => array(
                                "title" => esc_html__("Image", 'trx_utils'),
                                "desc" => wp_kses_data( __("Client's image", 'trx_utils') ),
                                "value" => "",
                                "readonly" => false,
                                "type" => "media"
                            ),
                            "_content_" => array(
                                "title" => esc_html__("Description", 'trx_utils'),
                                "desc" => wp_kses_data( __("Client's short description", 'trx_utils') ),
                                "divider" => true,
                                "rows" => 4,
                                "value" => "",
                                "type" => "textarea"
                            ),
                            "id" => yacht_rental_get_sc_param('id'),
                            "class" => yacht_rental_get_sc_param('class'),
                            "animation" => yacht_rental_get_sc_param('animation'),
                            "css" => yacht_rental_get_sc_param('css')
                        )
                    )
                )

            ));
        }
    }
}


// Add [trx_clients] and [trx_clients_item] in the VC shortcodes list
if (!function_exists('yacht_rental_clients_reg_shortcodes_vc')) {
    function yacht_rental_clients_reg_shortcodes_vc() {

        $clients_groups = yacht_rental_get_list_terms(false, 'clients_group');
        $clients_styles = yacht_rental_get_list_templates('clients');
        $controls		= yacht_rental_get_list_slider_controls();

        // Clients
        vc_map( array(
            "base" => "trx_clients",
            "name" => esc_html__("Clients", 'trx_utils'),
            "description" => wp_kses_data( __("Insert clients list", 'trx_utils') ),
            "category" => esc_html__('Content', 'trx_utils'),
            'icon' => 'icon_trx_clients',
            "class" => "trx_sc_columns trx_sc_clients",
            "content_element" => true,
            "is_container" => true,
            "show_settings_on_create" => true,
            "as_parent" => array('only' => 'trx_clients_item'),
            "params" => array(
                array(
                    "param_name" => "style",
                    "heading" => esc_html__("Clients style", 'trx_utils'),
                    "description" => wp_kses_data( __("Select style to display clients list", 'trx_utils') ),
                    "class" => "",
                    "admin_label" => true,
                    "value" => array_flip($clients_styles),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "scheme",
                    "heading" => esc_html__("Color scheme", 'trx_utils'),
                    "description" => wp_kses_data( __("Select color scheme for this block", 'trx_utils') ),
                    "class" => "",
                    "value" => array_flip(yacht_rental_get_sc_param('schemes')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "slider",
                    "heading" => esc_html__("Slider", 'trx_utils'),
                    "description" => wp_kses_data( __("Use slider to show testimonials", 'trx_utils') ),
                    "admin_label" => true,
                    "group" => esc_html__('Slider', 'trx_utils'),
                    "class" => "",
                    "std" => "no",
                    "value" => array_flip(yacht_rental_get_sc_param('yes_no')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "controls",
                    "heading" => esc_html__("Controls", 'trx_utils'),
                    "description" => wp_kses_data( __("Slider controls style and position", 'trx_utils') ),
                    "admin_label" => true,
                    "group" => esc_html__('Slider', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'slider',
                        'value' => 'yes'
                    ),
                    "class" => "",
                    "std" => "no",
                    "value" => array_flip($controls),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "slides_space",
                    "heading" => esc_html__("Space between slides", 'trx_utils'),
                    "description" => wp_kses_data( __("Size of space (in px) between slides", 'trx_utils') ),
                    "admin_label" => true,
                    "group" => esc_html__('Slider', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'slider',
                        'value' => 'yes'
                    ),
                    "class" => "",
                    "value" => "0",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "interval",
                    "heading" => esc_html__("Slides change interval", 'trx_utils'),
                    "description" => wp_kses_data( __("Slides change interval (in milliseconds: 1000ms = 1s)", 'trx_utils') ),
                    "group" => esc_html__('Slider', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'slider',
                        'value' => 'yes'
                    ),
                    "class" => "",
                    "value" => "7000",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "autoheight",
                    "heading" => esc_html__("Autoheight", 'trx_utils'),
                    "description" => wp_kses_data( __("Change whole slider's height (make it equal current slide's height)", 'trx_utils') ),
                    "group" => esc_html__('Slider', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'slider',
                        'value' => 'yes'
                    ),
                    "class" => "",
                    "value" => array("Autoheight" => "yes" ),
                    "type" => "checkbox"
                ),
                array(
                    "param_name" => "custom",
                    "heading" => esc_html__("Custom", 'trx_utils'),
                    "description" => wp_kses_data( __("Allow get clients from inner shortcodes (custom) or get it from specified group (cat)", 'trx_utils') ),
                    "class" => "",
                    "value" => array("Custom clients" => "yes" ),
                    "type" => "checkbox"
                ),
                array(
                    "param_name" => "title",
                    "heading" => esc_html__("Title", 'trx_utils'),
                    "description" => wp_kses_data( __("Title for the block", 'trx_utils') ),
                    "admin_label" => true,
                    "group" => esc_html__('Captions', 'trx_utils'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "subtitle",
                    "heading" => esc_html__("Subtitle", 'trx_utils'),
                    "description" => wp_kses_data( __("Subtitle for the block", 'trx_utils') ),
                    "group" => esc_html__('Captions', 'trx_utils'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "description",
                    "heading" => esc_html__("Description", 'trx_utils'),
                    "description" => wp_kses_data( __("Description for the block", 'trx_utils') ),
                    "group" => esc_html__('Captions', 'trx_utils'),
                    "class" => "",
                    "value" => "",
                    "type" => "textarea"
                ),
                array(
                    "param_name" => "cat",
                    "heading" => esc_html__("Categories", 'trx_utils'),
                    "description" => wp_kses_data( __("Select category to show clients. If empty - select clients from any category (group) or from IDs list", 'trx_utils') ),
                    "group" => esc_html__('Query', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "class" => "",
                    "value" => array_flip((array)yacht_rental_array_merge(array(0 => esc_html__('- Select category -', 'trx_utils')), $clients_groups)),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "columns",
                    "heading" => esc_html__("Columns", 'trx_utils'),
                    "description" => wp_kses_data( __("How many columns use to show clients", 'trx_utils') ),
                    "group" => esc_html__('Query', 'trx_utils'),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "4",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "count",
                    "heading" => esc_html__("Number of posts", 'trx_utils'),
                    "description" => wp_kses_data( __("How many posts will be displayed? If used IDs - this parameter ignored.", 'trx_utils') ),
                    "group" => esc_html__('Query', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "class" => "",
                    "value" => "4",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "offset",
                    "heading" => esc_html__("Offset before select posts", 'trx_utils'),
                    "description" => wp_kses_data( __("Skip posts before select next part.", 'trx_utils') ),
                    "group" => esc_html__('Query', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "class" => "",
                    "value" => "0",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "orderby",
                    "heading" => esc_html__("Post sorting", 'trx_utils'),
                    "description" => wp_kses_data( __("Select desired posts sorting method", 'trx_utils') ),
                    "group" => esc_html__('Query', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "std" => "title",
                    "class" => "",
                    "value" => array_flip((array)yacht_rental_get_sc_param('sorting')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "order",
                    "heading" => esc_html__("Post order", 'trx_utils'),
                    "description" => wp_kses_data( __("Select desired posts order", 'trx_utils') ),
                    "group" => esc_html__('Query', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "std" => "asc",
                    "class" => "",
                    "value" => array_flip((array)yacht_rental_get_sc_param('ordering')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "ids",
                    "heading" => esc_html__("client's IDs list", 'trx_utils'),
                    "description" => wp_kses_data( __("Comma separated list of client's ID. If set - parameters above (category, count, order, etc.)  are ignored!", 'trx_utils') ),
                    "group" => esc_html__('Query', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "link",
                    "heading" => esc_html__("Button URL", 'trx_utils'),
                    "description" => wp_kses_data( __("Link URL for the button at the bottom of the block", 'trx_utils') ),
                    "group" => esc_html__('Captions', 'trx_utils'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "link_caption",
                    "heading" => esc_html__("Button caption", 'trx_utils'),
                    "description" => wp_kses_data( __("Caption for the button at the bottom of the block", 'trx_utils') ),
                    "group" => esc_html__('Captions', 'trx_utils'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                yacht_rental_vc_width(),
                yacht_rental_vc_height(),
                yacht_rental_get_vc_param('margin_top'),
                yacht_rental_get_vc_param('margin_bottom'),
                yacht_rental_get_vc_param('margin_left'),
                yacht_rental_get_vc_param('margin_right'),
                yacht_rental_get_vc_param('id'),
                yacht_rental_get_vc_param('class'),
                yacht_rental_get_vc_param('animation'),
                yacht_rental_get_vc_param('css')
            ),
            'js_view' => 'VcTrxColumnsView'
        ) );


        vc_map( array(
            "base" => "trx_clients_item",
            "name" => esc_html__("Client", 'trx_utils'),
            "description" => wp_kses_data( __("Client - all data pull out from it account on your site", 'trx_utils') ),
            "show_settings_on_create" => true,
            "class" => "trx_sc_collection trx_sc_column_item trx_sc_clients_item",
            "content_element" => true,
            "is_container" => true,
            'icon' => 'icon_trx_clients_item',
            "as_child" => array('only' => 'trx_clients'),
            "as_parent" => array('except' => 'trx_clients'),
            "params" => array(
                array(
                    "param_name" => "name",
                    "heading" => esc_html__("Name", 'trx_utils'),
                    "description" => wp_kses_data( __("Client's name", 'trx_utils') ),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "position",
                    "heading" => esc_html__("Position", 'trx_utils'),
                    "description" => wp_kses_data( __("Client's position", 'trx_utils') ),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "link",
                    "heading" => esc_html__("Link", 'trx_utils'),
                    "description" => wp_kses_data( __("Link on client's personal page", 'trx_utils') ),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "image",
                    "heading" => esc_html__("Client's image", 'trx_utils'),
                    "description" => wp_kses_data( __("Clients's image", 'trx_utils') ),
                    "class" => "",
                    "value" => "",
                    "type" => "attach_image"
                ),
                yacht_rental_get_vc_param('id'),
                yacht_rental_get_vc_param('class'),
                yacht_rental_get_vc_param('animation'),
                yacht_rental_get_vc_param('css')
            ),
            'js_view' => 'VcTrxColumnItemView'
        ) );

        class WPBakeryShortCode_Trx_Clients extends Yacht_Rental_VC_ShortCodeColumns {}
        class WPBakeryShortCode_Trx_Clients_Item extends Yacht_Rental_VC_ShortCodeCollection {}

    }
}