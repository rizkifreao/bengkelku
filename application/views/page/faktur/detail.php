<?php
$rowSparepart = $this->M_sparepart->getAll();
$rowMstFeedback = $this->M_mst_feedback->getAll();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Faktur Detail  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?=site_url('Faktur');?>"> Faktur </a></li>
    <li><a href=""> Faktur #<?=$data->nomorfaktur?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <div class="pull-right">
            <?php if(count($rowFeedback) > 0): ?>
              <a href="<?=site_url("Cetak/faktur/$data->penjualanid")?>" class="btn btn-success"><i class="fa fa-print"></i></a>
            <?php else: ?>
              <a href="" class="btn btn-success" data-toggle="modal" data-target="#modalFeedback"><i class="fa fa-print"></i></a>
            <?php endif; ?>
          </div>
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
            Sparepart
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Sparepart</th>
              <th>Jumlah</th>
              <th>Total</th>
            </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($rowDetailWo as $row) :
              ?>
              <tr>
                <td><?=$no++;?></td>
                <td><?=$this->M_sparepart->getDetail($row->sparepartid)->nama;?></td>
                <td><?=$row->qty;?></td>
                <td><?=number_format($row->total,0,",",".");?></td>
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
    <!-- /.col -->
    
<!--     <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Feedback
          </h3>
        </div>
        <div class="box-body">
          <table id="" class="example2 table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Pertanyaan</th>
              <th>NIlai</th>
            </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($rowFeedback as $row) :
              ?>
              <tr>
                <td><?=$no++;?></td>
                <td><?=$this->M_mst_feedback->getDetail($row->mstfeedbackid)->pertanyaan;?></td>
                <td><?=$row->nilai;?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div> -->

    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->



<!-- Modal -->
<div id="modalFeedback" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">FEEDBACK</h4>
      </div>
      <?=form_open("Faktur/cetak/$data->penjualanid","class='form-horizontal'");
      ?>
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <?php foreach($rowMstFeedback as $row):?>
                <div class="form-group">
                  <label for="nilai" class="col-sm-10 control-label" style="text-align:left"><?=$row->pertanyaan?></label>
                  <div class="col-sm-2">
                    <label for=""><input type="radio" name="<?=$row->mstfeedbackid?>" id="<?=$row->mstfeedbackid?>" value="1" checked="">Kurang</label>
                    <label for=""><input type="radio" name="<?=$row->mstfeedbackid?>" id="<?=$row->mstfeedbackid?>" value="2" checked="">Cukup</label>
                    <label for=""><input type="radio" name="<?=$row->mstfeedbackid?>" id="<?=$row->mstfeedbackid?>" value="3" checked="">Baik</label>
                  </div>
                </div> 
                <hr>
                <?php endforeach;?>
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