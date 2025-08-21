<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran Peserta Didik Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        td, th {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }
        .no-border {
            border: none !important;
        }
        .center {
            text-align: center;
        }
        .section-title {
            font-weight: bold;
            text-align: center;
            background: #e0e0e0;
            padding: 4px;
        }
        .checkbox {
            width: 10px;
            height: 10px;
            border: 1px solid #000;
            display: inline-block;
            vertical-align: middle;
            margin-right: 5px;
        }
        .photo-box {
            width: 3cm;
            height: 4cm;
            border: 1px solid black;
            font-size: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px auto;
        }
        .signature-box {
            height: 40px;
            border-bottom: 1px solid #000;
            margin: 8px auto;
            width: 80%;
        }
        .gray-bar {
            background: #888;
            color: #fff;
            padding: 6px;
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }
        .requirement-list {
            font-size: 11px;
            margin-top: 6px;
        }
        .label-col {
            width: 3%;
            text-align: center;
        }
        .w-25 { width: 25%; }
        .w-20 { width: 20%; }
        .w-15 { width: 15%; }
        .w-10 { width: 10%; }
        strong.label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="center" style="margin-bottom: 10px;">
        <h3 style="margin: 2px;">SMK MA'ARIF NU 01 KETANGGUNGAN KAB. BREBES</h3>
        <h4 style="margin: 2px;">TAHUN PELAJARAN 2025 / 2026</h4>
    </div>

    <table>
        <colgroup>
            <col class="label-col">
            <col class="w-25">
            <col class="w-25">
            <col class="w-15">
            <col class="w-15">
            <col>
        </colgroup>
        <tr>
            <td colspan="7" class="section-title">
                Pilihan Program Keahlian
                <div style="margin-top: 4px;">
                    <div class="checkbox" style="background-color: {{ $pendaftar->pilihan_program == 'TKJ' ? '#000' : '#fff' }}"></div> TKJ
                    <div class="checkbox" style="margin-left: 20px; background-color: {{ $pendaftar->pilihan_program == 'OTOMOTIF' ? '#000' : '#fff' }}"></div> OTOMOTIF
                </div>
            </td>
        </tr>

        <tr><td colspan="7" class="section-title">IDENTITAS PESERTA DIDIK BARU</td></tr>
        <tr><td>a.</td><td><strong class="label">Nama Lengkap</strong></td><td colspan="5">{{ $pendaftar->nama }}</td></tr>
        <tr><td>b.</td><td><strong class="label">Tempat, Tanggal Lahir</strong></td><td colspan="5">{{ $pendaftar->tempat_tanggal_lahir }}</td></tr>
        <tr>
            <td>c.</td><td><strong class="label">Jenis Kelamin</strong></td>
            <td colspan="5">
                <div class="checkbox" style="background-color: {{ $pendaftar->jenis_kelamin == 'Laki-Laki' ? '#000' : '#fff' }}"></div> Laki-laki
                <div class="checkbox" style="margin-left: 20px; background-color: {{ $pendaftar->jenis_kelamin == 'Perempuan' ? '#000' : '#fff' }}"></div> Perempuan
            </td>
        </tr>
        <tr><td>d.</td><td><strong class="label">Agama</strong></td><td colspan="5">{{ $pendaftar->agama }}</td></tr>
        <tr><td>e.</td><td><strong class="label">NISN</strong></td><td colspan="5">{{ $pendaftar->nisn }}</td></tr>
        <tr><td>f.</td><td><strong class="label">Asal Sekolah</strong></td><td colspan="5">{{ $pendaftar->asal_sekolah }}</td></tr>
        <tr><td>g.</td><td><strong class="label">Alamat</strong></td><td colspan="5">{{ $pendaftar->alamat }}</td></tr>
        <tr>
            <td></td><td><strong class="label">Desa</strong></td><td>{{ $pendaftar->desa }}</td>
            <td><strong class="label">RT</strong></td><td>{{ $pendaftar->rt }}</td>
            <td><strong class="label">RW</strong></td><td>{{ $pendaftar->rw }}</td>
        </tr>
        <tr>
            <td></td><td><strong class="label">Kecamatan</strong></td><td>{{ $pendaftar->kecamatan }}</td>
            <td><strong class="label">Kode Pos</strong></td><td>{{ $pendaftar->kode_pos }}</td>
            <td colspan="2" class="no-border"></td><td class="no-border"></td>
        </tr>
        <tr><td></td><td><strong class="label">Kabupaten</strong></td><td colspan="5">{{ $pendaftar->kabupaten }}</td></tr>
        <tr><td></td><td><strong class="label">Provinsi</strong></td><td colspan="5">{{ $pendaftar->provinsi }}</td></tr>
        <tr><td>h.</td><td><strong class="label">Jumlah Saudara</strong></td><td>{{ $pendaftar->jml_saudara }}</td><td><strong class="label">Anak Ke</strong></td><td colspan="3">{{ $pendaftar->anak_ke }}</td></tr>
        <tr><td>i.</td><td><strong class="label">No. Telp Rumah</strong></td><td>{{ $pendaftar->telp_rumah }}</td><td><strong class="label">No. HP</strong></td><td colspan="3">{{ $pendaftar->hp }}</td></tr>
        <tr><td>j.</td><td><strong class="label">Nama Ayah</strong></td><td>{{ $pendaftar->nama_ayah }}</td><td><strong class="label">Tahun Lahir</strong></td><td colspan="3">{{ $pendaftar->tahun_ayah }}</td></tr>
        <tr><td>k.</td><td><strong class="label">Nama Ibu</strong></td><td>{{ $pendaftar->nama_ibu }}</td><td><strong class="label">Tahun Lahir</strong></td><td colspan="3">{{ $pendaftar->tahun_ibu }}</td></tr>
        <tr><td>l.</td><td><strong class="label">Pekerjaan Ayah</strong></td><td>{{ $pendaftar->pekerjaan_ayah }}</td><td><strong class="label">Penghasilan</strong></td><td colspan="3">{{ $pendaftar->penghasilan_ayah }}</td></tr>
        <tr><td>m.</td><td><strong class="label">Pekerjaan Ibu</strong></td><td>{{ $pendaftar->pekerjaan_ibu }}</td><td><strong class="label">Penghasilan</strong></td><td colspan="3">{{ $pendaftar->penghasilan_ibu }}</td></tr>
        <tr><td>n.</td><td><strong class="label">{{ $pendaftar->nama_wali ? 'Alamat Wali' : 'Alamat Orang Tua' }}</strong></td><td colspan="5">{{ $pendaftar->nama_wali ? $pendaftar->alamat_ortu : $pendaftar->alamat_ortu }}</td></tr>
        <tr><td>o.</td><td><strong class="label">Nama Wali</strong></td><td>{{ $pendaftar->nama_wali }}</td><td><strong class="label">Tahun Lahir</strong></td><td colspan="3">{{ $pendaftar->tahun_wali }}</td></tr>
        <tr><td>p.</td><td><strong class="label">Pekerjaan Wali</strong></td><td>{{ $pendaftar->pekerjaan_wali }}</td><td><strong class="label">Penghasilan</strong></td><td colspan="3">{{ $pendaftar->penghasilan_wali }}</td></tr>
        <tr><td>q.</td><td><strong class="label">Penerima KIP</strong></td><td>{{ $pendaftar->kip ? 'YA' : 'TIDAK' }}
