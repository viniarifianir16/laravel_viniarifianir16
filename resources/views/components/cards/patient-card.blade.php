<div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
    <div class="flex flex-wrap items-center justify-between gap-4 my-4">
        <div>
            <a href="{{ route('patient.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                <i class="bi bi-plus-lg mr-1"></i>
                Tambah Pasien
            </a>
        </div>
        <div>
            <select id="filter-hospital">
                <option value="">-- Filter Rumah Sakit --</option>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="overflow-auto">
        <table id="patient-table" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Rumah Sakit</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#filter-hospital').select2({
            placeholder: "-- Filter Rumah Sakit --",
            allowClear: true,
            width: 'resolve'
        });

        var table = $('#patient-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url()->current() }}',
                data: function(d) {
                    d.id_hospital = $('#filter-hospital').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'hospital',
                    name: 'hospital'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
        $('#filter-hospital').change(function() {
            table.ajax.reload();
        });
    });
</script>
