<?php
$rowPelayanan = $this->M_mst_pelayanan->getAll();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Pembelian Sparepart  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?=site_url('Workorder');?>"> Workorder </a></li>
    <li><a href=""> Workorder #<?=$data->nomor?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <div class="pull-right">
            <a href="<?=site_url("Cetak/workorder/$data->workorderid")?>" class="btn btn-success"><i class="fa fa-print"></i></a>
          </div>
        </div>
        <div class="box-header">
        <?php if($this->session->flashdata("warning")): ?>
          <div class="col-md-12">
            <div class="alert alert-warning" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <?=$this->session->flashdata("warning")?>
            </div>
          </div>
        <?php endif; ?>

        <?php if(!$data->status): ?>
          <div class="col-md-12">
            <div class="text-center">
              <a href="<?=site_url('Workorder/batal/').$data->workorderid;?>" class="btn btn-danger">BATAL</a>
              <!-- <a href="<?=site_url('Workorder/save/').$data->workorderid;?>" class="btn btn-success">SELESAI</a> -->
              <a href="" data-toggle="modal" data-target="#modalEnd"  class="btn btn-success">SELESAI</a>
            </div>
          </div>
        <?php endif; ?>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row form-horizontal">
              <div class="col-md-6">            
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Nama Pemilik</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="<?=$rowCust->nama_pemilik?>" disabled="">
                  </div>
                </div>        
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Alamat Rumah</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="<?=$rowCust->alamat?>" disabled="">
                  </div>
                </div>   
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Telepon</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="<?=$rowCust->notelp?>" disabled="">
                  </div>
                </div>      
              </div> 
              <div class="col-md-6"> 
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">No Polisi</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="<?=$rowCust->nopolisi?>" disabled="">
                  </div>
                </div>          
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Jenis</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="<?=$this->M_mst_jenis->getDetail($rowCust->jenisid)->nama?>" disabled="">
                  </div>
                </div>        
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Merk</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="<?=$this->M_mst_merk->getDetail($rowCust->merkid)->nama?>" disabled="">
                  </div>
                </div>   
              </div>        
            </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
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
              <th>Pelayanan</th>
              <th>Sparepart</th>
              <th>Jumlah</th>
              <th>Total</th>
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
                <td><?=$this->M_mst_pelayanan->getDetail($row->pelayananid)->nama;?></td>
                <td><?=$this->M_sparepart->getDetail($row->sparepartid)->nama;?></td>
                <td><?=$row->qty;?></td>
                <td><?=$row->total;?></td>
                <td>
                  <a href="<?=site_url('Workorder/deleteDetail/'.$row->detailwoid);?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
      <?=form_open("Workorder/addDetail","class='form-horizontal'");
      ?>
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">            
                <div class="form-group">
                  <label for="tanggal" class="col-sm-4 control-label">Pelayanan</label>
                  <input type="hidden" class="form-control" placeholder="workorderid" name="workorderid" value="<?=$data->workorderid;?>">
                  <div class="col-sm-8">
	                  <select name="pelayananid" id="pelayananid" required class="form-control" onchange="getDetail(this)" data-pelangganid="<?=$data->pelangganid;?>">
	                    <option value="">- pelayanan -</option>
	                    <?php foreach($rowPelayanan as $pelayanan):?>
	                    <option value="<?=$pelayanan->pelayananid?>" ><?=$pelayanan->nama?></option>
	                    <?php endforeach;?>
	                  </select>
                  </div>
                </div>   
                <div class="form-group text-center showGagal" hidden="">
                  <i class="text-danger">- tidak ada sparepart yang cocok -</i>
                </div>   
                <div class="form-group showSukses" hidden="">
                  <label for="qty" class="col-sm-4 control-label">Sparepart</label>
                  <div class="col-sm-8 menusparepart">
                  </div>
                </div> 
                <div class="form-group showSukses" hidden="">
                  <label for="qty" class="col-sm-4 control-label">Jumlah</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="qty" placeholder="jumlah" name="qty" value="" min="0">
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

<!-- Modal -->
<div id="modalEnd" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Faktur</h4>
      </div>
      <?=form_open("Workorder/save/$data->workorderid","class='form-horizontal'");
      ?>
      <input type="hidden" class="form-control" placeholder="workorderid" name="workorderid" value="<?php echo $data->workorderid;?>">
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nomorfaktur" class="col-sm-4 control-label">Tanggal</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" id="nomorfaktur" placeholder="nomor faktur" name="tanggal" value="">
                  </div>
                </div> 
              </div>      
            </div>
          </div>
          <!-- /.box-footer -->
      </div>
      <div class="modal-footer">
        <?=form_submit("btnsubmit", "CETAK","class='btn btn-success'");?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      <?=form_close();?>
    </div>

  </div>
</div>


<script>
  function getDetail(ini) {
    var pelangganid = $(ini).attr('data-pelangganid');
    var id = $('#pelayananid').val();
    clearForm();
    $.ajax({
      type: 'GET',
      url: "<?=base_url('');?>PelayananDetail/all/"+id+"/"+pelangganid,
      success: function (data) {
        //Do stuff with the JSON data
          console.log(data);
          if(data.length > 0 ){
            $(".showSukses").show();
            $.each(data, function(key, val){
              if(val.stokakhir < 0){
                var li = $("<div class='radio disabled'><label class='text-danger'><input disabled type='radio' name='sparepartid' value='"+val.sparepartid+"'>"+val.nama+" ("+val.stokakhir+" tersedia)</label></div>");
              }else{
                var li = $("<div class='radio'><label><input type='radio' name='sparepartid' value='"+val.sparepartid+"'>"+val.nama+" ("+val.stokakhir+" tersedia)</label></div>");
              }

              $(".menusparepart").append(li);
            });
          }
          else{
            $(".showGagal").show();
          }
         // $('#workorderid').val(id).hide();
         // $('#sparepartid').val(data.sparepartid);
         // $('#qty').val(data.qty);
      },
      error: function (data) {
        $(".showGagal").show();
      }
    });
  }

  function clearForm() {    
    // $('#pelayananid').val("");
    $(".menusparepart").empty();
    $('#qty').val("");
    $(".showGagal").hide();
    $(".showSukses").hide();
  }
</script>