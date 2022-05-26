<?php

defined('BASEPATH') or exit('No direct script is allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('ModelUser');
    }

    public function index()
    {
        $data['judul'] = 'Profil Saya';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        // var_dump($data['user']);
        // die();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }

    public function anggota()
    {
        $data['judul'] = 'Data Anggota';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('role_id', 2);
        $data['anggota'] = $this->db->get('user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/anggota', $data);
        $this->load->view('templates/footer');
    }

    public function ubahProfil()
    {
        $data['judul'] = 'Data Anggota';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/ubah-profile', $data);
            $this->load->view('template/footer');
        } else {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');

            $upload_image = $_FILES['image']['name'];

            if($upload_image){
                $config['upload_path'] = FCPATH . 'assets/img/profile';
                $config['allowed_types'] ='gif|jpg|png';
                $config['max_size'] = 3000;
                $config['max_width'] = '1024';
                $config['max_height'] = '1000';
                $config['file_name'] ='pro' . time();

                $this->load->library('upload');
                $this->upload->initialize($config);
                $this->upload->data('file_name');

                if($this->upload->do_upload('image')){
                    $gambar_lama = $data['user']['image'];
                    if($gambar_lama != 'default.jpg'){
                        unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                    }

                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                }
            }
            // var_dump($upload_image);
            // die();
            $dataEdit = [
                'nama' => $nama,
                'email' => $email,
                'image' => $gambar_baru
            ];
            $this->db->where('email', $email);
            $this->db->update('user', $dataEdit);

            redirect('user');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Profil berhasil diubah</div>');
        }
    }

    public function ubahPassword()
    {
        $data['judul'] = 'Ubah Password';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('password_sekarang', 'Password saat ini', 'required|trim', [
            'required' => 'Password saat ini harus diisi'
        ]);

        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[4]|matches[password_baru2]', [
            'required' => 'Password baru harus diisi',
            'min_length' => 'Password baru tidak boleh kurag dari 4 digit',
            'matches' => 'Password baru tidak sama dengan konfirmasi password'
        ]);

        $this->form_validation->set_rules('password_baru2', 'Konfirmasi Password Baru', 'required|trim|min_length[4]|matches[password_baru2]', [
            'required' => 'Password baru harus diisi',
            'min_length' => 'Password baru tidak boleh kurag dari 4 digit',
            'matches' => 'Ulangi password tidak sama dengan password baru'
        ]);

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/ubah-password', $data);
            $this->load->view('templates/footer');   
        } else {
            $pwd_skrg = $this->input->post('password_sekarang', true);
            $pwd_baru = $this->input->post('password_baru1', true);
            if(!password_verify($pwd_skrg, $data['user']['password'])){
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password saat ini salah</div>');
                redirect('user/ubahPassword');
            } else {
                if($pwd_skrg == $pwd_baru)
                {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password baru tidak boleh sama dengan password saat ini</div>');
                } else {
                    $password_hash = password_hash($pwd_baru, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->set('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Password berhasil diubah</div>');
                    redirect('user/ubahPassword');
                }
            }
        }
    }
}
