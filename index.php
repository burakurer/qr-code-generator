<?php
$settings = [
    'max-character' => 200,
    'qr-height' => 350,
    'qr-width' => 350
];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="R6wM">
    <meta name="description" content="R6wM - QR Code Generator">
    <title>R6wM - QR Code Generator</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link href="./assets/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="./assets/form-validation.css" rel="stylesheet">
</head>

<body class="bg-light" cz-shortcut-listen="true">
<div class="container">
    <main>
        <div class="mt-2 py-5 text-center">
            <span class="display-3">QR Code Generator</span>
            <mark>v1.1</mark>
        </div>

        <div class="row">
            <form class="needs-validation" novalidate="" method="post">
                <div class="col-auto">
                    <div class="input-group">
                        <input type="text" name="qrtext" class="form-control"
                               placeholder="enter text (max <?= $settings['max-character']; ?> character)" required="">
                        <button type="submit" class="btn btn-secondary">oluştur</button>
                    </div>
                </div>
            </form>
        </div>
        <?php
        if (@trim($_POST['qrtext'])) {
            $qr = htmlspecialchars(trim(strip_tags($_POST['qrtext']))); // malicious codes cleared
            if (!empty($qr) && strlen($qr) <= $settings['max-character']) {
                function qrCode($s)
                {
                    global $settings;
                    $u = 'https://chart.googleapis.com/chart?chs=%dx%d&cht=qr&chl=%s';
                    $url = sprintf($u, $settings['qr-width'], $settings['qr-height'], $s);
                    return $url;
                }

                $qr = qrCode($qr);
                ?>
                <div class="row justify-content-md-center">
                    <div class="col-sm-6 mt-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Original text</span>
                                    <span class="form-control"
                                          aria-describedby="inputGroup-sizing-default"><?= strip_tags(trim($_POST['qrtext'])); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="<?= $qr; ?>"
                                     class="rounded mx-auto d-block">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                echo "The entered value is blank, invalid or exceeds the " . $settings['max-character'] . " character limit!";
            }
        }
        ?>
    </main>
    <footer class="my-4 text-muted text-center text-small">
        <p class="mb-1">
            <mark class='text-muted'>
                Developed by <i class="bi bi-heart-fill"></i>
                <a class="text-muted" href="https://mami.wtf">R6wM</a>
            </mark>
        </p>
    </footer>
</div>

<script src="./assets/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
<script src="./assets/form-validation.js"></script>

</body>
</html>