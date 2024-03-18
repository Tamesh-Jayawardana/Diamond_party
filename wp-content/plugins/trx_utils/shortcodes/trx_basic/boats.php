<?php

if (function_exists('yacht_rental_exists_visual_composer') && yacht_rental_exists_visual_composer())
    add_action('yacht_rental_action_shortcodes_list',		'yacht_rental_boats_reg_shortcodes');
    add_action('yacht_rental_action_shortcodes_list_vc','yacht_rental_boats_reg_shortcodes_vc');


// ---------------------------------- [trx_boats] ---------------------------------------

/*
[trx_boats id="unique_id" columns="3" style="boats-1|boats-2|..."]
	[trx_boats_item name="boat name" position="director" image="url"]Description text[/trx_boats_item]
	...
[/trx_boats]
*/
if ( !function_exists( 'yacht_rental_sc_boats' ) ) {
    function yacht_rental_sc_boats($atts, $content=null){
        if (yacht_rental_in_shortcode_blogger()) return '';
        extract(yacht_rental_html_decode(shortcode_atts(array(
            // Individual params
            "style" => "boats-2",
            "columns" => 3,
            "slider" => "no",
            "slides_space" => 0,
            "controls" => "no",
            "interval" => "",
            "autoheight" => "no",
            "custom" => "no",
            "ids" => "",
            "cat" => "",
            "count" => 3,
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

        if (empty($id)) $id = "sc_boats_".str_replace('.', '', mt_rand());
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
        yacht_rental_storage_set('sc_boats_data', array(
                'id'=>$id,
                'style'=>$style,
                'counter'=>0,
                'columns'=>$columns,
                'slider'=>$slider,
                'css_wh'=>$ws . $hs
            )
        );

        $output = '<div' . ($id ? ' id="'.esc_attr($id).'_wrap"' : '')
            . ' class="sc_boats_wrap'
            . ($scheme && !yacht_rental_param_is_off($scheme) && !yacht_rental_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '')
            .'">'
            . '<div' . ($id ? ' id="'.esc_attr($id).'"' : '')
            . ' class="sc_boats sc_boats_style_'.esc_attr($style)
            . ' ' . esc_attr(yacht_rental_get_template_property($style, 'container_classes'))
            . (!empty($class) ? ' '.esc_attr($class) : '')
            .'"'
            . ($css!='' ? ' style="'.esc_attr($css).'"' : '')
            . (!yacht_rental_param_is_off($animation) ? ' data-animation="'.esc_attr(yacht_rental_get_animation_classes($animation)).'"' : '')
            . '>'
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
                    . ' data-slides-min-width="' . ($style=='boats-1' ? 100 : 220) . '"'
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
                'post_type' => 'boats',
                'post_status' => 'publish',
                'posts_per_page' => $count,
                'ignore_sticky_posts' => true,
                'order' => $order=='asc' ? 'asc' : 'desc',
            );

            if ($offset > 0 && empty($ids)) {
                $args['offset'] = $offset;
            }

            $args = yacht_rental_query_add_sort_order($args, $orderby, $order);
            $args = yacht_rental_query_add_posts_and_cats($args, $ids, 'boats', $cat, 'boats_group');

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

        $output .= (!empty($link) ? '<div class="sc_boats_button sc_item_button">'.yacht_rental_do_shortcode('[trx_button link="'.esc_url($link).'"]'.esc_html($link_caption).'[/trx_button]').'</div>' : '')
            . '</div><!-- /.sc_boats -->'
            . '</div><!-- /.sc_boats_wrap -->';

        // Add template specific scripts and styles
        do_action('yacht_rental_action_blog_scripts', $style);

        return apply_filters('yacht_rental_shortcode_output', $output, 'trx_boats', $atts, $content);
    }
    add_shortcode('trx_boats', 'yacht_rental_sc_boats');
}


if ( !function_exists( 'yacht_rental_sc_boats_item' ) ) {
    function yacht_rental_sc_boats_item($atts, $content=null) {
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

        yacht_rental_storage_inc_array('sc_boats_data', 'counter');

        $id = $id ? $id : (yacht_rental_storage_get_array('sc_boats_data', 'id') ? yacht_rental_storage_get_array('sc_boats_data', 'id') . '_' . yacht_rental_storage_get_array('sc_boats_data', 'counter') : '');

        $descr = trim(chop(do_shortcode($content)));

        $thumb_sizes = yacht_rental_get_thumb_sizes(array('layout' => yacht_rental_storage_get_array('sc_boats_data', 'style')));

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
            'layout' => yacht_rental_storage_get_array('sc_boats_data', 'style'),
            'number' => yacht_rental_storage_get_array('sc_boats_data', 'counter'),
            'columns_count' => yacht_rental_storage_get_array('sc_boats_data', 'columns'),
            'slider' => yacht_rental_storage_get_array('sc_boats_data', 'slider'),
            'show' => false,
            'descr'  => 0,
            'tag_id' => $id,
            'tag_class' => $class,
            'tag_animation' => $animation,
            'tag_css' => $css,
            'tag_css_wh' => yacht_rental_storage_get_array('sc_boats_data', 'css_wh'),
            'boat_position' => $position,
            'boat_link' => $link,
            'boat_image' => $image
        );
        $output = yacht_rental_show_post_layout($args, $post_data);
        return apply_filters('yacht_rental_shortcode_output', $output, 'trx_boats_item', $atts, $content);
    }
    add_shortcode('trx_boats_item', 'yacht_rental_sc_boats_item');
}
// ---------------------------------- [/trx_boats] ---------------------------------------



// Add [trx_boats] and [trx_boats_item] in the shortcodes list
if (!function_exists('yacht_rental_boats_reg_shortcodes')) {
    function yacht_rental_boats_reg_shortcodes() {
        if (yacht_rental_storage_isset('shortcodes')) {

            $users = yacht_rental_get_list_users();
            $members = yacht_rental_get_list_posts(false, array(
                    'post_type'=>'boats',
                    'orderby'=>'title',
                    'order'=>'asc',
                    'return'=>'title'
                )
            );
            $boats_groups = yacht_rental_get_list_terms(false, 'boats_group');
            $boats_styles = yacht_rental_get_list_templates('boats');
            $controls 		= yacht_rental_get_list_slider_controls();

            yacht_rental_sc_map_after('trx_chat', array(

                // Boats
                "trx_boats" => array(
                    "title" => esc_html__("Boats", 'trx_utils'),
                    "desc" => wp_kses_data( __("Insert boats list in your page (post)", 'trx_utils') ),
                    "decorate" => true,
                    "container" => false,
                    "params" => array(
                        "style" => array(
                            "title" => esc_html__("Boats style", 'trx_utils'),
                            "desc" => wp_kses_data( __("Select style to display boats list", 'trx_utils') ),
                            "value" => "boats-1",
                            "type" => "select",
                            "options" => $boats_styles
                        ),
                        "columns" => array(
                            "title" => esc_html__("Columns", 'trx_utils'),
                            "desc" => wp_kses_data( __("How many columns use to show boats", 'trx_utils') ),
                            "value" => 3,
                            "min" => 2,
                            "max" => 3,
                            "step" => 1,
                            "type" => "spinner"
                        ),
                        "slider" => array(
                            "title" => esc_html__("Slider", 'trx_utils'),
                            "desc" => wp_kses_data( __("Use slider to show boats", 'trx_utils') ),
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
                            "options" => yacht_rental_array_merge(array(0 => esc_html__('- Select category -', 'trx_utils')), $boats_groups)
                        ),
                        "count" => array(
                            "title" => esc_html__("Number of posts", 'trx_utils'),
                            "desc" => wp_kses_data( __("How many posts will be displayed? If used IDs - this parameter ignored.", 'trx_utils') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "value" => 3,
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
                )

            ));
        }
    }
}


// Add [trx_boats] and [trx_boats_item] in the VC shortcodes list
if (!function_exists('yacht_rental_boats_reg_shortcodes_vc')) {
    function yacht_rental_boats_reg_shortcodes_vc() {

        $boats_groups = yacht_rental_get_list_terms(false, 'boats_group');
        $boats_styles = yacht_rental_get_list_templates('boats');
        $controls		= yacht_rental_get_list_slider_controls();

        // Boats
        vc_map( array(
            "base" => "trx_boats",
            "name" => esc_html__("Boats", 'trx_utils'),
            "description" => wp_kses_data( __("Insert boats list", 'trx_utils') ),
            "category" => esc_html__('Content', 'trx_utils'),
            'icon' => 'icon_trx_boats',
            "class" => "trx_sc_columns trx_sc_boats",
            "content_element" => true,
            "is_container" => true,
            "show_settings_on_create" => true,
            "params" => array(
                array(
                    "param_name" => "style",
                    "heading" => esc_html__("Boats style", 'trx_utils'),
                    "description" => wp_kses_data( __("Select style to display boats list", 'trx_utils') ),
                    "class" => "",
                    "admin_label" => true,
                    "value" => array_flip($boats_styles),
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
                    "description" => wp_kses_data( __("Allow get boats from inner shortcodes (custom) or get it from specified group (cat)", 'trx_utils') ),
                    "class" => "",
                    "value" => array("Custom boats" => "yes" ),
                    "type" => "checkbox"
                ),
                array(
                    "param_name" => "cat",
                    "heading" => esc_html__("Categories", 'trx_utils'),
                    "description" => wp_kses_data( __("Select category to show boats. If empty - select boats from any category (group) or from IDs list", 'trx_utils') ),
                    "group" => esc_html__('Query', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "class" => "",
                    "value" => array_flip(yacht_rental_array_merge(array(0 => esc_html__('- Select category -', 'trx_utils')), $boats_groups)),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "columns",
                    "heading" => esc_html__("Columns", 'trx_utils'),
                    "description" => wp_kses_data( __("How many columns use to show boats", 'trx_utils') ),
                    "group" => esc_html__('Query', 'trx_utils'),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "3",
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
                    "value" => "3",
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
                    "value" => array_flip(yacht_rental_get_sc_param('sorting')),
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
                    "value" => array_flip(yacht_rental_get_sc_param('ordering')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "ids",
                    "heading" => esc_html__("boat's IDs list", 'trx_utils'),
                    "description" => wp_kses_data( __("Comma separated list of boat's ID. If set - parameters above (category, count, order, etc.)  are ignored!", 'trx_utils') ),
                    "group" => esc_html__('Query', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
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
        class WPBakeryShortCode_Trx_Boats extends Yacht_Rental_VC_ShortCodeColumns {}

    }
}