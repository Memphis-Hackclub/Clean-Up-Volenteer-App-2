<?php

$listing_status = "Please wait. Your listing is generating.";
$title = $_GET['title'];
$price = $_GET['price'];
$description = $_GET['description'];

$html_contents = 
<<<HTML
<html>
<head>
    <title>$title</title>
</head>
<body>
    <h1>$title</h1>
    <p>$price</p>
    <p>$description</p>
</body>
</html>
HTML;


$file_name = "listings/".str_replace(' ', '', $title).".html";
while (file_exists($file_name)) {
    $rand_num = rand(100000,999999);
    $file_name = "listings/".str_replace(' ', '', $title).$rand_num.".html";
}


$htmlfile = fopen($file_name, "w") or die("An error has occured");


fwrite($htmlfile, $html_contents);

$listing_status = "Congrats your listing is now live <a href='".$file_name."' target='_blank'>here</a>";

?>
<!DOCTYPE html>
<html>
<head>
<title>
Finalizing Your Listing...
</title>
</head>
<p><?php echo $listing_status;?></p>


</form>
</html>