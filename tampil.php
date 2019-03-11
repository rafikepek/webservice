<?php
include "config.php";
$query = mysqli_query($connection,"SELECT ms.nim , ms.nama , ms.prodi , mk.kdmk , mk.nmmk , mk.sks , n.nilai 
    FROM mahasiswa ms join nilai n on ms.nim = n.nim join matakuliah mk on n.kdmk = mk.kdmk");
?>
<form action="" method="post">
    <table border="1" cellpadding="0" cellspacing="0">
        <tr>
            <th>no</th>
            <th>nim</th>
            <th>nama</th>
            <th>prodi</th>
            <th>kode mk</th>
            <th>makul</th>
            <th>sks</th>
            <th>nilai</th>
        </tr>
        <?php if(mysqli_num_rows($query)>0){ ?>
        <?php
            $no = 1;
            while($data = mysqli_fetch_array($query)){
        ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $data["nim"];?></td>
            <td><?php echo $data["nama"];?></td>
            <td><?php echo $data["prodi"];?></td>
            <td><?php echo $data["kdmk"];?></td>
            <td><?php echo $data["nmmk"];?></td>
            <td><?php echo $data["sks"];?></td>
            <td><?php echo $data["nilai"];?></td>
        </tr>
        <?php $no++; } ?>
        <?php } ?>
    </table>
</form>