<?php include 'header.php'; ?>
			<form action="" class="col-md-6 mt-3" method="POST">
    	
			  <label for="formFile" class="form-label">Nama Paket</label>
			  <input class="form-control" type="text" name="nama" >
			
			  <label for="formFileMultiple" class="form-label">Harga</label>
			  <input class="form-control" type="text" name="harga"> 
			

			<input type="submit" name="submit" class="btn btn-primary" value="Simpan Data">
			
    	</form>
		</div>
    	<table class="table table-bordered">
    		<thead>
    			<tr>
    				<th>Nama Paket</th>
    				<th>Harga</th>
    				<th>Aksi</th>
    			</tr>
    		</thead>
    		
    		<tbody>
    			<?php 
	    		$sql = "SELECT * FROM paket";
				$query = mysqli_query($db, $sql);

				while($paket = mysqli_fetch_array($query)){

	    		?>
    			<tr>
    				<td><?php echo $paket['nama'] ?></td>
    				<td><?php echo $paket['harga'] ?></td>
    				<td>
    					
						<form action="" method="POST">
						  	<input class="form-control" type="hidden" name="id" value="<?php echo $paket['id'] ?>"> 
							<input type="submit" name="hapus" class="btn btn-primary" value="hapus">
						
				    	</form>

				    	<a href="master-edit?id=<?php echo $paket['id'] ?>" class="btn">Edit</a>
    				</td>
    			</tr>
    		<?php } ?>
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

