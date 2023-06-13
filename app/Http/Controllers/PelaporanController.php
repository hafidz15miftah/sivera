<?php

namespace App\Http\Controllers;

use App\Models\DataBarangModel;
use App\Models\DetailBarangModel;
use App\Models\KondisiBarangModel;
use App\Models\VerifikasiLaporanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Telegram\Bot\Laravel\Facades\Telegram;
use Yajra\DataTables\Facades\DataTables;
use NotificationChannels\Telegram\TelegramMessage;
use Telegram\Bot\Api;

class PelaporanController extends Controller
{
    public function tampilkanPelaporan()
    {
        $info = KondisiBarangModel::all();

        if (request()->ajax()) {
            $laporan = VerifikasiLaporanModel::with('info')->join('infos', 'laporans.info_id', '=', 'infos.id')->select('laporans.id', 'infos.kode_detail')->get();
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
                ->addColumn('kode_detail', function ($row) {
                    if ($row->info) {
                        return $row->info->kode_detail;
                    }
                    return '';
                })
                ->editColumn('tanggal_dilaporkan', function ($row) {
                    return \Carbon\Carbon::parse($row->tanggal_dilaporkan)->locale('id')->translatedFormat('l, d M Y');
                })
                ->addColumn('aksi', function ($row) {
                    $user = auth()->user();
                    $role_id = $user->role_id;
                    $tombol = '';

                    if ($role_id == 1) {
                        $tombol = "<a href='" . asset('storage/' . $row->path) . "' target='_blank' class='btn btn-primary btn-sm text-white' style='margin-top: 3px; width:200px; text-align: center;'><i class='fa fa-eye'></i>Lihat</a>";
                        if ($row->status == 1) {
                            $tombol .= "<a href='" . asset('storage/' . $row->gambar) . "' target='_blank' class='btn btn-warning btn-sm text-white' style='margin-top: 3px; width:200px; text-align: center;'><i class='fa fa-picture-o'></i>Gambar</a>";
                            $tombol .= "<button data-id='$row->id' class='btn btn-success btn-sm text-white' style='margin-top: 3px; width:200px; text-align: center;' onclick='setujuLaporan(this)'><i class='fa fa-check'></i>Setuju</button>";
                            $tombol .= "<button data-id='$row->id' class='btn btn-danger btn-sm text-white' style='margin-top: 3px; width:200px; text-align: center;' onclick='tolakLaporan(this)'><i class='fa fa-times'></i>Tolak</button>";
                        }
                    } elseif ($role_id == 3) {
                        $tombol = "<a href='" . asset('storage/' . $row->path) . "' target='_blank' class='btn btn-primary btn-sm text-white' style='margin-top: 3px; width:200px;><i class='fa fa-eye'></i>Lihat</a>";
                        if ($row->status == 2) {
                            $tombol .= "<a href='" . asset('storage/' . $row->gambar) . "' target='_blank' class='btn btn-warning btn-sm text-white' style='margin-top: 3px; width:200px; text-align: center;'><i class='fa fa-picture-o'></i>Gambar</a>";
                            $tombol .= "<button data-id='$row->id' class='btn btn-success btn-sm text-white' style='margin-top: 3px; width:200px; text-align: center;' onclick='setujuLaporan(this)'><i class='fa fa-check'></i>Setuju</button>";
                            $tombol .= "<button data-id='$row->id' class='btn btn-danger btn-sm text-white' style='margin-top: 3px; width:200px; text-align: center;' onclick='tolakLaporan(this)'><i class='fa fa-times'></i>Tolak</button>";
                        }
                    } else {
                        $tombol = "<a href='" . asset('storage/' . $row->path) . "' target='_blank' class='btn btn-primary btn-sm text-white' style='margin-top: 3px; width:200px; text-align: center;'><i class='fa fa-eye'></i>Lihat</a>";
                        $tombol .= "<a href='" . asset('storage/' . $row->gambar) . "' target='_blank' class='btn btn-warning btn-sm text-white' style='margin-top: 3px; width:200px; text-align: center;'><i class='fa fa-picture-o'></i>Gambar</a>";
                        $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_laporan' onclick='deleteDataLaporan(this)' class='btn btn-danger btn-sm' style='margin-top: 3px; width:200px; text-align: center;'><i class='fa fa-trash'></i>Hapus</button>";
                        if ($row->status == 3) {
                            $tombol .= "<button data-id='$row->id' class='btn btn-success btn-sm text-white' style='margin-top: 3px; width:200; text-align: center;' onclick='setujuLaporan(this)'><i class='fa fa-check'></i>Penanganan Selesai</button>";
                        }
                    }

                    return $tombol;
                })
                ->addColumn('status_html', function ($row) {
                    if ($row->status == 1) {
                        return "<span class='badge badge-info text-center text-white' style='display: block; text-align: center;'>Menunggu Verifikasi</span>";
                    } elseif ($row->status == 2) {
                        return "<span class='badge badge-warning text-center text-white' style='display: block; text-align: center;'>Diverifikasi Sekretaris Desa</span>";
                    } elseif ($row->status == 3) {
                        return "<span class='badge badge-success text-center text-white' style='display: block; text-align: center'>Disetujui Kepala Desa</span>";
                    } elseif ($row->status == 4) {
                        return "<span class='badge badge-success text-center text-white' style='display: block; text-align: center'>Penanganan Selesai</span>";
                    } else {
                        return "<span class='badge badge-danger text-center text-white' style='display: block; text-align: center;'>Ditolak</span>";
                    }
                })
                ->rawColumns(['status_html', 'aksi'])
                ->make(true);
        }
        return view('pages.pelaporan', compact('info'));
    }

