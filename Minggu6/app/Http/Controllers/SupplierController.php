<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class SupplierController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];

        $page = (object) [
            'title' => 'Daftar supplier yang terdaftar dalam sistem'
        ];

        $activeMenu = 'supplier';

        return view('supplier.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request)
    {
        $supplier = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat');

        if ($request->supplier_id) {
            $supplier->where('supplier_id', $request->supplier_id);
        }

        return DataTables::of($supplier)
            ->addIndexColumn()
            ->addColumn('aksi', function ($supplier) {
                // $btn = '<a href="' . url('/supplier/' . $supplier->supplier_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/supplier/' . $supplier->supplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/supplier/' . $supplier->supplier_id) . '">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                $btn = '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';

                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';

                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Supplier',
            'list' => ['Home', 'Supplier', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah supplier baru'
        ];

        $activeMenu = 'supplier';

        return view('supplier.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'supplier_kode' => 'required|string|min:3|unique:m_supplier,supplier_id',
            'supplier_nama'     => 'required|string|max:100',
            'supplier_alamat'   => 'required|string',
        ]);

        SupplierModel::create([
            'supplier_kode' => $request->supplier_kode,
            'supplier_nama'     => $request->supplier_nama,
            'supplier_alamat'   => $request->supplier_alamat,
        ]);

        return redirect('/supplier')->with('success', 'Data supplier berhasil disimpan');
    }
    public function show(string $id)
    {
        $supplier = SupplierModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail supplier',
            'list'  => ['Home', 'supplier', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.show', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'supplier'   => $supplier,
            'activeMenu' => $activeMenu
        ]);
    }
    public function edit(string $id)
    {
        $supplier = SupplierModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit supplier',
            'list'  => ['Home', 'supplier', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }
    public function destroy(string $id)
    {
        $check = SupplierModel::find($id);
        if (!$check) {
            return redirect('/supplier')->with('error', 'Data supplier tidak ditemukan');
        }

        try {
            SupplierModel::destroy($id);

            return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/supplier')->with('error', 'Data supplier gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

     // Create ajax
     public function create_ajax()
     {
         return view('supplier.create_ajax');
     }

       // Store ajax
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_kode' => 'required|string|max:10',
                'supplier_nama' => 'required|string|max:100',
                'supplier_alamat' => 'required|string|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            SupplierModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data supplier berhasil disimpan',
            ]);
        }
        return redirect('/');
    }

      // Edit ajax
      public function edit_ajax(string $id)
      {
          $supplier = SupplierModel::find($id);
          return view('supplier.edit_ajax', ['supplier' => $supplier]);
      }
  
  
      public function update(Request $request, string $id)
      {
          $request->validate([
              'supplier_kode' => 'required|string|max:10',
              'supplier_nama' => 'required|string|max:100',
              'supplier_alamat' => 'required'
          ]);
  
          SupplierModel::find($id)->update([
              'supplier_kode' => $request->supplier_kode,
              'supplier_nama' => $request->supplier_nama,
              'supplier_alamat' => $request->supplier_alamat
          ]);
  
          return redirect('/supplier')->with('success', 'Data supplier berhasil diubah');
      }
  
      // Update ajax
      public function update_ajax(Request $request, string $id)
      {
          if ($request->ajax() || $request->wantsJson()) {
              $rules = [
                  'supplier_kode' => 'required|string|max:10',
                  'supplier_nama' => 'required|string|max:100',
                  'supplier_alamat' => 'required',
              ];
  
              $validator = Validator::make($request->all(), $rules);
  
              if ($validator->fails()) {
                  return response()->json([
                      'status' => false,
                      'message' => 'Validasi Gagal',
                      'msgField' => $validator->errors(),
                  ]);
              }
              $check = SupplierModel::find($id);
              if ($check) {
                  $check->update($request->all());
                  return response()->json([
                      'status' => true,
                      'message' => 'Data supplier berhasil diubah',
                  ]);
              } else {
                  return response()->json([
                      'status' => false,
                      'message' => 'Data supplier tidak ditemukan',
                  ]);
              }
          }
          return redirect('/');
      }
  
      // Confirm delete
      public function confirm_ajax(string $id)
      {
          $supplier = SupplierModel::find($id);
  
          return view('supplier.confirm_ajax', ['supplier' => $supplier]);
      }
  
      // Delete ajax
      public function delete_ajax(Request $request, string $id)
      {
          if ($request->ajax() || $request->wantsJson()) {
              $supplier = SupplierModel::find($id);
              if ($supplier) {
                  $supplier->delete();
                  return response()->json([
                      'status' => true,
                      'message' => 'Data supplier berhasil dihapus',
                  ]);
              } else {
                  return response()->json([
                      'status' => false,
                      'message' => 'Data supplier tidak ditemukan',
                  ]);
              }
          }
          return redirect('/');
      }
}