<?php
$rowJenis = $this->M_mst_jenis->getAll();
$rowKategori = $this->M_mst_kategori->getAll();
$rowMerk = $this->M_mst_merk->getAll();
$rowSatuan = $this->M_mst_satuan->getAll();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Sparepart  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href=""> Sparepart </a></li>
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
              <th>Kategori</th>
              <th>Jenis Kendaraan</th>
              <th>Harga Jual</th>
              <th>Stok Akhir</th>
              <th>Satuan</th>
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
                <td><?=$this->M_mst_kategori->getDetail($row->kategoriid)->nama;?></td>
                <td><?=$this->M_mst_jenis->getDetail($row->jenisid)->nama;?></td>
                <td><?=number_format($row->hargajual,0,",",".");?></td>
                <td><?=($row->stokakhir)?$row->stokakhir:0;?></td>
                <td><?=$this->M_mst_satuan->getDetail($row->satuanid)->nama;?></td>
                <td>
                  <!-- <a href="<?=site_url('Sparepart/detail/'.$row->sparepartid);?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a> -->
                  <a href="" data-id="<?=$row->sparepartid?>" data-toggle="modal" data-target="#modalForm" onclick="getDetail(this)" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                  <a href="<?=site_url('Sparepart/delete/'.$row->sparepartid);?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <?=form_open("Sparepart/add","class='form-horizontal'");
      ?>
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">            
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Nama</label>
                  <div class="col-sm-8">
                    <input type="hidden" class="form-control" id="sparepartid" placeholder="sparepartid" name="sparepartid" value="">
                    <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="">
                  </div>
                </div>        
                <div class="form-group">
                  <label for="kategoriid" class="col-sm-4 control-label">Kategori</label>
                  <div class="col-sm-8">
                      <select name="kategoriid" id="kategoriid" required class="form-control">
                        <option value="">- Kategori -</option>
                        <?php foreach($rowKategori as $kategori):?>
                        <option value="<?=$kategori->kategoriid?>" ><?=$kategori->nama?></option>
                        <?php endforeach;?>
                      </select>
                  </div>
                </div>        
                <div class="form-group">
                  <label for="jenisid" class="col-sm-4 control-label">Jenis Kendaraan</label>
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
                  <label for="nama" class="col-sm-4 control-label">Satuan</label>
                  <div class="col-sm-8">
                      <select name="satuanid" id="satuanid" required class="form-control">
                        <option value="">- Jenis -</option>
                        <?php foreach($rowSatuan as $satuan):?>
                        <option value="<?=$satuan->satuanid?>" ><?=$satuan->nama?></option>
                        <?php endforeach;?>
                      </select>
                  </div>
                </div> 
                <div class="form-group">
                  <label for="qty" class="col-sm-4 control-label">harga Jual</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="hargajual" placeholder="harga jual" name="hargajual" value="">
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
      url: "<?=base_url('');?>Sparepart/detailJson/"+id,
      success: function (data) {
        //Do stuff with the JSON data
          console.log(data);
         $('#sparepartid').val(id).hide();
         $('#nama').val(data.nama);
         $('#kategoriid').val(data.kategoriid);
         $('#jenisid').val(data.jenisid);
         $('#satuanid').val(data.satuanid);
        }
    });
  }

  function clearForm() {  	
     $('#sparepartid').val("");
     $('#nama').val("");
     $('#kategoriid').val("");
     $('#jenisid').val("");
     $('#satuanid').val("");
  }
</script>