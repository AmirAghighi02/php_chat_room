<?php
session_start();
include_once '../back/validation.php';

$jsonArray = [];

if (is_file('userData.json')) {
    $jsonArray = json_decode(file_get_contents('userData.json'), true);
}

if (isset($_POST['submit'])) {

    $user = [
        'userName' => $_POST["userName"],
        'name' => $_POST["name"],
        'email' => $_POST["email"],
        'password' => $_POST["password"],
        'admin'=>false,
        'blocked'=>false
    ];

    $errors = checkSignUpErrors($user);

    if (!$errors) {
        $jsonArray[] = $user;
        file_put_contents('userData.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
    } else {
        $htmlErrors = "";
        foreach ($errors as $error) {
            if ($error != "") {
                $htmlErrors .= "<label class='text-danger'>" . $error . "</label>";
            }
        }

    }
}

if (isset($_POST['Login'])) {
    if ($_POST['username-log'] != "" && $_POST['password-log'] != "") {
        if (login($_POST['username-log'], $_POST['password-log'])) {
            $_SESSION['user'] = [$_POST['username-log'], $_POST['password-log']];
            header('location:mainPage.php');
            die();
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                <form class="mx-1 mx-md-4" action="" method="post">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="form3Example3c" class="form-control"
                                                   name="userName"/>
                                            <label class="form-label" for="form3Example3c">User name</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="form3Example1c" class="form-control" name="name"/>
                                            <label class="form-label" for="form3Example1c"> Name</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" id="form3Example3c" class="form-control" name="email"/>
                                            <label class="form-label" for="form3Example3c"> Email</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="form3Example4c" class="form-control"
                                                   name="password"/>
                                            <label class="form-label" for="form3Example4c">Password</label>
                                        </div>
                                    </div>
                                    <div class="form-check d-flex justify-content-center mb-5">

                                        <label class="form-check-label" for="form2Example3">
                                            Already have an account:
                                            <a href="signin.php">Sign in</a>
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" name="submit" class="btn btn-primary btn-lg">Register
                                        </button>
                                    </div>
                                </form>
                                <div class="d-flex flex-column gap-3">
                                    <?php
                                    if (@$htmlErrors != ""){
                                        echo @$htmlErrors;
                                    }?>
                                </div>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img
                                    src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                    class="img-fluid" alt="Sample image">
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>
</html>