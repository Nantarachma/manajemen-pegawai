<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $pegawais = [
            ['nip' => '198503142010011001', 'nama' => 'Andi Prasetyo', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1985-03-14', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Kepala Bagian Umum', 'alamat' => 'Jl. Sudirman No. 45, Menteng, Jakarta Pusat'],
            ['nip' => '199007222015012002', 'nama' => 'Siti Nurhaliza', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1990-07-22', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Administrasi', 'alamat' => 'Jl. Gatot Subroto No. 12, Setiabudi, Jakarta Selatan'],
            ['nip' => '198811052012011003', 'nama' => 'Budi Raharjo', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1988-11-05', 'pendidikan_terakhir' => 'S2', 'jabatan' => 'Kepala Sub Bagian Keuangan', 'alamat' => 'Jl. Diponegoro No. 78, Coblong, Bandung'],
            ['nip' => '199205182018012004', 'nama' => 'Dewi Kartika Sari', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1992-05-18', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Kepegawaian', 'alamat' => 'Jl. Ahmad Yani No. 33, Wonokromo, Surabaya'],
            ['nip' => '198201302008011005', 'nama' => 'Hendra Gunawan', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1982-01-30', 'pendidikan_terakhir' => 'S2', 'jabatan' => 'Sekretaris', 'alamat' => 'Jl. Malioboro No. 56, Gedongtengen, Yogyakarta'],
            ['nip' => '199508112020012006', 'nama' => 'Ratna Permata Dewi', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1995-08-11', 'pendidikan_terakhir' => 'D3', 'jabatan' => 'Staff Keuangan', 'alamat' => 'Jl. Pemuda No. 19, Semarang Tengah, Semarang'],
            ['nip' => '198706252011011007', 'nama' => 'Agus Setiawan', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1987-06-25', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Kepala Bagian Kepegawaian', 'alamat' => 'Jl. Veteran No. 8, Ketabang, Surabaya'],
            ['nip' => '199312042019012008', 'nama' => 'Indah Permatasari', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1993-12-04', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff IT', 'alamat' => 'Jl. Raya Bogor No. 102, Kramat Jati, Jakarta Timur'],
            ['nip' => '198004172006011009', 'nama' => 'Muhammad Rizki', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1980-04-17', 'pendidikan_terakhir' => 'S2', 'jabatan' => 'Kepala Bidang Perencanaan', 'alamat' => 'Jl. Imam Bonjol No. 67, Tegalsari, Surabaya'],
            ['nip' => '199609282021012010', 'nama' => 'Fitri Handayani', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1996-09-28', 'pendidikan_terakhir' => 'SMA/SMK', 'jabatan' => 'Staff Arsip', 'alamat' => 'Jl. Raden Saleh No. 14, Cikini, Jakarta Pusat'],
            ['nip' => '198909132013011011', 'nama' => 'Dedi Kurniawan', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1989-09-13', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Data', 'alamat' => 'Jl. Teuku Umar No. 31, Denpasar Barat, Denpasar'],
            ['nip' => '199103072016012012', 'nama' => 'Rina Wulandari', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1991-03-07', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Humas', 'alamat' => 'Jl. Hasanuddin No. 22, Ujung Pandang, Makassar'],
            ['nip' => '198602192009011013', 'nama' => 'Wahyu Nugroho', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1986-02-19', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Kepala Sub Bagian Umum', 'alamat' => 'Jl. Gajah Mada No. 88, Petojo, Jakarta Pusat'],
            ['nip' => '199407152020022014', 'nama' => 'Nurul Aini', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1994-07-15', 'pendidikan_terakhir' => 'D3', 'jabatan' => 'Staff Perpustakaan', 'alamat' => 'Jl. Panglima Sudirman No. 50, Genteng, Surabaya'],
            ['nip' => '198308112007011015', 'nama' => 'Bambang Supriadi', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1983-08-11', 'pendidikan_terakhir' => 'S3', 'jabatan' => 'Kepala Bidang Penelitian', 'alamat' => 'Jl. Pahlawan No. 5, Bubutan, Surabaya'],
            ['nip' => '199711232022012016', 'nama' => 'Ayu Lestari', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1997-11-23', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Administrasi', 'alamat' => 'Jl. Hayam Wuruk No. 39, Sawahan, Surabaya'],
            ['nip' => '199001082014011017', 'nama' => 'Eko Prabowo', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1990-01-08', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff IT', 'alamat' => 'Jl. MT Haryono No. 17, Lowokwaru, Malang'],
            ['nip' => '199204262017012018', 'nama' => 'Sri Wahyuni', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1992-04-26', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Keuangan', 'alamat' => 'Jl. Basuki Rahmat No. 62, Tegalsari, Surabaya'],
            ['nip' => '198507312010011019', 'nama' => 'Joko Susanto', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1985-07-31', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Koordinator Lapangan', 'alamat' => 'Jl. Slamet Riyadi No. 71, Laweyan, Solo'],
            ['nip' => '199806142023012020', 'nama' => 'Dian Purnama Sari', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1998-06-14', 'pendidikan_terakhir' => 'SMA/SMK', 'jabatan' => 'Staff Arsip', 'alamat' => 'Jl. Asia Afrika No. 28, Sumur Bandung, Bandung'],
            ['nip' => '198112092005011021', 'nama' => 'Rudi Hartono', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1981-12-09', 'pendidikan_terakhir' => 'S2', 'jabatan' => 'Kepala Bagian Keuangan', 'alamat' => 'Jl. Thamrin No. 10, Gondangdia, Jakarta Pusat'],
            ['nip' => '199302172018012022', 'nama' => 'Lina Marlina', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1993-02-17', 'pendidikan_terakhir' => 'D3', 'jabatan' => 'Staff Administrasi', 'alamat' => 'Jl. Braga No. 43, Braga, Bandung'],
            ['nip' => '198804212012011023', 'nama' => 'Fajar Maulana', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1988-04-21', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Kebijakan', 'alamat' => 'Jl. Pemuda No. 55, Jebres, Solo'],
            ['nip' => '199510032021012024', 'nama' => 'Mega Putri Utami', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1995-10-03', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Humas', 'alamat' => 'Jl. Dago No. 18, Coblong, Bandung'],
            ['nip' => '198703082009011025', 'nama' => 'Surya Dharma', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1987-03-08', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Perencanaan', 'alamat' => 'Jl. Hang Tuah No. 36, Denpasar Selatan, Denpasar'],
            ['nip' => '199108192015012026', 'nama' => 'Yuni Astuti', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1991-08-19', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Kepegawaian', 'alamat' => 'Jl. Sisingamangaraja No. 27, Medan Kota, Medan'],
            ['nip' => '198405152008011027', 'nama' => 'Teguh Prasetya', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1984-05-15', 'pendidikan_terakhir' => 'S2', 'jabatan' => 'Kepala Sub Bagian Kepegawaian', 'alamat' => 'Jl. Kartini No. 15, Sawahan, Surabaya'],
            ['nip' => '199612282022012028', 'nama' => 'Putri Rahayu', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1996-12-28', 'pendidikan_terakhir' => 'D3', 'jabatan' => 'Staff Keuangan', 'alamat' => 'Jl. Diponegoro No. 91, Citarum, Bandung'],
            ['nip' => '199001262014011029', 'nama' => 'Arief Budiman', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1990-01-26', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff IT', 'alamat' => 'Jl. Mangga Dua Raya No. 44, Pademangan, Jakarta Utara'],
            ['nip' => '199909072023012030', 'nama' => 'Nadia Safitri', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1999-09-07', 'pendidikan_terakhir' => 'SMA/SMK', 'jabatan' => 'Staff Arsip', 'alamat' => 'Jl. Raya Darmo No. 73, Wonokromo, Surabaya'],
            ['nip' => '198607112010011031', 'nama' => 'Rahmat Hidayat', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1986-07-11', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Perencanaan', 'alamat' => 'Jl. Antapani No. 15, Antapani, Bandung'],
            ['nip' => '199404192019012032', 'nama' => 'Winda Kusuma', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1994-04-19', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Administrasi', 'alamat' => 'Jl. Urip Sumoharjo No. 40, Banyumanik, Semarang'],
            ['nip' => '198210052007011033', 'nama' => 'Irwan Setiabudi', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1982-10-05', 'pendidikan_terakhir' => 'S2', 'jabatan' => 'Kepala Bidang SDM', 'alamat' => 'Jl. Cendrawasih No. 9, Makassar'],
            ['nip' => '199707232022012034', 'nama' => 'Hesti Ratnawati', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1997-07-23', 'pendidikan_terakhir' => 'D3', 'jabatan' => 'Staff Keuangan', 'alamat' => 'Jl. Sulawesi No. 14, Surabaya'],
            ['nip' => '198901142013011035', 'nama' => 'Doni Firmansyah', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1989-01-14', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff IT', 'alamat' => 'Jl. Pajajaran No. 52, Bogor Tengah, Bogor'],
            ['nip' => '199306082018012036', 'nama' => 'Eka Fitriani', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1993-06-08', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Data', 'alamat' => 'Jl. Trunojoyo No. 21, Klojen, Malang'],
            ['nip' => '198503272010011037', 'nama' => 'Yusuf Maulana', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1985-03-27', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Koordinator Lapangan', 'alamat' => 'Jl. Merdeka No. 33, Bandung Wetan, Bandung'],
            ['nip' => '199812012023012038', 'nama' => 'Cantika Maharani', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1998-12-01', 'pendidikan_terakhir' => 'SMA/SMK', 'jabatan' => 'Staff Arsip', 'alamat' => 'Jl. Kaliurang No. 7, Sleman, Yogyakarta'],
            ['nip' => '198708192011011039', 'nama' => 'Adi Nurcahyo', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1987-08-19', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Humas', 'alamat' => 'Jl. Pandanaran No. 60, Semarang Selatan, Semarang'],
            ['nip' => '199205112017012040', 'nama' => 'Tika Amelia', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1992-05-11', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Administrasi', 'alamat' => 'Jl. Colombo No. 1, Depok, Sleman, Yogyakarta'],
            ['nip' => '198306142008011041', 'nama' => 'Herman Suryadi', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1983-06-14', 'pendidikan_terakhir' => 'S3', 'jabatan' => 'Kepala Bagian Litbang', 'alamat' => 'Jl. Pasar Minggu No. 18, Pasar Minggu, Jakarta Selatan'],
            ['nip' => '199508302020012042', 'nama' => 'Anisa Rahma', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1995-08-30', 'pendidikan_terakhir' => 'D3', 'jabatan' => 'Staff Perpustakaan', 'alamat' => 'Jl. Buahbatu No. 74, Lengkong, Bandung'],
            ['nip' => '199002072014011043', 'nama' => 'Rizal Fauzi', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1990-02-07', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Keuangan', 'alamat' => 'Jl. Kapten Muslihat No. 29, Bogor Tengah, Bogor'],
            ['nip' => '199111202016012044', 'nama' => 'Riska Amalia', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1991-11-20', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Analis Kepegawaian', 'alamat' => 'Jl. Dr. Cipto No. 12, Semarang Timur, Semarang'],
            ['nip' => '198404092007011045', 'nama' => 'Sugeng Riyanto', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1984-04-09', 'pendidikan_terakhir' => 'S2', 'jabatan' => 'Kepala Sub Bagian IT', 'alamat' => 'Jl. Mayjen Sungkono No. 101, Dukuh Pakis, Surabaya'],
            ['nip' => '199603172021012046', 'nama' => 'Della Puspita', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1996-03-17', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Humas', 'alamat' => 'Jl. Laksda Adisucipto No. 45, Depok, Sleman'],
            ['nip' => '198805262012011047', 'nama' => 'Iwan Kurniawan', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1988-05-26', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Perencanaan', 'alamat' => 'Jl. Veteran No. 17, Lamongan'],
            ['nip' => '199402142018012048', 'nama' => 'Novita Sari', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1994-02-14', 'pendidikan_terakhir' => 'S1', 'jabatan' => 'Staff Administrasi', 'alamat' => 'Jl. Sultan Agung No. 62, Brebes'],
            ['nip' => '198109252006011049', 'nama' => 'Taufik Hidayat', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1981-09-25', 'pendidikan_terakhir' => 'S2', 'jabatan' => 'Kepala Bidang Hukum', 'alamat' => 'Jl. Pemuda No. 100, Simpang Lima, Semarang'],
            ['nip' => '199710062022012050', 'nama' => 'Vina Oktaviani', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1997-10-06', 'pendidikan_terakhir' => 'D3', 'jabatan' => 'Staff Keuangan', 'alamat' => 'Jl. Batununggal No. 30, Bandung Kidul, Bandung'],
        ];

        foreach ($pegawais as $data) {
            Pegawai::create($data);
        }
    }
}
