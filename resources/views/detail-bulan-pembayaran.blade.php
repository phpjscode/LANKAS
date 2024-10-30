<x-layout :title="$title">
    @section('page')
        <h1>{{ $title }}</h1>
        <div class="p-6 bg-white rounded-lg max-w-lg">
            <h2 class="text-xl text-gray-900 mb-2">{{ $bulan->nama_bulan }} {{ $bulan->tahun }}</h2>
            <p class="text-sm text-gray-500 mb-2">Pembayaran per minggu: Rp{{ number_format($bulan->pembayaran_perminggu) }}
            </p>

            <h3 class="text-lg text-gray-900 mb-4">Detail Uang Kas:</h3>
            <ul>
                @foreach ($bulan->uangKas as $kas)
                    <li class="mb-2">
                        Siswa: {{ $kas->siswa->nama }} - Minggu 1: Rp{{ number_format($kas->minggu_ke_1) }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endsection
</x-layout>
