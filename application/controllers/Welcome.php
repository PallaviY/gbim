<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Method to load welcome page for web application
     * @return load home page of web application 
     * @author Pallavi
     * @date 08-April-2021
     */
    public function index() {
        load_view($header = 'layout/header/header', 'layout/content/body/body', 'home/main_content' ,$footer = 'layout/footer/footer', 'GBIM', 'Breadcrumb', 'Lects see');
    }

}
