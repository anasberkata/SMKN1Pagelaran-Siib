<?php

// KONEKSI DATABASE =====================================================
$conn = mysqli_connect("localhost", "root", "", "db_simbara");


function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


// USERS
function user_add($data)
{
    global $conn;

    $nomor_induk = $data["nomor_induk"];
    $nama = $data["nama"];
    $username = $data["username"];
    $email = $data["email"];
    $password = $data["password"];
    $image = "default.jpg";
    $id_kelas = $data["id_kelas"];
    $phone = $data["phone"];
    $role = $data["role"];
    $date_created = date("Y-m-d");
    $is_active = 1;

    $cek_username = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    $cek_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");

    // Cek Username Mahasiswa Sudah Ada Atau Belum
    if (mysqli_fetch_assoc($cek_username)) {
        echo "<script>
            alert('Username Sudah Terdaftar!');
            document.location.href = 'user_add.php';
            </script>";
    } else if (mysqli_fetch_assoc($cek_email)) {
        echo "<script>
            alert('Email Sudah Terdaftar!');
            document.location.href = 'user_add.php';
            </script>";
    } else {
        $query = "INSERT INTO users
				VALUES
			(NULL, '$nomor_induk', '$nama', '$username', '$email', '$password', '$image', '$id_kelas', '$phone', '$role', '$date_created', '$is_active')
			";

        mysqli_query($conn, $query);
    }

    return mysqli_affected_rows($conn);
}

