<?php

class Image {

    var $image;
    var $image_type;
    public $gallery_thumb_directory;
    public $gallery_orig_directory;

    function load($filename) {

        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {

            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {

            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {

            $this->image = imagecreatefrompng($filename);
        }
    }

    function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null) {

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {

            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {

            imagepng($this->image, $filename);
        }
        if ($permissions != null) {

            chmod($filename, $permissions);
        }
    }

    function output($image_type = IMAGETYPE_JPEG) {

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image);
        } elseif ($image_type == IMAGETYPE_GIF) {

            imagegif($this->image);
        } elseif ($image_type == IMAGETYPE_PNG) {

            imagepng($this->image);
        }
    }

    function getWidth() {

        return imagesx($this->image);
    }

    function getHeight() {

        return imagesy($this->image);
    }

    function resizeToHeight($height) {

        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    function resizeToWidth($width) {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }

    function scale($scale) {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    function resize($width, $height) {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }

    private function fetch_image_files($handle) {
        $allowed_types = array('jpg', 'jpeg', 'gif', 'png');
        $file_parts = array();
        $ext = '';
        $title = '';

        $i = 1;
        while ($file = readdir($handle)) {
            /* Skipping the system files: */
            if ($file == '.' || $file == '..')
                continue;

            $file_parts = explode('.', $file);
            $ext = strtolower(array_pop($file_parts));

            /* Using the file name (withouth the extension) as a image title: */
            $title = implode('.', $file_parts);
            $title = htmlspecialchars($title);

            /* If the file extension is allowed: */
            if (in_array($ext, $allowed_types)) {
                echo "<a href='$this->gallery_orig_directory/$file'>";
                echo "<img id='image-" . ($i++) . "' src='$this->gallery_thumb_directory/$file', data-big='$this->gallery_orig_directory/$file', data-title='$title', data-description='$title'/>";
                echo"</a>";
            }
        }
    }

    public function gallery_display() {        
        $dir_handle = @opendir($this->gallery_thumb_directory) or die("There is an error with your image directory!");
        $this->fetch_image_files($dir_handle, $this->gallery_orig_directory, $this->gallery_thumb_directory);

        /* Closing the directory */
        closedir($dir_handle);
    }

}
