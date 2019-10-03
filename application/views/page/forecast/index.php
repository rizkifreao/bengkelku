<section class="content-header">
  <h1>
     Forecast  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href=""> Forecast </a></li>
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
            <a href="<?=site_url("Forecast/index/1")?>" class="btn btn-success"><i class="fa fa-print"></i> Print</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Stok Akhir</th>
              <th>Satuan</th>
              <th>Safety Stock</th>
              <th>yang harus dibeli</th>
<!--               <th>Total Transaksi</th>
              <th>Transaksi Berhasil</th> -->
              <!-- <th>Safety Stock</th>
              <th>FORECAST</th> -->
              <th>action</th>
            </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($rowData as $row) :
              ?>
              <tr class="<?=($row->safety > $row->stokakhir)?'bg-red':''?>">
                <td><?=$no++;?></td>
                <td><?=$row->nama;?></td>
                <td><?=$row->stokakhir;?></td>
                <td><?=$row->satuan;?></td>
                <td><?=$row->safety;?></td>
                <td><?=ceil($row->safety + (0.1*$row->safety));?></td>
                <!-- <td>
                  <?php
                    $tiga = $this->M_workorder_detail->getCountSparepart($row->sparepartid)->total;
                    $tiga *= 3;
                    echo $tiga;
                  ?>    
                </td>
                <td>
                  <?php
                    $dua = $this->M_workorder_detail->getCountSparepart($row->sparepartid,"F")->total;
                    $dua *= 3;
                    echo $dua;
                  ?>    
                </td> -->
                <!-- <td>
                  <?php
                    $satu = $this->M_sparepart->getCountSparepart($row->sparepartid)->total;
                    $satu /= 2;
                    echo $satu;
                  ?>    
                </td>
                <td>
                  <?php
                    $fc = ($tiga+$dua+$satu)/6;
                    echo round($fc, 2);
                  ?>    
                </td> -->
                <td>
                  <a href="<?=site_url('Forecast/detail/'.$row->sparepartid);?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
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
<!-- /.content