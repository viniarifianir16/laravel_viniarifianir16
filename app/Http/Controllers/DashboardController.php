<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Patient;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countHospitals = Hospital::count();
        $countPatients = Patient::count();

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

        return view('pages.dashboard.dashboard', [
            'countHospitals' => $countHospitals,
            'countPatients' => $countPatients,
            'breadcrumbs' => [
                ['label' => 'Data Rumah Sakit', 'url' => route('hospital.index')],
                ['label' => 'Tambah Data', 'url' => route('hospital.create')],
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
