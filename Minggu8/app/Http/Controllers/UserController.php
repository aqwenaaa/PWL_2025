<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
USE App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\String_;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller {
    public function index()
    {
       $breadcrumb = (object) [
           'title' => 'Daftar User',
           'link' => ['Home', 'User']
       ];

       $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem',
       ];

         $activeMenu = 'user';
         $level = LevelModel::all(); //filter level yang ada di database
         return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

// Ambil data user dalam bentuk JSON untuk DataTables
    // Ambil data user dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');

        // Filter data user berdasarkan level_id
        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            ->addIndexColumn() // Menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($user) {
                $btn  = '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi berisi HTML
            ->make(true);
    }

    public function edit_ajax(String $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('user.edit_ajax', ['user' => $user, 'level' => $level]);
    }

    public function update_ajax(Request $request, $id) {
        // Cek apakah request berasal dari Ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|max:20|unique:m_user,username,' . $id . ',user_id',
                'nama' => 'required|max:100',
                'password' => 'nullable|min:6|max:20'
            ];
    
            // Validasi input
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // Respon JSON, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // Menunjukkan field mana yang error
                ]);
            }
    
            $check = UserModel::find($id);
            if ($check) {
                // Jika password tidak diisi, hapus dari request
                if (!$request->filled('password')) {
                    $request->request->remove('password');
                }
    
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(String $id)
    {
        $user = UserModel::find($id);
        return view('user.confirm_ajax', ['user' => $user]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if($request->ajax() || $request->wantsJson()){
            $user = UserModel::find($id);
            if ($user) {
                $user->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
    
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'link' => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah user baru',
        ];

        $level = LevelModel::all();
        $activeMenu = 'user';
        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function create_ajax()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();
        
        return view('user.create_ajax')->with('level', $level);
    }

    //show ajax
    public function show_ajax(string $id)
    {
        $user = UserModel::with('level')->find($id); // with('level') jika ada relasi ke level

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return view('user.show_ajax', ['user' => $user]);
    }


    public function store_ajax(Request $request)
    {
        if($request->ajax() || $request->wantsJson()){
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:6'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);   
            }
            
            UserModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);
    
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password), //dienkripsi sblm disimpan
            'level_id' => $request->level_id,
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    public function show(String $id)
    {
        $user = UserModel::with('level')->find($id);
        $breadcrumb = (object) [
            'title' => 'Detail User',
            'link' => ['Home', 'User', 'Detail']
        ];
        $page = (object) [
            'title' => 'Detail User',
        ];
        $activeMenu = 'user';
        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function edit(String $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'link' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit User',
        ];

        $activeMenu = 'user';
        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, String $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::find($id)->update ([
            'username'  => $request->username,
            'nama'      => $request->nama,
            'password'  => $request->password ? bcrypt($request->password) : UserModel::find($id)->password, //dienkripsi sblm disimpan
            'level_id'  => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    //menghapus data user
    public function destroy(String $id)
    {
        $check = UserModel::find($id);
        if (!$check) {
            return redirect ('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            UserModel::destroy($id);
            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }


    public function tambah()
    {
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id,
            ]);
            return redirect('/user');
    }

    public function ubah($id)
    {
        $data = UserModel::find($id);
        return view('user_ubah', ['data' => $data]);
    }
    
    public function ubah_simpan(Request $request, $id)
    {
        $user = UserModel::find($id);
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make($request->password);
        $user->level_id = $request->level_id;
        $user->save();
        return redirect('/user');
    }

    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();
        return redirect('/user');
    }
    //Menampilkan form import user
    public function import()
    {
        return view('user.import');
    }
    //Proses import user dari file excel
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_user' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
    
            $file = $request->file('file_user');
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true);
    
            $insert = [];
            if (count($data) > 1) {
                foreach ($data as $row => $value) {
                    if ($row > 1) { // Skip header row
                        $insert[] = [
                            'user_id' => $value['A'],
                            'username' => $value['B'],
                            'nama' => $value['C'],
                            'level_id' => $value['D'],
                            'password' => bcrypt('password'), // Default password; adjust as needed
                            'created_at' => now(),
                        ];
                    }
                }
                if (count($insert) > 0) {
                    UserModel::insertOrIgnore($insert);
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil diimport'
                    ]);
                }
            }
            return response()->json([
                'status' => false,
                'message' => 'Tidak ada data yang diimport'
            ]);
        }
        return redirect('/');
    }

    //Menampilkan form export user
    public function export_excel()
         {
             // Ambil data users yang akan diekspor
             $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
                 ->orderBy('user_id')
                 ->with('level')
                 ->get();
 
             // Load library PhpSpreadsheet
             $spreadsheet = new Spreadsheet();
             $sheet = $spreadsheet->getActiveSheet();
 
             // Set header kolom
             $sheet->setCellValue('A1', 'No');
             $sheet->setCellValue('B1', 'User ID');
             $sheet->setCellValue('C1', 'Username');
             $sheet->setCellValue('D1', 'Nama');
             $sheet->setCellValue('E1', 'Level');
 
             // Format header bold
             $sheet->getStyle('A1:E1')->getFont()->setBold(true);
 
             // Isi data users
             $no = 1;
             $baris = 2;
             foreach ($users as $user) {
                 $sheet->setCellValue('A' . $baris, $no);
                 $sheet->setCellValue('B' . $baris, $user->user_id);
                 $sheet->setCellValue('C' . $baris, $user->username);
                 $sheet->setCellValue('D' . $baris, $user->nama);
                 $sheet->setCellValue('E' . $baris, $user->level->level_nama);
                 $baris++;
                 $no++;
             }
 
             // Set auto size untuk kolom
             foreach (range('A', 'E') as $columnID) {
                 $sheet->getColumnDimension($columnID)->setAutoSize(true);
             }
 
             // Set title sheet
             $sheet->setTitle('Data User');
             
             // Generate filename
             $filename = 'Data_User_' . date('Y-m-d_H-i-s') . '.xlsx';
 
             // Set header untuk download file
             header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
             header('Content-Disposition: attachment;filename="' . $filename . '"');
             header('Cache-Control: max-age=0');
             header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
             header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
             header('Cache-Control: cache, must-revalidate');
             header('Pragma: public');
 
             $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
             $writer->save('php://output');
             exit;
         }
        
        public function export_pdf()
        {
            set_time_limit(0); // set waktu eksekusi tidak terbatas
            
             $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
                 ->orderBy('user_id')
                 ->with('level')
                 ->get();
 
             // use Barryvdh\DomPDF\Facade\Pdf;
             $pdf = Pdf::loadView('user.export_pdf', ['user' => $users]);
             $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
             $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url
             $pdf->render();
 
             return $pdf->stream('Data user ' . date('Y-m-d H:i:s') . '.pdf');
        }
 
         //find : karena ada satu record di database yg id nya 1, maka akan menampilkan record yg id nya 1
        //first : karena kita ingin menampilkan record pertama yg memiliki level_id 1, maka akan menampilkan record yg id nya 1
        //firstWhere : karena kita ingin menampilkan record pertama yg memiliki level_id 1, maka akan menampilkan record yg id nya 1
        //findOr : karena ada satu record di database yg id nya 1, maka akan menampilkan record yg id nya 1, tapi klo gaada hasilnya 404notfound
        //findOrFail : karena ada satu record di database yg id nya 1, maka akan menampilkan record yg id nya 1 dan akan menampilkan error 404notfound
        //firstorcreate : karena ada di database tidak ada usn manager maka akan membuat record baru dengan usn manager, jika ada tidak akan merubah db
        //isdirty : Digunakan untuk mengecek apakah suatu atribut model telah diubah tetapi belum disimpan ke database.
        //wasChanged : Digunakan untuk mengecek apakah suatu atribut model telah diubah.
        //isClean : Digunakan untuk mengecek apakah model tidak memiliki perubahan.


        
    
}
