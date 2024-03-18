<?php

// Register shortcodes [trx_services] and [trx_services_item]
if (function_exists('yacht_rental_exists_visual_composer') && yacht_rental_exists_visual_composer())
    add_action('yacht_rental_action_shortcodes_list',		'yacht_rental_services_reg_shortcodes');
    add_action('yacht_rental_action_shortcodes_list_vc','yacht_rental_services_reg_shortcodes_vc');




// ---------------------------------- [trx_services] ---------------------------------------

/*
[trx_services id="unique_id" columns="4" count="4" style="services-1|services-2|..." title="Block title" subtitle="xxx" description="xxxxxx"]
	[trx_services_item icon="url" title="Item title" description="Item description" link="url" link_caption="Link text"]
	[trx_services_item icon="url" title="Item title" description="Item description" link="url" link_caption="Link text"]
[/trx_services]
*/
if ( !function_exists( 'yacht_rental_sc_services' ) ) {
    function yacht_rental_sc_services($atts, $content=null){
        if (yacht_rental_in_shortcode_blogger()) return '';
        extract(yacht_rental_html_decode(shortcode_atts(array(
            // Individual params
            "style" => "services-1",
            "columns" => 3,
            "slider" => "no",
            "slides_space" => 0,
            "controls" => "no",
            "interval" => "",
            "autoheight" => "no",
            "equalheight" => "no",
            "align" => "",
            "custom" => "no",
            "type" => "icons",	// icons | images
            "ids" => "",
            "cat" => "",
            "count" => 4,
            "offset" => "",
            "orderby" => "date",
            "order" => "desc",
            "readmore" => esc_html__('Learn more', 'trx_utils'),
            "title" => "",
            "subtitle" => "",
            "description" => "",
            "link_caption" => esc_html__('Learn more', 'trx_utils'),
            "link" => '',
            "scheme" => '',
            "image" => '',
            "image_align" => '',
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

        if (yacht_rental_param_is_off($slider) && $columns > 1 && $style == 'services-5' && !empty($image)) $columns = 2;
        if (!empty($image)) {
            if ($image > 0) {
                $attach = wp_get_attachment_image_src( $image, 'full' );
                if (isset($attach[0]) && $attach[0]!='')
                    $image = $attach[0];
            }
        }

        if (empty($id)) $id = "sc_services_".str_replace('.', '', mt_rand());
        if (empty($width)) $width = "100%";
        if (!empty($height) && yacht_rental_param_is_on($autoheight)) $autoheight = "no";
        if (empty($interval)) $interval = mt_rand(5000, 10000);

        $class .= ($class ? ' ' : '') . yacht_rental_get_css_position_as_classes($top, $right, $bottom, $left);

        $ws = yacht_rental_get_css_dimensions_from_values($width);
        $hs = yacht_rental_get_css_dimensions_from_values('', $height);
        $css .= ($hs) . ($ws);

        $columns = max(1, min(12, (int) $columns));
        $count = max(1, (int) $count);
        if (yacht_rental_param_is_off($custom) && $count < $columns) $columns = $count;

        if (yacht_rental_param_is_on($slider)) yacht_rental_enqueue_slider('swiper');

        yacht_rental_storage_set('sc_services_data', array(
                'id' => $id,
                'style' => $style,
                'type' => $type,
                'columns' => $columns,
                'counter' => 0,
                'slider' => $slider,
                'css_wh' => $ws . $hs,
                'readmore' => $readmore
            )
        );

        $output = '<div' . ($id ? ' id="'.esc_attr($id).'_wrap"' : '')
            . ' class="sc_services_wrap'
            . ($scheme && !yacht_rental_param_is_off($scheme) && !yacht_rental_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '')
            .'">'
            . '<div' . ($id ? ' id="'.esc_attr($id).'"' : '')
            . ' class="sc_services'
            . ' sc_services_style_'.esc_attr($style)
            . ' sc_services_type_'.esc_attr($type)
            . ' ' . esc_attr(yacht_rental_get_template_property($style, 'container_classes'))
            . (!empty($class) ? ' '.esc_attr($class) : '')
            . ($align!='' && $align!='none' ? ' align'.esc_attr($align) : '')
            . '"'
            . ($css!='' ? ' style="'.esc_attr($css).'"' : '')
            . (!yacht_rental_param_is_off($equalheight) ? ' data-equal-height=".sc_services_item"' : '')
            . (!yacht_rental_param_is_off($animation) ? ' data-animation="'.esc_attr(yacht_rental_get_animation_classes($animation)).'"' : '')
            . '>'
            . (!empty($subtitle) ? '<h6 class="sc_services_subtitle sc_item_subtitle">' . trim(yacht_rental_strmacros($subtitle)) . '</h6>' : '')
            . (!empty($title) ? '<h2 class="sc_services_title sc_item_title' . (empty($description) ? ' sc_item_title_without_descr' : ' sc_item_title_without_descr') . '">' . trim(yacht_rental_strmacros($title)) . '</h2>' : '')
            . (!empty($description) ? '<div class="sc_services_descr sc_item_descr">' . trim(yacht_rental_strmacros($description)) . '</div>' : '')
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
                    . ' data-slides-min-width="250"'
                    . '>'
                    . '<div class="slides swiper-wrapper">')
                : ($columns > 1
                    ? ($style == 'services-5' && !empty($image)
                        ? '<div class="sc_service_container sc_align_'.esc_attr($image_align).'">'
                        . '<div class="sc_services_image"><img src="'.esc_url($image).'" alt="'.esc_attr__('img', 'trx_utils').'"></div>'
                        : '')
                    . '<div class="sc_columns columns_wrap">'
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
                'post_type' => 'services',
                'post_status' => 'publish',
                'posts_per_page' => $count,
                'ignore_sticky_posts' => true,
                'order' => $order=='asc' ? 'asc' : 'desc',
                'readmore' => $readmore
            );

            if ($offset > 0 && empty($ids)) {
                $args['offset'] = $offset;
            }

            $args = yacht_rental_query_add_sort_order($args, $orderby, $order);
            $args = yacht_rental_query_add_posts_and_cats($args, $ids, 'services', $cat, 'services_group');

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
                    'readmore' => $readmore,
                    'tag_type' => $type,
                    'columns_count' => $columns,
                    'slider' => $slider,
                    'tag_id' => $id ? $id . '_' . $post_number : '',
                    'tag_class' => '',
                    'tag_animation' => '',
                    'tag_css' => '',
                    'tag_css_wh' => $ws . $hs
                );
                $output .= yacht_rental_show_post_layout($args);
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
            if ($style == 'services-5' && !empty($image))
                $output .= '</div>';
        }

        $output .=  (!empty($link) ? '<div class="sc_services_button sc_item_button">'.yacht_rental_do_shortcode('[trx_button link="'.esc_url($link).'"]'.esc_html($link_caption).'[/trx_button]').'</div>' : '')
            . '</div><!-- /.sc_services -->'
            . '</div><!-- /.sc_services_wrap -->';

        // Add template specific scripts and styles
        do_action('yacht_rental_action_blog_scripts', $style);

        return apply_filters('yacht_rental_shortcode_output', $output, 'trx_services', $atts, $content);
    }
    add_shortcode('trx_services', 'yacht_rental_sc_services');
}


if ( !function_exists( 'yacht_rental_sc_services_item' ) ) {
    function yacht_rental_sc_services_item($atts, $content=null) {
        if (yacht_rental_in_shortcode_blogger()) return '';
        extract(yacht_rental_html_decode(shortcode_atts( array(
            // Individual params
            "icon" => "",
            "image" => "",
            "title" => "",
            "link" => "",
            "readmore" => "(none)",
            // Common params
            "id" => "",
            "class" => "",
            "animation" => "",
            "css" => ""
        ), $atts)));

        yacht_rental_storage_inc_array('sc_services_data', 'counter');

        $id = $id ? $id : (yacht_rental_storage_get_array('sc_services_data', 'id') ? yacht_rental_storage_get_array('sc_services_data', 'id') . '_' . yacht_rental_storage_get_array('sc_services_data', 'counter') : '');

        $descr = trim(chop(do_shortcode($content)));
        $readmore = $readmore=='(none)' ? yacht_rental_storage_get_array('sc_services_data', 'readmore') : $readmore;

        $type = yacht_rental_storage_get_array('sc_services_data', 'type');
        if (!empty($icon)) {
            $type = 'icons';
        } else if (!empty($image)) {
            $type = 'images';
            if ($image > 0) {
                $attach = wp_get_attachment_image_src( $image, 'full' );
                if (isset($attach[0]) && $attach[0]!='')
                    $image = $attach[0];
            }
            $thumb_sizes = yacht_rental_get_thumb_sizes(array('layout' => yacht_rental_storage_get_array('sc_services_data', 'style')));
            $image = yacht_rental_get_resized_image_tag($image, $thumb_sizes['w'], $thumb_sizes['h']);
        }

        $post_data = array(
            'post_title' => $title,
            'post_excerpt' => $descr,
            'post_thumb' => $image,
            'post_icon' => $icon,
            'post_link' => $link,
            'post_protected' => false,
            'post_format' => 'standard'
        );
        $args = array(
            'layout' => yacht_rental_storage_get_array('sc_services_data', 'style'),
            'number' => yacht_rental_storage_get_array('sc_services_data', 'counter'),
            'columns_count' => yacht_rental_storage_get_array('sc_services_data', 'columns'),
            'slider' => yacht_rental_storage_get_array('sc_services_data', 'slider'),
            'show' => false,
            'descr'  => -1,		// -1 - don't strip tags, 0 - strip_tags, >0 - strip_tags and truncate string
            'readmore' => $readmore,
            'tag_type' => $type,
            'tag_id' => $id,
            'tag_class' => $class,
            'tag_animation' => $animation,
            'tag_css' => $css,
            'tag_css_wh' => yacht_rental_storage_get_array('sc_services_data', 'css_wh')
        );
        $output = yacht_rental_show_post_layout($args, $post_data);
        return apply_filters('yacht_rental_shortcode_output', $output, 'trx_services_item', $atts, $content);
    }
    add_shortcode('trx_services_item', 'yacht_rental_sc_services_item');
}
// ---------------------------------- [/trx_services] ---------------------------------------



// Add [trx_services] and [trx_services_item] in the shortcodes list
if (!function_exists('yacht_rental_services_reg_shortcodes')) {
    function yacht_rental_services_reg_shortcodes() {
        if (yacht_rental_storage_isset('shortcodes')) {

            $services_groups = yacht_rental_get_list_terms(false, 'services_group');
            $services_styles = yacht_rental_get_list_templates('services');
            $controls 		 = yacht_rental_get_list_slider_controls();

            yacht_rental_sc_map_after('trx_section', array(

                // Services
                "trx_services" => array(
                    "title" => esc_html__("Services", 'trx_utils'),
                    "desc" => wp_kses_data( __("Insert services list in your page (post)", 'trx_utils') ),
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
                            "title" => esc_html__("Services style", 'trx_utils'),
                            "desc" => wp_kses_data( __("Select style to display services list", 'trx_utils') ),
                            "value" => "services-1",
                            "type" => "select",
                            "options" => $services_styles
                        ),
                        "image" => array(
                            "title" => esc_html__("Item's image", 'trx_utils'),
                            "desc" => wp_kses_data( __("Item's image", 'trx_utils') ),
                            "dependency" => array(
                                'style' => 'services-5'
                            ),
                            "value" => "",
                            "readonly" => false,
                            "type" => "media"
                        ),
                        "image_align" => array(
                            "title" => esc_html__("Image alignment", 'trx_utils'),
                            "desc" => wp_kses_data( __("Alignment of the image", 'trx_utils') ),
                            "divider" => true,
                            "value" => "",
                            "type" => "checklist",
                            "dir" => "horizontal",
                            "options" => yacht_rental_get_sc_param('align')
                        ),
                        "type" => array(
                            "title" => esc_html__("Icon's type", 'trx_utils'),
                            "desc" => wp_kses_data( __("Select type of icons: font icon or image", 'trx_utils') ),
                            "value" => "icons",
                            "type" => "checklist",
                            "dir" => "horizontal",
                            "options" => array(
                                'icons'  => esc_html__('Icons', 'trx_utils'),
                                'images' => esc_html__('Images', 'trx_utils')
                            )
                        ),
                        "columns" => array(
                            "title" => esc_html__("Columns", 'trx_utils'),
                            "desc" => wp_kses_data( __("How many columns use to show services list", 'trx_utils') ),
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
                            "desc" => wp_kses_data( __("Use slider to show services", 'trx_utils') ),
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
                            "value" => "",
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
                            "value" => "yes",
                            "type" => "switch",
                            "options" => yacht_rental_get_sc_param('yes_no')
                        ),
                        "align" => array(
                            "title" => esc_html__("Alignment", 'trx_utils'),
                            "desc" => wp_kses_data( __("Alignment of the services block", 'trx_utils') ),
                            "divider" => true,
                            "value" => "",
                            "type" => "checklist",
                            "dir" => "horizontal",
                            "options" => yacht_rental_get_sc_param('align')
                        ),
                        "custom" => array(
                            "title" => esc_html__("Custom", 'trx_utils'),
                            "desc" => wp_kses_data( __("Allow get services items from inner shortcodes (custom) or get it from specified group (cat)", 'trx_utils') ),
                            "divider" => true,
                            "value" => "no",
                            "type" => "switch",
                            "options" => yacht_rental_get_sc_param('yes_no')
                        ),
                        "cat" => array(
                            "title" => esc_html__("Categories", 'trx_utils'),
                            "desc" => wp_kses_data( __("Select categories (groups) to show services list. If empty - select services from any category (group) or from IDs list", 'trx_utils') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "divider" => true,
                            "value" => "",
                            "type" => "select",
                            "style" => "list",
                            "multiple" => true,
                            "options" => yacht_rental_array_merge(array(0 => esc_html__('- Select category -', 'trx_utils')), $services_groups)
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
                            "value" => "date",
                            "type" => "select",
                            "options" => yacht_rental_get_sc_param('sorting')
                        ),
                        "order" => array(
                            "title" => esc_html__("Post order", 'trx_utils'),
                            "desc" => wp_kses_data( __("Select desired posts order", 'trx_utils') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "value" => "desc",
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
                        "readmore" => array(
                            "title" => esc_html__("Read more", 'trx_utils'),
                            "desc" => wp_kses_data( __("Caption for the Read more link (if empty - link not showed)", 'trx_utils') ),
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
                        "name" => "trx_services_item",
                        "title" => esc_html__("Service item", 'trx_utils'),
                        "desc" => wp_kses_data( __("Service item", 'trx_utils') ),
                        "container" => true,
                        "params" => array(
                            "title" => array(
                                "title" => esc_html__("Title", 'trx_utils'),
                                "desc" => wp_kses_data( __("Item's title", 'trx_utils') ),
                                "divider" => true,
                                "value" => "",
                                "type" => "text"
                            ),
                            "icon" => array(
                                "title" => esc_html__("Item's icon",  'trx_utils'),
                                "desc" => wp_kses_data( __('Select icon for the item from Fontello icons set',  'trx_utils') ),
                                "value" => "",
                                "type" => "icons",
                                "options" => yacht_rental_get_sc_param('icons')
                            ),
                            "image" => array(
                                "title" => esc_html__("Item's image", 'trx_utils'),
                                "desc" => wp_kses_data( __("Item's image (if icon not selected)", 'trx_utils') ),
                                "dependency" => array(
                                    'icon' => array('is_empty', 'none')
                                ),
                                "value" => "",
                                "readonly" => false,
                                "type" => "media"
                            ),
                            "link" => array(
                                "title" => esc_html__("Link", 'trx_utils'),
                                "desc" => wp_kses_data( __("Link on service's item page", 'trx_utils') ),
                                "divider" => true,
                                "value" => "",
                                "type" => "text"
                            ),
                            "readmore" => array(
                                "title" => esc_html__("Read more", 'trx_utils'),
                                "desc" => wp_kses_data( __("Caption for the Read more link (if empty - link not showed)", 'trx_utils') ),
                                "value" => "",
                                "type" => "text"
                            ),
                            "_content_" => array(
                                "title" => esc_html__("Description", 'trx_utils'),
                                "desc" => wp_kses_data( __("Item's short description", 'trx_utils') ),
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


// Add [trx_services] and [trx_services_item] in the VC shortcodes list
if (!function_exists('yacht_rental_services_reg_shortcodes_vc')) {
    function yacht_rental_services_reg_shortcodes_vc() {

        $services_groups = yacht_rental_get_list_terms(false, 'services_group');
        $services_styles = yacht_rental_get_list_templates('services');
        $controls		 = yacht_rental_get_list_slider_controls();

        // Services
        vc_map( array(
            "base" => "trx_services",
            "name" => esc_html__("Services", 'trx_utils'),
            "description" => wp_kses_data( __("Insert services list", 'trx_utils') ),
            "category" => esc_html__('Content', 'trx_utils'),
            "icon" => 'icon_trx_services',
            "class" => "trx_sc_columns trx_sc_services",
            "content_element" => true,
            "is_container" => true,
            "show_settings_on_create" => true,
            "as_parent" => array('only' => 'trx_services_item'),
            "params" => array(
                array(
                    "param_name" => "style",
                    "heading" => esc_html__("Services style", 'trx_utils'),
                    "description" => wp_kses_data( __("Select style to display services list", 'trx_utils') ),
                    "class" => "",
                    "admin_label" => true,
                    "value" => array_flip($services_styles),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "type",
                    "heading" => esc_html__("Icon's type", 'trx_utils'),
                    "description" => wp_kses_data( __("Select type of icons: font icon or image", 'trx_utils') ),
                    "class" => "",
                    "admin_label" => true,
                    "value" => array(
                        esc_html__('Icons', 'trx_utils') => 'icons',
                        esc_html__('Images', 'trx_utils') => 'images'
                    ),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "equalheight",
                    "heading" => esc_html__("Equal height", 'trx_utils'),
                    "description" => wp_kses_data( __("Make equal height for all items in the row", 'trx_utils') ),
                    "value" => array("Equal height" => "yes" ),
                    "type" => "checkbox"
                ),
                array(
                    "param_name" => "scheme",
                    "heading" => esc_html__("Color scheme", 'trx_utils'),
                    "description" => wp_kses_data( __("Select color scheme for this block", 'trx_utils') ),
                    "class" => "",
                    "value" => array_flip((array)yacht_rental_get_sc_param('schemes')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "image",
                    "heading" => esc_html__("Image", 'trx_utils'),
                    "description" => wp_kses_data( __("Item's image", 'trx_utils') ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => 'services-5'
                    ),
                    "class" => "",
                    "value" => "",
                    "type" => "attach_image"
                ),
                array(
                    "param_name" => "image_align",
                    "heading" => esc_html__("Image alignment", 'trx_utils'),
                    "description" => wp_kses_data( __("Alignment of the image", 'trx_utils') ),
                    "class" => "",
                    "value" => array_flip((array)yacht_rental_get_sc_param('align')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "slider",
                    "heading" => esc_html__("Slider", 'trx_utils'),
                    "description" => wp_kses_data( __("Use slider to show services", 'trx_utils') ),
                    "admin_label" => true,
                    "group" => esc_html__('Slider', 'trx_utils'),
                    "class" => "",
                    "std" => "no",
                    "value" => array_flip((array)yacht_rental_get_sc_param('yes_no')),
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
                    "param_name" => "align",
                    "heading" => esc_html__("Alignment", 'trx_utils'),
                    "description" => wp_kses_data( __("Alignment of the services block", 'trx_utils') ),
                    "class" => "",
                    "value" => array_flip((array)yacht_rental_get_sc_param('align')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "custom",
                    "heading" => esc_html__("Custom", 'trx_utils'),
                    "description" => wp_kses_data( __("Allow get services from inner shortcodes (custom) or get it from specified group (cat)", 'trx_utils') ),
                    "class" => "",
                    "value" => array("Custom services" => "yes" ),
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
                    "description" => wp_kses_data( __("Select category to show services. If empty - select services from any category (group) or from IDs list", 'trx_utils') ),
                    "group" => esc_html__('Query', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "class" => "",
                    "value" => array_flip((array)yacht_rental_array_merge(array(0 => esc_html__('- Select category -', 'trx_utils')), $services_groups)),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "columns",
                    "heading" => esc_html__("Columns", 'trx_utils'),
                    "description" => wp_kses_data( __("How many columns use to show services list", 'trx_utils') ),
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
                    "admin_label" => true,
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
                    "std" => "date",
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
                    "std" => "desc",
                    "class" => "",
                    "value" => array_flip((array)yacht_rental_get_sc_param('ordering')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "ids",
                    "heading" => esc_html__("Service's IDs list", 'trx_utils'),
                    "description" => wp_kses_data( __("Comma separated list of service's ID. If set - parameters above (category, count, order, etc.)  are ignored!", 'trx_utils') ),
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
                    "param_name" => "readmore",
                    "heading" => esc_html__("Read more", 'trx_utils'),
                    "description" => wp_kses_data( __("Caption for the Read more link (if empty - link not showed)", 'trx_utils') ),
                    "admin_label" => true,
                    "group" => esc_html__('Captions', 'trx_utils'),
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
            'default_content' => '
					[trx_services_item title="' . esc_html__( 'Service item 1', 'trx_utils') . '"][/trx_services_item]
					[trx_services_item title="' . esc_html__( 'Service item 2', 'trx_utils') . '"][/trx_services_item]
					[trx_services_item title="' . esc_html__( 'Service item 3', 'trx_utils') . '"][/trx_services_item]
					[trx_services_item title="' . esc_html__( 'Service item 4', 'trx_utils') . '"][/trx_services_item]
				',
            'js_view' => 'VcTrxColumnsView'
        ) );


        vc_map( array(
            "base" => "trx_services_item",
            "name" => esc_html__("Services item", 'trx_utils'),
            "description" => wp_kses_data( __("Custom services item - all data pull out from shortcode parameters", 'trx_utils') ),
            "show_settings_on_create" => true,
            "class" => "trx_sc_collection trx_sc_column_item trx_sc_services_item",
            "content_element" => true,
            "is_container" => true,
            'icon' => 'icon_trx_services_item',
            "as_child" => array('only' => 'trx_services'),
            "as_parent" => array('except' => 'trx_services'),
            "params" => array(
                array(
                    "param_name" => "title",
                    "heading" => esc_html__("Title", 'trx_utils'),
                    "description" => wp_kses_data( __("Item's title", 'trx_utils') ),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "icon",
                    "heading" => esc_html__("Icon", 'trx_utils'),
                    "description" => wp_kses_data( __("Select icon for the item from Fontello icons set", 'trx_utils') ),
                    "admin_label" => true,
                    "class" => "",
                    "value" => yacht_rental_get_sc_param('icons'),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "image",
                    "heading" => esc_html__("Image", 'trx_utils'),
                    "description" => wp_kses_data( __("Item's image (if icon is empty)", 'trx_utils') ),
                    "class" => "",
                    "value" => "",
                    "type" => "attach_image"
                ),
                array(
                    "param_name" => "link",
                    "heading" => esc_html__("Link", 'trx_utils'),
                    "description" => wp_kses_data( __("Link on item's page", 'trx_utils') ),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "readmore",
                    "heading" => esc_html__("Read more", 'trx_utils'),
                    "description" => wp_kses_data( __("Caption for the Read more link (if empty - link not showed)", 'trx_utils') ),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                yacht_rental_get_vc_param('id'),
                yacht_rental_get_vc_param('class'),
                yacht_rental_get_vc_param('animation'),
                yacht_rental_get_vc_param('css')
            ),
            'js_view' => 'VcTrxColumnItemView'
        ) );

        class WPBakeryShortCode_Trx_Services extends Yacht_Rental_VC_ShortCodeColumns {}
        class WPBakeryShortCode_Trx_Services_Item extends Yacht_Rental_VC_ShortCodeCollection {}

    }
}