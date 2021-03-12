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
            <h1>Kendaraan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">kendaraan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <h4>Pencarian kendaraan</h4>
        <div class="row mb-3">
          <div class="col-md-6">
          <div class="form-row">
            <div class="col">
                <input type="search" id="search" name="search" class="form-control" placeholder="Pencarian kendaraan">
              </div>
              <div class="col-md-4">
              </div>
            </div>
          </div>
          <div class="col-md-6 add">
              <?php if($this->session->userdata('tipe_user') != 'employee'){?>
              <a href="<?=site_url('kendaraan/export') ?>" type="submit" class="btn btn-success float-right" role="button"><i class="fas fa-file">    </i> Export </a>
              <button id="btn-kendaraan-modal" class="btn btn-primary float-right mx-2" onclick="btnKendaraanModal('Tambah')"><i class="fas fa-plus"></i>   Tambah</button>
              <button id="cancel-kendaraan" class="btn btn-warning text-light float-right mx-2" style="display:none;"><i class="fas fa-times"></i>     Batal</button>
              <button id="btn-delete"class="btn btn-danger float-right" disabled><i class="fas fa-trash-alt">    </i> Hapus</button>
              <?php } ?>
            </div>
        </div>

        <div class="row">
          <div class="col-12">
            <table id="kendaraan" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th></th>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Tipe </th>
                  <th>Stok</th>
                  <th>Harga Sewa (per Hari)</th>
                  <th>Dibuat tanggal</th>
                  <?php if($this->session->userdata('tipe_user') != 'employee'){?>
                  <th>Action</th>
                  <?php } ?>
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


  <div class="modal fade" id="kendaraanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">   

                <div class="card-body">
                <h3 id="titleForm" class="text-center">Tambah</h3>
                  
                  <div class="form-group">
                    <label for="name">Nama Kendaraan</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama kendaraan" >
                    <small id="name_eror" class="text-danger"></small>
                  </div>

                  <div class="form-group">
                    <label for="tipe">Tipe User</label>
                    <select name="tipe" class="form-control" id="tipe">
                      <option value="indoor">Indoor</option>
                      <option value="outdoor">Outdoor</option>
                    </select>
                    <small id="tipe_eror" class="text-danger"></small>
                  </div>

                  <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" class="form-control" id="stok" placeholder="Masukkan stok kendaraan" >
                    <small id="stok_eror" class="text-danger"></small>
                  </div>

                  <di class="form-group">
                    <label for="harga">Harga Sewa (per Hari)</label>
                    <input type="number" name="harga" class="form-control" id="harga" placeholder="Masukkan harga kendaraan" >
                    <small id="harga_eror" class="text-danger"></small>
                  </di>

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
    var t = $('#kendaraan').DataTable({
        'ajax' : {
            "type": "GET",
            "url": "<?php echo base_url('kendaraan/get-kendaraan') ?>",
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

    $('input[name="cb-kendaraan"]:checked').each(function(){
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

    $("#cancel-kendaraan").click(function(e){
      $("#cancel-kendaraan").toggle();
      $("#add-kendaraan").toggle();
      let jml_record_select = $('input[name="cb-kendaraan"]:checked').length;
      if(jml_record_select == 0){ 
          $("#btn-delete").prop('disabled', true);
        } else {
          $("#btn-delete").prop('disabled', false);
        }
      
    });

    $(document).on('click', 'input[name="cb-kendaraan"]', () => {
        let jml_record_select = $('input[name="cb-kendaraan"]:checked').length;

        if(jml_record_select >= 1){
          $("#add-kendaraan").hide();
          $("#cancel-kendaraan").show();  
          $("#btn-delete").prop('disabled', false);
        } else {
          $("#add-kendaraan").show();
          $("#cancel-kendaraan").hide();
          $("#btn-delete").prop('disabled', true);
        }
    })

    $(document).on('click', '#btn-confirm', () => {
      $.post("<?=base_url()?>kendaraan/"+data.action,data,function(response){
        swal("Deleted!", "Delete data berhasil", "success");
        setTimeout(function(){ 
          location.reload();
        }, 500);
      });
    })

  });

  function btnKendaraanModal(action, data){
    if(action == 'Tambah'){
      $('#nama').val('');
      $('#tipe').val('');
      $('#stok').val('');
      $('#harga').val('');
      $('#titleForm').text(`${action} kendaraan`);
      $('#kendaraanModal').modal();
      $('#save').attr('onClick','btnSave("add")');
    } else {
      $('#titleForm').text(`${action} kendaraan`);
      $('#nama').val(data[1]);
      $('#tipe').val(data[2]);
      $('#stok').val(data[3]);
      $('#harga').val(data[4]);
      $('#save').attr('onClick',`btnSave("edit", ${data[0]})`);
      $('#kendaraanModal').modal();
    }
  } 

  function btnSave(action, idx=0){
    let nama = $('#nama').val();
    let tipe = $('#tipe').val();
    let stok = $('#stok').val();
    let harga = $('#harga').val();

    data = {idx,nama,tipe,stok,harga};

    if(nama != '' && tipe != '' && stok != '' && harga != ''){
        $.post(`<?=base_url()?>kendaraan/${action}`,data, function(respons){
          //alert(respons);
          swal(action, `Data Berhasil di${action}`, "success");
          setTimeout(function(){ 
            location.reload();
          }, 500);
        })
      } else {
        swal({
            title: "Mohon lengkapi form terlebih dahulu"
          });
      }
  }
</script>