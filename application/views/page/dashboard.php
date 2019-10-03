<?php
    $iduser = $this->session->userdata("id");
    $bulanSebelum = date("Y-m", strtotime("-1 month"));
?>

<style>
  .batasbawah{
    height: 400px !important;
  }
</style>

<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>


<section class="content">
  <div class="row">
    <div class="col-md-6">
      <!-- LINE CHART -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Total Hasil Penjualan Tahun 2018</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body chart-responsive">
          <div class="chart" id="line-chart" style="height: 300px;"></div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

      <!-- DONUT CHART -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Top 5 Sparepart Bulan  <?=date("F", strtotime($bulanSebelum))?></h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body chart-responsive">
          <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
  
    </div><!-- /.col (LEFT) -->
    <div class="col-md-6">

      <!-- BAR CHART -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Total Layanan Tahun 2018</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body chart-responsive">
          <div class="chart" id="bar-chart" style="height: 300px;"></div>
          <div id="legend" class="bars-legend"></div>
        </div>
      </div>
      <!-- AREA CHART -->
      <!-- <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Total Layanan dan Batal</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body chart-responsive">
          <div class="chart" id="revenue-chart" style="height: 300px;"></div>
        </div>
      </div> -->

      <!-- DONUT CHART -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Top 5 Jenis Mobil Bulan <?=date("F", strtotime($bulanSebelum))?></h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body chart-responsive">
          <div class="chart" id="sales-chart2" style="height: 300px; position: relative;"></div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div><!-- /.col (RIGHT) -->
  </div><!-- /.row -->
</section>

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?=base_url('extras/');?>plugins/morris/morris.min.js" type="text/javascript"></script>

    <script type="text/javascript">
      $(function () {
        "use strict";
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // PENJUALAN
        var line = new Morris.Line({
          element: 'line-chart',
          resize: true,
          data: [
            <?php 
            // $query = $this->db->query("SELECT DISTINCT(w.sparepartid) AS sparepartid, s.nama FROM workorder_detail w, sparepart s WHERE s.sparepartid = w.sparepartid");
            // $rowTanggal = $query->result();

            for ($i=1;$i<=12;$i++) :
              if($i<10)
                $i = "0".$i;
              $bulan = "2018-".$i;
              $query = $this->db->query("SELECT SUM(total) as jml FROM `penjualan` WHERE tanggal_faktur LIKE '".$bulan."-%'");
              $jml = $query->row()->jml;
            ?>
            {y: '<?=$bulan?>', item1: <?=($jml)?$jml:'0'?>},
            <?php
            endfor;
            ?>
          ],
          xkey: 'y',
          ykeys: ['item1'],
          labels: ['Item 1'],
          lineColors: ['#3c8dbc'],
          hideHover: 'auto',
          xLabelAngle: '70',
          xLabelFormat: function (x) { return months[x.getMonth()]; }
        });

        //5 SPAREPART
        var donut = new Morris.Donut({
          element: 'sales-chart',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a"],
          data: [
            <?php 
            $rawquerySparepart = "SELECT
                                    s.nama,
                                    wo.`status`,
                                    wo.nomor,
                                    s.sparepartid,
                                    wod.qty,
                                    Sum(wod.qty) AS total,
                                    wo.tanggal_keluar
                                  FROM
                                    workorder AS wo
                                  INNER JOIN workorder_detail AS wod ON wod.workorderid = wo.workorderid
                                  INNER JOIN sparepart AS s ON wod.sparepartid = s.sparepartid
                                  WHERE
                                    wo.`status` = 'F'
                                  AND wo.tanggal_keluar BETWEEN CAST('".date("Y-m", strtotime($bulanSebelum))."-01' AS DATE)
                                  AND CAST('".date("Y-m-t", strtotime($bulanSebelum))."' AS DATE) 
                                  GROUP BY
                                    s.sparepartid
                                  ORDER BY
                                    total DESC
                                  LIMIT 5";
            $querySparepart = $this->db->query($rawquerySparepart);
            $rowSparepart = $querySparepart->result();
            
            $sumSparepart = $this->db->query("SELECT SUM(total) as sum FROM ($rawquerySparepart) as sparepart")->row()->sum;

            foreach ($rowSparepart as $row) :
            ?>
            {label: "<?=$row->nama?>", value: <?=round((($row->total)/$sumSparepart)*100,2)?>},
            <?php
            endforeach;
            ?>
          ],
          hideHover: 'auto'
        });

        //5 JENIS
        var donut = new Morris.Donut({
          element: 'sales-chart2',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a"],
          data: [
            <?php 
            $rawqueryJenis = "SELECT
                          wo.nomor,
                          wo.`status`,
                          wo.tanggal_keluar,
                          j.nama,
                          COUNT(p.jenisid) AS total
                        FROM
                          mst_jenis AS j
                        INNER JOIN pelanggan AS p ON p.jenisid = j.jenisid
                        INNER JOIN workorder AS wo ON wo.pelangganid = p.pelangganid
                        WHERE
                          wo.`status` = 'F'
                        AND wo.tanggal_keluar BETWEEN CAST('".date("Y-m", strtotime($bulanSebelum))."-01' AS DATE)
                        AND CAST('".date("Y-m-t", strtotime($bulanSebelum))."' AS DATE) 
                        GROUP BY
                          j.jenisid
                        ORDER BY
                          total DESC
                        LIMIT 5";
            $queryJenis = $this->db->query($rawqueryJenis);
            $rowJenis = $queryJenis->result();

            $sumjenis = $this->db->query("SELECT SUM(total) as sum FROM ($rawqueryJenis) as sparepart")->row()->sum;

            foreach ($rowJenis as $row) :
            ?>
            {label: "<?=$row->nama?>", value: <?=round((($row->total)/$sumjenis)*100,2)?>},
            <?php
            endforeach;
            ?>
          ],
          hideHover: 'auto'
        });

        //LAYANAN
        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: [
            <?php 
            // $query = $this->db->query("SELECT DISTINCT(w.sparepartid) AS sparepartid, s.nama FROM workorder_detail w, sparepart s WHERE s.sparepartid = w.sparepartid");
            // $rowTanggal = $query->result();

            for ($i=1;$i<=12;$i++) :
              if($i<10)
                $i = "0".$i;
              $bulan = "2018-".$i;
              $queryA = $this->db->query("SELECT COUNT(workorderid) as jml FROM `workorder` WHERE tanggal_masuk LIKE '".$bulan."-%'");
              $jmlA = $queryA->row()->jml;
              $queryB = $this->db->query("SELECT COUNT(workorderid) as jml FROM `workorder` WHERE tanggal_masuk LIKE '".$bulan."-%' AND status = 'NF'");
              $jmlB = $queryB->row()->jml;
            ?>
            {y: '<?=date("M", strtotime($bulan))?>', a: <?=($jmlA)?$jmlA:'0'?>, b: <?=($jmlB)?$jmlB:'0'?>},
            <?php
            endfor;
            ?>
          ],
          barColors: ['#00a65a', '#f56954'],
          xkey: 'y',
          ykeys: ['a', 'b'],
          labels: ['Total Layanan', 'Transaksi Batal'],
          xLabelAngle: '70',
          hideHover: 'auto'
        });

        bar.options.labels.forEach(function(label, i) {
          var legendItem = $('<span style="margin-left:50px"></span>').text( label).prepend('<span>&nbsp;</span>');
          legendItem.find('span')
            .css('backgroundColor', bar.options.barColors[i])
            .css('width', '20px')
            .css('display', 'inline-block')
            .css('margin', '5px');
          $('#legend').append(legendItem)
        });
      });
    </script>