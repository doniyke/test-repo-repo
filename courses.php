<?php 
  require_once 'header.php';
?>

  <main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <h2>Trainings & Courses</h2>
        <p>Growing your Business, Relationships, and in Leadership (personal and corporate). </p>
      </div>
    </div><!-- End Breadcrumbs -->

<div class="container mt-3">

    <?php
if(is_array($financeTrainings)){
?>
<div class="px-3 py-2 col-md-8 bg-firebrick section-head">
  <h5 class="text-white">Business</h5>
</div>
<section id="courses" class="courses">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row course-slide" data-aos="zoom-in" data-aos-delay="100">


          <?php
              foreach ($financeTrainings as $training) {
                $title = $training['title'];
                $category = $training['category'];
                $author = $training['author'];
                $price = $training['price'];
                $students = $training['students'];
                $image = $training['image'];
                $training_slug = $training['training_slug'];
                $created_at = $training['created_at'];
               $training_title = $training['title'];
               $short_description = $training['short_description'];
               if (is_array($myPurchases)) {

                 $key = array_search($training_slug, array_column($myPurchases, 'training_slug'));
                 if ((!empty($key) || $key === 0)) {
                    $paid = true;
                 }else{
                  $paid = false;
                 }
               }else{
                $paid = false;
               }
              
          ?>

          <div class="px-3 mb-4">
            <?php  if($paid || $price == 0): ?>
            <a href="i/take-course.php?training_slug=<?php echo $training_slug ?>">
             <?php  else : ?>
               <a href="course-details.php?training_slug=<?php echo $training_slug ?>">
            <?php  endif; ?>

            <div class="course-item">
              <img src="panel-admin/img/<?php echo $image ?>" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4><?php echo $category ?></h4>
                  <p class="price">
                    <?php echo $paid ? "paid" : "&#8358;". number_format($price, 2); ?>
                  </p>
                </div>

                <h3>
                  <?php  if($paid || $price == 0): ?>
                  <a href="i/take-course.php?training_slug=<?php echo $training_slug ?>"> <?=$title?></a></h3>
                   <?php  else : ?>
                     <a href="course-details.php?training_slug=<?php echo $training_slug ?>"><?=$title?></a></h3>
                  <?php  endif; ?>
                <p>
                  <?php echo limit_words($short_description, 20)?>
                </p>
                <div class="trainer d-flex justify-content-between align-items-center" >
                  <div class="trainer-profile d-flex align-items-center" >
                    <i class='bx bxs-graduation'></i>
                    <span><?=$author?></span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center" >
                    <i class='bx bxs-user'></i>&nbsp;<?=$students?>
                  </div>
                </div>
              </div>
            </div>
          </a>
          </div> <!-- End Course Item-->

          <?php
            }
          ?>

          

        </div>

      </div>
</section>
<?php
  }
?>


<?php
if(is_array($relationshipTrainings)){
?>
<div class="px-3 py-2 col-md-8 bg-firebrick section-head ">
  <h5 class="text-white">Relationship</h5>
</div>
<section id="courses" class="courses">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row course-slide" data-aos="zoom-in" data-aos-delay="100">


          <?php
              foreach ($relationshipTrainings as $training) {
                $title = $training['title'];
                $category = $training['category'];
                $author = $training['author'];
                $price = $training['price'];
                $students = $training['students'];
                $image = $training['image'];
                $training_slug = $training['training_slug'];
                $created_at = $training['created_at'];
               $training_title = $training['title'];
               $short_description = $training['short_description'];
               if (is_array($myPurchases)) {

                 $key = array_search($training_slug, array_column($myPurchases, 'training_slug'));
                 if ((!empty($key) || $key === 0)) {
                    $paid = true;
                 }else{
                  $paid = false;
                 }
               }

               else{
                  $paid = false;
                 }
              
          ?>

          <div class="px-3 mb-4">
            <?php  if($paid || $price == 0): ?>
            <a href="i/take-course.php?training_slug=<?php echo $training_slug ?>">
             <?php  else : ?>
               <a href="course-details.php?training_slug=<?php echo $training_slug ?>">
            <?php  endif; ?>

            <div class="course-item">
              <img src="panel-admin/img/<?php echo $image ?>" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4><?php echo $category ?></h4>
                  <p class="price">
                    <?php echo $paid ? "paid" : "&#8358;". number_format($price, 2); ?>
                  </p>
                </div>

                <h3>
                  <?php  if($paid || $price == 0): ?>
                  <a href="i/take-course.php?training_slug=<?php echo $training_slug ?>"> <?=$title?></a></h3>
                   <?php  else : ?>
                     <a href="course-details.php?training_slug=<?php echo $training_slug ?>"><?=$title?></a></h3>
                  <?php  endif; ?>
                <p>
                  <?php echo limit_words($short_description, 20) ?>
                </p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center" >
                    <i class='bx bxs-graduation'></i>
                    <span><?=$author?></span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                    <i class="fas fa-user"></i>&nbsp;<?=$students?>
                  </div>
                </div>
              </div>
            </div>
          </a>
          </div> <!-- End Course Item-->

          <?php
            }
          ?>

          

        </div>

      </div>
</section>
<?php
  }
