<div class="row">
	<div class="col">
		<a href="<?=base_url('home/add')?>" class="btn btn-primary">Tambah</a>	
	</div>
</div>
<div class="row">
	<div class="col">
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">ID Makanan</th>
		      <th scope="col">Nama Makanan</th>
		      <th scope="col">Harga</th>
		      <th scope="col">ID Penjual</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		    <?php foreach ($data as $dt) { ?>
				<tr>
					<td scope="row"><?=$dt->id_makanan?></td>
					<td><?=$dt->nama_makanan?></td>
					<td><?=$dt->harga?></td>
					<td><?=$dt->id_penjual?></td>
					<td>
						<a href="<?=base_url("home/edit/$dt->id_makanan")?>" class="btn btn-warning" >Edit</a>
						<a href="<?=base_url("home/delete/$dt->id_makanan")?>" class="btn btn-danger">Hapus</a>
					</td>
				</tr>
			<?php } ?>
		  </tbody>
		</table>
	</div>
</div>