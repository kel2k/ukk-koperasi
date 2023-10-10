<?php
namespace App\Controllers;

use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3) {
            echo view('header');
            echo view('menuutama');
            echo view('dashboard');
            echo view('footer');
        }
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
        // echo view('menuutama');
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
            'level' => '2',
            'status' => 'Active'
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
            'no_tlp' => $no_tlp
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
            'level' => '3',
            'status' => 'Active'
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
            'no_tlp' => $no_tlp,

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
    public function editpetugas($id)
    {
        if (session()->get('level') == 1) {

            $model = new M_model();
            $on = 'petugas.id_petugas_user=user.id_user';
            $where = array(
                'id_petugas_user' => $id
            );
            $data['petugas'] = $model->joinW('petugas', 'user', $on, $where);
            echo view('header');
            echo view('menuutama');
            echo view('editpetugas', $data);
            echo view('footer');

        } else {
            return redirect()->to('/home/dashboard');
        }
    }
    public function aksi_editpetugas()
    {
        $model = new M_model();
        ;
        $id = $this->request->getPost('id');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $alamat = $this->request->getPost('alamat');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $tmp_lahir = $this->request->getPost('tmp_lahir');
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
        $where2 = array('id_petugas_user' => $id);
        $data2 = array(
            'nama' => $username,
            'alamat' => $alamat,
            'tgl_lahir' => $tgl_lahir,
            'tmp_lahir' => $tmp_lahir,
            'j_kel' => $j_kel,
            'no_tlp' => $no_tlp
        );
        //    print_r($id);
        // //  print_r($data2);
        $model->qedit('petugas', $data2, $where2);
        return redirect()->to('/home/petugas/');
    }
    public function aksi_editstatus1($id)
    {
        $model = new M_model();
        $where = array('id_user' => $id);
        $data1 = array(
            'status' => 'Active'
        );
        $model = new M_model();
        $model->qedit('user', $data1, $where);
        return redirect()->to('/home/anggota/');
    }
    public function aksi_editstatus2($id)
    {
        $model = new M_model();
        $where = array('id_user' => $id);
        $data1 = array(
            'status' => 'Inactive'
        );
        $model = new M_model();
        $model->qedit('user', $data1, $where);
        return redirect()->to('/home/anggota/');
    }
    public function pinjaman()
    {
        $model = new M_model();
        $on = 'pinjaman.id_anggota_pinjaman=user.id_user';
        $data['vpinjaman'] = $model->join2('pinjaman', 'user', $on);
        echo view('header');
        echo view('menuutama');
        echo view('pinjaman', $data);
        echo view('footer');
    }
    public function hapuspinjaman($id)
    {
        $model = new M_model();

        // Kondisi untuk menghapus data dari tabel 'anggota'
        $where1 = array('id_pinjaman' => $id);
        $model->hapus('pinjaman', $where1);

        return redirect()->to(base_url('/home/pinjaman'));
    }
    public function tambahpinjaman()
    {
        $model = new M_model();

        $data['pinjaman'] = $model->tampil('pinjaman');
        echo view('header');
        echo view('menuutama');
        echo view('tambah_pinjam', $data);
        echo view('footer');
    }

    public function aksi_editstatus3($id)
    {
        $model = new M_model();
        $where = array('id_pinjaman' => $id);
        $data1 = array(
            'status_pinjaman' => 'Approved'
        );
        $model = new M_model();
        $model->qedit('pinjaman', $data1, $where);
        return redirect()->to('/home/pinjaman/');
    }
    public function aksi_editstatus4($id)
    {
        $model = new M_model();
        $where = array('id_pinjaman' => $id);
        $data1 = array(
            'status_pinjaman' => 'Not Approved'
        );
        $model = new M_model();
        $model->qedit('pinjaman', $data1, $where);
        return redirect()->to('/home/pinjaman/');
    }
    public function angsuran()
    {
        $model = new M_model();
        $on = 'angsuran.id_angsuran_user=user.id_user';
        $data['vangsuran'] = $model->join2('angsuran', 'user', $on);
        echo view('header');
        echo view('menuutama');
        echo view('angsuran', $data);
        echo view('footer');
    }
    public function tambahangsuran()
    {
        $model = new M_model();

        $data['angsuran'] = $model->tampil('angsuran');
        echo view('header');
        echo view('menuutama');
        echo view('tambah_angsuran', $data);
        echo view('footer');
    }
    public function aksi_tambahangsuran()
    {
        $model = new M_model();

        // Mengambil username dari Session
        $session = session();
        $username = $session->get('username');
        $tgl_pembayaran = $this->request->getPost('tgl_pembayaran');
        $besar_angsuran = $this->request->getPost('besar_angsuran');
        $kategori_pinjaman = $this->request->getPost('kategori_pinjaman');

        $where = array('username' => $username);
        $id = $model->getWhere2('user', $where);
        $id_user = $id['id_user'];

        $angsuran = array(
            'id_angsuran_user' => $id_user,
            'username' => $username,
            'tgl_pembayaran' => $tgl_pembayaran,
            'besar_angsuran' => $besar_angsuran,
            'kategori_pinjaman' => $kategori_pinjaman,
            'status_angsuran' => 'Not Approved'
        );
        // print_r($angsuran);
        $model->simpan('angsuran', $angsuran);
        return redirect()->to('/home/angsuran');
    }
    public function aksi_tambahpinjaman()
    {
        $model = new M_model();

        // Mengambil username dari Session
        $session = session();
        $username = $session->get('username');

        $besar_pinjaman = $this->request->getPost('besar_pinjaman');
        $tgl_pelunasan = $this->request->getPost('tgl_pelunasan');
        $where = array('username' => $username);
        $id = $model->getWhere2('user', $where);
        $id_user = $id['id_user'];

        $pinjaman = array(
            'id_anggota_pinjaman' => $id_user,
            'username' => $username,
            // Kolom username akan terisi otomatis sesuai dengan pengguna yang sudah login.
            'besar_pinjaman' => $besar_pinjaman,
            'tgl_pelunasan' => $tgl_pelunasan,
            'status_pinjaman' => 'Not Approved'
        );

        $model->simpan('pinjaman', $pinjaman);
        return redirect()->to('/home/pinjaman');
    }
    public function aksi_editstatus5($id)
    {
        $model = new M_model();
        $where = array('id_angsuran' => $id);
        $data1 = array(
            'status_angsuran' => 'Approved'
        );
        $model = new M_model();
        $model->qedit('angsuran', $data1, $where);
        return redirect()->to('/home/angsuran/');
    }
    public function aksi_editstatus6($id)
    {
        $model = new M_model();
        $where = array('id_angsuran' => $id);
        $data1 = array(
            'status_angsuran' => 'Not Approved'
        );
        $model = new M_model();
        $model->qedit('angsuran', $data1, $where);
        return redirect()->to('/home/angsuran/');
    }
    public function hapusangsuran($id)
    {
        $model = new M_model();

        // Kondisi untuk menghapus data dari tabel 'anggota'
        $where1 = array('id_angsuran' => $id);
        $model->hapus('angsuran', $where1);

        return redirect()->to(base_url('/home/angsuran'));
    }
    public function simpanan()
    {
        $model = new M_model();
        $on = 'simpanan.id_simpanan_user=user.id_user';
        $data['vsimpanan'] = $model->join2('simpanan', 'user', $on);
        echo view('header');
        echo view('menuutama');
        echo view('simpanan', $data);
        echo view('footer');
    }
    public function tambahsimpanan()
    {
        $model = new M_model();

        $data['simpanan'] = $model->tampil('simpanan');
        echo view('header');
        echo view('menuutama');
        echo view('tambah_simpanan', $data);
        echo view('footer');
    }
    public function aksi_tambahsimpanan()
    {
        $model = new M_model();

        // Mengambil username dari Session
        $session = session();
        $username = $session->get('username');
        // $tgl_simpanan = $this->request->getPost('tgl_simpanan');
        $besar_simpanan = $this->request->getPost('besar_simpanan');

        $where = array('username' => $username);
        $id = $model->getWhere2('user', $where);
        $id_user = $id['id_user'];

        $simpanan = array(
            'id_simpanan_user' => $id_user,
            'username' => $username,
            // 'tgl_simpanan' => $tgl_simpanan,
            'besar_simpanan' => $besar_simpanan
        );
        // print_r($angsuran);
        $model->simpan('simpanan', $simpanan);
        return redirect()->to('/home/simpanan');
    }
    public function hapussimpanan($id)
    {
        $model = new M_model();

        // Kondisi untuk menghapus data dari tabel 'anggota'
        $where1 = array('id_simpanan' => $id);
        $model->hapus('simpanan', $where1);

        return redirect()->to(base_url('/home/simpanan'));
    }
    public function export_pdf1()
    {
        $model = new M_model();

        // Get data absensi kantor berdasarkan filter
        $data['pinjaman'] = $model->getAllData();

        // Load the dompdf library
        $dompdf = new Dompdf();

        // Set the HTML content for the PDF
        $data['title'] = 'Laporan Pinjaman';
        $dompdf->loadHtml(view('pdfpinjaman', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporanpinjaman.pdf', ['Attachment' => 0]);
    }
    public function export_pdf2()
    {
        $model = new M_model();

        // Get data absensi kantor berdasarkan filter
        $data['angsuran'] = $model->getAllData1();

        // Load the dompdf library
        $dompdf = new Dompdf();

        // Set the HTML content for the PDF
        $data['title'] = 'Laporan Angsuran';
        $dompdf->loadHtml(view('pdfangsuran', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporanangsuran.pdf', ['Attachment' => 0]);
    }
    public function export_excel1()
    {
        $model = new M_model();

        $pinjaman = $model->GetAllData();

        $spreadsheet = new Spreadsheet();

        // Get the active worksheet and set the default row height for header row
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getDefaultRowDimension()->setRowHeight(20);

        // Set the title and period in merged cells
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'Laporan Pinjaman');
        $sheet->mergeCells('A3:D3');
        // $sheet->setCellValue('A3', 'Periode: ' . $awal . ' - ' . $akhir);

        // Set the header row values
        $sheet->setCellValueByColumnAndRow(1, 4, 'No');
        $sheet->setCellValueByColumnAndRow(2, 4, 'Nama Anggota');
        $sheet->setCellValueByColumnAndRow(3, 4, 'Besar Pinjaman');
        $sheet->setCellValueByColumnAndRow(4, 4, 'Tanggal Pinjaman');


        // Fill the data into the worksheet
        $row = 5;
        $no = 1;
        foreach ($pinjaman as $riz) {
            $sheet->setCellValueByColumnAndRow(1, $row, $no++);
            $sheet->setCellValueByColumnAndRow(2, $row, $riz['username']);
            $sheet->setCellValueByColumnAndRow(3, $row, $riz['besar_pinjaman']);
            $sheet->setCellValueByColumnAndRow(4, $row, date('d F Y', strtotime($riz['tgl_pinjaman'])));

            // Apply background color based on the value of "Keterangan"
            $row++;
        }

        // Apply the Excel styling
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
        $sheet->getStyle('A3')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $lastRow = count($pinjaman) + 4; // Add 4 for the header rows
        $sheet->getStyle('A4:E' . $lastRow)->applyFromArray($styleArray);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);

        // Create the Excel writer and save the file
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_pinjaman.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    public function export_excel2()
    {
        $model = new M_model();

        $angsuran = $model->GetAllData1();

        $spreadsheet = new Spreadsheet();

        // Get the active worksheet and set the default row height for header row
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getDefaultRowDimension()->setRowHeight(20);

        // Set the title and period in merged cells
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'Laporan Angsuran');
        $sheet->mergeCells('A3:D3');
        // $sheet->setCellValue('A3', 'Periode: ' . $awal . ' - ' . $akhir);

        // Set the header row values
        $sheet->setCellValueByColumnAndRow(1, 4, 'No');
        $sheet->setCellValueByColumnAndRow(2, 4, 'Nama Anggota');
        $sheet->setCellValueByColumnAndRow(3, 4, 'Tanggal Pembayaran');
        $sheet->setCellValueByColumnAndRow(4, 4, 'Besar Angsuran');
        $sheet->setCellValueByColumnAndRow(5, 4, 'Kategori Pinjaman');


        // Fill the data into the worksheet
        $row = 5;
        $no = 1;
        foreach ($angsuran as $riz) {
            $sheet->setCellValueByColumnAndRow(1, $row, $no++);
            $sheet->setCellValueByColumnAndRow(2, $row, $riz['username']);
            $sheet->setCellValueByColumnAndRow(3, $row, date('d F Y', strtotime($riz['tgl_pembayaran'])));
            $sheet->setCellValueByColumnAndRow(4, $row, $riz['besar_angsuran']);
            $sheet->setCellValueByColumnAndRow(5, $row, $riz['kategori_pinjaman']);

            // Apply background color based on the value of "Keterangan"
            $row++;
        }

        // Apply the Excel styling
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
        $sheet->getStyle('A3')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $lastRow = count($angsuran) + 4; // Add 4 for the header rows
        $sheet->getStyle('A4:E' . $lastRow)->applyFromArray($styleArray);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);

        // Create the Excel writer and save the file
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_angsuran.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    public function export_pdf3()
    {
        $model = new M_model();

        // Get data absensi kantor berdasarkan filter
        $data['simpanan'] = $model->getAllData2();

        // Load the dompdf library
        $dompdf = new Dompdf();

        // Set the HTML content for the PDF
        $data['title'] = 'Laporan Simpanan';
        $dompdf->loadHtml(view('pdfsimpanan', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporanpinjaman.pdf', ['Attachment' => 0]);
    }
    public function export_excel3()
    {
        $model = new M_model();

        $simpanan = $model->GetAllData2();

        $spreadsheet = new Spreadsheet();

        // Get the active worksheet and set the default row height for header row
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getDefaultRowDimension()->setRowHeight(20);

        // Set the title and period in merged cells
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'Laporan Simpanan');
        $sheet->mergeCells('A3:D3');
        // $sheet->setCellValue('A3', 'Periode: ' . $awal . ' - ' . $akhir);

        // Set the header row values
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Nama Anggota');
        $sheet->setCellValue('C4', 'Tanggal Simpanan');
        $sheet->setCellValue('D4', 'Besar Simpanan');

        // Fill the data into the worksheet
        $row = 5; // Mulai dari baris 5, setelah header
        $no = 1;
        foreach ($simpanan as $riz) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $riz['username']);
            $sheet->setCellValue('C' . $row, date('d F Y', strtotime($riz['tgl_simpanan'])));
            $sheet->setCellValue('D' . $row, $riz['besar_simpanan']);

            // Apply background color based on the value of "Keterangan"
            $row++;
        }

        // Apply the Excel styling
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
        $sheet->getStyle('A3')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $lastRow = count($simpanan) + 4; // Add 4 for the header rows
        $sheet->getStyle('A4:D' . $lastRow)->applyFromArray($styleArray);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);

        // Create the Excel writer and save the file
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_simpanan.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}