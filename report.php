<!DOCTYPE html>
<html lang="en">
<?php
function top10Words($text) {
    $text = strtolower($text);
    $text = preg_replace("/[^a-zA-Z\s]/", "", $text);
    $words = explode(" ", $text);
    $wordCounts = array_count_values($words);
    arsort($wordCounts);
    $top10 = array_slice($wordCounts, 0, 10, true);
    return $top10;
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Report Page</title>
</head>
<body class="bg-gray-100">

    <div class="text-center py-4 bg-blue-200">
        <h1 class="text-2xl font-bold">Image / Banner</h1>
    </div>

    <?php

            $publickey = openssl_pkey_get_public("file://publickey.pem");
            $privatekey = openssl_pkey_get_private("file://privatekey.pem");

            ?>

    <section class="flex justify-center my-8">
        <div class="bg-gray-300 text-center p-4 rounded shadow-lg mx-2">
            <h3 class="font-bold">Top Words Used</h3>
            <textarea id="Text_box" name="words" rows="8" cols="50" class="w-full p-2 mt-2 border rounded" placeholder="User enters text here.">
<?php
$words = $_POST['words'] ?? ''; // Use null coalescing operator to avoid undefined index error
$top10 = top10Words($words);
foreach ($top10 as $word => $count) {
    echo htmlspecialchars("$word: $count\n"); // Ensure output is HTML safe
}
?>
            </textarea>
            <br><br>
            <a href="index.html" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Go Back</a>
        </div>
        
        <div class="bg-gray-300 text-center p-4 rounded shadow-lg mx-2">
            <h3 class="font-bold">Original Text:</h3>
            <textarea id="Text_box_original" name="original_words" rows="8" cols="50" class="w-full p-2 mt-2 border rounded" placeholder="User enters text here.">
<?php echo htmlspecialchars($words); ?>
            </textarea>
            <h3 class="font-bold mt-4">Encrypted Text</h3>
            <textarea id="Text_box_encrypted" name="encrypted_words" rows="8" cols="50" class="w-full p-2 mt-2 border rounded" placeholder="Encrypted text appears here.">
<?php
if (isset($words) && !empty($words)) {
    openssl_private_encrypt($words, $encrypted, $privatekey);
    echo htmlspecialchars(base64_encode($encrypted)); // Display encrypted text in a readable format
}
?>
            </textarea>
        </div>
    </section>
</body>
</html>
