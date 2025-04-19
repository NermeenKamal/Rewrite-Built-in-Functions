<?php

function string_length($string): int
{
    $length = 0;
    while (isset($string[$length])) {
        $length++;
    }
    return $length;
}
function reverse_string($string): string
{
    $length = string_length($string);
    $reversed_string = "";
    for ($i = $length - 1; $i >= 0; $i--) {
        $reversed_string .= $string[$i];
    }
    return $reversed_string;
}

function lowercase_string($string): string
{
    $lowercase_string = "";
    for ($i = 0; $i < string_length($string); $i++) {
        if(65 <= ord($string[$i]) && ord($string[$i]) <= 90){
        $lowercase_string .= chr(ord($string[$i]) +32); // subtract 32 to convert to uppercase
    }
    else{
        $lowercase_string .= $string[$i];
        }
    }
    return $lowercase_string;
}

function uppercase_string($string): string
{
    $uppercase_string = "";
    for ($i = 0; $i < string_length($string); $i++) {
        if (97 <= ord($string[$i]) && ord($string[$i]) <= 122) {
            $uppercase_string .= chr(ord($string[$i]) - 32);
        }
        else {
            $uppercase_string .= $string[$i];
        }
    }
    return $uppercase_string;
}

function trimming($string): string
{
    $trimmed_string = "";
    for($i = 0; $i < string_length($string); $i++){
        if($string[$i] == " "){
            $string[$i] = $string[$i+1] ;
            continue;
        }
        else{
            $trimmed_string .= $string[$i];
        }
    }
    return $trimmed_string;
}
function explode_string($string): array
{
    $exploded_string = array();
    for($i = 0; $i < string_length($string); $i++){
        if($string[$i] == " "){
            $exploded_string[] = $string[$i+1] ;
            continue;
        }
        else{
            $exploded_string[] = $string[$i];
        }
    }
    return $exploded_string;
    }

function implode_string($array): string
{
    $imploded_string = "";
    for($i = 0; $i < string_length($array); $i++){
        if($array[$i] == " "){
            $imploded_string .= $array[$i+1];
            continue;
        }
        else{
            $imploded_string .= $array[$i];
        }
    }
    return $imploded_string;
}
function string_replace($search, $replacement, $string): string
{
    for($i = 0; $i < string_length($string); $i++){
        if($string[$i] == $search){
            $string[$i] = $replacement;
        }
    }
    return $string;
}
function substring($string, $start, $length): string
{
    $sub = '';
    if($start < 0 || $length < 0 || $length > string_length($string)){
        return "Invalid input";
    }
    for($i = $start; $i < $start + $length-1; $i++){
        $sub .= $string[$i];
    }
    return $sub;
}

function string_pos($haystack, $needle): int
{
    $pos = 0;
    for($i = 0; $i < string_length($haystack); $i++) {
      if($haystack[$i] == $needle){
          $pos = $i;
          break;
         }
      }
    return $pos;
}

function string_repeat($string, $times) : string
{
    $repeated_string = "";
    for ($i = 0; $i < $times; $i++) {
        $repeated_string .= $string;
    }
    return $repeated_string;
}

function upper_first($string): string
{
    $first_char = $string[0];
    $uppercase_first_char = "";
    if($first_char >= 'A' && $first_char <= 'Z'){
        $uppercase_first_char = $first_char;
    }
    else{
    $uppercase_first_char = chr(ord($first_char) - 32);
    }
    $rest_of_string = substring($string, 1 , string_length($string));
    return $uppercase_first_char . $rest_of_string;
}

function lower_first($string): string
{
    $first_char = $string[0];
    $lowercase_first_char = "";
    if($first_char >= 'a' && $first_char <= 'z'){
        $lowercase_first_char = $first_char;
    }
    else{
        $lowercase_first_char = chr(ord($first_char) + 32);
    }
    $rest_of_string = substring($string, 1 , string_length($string));
    return $lowercase_first_char . $rest_of_string;
}
function Sum($string): int
{
    $sum = 0;
    $string_to_array = explode_string($string);
    for($i = 0; $i < string_length($string); $i++){
        $sum += $string_to_array[$i];
    }
    return $sum;
}
function factorial($string): int
{
    $factorial = 1;
    $string_to_array = explode_string($string);
    for($i = 0; $i < string_length($string); $i++){
        $factorial *= $string_to_array[$i];
    }
     return $factorial;
}
function word_wrap($string, $width, $break = "\n", $cut = false): string
{
    $wrapped = "";
    $line = "";

    $words = explode_string($string);
    foreach ($words as $word) {
        while (string_length($word) > $width && $cut === false) {
            $wrapped .= substring($word, 0, $width) . $break;
            $word = substring($word, 0,$width);
        }
        if (string_length($line) + string_length($word) > $width) {
            $wrapped .= trim($line) . $break;
            $line = "";
        }
        $line .= $word . " ";
    }
    if (string_length(trim($line)) > 0) {
        $wrapped .= trim($line);
    }
    return $wrapped;
}


function get_content($filename): string
{
    if (!file_exists($filename)) {
        return false;
    }
    $content = "";
     $file = fopen($filename, "r");
    if(filesize($filename) == 0){
        return "File is empty";
    }
    while (!feof($file)) {
        $content .= fread($file, filesize($filename));
    }
    fclose($file);
    return $content;
}

