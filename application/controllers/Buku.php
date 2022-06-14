<?php

class Buku extends CI_Controller
{

    public function index()
    {
        $data['judul'] = 'Data Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();
        $data['where'] = 'data_buku';

        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[3]', [
            'required' => 'Judul Buku Harus Diisi', 'min_length' => 'Judul Buku Terlalu Pendek'
        ]);

        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Kategori Buku Harus Diisi',
        ]);

        $this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]', [
            'required' => 'Nama Pengarang Harus Diisi',
            'min_length' => 'Nama Pengarang Terlalu Pendek'
        ]);

        $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [
            'required' => 'Nama Penerbit Harus Diisi',
            'min_length' => 'Nama Penerbit Terlalu Pendek'
        ]);

        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|min_length[3]', [
            'required' => 'Tahun Terbit Harus Diisi',
            'min_length' => 'Tahun Terbit Terlalu Pendek'
        ]);

        $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]', [
            'required' => 'Nomor ISBN Harus Diisi',
            'min_length' => 'Nomor ISBN Terlalu Pendek'
        ]);

        $this->form_validation->set_rules('stok', 'Stok', 'required', [
            'required' => 'Stok Harus Diisi',
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = FCPATH . 'assets/img/upload';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_sizes'] = '5000';
        $config['max_width'] = '2400';
        $config['max_height'] = '2400';
        $config['file_name'] = 'img' . time();

        $this->load->library('upload', $config);
        //jika salah input
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('buku/index', $data);
            $this->load->view('template/footer');
        } else { //jika ada gambar
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else { //jika gambar tidak diisi
                $gambar = '';
            }

            $data = [ //yang akan disimpan
                'judul_buku' => $this->input->post('judul_buku'),
                'id_kategori' => $this->input->post('id_kategori'),
                'pengarang' => $this->input->post('pengarang'),
                'penerbit' => $this->input->post('penerbit'),
                'tahun_terbit' => $this->input->post('tahun_terbit'),
                'isbn' => $this->input->post('isbn'),
                'stok' => $this->input->post('stok'),
                'dipinjam' => 0,
                'dibooking' => 0,
                'image' => $gambar,
            ];
            //eksekusi ke db
            $this->ModelBuku->simpanBuku($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Tambah Data Sukses</div>');
            redirect('buku');
        }
    }

    public function hapusBuku()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelBuku->hapusBuku($where);
        redirect('buku');
    }

    public function ubahBuku()
    {
        $data['judul'] = 'Data Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->ModelBuku->bukuWhere(['id' => $this->uri->segment(3)])->result_array();
        // $kategori = $this->ModelBuku->joinKategoriBuku(['buku.id' => $this->uri->segment(3)])->result_array();

        // foreach ($kategori as $k) {
        //     $data['id_kategori'] = $k['id_kategori'];
        //     $data['k'] = $k['kategori'];
        // }        
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();
        $data['where'] = 'data_buku';

        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[3]', [
            'required' => 'Judul Buku Harus Diisi', 'min_length' => 'Judul Buku Terlalu Pendek'
        ]);

        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Kategori Buku Harus Diisi',
        ]);

        $this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]', [
            'required' => 'Nama Pengarang Harus Diisi',
            'min_length' => 'Nama Pengarang Terlalu Pendek'
        ]);

        $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [
            'required' => 'Nama Penerbit Harus Diisi',
            'min_length' => 'Nama Penerbit Terlalu Pendek'
        ]);

        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|min_length[3]', [
            'required' => 'Tahun Terbit Harus Diisi',
            'min_length' => 'Tahun Terbit Terlalu Pendek'
        ]);

        $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]', [
            'required' => 'Nomor ISBN Harus Diisi',
            'min_length' => 'Nomor ISBN Terlalu Pendek'
        ]);

        $this->form_validation->set_rules('stok', 'Stok', 'required', [
            'required' => 'Stok Harus Diisi',
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = FCPATH . 'assets/img/upload';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_sizes'] = '5000';
        $config['max_width'] = '2400';
        $config['max_height'] = '2400';
        $config['file_name'] = 'img' . time();

        $this->load->library('upload', $config);
        //jika salah input
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('buku/index', $data);
            $this->load->view('template/footer');
        } else { //gambar baru
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                unlink('assets/img/upload/' . $this->input->post('old_pict'));
                $gambar = $image['file_name'];
            } else { //gambar lama
                $gambar = $this->input->post('old_pict');
            }

            $data = [ //yang akan disimpan
                'id' => $this->input->post('id'),
                'judul_buku' => $this->input->post('judul_buku'),
                'id_kategori' => $this->input->post('id_kategori'),
                'pengarang' => $this->input->post('pengarang'),
                'penerbit' => $this->input->post('penerbit'),
                'tahun_terbit' => $this->input->post('tahun_terbit'),
                'isbn' => $this->input->post('isbn'),
                'stok' => intval($this->input->post('stok')),
                'dipinjam' => intval($this->input->post('dipinjam')),
                'dibooking' => intval($this->input->post('dibooking')),
                'image' => $gambar,
            ];

            // var_dump($data);
            // die();
            //eksekusi ke db
            $this->ModelBuku->updateBuku($data, $this->input->post('id'));
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Ubah Data Sukses</div>');
            return redirect('buku');
        }
    }

    public function kategori()
    {
        $data['judul'] = 'Kategori Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();
        $data['where'] = 'kategori_buku';

        $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
            'required' => 'Judul Buku harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('buku/kategori', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'kategori' => $this->input->post('kategori')
            ];

            $this->ModelBuku->simpanKategori($data);
            redirect('buku/kategori');
        }
    }

    public function hapusKategori()
    {
        $where = ['id_kategori' => $this->uri->segment(3)];
        $this->ModelBuku->hapusKategori($where);
        redirect('buku/kategori');
    }

    public function ubahKategori()
    {
        $data['judul'] = 'Ubah Kategori';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $ata['kategori'] = $this->ModelBuku->kategoriWhere(['id_kategori' => $this->uri->segment(3)])->result_array();
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|min_length[3]', ['required' => 'Nama Kategoi Harus Diisi', 'min_length' => 'Nama Kategori Terlalu Pendek']);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('buku/kategori', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'kategori' => $this->input->post('kategori')
            ];
            $this->ModelBuku->updateKategori(['id_kategori' => $this->input->post('id_kategori')], $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Diubah</div>');
            redirect('buku/kategori');
        }
    }
}
