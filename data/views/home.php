<!-- Vaizdas prisijungus -->

<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) : ?>

    <!-- Portfolio, uzsakymo issiuntimas, atsijungimas -->
    <header>
        <div class="header_line d-flex justify-content-between">
            <div class="col-4 header_profile">
                <?php if (isset($_SESSION['name']) || isset($_SESSION['surname']) || isset($_SESSION['isadmin']) || isset($_SESSION['user_position']) || isset($_SESSION['user_photo'])) : ?>
                    <div class="header_photo">
                        <img class="header_photo_img" src="<?= $_SESSION['user_photo'] ?>" alt="user photo">
                    </div>
                    <div class="header_profile_info">
                        <span class="header_user_company">UAB SANTECH</span> <br />
                        <span><?= $_SESSION['user_position'] ?></span> <br />
                        <p class="header_user_name text-capitalize"><?= $_SESSION['name'] ?> <?= $_SESSION['surname'] ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-2 d-flex justify-content-end m-0">
                <?php if ($_SESSION['isadmin'] == '1') : ?>
                    <a href="" data-tooltip="Užsakymo išsiuntimas"><img width="47px" class="header_truck_icon" src="./assets/truck.png"></a>
                <?php endif; ?>
                <a href="?page=logout" data-tooltip="Atsijungti"><img width="42px" class="header_logout_icon" src="./assets/logout.png"></a>
            </div>
        </div>
    </header>


    <main>

        <section class="main_first_section d-flex">

            <aside class="main_aside col-4">
                <div class="main_tools d-flex justify-content-center">
                    <?php if ($_SESSION['isadmin'] == '1') : ?>
                        <a href="" data-tooltip="Užsakymų istorija"><img width="46px" src="./assets/order-history-large.png" alt="Užsakymų istorija"></a>
                        <a href="" data-tooltip="Išduotos medžiagos"><img width="47px" src="./assets/on-hand-large.png" alt="Išduotos medžiagos"></a>
                        <a href="?page=add-product" data-tooltip="Pridėti naują medžiagą"><img width="40px" src="./assets/add-tool-large.png" alt="Pridėti naują medžiagą"></a>
                        <a href="" data-tooltip="Papildyti likutį"><img width="40px" src="./assets/update-stock-large.png" alt="Papildyti likutį"></a>
                        <a href="" data-tooltip="Pranešimai"><img width="55px" src="./assets/alert-large.png" alt="Pranešimai"></a>
                    <?php else : ?>
                        <a href="?page=take-product" data-tooltip="Paimti medžiagas"><img width="47px" src="./assets/take-tools-large.png" alt="Papildyti likutį"></a>
                        <a href="?page=report-amount" data-tooltip="Sunaudotos medžiagos"><img width="47px" src="./assets/used-tools-large.png" alt="Pranešimai"></a>
                        <a href="" data-tooltip="Išduotos medžiagos"><img width="47px" src="./assets/on-hand-large.png" alt="Išduotos medžiagos"></a>
                    <?php endif; ?>
                </div>
            </aside>

            <div class="first_section_search col-3">
                <form class="input-group" method='GET' action="./">
                    <button class="btn"><img src="./assets/search-small.png"></button>
                    <input type="search" class="input_search form-control" placeholder="Paieška" name="search">
                </form>
            </div>


            <div class="col-3 d-flex justify-content-center">
                <label for="categorySelect" class="label_category"><img src="./assets/menu.png"></label>
                <select id="categorySelect" class="select_category form-select" name="category" onchange="window.location.href = this.value;">
                    <option value="./">Visos medžiagos</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="?category=<?= $category['id'] ?>" <?php if (isset($_GET['category']) && $_GET['category'] == $category['id']) echo 'selected'; ?>>
                            <?= $category['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </section>

        <!-- Puslapiavimas visiems produktams ir kategorijoms -->
        <section>
            <?php
            $productsPerPage = 10;
            if (isset($products) && !empty($products)) {
                $productsTotalAmount = count($products);
            } else {
                echo "<h5 class='text-center mt-5'>Nėra įrašų šioje kategorijoje</h5>";
                exit;
            }
            $totalPages = ceil($productsTotalAmount / $productsPerPage);

            $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $category = isset($_GET['category']) ? $_GET['category'] : '';

            //Skaiciuojamas pradzios taskas nuo kurio prasideda atvaizduojamas sarasas ir kiek irasu turi buti
            $offset = ($currentPage - 1) * $productsPerPage;
            //Isgaunama masyvo dalis is table videos pagal salygas, nekeiciant originalaus masyvo
            $products = array_slice($products, $offset, $productsPerPage);
            ?>

            <nav class="pages">
                <ul class="pagination justify-content-end">
                    <?php if ($currentPage > 1) : ?>
                        <?php if ($category !== '') : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $currentPage - 1 ?>&category=<?= $category ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span></a></li>
                        <?php else : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $currentPage - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <?php if ($category !== '') : ?>
                            <li class="page-item <?= ($i === $currentPage) ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>&category=<?= $category ?>"><?= $i ?></a></li>
                        <?php else : ?>
                            <li class="page-item <?= ($currentPage == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages) : ?>
                        <?php if ($category !== '') : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $currentPage + 1 ?>&category=<?= $category ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php else : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $currentPage + 1 ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </nav>


            <!-- Lenteles atvaizdavimas -->
            <table width="1128px">
                <thead>
                    <tr>
                        <th></th>
                        <th>Pavadinimas</th>
                        <th>Gamintojas</th>
                        <th>Tiekėjas</th>
                        <th>Išduota</th>
                        <th>Likutis</th>
                        <th>Matmuo</th>
                        <?php if ($_SESSION['isadmin'] == '1') : ?>
                            <th>Tvarkyti</th>
                            <th>Ištrinti</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <!-- Duomenys is lenteliu products, manufacturers, suppliers, measurements -->
                    <?php

                    if (isset($products) || isset($manufacturers) || isset($suppliers) || isset($measurements) || isset($takenProducts)) {
                        foreach ($products as $product) : ?>

                            <tr>
                                <td>
                                    <img width=100% class="table_image rounded-start overflow-hidden " src=<?= $product['image'] ?> alt="Produkto nuotrauka">
                                </td>
                                <td width="300px">
                                    <?= $product['name'] ?> </br>
                                    <?= $product['description'] ?>
                                </td>
                                <td>
                                    <?php
                                    $connectManufacturersAndProduct = $db->query("SELECT * FROM manufacturers WHERE id = " . $product['manufacturer_id']);
                                    if ($connectManufacturersAndProduct->num_rows > 0) {
                                        $manufacturers = $connectManufacturersAndProduct->fetch_all(MYSQLI_ASSOC);
                                    }
                                    foreach ($manufacturers as $manufacturer) :
                                    ?>
                                        <?= $manufacturer['name'] ?></br>
                                    <?php endforeach; ?>
                                    <?= $product['factory_code'] ?>
                                </td>

                                <td>
                                    <?php
                                    $connectSuppliersAndProduct = $db->query("SELECT * FROM suppliers WHERE id = " . $product['supplier_id']);
                                    if ($connectSuppliersAndProduct->num_rows > 0) {
                                        $suppliers = $connectSuppliersAndProduct->fetch_all(MYSQLI_ASSOC);
                                    }
                                    foreach ($suppliers as $supplier) :
                                    ?>
                                        <?= $supplier['name'] ?>
                                    <?php endforeach; ?>
                                </td>
                                <td class="table_hand">
                                    <?php
                                    $connectTakenProductsAndProducts = $db->query("SELECT SUM(taken_amount) AS total_amount FROM taken_products WHERE product_id = " . $product['id']);
                                    $row = $connectTakenProductsAndProducts->fetch_assoc();

                                    if ($row['total_amount'] !== null) {
                                        echo $row['total_amount'];
                                    } else {
                                        echo '0';
                                    }
                                    ?>

                                </td>
                                <td class="table_amount">
                                    <div class="display-value"><?= $product['amount'] ?></div>
                                    <input class="editable" type="number" value="<?= $product['amount'] ?>" style="display: none;">
                                </td>

                                <td width="50px">
                                    <?php
                                    $connectMeasurementsAndProduct = $db->query("SELECT * FROM measure_units WHERE id = " . $product['measure_unit_id']);
                                    if ($connectMeasurementsAndProduct->num_rows > 0) {
                                        $measurements = $connectMeasurementsAndProduct->fetch_all(MYSQLI_ASSOC);
                                    }
                                    foreach ($measurements as $unit) :
                                    ?>
                                        <?= $unit['name'] ?> </br>
                                    <?php endforeach; ?>
                                </td>
                                <?php if ($_SESSION['isadmin'] == '1') : ?>
                                    <td class="table_edit">
                                        <img class="edit_button" type="button" src="./assets/edit-small.png">
                                        <img class="save-button" data-id="<?php echo $product['id']; ?>" style="display: none;" type="submit" src="./assets/check.png" onclick="saveAmount(this);">
                                    </td>
                                    <td><img src="./assets/trash-small.png"></td>
                                <?php endif; ?>
                            </tr>
                            </body>
                            <!-- pagrindinis endoreach products baigiasi -->
                    <?php

                        endforeach;
                    } else {
                        echo "<h5 class='text-center'>Nėra jokių įrašų </h5>";
                    }
                    ?>
            </table>
        </section>
    </main>
    <?php require_once 'footer.php' ?>
<?php else : ?>
    <?php require_once 'login.php' ?>
<?php endif ?>