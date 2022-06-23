<?php include 'header.php'; ?>
			<form action="" class="col-md-6 mt-3" method="POST">
    	
			  <label for="formFile" class="form-label">Nama Paket</label>
			  <select name="id_paket">
				<?php 
					$sql = "SELECT * FROM paket";
					$query = mysqli_query($db, $sql);

					while($paket = mysqli_fetch_array($query)){

					?>
					<option value="<?php echo $paket['id'] ?>"><?php echo $paket['nama'] ?></option>
				<?php } ?>
			  	<option value=""></option>
			  </select>
			<br>

			  <label for="formFile" class="form-label">Nama Pelanggan</label>
			  <input class="form-control" type="text" name="nama_pelanggan" >
			<br>
			  <label for="formFileMultiple" class="form-label">Harga</label>
			  <input class="form-control" type="date"  name="tanggal"> 
			

			<input type="submit" name="submit" class="btn btn-primary" value="Simpan Data">
			
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
	    		$sql = "SELECT * FROM transaksi LEFT JOIN paket on paket.id=transaksi.id_paket";
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

    				</td>
    			</tr>
    		<?php } ?>
    		</tbody>
    	</table>	
   
		</div>


<?php 


if(isset($_POST['submit'])){

    $id_paket = $_POST['id_paket'];
    $nama_pelanggan = $_POST['nama_pelanggan'];

    $input_date=$_POST['tanggal'];
	$tanggal=date("Y-m-d",strtotime($input_date));

    $sql = "INSERT INTO transaksi (id_paket, nama_pelanggan, tanggal) VALUE ('$id_paket', '$nama_pelanggan', '$tanggal')";
    $query = mysqli_query($db, $sql);
 
    if( $query ) {
        header('Location: transaksi.php?status=sukses');
    } else {
        header('Location: transaksi.php?status=gagal');
    }


}


if(isset($_POST['hapus'])){

    $id = $_POST['id'];

    $sql = "DELETE FROM transaksi where id='$id'";
    $query = mysqli_query($db, $sql);

    if( $query ) {
        header('Location: transaksi.php?status=sukses');
    } else {
        header('Location: transaksi.php?status=gagal');
    }

}

?>
<?php include 'footer.php'; ?>

