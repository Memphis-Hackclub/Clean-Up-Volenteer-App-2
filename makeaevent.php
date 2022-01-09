 <?php



$listing_status = "Please wait. Your listing is generating.";
$title = $_POST['title'];
$vol = $_POST['volenteers'];
$description = $_POST['description'];
$date = $_POST['date'];
$contact = $_POST['contact'];
$country = $_POST['country'];
$state = $_POST['state'];
$address = $_POST['address'];
$map = $_POST['map'];
$loc = $_POST['loc'];


function makeFileName() {
    $file_name = "listings/".str_replace(' ', '', $title).".html";
    while (file_exists($file_name)) {
        $rand_num = rand(100000,999999);
        $file_name = "listings/".str_replace(' ', '', $title).$rand_num.".html";
    }
    return $file_name;

}





$file_path = "listings/".str_replace(' ', '', $title);

$file_name = $file_path.".html";
while (file_exists($file_name)) {
    $rand_num = rand(100000,999999);
    $file_path = "listings/".str_replace(' ', '', $title).$rand_num;
    $file_name = $file_path.".html";
}


$structure = './listingimages/'.$file_path;



if (!mkdir($structure, 0777, true)) {
    die('An unsual error has occured :{');
}

$structure = $structure."/";


$html_contents = 
<<<HTML
<html>
<head>
    <title>$title</title>
</head>
<body>
    <h1>$title</h1>
   
    <p>$vol</p>
    <p>$description</p>
    
</body>
</html>
HTML;

$htmlfile = fopen($file_name, "w") or die("An error has occured :<");


fwrite($htmlfile, $html_contents);

$title_file_name = $structure."/title.txt";
$info_file_name = $structure."/info.txt";

$title_file= fopen($title_file_name, "w") or die("An error has occured ;}");
$info_file= fopen($info_file_name, "w") or die("An error has occured");
$info = $date+" "+$address+" "+$state+" "+$country;

fwrite($title_file, $title);
fwrite($info_file, $info);


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
<a href="index.php">Go to Store</a>

</form>
</html>