<!-- Naujo vartotojo registracija -->

<?php

$message = false;
// Naujo vartotojo registravimas

$signupSuccess = false;

$enteredValues = array(
    'first_name' => '',
    'last_name' => '',
    'email' => '',
    'contact' => '',
    'photo' => ''
);
$errorFields = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $enteredValues = array(
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'contact' => $_POST['contact'],
        'photo' => $_POST['photo']
    );

    if (
        isset($_POST['first_name']) && strlen($_POST['first_name']) > 1 && strlen($_POST['first_name']) <= 20 &&
        isset($_POST['last_name']) && strlen($_POST['last_name']) > 1 && strlen($_POST['last_name']) <= 30 &&
        isset($_POST['email']) && strlen($_POST['email']) > 5 && strlen($_POST['email']) <= 50 && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&
        isset($_POST['contact']) && preg_match('/^\d{8}$/', $_POST['contact']) &&
        isset($_POST['photo']) &&
        isset($_POST['password']) && preg_match('/^(?=.*[!@#$%^&*])(?=.*\d).{8,20}$/', $_POST['password'])
    ) {

        try {
            $db->query(
                sprintf("INSERT INTO users (first_name, last_name, email, contact, photo, password) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')", $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['contact'], $_POST['photo'], md5($_POST['password']))
            );
            $signupSuccess = true;
            $_SESSION['signup_success'] = 'Registracija sėkminga. Galite <a class="login_note_link" href="?page=login">prisijungti</a>.';

            header('Location: ?page=signup');
            exit;
        } catch (Exception $error) {
            //sioje vietoje el.pasto patikra, jis unikalus
            if (!isset($_POST['email']) || strlen($_POST['email']) < 6 || strlen($_POST['email']) > 50 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || $error) {
                $errorFields['email'] = true;
            }
            $message = 'Įvestas el. paštas jau yra užregistruotas.';
        }
    } else {
        if (!isset($_POST['first_name']) || strlen($_POST['first_name']) < 2 || strlen($_POST['first_name']) > 20) {
            $errorFields['first_name'] = true;
        }
        if (!isset($_POST['last_name']) || strlen($_POST['last_name']) < 2 || strlen($_POST['last_name']) > 30) {
            $errorFields['last_name'] = true;
        }
        if (!isset($_POST['contact']) || !preg_match('/^\d{8}$/', $_POST['contact'])) {
            $errorFields['contact'] = true;
        }
        if (!isset($_POST['photo'])) {
            $errorFields['photo'] = true;
        }
        $message = 'Neteisingai suvesti duomenys.';
    }
}

?>

<div class="d-flex justify-content-center">
    <div class="login_form signup_form d-flex justify-content-center">
        <img class="login_teamwork signup_teamwork" src="./assets/teamwork.png" alt="teamwork">
        <div class="login_transparent">
            <form method="POST">
                <h3 class="login_heading text-center">SUKURTI PASKYRĄ:</h3>
                <div class="signup_frame d-flex">
                    <div>
                        <input type="text" class="login_input form-control mb-4 <?= isset($errorFields['first_name']) ? 'error' : '' ?>" placeholder="Įveskite savo vardą" name="first_name" value="<?= $enteredValues['first_name'] ?>" required>
                        <input type="text" class="login_input form-control mb-4 <?= isset($errorFields['last_name']) ? 'error' : '' ?> " placeholder="Įveskite savo pavardę" name="last_name" value="<?= $enteredValues['last_name'] ?>" required>

                        <div class="signup_form_contact">
                            <input type="text" class="login_input signup_input form-control mb-4 <?= isset($errorFields['contact']) ? 'error' : '' ?> " placeholder="Įveskite savo tel. numerį" id="contactid" name="contact" value="<?= $enteredValues['contact'] ?>" required>
                            <label for="contactid" class="signup_label">+(370) </label>
                        </div>
                        <input type="text" class="login_input form-control mb-4 <?= isset($errorFields['photo']) ? 'error' : '' ?> " placeholder="Įkelkite savo nuotrauką" name="photo" value="<?= $enteredValues['photo'] ?>" required>
                    </div>
                    <div>
                        <input type="text" class="login_input form-control mb-4 <?= isset($errorFields['email']) ? 'error' : '' ?> " placeholder="Įveskite savo el. pašto adresą" name="email" value="<?= $enteredValues['email'] ?>" required>
                        <input type="password" class="login_input form-control mb-4" placeholder="Sukurkite slaptažodį*" name="password" required>
                        <div class="mb-4 signup_alert">
                            <p>
                                * Slaptažodį turi sudaryti mažiausiai 8 ženklai<br />
                                * Į slaptažodį reikia įtraukti bent vienas skaičių ir simbolį<br />
                                * Maksimalus slaptažodžio ilgis 20 ženklų
                            </p>
                        </div>

                    </div>
                </div>

                <div class="signup_down_line d-flex">

                    <div class="m-0">
                        <button class="login_button signup_button" type="submit"><img src="./assets/check-large.png"></button>
                    </div>

                    <div class="signup_warning m-0">
                        <!-- Pranesimas, jei kazkas negerai -->
                        <?php if ($message) : ?>
                            <div class="signup_warning alert war_alert m-0" id="alertMessage">
                                <?= $message ?>
                            </div>
                        <?php endif; ?>

                        <!-- Pranesimas, jei registracija pavyko, lieka tame paciame puslapyje -->
                        <?php if ($signupSuccess || isset($_SESSION['signup_success'])) : ?>
                            <div class="alert success_alert">
                                <?php
                                echo $signupSuccess ? 'Registracija sėkminga. Galite <a class="login_note_link" href="?page=login">prisijungti</a>.' : $_SESSION['signup_success'];
                                ?>
                            </div>
                            <?php
                            // Pranesimo isvalymas
                            unset($_SESSION['signup_success']);
                            ?>
                        <?php endif; ?>
                    </div>
                </div>

                <h6 class="login_note mt-5 mb-5 text-reset">Jau turite paskyrą? <a class="login_note_link" href="?page=login">Prisijunkite čia</a></h6>
        </div>
        </form>
    </div>
</div>

<?php require_once 'footer.php' ?>