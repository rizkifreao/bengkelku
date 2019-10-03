<?php 
$Z = 1.6;
$tanggal = date("Y-m-d", strtotime("-31 day"));
$no = 1;

// // PEMBELIAN
// $queryPembelian="SELECT
//         a.pembelianid,
//         a.tanggal,
//         a.tanggal_datang,
//         DATEDIFF(a.tanggal_datang,
//         a.tanggal) AS leadtime,
//         b.pembeliandetailid,
//         b.sparepartid
//         FROM
//         pembelian a
//         INNER JOIN pembelian_detail b ON b.pembelianid = a.pembelianid
//         WHERE b.sparepartid = $data->sparepartid
//         ORDER BY pembelianid DESC
//         LIMIT 8
// ";
// $rowPembelian = $this->db->query($queryPembelian)->result();

$queryLead = "SELECT
        a.waktu
        FROM
        mst_tipe_pelayanan AS a
        INNER JOIN mst_pelayanan AS b ON b.tipepelayananid = a.tipepelayananid
        INNER JOIN mst_pelayanan_detail AS c ON c.pelayananid = b.pelayananid
        INNER JOIN sparepart AS d ON c.sparepartid = d.sparepartid
        WHERE
        d.sparepartid = $data->sparepartid
      ";
$waktu = $this->db->query($queryLead)->row()->waktu;

