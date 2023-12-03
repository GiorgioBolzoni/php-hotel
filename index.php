<?php
$hotels = require('array.php');
// Filtri
$parkingFilter = isset($_GET['parking']) ? $_GET['parking'] : false;
$voteFilter = isset($_GET['vote']) ? $_GET['vote'] : false;

// Applico i filtri
$filteredHotels = array_filter($hotels, function ($hotel) use ($parkingFilter, $voteFilter) {
    return (!$parkingFilter || $hotel['parking']) && (!$voteFilter || $hotel['vote'] >= $voteFilter);
});
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">

    <title>PHP Hotel</title>
</head>

<body>



    <div class="container mt-5">
        <h1 class="text-center">PHP Hotel</h1>
        <!-- Form per i filtri -->
        <form class="mb-3">
            <div class="mb-3">
                <label for="parking" class="form-label">Parcheggio</label>
                <select id="parking" name="parking" class="form-select">
                    <option value="" <?php echo (!$parkingFilter ? 'selected' : ''); ?>>Tutti gli hotel</option>
                    <option value="1" <?php echo ($parkingFilter && $parkingFilter == '1' ? 'selected' : ''); ?>>Con
                        parcheggio</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="vote" class="form-label">Voto</label>
                <select id="vote" name="vote" class="form-select">
                    <option value="" <?php echo (!$voteFilter ? 'selected' : ''); ?>>Tutti gli hotel</option>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php echo ($voteFilter && $voteFilter == $i ? 'selected' : ''); ?>>
                            <?php echo $i; ?> stelle e più
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtra</button>
        </form>

        <!-- Tabella Bootstrap per visualizzare gli hotel -->
        <table class="table">
            <thead id="table-head">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Parcheggio</th>
                    <th scope="col">Voto</th>
                    <th scope="col">Distanza al centro</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php foreach ($filteredHotels as $hotel): ?>
                    <tr>
                        <td>
                            <?php echo $hotel['name']; ?>
                        </td>
                        <td>
                            <?php echo $hotel['description']; ?>
                        </td>
                        <td>
                            <?php echo $hotel['parking'] ? 'Sì' : 'No'; ?>
                        </td>
                        <td>
                            <?php echo $hotel['vote']; ?>
                        </td>
                        <td>
                            <?php echo $hotel['distance_to_center'];
                            ?><span> km</span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="js/script.js" type="module"></script>
</body>

</html>