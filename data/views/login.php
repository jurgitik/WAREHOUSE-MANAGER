<!-- Pirmas puslapis. Registruoto vartotojo prisijungimas -->

<?php

$message = false;

$enteredValues = array(
    'email' => ''
);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $enteredValues = array(
        'email' => $_POST['email']
    );

    if (
        isset($_POST['email']) && strlen($_POST['email']) > 5 && strlen($_POST['email']) <= 50 && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&
        isset($_POST['password']) && strlen($_POST['password']) > 7 && strlen($_POST['password']) <= 20
    ) {

        $enteredPassword = md5($_POST['password']);

        $result = $db->query(
            // sprintf("SELECT id, email FROM users WHERE email = '%s' AND password = '%s'", $_POST['email'], $_POST['password'])
            sprintf("SELECT id, email, first_name, last_name, password, is_admin, position, photo, created_at FROM users WHERE email = '%s'", $_POST['email'])

        );

        if ($result->num_rows) {
            $user = $result->fetch_assoc();

            $storedHashedPassword = $user['password'];

            if ($enteredPassword === $storedHashedPassword) {

                $_SESSION['userid'] = $user['id'];
                $_SESSION['name'] = $user['first_name'];
                $_SESSION['surname'] = $user['last_name'];
                $_SESSION['isadmin'] = $user['is_admin'];
                $_SESSION['user_position'] = $user['position'];
                $_SESSION['user_photo'] = $user['photo'];
                $_SESSION['user_from'] = $user['created_at'];

                $_SESSION['loggedin'] = true;
                header('Location: ?page=home');
                exit;
            } else {
                $message = 'Neteisingas el. paštas arba slaptažodis.';
            }
        } else {
            $message = 'Neteisingai suvesti duomenys.';
        }
    } else {
        $message = 'Įveskite teisingą el.paštą ir slaptažodį.';
    }
}
?>
<div class="login_box d-flex">
    <div class="login_form d-flex justify-content-center">
        <img class="login_teamwork" src="./assets/teamwork.png" alt="teamwork">
        <div class="login_transparent">
            <form method="POST">
                <h3 class="login_heading text-center">PRISIJUNGIMAS</h3>
                <input type="text" class="login_input form-control mb-4" placeholder="Įveskite el. pašto adresą" name="email" value="<?= $enteredValues['email'] ?>" required>
                <input type="password" class="login_input form-control mb-4" placeholder="Įveskite slaptažodį" name="password" required>

                <div class="login_down_line d-flex">
                    <div class="m-0">
                        <button class="login_button" type="submit"><img src="./assets/entry.png"></button>
                    </div>

                    <div class="login_warning m-0">
                        <!-- Pranesimas, jei kazkas negerai -->
                        <?php if ($message) : ?>
                            <div class="alert war_alert" id="alertMessage">
                                <?= $message ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

                <h6 class="login_note mb-5 text-reset">Naujo darbuotojo <a class="login_note_link" href="?page=signup">registracija čia</a></h6>
        </div>
        </form>
    </div>
</div>

<?php require_once 'footer.php' ?>