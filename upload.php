<?php
 # ========================================================================#
   #
   #  Author:    Diwakar upadhyay
   #  Version:	 1.0
   #  Date:      12-Nov-13
   #  Purpose:   Resizes and saves image view
   #  Requires : Requires PHP5, GD library.
   #  Usage Example:
   #                     include("ImageResizeComponent.php");
   #                     Define Folder name in $image_array();
   #                     Read folder images by RecursiveDirectoryIterator()
   #                     if error occur then manage exaception
   #
   # ========================================================================#

       try {
        // *** Include the class
	include("ImageResizeComponent.php");
        ini_set('max_execution_time', 0); //300 seconds = 5 minutes
        $root = '/';  
        $fullpath = dirname(__FILE__);
        $target_directory='/images';
        $image_direct_path= $fullpath. $target_directory;

        //Define here Folder name and size in pixcel
        $image_array=array('560x420'=>array('560','420'),
                           '408x306'=>array('408','306'),
                           '272x204'=>array('272','204'),
                           '50x50'=>array('50','50'),
                           '55x55'=>array('55','55'),
                           '100x100'=>array('100','100'),
                           '110x110'=>array('110','110'),
                           '150x150'=>array('150','150'),
                           '652x489'=>array('652','489'));
        
        $ite = new RecursiveDirectoryIterator($image_direct_path);
	$bytestotal=0;
	$nbfiles=0;
	foreach (new RecursiveIteratorIterator($ite) as $filename=>$cur) {
                             $only_file=$cur->getFilename();
                             $image = $image_direct_path.'/'.$only_file; 
		             //image array irritate
	                     foreach($image_array as $key => $value){
                                  if(!is_dir($fullpath.'/'.$key)){
                                         $old_umask = umask(0);	 
			                 mkdir($fullpath.'/'.$key , 0777);
                                         umask($old_umask);
                                         $dir_path=   $fullpath .'/'.$key.'/'.$only_file; 
				  }else{
					 $dir_path=   $fullpath .'/'.$key.'/'.$only_file; 
				  }
                                   $img_resize=new ImageResizeComponent();
           			   $img_resize->resize($image, $value[0], $value[1],$dir_path);
			   }
               $nbfiles++;
	
	}
          header("Location: index.php?msg='sucess'");
     }
     catch (Exception $e)
	   {
              //Catch Exception 
	      throw new Exception( 'Something really gone wrong', 0, $e);
	   }
?>
