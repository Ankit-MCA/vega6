<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $this->load->view('register');
    }

    public function register() {
        // Form validation rules
        $this->form_validation->set_rules('name', 'Name', 'required|alpha');
		$this->form_validation->set_rules('email', 'Email Id', 'required|valid_email|is_unique[users.Email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|min_length[6]|matches[password]');
		$this->form_validation->set_message('is_unique', 'This email already exists.');

        $upload="";
        $config = array('upload_path' =>'./images/', 
              'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE    
              );
            $this->load->library('upload',$config);
            if($this->upload->do_upload('picture'))
            {
            $user_image=$this->upload->data();
            $upload=$user_image['file_name'];              
            //echo "file upload success"; die;
            }
            else
            {
            $data['imageError']= $this->upload->display_errors();  
            } 
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, show registration form
            $this->load->view('register');
        } else {
            // Validation passed, register the user
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password_hint'=>$this->input->post('password'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'picture' => $upload, // Default picture if no file is uploaded
            );

            $result = $this->auth_model->register_user($data);

            if ($result) {
                $this->session->set_flashdata('success', 'Registration successful!');
            } else {
                $this->session->set_flashdata('error', 'Registration failed. Please try again.');
            }

            redirect('auth/register');
        }
    }

    public function login() {
        // Form validation rules
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, show login form
            $this->load->view('login');
        } else {
            // Validation passed, attempt login
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->auth_model->login_user($email, $password);

            if ($user) {
                // Set user session data
                $user_data = array(
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'picture' => $user->picture,
                );
                $this->session->set_userdata($user_data);

                $this->session->set_flashdata('success', 'Login successful!');
                redirect('auth/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password. Please try again.');
                redirect('auth/login');
            }
        }
    }

    public function dashboard() {
        // Check if the user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        // Load the dashboard view
        $this->load->view('dashboard');
    }


    public function profile() {
        // Check if the user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        $this->load->view('profile');
    }

    public function update_profile() {
        // Form validation rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email Id', 'required');
        $this->form_validation->set_rules('password', 'Password', 'trim');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, show profile form
            $this->load->view('profile');
        } else {
            // Validation passed, update user profile
            $user_id = $this->session->userdata('user_id');
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $password_hint = $this->input->post('password');

            $data = array(
                'name' => $name,
                'email' => $email,
                'password_hint' =>$password_hint
            );

            // Check if a new password is provided
            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            // Handle file upload for the profile picture
            $config['upload_path'] = './images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2048; // 2MB
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('picture')) {
                $data['picture'] = $this->upload->data('file_name');
            }

            $result = $this->auth_model->update_user($user_id, $data);

            if ($result) {
                $this->session->set_flashdata('profile_success', 'Profile updated successfully!');
            } else {
                $this->session->set_flashdata('profile_error', 'Failed to update profile. Please try again.');
            }

            redirect('auth/profile');
        }
    }

    public function search() {
        $this->load->view('search');
    }

    public function search_images() {
        // Get the search query for images
        $query = $this->input->post('search_query1');
    
        // Call the Pixabay API to get images
        $api_key = $this->config->item('pixabay_api_key');
        $url = "https://pixabay.com/api/?key=$api_key&q=$query&image_type=photo";
        
        $response = file_get_contents($url);
        $data['images'] = json_decode($response, true);
    
        $this->load->view('search', $data);
    }
    
    public function search_media() {
        // Get the search query for videos
        $query = $this->input->post('search_query');
    
        // Call the Pixabay API to get videos
        $api_key = $this->config->item('pixabay_api_key');
        $url = "https://pixabay.com/api/videos/?key=$api_key&q=$query";
        
        $response = file_get_contents($url);
        $data['videos'] = json_decode($response, true);
    
        $this->load->view('search', $data);
    }
    
    

    public function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Logout successful!');
        redirect('auth/login');
    }

}
