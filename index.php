<?php

$listing_status = "Please wait. Your listing is generating.";
$title = $_GET['title'];
$price = $_GET['price'];
$description = $_GET['description'];
$paypal_email = $_GET['paypal'];

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
    $payment_button
</body>
</html>
HTML;

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