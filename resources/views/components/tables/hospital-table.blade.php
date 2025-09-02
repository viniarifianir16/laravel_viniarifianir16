<div class="overflow-auto">
    <table id="hospital-table" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#hospital-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url()->current() }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
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
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

    $(document).on("click", ".delete-btn", function() {
        let id = $(this).data("id");

        Swal.fire({
            title: "Yakin hapus data?",
            text: "Data tidak bisa dikembalikan setelah dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!"
        }).then((result) => {
            Swal.fire({
                title: "Menghapus...",
                text: "Mohon tunggu sebentar",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            if (result.isConfirmed) {
                $.ajax({
                    url: "/hospital/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire("Berhasil!", response.message, "success");
                            $('#hospital-table').DataTable().ajax
                                .reload();
                        } else {
                            Swal.fire("Gagal!", response.message, "error");
                        }
                    },
                    error: function(xhr) {
                        Swal.fire("Error!", "Terjadi kesalahan server!", "error");
                    }
                });
            }
        });
    });
</script>
