<?php

$dir = "listings/";



// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      
      echo "filename:" . $file . "<br>";
      
      $file = str_replace('.html', '', $file);
      $dir2 = "listingimages/listings/".$file."/";
      //echo "<br>".$dir2."</br>";

      $title_file_name = $dir2."title.txt";
      $price_file_name = $dir2."price.txt";
  



      if($file != "."){
        if($file != ".."){
          
          $title_file = fopen($title_file_name , "r") or die("Hmm thats messed up");
          $title = fgets($title_file);
          fclose($title_file);
          $price_file = fopen($price_file_name , "r") or die("Hmm thats messed up");
          $price = fgets($price_file);
          fclose($price_file);

        }
      }
      
        
      
      
      


    }
    closedir($dh);
  }
}
?>