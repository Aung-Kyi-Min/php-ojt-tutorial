<?php
session_start();
if (isset($_POST['submit'])) {
    $get_folder = $_POST['folder'];
    $uploadpath = ("images/" . $get_folder);
    $max_size = 2000;
    $allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png', 'jpeg');
    if (!is_dir($uploadpath)) {
        mkdir($uploadpath);
        if (isset($_FILES['image']) && strlen($_FILES['image']['name']) > 1) {
            $uploaddir = $uploadpath . "/" . basename($_FILES['image']['name']);
            $sepext = explode('.', strtolower($_FILES['image']['name']));
            $type = end($sepext);
            $err = '';
            if (!in_array($type, $allowtype)) {
                $err .= 'Fails: <b>' . $_FILES['image']['name'] . 'incorrect file type.';
            }
            if ($_FILES['image']['size'] > $max_size * 1000) {
                $err .= 'Max size of image: ' . $max_size . ' KB.';
            }
            if ($err == '') {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir)) {
                    $_SESSION['message'] = "Upload Image Successfully...";
                    //var_dump($uploaddir);
                    echo "<script>window.location='index.php'</script>";
                    exit(0);
                } else {
                    $_SESSION['message'] = "Fail Upload Image....";
                }

                echo "<script>window.location='index.php'</script>";
                exit(0);
            } else {
                echo $err;
            }

        }
    } else {

        if (isset($_FILES['image']) && strlen($_FILES['image']['name']) > 1) {
            $uploaddir = $uploadpath . "/" . basename($_FILES['image']['name']);
            $sepext = explode('.', strtolower($_FILES['image']['name']));
            $type = end($sepext);
            $err = '';

            if (!in_array($type, $allowtype)) {
                $err .= 'Fails: <b>' . $_FILES['image']['name'] . 'incorrect file type.';
            }
            if ($_FILES['image']['size'] > $max_size * 1000) {
                $err .= 'Max size of image: ' . $max_size . ' KB.';
            }

            if ($err == '') {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir)) {
                    $_SESSION['message'] = "Upload Image Successfully...";
                    //var_dump($uploaddir);
                    echo "<script>window.location='index.php'</script>";
                    exit(0);
                } else {
                    $_SESSION['message'] = "Fail Upload Image....";
                }

                echo "<script>window.location='index.php'</script>";
                exit(0);
            } else {
                echo $err;
            }

        }
    }
}
function show()
{
    $files = glob('images/*/*.{jpg,png,jpeg}', GLOB_BRACE); //find file path
    foreach ($files as $file) {
        $folder = basename($file); //file name from path
        echo "<div class='col-md-4 mb-1'>
            <img src='$file' class='img-thumbnail w-100 h-50  border-dark'>
            <p class='mt-0 fs-5 text-center'>$folder</p><br>
            <p class='mt-0 w-30 ms-2 me-2'><a href='$file' class=' '>localhost/Tutorial_06/$file</a></p>
            <form method='post' class='w-100'>
              <input type='hidden' name='file_path' value='$file'>
              <input type='submit' class='btn btn-danger w-100 text-dark' name='delete' value='Delete'>
            </form>
            </div>";
    }
    if (isset($_POST['delete'])) {
        $img = $_POST['file_path'];
        $delete = unlink($img);
        if ($delete) {
            $_SESSION['message'] = "Image has been deleted....";
            echo "<script>window.location='index.php'</script>";
        }
    }
}
