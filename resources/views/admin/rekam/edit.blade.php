<x-app-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>
    
    <div>
        @include('layouts.Sidebar')
        <div class="p-4 sm:ml-64">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="py-7 px-10 text-gray-900 dark:text-gray-100">
                            {{ __("Edit Rekam Medis") }}
                        </div>
                        
                        <form class="px-10 pb-6" method="post" action="{{ route('admin.rekam.update', $rekam->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="mb-4">
                                <x-input-label for="pasien" :value="__('name Pasien')" />
                                <x-text-input id="pasien" name="pasien" type="text" class="mt-1 block w-full" :value="old('pasien', $rekam->name_pasien)" required autofocus autocomplete="pasien" />
                                <x-input-error class="mt-2" :messages="$errors->get('pasien')" />
                            </div>
                            <div class="mb-4">
                                <x-input-label for="dokter" :value="__('name Dokter')" />
                                <x-text-input id="dokter" name="dokter" type="text" class="mt-1 block w-full" :value="old('dokter', $rekam->name_dokter)" required autofocus autocomplete="dokter" />
                                <x-input-error class="mt-2" :messages="$errors->get('dokter')" />
                            </div>
                            <div class="mb-4">
                                <x-input-label for="kondisi" :value="__('Kondisi Kesehatan')" />
                                <x-text-input id="kondisi" name="kondisi" type="text" class="mt-1 block w-full" :value="old('kondisi', $rekam->kondisi)" required autofocus autocomplete="kondisi" />
                                <x-input-error class="mt-2" :messages="$errors->get('kondisi')" />
                            </div>
                            <div class="mb-4">
                                <x-input-label for="suhu" :value="__('Suhu Tubuh')" />
                                <x-text-input id="suhu" name="suhu" type="text" class="mt-1 block w-full" :value="old('suhu', $rekam->suhu)" required autofocus autocomplete="suhu" />
                                <x-input-error class="mt-2" :messages="$errors->get('suhu')" />
                            </div>
                            <button type="submit" class="text-white bg-blue-700 mb-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
