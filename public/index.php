<?php require __DIR__ . "/../includes/include.php"; ?>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
        <title>Fikir Atölyesi</title>

        <!-- Add to homescreen for Chrome on Android -->
        <meta name="mobile-web-app-capable" content="yes">
        <!-- Add to homescreen for Safari on iOS -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="Fikir Atölyesi">

        <!-- Tile icon for Win8 (144x144 + tile color) -->
        <meta name="msapplication-TileColor" content="#ffd555">


        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="/css/styles.css">
        <link rel="stylesheet" href="/css/getmdl-select.min.css">
        <link rel="stylesheet" href="/css/mdl-autocomplete.css">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.orange-deep_orange.min.css" /> 
    </head>
    <body>
        <div class="layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
            <div class="ribbon"></div>
            <main class="main mdl-layout__content">
                <div class="container mdl-grid">
                    <div class="mdl-cell mdl-cell--3-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
                    <div class="content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--6-col">
                        <div>
                            <img alt='Logo' src='images/logo.png' />
                        </div>
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text"><?= $_SESSION['LOOKUPS']['text']['caption'] ?></h2>
                        </div>
                        <p><?= nl2br($_SESSION['LOOKUPS']['text']['home']); ?></p>
                        <div style="text-align: center">
                            <img alt='Home' src='/images/home.png' />
                        </div>
                        <div style="text-align: center;padding-top: 40px">
                            <button onclick="window.location = '/form.php'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                                DEVAM
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>   
        <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <script src="/js/getmdl-select.min.js"></script>
        <script src="/js/mdl-autocomplete.js"></script>
    </body>
</html>
