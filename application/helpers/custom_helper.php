<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Method to get assets url to load assets files
 * @return assets url
 * @author Pallavi
 * @date 08-April-2021
 */
if (!function_exists('assets_url')) {

    function assets_url() {
        return base_url() . 'assets/';
    }

}
/**
 * Method to debug code
 * @return code in well format
 * @author Pallavi
 * @date 08-April-2021
 */
if (!function_exists('debug')) {

    function debug($value) {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
        exit();
    }

}
/**
 * Method to load ci instance
 * @return instance of ci
 * @author Pallavi
 * @date 08-April-2021
 */
if (!function_exists('load_instance')) {

    function load_instance() {
        $CI = & get_instance();
        return $CI;
    }

}
/**
 * Method to get output class
 * @return object of std class
 * @author Pallavi
 * @date 08-April-2021
 */
if (!function_exists('load_output_')) {

    function load_output_() {
        $output = new stdClass();
        return $output;
    }

}
/**
 * Method to load view
 * @return load view file for controller
 * @author Pallavi
 * @date 08-April-2021
 */
if (!function_exists('load_view')) {

    function load_view($header, $body, $content, $footer, $title, $breadcrumb = 'IT Support', $data = '') {       
        $CI = load_instance();
        $output = load_output_();

        if (!is_file(APPPATH . '/views/' . $body . '.php')) {
            $CI->output->heading = 'Page Not Found';
            $CI->output->message = "Whoops, we don't have a page for that!";
            $CI->load->view('errors/html/error_404', $CI->output);
        } else {

            if (!empty($title))
                $CI->output->title = ucfirst($title);

            $CI->output->bredcrumb = $breadcrumb;

            if (!empty($data))
                $CI->output->data = $data;

            if (!empty($header))
                $CI->load->view($header, $CI->output);
            
            if(!empty($content))
                $CI->output->main_content = $content;
            
            $CI->load->view($body, $CI->output);

            if (!empty($footer))
                $CI->load->view($footer, $CI->output);
        }
    }

}
/**
 * Method to append active class to menu
 * @return class active
 * @author Pallavi
 * @date 08-April-2021
 */
if(!function_exists('activate_menu')) {
  function activate_menu($controller) { 
    $ci = get_instance();
    $class = $ci->router->fetch_class();    
    echo ($class == $controller) ? 'active' : '';
  }
}
/**
 * Method to generate token
 * @return token
 * @author Pallavi
 * @date 08-April-2021
 */
if(!function_exists('generate_token')) {
  function generate_token($str) { 
    $ci = get_instance();
    $token = do_hash($str, 'SHA1');
    return $token;
  }
}