<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tiflog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        // load model
        $this->load->model('M_user', 'user');
    }

    public function index()
    {
        if ($this->session->has_userdata('masuk_user')) {
            redirect("block");
        } else {
            $this->form_validation->set_rules(
                'username',
                'Username',
                'required|trim',
                [
                    "required" => "*Username harus diisi",
                ]
            );
            $this->form_validation->set_rules(
                'password',
                'Password',
                'required|trim',
                [
                    "required" => "*Password harus diisi"
                ]
            );
            if ($this->form_validation->run() == false) {
                $this->load->view('admin_portal/v_login');
            } else {
                $this->_login();
            }
        }
    }

    private function _login()
    {
        $username = $this->input->post("username", true);
        $password = $this->input->post("password", true);
        $user = $this->user->getDataByUsername($username);
        // pengecekan keaktifan akun 
        if ($user) {
            if (password_verify($password, $user->password)) {
                if ($user->status != 'aktif') {
                    $this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible" role="alert">
                        Akun Dinonaktifkan.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect("tiflog");
                } else {
                    // PEMBUATAN SESSION
                    $sesi = [
                        'id_user' => $user->id,
                        'username_user' => $user->username,
                        'password_user' => $user->password,
                        'level_user' => $user->level,
                        'prodi_user' => $user->prodi,
                        'jk_user' => $user->jk,
                        'status_user' => $user->status_user,
                        'nama_user' => $user->nama,
                        'foto_user' => $user->foto,
                        'masuk_user' => TRUE,
                    ];
                    $this->session->set_userdata($sesi);

                    if ($user->level == "SA") {
                        redirect("superadmin");
                    } elseif (($user->level == "AP")) {
                        redirect("adminprodi");
                    }
                }
            } else {
                $this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible" role="alert">
                Password Salah.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
                redirect("tiflog");
            }
        } else {
            $this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible" role="alert">
                Akun Belum Terdaftar.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect("tiflog");
        }
    }
    public function logout()
    {
        $sesi = ['id_user', 'username_user', 'password_user', 'level_user', 'prodi_user', 'jk_user', 'status_user', 'nama_user', 'foto_user', 'masuk_user'];
        $this->session->unset_userdata($sesi);
        $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                Kamu Berhasil Logout.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect("tiflog");
    }
}
