<?php
namespace App\Controllers;

use App\Models\M_model;

class Home extends BaseController
{
    public function index()
    {
        echo view('header');
        echo view('landingpage');
        echo view('footer');
    }
    public function promosi()
    {
        echo view('header');
        echo view('promosi');
        echo view('footer');
    }

    public function tentang()
    {
        echo view('header');
        echo view('tentang');
        echo view('footer');
    }
    public function login()
    {
        echo view('header');
        echo view('login');
        echo view('footer');
    }
    public function periksa()
    {
        echo view('header');
        echo view('periksalebihlanjut');
        echo view('footer');
    }
    public function dashboard()
    {
        echo view('header');
        echo view('menuutama');
        echo view('dashboard');
        echo view('footer');
    }
    public function reset($id)
    {
        $model = new M_model();
        $where = array('id_user' => $id);
        $user = array('password' => 'aaaa');
        $model->qedit('user', $user, $where);
        echo view('header');
        echo view('menuutama');
        echo view('footer');
        return redirect()->to('/Home/user');
    }

    public function aksi_login()
    {
        // Verify reCAPTCHA
        $recaptchaSecretKey = '6LcRiRYoAAAAALFQAFqA-ibR7AZeTY4PbeWuYLn2'; // Replace with your actual secret key
        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');

        $verificationUrl = "https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse";
        $recaptchaResponseData = json_decode(file_get_contents($verificationUrl));

        if (!$recaptchaResponseData->success) {
            // reCAPTCHA verification failed
            // You can handle this by showing an error message to the user
            return redirect()->to('/Home')->with('error', 'reCAPTCHA verification failed. Please try again.');
        }

        // Continue with your login logic
        $u = $this->request->getPost('username');
        $p = $this->request->getPost('password');
        $model = new M_model();
        $data = array(
            'username' => $u,
            'password' => md5($p),
            'status' => 'Active'
        );
        $cek = $model->getWhere2('user', $data);

        if ($cek > 0) {
            session()->set('id', $cek['id_user']);
            session()->set('username', $cek['username']);
            session()->set('email', $cek['email']);
            session()->set('level', $cek['level']);
            return redirect()->to('dashboard');
        } else {
            // Tambahkan kode berikut
            session()->setFlashdata('error', 'Salah password');
            return redirect()->to('/Home/login');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/Home');
    }
    // public function user()
    // {
    //     if (session()->get('level') == 1 || session()->get('level') == 2) {
    //         $model = new M_model();
    //         $on = 'user.level=level.id_level';
    //         $data['vuser'] = $model->join2('user', 'level', $on);
    //         echo view('header');
    //         echo view('menuutama');
    //         echo view('data_user', $data);
    //         echo view('footer');
    //     }

    public function anggota()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_model();
            $on = 'anggota.id_anggota_user=user.id_user';
            // $on1 = 'data_murid.lombaa=data_lomba.id_lomba';
            $data['vanggota'] = $model->join2('anggota', 'user', $on);
            echo view('header');
            echo view('menuutama');
            echo view('anggota', $data);
            echo view('footer');
        }
    }
    public function register()
    {
        $model = new M_model();

        $data['anggota'] = $model->tampil('anggota');
        echo view('header');
        echo view('menuutama');
        echo view('tambah_anggota', $data);
        echo view('footer');
    }
    public function aksi_tambahanggota()
    {
        $model = new M_model();
        // $on='guru.user = user.id_user';
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $alamat = $this->request->getPost('alamat');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $tmp_lhr = $this->request->getPost('tmp_lhr');
        $email = $this->request->getPost('email');
        $no_tlp = $this->request->getPost('no_tlp');
        $level = $this->request->getPost('level');
        $j_kel = $this->request->getPost('j_kel');

        $user = array(
            'username' => $username,
            'password' => md5('password'),
            'email' => $email,
            'level' => '2'
        );

        $model = new M_model();
        $model->simpan('user', $user);

        // Mendapatkan nilai id_user dari tabel user
        $where = array('username' => $username);
        $id = $model->getWhere2('user', $where);
        $id_user = $id['id_user'];

        // Tambahkan data ke tabel anggota
        $anggota = array(
            'id_anggota_user' => $id_user,
            'nama' => $username,
            'alamat' => $alamat,
            'tgl_lahir' => $tgl_lahir,
            'tmp_lhr' => $tmp_lhr,
            'j_kel' => $j_kel,
            'no_tlp' => $no_tlp,
            'status' => 'Active'
        );
        // print_r($user);
        // print_r($anggota);
        // print_r($user);
        $model->simpan('anggota', $anggota);
        return redirect()->to('/home/login');
    }
    public function hapusanggota($id)
    {
        $model = new M_model();

        // Kondisi untuk menghapus data dari tabel 'anggota'
        $where1 = array('id_anggota_user' => $id);
        $model->hapus('anggota', $where1);

        // Kondisi untuk menghapus data dari tabel 'user'
        $where2 = array('id_user' => $id);
        $model->hapus('user', $where2);

        return redirect()->to(base_url('/home/anggota'));
    }
    public function editanggota($id)
    {
        if (session()->get('level') == 1) {

            $model = new M_model();
            $on = 'anggota.id_anggota_user=user.id_user';
            $where = array(
                'id_anggota_user' => $id
            );
            $data['anggota'] = $model->joinW('anggota', 'user', $on, $where);
            echo view('header');
            echo view('menuutama');
            echo view('editanggota', $data);
            echo view('footer');

        } else {
            return redirect()->to('/home/dashboard');
        }
    }
    public function aksi_editanggota()
    {
        $model = new M_model();
        // $on='guru.user = user.id_user';
        $id = $this->request->getPost('id');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $alamat = $this->request->getPost('alamat');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $tmp_lhr = $this->request->getPost('tmp_lhr');
        $email = $this->request->getPost('email');
        $no_tlp = $this->request->getPost('no_tlp');
        $level = $this->request->getPost('level');
        $j_kel = $this->request->getPost('j_kel');

        $where = array('id_user' => $id);
        $data1 = array(
            'username' => $username,
            'email' => $email,
            'password' => md5($password)
        );
        $model = new M_model();
        $model->qedit('user', $data1, $where);
        $where2 = array('id_anggota_user' => $id);
        $data2 = array(
            'nama' => $username,
            'alamat' => $alamat,
            'tgl_lahir' => $tgl_lahir,
            'tmp_lhr' => $tmp_lhr,
            'j_kel' => $j_kel,
            'no_tlp' => $no_tlp
        );
        //    print_r($id);
        // //  print_r($data2);
        $model->qedit('anggota', $data2, $where2);
        return redirect()->to('/home/anggota/');
    }
    public function petugas()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_model();
            $on = 'petugas.id_petugas_user=user.id_user';
            // $on1 = 'data_murid.lombaa=data_lomba.id_lomba';
            $data['vpetugas'] = $model->join2('petugas', 'user', $on);
            echo view('header');
            echo view('menuutama');
            echo view('petugas', $data);
            echo view('footer');
        }
    }
    public function tambahpetugas()
    {
        $model = new M_model();

        $data['petugas'] = $model->tampil('petugas');
        echo view('header');
        echo view('menuutama');
        echo view('tambah_petugas', $data);
        echo view('footer');
    }
    public function aksi_tambahpetugas()
    {
        $model = new M_model();
        // $on='guru.user = user.id_user';
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $alamat = $this->request->getPost('alamat');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $tmp_lahir = $this->request->getPost('tmp_lahir');
        $email = $this->request->getPost('email');
        $no_tlp = $this->request->getPost('no_tlp');
        $level = $this->request->getPost('level');
        $j_kel = $this->request->getPost('j_kel');

        $user = array(
            'username' => $username,
            'password' => md5('password'),
            'email' => $email,
            'level' => '3'
        );

        $model = new M_model();
        $model->simpan('user', $user);

        // Mendapatkan nilai id_user dari tabel user
        $where = array('username' => $username);
        $id = $model->getWhere2('user', $where);
        $id_user = $id['id_user'];

        // Tambahkan data ke tabel petugas
        $petugas = array(
            'id_petugas_user' => $id_user,
            'nama' => $username,
            'alamat' => $alamat,
            'tgl_lahir' => $tgl_lahir,
            'tmp_lahir' => $tmp_lahir,
            'j_kel' => $j_kel,
            'no_tlp' => $no_tlp
        );
        // print_r($user);
        // print_r($petugas);
        $model->simpan('petugas', $petugas);
        return redirect()->to('/home/petugas');
    }
    public function hapuspetugas($id)
    {
        $model = new M_model();

        // Kondisi untuk menghapus data dari tabel 'anggota'
        $where1 = array('id_petugas_user' => $id);
        $model->hapus('petugas', $where1);

        // Kondisi untuk menghapus data dari tabel 'user'
        $where2 = array('id_user' => $id);
        $model->hapus('user', $where2);

        return redirect()->to(base_url('/home/petugas'));
    }
}