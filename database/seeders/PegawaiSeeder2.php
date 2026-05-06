<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder2 extends Seeder
{
    public function run(): void
    {
        $pegawais = [
            ['nip' => '198606132010011051', 'nama' => 'Galih Pratama', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1986-06-13', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Kebijakan', 'alamat' => 'Jl. Salemba Raya No. 4, Salemba, Jakarta Pusat'],
            ['nip' => '199301222017012052', 'nama' => 'Maya Anggraeni', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1993-01-22', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff IT', 'alamat' => 'Jl. Ir. H. Juanda No. 36, Dago, Bandung'],
            ['nip' => '198207182007011053', 'nama' => 'Mulyadi Santoso', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1982-07-18', 'pendidikan_terakhir' => 'S2', 'jabatan' => 'Kepala Bagian Humas', 'alamat' => 'Jl. Kolonel Sugiono No. 55, Mergosono, Malang'],
            ['nip' => '199809142023012054', 'nama' => 'Aisyah Zahra', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1998-09-14', 'pendidikan_terakhir' => 'SMA/SMK', 'jabatan' => 'Staff Arsip', 'alamat' => 'Jl. Kertajaya No. 68, Gubeng, Surabaya'],
            ['nip' => '198904072013011055', 'nama' => 'Hendri Wijaya', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1989-04-07', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Keuangan', 'alamat' => 'Jl. Gatot Subroto No. 77, Bandung Kulon, Bandung'],
            ['nip' => '199206112017012056', 'nama' => 'Rini Susanti', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1992-06-11', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Administrasi', 'alamat' => 'Jl. Parangtritis No. 120, Bantul, Yogyakarta'],
            ['nip' => '198510292010011057', 'nama' => 'Bayu Aditya', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1985-10-29', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Perencanaan', 'alamat' => 'Jl. Dr. Radjiman No. 200, Laweyan, Solo'],
            ['nip' => '199504182020012058', 'nama' => 'Kirana Dewi', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1995-04-18', 'pendidikan_terakhir' => 'D3', 'jabatan' => 'Staff Perpustakaan', 'alamat' => 'Jl. Setia Budi No. 88, Setiabudi, Semarang'],
            ['nip' => '198708012011011059', 'nama' => 'Fandi Ahmad', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1987-08-01', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Koordinator Lapangan', 'alamat' => 'Jl. Nusantara No. 25, Gresik'],
            ['nip' => '199107252015012060', 'nama' => 'Laras Setyorini', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1991-07-25', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Data', 'alamat' => 'Jl. S. Parman No. 41, Semarang Barat, Semarang'],
            ['nip' => '198303072008011061', 'nama' => 'Saiful Bahri', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1983-03-07', 'pendidikan_terakhir' => 'S3', 'jabatan' => 'Kepala Bidang Pendidikan', 'alamat' => 'Jl. Veteran No. 3, Mojokerto'],
            ['nip' => '199602142021012062', 'nama' => 'Intan Pratiwi', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1996-02-14', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Humas', 'alamat' => 'Jl. Raya Puputan No. 17, Renon, Denpasar'],
            ['nip' => '199003122014011063', 'nama' => 'Danang Wicaksono', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1990-03-12', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff IT', 'alamat' => 'Jl. Pattimura No. 30, Jember'],
            ['nip' => '199408052019012064', 'nama' => 'Wahidah Nur', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1994-08-05', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Kepegawaian', 'alamat' => 'Jl. Ahmad Dahlan No. 15, Mergangsan, Yogyakarta'],
            ['nip' => '198412252008011065', 'nama' => 'Lukman Hakim', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1984-12-25', 'pendidikan_terakhir' => 'S2', 'jabatan' => 'Sekretaris', 'alamat' => 'Jl. Kawi No. 48, Klojen, Malang'],
            ['nip' => '199706182022012066', 'nama' => 'Bunga Citra', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1997-06-18', 'pendidikan_terakhir' => 'D3', 'jabatan' => 'Staff Keuangan', 'alamat' => 'Jl. Perintis Kemerdekaan No. 9, Tamalanrea, Makassar'],
            ['nip' => '198801172012011067', 'nama' => 'Pandu Wibowo', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1988-01-17', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Administrasi', 'alamat' => 'Jl. Gajah Mada No. 55, Mojosari, Mojokerto'],
            ['nip' => '199309102018012068', 'nama' => 'Shinta Dewi', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1993-09-10', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Perencanaan', 'alamat' => 'Jl. Mastrip No. 22, Jember'],
            ['nip' => '198602082009011069', 'nama' => 'Zainal Abidin', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1986-02-08', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Data', 'alamat' => 'Jl. Brigjen Katamso No. 14, Medan'],
            ['nip' => '199501282020012070', 'nama' => 'Febriana Salsabila', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1995-01-28', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff IT', 'alamat' => 'Jl. Pasar Baru No. 6, Sawah Besar, Jakarta Pusat'],
            ['nip' => '198709222011011071', 'nama' => 'Dwi Cahyono', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1987-09-22', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Humas', 'alamat' => 'Jl. Jend. A. Yani No. 22, Blitar'],
            ['nip' => '199204172017012072', 'nama' => 'Amira Zahra', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1992-04-17', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Keuangan', 'alamat' => 'Jl. Moh. Toha No. 49, Cicendo, Bandung'],
            ['nip' => '198104112006011073', 'nama' => 'Supriyanto', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1981-04-11', 'pendidikan_terakhir' => 'S2', 'jabatan' => 'Kepala Sub Bagian Hukum', 'alamat' => 'Jl. Kapuas No. 8, Darmo, Surabaya'],
            ['nip' => '199607232021012074', 'nama' => 'Rani Puspitasari', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1996-07-23', 'pendidikan_terakhir' => 'SMA/SMK', 'jabatan' => 'Staff Arsip', 'alamat' => 'Jl. Raya Dieng No. 5, Batu, Malang'],
            ['nip' => '198908132013011075', 'nama' => 'Ilham Ramadhan', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1989-08-13', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Administrasi', 'alamat' => 'Jl. Raya Serang No. 32, Tangerang'],
            ['nip' => '199110062016012076', 'nama' => 'Tri Wahyuningsih', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1991-10-06', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Kebijakan', 'alamat' => 'Jl. Magelang No. 19, Sleman, Yogyakarta'],
            ['nip' => '198507012010011077', 'nama' => 'Andika Putra', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1985-07-01', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Koordinator Lapangan', 'alamat' => 'Jl. A. R. Hakim No. 116, Medan Timur, Medan'],
            ['nip' => '199803072023012078', 'nama' => 'Nabila Putri', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1998-03-07', 'pendidikan_terakhir' => 'D3', 'jabatan' => 'Staff Perpustakaan', 'alamat' => 'Jl. Cipaganti No. 13, Coblong, Bandung'],
            ['nip' => '198802192012011079', 'nama' => 'Sigit Purnomo', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1988-02-19', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Perencanaan', 'alamat' => 'Jl. Rajawali No. 7, Krembangan, Surabaya'],
            ['nip' => '199305252018012080', 'nama' => 'Elsa Damayanti', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1993-05-25', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Administrasi', 'alamat' => 'Jl. Sudirman No. 220, Pekanbaru'],
            ['nip' => '198403272008011081', 'nama' => 'Kurniawan Adi', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1984-03-27', 'pendidikan_terakhir' => 'S2', 'jabatan' => 'Kepala Bagian Logistik', 'alamat' => 'Jl. Letjen Suprapto No. 28, Cempaka Putih, Jakarta Pusat'],
            ['nip' => '199708112022012082', 'nama' => 'Syifa Aulia', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1997-08-11', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff IT', 'alamat' => 'Jl. Setiabudi No. 45, Setiabudi, Bandung'],
            ['nip' => '199007042014011083', 'nama' => 'Rendi Saputra', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1990-07-04', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Keuangan', 'alamat' => 'Jl. Pramuka No. 61, Matraman, Jakarta Timur'],
            ['nip' => '199112192016012084', 'nama' => 'Dwi Ratnasari', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1991-12-19', 'pendidikan_terakhir' => 'D3', 'jabatan' => 'Staff Administrasi', 'alamat' => 'Jl. Wonodri No. 12, Semarang Selatan, Semarang'],
            ['nip' => '198606252010011085', 'nama' => 'Arya Wijaksana', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1986-06-25', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Data', 'alamat' => 'Jl. Gubernur Suryo No. 5, Genteng, Surabaya'],
            ['nip' => '199403082019012086', 'nama' => 'Lestari Ningrum', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1994-03-08', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Humas', 'alamat' => 'Jl. Surapati No. 72, Cibeunying, Bandung'],
            ['nip' => '198310192007011087', 'nama' => 'Yanto Hermawan', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1983-10-19', 'pendidikan_terakhir' => 'S3', 'jabatan' => 'Kepala Bidang Pengawasan', 'alamat' => 'Jl. Dr. Sutomo No. 16, Tegalsari, Surabaya'],
            ['nip' => '199606012021012088', 'nama' => 'Safira Nuraini', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1996-06-01', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Kepegawaian', 'alamat' => 'Jl. Kusumanegara No. 2, Umbulharjo, Yogyakarta'],
            ['nip' => '198901022013011089', 'nama' => 'Firman Hidayatullah', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1989-01-02', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Perencanaan', 'alamat' => 'Jl. Mulyosari No. 44, Mulyorejo, Surabaya'],
            ['nip' => '199207162017012090', 'nama' => 'Tiara Kusumadewi', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1992-07-16', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Keuangan', 'alamat' => 'Jl. Cihampelas No. 119, Coblong, Bandung'],
            ['nip' => '198505182009011091', 'nama' => 'Okta Ramdani', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1985-05-18', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff IT', 'alamat' => 'Jl. Raya Bekasi No. 68, Cakung, Jakarta Timur'],
            ['nip' => '199904252023012092', 'nama' => 'Zahra Aulia', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1999-04-25', 'pendidikan_terakhir' => 'SMA/SMK', 'jabatan' => 'Staff Arsip', 'alamat' => 'Jl. Tanjung No. 3, Pontianak Selatan, Pontianak'],
            ['nip' => '198711082011011093', 'nama' => 'Nanang Kosim', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1987-11-08', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Administrasi', 'alamat' => 'Jl. Sam Ratulangi No. 26, Manado'],
            ['nip' => '199308272018012094', 'nama' => 'Wulan Fitriyani', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1993-08-27', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Perencanaan', 'alamat' => 'Jl. Jend. Basuki Rachmat No. 12, Tegalsari, Surabaya'],
            ['nip' => '198204152006011095', 'nama' => 'Anton Subagyo', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1982-04-15', 'pendidikan_terakhir' => 'S2', 'jabatan' => 'Kepala Sub Bagian Logistik', 'alamat' => 'Jl. Waru No. 5, Sidoarjo'],
            ['nip' => '199705092022012096', 'nama' => 'Citra Mahardhika', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1997-05-09', 'pendidikan_terakhir' => 'D3', 'jabatan' => 'Staff Keuangan', 'alamat' => 'Jl. Tendean No. 37, Mampang Prapatan, Jakarta Selatan'],
            ['nip' => '199003302014011097', 'nama' => 'Gilang Ramadhan', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1990-03-30', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Kebijakan', 'alamat' => 'Jl. Bungur Besar No. 80, Kemayoran, Jakarta Pusat'],
            ['nip' => '199109132016012098', 'nama' => 'Retno Wulandari', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1991-09-13', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Administrasi', 'alamat' => 'Jl. Karangmenjangan No. 41, Gubeng, Surabaya'],
            ['nip' => '198806052012011099', 'nama' => 'Hariyadi Putra', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1988-06-05', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Humas', 'alamat' => 'Jl. Diponegoro No. 150, Pekalongan'],
            ['nip' => '199512012020012100', 'nama' => 'Annisa Fitria', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1995-12-01', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Data', 'alamat' => 'Jl. Kenjeran No. 504, Kenjeran, Surabaya'],
        ];

        foreach ($pegawais as $data) {
            Pegawai::create($data);
        }
    }
}
