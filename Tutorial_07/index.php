<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial_07</title>
    <link rel="shortcut icon" href="qr-code.png" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="libs/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <main class="row d-flex aligns-items-center mt-5 justify-content-center  w-75 mx-auto">
            <div class="card border mt-5 w-50">
                <div class="card-header"><h3 class="text-center  my-3">- QRCode Generator -</h3></div>
                <div class="card-body mt-3 w-100">
                    <form id="new-form"  method="post" action="" class="needs-validation" novalidate >
                        <div class="mb-3">
                            <label for="">QR Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" required>
                            <div class="invalid-feedback">Username is required.</div>
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-info w-100" name="submit">Generate</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php include 'generate.php';?>
            <div class="card mt-5 w-100">
                <div class="card-header"><h4 class="">QRList</h4></div>
                <div class="card-body">
                    <div class="row">
                        <?php
$i = 0;
if (count(glob("$path/*")) > 0) {
    if (is_dir($path)) {
        if ($dh = opendir($path)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != ".." && $file != 'index.php') {
                    echo '<div class="col-md-4 mb-3 text-center">';
                    echo '<img class="img-thumbnail w-75 border-dark" src="' . $path . $file . '" alt=""  > <br>';
                    echo $file;
                    echo '</div>';
                    if ($i >= 5) {
                        break;
                    }
                    $i++;
                }
            }
            closedir($dh);
        }
    }
}
?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="libs/bootstrap.bundle.min.js"></script>
        <script src="libs/bootstrap.min.js"></script>
        <script>
            (() => {
                'use strict'
                const forms = document.querySelectorAll('.needs-validation')
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
            })()
        </script>
    </body>
    </html>
