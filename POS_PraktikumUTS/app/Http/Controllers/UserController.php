<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list'  => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif

        $level = LevelModel::all(); // ambil data level untuk filter level

        return view('user.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu

        ]);
    }
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
            ->addColumn('aksi', function ($user) { // Menambahkan kolom aksi
                
                $btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="'. url('/user/'.$user->user_id).'">'
                //     . csrf_field() . method_field('DELETE') . 
                //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>
                //     </form>';
                

                // $btn = '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/show_ajax') . '\')" 
                //     class="btn btn-info btn-sm">Detail</button> ';

                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/edit_ajax') . '\')" 
                    class="btn btn-warning btn-sm">Edit</button> ';

                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/delete_ajax') . '\')" 
                    class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi adalah HTML
            ->make(true);
    }

    // Menampilkan detail user
    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list'  => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail user'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif

        return view('user.show', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'user'       => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create_ajax()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.create_ajax')
            ->with('level', $level);
    }

    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id'   => 'required|integer',
                'username'   => 'required|string|min:3|unique:m_user,username',
                'nama'       => 'required|string|max:100',
                'password'   => 'required|min:6'
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false, // response status, false: error/gagal, true: berhasil
                    'message'  => 'Validasi gagal',
                    'msgField' => $validator->errors() // pesan error validasi
                ]);
            }

            UserModel::create($request->all());

            return response()->json([
                'status'  => true,
                'message' => 'Data user berhasil disimpan'
            ]);
        }

        redirect('/');
    }

    // Menampilkan halaman form edit user ajax
    public function edit_ajax(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.edit_ajax', ['user' => $user, 'level' => $level]);
    }

    public function update_ajax(Request $request, $id)
    {
        // Cek apakah request berasal dari AJAX
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id'  => 'required|integer',
                'username'  => 'required|max:20|unique:m_user,username,' . $id . ',user_id',
                'nama'      => 'required|max:100',
                'password'  => 'nullable|min:6|max:20'
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,  // respon json, true: berhasil, false: gagal
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
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
                    'status'  => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $user = UserModel::find($id);

        return view('user.confirm_ajax', ['user' => $user]);
    }

    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
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

    public function import()
    {
        return view('user.import');
    }

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
        set_time_limit(0);

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
    /**
     * Menampilkan halaman profile
     */
    public function profilePage()
    {
        // Use Laravel's auth system to get the current user
        $user = auth()->user();

        if (!$user) {
            return redirect('/login')->with('error', 'Silahkan login terlebih dahulu');
        }

        // Define breadcrumb as an OBJECT (note the (object) cast)
        $breadcrumb = (object) [
            'title' => 'Profile User',
            'list' => ['Home', 'Profile']
        ];

        // Define page information
        $page = (object) [
            'title' => 'Profil Pengguna'
        ];

        // Set active menu
        $activeMenu = 'profile';

        return view('user.profile', compact('user', 'breadcrumb', 'page', 'activeMenu'));
    }

    /**
     * Menampilkan halaman form edit photo
     */
    public function editPhoto(Request $request)
    {
        // Validasi file
        $request->validate([
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Get the authenticated user
            $user = auth()->user();

            if (!$user) {
                return redirect('/login')->with('error', 'Silahkan login terlebih dahulu');
            }

            // Get the user ID
            $userId = $user->user_id;

            // Get the proper UserModel instance
            $userModel = UserModel::find($userId);

            if (!$userModel) {
                return redirect('/login')->with('error', 'User tidak ditemukan');
            }

            // Delete old photo if exists
            if ($userModel->foto_profil && file_exists(storage_path('app/public/' . $userModel->foto_profil))) {
                Storage::disk('public')->delete($userModel->foto_profil);
            }

            // Store new photo
            $fileName = 'profile_' . $userId . '_' . time() . '.' . $request->foto_profil->extension();
            $path = $request->foto_profil->storeAs('profiles', $fileName, 'public');

            // Update user record using update() method
            UserModel::where('user_id', $userId)->update([
                'foto_profil' => $path
            ]);

            return redirect()->back()->with('success', 'Foto profile berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupload foto: ' . $e->getMessage());
        }
    }
}