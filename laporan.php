<?php include 'header.php'; ?>
		<h3>Laporan</h3>

<form action="" class="col-md-6 mt-3" method="GET">

              <label for="formFile" class="form-label">Bulan</label>
              <select name="bulan">
                <?php 
                   for ($x = 1; $x <= 12; $x++) { ?>
                        <option value="<?php echo $x ?>"><?php echo $x ?></option>
                <?php } ?>
              </select>
            <br>

            <label for="formFile" class="form-label">Tahun</label>
              <input class="form-control" type="text" name="tahun" >

            

            <input type="submit" name="filter" class="btn btn-primary" value="filter">
            
        </form>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            
            <tbody>
                <?php 
                if (isset($_GET['tahun'])) {

                $bulan = isset($_GET['bulan']) ?? 2;
                $tahun = isset($_GET['tahun']) ?? 2022;

                $sql = "SELECT * FROM transaksi LEFT JOIN paket on paket.id=transaksi.id_paket WHERE MONTH(transaksi.tanggal)='$bulan' and YEAR(transaksi.tahun)='$tahun'";
                $query = mysqli_query($db, $sql);

                while($paket = mysqli_fetch_array($query)){

                ?>
                <tr>
                    <td><?php echo $paket['nama'] ?></td>
                    <td><?php echo $paket['harga'] ?></td>
                    <td><?php echo $paket['nama_pelanggan'] ?></td>
                    <td><?php echo $paket['tanggal'] ?></td>
                    
                    <td>
                        
                        <form action="" method="POST">
                            <input class="form-control" type="hidden" name="id" value="<?php echo $paket['id'] ?>"> 
                            <input type="submit" name="hapus" class="btn btn-primary" value="hapus">
                        
                        </form>

                        <a href="master-edit?id=<?php echo $paket['id'] ?>" class="btn">Edit</a>
                    </td>
                </tr>
            <?php } }?>
            </tbody>
        </table>    
   
		</div>


<?php 


if(isset($_POST['submit'])){

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    $sql = "INSERT INTO paket (nama, harga) VALUE ('$nama', '$harga')";
    $query = mysqli_query($db, $sql);
    if( $query ) {
        header('Location: master.php?status=sukses');
    } else {
        header('Location: master.php?status=gagal');
    }


}


if(isset($_POST['hapus'])){

    $id = $_POST['id'];

    $sql = "DELETE FROM paket where id='$id'";
    $query = mysqli_query($db, $sql);

    if( $query ) {
        header('Location: master.php?status=sukses');
    } else {
        header('Location: master.php?status=gagal');
    }

}

?>
<?php include 'footer.php'; ?>

