<?php
use Illuminate\Support\Facades\Route;
/**
 *
 * @param $number
 * @param $currency
 */
//############################# START PHP FUNCTIONS  #######################

//GET ORIGINAL LOAD IMAGE FROM YOUTUBE VIDEOS
function videoJpg($video_url)
{
    $cut_head = str_after($video_url, 'https://www.youtube.com/watch?v=');
    $cut_tail = str_before($cut_head, '&');
    $video_jpg = "https://i3.ytimg.com/vi/".$cut_tail."/hqdefault.jpg";
    return $video_jpg;
}


//CONVERT YOUTUBE VIDEOS TO EMBEDED URL
function convertEmbed($video_url)
{
    $get_last = str_after($video_url, 'https://www.youtube.com/watch?v=');
    $throw = str_before($get_last, '&');
    $embed = "https://www.youtube.com/embed/".$throw;
    return $embed;
}

//MAKE SLUG
function createSlug($str, $delimiter = '-')
{
    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));

    return $slug;
} 

//GET FILE EXTENSIONS
function fileExtension($file_name)
{
    $separate = explode(".", $file_name);
    $extension = end($separate);
    return $extension ? $extension : false;
}

//PUT CHARACTER LIMIT IN TEXT. STOP WRITING AFTER END OF THE WORD.
function shortening($content, $letter) {
    $content = stripslashes(strip_tags($content));
    if (strlen($content) <= $letter) {
        return $content;
    } else {
        $content = preg_replace('/\s+?(\S+)?$/', '', substr($content, 0, $letter));
        return $content . "...";
    }
}

//CALCULATE KM, METER, MILE FROM LATITUDE AND LONGITUDE
function calculate($latitude1, $longitude1, $latitude2, $longitude2) {
    $longitude_diff = $longitude1 - $longitude2;
    $mile = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($longitude_diff)));
    $mile = acos($mile);
    $mile = rad2deg($mile);
    $mile = $mile * 60 * 1.1515;
    $km = $mile * 1.609344;
    $meter = $km * 1000;
    return compact('mile','km','meter');
}

//GET NUMBERS EXTENSION
function ordinalNumbers($number){
    $lastnum = abs($number) % 10;
    $ordinal = ((abs($number) %100 < 21 && abs($number) %100 > 4) ? 'th'
        : (($lastnum < 4) ? ($lastnum < 3) ? ($lastnum < 2) ? ($lastnum < 1)
            ? 'th' : 'st' : 'nd' : 'rd' : 'th'));
    return $number.$ordinal;
}

//IF WORD STARTING WITH CHILD RETURN TRUE
function startingWord($word, $child){
    $length = strlen($child);
    return (substr($word, 0, $length) === $child);
}

//UPPER FIRST LETTER //NOT UTF-8
//Inputs: "HEEY. WHAZZUP!" Outputs: "Heey. Whazzup!"
function ucname($string) {
    $string =ucwords(strtolower($string));

    foreach (array('-', '\'') as $delimiter) {
      if (strpos($string, $delimiter)!==false) {
        $string =implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
      }
    }
    return $string;
}


function ucwords_tr($string) {
$lower_arr = array("I"=>"ı","i"=>"İ");
$string=strtr($string,$lower_arr);
return mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
}

//TR STRTOUPPER
function tr_strtoupper($string)
{
    $find=array("ç","i","ı","ğ","ö","ş","ü");
    $replace=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
    $string=str_replace($find,$replace,$string);
    $string=strtoupper($string);
    return $string;
}

function sentence_case($string) {
    $sentences = preg_split('/([.?!]+)/', $string, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
    $new_string = '';
    foreach ($sentences as $key => $sentence) {
        $new_string .= ($key & 1) == 0?
            ucfirst(strtolower(trim($sentence))) :
            $sentence.' ';
    }
    return trim($new_string);
}

//GENERATE RANDOM STRING AS SPECIFIED LENGTH
function randomString($length, $strings = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz1234567890'){
    if($length > 0){
        $string_length = (strlen($strings) - 1);
        $random_string = $strings{rand(0, $string_length)};
        for ($i = 1; $i < $length; $i = strlen($random_string)){
            $r = $strings{rand(0, $string_length)};
            if ($r != $random_string{$i - 1}) $random_string .=  $r;
        }
        return $random_string;
    }
}

//IF PASSWORD IS MD5 RETURN TRUE
function is_md5 ($string) {
    if (is_string($string) && preg_match('/^[0-9a-f]{32}$/', $string)){
        return true;
    }
    else
        return false;
}

//SEPARATE <p></p> TAGS AND ADD EACH ONE TO AN ARRAY
function separate_between_tags($string) {
    $tags = array("<p>", "\n", "&nbsp;");
    $a = str_replace($tags, "", $string);
    $b = explode('</p>', $a);
    $c = array_filter( $b);
    return $c;
}

//#############################  END PHP FUNCTIONS  ############################
//###############################  START LARAVEL ###############################
//########################  Eloquent - Helpers - Routes  #######################


function isUrlContainString($string)
{
    if (stripos(Route::current()->getName(),$string) !== false) return true;
    else
        return false;
}

function isContainArray($wordToAdd, array $arr)
{
    foreach($arr as $a) {
        if (stripos(Route::current()->getName(),$a) !== false) return $wordToAdd;
    }
    return "";
}

function urlAddString($string, $add){
    if (strpos(Route::current()->getName(), $string) !== false) {
        return $add;
    }
    else return "";
}

//Separate you url with specified string and get the last part
function specificPartFromUrl($part){
    $link = URL::full();
    $myarray = explode($part ,$link);
    return end($myarray);
}

function urlLastPart($string){
    substr(strrchr(url()->current(), $string),1);
}

//WORKS WITH LOCALIZATION IN LARAVEL. ALSO WORKS IF "HIDE DEFAULT LOCALE IN URL" IS TRUE.
// isNeedBack("foo") ---> local/tr/foo = true,  isNeedBack("foo") ---> local/tr/foo/2 = false, Then put back button @if(!isNeedBack("investments"))
function isNeedBack($string) {
    $localeCode = LaravelLocalization::getCurrentLocale();
    $ready_to_cut = "$localeCode"."/";
    $after_cut = str_after(URL::full(), $ready_to_cut);
    if($after_cut == $string) {
        return true;
    }
}
//#######################  Eloquent - Helpers - Routes  ######################
//###############################  END LARAVEL ###############################