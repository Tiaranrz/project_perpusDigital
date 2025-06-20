<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public function index()
    {
        $model = new CategoryModel();
        return view('admin/categories/index', [
            'categories' => $model->orderBy('nama', 'ASC')->findAll()
        ]);
    }

    // Tambah Kategori
public function add()
{
    return view('admin/categories/form', [
        'form_action' => base_url('admin/categories/save'),
        'category'    => null
    ]);
}

// Edit Kategori
public function edit($id)
{
    $model = new \App\Models\CategoryModel();
    $category = $model->find($id);
    if (!$category) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

    return view('admin/categories/form', [
        'form_action' => base_url('admin/categories/update/' . $id),
        'category'    => $category
    ]);
}


    public function save()
    {
        $model = new CategoryModel();
        $data = $this->request->getPost();
        $rules = [
            'nama' => 'required|is_unique[categories.nama]',
            'deskripsi' => 'permit_empty'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model->insert($data);
        // Kembali ke halaman form buku setelah sukses
        return redirect()->to(base_url('admin/books/add'))->with('success', 'Kategori berhasil ditambahkan!');
    }
}
