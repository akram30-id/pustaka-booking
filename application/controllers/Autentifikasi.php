<?php 

    class Autentifikasi extends CI_Controller{

        function __construct()
        {
            parent::__construct();
            $this->load->model('ModelUser');
        }

        public function index()
        {
            if($this->session->userdata('email')){
                redirect('admin');
            }

            $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email', [
                'required' => 'Email harus diisi',
                'valid_email' => 'Email tidak benar'
            ]);

            $this->form_validation->set_rules('password', 'Password', 'required|trim', [
                'required' => 'Password harus diisi'
            ]);

            if($this->form_validation->run() == false){
                $data['judul'] = 'Login';
                $data['user'] = '';

                $this->load->view('autentifikasi/header', $data);
                $this->load->view('autentifikasi/login');
                $this->load->view('autentifikasi/footer');
            } else {
                $this->_login();
            }
        }

        private function _login()
        {
            $email = htmlspecialchars($this->input->post('email', true));
            $password = html_escape($this->input->post('password', true));
            $user = $this->ModelUser->cekData(['email'=>$email])->row_array();

            if($user){
                if($user['is_active'] == 1){
                    if(password_verify($password, $user['password'])){
                        $data = [
                            'email' => $user['email'],
                            'role_id' => $user['role_id']
                        ];

                        $this->session->set_userdata($data);
                        redirect('admin');
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password salah</div>');
                        redirect('autentifikasi');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">User belum diaktivasi</div>');
                    redirect('autentifikasi');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar</div>');
                redirect('autentifikasi');
            }
        }

    }

?>