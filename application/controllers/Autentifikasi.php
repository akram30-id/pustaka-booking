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

        public function blok()
        {
            $this->load->view('autentifikasi/blok');
        }

        public function gagal()
        {
            $this->load->view('autentifikasi/gagal');
        }

        public function registrasi()
        {
            if($this->session->userdata('email')){
                redirect('user');
            }

            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', [
                'required' => 'Nama Belum diisi'
            ]);
            $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required', [
                'required' => 'Alamat Belum diisi'
            ]);
            $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[user.email]', [
                'valid_email' => 'Email tidak benar',
                'required' => 'Nama Belum diisi',
                'is_unique' => 'Email sudah terdaftar',
            ]);
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
                'matches' => 'Password tidak sama',
                'min_length' => 'Password terlalu pendek',
            ]);
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password1]');

            if($this->form_validation->run() == false){
                $data['judul'] = 'Registrasi Member';
                $this->load->view('autentifikasi/header', $data);
                $this->load->view('autentifikasi/registrasi');
                $this->load->view('autentifikasi/footer');
            } else {
                $email = $this->input->post('email', true);
                $alamat = html_escape($this->input->post('alamat'));
                $data = [
                    'nama' => htmlspecialchars($this->input->post('nama', true)),
                    'alamat' => $alamat,
                    'email' => htmlspecialchars($email),
                    'image' => 'default.jpg',
                    'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                    'role_id' => 1,
                    'is_active' => 1,
                    'tanggal_input' => date('Y-m-d')
                ];

                $this->ModelUser->simpanData($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Selamat!! Akun member anda sudah dibuat. Silahkan aktivasi akun anda.</div>');
                redirect('autentifikasi');
            }
        }

        public function logout()
        {
            $this->session->sess_destroy();

            redirect('autentifikasi');
        }

    }

?>