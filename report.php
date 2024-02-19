<!DOCTYPE html>
<html lang="en">
<?php
function top10Words($text)
{
    // Convert text to lowercase and remove punctuation
    $text = strtolower($text);
    $text = preg_replace("/[^a-zA-Z\s]/", "", $text);

    // Split text into words
    $words = explode(" ", $text);

    // Count occurrences of each word
    $wordCounts = array_count_values($words);

    // Sort words by frequency
    arsort($wordCounts);

    // Take top 10 words
    $top10 = array_slice($wordCounts, 0, 10, true);

    return $top10;
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Report Page</title>
</head>

<body>

    <div class="headerdiv">
        <h1>Image / Banner</h1>
    </div>

    <section class="container">
        <div class="leftdiv">
    <h3>Top Words Used</h3>
            <textarea id="Text_box" name="words" rows="8" cols="50" placeholder="User enters text here.">

      <?php
        $words = $_POST['words'];
        $top10 = top10Words($words);
        foreach ($top10 as $word => $count) {
            echo "$word: $count\n";
        }
        ?>
      </textarea>

      <br>
      <br>

      <a class="back-btn" href="index.html">Go Back</a>

        </div>
        <div class="rightdiv">
            <?php

            $publickey = openssl_pkey_get_public("file://publickey.pem");
            $privatekey = openssl_pkey_get_private("file://privatekey.pem");

            ?>

            <h3>Original Text:</h3>

            <textarea id="Text_box" name="words" rows="8" cols="50" placeholder="User enters text here.">
            <?php
            echo $words;
            // $mytext = "The quick brown fox jumps over the lazy dog";

            // echo "<br><br>" . $words . "<br><br>";
            ?>
    
        </textarea>
            <h3>Encrypted Text</h3>
            <textarea id="Text_box" name="words" rows="8" cols="50" placeholder="User enters text here.">
            <?php
            openssl_private_encrypt($words, $encrypted, $privatekey);
            echo $encrypted;

            // openssl_public_decrypt($encrypted, $decrypted, $publickey);
            // echo $decrypted;
            ?>
    
        </textarea>

        </div>
    </section>



</body>

</html>