?>




<?php
if(is_array($leadershipTrainings)){
?>
<div class="px-3 py-2 col-md-8 bg-firebrick section-head">
  <h5 class="text-white">Leadership</h5>
</div>
<section id="courses" class="courses">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row course-slide" data-aos="zoom-in" data-aos-delay="100">


          <?php
              foreach ($leadershipTrainings as $training) {
                $title = $training['title'];
                $category = $training['category'];
                $author = $training['author'];
                $price = $training['price'];
                $students = $training['students'];
                $image = $training['image'];
                $training_slug = $training['training_slug'];
                $created_at = $training['created_at'];
               $training_title = $training['title'];
               $short_description = $training['short_description'];

               if (is_array($myPurchases)) {

                 $key = array_search($training_slug, array_column($myPurchases, 'training_slug'));
                 if ((!empty($key) || $key === 0)) {
                    $paid = true;
                 }else{
                  $paid = false;
                 }
               }

               else{
                  $paid = false;
                }
               
              
          ?>

          <div class="px-3 mb-4">
            <?php  if($paid || $price == 0): ?>
            <a href="i/take-course.php?training_slug=<?php echo $training_slug ?>">
             <?php  else : ?>
               <a href="course-details.php?training_slug=<?php echo $training_slug ?>">
            <?php  endif; ?>

            <div class="course-item">
              <img src="panel-admin/img/<?php echo $image ?>" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4><?php echo $category ?></h4>
                  <p class="price">
                    <?php echo $paid ? "paid" : "&#8358;". number_format($price, 2); ?>
                  </p>
                </div>

                <h3>
                  <?php  if($paid || $price == 0): ?>
                  <a href="i/take-course.php?training_slug=<?php echo $training_slug ?>"> <?=$title?></a></h3>
                   <?php  else : ?>
                     <a href="course-details.php?training_slug=<?php echo $training_slug ?>"><?=$title?></a></h3>
                  <?php  endif; ?>
                <p>
                  <?php echo limit_words($short_description, 20) ?>
                </p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <i class='bx bxs-graduation'></i>
                    <span><?=$author?></span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                    <i class="fas fa-user"></i>&nbsp;<?=$students?>
                  </div>
                </div>
              </div>
            </div>
          </a>
          </div> <!-- End Course Item-->

          <?php
            }
          ?>

          

        </div>

      </div>
</section>
<?php
  }
?>





<?php
if(is_array($allTrainings)){
?>
<div class="px-3 py-2 col-md-8 bg-firebrick section-head ">
  <h5 class="text-white">Other Trainings</h5>
</div>
<section id="courses" class="courses">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row course-slide" data-aos="zoom-in" data-aos-delay="100">


          <?php
              foreach ($allTrainings as $training) {
                $title = $training['title'];
                $category = $training['category'];
                $author = $training['author'];
                $price = $training['price'];
                $students = $training['students'];
                $image = $training['image'];
                $training_slug = $training['training_slug'];
                $created_at = $training['created_at'];
               $training_title = $training['title'];
               $short_description = $training['short_description'];

               if (is_array($myPurchases)) {

                 $key = array_search($training_slug, array_column($myPurchases, 'training_slug'));
                 if ((!empty($key) || $key === 0)) {
                    $paid = true;
                 }else{
                  $paid = false;
                 }
               }

               else{
                  $paid = false;
                }
               
              
          ?>

          <div class="px-3 mb-4">
            <?php  if($paid || $price == 0): ?>
            <a href="i/take-course.php?training_slug=<?php echo $training_slug ?>">
             <?php  else : ?>
               <a href="course-details.php?training_slug=<?php echo $training_slug ?>">
            <?php  endif; ?>

            <div class="course-item">
              <img src="panel-admin/img/<?php echo $image ?>" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4><?php echo $category ?></h4>
                  <p class="price">
                    <?php echo $paid ? "paid" : "&#8358;". number_format($price, 2); ?>
                  </p>
                </div>

                <h3>
                  <?php  if($paid || $price == 0): ?>
                  <a href="i/take-course.php?training_slug=<?php echo $training_slug ?>"> <?=$title?></a></h3>
                   <?php  else : ?>
                     <a href="course-details.php?training_slug=<?php echo $training_slug ?>"><?=$title?></a></h3>
                  <?php  endif; ?>
                <p>
                  <?php echo limit_words($short_description, 20) ?>
                </p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <i class='bx bxs-graduation'></i>
                    <span><?=$author?></span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                    <i class="fas fa-user"></i>&nbsp;<?=$students?>
                  </div>
                </div>
              </div>
            </div>
          </a>
          </div> <!-- End Course Item-->

          <?php
            }
          ?>

          

        </div>

      </div>
</section>
<?php
  }
?>


  </main><!-- End #main -->
<?php
  require_once 'footer.php';
?>