<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table border="1" width="100%">

<thead>

<tr>

 <th>No Pemesanan</th>

 <th>Nama User</th>

 <th>Nama Kendaraan</th>

 <th>Harga (per Unit)</th>

 <th>Jumlah</th>

 <th>Durasi (Hari)</th>

 <th>Total Pembayaran</th>

 <th>Status</th>

 </tr>

</thead>

<tbody>

<?php $i=1; foreach($pemesanan as $row) { ?>

  

<tr>

 <td><?php echo $i ?></td>

 <td><?php echo $row->name ?></td>

 <td><?php echo $row->nama ?></td>

 <td><?php echo $row->harga ?></td>

 <td><?php echo $row->jumlah ?></td>

 <td><?php echo $row->durasi_pemakaian ?></td>

 <td><?php echo number_format($row->total_pembayaran) ?></td>

 <td><?php echo ($row->status == 1)? 'Approve' : 'Waiting' ?></td>

 </tr>

<?php $i++; } ?>

</tbody>

</table>