<?php
$rowTipe = $this->M_mst_tipe_pelayanan->getAll();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Pelayanan  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href=""> Pelayanan </a></li>
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
              <th>Tipe</th>
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
                <td><?=$this->M_mst_tipe_pelayanan->getDetail($row->tipepelayananid)->nama;?></td>
                <td>
                  <a href="<?=site_url('Pelayanan/detail/'.$row->pelayananid);?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                  <a href="" data-id="<?=$row->pelayananid?>" data-toggle="modal" data-target="#modalForm" onclick="getDetail(this)" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                  <a href="<?=site_url('Pelayanan/delete/'.$row->pelayananid);?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
        <h4 class="modal-title">Tambah Pelayanan</h4>
      </div>
      <?=form_open("Pelayanan/add","class='form-horizontal'");
      ?>
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">            
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Nama</label>
                  <div class="col-sm-8">
                    <input type="hidden" class="form-control" id="pelayananid" placeholder="pelayananid" name="pelayananid" value="">
                    <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="">
                  </div>
                </div>     
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Tipe Pelayanan</label>
                  <div class="col-sm-8">
                      <select name="tipepelayananid" id="tipepelayananid" required class="form-control">
                        <option value="">- Tipe -</option>
                        <?php foreach($rowTipe as $row):?>
                        <option value="<?=$row->tipepelayananid?>" ><?=$row->nama?></option>
                        <?php endforeach;?>
                      </select>
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
  function getDetail(ini) {
    var id = $(ini).attr('data-id');
    $.ajax({
      type: 'GET',
      url: "<?=base_url('');?>Pelayanan/detailJson/"+id,
      success: function (data) {
        //Do stuff with the JSON data
          console.log(data);
         $('#pelayananid').val(id).hide();
         $('#nama').val(data.nama);
         $('#tipepelayananid').val(data.tipepelayananid);
        }
    });
  }

  function clearForm() {    
     $('#pelayananid').val("");
     $('#nama').val("");
     $('#tipepelayananid').val("");
  }
</script>