    public function uploadPDF(Request $request)
    {
        
        $validatedData = $request->validate([
            'info_id' => 'required', 
            'nama_laporan' => 'required',
            'file_gambar' => 'required|mimes:jpeg,png|max:8192', //Hanya menerima file gambar dengan ukuran maks 8 MB
            'file_pdf' => 'required|mimes:pdf|max:2048', // Hanya menerima file PDF dengan ukuran maksimum 2MB
        ], [
            'nama_laporan.required' => 'Nama laporan harus diisi',
            'file_gambar' => 'Silahkan upload gambar barang rusak',
            'file_pdf' => 'Silahkan upload file PDF'
        ]);

        if ($request->hasFile('file_gambar') && $request->hasFile('file_pdf')) {
            $pdf = $request->file('file_pdf');
            $gambar = $request->file('file_gambar');
            $fileName = 'laporan-' . $validatedData['nama_laporan'] . Carbon::now()->locale('id')->translatedFormat('dHis');
            $fileGambar = $gambar->storeAs('pictures', $fileName.'.'.$gambar->getClientOriginalExtension(), 'public'); // Simpan file di folder "public/pdf"
            $filePath = $pdf->storeAs('pdf', $fileName.'.'.$pdf->getClientOriginalExtension(), 'public'); // Simpan file di folder "public/pdf"

            // Proses selanjutnya dengan data file yang diunggah...

            // Contoh: Simpan data ke database

            $data = new VerifikasiLaporanModel();
            $data->nama_laporan = $validatedData['nama_laporan'];
            $data->info_id = $request->input('info_id');
            $data->path = $filePath;
            $data->gambar = $fileGambar;
            $data->tanggal_dilaporkan = Carbon::now();
            $data->status = 1;
            $data->created_at = Carbon::now();
            $data->updated_at = Carbon::now();
            $data->save();

            // $cek = KondisiBarangModel::find($request->info_id);
            // $barang = DataBarangModel::findorFail($cek->barang_id);
            // $telegram = new Api('6184772539:AAEAKTUUYBJJVYlo7ovkPyfHRkINPj857oc');
            // $response = $telegram->sendMessage([
            //     'chat_id' => '-865301668',
            //     'text' => 'Terdapat laporan barang '. strtolower($barang->nama_barang) .' rusak, mohon lakukan verifikasi dan lakukan pengecekan pada Sistem Informasi Inventaris Barang dan Aset Desa | SIVERA'
            // ]);
            // $messageId = $response->getMessageId();
            // // $botId = $response->getId();

            // return response()->json([
            //     'success' => true,
            //     'message' => $messageId,
            // ]);
        }

        return back()->with('error', 'File PDF dan Gambar tidak ditemukan.');
    }

    public function tolak(Request $request, $id)
    {
        $laporan = VerifikasiLaporanModel::findOrFail($id);

        // Lakukan logika untuk menolak laporan

        //Mengubah status menjadi 0 (Ditolak)
        $laporan->status = 0;
        $laporan->keterangan = $request->input('keterangan');
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

        if (Auth::user()->role_id == 1) {
            // jika usernya Sekdes
            $laporan->status = 2;
        } elseif (Auth::user()->role_id == 3) {
            // jika usernya Kades
            $laporan->status = 3;
        } elseif (Auth::user()->role_id == 2) {
            // jika usernya Kaur
            $laporan->status = 4;
        }
        $laporan->save();

        // Berikan respons yang sesuai (misalnya menggunakan JSON response)
        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil disetujui.',
        ]);
    }

    public function hapuslaporan(Request $request, $id)
    {
        $laporan = VerifikasiLaporanModel::findOrFail($id);
        if ($request->ajax()) {
            if ($laporan) {
                
                // Menghapus data laporan
                $laporan->delete();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Data laporan ' . $laporan->nama_laporan . ' berhasil dihapus.'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
    }    

}
