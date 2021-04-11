<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public $this;

    function __construct() {
        parent::__construct();
        $output = new stdClass();
        $this->load->model('Users_Model', 'usermodel');
    }

    /**
     * Method to load welcome page for web application
     * @return load home page of web application 
     * @author Pallavi
     * @date 08-April-2021
     */
    public function index() {
        load_view($header = 'layout/header/header', 'layout/content/body/body', 'login/login', $footer = 'layout/footer/footer', 'GBIM', 'Breadcrumb', 'Lects see');
    }

    public function process() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $errors = validation_errors();
                echo json_encode(['error' => $errors]);
            } else {
                //fetch user, set token and return user
                $user = new Users_Model();
                $user->email = $this->input->post('email');
                $user->password = $this->input->post('password');
                $ret_user = $this->usermodel->fetch_single_by_email($user);
                if (!empty($ret_user)) {
                    $token = generate_token($ret_user->email);
                    $users = array(
                        'first_name' => $ret_user->first_name,
                        'email' => $ret_user->email,
                        'token' => $token,
                        'token_type' => 'bearer',
                        'logged_in' => TRUE
                    );

                    $this->session->set_userdata($users);
                    echo json_encode(['success' => 'done', 'data' => $users, 'goto' => 'user']);
                } else {
                    echo json_encode(['error' => 'User not found']);
                }
            }
        }
    }

}
