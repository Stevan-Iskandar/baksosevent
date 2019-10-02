<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
      <i class="fas fa-hand-holding-heart"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Panitia BAKSOS</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    <?= $admin["nama"]; ?>
  </div>

  <?php foreach ($menu as $m) : ?>
    <!-- Loop Menu -->
    <?php if ($menu_ == $m["menu"]) : ?>
      <li class="nav-item active">
      <?php else : ?>
      <li class="nav-item">
      <?php endif; ?>
      <a class="nav-link pb-0" href="<?= base_url($m["url"]); ?>">
        <i class="<?= $m["icon"]; ?>"></i>
        <span><?= $m["menu"]; ?></span>
      </a>
      </li>
    <?php endforeach; ?>

    <!-- Divider -->
    <hr class="sidebar-divider mt-3">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->