<form method="POST">
	<input type="hidden" name="id_makanan" value="<?=$data->id_makanan?>">
	<div class="form-group">
	    <label>Nama Makanan</label>
		<input type="text" name="nama_makanan" class="form-control" placeholder="Nama Makanan" value="<?=$data->nama_makanan?>">
	</div>
	<div class="form-group">
		<label>Harga</label>
		<input type="text" name="harga" class="form-control" placeholder="Harga Makanan" value="<?=$data->harga?>">
	</div>
	<div class="form-group">
		<label>ID Penjual</label>
		<input type="text" name="id_penjual" class="form-control" placeholder="ID Penjual" value="<?=$data->id_penjual?>">
	</div>
	<button type="submit" class="btn btn-primary" name="submit" value="1!1">Simpan</button>
</form>