function user_edit($data)
{
    global $conn;

    $id = $data["id"];
    $nomor_induk = $data["nomor_induk"];
    $nama = $data["nama"];
    $id_kelas = $data["id_kelas"];
    $email = $data["email"];
    $username = $data["username"];
    $password = $data["password"];
    $phone = $data["phone"];
    $role = $data["role"];

    $query = "UPDATE users SET
			nomor_induk = '$nomor_induk',
			nama = '$nama',
			id_kelas = '$id_kelas',
			email = '$email',
			username = '$username',
			password = '$password',
			phone = '$phone',
			role_id = '$role'

            WHERE id_user = $id
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function user_delete($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM users WHERE id_user = $id");
    return mysqli_affected_rows($conn);
}

function profile_edit($data)
{
    global $conn;

    $id = $data["id"];
    $nama = $data["nama"];
    $email = $data["email"];
    $username = $data["username"];
    $password = $data["password"];
    $role = $data["role"];

    $query = "UPDATE users SET
			nama = '$nama',
			email = '$email',
			username = '$username',
			password = '$password',
			role_id = '$role'

            WHERE id_user = $id
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

// INVENTARIS
function inventaris_add($data)
{
    global $conn;

    $kode = $data["kode"];
    $nama_barang = $data["nama_barang"];
    $merk = $data["merk"];
    $qty = $data["qty"];
    $id_satuan = $data["id_satuan"];
    $harga = $data["harga"];
    $gambar = upload_gambar();
    $tahun_perolehan = $data["tahun_perolehan"];
    $id_kondisi = $data["id_kondisi"];
    $date_created = date("Y-m-d");
    $is_active = 1;

    $cek_kode = mysqli_query($conn, "SELECT kode FROM inventaris WHERE kode = '$kode'");

    if (mysqli_fetch_assoc($cek_kode)) {
        echo "<script>
            alert('Barang Sudah Ada!');
            document.location.href = 'inventaris_add.php';
            </script>";
    } else {
        $query = "INSERT INTO inventaris
				VALUES
			(NULL, '$kode', '$nama_barang', '$merk', '$qty', '$id_satuan', '$harga', '$gambar', '$tahun_perolehan', '$id_kondisi', '$date_created', '$is_active')
			";

        mysqli_query($conn, $query);
    }

    return mysqli_affected_rows($conn);
}

function inventaris_edit($data)
{
    global $conn;

    $id_inventaris = $data["id_inventaris"];
    $kode = $data["kode"];
    $nama_barang = $data["nama_barang"];
    $merk = $data["merk"];
    $qty = $data["qty"];
    $id_satuan = $data["id_satuan"];
    $harga = $data["harga"];
    $gambar_lama = $data["gambar_lama"];

    if ($_FILES["gambar"]["error"] === 4) {
        $gambar = $gambar_lama;
    } else {
        $gambar = upload_gambar();
    }

    $tahun_perolehan = $data["tahun_perolehan"];
    $id_kondisi = $data["id_kondisi"];

    $query = "UPDATE inventaris SET
			kode = '$kode',
			nama_barang = '$nama_barang',
			merk = '$merk',
			qty = '$qty',
			id_satuan = '$id_satuan',
			harga = '$harga',
			gambar = '$gambar',
			tahun_perolehan = '$tahun_perolehan',
			id_kondisi = '$id_kondisi'

            WHERE id_inventaris = $id_inventaris
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function inventaris_delete($id_inventaris)
{
    global $conn;

    // Mendapatkan nama file gambar dari database berdasarkan id_inventaris
    $result = mysqli_query($conn, "SELECT gambar FROM inventaris WHERE id_inventaris = $id_inventaris");
    $row = mysqli_fetch_assoc($result);
    $gambar = $row['gambar'];

    // Hapus gambar dari folder assets jika file gambar ada
    if (file_exists("../assets/img/barang/$gambar")) {
        unlink("../assets/img/barang/$gambar");
    }

    mysqli_query($conn, "DELETE FROM inventaris WHERE id_inventaris = $id_inventaris");
    return mysqli_affected_rows($conn);
}

// SATUAN
function satuan_add($data)
{
    global $conn;

    $satuan = $data["satuan"];

    $cek_satuan = mysqli_query($conn, "SELECT satuan FROM satuan WHERE satuan = '$satuan'");

    if (mysqli_fetch_assoc($cek_satuan)) {
        echo "<script>
            alert('Satuan Sudah Ada!');
            document.location.href = 'satuan_add.php';
            </script>";
    } else {
        $query = "INSERT INTO satuan
				VALUES
			(NULL, '$satuan')
			";

        mysqli_query($conn, $query);
    }

    return mysqli_affected_rows($conn);
}

function satuan_edit($data)
{
    global $conn;

    $id_satuan = $data["id_satuan"];
    $satuan = $data["satuan"];

    $query = "UPDATE satuan SET
			satuan = '$satuan'

            WHERE id_satuan = $id_satuan
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function satuan_delete($id_satuan)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM satuan WHERE id_satuan = $id_satuan");
    return mysqli_affected_rows($conn);
}


// PENGAJUAN
function pengajuan_add($data)
{
    global $conn;

    $tanggal_pengajuan = $data["tanggal_pengajuan"];
    $id_user = $data["id_user"];

    $cek_pengajuan = mysqli_query($conn, "SELECT tanggal_pengajuan FROM pengajuan WHERE tanggal_pengajuan = '$tanggal_pengajuan'");

    if (mysqli_fetch_assoc($cek_pengajuan)) {
        echo "<script>
            alert('Tanggal Pengajuan Sudah Ada!');
            document.location.href = 'pengajuan_add.php';
            </script>";
    } else {
        $query = "INSERT INTO pengajuan
				VALUES
			(NULL, '$tanggal_pengajuan', '$id_user')
			";

        mysqli_query($conn, $query);
    }

    // Mengambil ID pengajuan yang baru ditambahkan
    $id_pengajuan_baru = mysqli_insert_id($conn);

    return $id_pengajuan_baru;
}

function pengajuan_edit($data)
{
    global $conn;

    $id_pengajuan = $data["id_pengajuan"];
    $tanggal_pengajuan = $data["tanggal_pengajuan"];

    $cek_pengajuan = mysqli_query($conn, "SELECT tanggal_pengajuan FROM pengajuan WHERE tanggal_pengajuan = '$tanggal_pengajuan'");

    if (mysqli_fetch_assoc($cek_pengajuan)) {
        echo "<script>
            alert('Tanggal Pengajuan Sudah Ada!');
            document.location.href = 'pengajuan_add.php';
            </script>";
    } else {
        $query = "UPDATE pengajuan SET
			tanggal_pengajuan = '$tanggal_pengajuan'

            WHERE id_pengajuan = $id_pengajuan
			";

        mysqli_query(
            $conn,
            $query
        );
    }

    return mysqli_affected_rows($conn);
}

function pengajuan_delete($id_pengajuan)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM pengajuan_detail WHERE id_pengajuan = $id_pengajuan");

    mysqli_query($conn, "DELETE FROM pengajuan WHERE id_pengajuan = $id_pengajuan");
    return mysqli_affected_rows($conn);
}

function pengajuan_detail_add($data)
{
    global $conn;

    $id_pengajuan = $data["id_pengajuan"];
    $nama_barang = $data["nama_barang"];
    $spesifikasi = $data["spesifikasi"];
    $qty = $data["qty"];
    $harga = $data["harga"];
    $jumlah = $qty * $harga;
    $keterangan = $data["keterangan"];

    $query = "INSERT INTO pengajuan_detail
				VALUES
			(NULL, '$id_pengajuan', '$nama_barang', '$spesifikasi', '$qty', '$harga', '$jumlah', '$keterangan')
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function pengajuan_detail_edit($data)
{
    global $conn;

    $id_pengajuan = $data["id_pengajuan"];
    $id_pengajuan_detail = $data["id_pengajuan_detail"];
    $nama_barang = $data["nama_barang"];
    $spesifikasi = $data["spesifikasi"];
    $qty = $data["qty"];
    $harga = $data["harga"];
    $jumlah = $qty * $harga;
    $keterangan = $data["keterangan"];


    $query = "UPDATE pengajuan_detail SET
			nama_barang = '$nama_barang',
			spesifikasi = '$spesifikasi',
			qty = '$qty',
			harga = '$harga',
			jumlah = '$jumlah',
			keterangan = '$keterangan'

            WHERE id_pengajuan_detail = $id_pengajuan_detail
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function pengajuan_detail_delete($id_pengajuan_detail)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM pengajuan_detail WHERE id_pengajuan_detail = $id_pengajuan_detail");

    return mysqli_affected_rows($conn);
}



// PEMINJAMAN
function peminjaman_add($data)
{
    global $conn;

    $id_petugas = $data["id_petugas"];
    $id_peminjam = $data["id_peminjam"];
    $tanggal_peminjaman = $data["tanggal_peminjaman"];
    $tanggal_pengembalian = $data["tanggal_pengembalian"];
    $status_peminjaman = 2;
    $approve = 2;

    $query = "INSERT INTO peminjaman
				VALUES
			(NULL, '$id_petugas', '$id_peminjam', '$tanggal_peminjaman', '$tanggal_pengembalian', '$status_peminjaman', '$approve')
			";

    mysqli_query($conn, $query);

    // Mengambil ID peminjaman yang baru ditambahkan
    $id_peminjaman_baru = mysqli_insert_id($conn);

    return $id_peminjaman_baru;
}

function status_approve_save($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];
    $status_approve = 1;

    $query = "UPDATE peminjaman SET approve = $status_approve WHERE id_peminjaman = $id_peminjaman";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function status_belum_approve_save($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];
    $status_approve = 2;

    $query = "UPDATE peminjaman SET approve = $status_approve WHERE id_peminjaman = $id_peminjaman";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function status_ditolak_save($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];
    $status_approve = 3;

    update_qty_inventaris($data);

    $query = "UPDATE peminjaman SET approve = $status_approve WHERE id_peminjaman = $id_peminjaman";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function status_pengembalian_save($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];
    $status_pengembalian = $data["status_pengembalian"];

    update_qty_inventaris($data);

    // simpan status pengembalian
    $query = "UPDATE peminjaman SET status_peminjaman = $status_pengembalian WHERE id_peminjaman = $id_peminjaman";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function peminjaman_edit($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];
    $id_peminjam = $data["id_peminjam"];
    $tanggal_peminjaman = $data["tanggal_peminjaman"];
    $tanggal_pengembalian = $data["tanggal_pengembalian"];

    $query = "UPDATE peminjaman SET
			id_peminjam = '$id_peminjam',
			tanggal_peminjaman = '$tanggal_peminjaman',
			tanggal_pengembalian = '$tanggal_pengembalian'

            WHERE id_peminjaman = $id_peminjaman
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function update_qty_inventaris($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];

    $peminjaman_detail = query("SELECT * FROM peminjaman_detail WHERE id_peminjaman = $id_peminjaman");
    foreach ($peminjaman_detail as $pd) {
        $id_inventaris = $pd["id_inventaris"];
        $qty_pengembalian = $data["qty_pengembalian" . $id_inventaris];

        // Ambil stok terbaru dari tabel alat_bahan
        $inventaris = query("SELECT * FROM inventaris WHERE id_inventaris = $id_inventaris")[0];
        $qty_terbaru = $inventaris["qty"] + $qty_pengembalian;

        // Update stok pada tabel alat_bahan
        $query = "UPDATE inventaris SET qty = $qty_terbaru WHERE id_inventaris = $id_inventaris";

        mysqli_query($conn, $query);
    }
}

function peminjaman_delete($id_peminjaman, $data)
{
    global $conn;

    update_qty_inventaris($data);
    pd_delete($id_peminjaman);

    mysqli_query($conn, "DELETE FROM peminjaman WHERE id_peminjaman = $id_peminjaman");
    return mysqli_affected_rows($conn);
}

function pd_delete($id_peminjaman)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM peminjaman_detail WHERE id_peminjaman = $id_peminjaman");
}

function peminjaman_detail_add($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];
    $id_inventaris = $data["id_inventaris"];
    $quantity = $data["quantity"];
    $kondisi_inventaris = 1;

    foreach ($id_inventaris as $key => $id) {

        // $id_alat_bahan = $id_barang[$id];
        $qty = $quantity[$id];

        $query = "UPDATE inventaris SET qty = qty - $qty WHERE id_inventaris = $id";

        mysqli_query($conn, $query);

        $query = "INSERT INTO peminjaman_detail (id_peminjaman_detail, id_peminjaman, id_inventaris, qty_peminjaman, kondisi_inventaris) 
                VALUES (NULL, '$id_peminjaman', '$id', '$qty', '$kondisi_inventaris')";

        mysqli_query($conn, $query);
    }

    return mysqli_affected_rows($conn);
}

