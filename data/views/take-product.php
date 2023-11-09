<!-- Prisijunges vartotojas. Paimti medziagas-->

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

        $newTakenAmount = $_POST['taken_amount'];


        if (
            isset($_POST['product_id']) &&
            isset($_POST['taken_amount']) && preg_match('/^\d{1,20}$/', $_POST['taken_amount'])
        ) {
            $productID = $_POST['product_id'];

            $takenExists = "SELECT id FROM taken_products WHERE user_id = $userSession AND product_id = $productID";
            $productCount = "SELECT amount FROM products WHERE id = $productID";
            $sqlUpdateProducts = "UPDATE products SET amount = amount - $newTakenAmount WHERE id = $productID";
            $sqlInsertTakenProducts = "INSERT INTO taken_products (taken_amount, user_id, product_id) VALUES ('$newTakenAmount', $userSession, $productID)";
            $sqlUpdateTakenProducts = "UPDATE taken_products SET taken_amount = taken_amount + $newTakenAmount WHERE user_id = $userSession AND product_id = $productID";

            if ($db->query($productCount)->fetch_row()[0] < $newTakenAmount) {
                echo 'Nepakankamas prekių likutis';
                http_response_code(500);
                exit;
            }

            if ($db->query($takenExists)->num_rows > 0) {
                $takenAction = $db->query($sqlUpdateTakenProducts);
            } else {
                $takenAction = $db->query($sqlInsertTakenProducts);
            }

            if ($db->query($sqlUpdateProducts) === TRUE && $takenAction === TRUE) {
                header('Location: ?page=home');
                exit;
            } else {
                echo 'Įvyko klaida išsaugant. Bandykite dar kartą';
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
                    <h3 class="mb-4 mt-4 text-center text-uppercase">Paimti medžiagas:</h3>



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