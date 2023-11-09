<!-- Prisijunges vartotojas. Sunaudotos medziagos-->

<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) : ?>

    <?php

    $message = false;

    $userSession = isset($_SESSION['userid']) ? $_SESSION['userid'] : 0;

    $enteredValues = array(
        'product_id' => '',
        'taken_amount' => ''
    );

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $enteredValues = array(
            'product_id' => $_POST['product_id'],
            'taken_amount' => $_POST['taken_amount']
        );

        $enteredAmount = $_POST['taken_amount'];

        if (
            isset($_POST['product_id']) &&
            isset($_POST['taken_amount']) && preg_match('/^\d{1,20}$/', $_POST['taken_amount']) &&
            $_POST['taken_amount'] >= 0
        ) {
            $productID = $_POST['product_id'];

            $sqlLeftProducts = "UPDATE taken_products SET taken_amount = taken_amount - $enteredAmount WHERE product_id = $productID AND user_id = $userSession";

            try {
                $db->query($sqlLeftProducts);
                header('Location: ?page=home');
                exit;
            } catch (\Exception $e) {
                if ($e->getCode() === 1690) {
                    echo 'Nepakankamas medziagu likutis';
                } else {
                    echo 'Įvyko klaida išsaugant. Bandykite dar kartą';
                }
                http_response_code(500);
            }
        } else {

            $message = 'Įvyko klaida validuojant. Bandykite dar kartą';
            http_response_code(500);
        }
        exit;
    }

    ?>


    <a href="?page=home"><img class="add_product_back" src="./assets/back-large.png" alt="Grįžti atgal"></a>
    <div class="d-flex justify-content-center mt-2 mb-4">
        <div class="login_form take_product_form">
            <img class="login_teamwork take_product_teamwork" src="./assets/teamwork.png" alt="teamwork">
            <div class="d-flex login_transparent">
                <form method="POST">
                    <h3 class="mb-4 mt-4 text-center text-uppercase">Sunaudotos medžiagos:</h3>

                    <select class="login_input take_product_input form-control mb-4" name="product_id" required>
                        <option value="" disabled selected>Pasirinkite medžiagą:</option>
                        <?php foreach ($products as $product) : ?>
                            <option value="<?= $product['id'] ?>" <?php if ($product['id'] == $enteredValues['product_id']) echo 'selected' ?>><?= $product['name'] ?> | <?= $product['description'] ?> </option>
                        <?php endforeach ?>
                    </select>

                    <div class="d-flex">
                        <input type="number" class="login_input add_product_input form-control mb-4" placeholder="Įveskite medžiagų kiekį" name="taken_amount" value="<?= $enteredValues['taken_amount'] ?>" required>

                    </div>

                    <?php if ($message) : ?>
                        <div class="alert war_alert">
                            <?= $message ?>
                        </div>
                    <?php endif; ?>

                    <div class="d-flex justify-content-center"><button class="login_button signup_button" type="submit"><img src="./assets/check-large.png"></button></div>

                </form>
            </div>
        </div>
    </div>




<?php endif ?>

<?php require_once 'footer.php' ?>