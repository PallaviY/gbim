<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Domain extends CI_Controller {
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
        $token = "05816cfa52ba8238451300cda2114151b948ce0e";
        $url = "https://api4.seranking.com/sites";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Token ' . $token,
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        $response = json_decode($result);
        $this->output->response = $response;
        load_view($header = 'layout/header/header', 'layout/content/body/body', 'domain/list', $footer = 'layout/footer/footer', 'GBIM', 'Breadcrumb', $this->output);
    }

}