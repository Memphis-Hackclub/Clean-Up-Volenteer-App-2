<!DOCTYPE html>
<html>
<head>
<title>
Make an Event
</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <center>
  <br>
<form action="/add" method="POST"><br>
<h1>Make a Clean Up Event</h1><br>
<label>Event Title<br><input maxlength="200" id="title" name="title"><br></label>
<label>Event Description<br> <textarea maxlength="500" id="description" name="description" rows="4" cols="50"></textarea><br></label>
<label>How many volenteers?<br><input type="text" maxlength="200" id ="volenteers" name="volenteers"><br></label>
 <label>Date and Time<br><input type="text" maxlength="200" id="date" name="date"><br></label>
 <label>Contact Info<br><input type="text" maxlength="200" id="contact" name="contact"><br></label>

 <h1>Event Location Details</h1>
 <label>Country<br><input type="text" maxlength="200" id="country" name="country"></label><br>
 <label>State/Providence/Territory<br><input type="text" maxlength="200" id="state" name="state"></label><br>
 <label>Event Address<br><input type="text" maxlength="200" id="address"name="address"></label><br>
 <p>Or use your location</p>
   <input id="map" type="checkbox"  name="map" value="true" checked>
   <label for="map">Use my location, I am at the clean up site.</label><br><br>
   <br><label>Your location only used if you consent above</label><br>
   <textarea maxlength="500" id="loc" name="loc" rows="1" cols="50">Not Given</textarea><br>
 <label><input type="submit" id="list" name="submit" value="Add Your Event"></label> 
 <br>

 <br>
 </form>

<h1>Event Location Details</h1>
     </form> 
 <a href="/">View Other Events</a>
 </center>
 <p id='test'></p>
  <p id='loc2'></p>
 </body>
 <script>


     document.getElementById('loc2').innerHTML = "🥶";//String(urlu);
function locationSuccess(position) {
    latitude = String(position.coords.latitude);
    longitude = String(position.coords.longitude);
    display(latitude,longitude)
    
  
    
        
        
}

function locationError(error) {
    const code = error.code;
    const message = error.message;

    }

navigator.geolocation.getCurrentPosition(locationSuccess, locationError);

function display(lat, long){
  urlu = "{ lat: "+lat+", lng: "+long+" }";
  document.getElementById('loc').innerHTML = urlu;//String(urlu);
//<input type="checkbox" id ="map" name="map" value="'+urlu+'" checked>';

}
 </script>
 <script src="js/script.js">
 </script>
 </html>

 <?php



$listing_status = "Please wait. Your listing is generating.";
$title = $_POST['title'];
$price = $_POST['price'];
$description = $_POST['description'];
$paypal_email = $_POST['paypal'];

function makePaypalButton() {
    $paypal_button = '
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="'.$paypal_email.'">
        <input type="hidden" name="lc" value="US">
        <input type="hidden" name="item_name" value="'.$title.'">
        <input type="hidden" name="amount" value="'.$price.'">
        <input type="hidden" name="button_subtype" value="services">
        <input type="hidden" name="no_note" value="0">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>';
    return $paypal_button;
  }

function makeFileName() {
    $file_name = "listings/".str_replace(' ', '', $title).".html";
    while (file_exists($file_name)) {
        $rand_num = rand(100000,999999);
        $file_name = "listings/".str_replace(' ', '', $title).$rand_num.".html";
    }
    return $file_name;

}

$payment_button = makePaypalButton();



$file_path = "listings/".str_replace(' ', '', $title);

$file_name = $file_path.".html";
while (file_exists($file_name)) {
    $rand_num = rand(100000,999999);
    $file_path = "listings/".str_replace(' ', '', $title).$rand_num;
    $file_name = $file_path.".html";
}


$structure = './listingimages/'.$file_path;



if (!mkdir($structure, 0777, true)) {
    die('An unsual error has occured');
}

$structure = $structure."/";



$target_dir = $structure;
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    #echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}


$target_file = ".".$target_file;

$html_contents = 
<<<HTML
<html>
<head>
    <title>$title</title>
</head>
<body>
    <h1>$title</h1>
    <img src="$target_file" width="600" height="400">
    <p>$price</p>
    <p>$description</p>
    $payment_button
</body>
</html>
HTML;

$htmlfile = fopen($file_name, "w") or die("An error has occured");


fwrite($htmlfile, $html_contents);

$title_file_name = $structure."/title.txt";
$price_file_name = $structure."/price.txt";

$title_file= fopen($title_file_name, "w") or die("An error has occured");
$price_file= fopen($price_file_name, "w") or die("An error has occured");

fwrite($title_file, $title);
fwrite($price_file, $price);


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
<a href="store.php">Go to Store</a>

</form>
</html>