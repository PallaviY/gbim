<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hosting extends CI_Controller {
    public $this;
    function __construct()
    {
        parent::__construct();
        $output = new stdClass();
    }
    /**
     * Method to load welcome page for web application
     * @return load home page of web application 
     * @author IT Support Developers
     * @date 04-April-2021
     */
    public function index() {      
        $this->output->banner_header = 'WEB HOSTING';
        $this->output->banner_shotdesc = 'Fully cloud based shared web hosting with cPanel! <br/> Special Offer $0.99/mo';
        load_view($header = 'layout/header/header', 'layout/content/body/body', 'hosting/main_content', $footer = 'layout/footer/footer', 'Hosting - Hosting Site', 'Pallavi', $this->output);
    }

}