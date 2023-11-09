<?php
// Routeris, patikra, ar prisijungimas sekmingas ir visokie fetchai
session_start();

//Testas, ar susijungia SQL

try {
    $db = new mysqli('localhost', 'root', '', 'warehouse');
} catch (Exception $error) {
    echo 'Connection invalid';
    exit;
}

function view($template)
{
    global $db;

    //Simboliu konvertavimas i utf8mb4 nustatymus (pagal pasirinkima phpMyAdmin)
    $db->set_charset("utf8mb4");

    if (isset($_GET['search'])) {
        $enteredName = $_GET['search'];
        $resultFromProducts = $db->query("SELECT * FROM products WHERE name LIKE '%$enteredName%'");
    }
    //Kategorijos mygtukas susijungia per linka ir atvaizduoja produktus pagal kategorijas
    elseif (isset($_GET['category'])) {
        $id = $_GET['category'];
        $resultFromProducts = $db->query("SELECT * FROM products WHERE category_id = $id");
    } else {
        $resultFromProducts = $db->query("SELECT * FROM products");
    }
    //Visu produktu sarasas fetch
    if ($resultFromProducts->num_rows > 0) {
        $products = $resultFromProducts->fetch_all(MYSQLI_ASSOC);
    }
    //Kategoriju sarasas fetch
    $resultFromCategories = $db->query('SELECT * FROM categories');
    if ($resultFromCategories->num_rows > 0) {
        $categories = $resultFromCategories->fetch_all(MYSQLI_ASSOC);
    }

    //Subkategoriju sarasas fetch
    $resultFromSubcategories = $db->query('SELECT * FROM subcategories');
    if ($resultFromSubcategories->num_rows > 0) {
        $subcategories = $resultFromSubcategories->fetch_all(MYSQLI_ASSOC);
    }

    //Manufacturers sarasas fetch
    $resultManufacturers = $db->query('SELECT * FROM manufacturers');
    if ($resultManufacturers->num_rows > 0) {
        $manufacturers = $resultManufacturers->fetch_all(MYSQLI_ASSOC);
    }

    //Supplier sarasas fetch
    $resultFromSuppliers = $db->query('SELECT * FROM suppliers');
    if ($resultFromSuppliers->num_rows > 0) {
        $suppliers = $resultFromSuppliers->fetch_all(MYSQLI_ASSOC);
    }

    //Measurement sarasas fetch
    $resultMeasurements = $db->query('SELECT * FROM measure_units');
    if ($resultMeasurements->num_rows > 0) {
        $measurements = $resultMeasurements->fetch_all(MYSQLI_ASSOC);
    }

    //Taken_products sarasas fetch
    $resultTakenProducts = $db->query('SELECT * FROM taken_products');
    if ($resultTakenProducts->num_rows > 0) {
        $takenProducts = $resultTakenProducts->fetch_all(MYSQLI_ASSOC);
    }

    //atvaizdavimo padalinimas

    $layout = file_get_contents('./views/layouts/main.php');

    $parts = explode('%%%content%%%', $layout);

    echo $parts[0];
    include $template;
    echo $parts[1];
}

?>



<?php
$page = isset($_GET['page']) ? $_GET['page'] : false;
switch ($page) {
    case "signup":
        view('./views/signup.php');
        break;
    case "login":
        view('./views/login.php');
        break;
    case "logout":
        session_destroy();
        header('Location: ./?page=login');
        break;
    case "add-product":
        view('./views/add-product.php');
        break;
    case "take-product":
        view('./views/take-product.php');
        break;
    case "report-amount":
        view('./views/report-amount.php');
        break;
    case "edit-amount":
        include './views/edit-amount.php';
        break;
    case "footer":
        view('./views/footer.php');
        break;
    default:
        view('./views/home.php');
}
?>