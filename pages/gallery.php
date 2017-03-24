<div class="content-wrapper con-gallery">
    <div class="col-md-11">
        <div>
            <div class="col-md-9 left-col-design">
                <h1>Gallery</h1>      
                <div id="galleria">
                    <?php
                    include 'classes/image.php';
                    
                    $gallery = new Image();                    
                    $gallery->gallery_thumb_directory = 'images/gallery/thumbs';
                    $gallery->gallery_orig_directory = 'images/gallery/original';                    
                    $gallery->gallery_display();
                    
                    ?>                    
                </div>                
                <?php include 'includes/enquiry_faq_section.php'?>
            </div>
            <div class="col-md-3 right-col-design"></div>
        </div>
    </div>    
</div>