<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add New Collection</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item">Collections</li>
          <li class="breadcrumb-item active">Add New</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      
    </section>

  </main><!-- End #main -->

  <?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>