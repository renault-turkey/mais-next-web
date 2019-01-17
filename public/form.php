<?php require __DIR__ . "/../includes/include.php"; ?>
<?php
if (!empty($_POST)) {

    $name = $_POST['name'];
    $branch = $_POST['branch'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if ($phone && $name && $department && $branch && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['IDENTITY'] = [
            'name' => $name,
            'branch' => $branch,
            'department' => $department,
            'email' => $email,
            'phone' => $phone
        ];

        header("Location: /suggestion.php");
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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
            <div class="ribbon"></div>
            <main class="main mdl-layout__content">
                <div class="container mdl-grid">
                    <div class="mdl-cell mdl-cell--3-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
                    <div class="content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--6-col">
                        <form action="/form.php" method="POST" id='form'>  
                            <div class="mdl-card__title">
                                <h2 class="mdl-card__title-text">Kimlik Bilgileriniz</h2>
                            </div>
                            <div class="form-element">
                                <div class="input-label">İsminiz</div>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input name='name' class="mdl-textfield__input" type="text" id="name" required>
                                    <label class="mdl-textfield__label" for="name">Tam adınızı girin</label>
                                </div>
                            </div>

                            <div class="form-element">
                                <div>Çalıştığınız Konum</div>
                                <select name="branch" class="select2" style="width: 100%" required>
                                    <option>Şubenizi Seçin</option>
                                    <?php foreach ($_SESSION['LOOKUPS']['branch'] as $k => $v) : ?>
                                        <option value="<?= $k ?>"><?= $v ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br/><br/>
                                <!--
                                <div class="mdl-textfield mdl-js-textfield getmdl-select">
                                    <input type="text" class="mdl-textfield__input" id="branch" required>
                                    <input type="hidden" value="" name="branch">
                                    <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                    <label for="branch" class="mdl-textfield__label">Şubenizi seçin</label>
                                    <ul for="branch" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                <?php foreach ($_SESSION['LOOKUPS']['branch'] as $k => $v) : ?>
                                                        <li class="mdl-menu__item" data-val="<?= $k ?>"><?= $v ?></li>
                                <?php endforeach; ?>
                                    </ul>
                                </div>
                                -->
                            </div>

                            <div class="form-element">
                                <div class="input-label">Çalıştığınız Departman</div>
                                <div class="mdl-textfield mdl-js-textfield  mdl-autocomplete">
                                    <input class="mdl-textfield__input" type="text" name="department" id="department" required/>
                                    <label class="mdl-textfield__label" for="department">Departmanınızı girin</label>
                                </div>

                            </div>

                            <div class="mdl-card__title">
                                <h2 class="mdl-card__title-text">İletişim Bilgileriniz</h2>
                            </div>
                            <div class="form-element">
                                <div class="input-label">E-Posta</div>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="email" name="email" id="email" required>
                                    <label class="mdl-textfield__label" for="email">E-posta adresinizi girin</label>
                                </div>
                            </div>
                            <div class="form-element">
                                <div class="input-label">Telefon</div>
                                <div class="mdl-textfield mdl-js-textfield" id='container-input-celular'>
                                    <input class="mdl-textfield__input" type="text" id="phone"  name="phone"  required>
                                    <label class="mdl-textfield__label" for="phone">Telefon numaranızı girin</label>
                                </div>
                            </div>

                            <div class="mdl-card__actions">
                                <button id='submit-button' type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                                    DEVAM
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.select2').select2();
            });
            $("#phone").focus(function () {
                $(this).next().hide();
            });
            $("#phone").blur(function () {
                $(this).next().show();
            });
            $('#phone').on('change', function () {
                if ($(this).val() != '') {
                    $('#container-input-celular').addClass('is-dirty');
                } else {
                    $('#container-input-celular').removeClass('is-dirty');
                }
            });
            $('#phone').mask("0(999) 999 9999");
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

            window.addEventListener('load', function () {
                var autocomplete = new Ugosansh.Autocomplete.Component('#department', {
                    path: '/departments.php'
                });

                autocomplete.onChange(function (entity) {
                    // console.log(entity);
                });
            });

        </script>
    </body>
</html>
