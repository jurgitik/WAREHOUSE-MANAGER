<!-- Prisijunges admin vartotojas. Prideti nauja medziaga-->

<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) : ?>


    <?php

    $message = false;

    $userSession = isset($_SESSION['userid']) ? $_SESSION['userid'] : 0;

    $enteredValues = array(
        'name' => '',
        'factory_code' => '',
        'description' => '',
        'image' => '',
        'amount' => '',
        'price' => '',
        'category' => '',
        'subcategory' => '',
        'manufacturer' => '',
        'supplier' => '',
        'measurement' => ''
    );

    $errorFields = array();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $enteredValues = array(
            'name' => $_POST['name'],
            'factory_code' => $_POST['factory_code'],
            'description' => $_POST['description'],
            'image' => $_POST['image'],
            'amount' => $_POST['amount'],
            'price' => $_POST['price'],
            'category' => $_POST['category'],
            'subcategory' => $_POST['subcategory'],
            'manufacturer' => $_POST['manufacturer'],
            'supplier' => $_POST['supplier'],
            'measurement' => $_POST['measurement']
        );

        if (
            isset($_POST['name']) && strlen($_POST['name']) > 0 && strlen($_POST['name']) <= 200 &&
            isset($_POST['factory_code']) && strlen($_POST['factory_code']) > 0 && strlen($_POST['factory_code']) <= 50 &&
            isset($_POST['description']) && strlen($_POST['description']) > 0 && strlen($_POST['description']) <= 50 &&
            isset($_POST['image']) && strlen($_POST['image']) > 0 && strlen($_POST['image']) <= 1000 &&
            isset($_POST['amount']) && preg_match('/^\d{1,20}$/', $_POST['amount']) &&
            isset($_POST['price']) && preg_match('/^((?!0$)([1-9]\d{0,3}(\.\d{2})?)|0|0\.\d{2})$/', $_POST['price']) &&
            isset($_POST['category']) &&
            isset($_POST['subcategory']) &&
            isset($_POST['manufacturer']) &&
            isset($_POST['supplier']) &&
            isset($_POST['measurement'])

        )
            try {
                $name = $db->real_escape_string($_POST['name']);
                $factoryCode = $db->real_escape_string($_POST['factory_code']);
                $description = $db->real_escape_string($_POST['description']);
                $result = $db->query(
                    sprintf(
                        "INSERT INTO products (name, factory_code, description, image, amount, user_id, category_id, subcategory_id, manufacturer_id, supplier_id, measure_unit_id, price, created_at, updated_at) VALUES ('%s', '%s', '%s', '%s','%s', %d, %d, %d, %d, %d, %d, '%s', NOW(), NOW())",
                        $name,
                        $factoryCode,
                        $description,
                        $_POST['image'],
                        $_POST['amount'],
                        $userSession,
                        $_POST['category'],
                        $_POST['subcategory'],
                        $_POST['manufacturer'],
                        $_POST['supplier'],
                        $_POST['measurement'],
                        $_POST['price']
                    )
                );
                if ($result) {
                    header('Location: ?page=home');
                    exit;
                } else {
                    $message = 'Įvyko klaida. Bandykite vėliau dar kartą';
                }
            } catch (Exception $error) {
                //sioje vietoje gamintojo kodo patikra, kodas unikalus
                if (!isset($_POST['factory_code']) || strlen($_POST['factory_code']) === 0 || strlen($_POST['factory_code']) > 50 || $error) {
                    $errorFields['factory_code'] = true;
                }
                $message = 'Medžiaga su tokiu gamintojo kodu jau egzistuoja.';
            }
        else {

            if (!isset($_POST['name']) || strlen($_POST['name']) === 0 || strlen($_POST['name']) > 200) {
                $errorFields['name'] = true;
            }
            if (!isset($_POST['description']) || strlen($_POST['description']) === 0 || strlen($_POST['description']) > 50) {
                $errorFields['description'] = true;
            }
            if (!isset($_POST['image']) || strlen($_POST['image']) === 0 || strlen($_POST['image']) > 1000) {
                $errorFields['image'] = true;
            }
            if (!isset($_POST['amount']) || !preg_match('/^\d{1,20}$/', $_POST['amount'])) {
                $errorFields['amount'] = true;
            }
            if (!isset($_POST['price']) || !preg_match('/^((?!0$)([1-9]\d{0,3}(\.\d{2})?)|0|0\.\d{2})$/', $_POST['price'])) {
                $errorFields['price'] = true;
            }
            $message = 'Neteisingai suvesti duomenys.';
        }
    }
    ?>

    <a href="?page=home"><img class="add_product_back" src="./assets/back-large.png" alt="Grįžti atgal"></a>
    <div class="d-flex justify-content-center mt-2 mb-4">
        <div class="login_form ad_product_form">
            <img class="login_teamwork ad_product_teamwork" src="./assets/teamwork.png" alt="teamwork">
            <div class="d-flex login_transparent">
                <form method="POST">
                    <h3 class="mb-4 mt-4 text-center text-uppercase">Pridėti naują medžiagą:</h3>

                    <input type="text" class="login_input add_product_input form-control mb-4 <?= isset($errorFields['name']) ? 'error' : '' ?> " placeholder="Įveskite produkto pavadinimą" name="name" value="<?= $enteredValues['name'] ?>" required>
                    <input type="text" class="login_input add_product_input form-control mb-4 <?= isset($errorFields['factory_code']) ? 'error' : '' ?> " placeholder="Įveskite gamintojo prekės kodą" name="factory_code" value="<?= $enteredValues['factory_code'] ?>" required>
                    <input type="text" class="login_input add_product_input form-control mb-4 <?= isset($errorFields['description']) ? 'error' : '' ?> " placeholder="Įveskite produkto aprašymą" name="description" value="<?= $enteredValues['description'] ?>" required>
                    <input type="text" class="login_input add_product_input form-control mb-4 <?= isset($errorFields['image']) ? 'error' : '' ?> " placeholder="Įklijuokite produkto paveiksliuko url adresą" name="image" value="<?= $enteredValues['image'] ?>" required>
                    <input type="text" class="login_input add_product_input form-control mb-4 <?= isset($errorFields['amount']) ? 'error' : '' ?> " placeholder="Įveskite produkto kiekį" name="amount" value="<?= $enteredValues['amount'] ?>" required>
                    <input type="text" class="login_input add_product_input form-control mb-4 <?= isset($errorFields['price']) ? 'error' : '' ?>" placeholder="Įveskite produkto kainą (pvz.: 0.59, 6)" name="price" value="<?= $enteredValues['price'] ?>" required>


                    <select class="login_input add_product_input form-control mb-4" name="category" required>
                        <option value="" disabled selected>Pasirinkite kategoriją:</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['id'] ?>" <?php if ($category['id'] == $enteredValues['category']) echo 'selected' ?>><?= $category['name'] ?></option>
                        <?php endforeach ?>
                    </select>

                    <select class="login_input add_product_input form-control mb-4" name="subcategory" required>
                        <option value="" disabled selected>Pasirinkite tipą:</option>
                        <?php foreach ($subcategories as $subcategory) : ?>
                            <option value="<?= $subcategory['id'] ?>" <?php if ($subcategory['id'] == $enteredValues['subcategory']) echo 'selected' ?>><?= $subcategory['name'] ?></option>
                        <?php endforeach ?>
                    </select>

                    <select class="login_input add_product_input form-control mb-4" name="manufacturer" required>
                        <option value="" disabled selected>Pasirinkite gamintoją:</option>
                        <?php foreach ($manufacturers as $manufacturer) : ?>
                            <option value="<?= $manufacturer['id'] ?>" <?php if ($manufacturer['id'] == $enteredValues['manufacturer']) echo 'selected' ?>><?= $manufacturer['name'] ?></option>
                        <?php endforeach ?>
                    </select>

                    <select class="login_input add_product_input form-control mb-4" name="supplier" required>
                        <option value="" disabled selected>Pasirinkite tiekėją:</option>
                        <?php foreach ($suppliers as $supplier) : ?>
                            <option value="<?= $supplier['id'] ?>" <?php if ($supplier['id'] == $enteredValues['supplier']) echo 'selected' ?>><?= $supplier['name'] ?></option>
                        <?php endforeach ?>
                    </select>

                    <select class="login_input add_product_input form-control mb-4" name="measurement" required>
                        <option value="" disabled selected>Pasirinkite mato vienetą:</option>
                        <?php foreach ($measurements as $measurement) : ?>
                            <option value="<?= $measurement['id'] ?>" <?php if ($measurement['id'] == $enteredValues['measurement']) echo 'selected' ?>><?= $measurement['name'] ?></option>
                        <?php endforeach ?>
                    </select>

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