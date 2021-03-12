<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table border="1" width="100%">

<thead>

<tr>

 <th>No</th>

 <th>Nama Kendaraan</th>

 <th>Tipe Kendaraan</th>

 <th>Stok</th>

 <th>Harga</th>

 <th>Dibuat tanggal</th>

 </tr>

</thead>

<tbody>

<?php $i=1; foreach($kendaraan as $row) { ?>

<tr>

 <td><?php echo $i ?></td>

 <td><?php echo $row->nama ?></td>

 <td><?php echo $row->tipe ?></td>

 <td><?php echo $row->stok ?></td>

 <td><?php echo $row->harga ?></td>

 <td><?php echo $row->created_date ?></td>

 </tr>

<?php $i++; } ?>

</tbody>

</table>