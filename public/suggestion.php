<?php require __DIR__ . "/../includes/include.php"; ?>
<?php
if (empty($_SESSION['IDENTITY'])) {
    header("Location: /index.php");
    exit;
}
if (!empty($_POST)) {
    $type = $_POST['type'];
    $subject = $_POST['subject'];
    $suggestion = $_POST['suggestion'];

    if ($type && $subject && $suggestion) {
        require __DIR__ . "/../includes/func.php";

        $files = [];
        foreach ($_FILES as $f) {
            if ($f['tmp_name']) {
                $files[] = uploadBlob($f['tmp_name'], $f['name']);
            }
        }

        $post = [
            "Isim" => $_SESSION['IDENTITY']['name'],
            "Konum" => $_SESSION['IDENTITY']['branch'],
            "Departman" => $_SESSION['IDENTITY']['department'],
            "Eposta" => $_SESSION['IDENTITY']['email'],
            "Telefon" => $_SESSION['IDENTITY']['phone'],
            "OneriOzet" => $subject,
            "OneriDetay" => $suggestion,
            "OneriTipi" => $type
        ];

        if (!empty($files)) {
            $post['Eklentiler'] = [];
            foreach ($files as $f) {
                $post['Eklentiler'][] = ['url' => $f];
            }
        }

        postSuggestion($post);

        $_SESSION = [];
        session_unset();
        session_destroy();
        header("Location: /done.php");
        exit;
    }
}
?>
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
                        <form action="/suggestion.php" method="POST" id='form' enctype="multipart/form-data">  
                            <div class="mdl-card__title">
                                <h2 class="mdl-card__title-text">Öneriniz</h2>
                            </div>
                            <div class="form-element">
                                <div class="input-label">Öneri Tipi</div>
                                <div class="mdl-textfield mdl-js-textfield getmdl-select">
                                    <input type="text" class="mdl-textfield__input" id="type" required>
                                    <input type="hidden" value="" name="type">
                                    <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                    <label for="type" class="mdl-textfield__label">Öneri Tipini Seçin</label>
                                    <ul for="type" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                        <?php foreach ($_SESSION['LOOKUPS']['suggestionType'] as $k => $v) : ?>
                                            <li class="mdl-menu__item" data-val="<?= $k ?>"><?= $v ?></li>
<?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-element">
                                <div class="input-label">Öneri Başlığı</div>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="text" name="subject" id="subject" required>
                                    <label class="mdl-textfield__label" for="subject">Önerinizin kısa özeti</label>
                                </div>
                            </div>

                            <div class="form-element">
                                <div class="input-label">Önerinizin Detayı</div>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <textarea class="mdl-textfield__input" type="text" name='suggestion' id="suggestion" required/></textarea>
                                    <label class="mdl-textfield__label" for="suggestion">Önerinizi birkaç cümlede detaylandırın.</label>
                                </div>
                            </div>

                            <div class="form-element">
                                <div class="input-label"><a href="#">Dosya Ekle</a></div>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                                    <input class="mdl-textfield__input" placeholder="Dosya Seçilmedi" type="text" id="ATT1" readonly />
                                    <div class="mdl-button mdl-button--icon mdl-button--file">
                                        <i class="material-icons">attach_file</i>
                                        <input type="file" name="att1" id="fatt1" onchange="document.getElementById('ATT1').value = this.files[0].name;" />
                                    </div>
                                </div>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                                    <input class="mdl-textfield__input" placeholder="Dosya Seçilmedi" type="text" id="ATT2" readonly />
                                    <div class="mdl-button mdl-button--icon mdl-button--file">
                                        <i class="material-icons">attach_file</i>
                                        <input type="file" name="att2" id="fatt2" onchange="document.getElementById('ATT2').value = this.files[0].name;" />
                                    </div>
                                </div>
                            </div>

                            <div class="mdl-card__actions">
                                <button id='submit-button' type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                                    ÖNERİNİ YOLLA
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>   
        <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <script src="/js/getmdl-select.min.js"></script>
        <script src="/js/mdl-autocomplete.js"></script>
        <script
            src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

        <script type="text/javascript">

                                            /**
                                             * Check the validity state and update field accordingly.
                                             *
                                             * @public
                                             */
                                            MaterialTextfield.prototype.checkValidity = function () {
                                                if (this.input_.validity.valid) {
                                                    this.element_.classList.remove(this.CssClasses_.IS_INVALID);
                                                } else {
                                                    if (this.element_.getElementsByTagName('input')[0].value.length > 0) {
                                                        this.element_.classList.add(this.CssClasses_.IS_INVALID);
                                                    }
                                                }
                                            };

        </script>
    </body>
</html>
