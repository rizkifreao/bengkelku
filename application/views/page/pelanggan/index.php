<?php
$rowJenis = $this->M_mst_jenis->getAll();
$rowKategori = $this->M_mst_kategori->getAll();
$rowMerk = $this->M_mst_merk->getAll();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Pelanggan  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href=""> Pelanggan </a></li>
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
              <th>No Polisi</th>
              <th>Nama Pemilik</th>
              <th>No Telepon</th>
              <th>Merk</th>
              <th>Jenis</th>
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
                <td><?=$row->nopolisi;?></td>
                <td><?=$row->nama_pemilik;?></td>
                <td><?=$row->notelp;?></td>
                <td><?=$this->M_mst_merk->getDetail($row->merkid)->nama;?></td>
                <td><?=$this->M_mst_jenis->getDetail($row->jenisid)->nama;?></td>
                <td>
                  <a href="<?=site_url('Pelanggan/detail/'.$row->pelangganid);?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                  <a href="" data-id="<?=$row->pelangganid?>" data-toggle="modal" data-target="#modalForm" onclick="getDetail(this)" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                  <a href="<?=site_url('Pelanggan/delete/'.$row->pelangganid);?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
        <h4 class="modal-title">Tambah Pelanggan</h4>
      </div>
      <?=form_open("Pelanggan/add","class='form-horizontal'");
      ?>
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">            
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Nama</label>
                  <div class="col-sm-8">
                    <input type="hidden" class="form-control" id="pelangganid" placeholder="pelangganid" name="pelangganid" value="">
                    <input type="text" class="form-control" id="nama_pemilik" placeholder="nama_pemilik" name="nama_pemilik" value="">
                  </div>
                </div>      
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">No Telepon</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="notelp" placeholder="notelp" name="notelp" value="">
                  </div>
                </div>      
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Alamat</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="alamat" placeholder="alamat" name="alamat" value="">
                  </div>
                </div>      
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">No Polisi</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nopolisi" placeholder="nopolisi" name="nopolisi" value="">
                  </div>
                </div>   
                <div class="form-group">
                  <label for="jenisid" class="col-sm-4 control-label">Jenis</label>
                  <div class="col-sm-8">
                      <select name="jenisid" id="jenisid" required class="form-control">
                        <option value="">- Jenis -</option>
                        <?php foreach($rowJenis as $jenis):?>
                        <option value="<?=$jenis->jenisid?>" ><?=$jenis->nama?></option>
                        <?php endforeach;?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="merkid" class="col-sm-4 control-label">Merk</label>
                  <div class="col-sm-8">
                      <select name="merkid" id="merkid" required class="form-control">
                        <option value="">- Merk -</option>
                        <?php foreach($rowMerk as $merk):?>
                        <option value="<?=$merk->merkid?>" ><?=$merk->nama?></option>
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
      url: "<?=base_url('');?>Pelanggan/detailJson/"+id,
      success: function (data) {
        //Do stuff with the JSON data
          console.log(data);
         $('#pelangganid').val(id).hide();
         $('#nama_pemilik').val(data.nama_pemilik);
         $('#notelp').val(data.notelp);
         $('#alamat').val(data.alamat);
         $('#nopolisi').val(data.nopolisi);
         $('#jenisid').val(data.jenisid);
         $('#merkid').val(data.merkid);
        }
    });
  }

  function clearForm() {  	
     $('#pelangganid').val("");
     $('#nama_pemilik').val("");
     $('#notelp').val("");
     $('#alamat').val("");
     $('#nopolisi').val("");
     $('#jenisid').val("");
     $('#merkid').val("");
  }
</script>