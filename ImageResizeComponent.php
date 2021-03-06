<?php
   # ========================================================================#
   #
   #  Author:    Diwakar upadhyay
   #  Version:	 1.0
   #  Date:      12-Nov-13
   #  Purpose:   Resizes and saves image
   #  Requires : Requires PHP5, GD library.
   #  Usage Example:
   #                     include("ImageResizeComponent.php");
   #                     $Obj -> resize(150, 100, 0);
   #                     
   #
   # ========================================================================#
class ImageResizeComponent{

    function setTransparency($new_image, $image_source) {
        $transparencyIndex = imagecolortransparent($image_source);
        $transparencyColor = array('red' => 255, 'green' => 255, 'blue' => 255);
        if ($transparencyIndex >= 0) {
            $transparencyColor = imagecolorsforindex($image_source, $transparencyIndex);
        }
        $transparencyIndex = imagecolorallocate($new_image, $transparencyColor['red'], $transparencyColor['green'], $transparencyColor['blue']);
        imagefill($new_image, 0, 0, $transparencyIndex);
        imagecolortransparent($new_image, $transparencyIndex);
    }

    // Resize any specified jpeg, gif, or png image 
    function resize($imagePath, $destinationWidth, $destinationHeight, $destinationPath) {

        // The file has to exist to be resized 
	//list($source_image_width, $source_image_height, $source_image_type) = getimagesize($imagePath);
          if (file_exists($imagePath)) {
            // Gather some info about the image
              
            $imageInfo = getimagesize($imagePath);
            
            // Find the intial size of the image 
            $sourceWidth = $imageInfo[0];
            $sourceHeight = $imageInfo[1];
 	    $source_aspect_ratio =   $sourceWidth / $sourceHeight;
		    $thumbnail_aspect_ratio = $destinationWidth/ $destinationHeight;
		
                    if ( $sourceWidth  <= $destinationWidth && $sourceHeight <= $destinationHeight) { 
			$thumbnail_image_width = $sourceWidth;
			$thumbnail_image_height = $sourceHeight;
		    } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
			$thumbnail_image_width = (int) ($destinationHeight * $source_aspect_ratio);
			$thumbnail_image_height = $destinationHeight;
		    } else {
			$thumbnail_image_width = $destinationWidth;
			$thumbnail_image_height = (int) ($destinationWidth / $source_aspect_ratio);
		    }
            // Find the mime type of the image 
            $mimeType = $imageInfo['mime'];

            // Create the destination for the new image 
            $destinationWidth=$thumbnail_image_width;
            $destinationHeight=$thumbnail_image_height;
            $destination = imagecreatetruecolor($destinationWidth, $destinationHeight);
            // Now determine what kind of image it is and resize it appropriately 
            if ($mimeType == 'image/jpeg' || $mimeType == 'image/pjpeg') {

                $source = imagecreatefromjpeg($imagePath);
                $this->setTransparency($destination, $source);
                imagecopyresampled($destination, $source, 0, 0, 0, 0, $destinationWidth, $destinationHeight, $sourceWidth, $sourceHeight);
                $destinationPath =$destinationPath;
                imagejpeg($destination, $destinationPath);
            } else if ($mimeType == 'image/gif') {
                $source = imagecreatefromgif($imagePath);
                $this->setTransparency($destination, $source);
                imagecopyresampled($destination, $source, 0, 0, 0, 0, $destinationWidth, $destinationHeight, $sourceWidth, $sourceHeight);
                $destinationPath =$destinationPath;
                imagegif($destination, $destinationPath);
            } else if ($mimeType == 'image/png' || $mimeType == 'image/x-png') { 
                $source = imagecreatefrompng($imagePath);
               //$this->setTransparency($destination, $source);
                imagecopyresampled($destination, $source, 0, 0, 0, 0, $destinationWidth, $destinationHeight, $sourceWidth, $sourceHeight);
                $destinationPath =$destinationPath;
                imagepng($destination, $destinationPath);
            } else {
                $this->_error('This image type is not supported.');
            }
        } else {
            $this->_error('The requested file does not exist.');
        }
 }
    // Outputs errors... 
    function _error($message) {
        trigger_error('The file could not be resized for the following reason: ' . $message);
    }

}

?>