$arrayJual = array();
 ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Forecast Detail  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url(''); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?=site_url('Forecast'); ?>"> Forecast </a></li>
    <li><a href=""> <?=$data->nama ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Pembelian
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="" class="example11 table table-bordered table-striped">
            <thead>
              <tr>
                <th>Leadtime</th>
                <th>Frekuensi (f)</th>
                <th>Deviasi (d)</th>
                <th>Deviasi Kuadrat (d<sup>2</sup>)</th>
                <th>f.d<sup>2</sup></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $totalLeadtime = 0;
              $totalFrekuensi = 0;
              $totalFxd = 0;

              for ($i = $waktu ; $i<= $waktu+3 ; $i++) :
                $queryJml = "SELECT
                        COUNT(leadtime) AS jml
                      FROM
                        (
                          SELECT
                            a.pembelianid,
                            a.tanggal,
                            a.tanggal_datang,
                            DATEDIFF(a.tanggal_datang, a.tanggal) AS leadtime,
                            b.pembeliandetailid,
                            b.sparepartid
                          FROM
                            pembelian a
                          INNER JOIN pembelian_detail b ON b.pembelianid = a.pembelianid
                          WHERE
                            b.sparepartid = $data->sparepartid
                          ORDER BY
                            pembelianid DESC
                          LIMIT 8
                        ) AS beli
                      WHERE
                        leadtime = $i
                      ";
                $frekuensiBeli = ($this->db->query($queryJml))?$this->db->query($queryJml)->row()->jml:0;
                $tableBeli[$i] = $frekuensiBeli;
                $totalLeadtime += ($i*$frekuensiBeli);
                $totalFrekuensi += $frekuensiBeli;
              endfor;
              // $rataLeadtime = $totalLeadtime/4;
              $rataLeadtime = round($totalLeadtime/8,2);

              // DRAW TABLE
              foreach ($tableBeli as $beli) :
                $frekuensiBeli = $beli;
                $deviasi = $rataLeadtime-$waktu;
                $dedev = pow($deviasi,2);
                $fxd = $frekuensiBeli*$dedev;
                $totalFxd += $fxd;
               ?>
              <tr>
                <td><?=$waktu++ ?></td>
                <td><?=$frekuensiBeli ?></td>
                <td><?=$deviasi ?></td>
                <td><?=round($dedev,2) ?></td>
                <td><?=round($fxd,2) ?></td>
              </tr>
              <?php
              endforeach;
               ?>
            </tbody>
          </table>
          <br>
          <table id="" class="example11 table table-bordered table-striped">
            <thead>
              <tr>
                <th>Jumlah Leadtime</th>
                <th>Rata-rata Leadtime (R)</th>
                <th>Total Frekuensi</th>
                <th>Total f.d<sup>2</sup></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?=$totalLeadtime ?></td>
                <td><?=$rataLeadtime ?></td>
                <td><?=$totalFrekuensi ?></td>
                <td><?=$totalFxd ?></td>
              </tr>
            </tbody>
          </table>
          <table id="" class="table table-bordered">
              <tr>
                <th>Standard Deviasi Rata-rata Leadtime</th>
                <th><?php
                  $sdR = 0;
                  if($totalFrekuensi>1){
                    $sdR = round(sqrt($totalFxd/($totalFrekuensi-1)),2);
                  }
                  echo $sdR;
                 ?></th>
              </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-xs-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Penjualan
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">              
              <table id="" class=" table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>F</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i=1; $i <= 10; $i++) :
                    $tanggal = date("Y-m-d", strtotime("1 day", strtotime($tanggal)));
                    $queryPenjualan="SELECT SUM(qty) as jumlah, sparepartid from(
                              SELECT
                                c.nama,
                                b.detailwoid,
                                b.sparepartid,
                                a.workorderid,
                                b.qty,
                                a.`status`,
                                d.penjualanid,
                                d.woid,
                                d.tanggal_faktur
                              FROM
                                sparepart AS c ,
                                workorder AS a
                              INNER JOIN workorder_detail AS b ON b.workorderid = a.workorderid
                              INNER JOIN penjualan AS d ON d.woid = a.workorderid
                              WHERE
                                b.sparepartid = c.sparepartid
                                AND b.sparepartid = $data->sparepartid
                                AND tanggal_faktur = '$tanggal'
                            ) as penjualan
                        ";
                    $rowPenjualan = $this->db->query($queryPenjualan)->row();
                    $frekuensiJual = ($rowPenjualan->jumlah)?$rowPenjualan->jumlah:0;
                    array_push($arrayJual, $frekuensiJual);
                   ?>
                  <tr>
                    <td><?=$no++ ?></td>
                    <td><?=date("d-m-Y", strtotime($tanggal)) ?></td>
                    <td><?=$frekuensiJual ?></td>
                  </tr>
                  <?php
                  endfor;
                   ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-4">
              <table id="" class=" table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>F</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i=11; $i <= 20; $i++) :
                    $tanggal = date("Y-m-d", strtotime("1 day", strtotime($tanggal)));
                    $queryPenjualan="SELECT SUM(qty) as jumlah, sparepartid from(
                              SELECT
                                c.nama,
                                b.detailwoid,
                                b.sparepartid,
                                a.workorderid,
                                b.qty,
                                a.`status`,
                                d.penjualanid,
                                d.woid,
                                d.tanggal_faktur
                              FROM
                                sparepart AS c ,
                                workorder AS a
                              INNER JOIN workorder_detail AS b ON b.workorderid = a.workorderid
                              INNER JOIN penjualan AS d ON d.woid = a.workorderid
                              WHERE
                                b.sparepartid = c.sparepartid
                                AND b.sparepartid = $data->sparepartid
                                AND tanggal_faktur = '$tanggal'
                            ) as penjualan
                        ";
                    $rowPenjualan = $this->db->query($queryPenjualan)->row();
                    $frekuensiJual = ($rowPenjualan->jumlah)?$rowPenjualan->jumlah:0;
                    array_push($arrayJual, $frekuensiJual);
                   ?>
                  <tr>
                    <td><?=$no++ ?></td>
                    <td><?=date("d-m-Y", strtotime($tanggal)) ?></td>
                    <td><?=$frekuensiJual ?></td>
                  </tr>
                  <?php
                  endfor;
                   ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-4">
              <table id="" class=" table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>F</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i=21; $i <= 30; $i++) :
                    $tanggal = date("Y-m-d", strtotime("1 day", strtotime($tanggal)));
                    $queryPenjualan="SELECT SUM(qty) as jumlah, sparepartid from(
                              SELECT
                                c.nama,
                                b.detailwoid,
                                b.sparepartid,
                                a.workorderid,
                                b.qty,
                                a.`status`,
                                d.penjualanid,
                                d.woid,
                                d.tanggal_faktur
                              FROM
                                sparepart AS c ,
                                workorder AS a
                              INNER JOIN workorder_detail AS b ON b.workorderid = a.workorderid
                              INNER JOIN penjualan AS d ON d.woid = a.workorderid
                              WHERE
                                b.sparepartid = c.sparepartid
                                AND b.sparepartid = $data->sparepartid
                                AND tanggal_faktur = '$tanggal'
                            ) as penjualan
                        ";
                    $rowPenjualan = $this->db->query($queryPenjualan)->row();
                    $frekuensiJual = ($rowPenjualan->jumlah)?$rowPenjualan->jumlah:0;
                    array_push($arrayJual, $frekuensiJual);
                   ?>
                  <tr>
                    <td><?=$no++ ?></td>
                    <td><?=date("d-m-Y", strtotime($tanggal)) ?></td>
                    <td><?=$frekuensiJual ?></td>
                  </tr>
                  <?php
                  endfor;
                   ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
              
              <table id="" class="example11 table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Daily Sales</th>
                    <th>Frekuensi (f)</th>
                    <th>Deviasi (d)</th>
                    <th>Deviasi Kuadrat (d<sup>2</sup>)</th>
                    <th>f.d<sup>2</sup></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $countJual = 0;
                  $totalPenjualan = 0;
                  $totalPengamatan = 26;
                  $totalFxdJual = 0;
                  $rataPenjualan = 0;
                  // var_dump($arrayJual);
                  // var_dump(array_unique($arrayJual));
                  // var_dump(array_count_values(($arrayJual)));
                  $arrayCountJual = array_count_values(($arrayJual));
                  foreach ($arrayCountJual as $key => $value) :
                    if($key != 0):
                      $totalPenjualan += ($key*$value);
                      $countJual++;
                    endif;
                  endforeach;
                  if($totalPenjualan != 0 && $countJual != 0)
                    // $rataPenjualan = $totalPenjualan/$countJual;
                    $rataPenjualan = round($totalPenjualan/26,2);
                  
                  foreach ($arrayCountJual as $key => $value) :
                    if($key != 0):
                      $deviasiJual = $rataPenjualan-$key;
                      $dedevJual = pow($deviasiJual,2);
                      $fxdJual = $value*$dedevJual;
                      $totalFxdJual += $fxdJual;
                     ?>
                    <tr>
                      <td><?=$key ?></td>
                      <td><?=$value ?></td>
                      <td><?=$deviasiJual ?></td>
                      <td><?=round($dedevJual,2) ?></td>
                      <td><?=round($fxdJual,2) ?></td>
                    </tr>
                    <?php
                    endif;
                  endforeach;
                   ?>
                </tbody>
              </table>
              <br>
              <table id="" class="example11 table table-bordered table-striped" >
                <thead>
                  <tr>
                    <th>Jumlah Penjualan</th>
                    <th>Rata-rata Penjualan (S)</th>
                    <th>Total Pengamatan</th>
                    <th>Total f.d<sup>2</sup></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?=$totalPenjualan ?></td>
                    <td><?=$rataPenjualan ?></td>
                    <td><?=$totalPengamatan ?></td>
                    <td><?=round($totalFxdJual,2) ?></td>
                  </tr>
                </tbody>
              </table>
              <table id="" class="table table-bordered">
                  <tr>
                    <th>Standard Deviasi Rata-rata Penjualan</th>
                    <th><?php
                      $sdS = round(sqrt($totalFxdJual/($totalPengamatan-1)),2);
                      echo $sdS;
                     ?></th>
                  </tr>
              </table>
            </div>
          </div> 
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <?php
      $SS = $Z * sqrt(($rataLeadtime*pow($sdS,2))+(pow($rataPenjualan,2)*pow($sdR,2)));
      $SSbulat = ceil($SS);
    ?>
    <!-- /.col -->
    <div class="col-xs-12"> 
      <div class="box box-solid box-info">
        <div class="box-header">
          <h3 class="box-title">
            <?=$data->nama ?>
          </h3>
        </div>
        <div class="box-body">
          <div class="row form-horizontal">
            <?php if($data->stokakhir < $SSbulat):?>
              <div class="col-md-12">
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                    Stock telah melewati batas Safety Stock
                  </div>
              </div>
            <?php endif;?>
            <div class="col-md-4">            
              <div class="form-group">
                <label for="nama" class="col-sm-4 control-label">Stock Akhir</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="<?=$data->stokakhir?>" disabled="">
                </div>
              </div>         
            </div> 
            <div class="col-md-4">            
              <div class="form-group">
                <label for="nama" class="col-sm-4 control-label">SAFETY STOCK</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="<?=round($SS,2)." ~ ".$SSbulat?>" disabled="">
                </div>
              </div>         
            </div> 
            <div class="col-md-4">            
              <div class="form-group">
                <label for="nama" class="col-sm-4 control-label">Yang harus dibeli</label>
                <div class="col-sm-8">
                  <?php
                    $harus = $SSbulat + (0.1*$SSbulat);
                  ?>
                  <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="<?=ceil($harus)?>" disabled="">
                </div>
              </div>         
            </div>         
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->