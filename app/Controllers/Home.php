<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function dashboard(): string
    {
        return view('dashboard');
    }

    public function daftar_role(): string
    {
        return view('daftar_role');
    }

    public function daftar_pengguna(): string
    {
        return view('daftar_pengguna');
    }

    public function daftar_sertifikat(): string
    {
        return view('daftar_sertifikat');
    }

    public function daftar_karyawan(): string
    {
        return view('daftar_karyawan');
    }
}
