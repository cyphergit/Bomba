<?php
$info = new Settings();
//Initiate database connection
include 'config/dbase_init.php';
$fields = $crud->article_fetch($_GET['aid']);
?>
<div class="content-wrapper con-about">
    <div class="col-md-11">
        <div>
            <div class="col-md-9 left-col-design">
                <?php
                if ($fields['Status'] == 1) {
                    ?>
                    <h1><?php echo $fields['ArticleTitle']; ?></h1>
                    <?php echo $fields['ArticleContent']; ?>
                    <?php
                } else {
                    ?>
                    <h1>Oops!!!</h1>
                    <p>Sorry but the page that you're looking for is no longer available.</p>
                    <?php
                }
                ?>
                <?php include 'includes/enquiry_faq_section.php'; ?>
            </div>
            <div class="col-md-3 right-col-design"></div>
        </div>  
    </div>    
</div>
