<html>

    <head>
        <title>Laporan Bulanan</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            table,
            th,
            td {
                border: 1px solid black;
            }

            th,
            td {
                padding: 8px;
                text-align: left;
            }
        </style>
    </head>

    <body>
        <h1>Laporan Bulanan: {{ $bulan->nama_bulan }} {{ $bulan->tahun }}</h1>

        <h2>Pemasukan</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Minggu Ke-1</th>
                    <th>Minggu Ke-2</th>
                    <th>Minggu Ke-3</th>
                    <th>Minggu Ke-4</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemasukan as $item)
                    <tr>
                        <td>{{ $item->siswa->nama_siswa }}</td>
                        <td>{{ number_format($item->minggu_ke_1) }}</td>
                        <td>{{ number_format($item->minggu_ke_2) }}</td>
                        <td>{{ number_format($item->minggu_ke_3) }}</td>
                        <td>{{ number_format($item->minggu_ke_4) }}</td>
                        <td>{{ number_format($item->minggu_ke_1 + $item->minggu_ke_2 + $item->minggu_ke_3 + $item->minggu_ke_4) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Pengeluaran</h2>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengeluaran as $item)
                    <tr>
                        <td>{{ $item->tanggal_pengeluaran }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ number_format($item->jumlah_pengeluaran) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>

</html>
