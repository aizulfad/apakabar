<!-- DataTables -->
<link rel="stylesheet" href="<?=base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url() ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- sweetalert -->
<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />

<style> 

.btn-warning {
  background-color: #ffb764;
  color: #ffffff;
}

.btn-danger {
  background-color: #d54b4b;
}

.btn-primary {
  background-color: #4b8bd5;
  border:1px solid #4b8bd5;
}

.add a, .add button {
  margin-bottom: 0 !important;
  font-size: 12px
}

.dataTables_wrapper .dataTables_filter {
float: right;
text-align: right;
visibility: hidden;
}



</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pemesanan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">pemesanan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <h4>Pencarian pemesanan</h4>
        <div class="row mb-3">
          <div class="col-md-6">
          <div class="form-row">
            <div class="col">
                <input type="search" id="search" name="search" class="form-control" placeholder="Pencarian pemesanan">
              </div>
              <div class="col-md-4">
              </div>
            </div>
          </div>
          <div class="col-md-6 add">
          <?php if($this->session->userdata('tipe_user') != 'admin'){?>
              <a href="<?=site_url('pemesanan/export') ?>" type="submit" class="btn btn-success float-right" role="button"><i class="fas fa-file">    </i> Export </a>
              <button id="btn-pemesanan-modal" class="btn btn-primary float-right mx-2" onclick="btnPemesananModal('Tambah')"><i class="fas fa-plus"></i>   Tambah</button>
              <button id="cancel-pemesanan" class="btn btn-warning text-light float-right mx-2" style="display:none;"><i class="fas fa-times"></i>     Batal</button>
              <button id="btn-delete"class="btn btn-danger float-right" disabled><i class="fas fa-trash-alt">    </i> Hapus</button>
          <?php } ?>
            </div>
        </div>

        <div class="row">
          <div class="col-12">
            <table id="pemesanan" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th></th>
                  <th>No Pemesanan</th>
                  <th>Nama User</th>
                  <th>Nama Kendaraan</th>
                  <th>Harga (Per Unit)</th>
                  <th>Jumlah</th>
                  <th>Durasi (Hari)</th>
                  <th>Total Pembayaran</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


  <div class="modal fade" id="pemesananModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">   

                <div class="card-body">
                <h3 id="titleForm" class="text-center">Tambah</h3>

                <?php if($this->session->userdata('tipe_user') != 'employee'){?>
                  <div class="form-group">
                    <label for="user">Nama User</label>
                    <select name="user" class="form-control" id="user">
                    <option value="">Pilih User</option>
                      <?php foreach($user as $row) { ?>
                      <option value="<?=$row->id_user ?>"><?=$row->name ?></option>
                      <?php } ?>
                    </select>
                    <small id="user_eror" class="text-danger"></small>
                  </div>
                <?php } ?>
                  <div class="form-group">
                    <label for="kendaraan">Nama User</label>
                    <select name="kendaraan" class="form-control" id="kendaraan">
                    <option value="">Pilih Kendaraan</option>
                      <?php foreach($kendaraan as $row) { ?>
                      <option value="<?=$row->id_kendaraan ?>"><?=$row->nama ?></option>
                      <?php } ?>
                    </select>
                    <small id="kendaraan_eror" class="text-danger"></small>
                  </div>
                  
                  <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" id="jumlah" placeholder="Masukkan Jumlah" >
                    <small id="jumlah_eror" class="text-danger"></small>
                  </div>

                  <div class="form-group">
                    <label for="durasi">Durasi (Hari)</label>
                    <input type="number" name="durasi" class="form-control" id="durasi" placeholder="Masukkan durasi" >
                    <small id="durasi_eror" class="text-danger"></small>
                  </div>

                  <?php if($this->session->userdata('tipe_user') != 'employee'){?>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" id="status">
                    <option value="">Pilih Status</option>
                      <option value="1">Approve</option>
                      <option value="0">Waiting</option>
                    </select>
                    <small id="status_eror" class="text-danger"></small>
                  </div>
                  <?php }?>
                  <div class="form-group">
                    <button type="button" class="btn btn-danger btn-block mt-4" id="save">Save</button>
                  </div>
                </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- modal confirm -->
