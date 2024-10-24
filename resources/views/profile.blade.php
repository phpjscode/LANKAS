<x-layout :title="$title">
    @section('page')
        <main class="bg-slate-100 pt-20 p-4 sm:ml-64 font-poppins h-screen">
            <section class="space-y-2">
                <div>
                    <h1 class="text-2xl text-gray-900">{{ $title }}</h1>
                </div>
                <ul class="bg-white rounded-lg shadow-md p-2">
                    <li class="border-b border-slate-100 p-2 text-sm">
                        Nama: {{ $user->name }}
                    </li>
                    <li class="p-2 text-sm">
                        Email: {{ $user->email }}
                    </li>
                </ul>

                <div class="flex items-center space-x-2">
                    <button
                        class="flex items-center justify-center gap-x-1 bg-[#218838] px-2.5 py-2 rounded-lg hover:bg-green-600 transition duration-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#ffffff" class="w-5 h-5">
                            <path
                                d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
                        </svg>
                        <p class="text-sm text-white">Edit</p>
                    </button>
                    <button
                        class="flex items-center justify-center gap-x-1 bg-red-600 px-2.5 py-2 rounded-lg hover:bg-red-700 transition duration-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#ffffff" class="w-5 h-5">
                            <path
                                d="M80-200v-80h800v80H80Zm46-242-52-30 34-60H40v-60h68l-34-58 52-30 34 58 34-58 52 30-34 58h68v60h-68l34 60-52 30-34-60-34 60Zm320 0-52-30 34-60h-68v-60h68l-34-58 52-30 34 58 34-58 52 30-34 58h68v60h-68l34 60-52 30-34-60-34 60Zm320 0-52-30 34-60h-68v-60h68l-34-58 52-30 34 58 34-58 52 30-34 58h68v60h-68l34 60-52 30-34-60-34 60Z" />
                        </svg>
                        <p class="text-sm text-white">Change Password</p>
                    </button>
                </div>
            </section>
        </main>
    @endsection
</x-layout>
