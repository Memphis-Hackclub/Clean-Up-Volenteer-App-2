<!DOCTYPE html>
<html>
<head>
<title>
Make an Event
</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  
<a href="makeevent.html">Post a Clean Up</a><br>
<form action="search.php" method="post" enctype="multipart/form-data">
<label>Find Things Faster<input type="text" maxlength="200" name="search"><br></label>

<input type="submit" name="submit" value="search">

</form>
<center>
  <h1>Want to help the earth?
  </h1>
  <p>Uncollected trash damages enviroment and causes serious harm the health of animals and humans. Host a clean up event or join an event today to help saving our plant! Participaite in a clean up below</p>
  <h1>Featured Events</h1>
</center>
<?php

$dir = "listings/";



// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      
      //echo "filename:" . $file . "<br>";
      $link = $dir.$file;
      $file = str_replace('.html', '', $file);
      $dir2 = "listingimages/listings/".$file."/";
      //echo "<br>".$dir2."</br>";

      $title_file_name = $dir2."title.txt";
      $info_file_name = $dir2."info.txt";
  



      if($file != "."){
        if($file != ".."){
          
          $title_file = fopen($title_file_name , "r") or die("Hmm thats messed up");
          $title = fgets($title_file);
          fclose($title_file);
          $info_file = fopen($info_file_name , "r") or die("Hmm thats messed up");
          $info = fgets($info_file);
          fclose($info_file);

        }
      }

      if($file != "."){
        if($file != ".."){
          // Open a directory, and read its contents
          if (is_dir($dir2)){
            if ($dh2 = opendir($dir2)){
              while (($file2 = readdir($dh2)) !== false){
                if($file2 != "title.txt"){
                  if($file2 != "info.txt"){
                    if($file2 != "."){
                      if($file2 != ".."){
                        $image_dir = $dir2.$file2;
                        
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
        
    if($file != "."){
      if($file != ".."){
      $html_contents = 
      <<<HTML

          <h1><a href="$link">$title</a></h1>
          <p>$info</p>
          
          <hr>
          

          HTML;
      echo $html_contents;
    }
  }
      


    }
    closedir($dh);
  }
}
?>


