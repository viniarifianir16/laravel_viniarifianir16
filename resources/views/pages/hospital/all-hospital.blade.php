<x-layouts.app>
    <div class="flex flex-1 flex-col h-full w-full gap-4 rounded-xl">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h1 class="text-2xl font-bold">Data Rumah Sakit</h1>
            <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
        </div>
        @include ('components.cards.hospital-card')
    </div>
</x-layouts.app>

<script>
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
