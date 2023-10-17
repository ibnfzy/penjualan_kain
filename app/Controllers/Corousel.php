<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Corousel extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('admin/corousel', [
            'data' => $this->db->table('corousel')->get()->getResultArray()
        ]);
    }

    public function create()
    {
        $rules = [
            'gambar' => 'is_image[gambar]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Corousel'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $img = $this->request->getFile('gambar');
        $filename = $img->getRandomName();

        $this->db->table('corousel')->insert([
            'gambar' => $filename
        ]);

        if (!$img->hasMoved()) {
            $img->move('uploads', $filename);
        }

        return redirect()->to(base_url('AdmPanel/Corousel'))->with('type-status', 'success')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function delete($id)
    {
        $this->db->table('corousel')->where('id_corousel', $id)->delete();

        return redirect()->to(base_url('AdmPanel/Corousel'))->with('type-status', 'success')
            ->with('message', 'Data berhasil dihapus');
    }
}