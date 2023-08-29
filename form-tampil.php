<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION["user"])) {
    header("Location: form-login.php"); // Redirect to login page
    exit();
}
?>

<?php
if (isset($_POST['Cari'])) {
$cari = $_POST['Cari'];
} else {
$cari = "";
}
?>
<?php require_once("auth.php"); ?>
    <header class="p-3 text-bg-dark">
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                <a href="Dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <h1 class="fs-4">Data Wajib Ipeda</h1>
                </a>
            </header>
        </div>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Cari..." 
          aria-label="Cari" autocomplete="off" value="<?php echo $cari; ?>">
        </form>

        <div class="text-end">
            <button type="button" class="btn btn-outline-light me-2" onclick="redirectToFormTambah()">Tambah Data</button>
            <script>
                function redirectToFormTambah() {
                    window.location.href = "form-tambah.php";
                }</script>
        </div>
    </header>
<?php
if (empty($_GET['alert'])) {
    echo "";
} elseif ($_GET['alert'] == 1) {
    echo '
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><i class="glyphicon glyphicon-alert"></i> Gagal!</strong>
        Terjadi kesalahan.
    </div>';
} elseif ($_GET['alert'] == 2) {
    echo '
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><i class="glyphicon glyphicon-ok-circle"></i> Sukses!</strong>
        Data berhasil disimpan.
    </div>';
} elseif ($_GET['alert'] == 3) {
    echo '
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><i class="glyphicon glyphicon-ok-circle"></i> Sukses!</strong>
        Data berhasil diubah.
    </div>';
} elseif ($_GET['alert'] == 4) {
    echo '
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><i class="glyphicon glyphicon-ok-circle"></i> Sukses!</strong>
        Data berhasil dihapus.
    </div>';
}
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title, mt-3">Data Wajib Ipeda</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No Data</th>
                        <th>Nama</th>
                        <th>Tempat Tinggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
<?php
/* Pagination */
$batas = 50;
if (isset($cari)) {
    $jumlah_record = mysqli_query($db, "SELECT * FROM wajibipeda WHERE
    no_data LIKE '%$cari%' OR nama LIKE '%$cari%'") or die('Ada kesalahan 
    pada query jumlah_record: '.mysqli_error($db));
    } else {
    $jumlah_record = mysqli_query($db, "SELECT * FROM wajibipeda") or 
    die('Ada kesalahan pada query jumlah_record: '.mysqli_error($db));
    }
    $jumlah = mysqli_num_rows($jumlah_record);
    $halaman = ceil($jumlah / $batas);
    $page = (isset($_GET['hal'])) ? (int)$_GET['hal'] : 1 ;
    $mulai = ($page - 1) * $batas;
    /*-----------------------------------------------------------------
    --*/
    $no = 1;
    if (isset($cari)) {
    $query = mysqli_query($db, "SELECT * FROM wajibipeda WHERE no_data 
    LIKE '%$cari%' OR nama LIKE'%$cari%' ORDER BY no_data DESC LIMIT
    $mulai,$batas") or die('Ada kesalahan pada query data: 
    '.mysqli_error($db));
    } else {
    $query = mysqli_query($db, "SELECT * FROM wajibipeda ORDER BY no_data 
    DESC LIMIT $mulai,$batas") or die('Ada kesalahan pada query 
    data: '.mysqli_error($db));}
    while ($data = mysqli_fetch_assoc($query)) {
        echo " <tr>
        <td class='center'>$no</td>
        <td>$data[no_data]</td>
        <td>$data[nama]</td>
        <td>$data[tmpt_tinggal]</td>
        <td>
        <div class='btn-group'>
                <a data-toggle='tooltip' data-placement='top' title='Ubah' class='btn btn-info btn-sm' href='?page=ubah&id=$data[no_data]'>
                    <i class='glyphicon glyphicon-edit'></i>
                </a>
                <a data-toggle='tooltip' data-placement='top' title='Hapus' class='btn btn-danger btn-sm' href='proses-hapus.php?id=$data[no_data]' onclick='return confirm(\"Anda yakin ingin menghapus data " . addslashes($data['nama']) . "?\");'>
                    <i class='glyphicon glyphicon-trash'></i>
                </a>
                
            </div>
        </td>
        </tr>";
        $no++;}?>
        
