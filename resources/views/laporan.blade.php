<x-layout :title="$title">
    @section('page')
        <main class="bg-slate-100 h-screen pt-20 p-4 sm:ml-64 font-poppins">
            <div class="relative overflow-x-auto">
                <div class="space-y-4">
                    <h1 class="text-2xl">{{ $title }}</h1>
                    <form action="{{ route('laporan.print') }}" method="POST">
                        @csrf
                        <div class="flex flex-col space-y-4">
                            <div>
                                <label for="bulan">Pilih Bulan:</label>
                                <select name="bulan" id="bulan" required>
                                    @foreach ($bulanPembayaran as $bulan)
                                        <option value="{{ $bulan->id }}">{{ $bulan->nama_bulan }} | {{ $bulan->tahun }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="start_date">Dari Tanggal:</label>
                                <input type="date" name="start_date" id="start_date">
                            </div>
                            <div>
                                <label for="end_date">Sampai Tanggal:</label>
                                <input type="date" name="end_date" id="end_date">
                            </div>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Cetak PDF</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    @endsection
</x-layout>
