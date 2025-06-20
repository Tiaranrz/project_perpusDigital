<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\CategoryModel;

class Book extends BaseController
{
    public function index()
    {
        $bookModel     = new BookModel();
        $categoryModel = new CategoryModel();

        $search    = $this->request->getGet('q');
        $kategori  = $this->request->getGet('kategori');
        $page      = (int) ($this->request->getGet('page') ?? 1);
        $perPage   = 8;

        $books = $bookModel->select('books.*, categories.nama as kategori')
            ->join('categories', 'categories.id=books.id_kategori', 'left');

        if ($search) {
            $books->groupStart()
                ->like('judul', $search)
                ->orLike('penulis', $search)
                ->orLike('isbn', $search)
                ->groupEnd();
        }
        if ($kategori) {
            $books->where('id_kategori', $kategori);
        }

        $booksList = $books->orderBy('books.id', 'DESC')->paginate($perPage, 'books');
        $categories = $categoryModel->orderBy('nama', 'ASC')->findAll();

        $breadcrumb = [
            ['label' => 'Dashboard', 'url' => base_url('admin/dashboard')],
            ['label' => 'Manajemen Buku', 'url' => '']
        ];

        return view('admin/books/index', [
            'books'      => $booksList,
            'categories' => $categories,
            'breadcrumb' => $breadcrumb,
            'search'     => $search,
            'kategori'   => $kategori,
            'pager'      => $bookModel->pager,
            'perPage'    => $perPage,
            'currentPage'=> $page
        ]);
    }

    public function add()
{
    $categoryModel = new \App\Models\CategoryModel();
    $breadcrumb = [
        ['label' => 'Dashboard', 'url' => base_url('admin/dashboard')],
        ['label' => 'Manajemen Buku', 'url' => base_url('admin/books')],
        ['label' => 'Tambah Buku', 'url' => '']
    ];
    return view('admin/books/form', [
        'categories' => $categoryModel->orderBy('nama','ASC')->findAll(),
        'breadcrumb' => $breadcrumb,
        'book'       => null,
        'form_action'=> base_url('admin/books/save')
    ]);
}


    public function save()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'judul'        => 'required',
            'penulis'      => 'required',
            'id_kategori'  => 'required|is_natural_no_zero',
            'jumlah'       => 'required|integer',
            'sisa'         => 'required|integer',
            'cover'        => 'permit_empty|is_image[cover]|max_size[cover,2048]'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $cover = $this->request->getFile('cover');
        $coverName = null;
        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            $coverName = $cover->getRandomName();
            $cover->move('uploads/covers/', $coverName);
        }
        $bookModel = new BookModel();
        $bookModel->save([
            'judul'        => $this->request->getPost('judul'),
            'penulis'      => $this->request->getPost('penulis'),
            'penerbit'     => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'isbn'         => $this->request->getPost('isbn'),
            'id_kategori'  => $this->request->getPost('id_kategori'),
            'jumlah'       => $this->request->getPost('jumlah'),
            'sisa'         => $this->request->getPost('sisa'),
            'cover'        => $coverName,
        ]);
        return redirect()->to(base_url('admin/books'))->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $bookModel = new BookModel();
        $categoryModel = new CategoryModel();
        $book = $bookModel->find($id);
        if (!$book) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $breadcrumb = [
            ['label' => 'Dashboard', 'url' => base_url('admin/dashboard')],
            ['label' => 'Manajemen Buku', 'url' => base_url('admin/books')],
            ['label' => 'Edit Buku', 'url' => '']
        ];
        return view('admin/books/form', [
            'categories' => $categoryModel->orderBy('nama','ASC')->findAll(),
            'breadcrumb' => $breadcrumb,
            'book'       => $book,
            'form_action'=> base_url('admin/books/update/'.$id)
        ]);
    }

    public function update($id)
    {
        $bookModel = new BookModel();
        $book      = $bookModel->find($id);

        $validation = \Config\Services::validation();
        $rules = [
            'judul'        => 'required',
            'penulis'      => 'required',
            'id_kategori'  => 'required|is_natural_no_zero',
            'jumlah'       => 'required|integer',
            'sisa'         => 'required|integer',
        ];
        if ($this->request->getFile('cover')->isValid() && !$this->request->getFile('cover')->hasMoved()) {
            $rules['cover'] = 'is_image[cover]|max_size[cover,2048]';
        }
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $cover = $this->request->getFile('cover');
        $coverName = $book['cover'];
        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            if ($coverName && file_exists('uploads/covers/'.$coverName)) {
                unlink('uploads/covers/'.$coverName);
            }
            $coverName = $cover->getRandomName();
            $cover->move('uploads/covers/', $coverName);
        }
        $bookModel->update($id, [
            'judul'        => $this->request->getPost('judul'),
            'penulis'      => $this->request->getPost('penulis'),
            'penerbit'     => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'isbn'         => $this->request->getPost('isbn'),
            'id_kategori'  => $this->request->getPost('id_kategori'),
            'jumlah'       => $this->request->getPost('jumlah'),
            'sisa'         => $this->request->getPost('sisa'),
            'cover'        => $coverName,
        ]);
        return redirect()->to(base_url('admin/books'))->with('success', 'Buku berhasil diupdate!');
    }

    public function delete($id)
    {
        $bookModel = new BookModel();
        $book = $bookModel->find($id);
        if ($book && $book['cover'] && file_exists('uploads/covers/'.$book['cover'])) {
            unlink('uploads/covers/'.$book['cover']);
        }
        $bookModel->delete($id);
        return redirect()->to(base_url('admin/books'))->with('success', 'Buku berhasil dihapus!');
    }

    // AJAX tambah kategori dari form buku
    public function addCategory()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama' => 'required|is_unique[categories.nama]',
            'deskripsi' => 'permit_empty'
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'fail',
                'message' => implode(' ', $validation->getErrors())
            ]);
        }
        $model = new CategoryModel();
        $id = $model->insert([
            'nama' => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ], true);

        return $this->response->setJSON([
            'status' => 'ok',
            'data' => [
                'id' => $id,
                'nama' => $this->request->getPost('nama')
            ]
        ]);
    }
}
