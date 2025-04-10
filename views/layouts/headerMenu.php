<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LINK GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Actor&family=Allura&family=Amatic+SC:wght@400;700&family=Archivo+Narrow:ital,wght@0,400..700;1,400..700&family=Belleza&family=Cinzel:wght@400..900&family=Kings&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Lexend+Giga:wght@100..900&family=Lexend+Mega:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- LINK CSS -->
    <link rel="stylesheet" href="resources/css/main.css">
<title> <?= $data['nav']["titrePage"] ?> </title>
</head>
<body class="roboto">
<nav class="menu__principal">
    <a href="#"><img src="resources/img/logo.webp" alt="logo"></a>
    <div class="menu__principal_pages">
        <a href="<?= $data['nav']["lien1"] ?>"><?= $data['nav']["nav1"] ?></a>
        <a href="#"></a>
        <a href="<?= $data['nav']["lien2"] ?>"><?= $data['nav']["nav2"] ?></a>
        <a href="<?= $data['nav']["lien3"] ?>"><?= $data['nav']["nav3"] ?></a>
    </div>
</nav>
