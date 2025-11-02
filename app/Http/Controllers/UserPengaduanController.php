<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserPengaduanController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();
        
        // Statistik Pengaduan User
        $totalPengaduan = Pengaduan::where('user_id', $userId)->count();
        $menunggu = Pengaduan::where('user_id', $userId)
            ->where('status_pengaduan', 'Menunggu Konfirmasi')
            ->count();
        $diproses = Pengaduan::where('user_id', $userId)
            ->where('status_pengaduan', 'Diproses')
            ->count();
        $selesai = Pengaduan::where('user_id', $userId)
            ->where('status_pengaduan', 'Selesai')
            ->count();
        
        // Pengaduan Terbaru (3 data terakhir)
        $pengaduanTerbaru = Pengaduan::with(['kategori', 'tanggapan'])
            ->where('user_id', $userId)
            ->latest()
            ->limit(3)
            ->get();
        
        return view('user.dashboard', compact(
            'totalPengaduan',
            'menunggu',
            'diproses',
            'selesai',
            'pengaduanTerbaru'
        ));
    }
    
    public function index()
    {
        $pengaduan = Pengaduan::with(['kategori', 'tanggapan'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
        
        return view('user.pengaduan.index', compact('pengaduan'));
    }

    public function create()
    {
        $kategori = KategoriPengaduan::all();
        return view('user.pengaduan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori_pengaduan,id_kategori',
            'deskripsi' => 'required|string|min:20',
        ], [
            'id_kategori.required' => 'Kategori pengaduan wajib dipilih',
            'id_kategori.exists' => 'Kategori yang dipilih tidak valid',
            'deskripsi.required' => 'Deskripsi pengaduan wajib diisi',
            'deskripsi.min' => 'Deskripsi pengaduan minimal 20 karakter',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['tanggal_pengaduan'] = Carbon::now()->toDateString();
        $validated['status_pengaduan'] = 'Menunggu Konfirmasi';

        Pengaduan::create($validated);

        return redirect()->route('user.pengaduan.index')
            ->with('success', 'Pengaduan Anda berhasil dikirim dan sedang menunggu konfirmasi.');
    }

    public function show(Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pengaduan ini.');
        }

        $pengaduan->load(['kategori', 'tanggapan.penanggap']);
        return view('user.pengaduan.show', compact('pengaduan'));
    }

    public function publicIndex()
    {
        $pengaduan = Pengaduan::with(['kategori', 'tanggapan'])
            ->whereIn('status_pengaduan', ['Diproses', 'Selesai'])
            ->latest()
            ->paginate(10);
        
        return view('public.pengaduan.index', compact('pengaduan'));
    }

    public function createAnonim()
    {
        $kategori = KategoriPengaduan::all();
        return view('public.pengaduan.create', compact('kategori'));
    }

    public function storeAnonim(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori_pengaduan,id_kategori',
            'deskripsi' => 'required|string|min:20',
        ], [
            'id_kategori.required' => 'Kategori pengaduan wajib dipilih',
            'id_kategori.exists' => 'Kategori yang dipilih tidak valid',
            'deskripsi.required' => 'Deskripsi pengaduan wajib diisi',
            'deskripsi.min' => 'Deskripsi pengaduan minimal 20 karakter',
        ]);

        $validated['user_id'] = null; 
        $validated['tanggal_pengaduan'] = Carbon::now()->toDateString();
        $validated['status_pengaduan'] = 'Menunggu Konfirmasi';

        Pengaduan::create($validated);

        return redirect()->route('pengaduan.anonim.create')
            ->with('success', 'Pengaduan anonim Anda berhasil dikirim dan sedang menunggu konfirmasi.');
    }
}