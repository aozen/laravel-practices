<p>This guide present some useful functions for php &amp; laravel.&nbsp;</p>
<p>For using helper.php, add this columns to the composer.json.&nbsp;</p>
<p>&nbsp;</p>
<pre>"autoload": {<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; "psr-4": {<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; "App\\": "app/"<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; },<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; "files" : ["app/helper.php"]<br /><br />&nbsp; &nbsp; }</pre>
<p>&nbsp;</p>
<p>After that, functions are may call in the project.</p>
<p>&nbsp;</p>
<pre>&lt;?php<br /><br />use Illuminate\Support\Facades\Route;<br /><br />/**<br /><br />&nbsp;*<br /><br />&nbsp;* @param $number<br /><br />&nbsp;* @param $currency<br /><br />&nbsp;*/</pre>
<p>############################# START PHP FUNCTIONS&nbsp; #######################</p>
<p>&nbsp;</p>
<p>GET ORIGINAL LOAD IMAGE FROM YOUTUBE VIDEOS</p>
<pre>function videoJpg($video_url)<br /><br />{<br /><br />&nbsp; &nbsp; $cut_head = str_after($video_url, 'https://www.youtube.com/watch?v=');<br /><br />&nbsp; &nbsp; $cut_tail = str_before($cut_head, '&amp;');<br /><br />&nbsp; &nbsp; $video_jpg = "https://i3.ytimg.com/vi/".$cut_tail."/hqdefault.jpg";<br /><br />&nbsp; &nbsp; return $video_jpg;<br /><br />}<br /><br /><br /></pre>
<p>&nbsp;</p>
<p>CONVERT YOUTUBE VIDEOS TO EMBEDED URL</p>
<pre>function convertEmbed($video_url)<br /><br />{<br /><br />&nbsp; &nbsp; $get_last = str_after($video_url, 'https://www.youtube.com/watch?v=');<br /><br />&nbsp; &nbsp; $throw = str_before($get_last, '&amp;');<br /><br />&nbsp; &nbsp; $embed = "https://www.youtube.com/embed/".$throw;<br /><br />&nbsp; &nbsp; return $embed;<br /><br />}</pre>
<p>&nbsp;</p>
<p>MAKE SLUG</p>
<pre>function createSlug($str, $delimiter = '-')<br /><br />{<br /><br />&nbsp; &nbsp; $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&amp;]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));<br /><br /><br /><br /><br />&nbsp; &nbsp; return $slug;<br /><br />}&nbsp;</pre>
<p>&nbsp;</p>
<p>GET FILE EXTENSIONS</p>
<pre>function fileExtension($file_name)<br /><br />{<br /><br />&nbsp; &nbsp; $separate = explode(".", $file_name);<br /><br />&nbsp; &nbsp; $extension = end($separate);<br /><br />&nbsp; &nbsp; return $extension ? $extension : false;<br /><br />}</pre>
<p>&nbsp;</p>
<p>PUT CHARACTER LIMIT IN TEXT. STOP WRITING AFTER END OF THE WORD.</p>
<pre>function shortening($content, $letter) {<br /><br />&nbsp; &nbsp; $content = stripslashes(strip_tags($content));<br /><br />&nbsp; &nbsp; if (strlen($content) &lt;= $letter) {<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; return $content;<br /><br />&nbsp; &nbsp; } else {<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; $content = preg_replace('/\s+?(\S+)?$/', '', substr($content, 0, $letter));<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; return $content . "...";<br /><br />&nbsp; &nbsp; }<br /><br />}</pre>
<p>&nbsp;</p>
<p>CALCULATE KM, METER, MILE FROM LATITUDE AND LONGITUDE</p>
<pre>function calculate($latitude1, $longitude1, $latitude2, $longitude2) {<br /><br />&nbsp; &nbsp; $longitude_diff = $longitude1 - $longitude2;<br /><br />&nbsp; &nbsp; $mile = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($longitude_diff)));<br /><br />&nbsp; &nbsp; $mile = acos($mile);<br /><br />&nbsp; &nbsp; $mile = rad2deg($mile);<br /><br />&nbsp; &nbsp; $mile = $mile * 60 * 1.1515;<br /><br />&nbsp; &nbsp; $km = $mile * 1.609344;<br /><br />&nbsp; &nbsp; $meter = $km * 1000;<br /><br />&nbsp; &nbsp; return compact('mile','km','meter');<br /><br />}</pre>
<p>&nbsp;</p>
<p>GET NUMBERS EXTENSION</p>
<pre>function ordinalNumbers($number){<br /><br />&nbsp; &nbsp; $lastnum = abs($number) % 10;<br /><br />&nbsp; &nbsp; $ordinal = ((abs($number) %100 &lt; 21 &amp;&amp; abs($number) %100 &gt; 4) ? 'th'<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; : (($lastnum &lt; 4) ? ($lastnum &lt; 3) ? ($lastnum &lt; 2) ? ($lastnum &lt; 1)<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ? 'th' : 'st' : 'nd' : 'rd' : 'th'));<br /><br />&nbsp; &nbsp; return $number.$ordinal;<br /><br />}</pre>
<p>&nbsp;</p>
<p>IF WORD STARTING WITH CHILD RETURN TRUE</p>
<pre>function startingWord($word, $child){<br /><br />&nbsp; &nbsp; $length = strlen($child);<br /><br />&nbsp; &nbsp; return (substr($word, 0, $length) === $child);<br /><br />}</pre>
<p>&nbsp;</p>
<p>UPPER FIRST LETTER, NOT UTF-8</p>
<p>Inputs: "HEEY. WHAZZUP!" Outputs: "Heey. Whazzup!"</p>
<pre>function ucname($string) {<br /><br />&nbsp; &nbsp; $string =ucwords(strtolower($string));<br /><br /><br /><br /><br />&nbsp; &nbsp; foreach (array('-', '\'') as $delimiter) {<br /><br />&nbsp; &nbsp; &nbsp; if (strpos($string, $delimiter)!==false) {<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; $string =implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));<br /><br />&nbsp; &nbsp; &nbsp; }<br /><br />&nbsp; &nbsp; }<br /><br />&nbsp; &nbsp; return $string;<br /><br />}</pre>
<p>&nbsp;</p>
<p>&nbsp;</p>
<pre>function ucwords_tr($string) {<br /><br />$lower_arr = array("I"=&gt;"ı","i"=&gt;"İ");<br /><br />$string=strtr($string,$lower_arr);<br /><br />return mb_convert_case($string, MB_CASE_TITLE, "UTF-8");<br /><br />}</pre>
<p>&nbsp;</p>
<p>TR STRTOUPPER</p>
<pre>function tr_strtoupper($string)<br /><br />{<br /><br />&nbsp; &nbsp; $find=array("&ccedil;","i","ı","ğ","&ouml;","ş","&uuml;");<br /><br />&nbsp; &nbsp; $replace=array("&Ccedil;","İ","I","Ğ","&Ouml;","Ş","&Uuml;");<br /><br />&nbsp; &nbsp; $string=str_replace($find,$replace,$string);<br /><br />&nbsp; &nbsp; $string=strtoupper($string);<br /><br />&nbsp; &nbsp; return $string;<br /><br />}</pre>
<p>&nbsp;</p>
<pre>function sentence_case($string) {<br /><br />&nbsp; &nbsp; $sentences = preg_split('/([.?!]+)/', $string, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);<br /><br />&nbsp; &nbsp; $new_string = '';<br /><br />&nbsp; &nbsp; foreach ($sentences as $key =&gt; $sentence) {<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; $new_string .= ($key &amp; 1) == 0?<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ucfirst(strtolower(trim($sentence))) :<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $sentence.' ';<br /><br />&nbsp; &nbsp; }<br /><br />&nbsp; &nbsp; return trim($new_string);<br /><br />}<br /><br /><br /></pre>
<p>GENERATE RANDOM STRING AS SPECIFIED LENGTH</p>
<pre>function randomString($length, $strings = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz1234567890'){<br /><br />&nbsp; &nbsp; if($length &gt; 0){<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; $string_length = (strlen($strings) - 1);<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; $random_string = $strings{rand(0, $string_length)};<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; for ($i = 1; $i &lt; $length; $i = strlen($random_string)){<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $r = $strings{rand(0, $string_length)};<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; if ($r != $random_string{$i - 1}) $random_string .=&nbsp; $r;<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; }<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; return $random_string;<br /><br />&nbsp; &nbsp; }<br /><br />}</pre>
<p>&nbsp;</p>
<p>IF PASSWORD IS MD5 RETURN TRUE</p>
<pre>function is_md5 ($string) {<br /><br />&nbsp; &nbsp; if (is_string($string) &amp;&amp; preg_match('/^[0-9a-f]{32}$/', $string)){<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; return true;<br /><br />&nbsp; &nbsp; }<br /><br />&nbsp; &nbsp; else<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; return false;<br /><br />}</pre>
<p>&nbsp;</p>
<p>SEPARATE &lt;p&gt;&lt;/p&gt; TAGS AND ADD EACH ONE TO AN ARRAY</p>
<pre>function separate_between_tags($string) {<br /><br />&nbsp; &nbsp; $tags = array("&lt;p&gt;", "\n", "&amp;nbsp;");<br /><br />&nbsp; &nbsp; $a = str_replace($tags, "", $string);<br /><br />&nbsp; &nbsp; $b = explode('&lt;/p&gt;', $a);<br /><br />&nbsp; &nbsp; $c = array_filter( $b);<br /><br />&nbsp; &nbsp; return $c;<br /><br />}</pre>
<p>&nbsp;</p>
<p>#############################&nbsp; END PHP FUNCTIONS&nbsp; ############################</p>
<p>###############################&nbsp; START LARAVEL ###############################</p>
<p>########################&nbsp; Eloquent - Helpers - Routes&nbsp; #######################</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<pre>function isUrlContainString($string)<br /><br />{<br /><br />&nbsp; &nbsp; if (stripos(Route::current()-&gt;getName(),$string) !== false) return true;<br /><br />&nbsp; &nbsp; else<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; return false;<br /><br />}</pre>
<p>&nbsp;</p>
<pre>function isContainArray($wordToAdd, array $arr)<br /><br />{<br /><br />&nbsp; &nbsp; foreach($arr as $a) {<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; if (stripos(Route::current()-&gt;getName(),$a) !== false) return $wordToAdd;<br /><br />&nbsp; &nbsp; }<br /><br />&nbsp; &nbsp; return "";<br /><br />}<br /><br /><br /></pre>
<pre>function urlAddString($string, $add){<br /><br />&nbsp; &nbsp; if (strpos(Route::current()-&gt;getName(), $string) !== false) {<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; return $add;<br /><br />&nbsp; &nbsp; }<br /><br />&nbsp; &nbsp; else return "";<br /><br />}</pre>
<p>&nbsp;</p>
<p>Separate you url with specified string and get the last part</p>
<pre>function specificPartFromUrl($part){<br /><br />&nbsp; &nbsp; $link = URL::full();<br /><br />&nbsp; &nbsp; $myarray = explode($part ,$link);<br /><br />&nbsp; &nbsp; return end($myarray);<br /><br />}</pre>
<p>&nbsp;</p>
<pre>function urlLastPart($string){<br /><br />&nbsp; &nbsp; substr(strrchr(url()-&gt;current(), $string),1);<br /><br />}</pre>
<p>&nbsp;</p>
<p>WORKS WITH LOCALIZATION IN LARAVEL. ALSO WORKS IF "HIDE DEFAULT LOCALE IN URL" IS TRUE.</p>
<p> isNeedBack("foo") ---&gt; local/tr/foo = true,&nbsp; isNeedBack("foo") ---&gt; local/tr/foo/2 = false, Then put back button @if(!isNeedBack("investments"))</p>
<pre>function isNeedBack($string) {<br /><br />&nbsp; &nbsp; $localeCode = LaravelLocalization::getCurrentLocale();<br /><br />&nbsp; &nbsp; $ready_to_cut = "$localeCode"."/";<br /><br />&nbsp; &nbsp; $after_cut = str_after(URL::full(), $ready_to_cut);<br /><br />&nbsp; &nbsp; if($after_cut == $string) {<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; return true;<br /><br />&nbsp; &nbsp; }<br /><br />}</pre>
<p>#######################&nbsp; Eloquent - Helpers - Routes&nbsp; ######################</p>
<p>###############################&nbsp; END LARAVEL ###############################</p>