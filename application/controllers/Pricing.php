<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pricing extends CI_Controller {
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
        $this->output->banner_header = 'Pricing';
        $this->output->banner_shotdesc = 'Lorem Ipsum Dolroin Gravida Nibh Vel Velit.';
        load_view($header = 'layout/header/header', 'layout/content/body/body', 'pricing/main_content', $footer = 'layout/footer/footer', 'Pricing - Hosting Site', 'Pallavi', $this->output);
    }

}