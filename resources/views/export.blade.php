<table border="1">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tingkat Pendidikan</th>
        <th>Tingkat Ska</th>
        <th>Lama Kerja</th>
        <th>Jabatan Yang Diusulkan</th>
    </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
    @foreach($pesertas as $peserta)
        <tr>
            <td rowspan="{{ count($peserta->peserta->listData()) + 2 }}">{{ $i++ }}</td>
            <td rowspan="{{ count($peserta->peserta->listData()) + 2 }}">{{ $peserta->peserta->nama }}</td>
        </tr>
        <tr>
            <td>{{ $peserta->peserta->firstIjazah() }}</td>
            <td>{{ $peserta->peserta->firstSka() }}</td>
            <td>{{ $peserta->peserta->getLamaKerja() }}</td>
            <td rowspan="{{ count($peserta->peserta->listData()) + 2 }}">{{$peserta->divisi}}</td>
        </tr>
        @foreach ($peserta->peserta->listData() as $item)
            <tr>
                <td>{{ $item['ijazah'] }}</td>
                <td>{{ $item['ska'] }}</td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>