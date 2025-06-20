<table>
    <thead>
        <tr>
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>Ditambahkan Oleh</th>
            <th colspan="2">Siswa Dibuat Pada</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($siswa as $siswa)
            <tr>
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->username }}</td>
                <td>{{ $siswa->admin }}</td>
                <td>{{ \Carbon\Carbon::parse($siswa->created_at)->format('d-F-Y H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
