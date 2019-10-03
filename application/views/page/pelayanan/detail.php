<?php
$rowMerk = $this->M_mst_merk->getAll();
$rowJenis = $this->M_mst_jenis->getAll();
$rowSparepart = $this->M_sparepart->getAll();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Pelayanan Detail  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?=site_url('Pelayanan');?>"> Pelayanan </a></li>
    <li><a href=""> Detail Pelayanan</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            <?=$data->nama?>
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
              <th>Merk</th>
              <th>Jenis</th>
              <th>Sparepart</th>
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
                <td><?=$this->M_mst_merk->getDetail($row->merkid)->nama;?></td>
                <td><?=$this->M_mst_jenis->getDetail($row->jenisid)->nama;?></td>
                <td><?=$this->M_sparepart->getDetail($row->sparepartid)->nama;?></td>
                <td>
                  <a href="<?=site_url('Pelayanan/deleteDetail/'.$row->pelayanandetailid);?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
        <h4 class="modal-title">Tambah Pelayanan Detail</h4>
      </div>
      <?=form_open("PelayananDetail/add","class='form-horizontal'");
      ?>
	    <input type="hidden" class="form-control" id="pelayananid" placeholder="pelayananid" name="pelayananid" value="<?=$data->pelayananid?>">
	    <input type="hidden" class="form-control" id="pelayanandetailid" placeholder="pelayanandetailid" name="pelayanandetailid" value="">
      <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">         
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Merk</label>
                  <div class="col-sm-8">
                      <select name="merkid" id="merkid" required class="form-control">
                        <option value="">- merk -</option>
                        <?php foreach ($rowMerk as $merk):?>
                        <option value="<?=$merk->merkid?>"><?=$merk->nama?></option>
                    	<?php endforeach; ?>
                      </select>
                  </div>
                </div>    
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Jenis</label>
                  <div class="col-sm-8">
                      <select name="jenisid" id="jenisid" required class="form-control">
                        <option value="">- jenis -</option>
                        <?php foreach ($rowJenis as $jenis):?>
                        <option value="<?=$jenis->jenisid?>"><?=$jenis->nama?></option>
                    	<?php endforeach; ?>
                      </select>
                  </div>
                </div>    
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Sparepart</label>
                  <div class="col-sm-8">
                      <select name="sparepartid" id="sparepartid" required class="form-control">
                        <option value="">- sparepart -</option>
                        <?php foreach ($rowSparepart as $sparepart):?>
                        <option value="<?=$sparepart->sparepartid?>"><?=$sparepart->nama?></option>
                    	<?php endforeach; ?>
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
      url: "<?=base_url('');?>Pelayanan_detail/detail/"+id,
      success: function (data) {
        //Do stuff with the JSON data
          console.log(data);
         $('#pelayanandetailid').val(id).hide();
         $('#merkid').val(data.merkid);
         $('#jenisid').val(data.jenisid);
         $('#sparepartid').val(data.sparepartid);
        }
    });
  }

  function clearForm() {    
     $('#pelayanandetailid').val("");
     $('#merkid').val("");
     $('#jenisid').val("");
     $('#sparepartid').val("");
  }
</script>