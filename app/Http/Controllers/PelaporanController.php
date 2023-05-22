<?php

namespace App\Http\Controllers;

use App\Models\VerifikasiLaporanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PelaporanController extends Controller
{
    public function tampilkanPelaporan()
    {

        if (request()->ajax()) {

            // Filter data sesuai role_id
            if (Auth::user()->role_id == 1) {
                $laporan = VerifikasiLaporanModel::where('status', 1)->get();
            } elseif (Auth::user()->role_id == 2) {
                $laporan = VerifikasiLaporanModel::get();
            } elseif (Auth::user()->role_id == 3) {
                $laporan = VerifikasiLaporanModel::where('status', 2)->get();
            }

            return DataTables::of($laporan)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->editColumn('tanggal_dilaporkan', function ($row) {
                    return \Carbon\Carbon::parse($row->tanggal_dilaporkan)->locale('id')->translatedFormat('l, d M Y | H:i');
                })
                ->addColumn('aksi', function ($row) {
                    $user = auth()->user();
                    $role_id = $user->role_id;
                    $tombol = '';

                    if ($role_id == 1) {
                            $tombol = "<a href='" . asset('storage/'. $row->path ) . "' target='_blank' class='btn btn-primary btn-sm text-white'><i class='fa fa-eye'></i>Lihat</a>";
                        if ($row->status == 1) {
                            $tombol .= "<button data-id='$row->id' class='btn btn-success btn-sm text-white' onclick='setujuLaporan(this)'><i class='fa fa-check'></i>Setuju</button>";
                            $tombol .= "<button data-id='$row->id' class='btn btn-danger btn-sm text-white' onclick='tolakLaporan(this)'><i class='fa fa-times'></i>Tolak</button>";
                        }
                    } elseif ($role_id == 3) {
                            $tombol = "<a href='" . asset('storage/'. $row->path ) . "' target='_blank' class='btn btn-primary btn-sm text-white'><i class='fa fa-eye'></i>Lihat</a>";
                        if ($row->status == 2) {
                            $tombol .= "<button data-id='$row->id' class='btn btn-success btn-sm text-white' onclick='setujuLaporan(this)'><i class='fa fa-check'></i>Setuju</button>";
                            $tombol .= "<button data-id='$row->id' class='btn btn-danger btn-sm text-white' onclick='tolakLaporan(this)'><i class='fa fa-times'></i>Tolak</button>";
                        }
                    } else {
                        $tombol = "<a href='" . asset('storage/'. $row->path ) . "' target='_blank' class='btn btn-primary btn-sm text-white'><i class='fa fa-eye'></i>Lihat</a>";
                        $tombol .= "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' onclick='lihatdatabarang(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                        $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_laporan' onclick='deleteDataRuangan(this)' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i>Hapus</button>";
                    }

                    return $tombol;
                })
                ->addColumn('status_html', function ($row) {
                    if ($row->status == 1) {
                        return "<span class='badge badge-info text-center' style='display: block; text-align: center;'>Pending</span>";
                    } elseif ($row->status == 2) {
                        return '<span class="badge badge-success">Disetujui Sekdes</span>';
                    } elseif ($row->status == 3) {
                        return '<span class="badge badge-success">Disetujui</span>';
                    } else {
                        return '<span class="badge badge-danger">Ditolak</span>';
                    }
                })
                ->rawColumns(['status_html','aksi'])
                ->make(true);
        }
        return view('pages.pelaporan');
    }

    public function uploadPDF(Request $request)
    {
                $validatedData = $request->validate([
                    'nama_laporan' => 'required',
                    'file_pdf' => 'required|mimes:pdf|max:2048', // Hanya menerima file PDF dengan ukuran maksimum 2MB
                ]);

                if ($request->hasFile('file_pdf')) {
                    $file = $request->file('file_pdf');
                    $fileName = 'laporan-'. $validatedData['nama_laporan'] . Carbon::now()->locale('id')->translatedFormat('dHis');
                    $filePath = $file->storeAs('pdf', $fileName, 'public'); // Simpan file di folder "public/pdf"

                    // Proses selanjutnya dengan data file yang diunggah...

                    // Contoh: Simpan data ke database
                    $data = new VerifikasiLaporanModel();
                    $data->nama_laporan = $validatedData['nama_laporan'];
                    $data->path = $filePath;
                    $data->tanggal_dilaporkan = Carbon::now();
                    $data->status = 1;
                    $data->created_at = Carbon::now();
                    $data->updated_at = Carbon::now();
                    $data->save();

                    return response()->json([
                        'success' => true,
                        'message' =>
                            'File PDF berhasil diunggah dan data telah disimpan',
                    ]);
                }

                return back()->with('error', 'File PDF tidak ditemukan.');
            }

            public function tolak($id)
            {
                $laporan = VerifikasiLaporanModel::findOrFail($id);

                // Lakukan logika untuk menolak laporan

                //Mengubah status menjadi 0 (Ditolak)
                $laporan->status = 0;
                $laporan->save();

                // Berikan respons yang sesuai (misalnya menggunakan JSON response)
                return response()->json([
                    'success' => true,
                    'message' => 'Laporan berhasil ditolak.',
                ]);
            }

            public function setuju($id)
            {
                $laporan = VerifikasiLaporanModel::findOrFail($id);

                // Lakukan logika untuk menyetujui laporan

                if(Auth::user()->role_id == 1){  //jika usernya Sekdes
                    $laporan->status = 2;
                }elseif(Auth::user()->role_id == 3){ //jika usernya Kades
                    $laporan->status = 3;
                }
                $laporan->save();

                // Berikan respons yang sesuai (misalnya menggunakan JSON response)
                return response()->json([
                    'success' => true,
                    'message' => 'Laporan berhasil disetujui.',
                ]);
            }
}

