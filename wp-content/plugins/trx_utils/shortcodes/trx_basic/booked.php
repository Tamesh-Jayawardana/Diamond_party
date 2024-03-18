<?php

if (function_exists('yacht_rental_exists_visual_composer') && yacht_rental_exists_visual_composer())
    add_action('yacht_rental_action_shortcodes_list',				'yacht_rental_booked_reg_shortcodes');
    add_action('yacht_rental_action_shortcodes_list_vc',		'yacht_rental_booked_reg_shortcodes_vc');



// Register plugin's shortcodes
//------------------------------------------------------------------------

// Register shortcode in the shortcodes list
if (!function_exists('yacht_rental_booked_reg_shortcodes')) {
    function yacht_rental_booked_reg_shortcodes() {
        if (yacht_rental_storage_isset('shortcodes')) {

            $booked_cals = yacht_rental_get_list_booked_calendars();

            yacht_rental_sc_map('booked-appointments', array(
                    "title" => esc_html__("Booked Appointments", 'trx_utils'),
                    "desc" => esc_html__("Display the currently logged in user's upcoming appointments", 'trx_utils'),
                    "decorate" => true,
                    "container" => false,
                    "params" => array()
                )
            );

            yacht_rental_sc_map('booked-calendar', array(
                "title" => esc_html__("Booked Calendar", 'trx_utils'),
                "desc" => esc_html__("Insert booked calendar", 'trx_utils'),
                "decorate" => true,
                "container" => false,
                "params" => array(
                    "calendar" => array(
                        "title" => esc_html__("Calendar", 'trx_utils'),
                        "desc" => esc_html__("Select booked calendar to display", 'trx_utils'),
                        "value" => "0",
                        "type" => "select",
                        "options" => yacht_rental_array_merge(array(0 => esc_html__('- Select calendar -', 'trx_utils')), $booked_cals)
                    ),
                    "year" => array(
                        "title" => esc_html__("Year", 'trx_utils'),
                        "desc" => esc_html__("Year to display on calendar by default", 'trx_utils'),
                        "value" => date("Y"),
                        "min" => date("Y"),
                        "max" => date("Y")+10,
                        "type" => "spinner"
                    ),
                    "month" => array(
                        "title" => esc_html__("Month", 'trx_utils'),
                        "desc" => esc_html__("Month to display on calendar by default", 'trx_utils'),
                        "value" => date("m"),
                        "min" => 1,
                        "max" => 12,
                        "type" => "spinner"
                    )
                )
            ));
        }
    }
}


// Register shortcode in the VC shortcodes list
if (!function_exists('yacht_rental_booked_reg_shortcodes_vc')) {
    function yacht_rental_booked_reg_shortcodes_vc() {

        $booked_cals = yacht_rental_get_list_booked_calendars();

        // Booked Appointments
        vc_map( array(
            "base" => "booked-appointments",
            "name" => esc_html__("Booked Appointments", 'trx_utils'),
            "description" => esc_html__("Display the currently logged in user's upcoming appointments", 'trx_utils'),
            "category" => esc_html__('Content', 'trx_utils'),
            'icon' => 'icon_trx_booked',
            "class" => "trx_sc_single trx_sc_booked_appointments",
            "content_element" => true,
            "is_container" => false,
            "show_settings_on_create" => false,
            "params" => array()
        ) );

        class WPBakeryShortCode_Booked_Appointments extends Yacht_Rental_VC_ShortCodeSingle {}

        // Booked Calendar
        vc_map( array(
            "base" => "booked-calendar",
            "name" => esc_html__("Booked Calendar", 'trx_utils'),
            "description" => esc_html__("Insert booked calendar", 'trx_utils'),
            "category" => esc_html__('Content', 'trx_utils'),
            'icon' => 'icon_trx_booked',
            "class" => "trx_sc_single trx_sc_booked_calendar",
            "content_element" => true,
            "is_container" => false,
            "show_settings_on_create" => true,
            "params" => array(
                array(
                    "param_name" => "calendar",
                    "heading" => esc_html__("Calendar", 'trx_utils'),
                    "description" => esc_html__("Select booked calendar to display", 'trx_utils'),
                    "admin_label" => true,
                    "class" => "",
                    "std" => "0",
                    "value" => array_flip((array)yacht_rental_array_merge(array(0 => esc_html__('- Select calendar -', 'trx_utils')), $booked_cals)),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "year",
                    "heading" => esc_html__("Year", 'trx_utils'),
                    "description" => esc_html__("Year to display on calendar by default", 'trx_utils'),
                    "admin_label" => true,
                    "class" => "",
                    "std" => date("Y"),
                    "value" => date("Y"),
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "month",
                    "heading" => esc_html__("Month", 'trx_utils'),
                    "description" => esc_html__("Month to display on calendar by default", 'trx_utils'),
                    "admin_label" => true,
                    "class" => "",
                    "std" => date("m"),
                    "value" => date("m"),
                    "type" => "textfield"
                )
            )
        ) );

        class WPBakeryShortCode_Booked_Calendar extends Yacht_Rental_VC_ShortCodeSingle {}

    }
}