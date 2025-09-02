<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="relative grid auto-rows-min gap-3 grid-cols-3 overflow-hidden rounded-xl border border-neutral-200 dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center justify-center m-auto p-5 w-fit h-fit">
                    <i class="bi bi-pencil-square text-3xl"></i>
                </div>
                <div class="col-span-2 py-5 text-start">
                    <h4 class="text-xl font-bold">{{ $countHospitals }}</h4>
                    <p class="text-md">Rumah Sakit</p>
                </div>
            </div>
            <div
                class="relative grid auto-rows-min gap-3 grid-cols-3 overflow-hidden rounded-xl border border-neutral-200 dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center justify-center m-auto p-5 w-fit h-fit">
                    <i class="bi bi-check2-circle text-3xl"></i>
                </div>
                <div class="col-span-2 py-5 text-start">
                    <h4 class="text-xl font-bold">{{ $countPatients }}</h4>
                    <p class="text-md">Pasien</p>
                </div>
            </div>
            <div
                class="relative grid auto-rows-min gap-3 grid-cols-3 overflow-hidden rounded-xl border border-neutral-200 dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center justify-center m-auto p-5 w-fit h-fit">
                    <i class="bi bi-x-circle text-3xl"></i>
                </div>
                <div class="col-span-2 py-5 text-start">
                    <h4 class="text-xl font-bold">3</h4>
                    <p class="text-md">Berita Tidak Aktif</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
