<x-app-layout>
    <x-slot name="title">
        Pasiens
    </x-slot>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
                {{ __('Pasiens List') }}
            </h2>
            <form action="{{ route('pasiens.list') }}" method="get" class="w-1/2 inline-block">   
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" name="query" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search here..." required>
                    <input type="hidden" name="sort_by" value="{{ $sort_by }}">
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </form>
        </div>
    </x-slot>

    
    <div class="relative overflow-x-auto py-10">
    @if(isset($pasiens))
    <div class="mx-auto w-full px-8 overflow-x-auto lg:px-56 md:px-14">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>    
                <th scope="col" class="px-6 py-3 rounded-tl-lg">
                    <div class="flex items-center">
                        NO
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Name
                        <div class="hidden sm:flex sm:items-center">
                            <x-dropdown align="left" width="24">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-0 font-medium rounded-md text-gray-500 dark:text-gray-40 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">

                                        <div class="ml-1">
                                            <svg class="w-3 h-3 ml-1.5 opacity: 0.4;" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                
                                <x-slot name="content">
                                    <form action="{{ route('pasiens.list') }}" method="get">
                                        <input type="hidden" name="query" value="{{ $query }}">
                                        <input type="hidden" name="sort_by" value="name_asc">
                                        <button type="submit">
                                            <x-dropdown-link>
                                                {{ __('asc') }}
                                            </x-dropdown-link>
                                        </button>
                                    </form>
                                    <form action="{{ route('pasiens.list') }}" method="get">
                                        <input type="hidden" name="query" value="{{ $query }}">
                                        <input type="hidden" name="sort_by" value="name_desc">
                                        <button type="submit">
                                            <x-dropdown-link>
                                                {{ __('desc') }}
                                            </x-dropdown-link>
                                        </button>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Email
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Phone Number
                    </div>
                </th>
                <th scope="col" class="px-3 py-3">
                    <div class="flex items-center">
                        Age
                        <div class="hidden sm:flex sm:items-center">
                            <x-dropdown align="left" width="24">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-0 font-medium rounded-md text-gray-500 dark:text-gray-40 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">

                                        <div class="ml-1">
                                            <svg class="w-3 h-3 ml-1.5 opacity: 0.4;" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                
                                <x-slot name="content">
                                    <form action="{{ route('pasiens.list') }}" method="get">
                                        <input type="hidden" name="query" value="{{ $query }}">
                                        <input type="hidden" name="sort_by" value="age_asc">
                                        <button type="submit">
                                            <x-dropdown-link>
                                                {{ __('asc') }}
                                            </x-dropdown-link>
                                        </button>
                                    </form>
                                    <form action="{{ route('pasiens.list') }}" method="get">
                                        <input type="hidden" name="query" value="{{ $query }}">
                                        <input type="hidden" name="sort_by" value="age_desc">
                                        <button type="submit">
                                            <x-dropdown-link>
                                                {{ __('desc') }}
                                            </x-dropdown-link>
                                        </button>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </th>
                <th scope="col" class="px-3 py-3">
                    <div class="flex items-center">
                        Height
                        <div class="hidden sm:flex sm:items-center">
                            <x-dropdown align="left" width="24">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-0 font-medium rounded-md text-gray-500 dark:text-gray-40 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">

                                        <div class="ml-1">
                                            <svg class="w-3 h-3 ml-1.5 opacity: 0.4;" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                
                                <x-slot name="content">
                                    <form action="{{ route('pasiens.list') }}" method="get">
                                        <input type="hidden" name="query" value="{{ $query }}">
                                        <input type="hidden" name="sort_by" value="height_asc">
                                        <button type="submit">
                                            <x-dropdown-link>
                                                {{ __('asc') }}
                                            </x-dropdown-link>
                                        </button>
                                    </form>
                                    <form action="{{ route('pasiens.list') }}" method="get">
                                        <input type="hidden" name="query" value="{{ $query }}">
                                        <input type="hidden" name="sort_by" value="height_desc">
                                        <button type="submit">
                                            <x-dropdown-link>
                                                {{ __('desc') }}
                                            </x-dropdown-link>
                                        </button>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </th>
                <th scope="col" class="px-3 py-3">
                    <div class="flex items-center">
                        Weight
                        <div class="hidden sm:flex sm:items-center">
                            <x-dropdown align="left" width="24">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-0 font-medium rounded-md text-gray-500 dark:text-gray-40 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">

                                        <div class="ml-1">
                                            <svg class="w-3 h-3 ml-1.5 opacity: 0.4;" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                
                                <x-slot name="content">
                                    <form action="{{ route('pasiens.list') }}" method="get">
                                        <input type="hidden" name="query" value="{{ $query }}">
                                        <input type="hidden" name="sort_by" value="weight_asc">
                                        <button type="submit">
                                            <x-dropdown-link>
                                                {{ __('asc') }}
                                            </x-dropdown-link>
                                        </button>
                                    </form>
                                    <form action="{{ route('pasiens.list') }}" method="get">
                                        <input type="hidden" name="query" value="{{ $query }}">
                                        <input type="hidden" name="sort_by" value="weight_desc">
                                        <button type="submit">
                                            <x-dropdown-link>
                                                {{ __('desc') }}
                                            </x-dropdown-link>
                                        </button>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </th>
                <th scope="col" class="rounded-tr-lg">
                </th>
            </tr>
        </thead>
        @if(count($pasiens)>0)
        <tbody>
            @foreach($pasiens as $index => $pasien)
                @if($index % 2 == 0)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                @else
                    <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                @endif
                    <td class="px-6 py-4">
                        {{ $index + $pasiens->firstItem() }}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $pasien->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $pasien->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $pasien->phone_number }}
                    </td> 
                    <td class="px-3 py-4">
                        {{ $pasien->age }}
                    </td> 
                    <td class="px-3 py-4">
                        {{ $pasien->height }}
                    </td> 
                    <td class="px-3 py-4">
                        {{ $pasien->weight }}
                    </td> 
                    <td>
                        <div class="flex gap-1 mr-5">
                            <a href="{{ route('pasiens.edit', ['id' => $pasien->id]) }}" data-id="{{ $pasien->id }}" data-tooltip-target="card-cta-example-toggle-dark-mode-tooltip" class="flex items-center w-9 h-9 justify-center text-xs font-medium text-gray-700 bg-white border border-gray-200 rounded-lg toggle-dark-state-example hover:bg-emerald-500 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-500 dark:bg-gray-800 focus:outline-none dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-emerald-500">
                                <svg data-toggle-icon="edit" class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                                    <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                                </svg>
                                <span class="sr-only">Edit</span>
                            </a>
                            <a href="{{ route('pasiens.delete', ['id' => $pasien->id]) }}" data-id="{{ $pasien->id }}" data-tooltip-target="card-cta-example-toggle-dark-mode-tooltip" class="flex items-center w-9 h-9 justify-center text-xs font-medium text-gray-700 bg-white border border-gray-200 rounded-lg toggle-dark-state-example hover:bg-red-500 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-500 dark:bg-gray-800 focus:outline-none dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-red-500">
                                <svg data-toggle-icon="remove" class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z"/>
                                </svg>
                                <span class="sr-only">Remove</span>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        @else
            <tr>
                <td class="text-center py-6 font-semibold" colspan="7">
                    <h2 class="text-xl font-bold">"{{ $query }}" not found!</h2>
                </td>
            </tr>
        @endif
    </table>
    </div>
    @endif
    @if(count($pasiens)>0)
        <nav class="mx-auto w-full px-8 overflow-x-auto lg:px-56 md:px-24 justify-between pt-4" aria-label="Table navigation">
            {{ $pasiens->appends(['sort_by' => request('sort_by')])->appends(['query' => request ('query')])->links() }}
        </nav>
    @endif
    
</x-app-layout>
