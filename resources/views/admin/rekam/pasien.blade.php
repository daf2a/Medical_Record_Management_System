@php
$previousPasien = null;
@endphp

<x-app-layout>
    <x-slot name="title">
        Rekam Medis
    </x-slot>
    
    <div>
        @include('layouts.Sidebar')
        <div class="p-4 sm:ml-64">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @foreach($rekams as $rekam)
                    @if($rekam->name_pasien != $previousPasien)
                        @php
                        $previousPasien = $rekam->name_pasien;
                        @endphp

                        <h3 class="bg-blue-100 text-blue-800 text-2xl font-semibold px-2.5 y-6 py-1 mb-5 mt-8 rounded dark:bg-gray-700 dark:text-gray-200">{{ $rekam->name_pasien }}</h3>
                        <div class="container mx-auto gap-8 flex flex-col sm:flex-row flex-wrap">
                            @foreach($rekams as $rekamInner)
                                @if($rekamInner->name_pasien == $rekam->name_pasien)
                                    <div class="w-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        @if (file_exists(public_path('storage/' . $rekamInner->picture)))
                                            <img draggable="false" class="object-cover w-full h-48 rounded-t-lg" src="{{ asset('storage/' . $rekamInner->picture) }}" alt="{{ $rekamInner->id }}">
                                        @else
                                            <img draggable="false" class="object-cover w-full h-48 rounded-t-lg" src="{{ $rekamInner->picture }}" alt="{{ $rekamInner->id }}">
                                        @endif
                                        <div class="p-5 justify-between">
                                                   
                                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $rekamInner->kondisi }}</p>
                                            <div class="mb-3 grid grid-cols-1 gap-4">
                                                <div>
                                                    <p class="mb-1 font-normal text-sm text-gray-700 dark:text-white">Dokter : {{ $rekamInner->name_dokter }}</p>
                                                    <p class="mb-1 font-normal text-sm text-gray-700 dark:text-white">Suhu Tubuh : {{ $rekamInner->suhu }} °C</p>
                                                </div>
                                            </div>

                                            <div class="flex">
                                                <a href="{{ route('admin.rekam.edit', $rekamInner->id) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.rekam.destroy', $rekamInner->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-4 py-2 ml-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-blue">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
