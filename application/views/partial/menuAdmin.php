<?php
    $iduser = $this->session->userdata("id");
    $user = $this->M_user->getDetail($iduser);
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  <li class="<?=($this->uri->segment(1) == 'TugasAkhir')?'active':''?>"><a href="<?=site_url('Welcome/da
shboard')?>"><i class="fa fa-home"></i> Dashboard</a></li>

  <li class="treeview <?=($this->uri->segment(1) == 'Feedback'
    || $this->uri->segment(1) == 'Jenis'
    || $this->uri->segment(1) == 'Kategori'
    || $this->uri->segment(1) == 'Merk'
    || $this->uri->segment(1) == 'Satuan'
    || $this->uri->segment(1) == 'Sparepart'
    || $this->uri->segment(1) == 'Pelayanan'
    || $this->uri->segment(1) == 'TipePelayanan'
    || $this->uri->segment(1) == 'User')?'active':''?>">
    <a href="#">
      <i class="fa fa-gear"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li class="<?=($this->uri->segment(1) == 'Feedback')?'active':''?>"><a href="<?=site_url('Feedback')?>">Feedback</a></li>
      <li class="<?=($this->uri->segment(1) == 'Jenis')?'active':''?>"><a href="<?=site_url('Jenis')?>">Jenis</a></li>
      <li class="<?=($this->uri->segment(1) == 'Kategori')?'active':''?>"><a href="<?=site_url('Kategori')?>">Kategori</a></li>
      <li class="<?=($this->uri->segment(1) == 'Merk')?'active':''?>"><a href="<?=site_url('Merk')?>">Merk</a></li>
      <li class="<?=($this->uri->segment(1) == 'Satuan')?'active':''?>"><a href="<?=site_url('Satuan')?>">Satuan</a></li>
      <li class="<?=($this->uri->segment(1) == 'Sparepart')?'active':''?>"><a href="<?=site_url('Sparepart')?>">Spare Part</a></li>
      <li class="<?=($this->uri->segment(1) == 'TipePelayanan')?'active':''?>"><a href="<?=site_url('TipePelayanan')?>">Tipe Pelayanan</a></li>
      <li class="<?=($this->uri->segment(1) == 'Pelayanan')?'active':''?>"><a href="<?=site_url('Pelayanan')?>">Pelayanan</a></li>
      <li class="<?=($this->uri->segment(1) == 'User')?'active':''?>"><a href="<?=site_url('User')?>">User</a></li>
    </ul>
  </li>
  <li class="<?=($this->uri->segment(1) == 'PembelianSparepart')?'active':''?>"><a href="<?=site_url('PembelianSparepart')?>"><i class="fa fa-list"></i> Pembelian Spare Part</a></li>
  <li class="<?=($this->uri->segment(1) == 'Pelanggan')?'active':''?>"><a href="<?=site_url('Pelanggan')?>"><i class="fa fa-list"></i> Pelanggan</a></li>
  <li class="<?=($this->uri->segment(1) == 'Workorder')?'active':''?>"><a href="<?=site_url('Workorder')?>"><i class="fa fa-list"></i> Work Order</a></li>
  <li class="<?=($this->uri->segment(1) == 'Faktur')?'active':''?>"><a href="<?=site_url('Faktur')?>"><i class="fa fa-list"></i> Faktur</a></li>
  <li class="<?=($this->uri->segment(1) == 'Forecast')?'active':''?>"><a href="<?=site_url('Forecast')?>"><i class="fa fa-magic"></i> Forecast</a></li>
</ul>