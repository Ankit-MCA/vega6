<?php
class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function register_user($data) {
        // Insert user data into the database
        return $this->db->insert('users', $data);
    }

    public function login_user($email, $password) {
        // Get user data based on email
        $query = $this->db->get_where('users', array('email' => $email));

        if ($query->num_rows() == 1) {
            $user = $query->row();

            // Verify password
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }

        return false;
    }

    public function get_user($user_id) {
        // Code for retrieving user data
        // ...
    }

    public function update_user($user_id, $data) {
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }
}
?>