function put_content($filename, $content): bool
{
    $file = fopen($filename, "w");
    if(fwrite($file, $content) === false){
        return false;
    }
    fclose($file);
    return true;
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $string = $_POST["string"];
    if($string == null || $string == ""){
        echo "Please enter a string";
    }
    else if(isset($_POST["length"])){
            echo "Length of the string is: " . string_length($string);
    }
   else if(isset($_POST["reverse"])){
       echo "Reverse string is: " . reverse_string($string);
    }
   else if(isset($_POST["uppercase"])){
       echo "Uppercase string is: " . uppercase_string($string);
   }
   else if(isset($_POST["lowercase"])){
       echo "Lowercase string is: " . lowercase_string($string);
   }
   else if(isset($_POST["trimming"])){
       echo "Trimming string is: " . trimming($string);
   }
   else if(isset($_POST["Exploding"])){
       echo "Exploded string is: ";
       print_r(explode_string($string));
   }
   else if(isset($_POST["Imploding"])){
       echo "Imploded string is: " ;
       echo implode_string($string);
   }
   else if(isset($_POST["Replace"])){
       $search = $_POST["search"];
       $replacement = $_POST["replacement"];
       echo "Replaced string is: " . string_replace($search, $replacement, $string);
   }
   else if(isset($_POST["Substring"])){
       $start = $_POST["Start"];
       $length = $_POST["Length"];
       echo "Substring is: " . substring($string, $start, $length);
   }
   else if(isset($_POST["Position"])){
       $needle = $_POST["needle"];
       echo "Position is: " . string_pos($string, $needle);
   }
   else if(isset($_POST["Repeat"])){
       $times = $_POST["times"];
       echo "Repeated string is: " . string_repeat($string, $times);
   }
   else if(isset($_POST["Upper_First"])){
       echo "Upper first string is: " . upper_first($string);
   }
   else if(isset($_POST["Lower_First"])){
       echo "Lower first string is: " . lower_first($string);
   }
   else if (isset($_POST["Sum"])){
       echo "Sum is: " . Sum($string);
   }
   else if(isset($_POST["factorial"])){
       echo "Factorial is: " . factorial($string);
   }
   else if(isset($_POST["Word_Wrap"])){
       $width = $_POST["width"];
       $break = $_POST["break"];
       $cut = isset($_POST["cut"]);
       echo "Word Wrapped string is: " . word_wrap($string, $width, $break, $cut);
   }
   else{
       echo "Please enter a string";
   }
}
if($_SERVER["REQUEST_METHOD"] === "GET"){
    $filename = $_GET["filename"];
    if($filename == null || $filename == ""){
        echo "Please enter a filename";
    }
    else if (isset($_GET["get_content"])){
        echo "Content of the file is: " . get_content($filename);
    }
    else if(isset($_GET["put_content"])){
        $content = $_GET["content"];
        put_content($filename, $content);
        if(put_content($filename, $content) === true){
            echo "Content has been written to the file successfully";
        }
        else{
            echo "Error while writing content to the file";
        }
        }
     else{
         echo "Please enter a filename";
     }
}

?>
<body style=" background-color: rgba(189,168,98,0.94); height: 100vh;">
<div style="display: flex; justify-content: space-evenly; align-items: center;" >
<div>
<h1>String Functions</h1>
<form method="post">
    <input type="text" name="string"> <br> <br>
    <input type="submit" value="Length" name="length">
    <input type="submit" value="Reverse" name="reverse">
    <input type="submit" value="Uppercase" name="uppercase">
    <input type="submit" value="Lowercase" name="lowercase"> <br> <br>
    <input type="submit" value="Trim" name="trimming">
    <input type="submit" value="Explode" name="Exploding">
    <input type="submit" value="Implode" name="Imploding"> <br> <br>
    <input type="text" placeholder="Replacement" name="replacement">
    <input type="text" placeholder="Search" name="search">
    <input type="submit" value="Replace" name="Replace"> <br> <br>
    <input type="text" placeholder="Start" name="Start">
    <input type="text" placeholder="Length" name="Length">
    <input type="submit" value="Substring" name="Substring"> <br> <br>
    <input type="text" placeholder="Needle" name="needle">
    <input type="submit" value="Position" name="Position"> <br> <br>
    <input type="text" placeholder="Times" name="times">
    <input type="submit" value="Repeat" name="Repeat"> <br> <br>
    <input type="submit" value="Upper First" name="Upper_First">
    <input type="submit" value="Lower First" name="Lower_First"> <br> <br>
    <input type="submit" value="Sum" name="Sum">
    <input type="submit" value="factorial" name="factorial"> <br> <br>
    <input type="text" placeholder="Width" name="width">
    <input type="text" placeholder="Break" name="break">
    <input type="checkbox" name="cut" value="1"> Cut &nbsp;
    <input type="submit" value="Word Wrap" name="Word_Wrap">
</form>
   </div>

<div>
<h1>File Functions</h1>
<form method="get">
    <input type="text" name="filename" placeholder="Enter File Path / Filename"> <br> <br>
    <input type="submit" name="get_content" value="Get Content"> <br> <br>
    <input type="text" name="content" placeholder="Enter Content">
    <input type="submit" name="put_content" value="Put Content"> <br> <br>

</form>
</div>
</div>

</body>

