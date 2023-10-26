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
                            {{ __("Tambah Rekam Medis") }}
                        </div>
                                                
                        <form class="px-10 pb-6" action="{{ route('admin.rekam.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <select name="pasien" id="pasien" class="block bg-transparent py-2.5 px-0 w-full text-sm border-0 border-b-2 border-gray-300 appearance-none text-gray-500 dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                        <option value="" selected disabled> Pilih Pasien </option>
                                        @foreach($pasien as $pasien)
                                            <option value="{{ $pasien->id }}">{{ $pasien->name }}</option>
                                        @endforeach
                                    </select>
                                    <!-- <label for="pasien" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">pasien rekam</label> -->
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <select name="dokter" id="dokter" class="block bg-transparent py-2.5 px-0 w-full text-sm border-0 border-b-2 border-gray-300 appearance-none text-gray-500 dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                        <option value="" selected disabled> Pilih dokter </option>
                                        @foreach($dokter as $dokter)
                                            <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="kondisi" id="kondisi" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="kondisi" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kondisi Kesehatan</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="suhu" id="suhu" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="suhu" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Suhu Tubuh</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400" for="picture">Gambar Resep</label>
                                <input value="{{old('picture')}}" name="picture" id="picture" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="picture_help" type="file">
                            </div>
                            <button type="submit" class="text-white bg-blue-700 mb-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
