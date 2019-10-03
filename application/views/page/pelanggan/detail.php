
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


<!-- Content content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <div class="pull-right">
            <a href="<?=site_url("Cetak/pelanggan/$data->pelangganid")?>" class="btn btn-success"><i class="fa fa-print"></i></a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        	<div class="row">
	        	<div class="col-md-6">
		        	<table class="table">
		        		<tr>
		        			<td width="25%">Nama Pemilik</td>
		        			<td>: <?=$data->nama_pemilik?></td>
		        		</tr>
		        		<tr>
		        			<td>Alamat</td>
		        			<td>: <?=$data->alamat?></td>
		        		</tr>
		        		<tr>
		        			<td>No. Telepon</td>
		        			<td>: <?=$data->notelp?></td>
		        		</tr>
		        	</table> 
	        	</div>
	        	<div class="col-md-6">
		        	<table class="table">
		        		<tr>
		        			<td width="25%">No. Polisi</td>
		        			<td>: <?=$data->nopolisi?></td>
		        		</tr>
		        		<tr>
		        			<td>Merk</td>
		        			<td>: <?=$this->M_mst_merk->getDetail($data->merkid)->nama;?></td>
		        		</tr>
		        		<tr>
		        			<td>Jenis</td>
		        			<td>: <?=$this->M_mst_jenis->getDetail($data->jenisid)->nama;?></td>
		        		</tr>
		        	</table> 
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
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Tanggal Masuk</th>
              <th>Tanggal Keluar</th>
              <th>Keluhan</th>
              <th>Keterangan</th>
              <th>Status</th>
              <th>Mekanik</th>
              <th>Rata-rata Feedback</th>
            </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($rowData as $row) :
              ?>
              <tr>
                <td><?=$no++;?></td>
                <td><?=$row->tanggal_masuk;?></td>
                <td><?=$row->tanggal_keluar;?></td>
                <td><?=$row->keluhan;?></td>
                <td><?=$row->keterangan;?></td>
                <td><?=$row->status;?></td>
                <td><?=$this->M_user->getDetail($row->userid)->nama;?></td>
                <td><?php
                  $penjualan = $this->M_penjualan->getDetailByFk($row->workorderid);
                  if($penjualan){
                    $penjualanid = $penjualan->penjualanid;
                    $nilai = $this->M_feedback->getSumNilai($penjualanid)->nilai;
                    echo ($nilai)?$nilai/count($this->M_mst_feedback->getAll()):"0";
                  }
                  else{
                    echo "0";
                  }
                ?></td>
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