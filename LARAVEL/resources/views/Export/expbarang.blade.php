<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Ditambahkan Oleh</th>
            <th>Kategori</th>
            <th>Kondisi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($barangs as $barang)
            <tr>
                <td>{{ $barang->id }}</td>
                <td>{{ $barang->kode_barang }}</td>
                <td>{{ $barang->nama }}</td>
                <td>{{ $barang->admin }}</td>
                <td>{{ $barang->kategori->nama_kategori }}</td>
                <td>{{ $barang->kondisi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
