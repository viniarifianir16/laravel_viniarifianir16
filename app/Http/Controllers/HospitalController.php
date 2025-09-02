<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Hospital::orderBy('name', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                    <div class="flex space-x-2">
                        <a href="' . route('hospital.edit', $row->id) . '" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 me-2 mb-2 dark:focus:ring-yellow-900"><i class="bi bi-pencil-square"></i></a>

                         <button type="button" 
                            class="delete-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" 
                            data-id="' . $row->id . '">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.hospital.all-hospital', [
            'breadcrumbs' => [
                ['label' => 'Data Rumah Sakit', 'url' => route('hospital.index')],
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.hospital.form-hospital', [
            'breadcrumbs' => [
                ['label' => 'Data Rumah Sakit', 'url' => route('hospital.index')],
                ['label' => 'Tambah Data', 'url' => route('hospital.create')],
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string',
            'phone' => 'required|string|max:255',
        ]);

        try {
            Hospital::create($request->all());

            return redirect()->route('hospital.index')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->route('hospital.index')->with('error', 'Terjadi kesalahan. Silahkan coba lagi');
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(Hospital $hospital)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hospital = Hospital::findOrFail($id);
        return view('pages.hospital.form-hospital', [
            'hospital' => $hospital,
            'breadcrumbs' => [
                ['label' => 'Data Rumah Sakit', 'url' => route('hospital.index')],
                ['label' => 'Edit Data', 'url' => route('hospital.edit', ['hospital' => $hospital->id])],
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string',
            'phone' => 'required|string|max:255'
        ]);

        try {
            $hospital = Hospital::findOrFail($id);
            $hospital->update($request->all());

            return redirect()->route('hospital.index')->with('success', 'Data berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->route('hospital.index')->with('error', 'Terjadi kesalahan. Silahkan coba lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $hospital = Hospital::findOrFail($id);
            $hospital->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silahkan coba lagi.'
            ], 500);
        }
    }
}
