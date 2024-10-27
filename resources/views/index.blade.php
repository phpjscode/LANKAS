<x-layout :title="$title">
    @section('page')
        <main class="bg-slate-100 pt-20 p-4 sm:ml-64">
            <section>
                <div class="px-4 py-6 font-poppins">
                    <div>
                        <h1 class="text-2xl text-gray-900">{{ $title }}</h1>
                    </div>
                    <div class="grid">
                        <figure class="w-full bg-white rounded-md">
                            <div class="p-6 grid grid-cols gap-y-1">
                                <div class="flex items-center gap-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="undefined"
                                        class="w-6 h-6">
                                        <path
                                            d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                                    </svg>
                                    <p class="text-lg">Siswa</p>
                                </div>
                                <div>
                                    <p class="text-sm opacity-80">Jumlah Siswa: {{ $totalSiswa }}</p>
                                </div>
                                <a href="{{ route('siswa') }}"
                                    class="bg-sky-500 h-10 w-12 flex items-center justify-center rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#ffffff"
                                        class="h-6 w-6">
                                        <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                                    </svg>
                                </a>
                            </div>
                        </figure>
                    </div>
                </div>
            </section>
        </main>
    @endsection
</x-layout>