</td><td><strong class="label">No. KIP</strong></td><td colspan="3">{{ $pendaftar->nomor_kip }}</td></tr>
        <tr><td>r.</td><td><strong class="label">Tinggi Badan</strong></td><td>{{ $pendaftar->tinggi_badan }} cm</td><td><strong class="label">Berat Badan</strong></td><td colspan="3">{{ $pendaftar->berat_badan }} kg</td></tr>
    </table>

    <table class="no-border" style="margin-top: 30px; width: 100%;">
        <tr class="no-border">
            <td class="center no-border" style="width: 33%;">
                Mengetahui,<br><strong>Orang Tua/Wali</strong>
                <div class="signature-box"></div>
                <div>(..............................)</div>
            </td>
            <td class="center no-border" style="width: 33%;">
                <div class="photo-box">Foto 3x4</div>
            </td>
            <td class="center no-border" style="width: 33%;">
                {{ $pendaftar->kabupaten ?? '...................' }}, ................ 20...
                <br><strong>Pendaftar</strong>
                <div class="signature-box"></div>
                <div>(..............................)</div>
            </td>
        </tr>
    </table>

    <div class="gray-bar">
        www.smknusaka.sch.id
    </div>

    <div class="requirement-list">
        <strong>PERSYARATAN PENDAFTARAN:</strong>
        <ol>
            <li>Fotokopi Ijazah/Surat Kelulusan</li>
            <li>Fotokopi Akta Kelahiran</li>
            <li>Fotokopi Kartu Keluarga</li>
            <li>Fotokopi NISN</li>
            <li>Fotokopi KTP Orang Tua</li>
            <li>Pas Foto 3x4 (2 lembar, latar merah)</li>
            <li>Fotokopi KIP (jika ada)</li>
        </ol>
    </div>
</body>
</html>
