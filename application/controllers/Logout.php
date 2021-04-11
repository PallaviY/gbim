<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    /**
     * Method to load welcome page for web application
     * @return load home page of web application 
     * @author Pallavi
     * @date 08-April-2021
     */
    public function index() {
        $this->session->unset_userdata('user_token');
        load_view($header = 'layout/header/header', 'layout/content/body/body', 'login/login' ,$footer = 'layout/footer/footer', 'GBIM', 'Breadcrumb', 'Lects see');
    }

}
