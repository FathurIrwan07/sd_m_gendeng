<?php

namespace App\Http\Controllers;

use App\Models\TenagaPendidik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TenagaPendidikController extends Controller
{
    public function publicIndex()
    {
        // Get all teachers ordered by created_at
        $tenagaPendidik = TenagaPendidik::latest()->get();
        
        // Calculate statistics
        $stats = [
            [
                'value' => $tenagaPendidik->count(),
                'label' => 'Total Guru'
            ],
            [
                'value' => $tenagaPendidik->where('jabatan', 'like', '%Kepala Sekolah%')->count() + 
                        $tenagaPendidik->where('jabatan', 'like', '%Guru%')->count(),
                'label' => 'Guru Profesional'
            ],
            [
                'value' => $tenagaPendidik->filter(function($item) {
                    return str_contains(strtolower($item->lulusan ?? ''), 's1') || 
                        str_contains(strtolower($item->lulusan ?? ''), 's2') ||
                        str_contains(strtolower($item->lulusan ?? ''), 'sarjana') ||
                        str_contains(strtolower($item->lulusan ?? ''), 'magister');
                })->count(),
                'label' => 'Bersertifikat'
            ],
        ];
        
        return view('teachers', compact('tenagaPendidik', 'stats'));
    }
    
    public function index(Request $request)
    {
        $query = TenagaPendidik::with('user');
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', '%' . $search . '%')
                  ->orWhere('jabatan', 'like', '%' . $search . '%')
                  ->orWhere('lulusan', 'like', '%' . $search . '%');
            });
        }
        
        $tenagaPendidik = $query->latest()->paginate(9);
        
        return view('admin.tenaga-pendidik.index', compact('tenagaPendidik'));
    }

    public function create()
    {
        return view('admin.tenaga-pendidik.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'jabatan' => 'required|string|max:100',
            'lulusan' => 'nullable|string|max:200',
            'foto_tenaga_pendidik' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nama_lengkap.max' => 'Nama lengkap maksimal 150 karakter',
            'jabatan.required' => 'Jabatan wajib diisi',
            'jabatan.max' => 'Jabatan maksimal 100 karakter',
            'lulusan.max' => 'Lulusan maksimal 200 karakter',
            'foto_tenaga_pendidik.image' => 'File harus berupa gambar',
            'foto_tenaga_pendidik.mimes' => 'Format gambar harus: jpeg, png, jpg, gif',
            'foto_tenaga_pendidik.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('foto_tenaga_pendidik')) {
            $validated['foto_tenaga_pendidik'] = $request->file('foto_tenaga_pendidik')
                ->store('tenaga-pendidik', 'public');
        }

        TenagaPendidik::create($validated);

        return redirect()->route('tenaga-pendidik.index')
            ->with('success', 'Tenaga pendidik berhasil ditambahkan.');
    }

    public function show(TenagaPendidik $tenagaPendidik)
    {
        $tenagaPendidik->load('user');
        return view('admin.tenaga-pendidik.show', compact('tenagaPendidik'));
    }

    public function edit(TenagaPendidik $tenagaPendidik)
    {
        return view('admin.tenaga-pendidik.edit', compact('tenagaPendidik'));
    }

    public function update(Request $request, TenagaPendidik $tenagaPendidik)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'jabatan' => 'required|string|max:100',
            'lulusan' => 'nullable|string|max:200',
            'foto_tenaga_pendidik' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nama_lengkap.max' => 'Nama lengkap maksimal 150 karakter',
            'jabatan.required' => 'Jabatan wajib diisi',
            'jabatan.max' => 'Jabatan maksimal 100 karakter',
            'lulusan.max' => 'Lulusan maksimal 200 karakter',
            'foto_tenaga_pendidik.image' => 'File harus berupa gambar',
            'foto_tenaga_pendidik.mimes' => 'Format gambar harus: jpeg, png, jpg, gif',
            'foto_tenaga_pendidik.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('foto_tenaga_pendidik')) {
            if ($tenagaPendidik->foto_tenaga_pendidik) {
                Storage::disk('public')->delete($tenagaPendidik->foto_tenaga_pendidik);
            }
            $validated['foto_tenaga_pendidik'] = $request->file('foto_tenaga_pendidik')
                ->store('tenaga-pendidik', 'public');
        }

        $tenagaPendidik->update($validated);

        return redirect()->route('tenaga-pendidik.index')
            ->with('success', 'Tenaga pendidik berhasil diperbarui.');
    }

    public function destroy(TenagaPendidik $tenagaPendidik)
    {
        if ($tenagaPendidik->foto_tenaga_pendidik) {
            Storage::disk('public')->delete($tenagaPendidik->foto_tenaga_pendidik);
        }

        $tenagaPendidik->delete();

        return redirect()->route('tenaga-pendidik.index')
            ->with('success', 'Tenaga pendidik berhasil dihapus.');
    }

    public function deleteFoto($id)
    {
        $tenagaPendidik = TenagaPendidik::findOrFail($id);
        
        if ($tenagaPendidik->foto_tenaga_pendidik) {
            Storage::disk('public')->delete($tenagaPendidik->foto_tenaga_pendidik);
            $tenagaPendidik->foto_tenaga_pendidik = null;
            $tenagaPendidik->save();
        }

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }
}