function peminjaman_detail_edit($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];
    $id_peminjaman_detail = $data["id_peminjaman_detail"];
    $id_inventaris = $data["id_inventaris"];
    $qty_peminjaman = $data["qty_peminjaman"];

    $ab = query("SELECT * FROM inventaris WHERE id_inventaris = $id_inventaris")[0];
    $pd = query("SELECT * FROM peminjaman_detail WHERE id_peminjaman_detail = $id_peminjaman_detail")[0];

    if ($qty_peminjaman == $pd['qty_peminjaman']) {
        $qty_edit = $ab['qty'];
    } else {
        $selisih = $qty_peminjaman - $pd['qty_peminjaman'];
        $qty_edit = $ab['qty'] - $selisih;
    }

    $query = "UPDATE inventaris SET
			qty = '$qty_edit'

            WHERE id_inventaris = $id_inventaris
			";

    mysqli_query($conn, $query);

    $query = "UPDATE peminjaman_detail SET
			qty_peminjaman = '$qty_peminjaman'

            WHERE id_peminjaman_detail = $id_peminjaman_detail
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function peminjaman_detail_delete($id_peminjaman_detail, $id_peminjaman)
{
    global $conn;

    $pd = query("SELECT * FROM peminjaman_detail WHERE id_peminjaman_detail = $id_peminjaman_detail")[0];

    $qty_peminjaman = $pd["qty_peminjaman"];
    $id_inventaris = $pd["id_inventaris"];

    $query = "UPDATE inventaris SET qty = qty + $qty_peminjaman WHERE id_inventaris = $id_inventaris";
    mysqli_query($conn, $query);

    $query = "DELETE FROM peminjaman_detail WHERE id_peminjaman_detail = $id_peminjaman_detail";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}











// UPLOAD
function upload_gambar()
{
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    if ($error === 4) {
        echo "<script>
                alert('Foto wajib diupload!');
            </script>";

        return false;
    }

    $ekstensiFileValid = ["jpg", "jpeg", "png"];
    $ekstensiFile = explode(".", $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
        echo "<script>
                alert('Gambar yang diupload bukan gambar!');
            </script>";

        return false;
    }

    // max 10mb
    if ($ukuranFile > 20000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar, Maksimal 20mb!');
            </script>";

        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    move_uploaded_file($tmpName, "../assets/img/barang/" . $namaFileBaru);

    return $namaFileBaru;
}