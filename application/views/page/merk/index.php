
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Merk  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href=""> Merk </a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Tabel Data
          </h3>
          <div class="pull-right">
            <a href="" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalForm" onclick="clearForm()"><i class="fa fa-plus"></i> Tambah Data</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>action</th>
            </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($rowData as $row) :
              ?>
              <tr>
                <td><?=$no++;?></td>
                <td><?=$row->nama;?></td>
                <td>
                  <a href="" data-id="<?=$row->merkid?>" data-toggle="modal" data-target="#modalForm" onclick="getDetail(this)" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                  <!-- <a href="" class="btn btn-xs btn-danger"><i class="fa fa-trash" onclick=”return confirm(‘Yakin Hapus?’)”>Hapus</a> -->
                  <a href="<?=site_url('Merk/delete/'.$row->merkid);?>" class="btn btn-xs btn-danger"onclick="javascript: return confirm('Anda yakin hapus ?')"><i class="fa fa-trash"></i></a>
                  <!-- 

                  <a href="<?=site_url('Merk/delete/'.$row->merkid);?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a> -->
                </td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->






<!-- Modal -->
<div id="modalForm" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Merk</h4>
      </div>
      <?=form_open("Merk/add","class='form-horizontal'");
      ?>
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">            
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Nama</label>
                  <div class="col-sm-8">
                    <input type="hidden" class="form-control" id="merkid" placeholder="merkid" name="merkid" value="">
                    <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="">
                  </div>
                </div>           
              </div>        
            </div>
          </div>
          <!-- /.box-footer -->
      </div>
      <div class="modal-footer">
        <?=form_submit("btnsubmit", "save","class='btn btn-success'");?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      <?=form_close();?>
    </div>

  </div>
</div>


<script>
  $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
    if ($id <> '') {
    //    jalankan perintah hapus data
    //    mysql_query("DELETE FROM tabel WHERE id='$id'");
        echo 'data dengan id = '.$id.' berhasil dihapus';
    }

  function getDetail(ini) {
    var id = $(ini).attr('data-id');
    $.ajax({
      type: 'GET',
      url: "<?=base_url('');?>Merk/detail/"+id,
      success: function (data) {
        //Do stuff with the JSON data
          console.log(data);
         $('#merkid').val(id).hide();
         $('#nama').val(data.nama);
        }
    });
  }

  function clearForm() {    
     $('#merkid').val("");
     $('#nama').val("");
  }
</script>