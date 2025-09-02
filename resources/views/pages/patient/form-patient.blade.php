<x-layouts.app>
    <div class="flex flex-1 flex-col h-full w-full gap-4 rounded-xl">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h1 class="text-2xl font-bold">Data Pasien</h1>
            <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
        </div>
        <div
            class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:border-zinc-700 dark:bg-zinc-900">
            <div class="w-full">
                <h2 class="text-xl font-bold mb-3">{{ isset($patient) ? 'Edit Data' : 'Tambah Data' }}</h2>

                @php
                    $isEdit = isset($patient);
                @endphp

                @if ($errors->any())
                    <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ $isEdit ? route('patient.update', $patient->id) : route('patient.store') }}"
                    method="POST" enctype="multipart/form-data" class="space-y-4">

                    @csrf
                    @if ($isEdit)
                        @method('PUT')
                    @endif

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pasien</label>
                        <input type="text" id="name" name="name" required
                            value="{{ old('name', $patient->name ?? '') }}" placeholder="Nama Pasien"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                            Telepon</label>
                        <input type="number" id="phone" name="phone" required
                            value="{{ old('phone', $patient->phone ?? '') }}" placeholder="08xxxxxx"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                        <textarea id="address" name="address" placeholder="Alamat"
                            class="min-h-30 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{!! old('address', $patient->address ?? '') !!}</textarea>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rumah Sakit</label>
                        <select name="id_hospital" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">-- Pilih Rumah Sakit --</option>
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital->id }}"
                                    {{ old('id_hospital', $patient->id_hospital ?? '') == $hospital->id ? 'selected' : '' }}>
                                    {{ $hospital->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button id="submit-button" type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