<div class="modal fade" id="modal-confirm" tabindex="-1" aria-labelledby="modal-confirmLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header d-block border-bottom-0 pb-0">
        <p><img src="<?=base_url('assets/img/warning.png') ?>" alt="" class="d-block margin-auto"></p>
        <h5 class="modal-title text-center font-weight-bold mb-1" id="modal-confirmLabel">--</h5>
      </div>
      <div class="modal-body text-center">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <button type="button" class="btn btn-light text-danger btn-lg font-weight-bold" data-dismiss="modal" aria-label="Close">Batal</button>
            <button id="btn-confirm" type="button" class="btn btn-danger btn-lg" data-dismiss="modal" aria-label="Close">Ya</button>
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- DataTables  & Plugins -->
<script src="<?=base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url() ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url() ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
  let data = {};

  function table() {
    var t = $('#pemesanan').DataTable({
        'ajax' : {
            "type": "GET",
            "url": "<?php echo base_url('pemesanan/get-pemesanan') ?>",
            "dataSrc": function (json) {
                console.log(json)
                return json;
            }
        },
        "dom": '<<t><"bottom" ilp>',
        "oLanguage" : {
            "sInfo" : "Total _TOTAL_ Baris",
            "sLengthMenu": "_MENU_ ",
            "oPaginate" : {
              "sNext" : "<img src='<?=base_url('assets/img/ionic-ios-arrow-up.svg') ?>'>",
              "sPrevious" : "<img src='<?=base_url('assets/img/ionic-ios-arrow-down.svg') ?>'>"
            }
        },
    });

    $('#search').on( 'keyup', function () {
        t.search( this.value ).draw();
    } );
  }

  $('#btn-delete').click(function() {

    const confirmlabel = "Apakah anda yakin ingin menghapus data ini?";
      $('#modal-confirmLabel').text(confirmlabel);
      $('#modal-confirm').modal();
    let dataArr = [];

    $('input[name="cb-pemesanan"]:checked').each(function(){
      dataArr.push(this.value);
    })
    data = {};
    data = {
      action: 'delete',
      all: dataArr
    }
  })

  $(document).ready(function(){
    table();

    $("#cancel-pemesanan").click(function(e){
      $("#cancel-pemesanan").toggle();
      $("#add-pemesanan").toggle();
      let jml_record_select = $('input[name="cb-pemesanan"]:checked').length;
      if(jml_record_select == 0){ 
          $("#btn-delete").prop('disabled', true);
        } else {
          $("#btn-delete").prop('disabled', false);
        }
      
    });

    $(document).on('click', 'input[name="cb-pemesanan"]', () => {
        let jml_record_select = $('input[name="cb-pemesanan"]:checked').length;

        if(jml_record_select >= 1){
          $("#add-pemesanan").hide();
          $("#cancel-pemesanan").show();  
          $("#btn-delete").prop('disabled', false);
        } else {
          $("#add-pemesanan").show();
          $("#cancel-pemesanan").hide();
          $("#btn-delete").prop('disabled', true);
        }
    })

    $(document).on('click', '#btn-confirm', () => {
      $.post("<?=base_url()?>pemesanan/"+data.action,data,function(response){
        swal("Deleted!", "Delete data berhasil", "success");
        setTimeout(function(){ 
          location.reload();
        }, 500);
      });
    })

  });

  function btnPemesananModal(action, data){
    if(action == 'Tambah'){
      $('#user').val('');
      $('#kendaraan').val('');
      $('#jumlah').val('');
      $('#durasi').val('');
      $('#status').val('');
      $('#titleForm').text(`${action} pemesanan`);
      $('#pemesananModal').modal();
      $('#save').attr('onClick','btnSave("add")');
    } else {
     
      $('#user').val(data[1]);
      $('#kendaraan').val(data[2]);
      $('#jumlah').val(data[3]);
      $('#durasi').val(data[4]);
      $('#status').val(data[5]);
      $('#titleForm').text(`${action} pemesanan`);
      $('#pemesananModal').modal();
      $('#save').attr('onClick',`btnSave("edit", ${data[0]})`);
    }
  } 

  function btnSave(action, idx=0, ){
    let user = (idx == 0)? "<?= $this->session->userdata('id_user')?>":$('#user').val();
    let kendaraan = $('#kendaraan').val();
    let jumlah = $('#jumlah').val();
    let durasi = $('#durasi').val();
    let status = (idx == 0)? '0' : $('#status').val();

    data = {idx,user,kendaraan,jumlah,durasi,status};
    //alert(JSON.stringify(data))

    if(user != '' && kendaraan != '' && jumlah != '' && durasi != '' && status != ''){
        $.post(`<?=base_url()?>pemesanan/${action}`,data, function(respons){
          //alert(respons);
          swal(action, `Data Berhasil di${action}. No Pemesanan anda: "${respons}"`, "success");
          setTimeout(function(){ 
            location.reload();
          }, 500);
          //location.reload();
        })
      } else {
        swal({
            title: "Mohon lengkapi form terlebih dahulu"
          });
      }

   // alert(`${nama} ${email} ${password} ${hp} ${tipe_pemesanan}`);
  }
</script>