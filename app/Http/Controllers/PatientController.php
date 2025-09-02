<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Patient;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Patient::with('hospital')->orderBy('name', 'asc');

            if (request()->has('id_hospital') && request('id_hospital') != '') {
                $query->where('id_hospital', request('id_hospital'));
            }

            $data = $query->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('hospital', function ($row) {
                    return $row->hospital ? $row->hospital->name : '-';
                })
                ->addColumn('action', function ($row) {
                    return '
                <div class="flex space-x-2">
                    <a href="' . route('patient.edit', $row->id) . '" 
                       class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 me-2 mb-2 dark:focus:ring-yellow-900">
                       <i class="bi bi-pencil-square"></i>
                    </a>
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

        $hospitals = Hospital::orderBy('name', 'asc')->get();

        return view('pages.patient.all-patient', [
            'hospitals' => $hospitals,
            'breadcrumbs' => [
                ['label' => 'Data Pasien', 'url' => route('patient.index')],
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals = Hospital::orderBy('name')->get();
        return view('pages.patient.form-patient', [
            'hospitals' => $hospitals,
            'breadcrumbs' => [
                ['label' => 'Data Pasien', 'url' => route('patient.index')],
                ['label' => 'Tambah Data', 'url' => route('patient.create')],
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
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'id_hospital' => 'required|exists:hospitals,id',
        ]);

        try {
            Patient::create($request->all());

            return redirect()->route('patient.index')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->route('patient.index')->with('error', 'Terjadi kesalahan. Silahkan coba lagi nanti.');
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(Patient $patient)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        $hospitals = Hospital::orderBy('name')->get();
        return view('pages.patient.form-patient', [
            'patient' => $patient,
            'hospitals' => $hospitals,
            'breadcrumbs' => [
                ['label' => 'Data Pasien', 'url' => route('patient.index')],
                ['label' => 'Edit Data', 'url' => route('patient.edit', ['patient' => $patient->id])],
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'id_hospital' => 'required|exists:hospitals,id',
        ]);

        try {
            $patient = Patient::findOrFail($id);
            $patient->update($request->all());

            return redirect()->route('patient.index')->with('success', 'Data berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->route('patient.index')->with('error', 'Terjadi kesalahan. Silahkan coba lagi nanti.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $patient = Patient::findOrFail($id);
            $patient->delete();

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
