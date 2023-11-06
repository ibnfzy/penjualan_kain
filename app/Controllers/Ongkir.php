<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Ongkir extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('admin/ongkir', [
            'data' => $this->db->table('ongkir')->get()->getResultArray()
        ]);
    }

    public function create()
    {
        $rules = [
            'nama_kota' => 'required',
            'biaya_ongkir' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Ongkir'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('ongkir')->insert([
            'nama_kota' => $this->request->getPost('nama_kota'),
            'biaya_ongkir' => $this->request->getPost('biaya_ongkir'),
        ]);

        return redirect()->to(base_url('AdmPanel/Ongkir'))->with('type-status', 'success')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function update()
    {
        $rules = [
            'id_ongkir' => 'required',
            'nama_kota' => 'required',
            'biaya_ongkir' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Ongkir'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('ongkir')->where('id_ongkir', $this->request->getPost('id_ongkir'))->update([
            'nama_kota' => $this->request->getPost('nama_kota'),
            'biaya_ongkir' => $this->request->getPost('biaya_ongkir'),
        ]);

        return redirect()->to(base_url('AdmPanel/Ongkir'))->with('type-status', 'success')
            ->with('message', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $this->db->table('ongkir')->where('id_ongkir', $id)->delete();

        return redirect()->to(base_url('AdmPanel/Ongkir'))->with('type-status', 'success')
            ->with('message', 'Data berhasil diubah');
    }
}