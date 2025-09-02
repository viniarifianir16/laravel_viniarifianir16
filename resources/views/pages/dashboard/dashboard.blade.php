<x-layouts.app :title="__('Dashboard')">
    <div>
        <div
            class="flex flex-col lg:flex-row lg:items-center justify-between p-6 mb-6 text-white overflow-hidden rounded-xl border bg-gradient-to-br from-blue-500 to-cyan-500 dark:from-zinc-800 dark:to-zinc-900 dark:text-white dark:border-zinc-700 shadow-lg">

            <!-- Left content -->
            <div class="flex-1 grid gap-4">
                <h1 class="text-3xl font-bold">Hello {{ auth()->user()->name }}!</h1>
                <p class="text-lg">{{ now()->format('l, d M Y') }}</p>

                <div class="flex flex-col sm:flex-row gap-6">
                    <!-- Rumah Sakit -->
                    <div
                        class="flex items-center gap-3 w-50 bg-white/20 dark:bg-zinc-900/40 rounded-lg px-4 py-3 shadow-sm">
                        <i class="bi bi-hospital text-3xl"></i>
                        <div>
                            <h4 class="text-xl font-bold">{{ $countHospitals }}</h4>
                            <p class="text-md">Rumah Sakit</p>
                        </div>
                    </div>

                    <!-- Pasien -->
                    <div
                        class="flex items-center gap-3 w-50 bg-white/20 dark:bg-zinc-900/40 rounded-lg px-4 py-3 shadow-sm">
                        <i class="bi bi-person-raised-hand text-3xl"></i>
                        <div>
                            <h4 class="text-xl font-bold">{{ $countPatients }}</h4>
                            <p class="text-md">Pasien</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right image -->
            <div class="hidden lg:block xl:block">
                <img src="/image2.png" alt="Dashboard" class="w-100 h-auto">
            </div>
        </div>

        {{-- <div class="flex h-full w-full flex-1 flex-col gap-4 mb-4 rounded-xl">
            <div class="grid grid-cols-2 auto-rows-min gap-4">
                <div
                    class="relative grid auto-rows-min gap-3 grid-cols-3 overflow-hidden rounded-xl border bg-sky-200 border-neutral-200 dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="flex items-center justify-center m-auto p-5 w-fit h-fit">
                        <i class="bi bi-hospital text-3xl"></i>
                    </div>
                    <div class="col-span-2 py-5 text-start">
                        <h4 class="text-xl font-bold">{{ $countHospitals }}</h4>
                        <p class="text-md">Rumah Sakit</p>
                    </div>
                </div>
                <div
                    class="relative grid auto-rows-min gap-3 grid-cols-3 overflow-hidden rounded-xl border bg-sky-200 border-neutral-200 dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="flex items-center justify-center m-auto p-5 w-fit h-fit">
                        <i class="bi bi-person-raised-hand text-3xl"></i>
                    </div>
                    <div class="col-span-2 py-5 text-start">
                        <h4 class="text-xl font-bold">{{ $countPatients }}</h4>
                        <p class="text-md">Pasien</p>
                    </div>
                </div>
            </div>
        </div> --}}

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
