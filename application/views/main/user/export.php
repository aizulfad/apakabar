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

 <th>Nama User</th>

 <th>Email</th>

 <th>Handphone</th>

 <th>Tipe User</th>

 <th>Dibuat Tanggal</th>

 </tr>

</thead>

<tbody>

<?php $i=1; foreach($user as $row) { ?>

<tr>

 <td><?php echo $i ?></td>

 <td><?php echo $row->name ?></td>

 <td><?php echo $row->email ?></td>

 <td><?php echo $row->phone_number ?></td>

 <td><?php echo $row->tipe_user ?></td>

 <td><?php echo $row->created_date ?></td>

 </tr>

<?php $i++; } ?>

</tbody>

</table>