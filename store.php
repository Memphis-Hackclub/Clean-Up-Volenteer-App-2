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

      if($file != "."){
        if($file != ".."){
          // Open a directory, and read its contents
          if (is_dir($dir2)){
            if ($dh2 = opendir($dir2)){
              while (($file2 = readdir($dh2)) !== false){
                if($file2 != "title.txt"){
                  if($file2 != "price.txt"){
                    if($file2 != "."){
                      if($file2 != ".."){
                        $image_dir = $dir2.$file2;
                        echo "<br>".$image_dir."<br><h1>Look above</h1>";
                      }

                    }
                  }
                }
              }
              closedir($dh2);
            }
          }
        }
      }
        

      
      
      
      


    }
    closedir($dh);
  }
}
?>