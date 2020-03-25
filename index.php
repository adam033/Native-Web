<?php
include 'koneksi.php';

$sql="SELECT * FROM peminjaman INNER JOIN angg ON peminjaman.id_anggota = angg.id_anggota INNER JOIN petugas ON peminjaman.id_petugas = petugas.id_petugas ORDER BY peminjaman.tgl_pinjam";

$res = mysqli_query($koneksi , $sql);
$pinjam = array();

while ($data = mysqli_fetch_assoc($res)) {
    $pinjam[] = $data;

}
?>

<?php
include '../aset/header.php';
?>
<style>
    thead{
        background-color: turquoise;
        color: white;
    }
    tbody{
        background-color: darkslategrey;
        color: white;
    }
</style>
<div class="container">
    <div class="row mt-4">
        <div class="col-md">
            <div class="card bg-dark">
                <div class="card-header">
                    <h2 class="card-title text-white"><i class="fas fa-edit"></i>Data Peminjaman</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Peminjam</th>
                                <th scope="col">Tanggal Pinjam</th>
                                <th scope="col">Tanggal Jatuh Tempo</th>
                                <th scope="col">Petugas</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                                
                            </tr>
                        </thead>
                        <tbody>


                        <?php
    $no = 1;
    foreach ($pinjam as $p ) { ?>

    <tr>
        
        <th scope="row"><?= $no ?></th>
        <td><?= @$p['nama'] ?></th>
        <td><?= date('d F Y', strtotime(@$p['tgl_pinjam'])) ?></th>
        <td><?= date('d F Y', strtotime(@$p['tgl_jatuh_tempo'])) ?></th>                                 
        <td><?= $p['nama_petugas'] ?></td>
        <td>
        <?php 
                if(@$p['status'] == "dipinjam")
                {
                        echo '<h5><span class="badge badge-info">Dipinjam</span></h5>';   
                }
                else
                {
                        echo '<h5><span class="badge badge-secondary">Kembali</span></h5>';
                }
        ?>
                                <td>
                            <a href="#" class="badge badge-success">Detail</a>
                            <a href="#" class="badge badge-warning">Edit</a>
                            <a href="#" class="badge badge-danger">Hapus</a>
                            </td>
        </td>
        <td>
                                    
        </td>
    </tr>
                                        
<?php 
    $no++;
}
?>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include '../aset/footer.php';
?>