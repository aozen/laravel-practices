<p>This guide present some useful functions for php &amp; laravel.&nbsp;</p>
<p>For using helper.php, add this columns to the composer.json.&nbsp;</p>
<p>&nbsp;</p>
<pre>"autoload": {<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; "psr-4": {<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; "App\\": "app/"<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; },<br /><br />&nbsp; &nbsp; &nbsp; &nbsp; "files" : ["app/helper.php"]<br /><br />&nbsp; &nbsp; }<br /><br />&nbsp;</pre>
<p>After that, functions are may call in the project.</p>
<p>&nbsp;</p>
<p><!--?php &lt;/p&gt;
&lt;p&gt;use Illuminate\Support\Facades\Route;&lt;/p&gt;
&lt;p&gt;/**&lt;/p&gt;
&lt;p&gt; *&lt;/p&gt;
&lt;p&gt; * @param $number&lt;/p&gt;
&lt;p&gt; * @param $currency&lt;/p&gt;
&lt;p&gt; */&lt;/p&gt;
&lt;p&gt;//############################# START PHP FUNCTIONS  #######################&lt;/p&gt;
&lt;p&gt; &lt;/p&gt;
&lt;p&gt;//GET ORIGINAL LOAD IMAGE FROM YOUTUBE VIDEOS&lt;/p&gt;
&lt;pre&gt;function videoJpg($video_url)&lt;br ?--><br />{<br /><br />&nbsp; &nbsp; $cut_head = str_after($video_url, 'https://www.youtube.com/watch?v=');<br /><br />&nbsp; &nbsp; $cut_tail = str_before($cut_head, '&amp;');<br /><br />&nbsp; &nbsp; $video_jpg = "https://i3.ytimg.com/vi/".$cut_tail."/hqdefault.jpg";<br /><br />&nbsp; &nbsp; return $video_jpg;<br /><br />}</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>//CONVERT YOUTUBE VIDEOS TO EMBEDED URL</p>
<p>function convertEmbed($video_url)</p>
<p>{</p>
<p>&nbsp; &nbsp; $get_last = str_after($video_url, 'https://www.youtube.com/watch?v=');</p>
<p>&nbsp; &nbsp; $throw = str_before($get_last, '&amp;');</p>
<p>&nbsp; &nbsp; $embed = "https://www.youtube.com/embed/".$throw;</p>
<p>&nbsp; &nbsp; return $embed;</p>
<p>}</p>
<p>&nbsp;</p>
<p>//MAKE SLUG</p>
<p>function createSlug($str, $delimiter = '-')</p>
<p>{</p>
<p>&nbsp; &nbsp; $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&amp;]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));</p>
<p>&nbsp;</p>
<p>&nbsp; &nbsp; return $slug;</p>
<p>}&nbsp;</p>
<p>&nbsp;</p>
<p>//GET FILE EXTENSIONS</p>
<p>function fileExtension($file_name)</p>
<p>{</p>
<p>&nbsp; &nbsp; $separate = explode(".", $file_name);</p>
<p>&nbsp; &nbsp; $extension = end($separate);</p>
<p>&nbsp; &nbsp; return $extension ? $extension : false;</p>
<p>}</p>
<p>&nbsp;</p>
<p>//PUT CHARACTER LIMIT IN TEXT. STOP WRITING AFTER END OF THE WORD.</p>
<p>function shortening($content, $letter) {</p>
<p>&nbsp; &nbsp; $content = stripslashes(strip_tags($content));</p>
<p>&nbsp; &nbsp; if (strlen($content) &lt;= $letter) {</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; return $content;</p>
<p>&nbsp; &nbsp; } else {</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; $content = preg_replace('/\s+?(\S+)?$/', '', substr($content, 0, $letter));</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; return $content . "...";</p>
<p>&nbsp; &nbsp; }</p>
<p>}</p>
<p>&nbsp;</p>
<p>//CALCULATE KM, METER, MILE FROM LATITUDE AND LONGITUDE</p>
<p>function calculate($latitude1, $longitude1, $latitude2, $longitude2) {</p>
<p>&nbsp; &nbsp; $longitude_diff = $longitude1 - $longitude2;</p>
<p>&nbsp; &nbsp; $mile = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($longitude_diff)));</p>
<p>&nbsp; &nbsp; $mile = acos($mile);</p>
<p>&nbsp; &nbsp; $mile = rad2deg($mile);</p>
<p>&nbsp; &nbsp; $mile = $mile * 60 * 1.1515;</p>
<p>&nbsp; &nbsp; $km = $mile * 1.609344;</p>
<p>&nbsp; &nbsp; $meter = $km * 1000;</p>
<p>&nbsp; &nbsp; return compact('mile','km','meter');</p>
<p>}</p>
<p>&nbsp;</p>
<p>//GET NUMBERS EXTENSION</p>
<p>function ordinalNumbers($number){</p>
<p>&nbsp; &nbsp; $lastnum = abs($number) % 10;</p>
<p>&nbsp; &nbsp; $ordinal = ((abs($number) %100 &lt; 21 &amp;&amp; abs($number) %100 &gt; 4) ? 'th'</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; : (($lastnum &lt; 4) ? ($lastnum &lt; 3) ? ($lastnum &lt; 2) ? ($lastnum &lt; 1)</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ? 'th' : 'st' : 'nd' : 'rd' : 'th'));</p>
<p>&nbsp; &nbsp; return $number.$ordinal;</p>
<p>}</p>
<p>&nbsp;</p>
<p>//IF WORD STARTING WITH CHILD RETURN TRUE</p>
<p>function startingWord($word, $child){</p>
<p>&nbsp; &nbsp; $length = strlen($child);</p>
<p>&nbsp; &nbsp; return (substr($word, 0, $length) === $child);</p>
<p>}</p>
<p>&nbsp;</p>
<p>//UPPER FIRST LETTER //NOT UTF-8</p>
<p>//Inputs: "HEEY. WHAZZUP!" Outputs: "Heey. Whazzup!"</p>
<p>function ucname($string) {</p>
<p>&nbsp; &nbsp; $string =ucwords(strtolower($string));</p>
<p>&nbsp;</p>
<p>&nbsp; &nbsp; foreach (array('-', '\'') as $delimiter) {</p>
<p>&nbsp; &nbsp; &nbsp; if (strpos($string, $delimiter)!==false) {</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; $string =implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));</p>
<p>&nbsp; &nbsp; &nbsp; }</p>
<p>&nbsp; &nbsp; }</p>
<p>&nbsp; &nbsp; return $string;</p>
<p>}</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>function ucwords_tr($string) {</p>
<p>$lower_arr = array("I"=&gt;"ı","i"=&gt;"İ");</p>
<p>$string=strtr($string,$lower_arr);</p>
<p>return mb_convert_case($string, MB_CASE_TITLE, "UTF-8");</p>
<p>}</p>
<p>&nbsp;</p>
<p>//TR STRTOUPPER</p>
<p>function tr_strtoupper($string)</p>
<p>{</p>
<p>&nbsp; &nbsp; $find=array("&ccedil;","i","ı","ğ","&ouml;","ş","&uuml;");</p>
<p>&nbsp; &nbsp; $replace=array("&Ccedil;","İ","I","Ğ","&Ouml;","Ş","&Uuml;");</p>
<p>&nbsp; &nbsp; $string=str_replace($find,$replace,$string);</p>
<p>&nbsp; &nbsp; $string=strtoupper($string);</p>
<p>&nbsp; &nbsp; return $string;</p>
<p>}</p>
<p>&nbsp;</p>
<p>function sentence_case($string) {</p>
<p>&nbsp; &nbsp; $sentences = preg_split('/([.?!]+)/', $string, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);</p>
<p>&nbsp; &nbsp; $new_string = '';</p>
<p>&nbsp; &nbsp; foreach ($sentences as $key =&gt; $sentence) {</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; $new_string .= ($key &amp; 1) == 0?</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ucfirst(strtolower(trim($sentence))) :</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $sentence.' ';</p>
<p>&nbsp; &nbsp; }</p>
<p>&nbsp; &nbsp; return trim($new_string);</p>
<p>}</p>
<p>&nbsp;</p>
<p>//GENERATE RANDOM STRING AS SPECIFIED LENGTH</p>
<p>function randomString($length, $strings = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz1234567890'){</p>
<p>&nbsp; &nbsp; if($length &gt; 0){</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; $string_length = (strlen($strings) - 1);</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; $random_string = $strings{rand(0, $string_length)};</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; for ($i = 1; $i &lt; $length; $i = strlen($random_string)){</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $r = $strings{rand(0, $string_length)};</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; if ($r != $random_string{$i - 1}) $random_string .=&nbsp; $r;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; }</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; return $random_string;</p>
<p>&nbsp; &nbsp; }</p>
<p>}</p>
<p>&nbsp;</p>
<p>//IF PASSWORD IS MD5 RETURN TRUE</p>
<p>function is_md5 ($string) {</p>
<p>&nbsp; &nbsp; if (is_string($string) &amp;&amp; preg_match('/^[0-9a-f]{32}$/', $string)){</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; return true;</p>
<p>&nbsp; &nbsp; }</p>
<p>&nbsp; &nbsp; else</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; return false;</p>
<p>}</p>
<p>&nbsp;</p>
<p>//SEPARATE</p>
<p>&nbsp;</p>
<p>TAGS AND ADD EACH ONE TO AN ARRAY</p>
<p>function separate_between_tags($string) {</p>
<p>&nbsp; &nbsp; $tags = array("</p>
<p>", "\n", "&nbsp;");</p>
<p>&nbsp; &nbsp; $a = str_replace($tags, "", $string);</p>
<p>&nbsp; &nbsp; $b = explode('</p>
<p>', $a);</p>
<p>&nbsp; &nbsp; $c = array_filter( $b);</p>
<p>&nbsp; &nbsp; return $c;</p>
<p>}</p>
<p>&nbsp;</p>
<p>//#############################&nbsp; END PHP FUNCTIONS&nbsp; ############################</p>
<p>//###############################&nbsp; START LARAVEL ###############################</p>
<p>//########################&nbsp; Eloquent - Helpers - Routes&nbsp; #######################</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>function isUrlContainString($string)</p>
<p>{</p>
<p>&nbsp; &nbsp; if (stripos(Route::current()-&gt;getName(),$string) !== false) return true;</p>
<p>&nbsp; &nbsp; else</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; return false;</p>
<p>}</p>
<p>&nbsp;</p>
<p>function isContainArray($wordToAdd, array $arr)</p>
<p>{</p>
<p>&nbsp; &nbsp; foreach($arr as $a) {</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; if (stripos(Route::current()-&gt;getName(),$a) !== false) return $wordToAdd;</p>
<p>&nbsp; &nbsp; }</p>
<p>&nbsp; &nbsp; return "";</p>
<p>}</p>
<p>&nbsp;</p>
<p>function urlAddString($string, $add){</p>
<p>&nbsp; &nbsp; if (strpos(Route::current()-&gt;getName(), $string) !== false) {</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; return $add;</p>
<p>&nbsp; &nbsp; }</p>
<p>&nbsp; &nbsp; else return "";</p>
<p>}</p>
<p>&nbsp;</p>
<p>//Separate you url with specified string and get the last part</p>
<p>function specificPartFromUrl($part){</p>
<p>&nbsp; &nbsp; $link = URL::full();</p>
<p>&nbsp; &nbsp; $myarray = explode($part ,$link);</p>
<p>&nbsp; &nbsp; return end($myarray);</p>
<p>}</p>
<p>&nbsp;</p>
<p>function urlLastPart($string){</p>
<p>&nbsp; &nbsp; substr(strrchr(url()-&gt;current(), $string),1);</p>
<p>}</p>
<p>&nbsp;</p>
<p>//WORKS WITH LOCALIZATION IN LARAVEL. ALSO WORKS IF "HIDE DEFAULT LOCALE IN URL" IS TRUE.</p>
<p>// isNeedBack("foo") ---&gt; local/tr/foo = true,&nbsp; isNeedBack("foo") ---&gt; local/tr/foo/2 = false, Then put back button @if(!isNeedBack("investments"))</p>
<p>function isNeedBack($string) {</p>
<p>&nbsp; &nbsp; $localeCode = LaravelLocalization::getCurrentLocale();</p>
<p>&nbsp; &nbsp; $ready_to_cut = "$localeCode"."/";</p>
<p>&nbsp; &nbsp; $after_cut = str_after(URL::full(), $ready_to_cut);</p>
<p>&nbsp; &nbsp; if($after_cut == $string) {</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; return true;</p>
<p>&nbsp; &nbsp; }</p>
<p>}</p>
<p>//#######################&nbsp; Eloquent - Helpers - Routes&nbsp; ######################</p>
<p>//###############################&nbsp; END LARAVEL ###############################</p>