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
            <h1>User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <h4>Pencarian User</h4>
        <div class="row mb-3">
          <div class="col-md-6">
          <div class="form-row">
            <div class="col">
                <input type="search" id="search" name="search" class="form-control" placeholder="Pencarian User">
              </div>
              <div class="col-md-4">
              </div>
            </div>
          </div>
          <div class="col-md-6 add">
              <a href="<?=site_url('user/export') ?>" type="submit" class="btn btn-success float-right" role="button"><i class="fas fa-file">    </i> Export </a>
              <button id="btn-user-modal" class="btn btn-primary float-right mx-2" onclick="btnUserModal('Tambah')"><i class="fas fa-plus"></i>   Tambah</button>
              <button id="cancel-user" class="btn btn-warning text-light float-right mx-2" style="display:none;"><i class="fas fa-times"></i>Batal</button>
              <button id="btn-delete"class="btn btn-danger float-right" disabled><i class="fas fa-trash-alt">    </i> Hapus</button>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <table id="user" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th></th>
                  <th>No</th>
                  <th>nama</th>
                  <th>email</th>
                  <th>Handphone</th>
                  <th>Tipe User</th>
                  <th>Dibuat tanggal</th>
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


  <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">   

                <div class="card-body">
                <h3 id="titleForm" class="text-center">Tambah</h3>
                  
                  <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan nama" >
                    <small id="name_eror" class="text-danger"></small>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" >
                    <small id="email_eror" class="text-danger"></small>
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" class="form-control" id="password" placeholder="Masukkan password" >
                    <small id="password_eror" class="text-danger"></small>
                  </div>

                  <div class="form-group">
                    <label for="phone_number">No Handphone</label>
                    <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Masukkan nomor HP" maxlength="16">
                    <small id="phone_number_eror" class="text-danger"></small>
                  </div>

                  <div class="form-group">
                    <label for="tipe_user">Tipe User</label>
                    <select name="tipe_user" class="form-control" id="tipe_user">
                      <option value="super-admin">Super Admin</option>
                      <option value="admin">Admin</option>
                      <option value="employee">Employee (Staff/Spv/Manager)</option>
                    </select>
                    <small id="tipe_user_eror" class="text-danger"></small>
                  </div>

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
    var t = $('#user').DataTable({
        'ajax' : {
            "type": "GET",
            "url": "<?php echo base_url('user/get-user') ?>",
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

    const confirmlabel = "Apakah anda ingin menghapus data ini?";
      $('#modal-confirmLabel').text(confirmlabel);
      $('#modal-confirm').modal();
    let dataArr = [];

    $('input[name="cb-user"]:checked').each(function(){
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

    $("#cancel-user").click(function(e){
      $("#cancel-user").toggle();
      $("#add-user").toggle();
      let jml_record_select = $('input[name="cb-user"]:checked').length;
      if(jml_record_select == 0){ 
          $("#btn-delete").prop('disabled', true);
        } else {
          $("#btn-delete").prop('disabled', false);
        }
      
    });

    $(document).on('click', 'input[name="cb-user"]', () => {
        let jml_record_select = $('input[name="cb-user"]:checked').length;

        if(jml_record_select >= 1){
          $("#add-user").hide();
          $("#cancel-user").show();  
          $("#btn-delete").prop('disabled', false);
        } else {
          $("#add-user").show();
          $("#cancel-user").hide();
          $("#btn-delete").prop('disabled', true);
        }
    })

    $(document).on('click', '#btn-confirm', () => {
      $.post("<?=base_url()?>user/"+data.action,data,function(response){
        swal("Deleted!", "Delete data berhasil", "success");
        setTimeout(function(){ 
          location.reload();
        }, 500);
      });
    })

  });

  function btnUserModal(action, data){
    if(action == 'Tambah'){
      $('#name').val('');
      $('#email').val('');
      $('#password').val('');
      $('#phone_number').val('');
      $('#tipe_user').val('');
      $('#titleForm').text(`${action} User`);
      $('#userModal').modal();
      $('#save').attr('onClick','btnSave("add")');
    } else {
      $('#titleForm').text(`${action} User`);
      $('#name').val(data[1]);
      $('#email').val(data[2]);
      $('#password').val(data[3]);
      $('#phone_number').val(data[4]);
      $('#tipe_user').val(data[5]);
      $('#save').attr('onClick',`btnSave("edit", ${data[0]})`);
      $('#userModal').modal();
    }
  } 

  function btnSave(action, idx=0){
    let nama = $('#name').val();
    let email = $('#email').val();
    let password = $('#password').val();
    let hp = $('#phone_number').val();
    let tipe_user = $('#tipe_user').val();

    data = {idx,nama,email,password,hp,tipe_user};
    //alert(JSON.stringify(data))

    if(nama != '' && email != '' && password != '' && hp != '' && tipe_user != ''){
        $.post(`<?=base_url()?>user/${action}`,data, function(respons){
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

   // alert(`${nama} ${email} ${password} ${hp} ${tipe_user}`);
  }
</script>