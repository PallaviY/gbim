<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public $this;

    function __construct() {
        parent::__construct();
        $output = new stdClass();
        $this->load->model('Users_Model', 'usermodel');
    }

    /**
     * Method to load user view
     * @return load home page of web application 
     * @author Pallavi
     * @date 08-April-2021
     */
    public function index() {
        load_view($header = 'layout/header/header', 'layout/content/body/body', 'user/list', $footer = 'layout/footer/footer', 'GBIM', 'Breadcrumb', 'Lects see');
    }

    /**
     * Method to load user view
     * @return load home page of web application 
     * @author Pallavi
     * @date 08-April-2021
     */
    public function list() {
        if ($this->input->post('token')) {
            $users = $this->usermodel->fetch_all();
            $output = '';
            if (!empty($users)) {
                $i=1;
                foreach ($users as $user) {
                    $output .= '<tr>'
                            . '<td>' . $i . '</td>'
                            . '<td>' . $user->first_name . '</td>'
                            . '<td>' . $user->last_name . '</td>'
                            . '<td>' . $user->email . '</td>'
                            . '<td>' . $user->role . '</td>'
                            . '<td>' . $user->created_at . '</td>'
                            . '<td>' . $user->updated_at . '</td>'
                            . '<td><a href="' . base_url() . 'user/edit/' . $user->id . '"><button type="button" class="btn btn-warning btn-xs edit" name="edit" id="' . $user->id . '">Edit</button></a></td>'
                            . '<td><button type="button" class="btn btn-danger btn-xs delete" name="delete" id="' . $user->id . '">Delete</button></td>'
                            . '</tr>';
                    $i++;
                }
            } else {
                $output .= '<tr><td colspan="4" align="center">No Data Found</td>'
                        . '</tr>';
            }
            if ($users) {
                echo json_encode(['success' => 'done', 'data' => $output, 'code' => 200]);
            } else {
                echo json_encode(['error' => 'Users not found', 'code' => 404]);
            }
        }
    }

    /**
     * Method to load welcome page for web application
     * @return load create new user view
     * @author Pallavi
     * @date 08-April-2021
     */
    public function add() {
        $this->output->user_roles = $this->usermodel->fetch_all_user_roles();
        load_view($header = 'layout/header/header', 'layout/content/body/body', 'user/add', $footer = 'layout/footer/footer', 'GBIM', 'Breadcrumb', $this->output);
    }

    public function store() {
        if ($this->input->post('token')) {
            if (!empty($this->input->post())) {

                $this->form_validation->set_rules('email', 'Email', 'is_unique[users.email]');
                $this->form_validation->set_rules('phone_number', 'Phone number', 'is_unique[users.phone_number]');

                if ($this->form_validation->run() == FALSE) {
                    $errors = validation_errors();
                    echo json_encode(['error' => $errors]);
                } else {
                    $user = new Users_Model();
                    $user->first_name = $this->input->post('first_name');
                    $user->last_name = $this->input->post('last_name');
                    $user->email = $this->input->post('email');
                    $user->password = $this->input->post('password');
                    $user->role_type = $this->input->post('role_type');
                    $user->phone_number = $this->input->post('phone_number');

                    $is_user = $this->usermodel->is_user_exists($user->email, $user->phone_number);
                    if (!empty($is_user)) {
                        echo json_encode(['error' => 'User already exists', 'code' => 404]);
                    } else {
                        $users = $this->usermodel->store($user);
                        if ($users) {
                            echo json_encode(['success' => 'User created successfully', 'code' => 200]);
                        } else {
                            echo json_encode(['error' => 'Erroo in creating user', 'code' => 404]);
                        }
                    }
                }
            }
        }
    }

    /**
     * Method to load welcome page for web application
     * @return load edit new user view
     * @author Pallavi
     * @date 08-April-2021
     */
    public function edit($id) {
        $this->output->user_roles = $this->usermodel->fetch_all_user_roles();
        $this->output->user = $this->usermodel->fetch_single_by_id($id);
        load_view($header = 'layout/header/header', 'layout/content/body/body', 'user/edit', $footer = 'layout/footer/footer', 'GBIM', 'Breadcrumb', $this->output);
    }

    public function update() {
        if ($this->input->post('token')) {
            $user = new Users_Model();
            $user->id = $this->input->post('user_id');
            $user->first_name = $this->input->post('first_name');
            $user->last_name = $this->input->post('last_name');
            $user->email = $this->input->post('email');
            $user->password = $this->input->post('password');
            $user->role_type = $this->input->post('role_type');
            $user->phone_number = $this->input->post('phone_number');

            $users = $this->usermodel->store($user);
            if ($users) {
                echo json_encode(['success' => 'User updated successfully', 'code' => 200]);
            } else {
                echo json_encode(['error' => 'Erroo in creating user', 'code' => 404]);
            }
        }
    }

    public function delete() {

        if ($this->input->post('token')) {
            $id = $this->input->post('user_id');
            $users = $this->usermodel->drop($id);
            if ($users) {
                echo json_encode(['success' => 'User deleted successfully', 'code' => 200]);
            } else {
                echo json_encode(['error' => 'Erroo in creating user', 'code' => 404]);
            }
        }
    }

}
