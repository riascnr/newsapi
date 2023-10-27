<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .news-column {
            max-height: 100%; /* Menetapkan tinggi maksimum untuk semua kolom */
        }
    </style>
    <title>Presentasi Pertemuan 6</title>
</head>
<body>

<div class="container">
    <br>
    <h1 align="Center">Top Technology Headlines</h1>
    <br>

    <?php

    $country = "us";
    $category = "technology";
    $apiKey = "e378c97bb27d4dca800caa3565748cfa ";
    $alamatAPI = "https://newsapi.org/v2/top-headlines?country={$country}&category={$category}&apiKey={$apiKey}";

    try {
        $data = @file_get_contents($alamatAPI);

        if ($data === false) {
            throw new Exception('Gagal mengambil data dari API.');
        }

        # parsing variabel $data ke dalam array
        $dataBerita = json_decode($data);

        if ($dataBerita === null || !property_exists($dataBerita, 'status') || $dataBerita->status !== "ok") {
            throw new Exception('Data berita tidak valid.');
        }

        echo '<div class="row">';
        # tampilkan menggunakan perulangan
        foreach ($dataBerita->articles as $berita) {
            echo '<div class="col-md-4 news-column">'; // Tambahkan kelas "news-column"
            echo '<div class="card">';
            if ($berita->urlToImage) {
                echo "<img class='card-img-top' src='{$berita->urlToImage}' alt='News Image'>";
            }
            echo '<div class="card-body">';
            echo "<h5 class='card-title'><a href='{$berita->url}'>{$berita->title}</a></h5>";
            echo "<p class='card-text'>{$berita->description}</p>";
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>'; // Tutup baris (row)
    } catch (Exception $e) {
        $errorMessage = 'Terjadi kesalahan saat mengambil data berita: ' . $e->getMessage();
        echo '<script>alert("' . $errorMessage . '");</script>';
    }
    ?>

</div>
</body>
</html>
