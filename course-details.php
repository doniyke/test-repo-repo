<?php
  require_once 'header.php';

  if (isset($_GET['training_slug']) && !empty($_GET['training_slug'])) {
      $training_slug = $_GET['training_slug'];

         $getSingleTraining = $fetchData->fetchBySlug($training_slug);
         if (is_array($getSingleTraining)) {
           foreach ($getSingleTraining as $training) {
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
              $full_description = $training['full_description'];
            }
          }

          $getFreeResources = $fetchData->fetchFreeResourcesBySlug($training_slug);


          if (is_array($myPurchases)) {

             $key = array_search($training_slug, array_column($myPurchases, 'training_slug'));
             if ((!empty($key) || $key === 0)) {
                $paid = true;
             }else{
              $paid = false;
               $needCookie = true;
             }
           }

           else{
              $paid = false;
               $needCookie = true;
            }

          
       

  }else{
    echo 

    '
      <script>
        window.location = "courses.php"
      </script>
    '

    ;
    die();
  }
?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2><?php echo $title ?></h2>
        <p><?php echo nl2br($short_description) ?> </p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-8">
            <img src="panel-admin/img/<?php echo $image ?>" class="img-fluid" alt="">
            <h3><?php echo $title ?></h3>
            <p>
              <?php echo nl2br($full_description) ?>
            </p>
          </div>
          <div class="col-lg-4">

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Author</h5>
              <p><a href="#"><?php echo $author ?></a></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Training Fee</h5>
              <p>&#8358;<?php echo number_format($price) ?></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Category</h5>
              <p><?php echo $category ?></p>
            </div>


            <?php if (is_array($getFreeResources)) : ?>
              <div class="mb-3">
                <button class="btn btn-success rounded-curve  btn-block font-weight-bold" onclick="triggerNav()" data-toggle="modal" data-target="#modalFreeResource"><<<< Get Free Reources >>> </button>
              </div>
            <?php endif; ?>
              
                
          
            
            <?php if(!empty($email)) :  ?>
            <div>
              <?php if($paid || $price == 0) :  ?>
               
               <a href="i/take-course.php?training_slug=<?php echo $training_slug ?>" class="btn btn-firebrick btn-block">Take This Training</a>
              <?php else: ?>
                <button class="btn btn-firebrick btn-block" onclick="makePayment('<?php echo $email ?>', '<?php echo $price ?>', '<?php echo $name ?>','<?php echo $phone ?>','<?php echo $training_slug ?>')">Take Full Training</button>
              <?php endif; ?>
            </div>
            <?php else: ?>
              <div>
              
               <button data-toggle="modal" data-target="#modalLogin" onclick="triggerNav()" class="btn btn-firebrick btn-block">Take Full Training</button>
              
            </div>
            <?php endif; ?>
          </div>
        </div>

      </div>
    </section><!-- End Cource Details Section -->

  </main><!-- End #main -->

 <?php
 require_once 'footer.php';
 if ($needCookie):            
 
 ?>
 <script>
  
  setCookie("training_slug", '<?php echo $training_slug ?>', 365);

</script>';

<?php
endif;
?>


