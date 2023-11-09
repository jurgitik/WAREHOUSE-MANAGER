<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) : ?>

    <?php

    $message = false;

    $enteredValues = array(
        'amount' => ''
    );

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // $enteredValues = array(
        //     'amount' => $_POST['newAmount']
        // );
        if (
            isset($_GET['id']) &&
            isset($_POST['amount']) && preg_match('/^\d{1,20}$/', $_POST['amount'])
        ) {
            $productID = $_GET['id'];
            $newAmount = (int)$_POST['amount'];


            $sql = "UPDATE products SET amount = '$newAmount' WHERE id = $productID";


            if ($db->query($sql) === TRUE) {
                echo 'Gerai';
            } else {
                echo 'Įvyko klaida išsaugant. Bandykite dar kartą';
                http_response_code(500);
            }
        } else {
            echo 'Įvyko klaida validuojant. Bandykite dar kartą';
            http_response_code(500);
        }
        exit;
    }

    ?>
<?php endif ?>



