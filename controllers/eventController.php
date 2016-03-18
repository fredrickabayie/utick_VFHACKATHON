<?php

include_once '../errors/ErrorHandler.php';
//ob_start();
//ini_set('error_reporting', E_NOTICE);
//print_r($_GET['undefined']);

//ob_end_clean();

if (isset ($_REQUEST ['cmd'])) {
    session_start();

    $cmd = $_REQUEST['cmd'];

    switch ($cmd) {
        case 1:
            displayWines();
            break;

        case 2:
            customerLogin();
            break;

        case 3:
            checkout();
            break;

        case 8:
            login();
            break;

        case 9:
            wineDetail();
            break;

        case 10:
            shoppingCart();
            break;

        case 11:
            twigLoader();
            break;

        default:
            echo '{"result":0,status:"unknown command"}';
            break;
    }//end of switch

}//end of if


function checkout()
{
    if (isset($_SESSION['customer'])) {
        echo 'checkout page';
    } else {
        header('Location: ../controllers/WineController.php?cmd=2');
    }
}


function twiggg($url = "", $data = "", $total_wines = "", $page = "", $totalCost = "", $totalQuantity = "", $total_pages = "")
{
    require_once '../lib/Twig/Autoloader.php';

    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('../templates');
    $twig = new Twig_Environment($loader);

//    print_r($_SESSION['cart']);

//    '/products.html.twig'

    echo $twig->render($url, [
        'wines' => $data,
        'totalWines' => $total_wines,
        'page' => $page,
        'totalPages' => $total_pages,
        'carts' => isset($_SESSION['cart']) ? $_SESSION['cart'] : "",
        'totalCost' => $totalCost,
        'totalQuantity' => $totalQuantity,
        'customer' => isset($_SESSION['customer']) ? $_SESSION['customer'] : ''
    ]);
}


function customerLogin()
{
    require_once '../lib/Twig/Autoloader.php';
    include_once '../models/Wine.php';

    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $wine = new Wine();
        $result = $wine->login($email, $password);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if (!$row) {
            echo 'Failed to login';
        } else {
            $_SESSION['customer'] = $row;
            print_r($_SESSION['customer']);
            header('Location: ../controllers/WineController.php?cmd=1');
        }
    } elseif (isset($_GET['action']) && $_GET['action'] == 'logout') {
        unset($_SESSION['customer']);
    }

    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('../templates');
    $twig = new Twig_Environment($loader);
    $totalQuantity = 0;

    if (isset($_SESSION['cart'])) {
        $totalCost = 0;

        foreach ($_SESSION['cart'] as $key => $quantity) {

            $totalCost += $_SESSION['cart'][$key]['cost'];
            $totalQuantity += $_SESSION['cart'][$key]['quantity'];
        }
    }


    $url = '/login.html.twig';

    /** @var array $row */
    /** @var TYPE_NAME $totalQuantity */
    echo $twig->render($url, [
        'customer' => isset($_SESSION['customer']) ? $_SESSION['customer'] : '',
//        'totalWines' => $total_wines,
//        'page' => $page,
//        'totalPages' => $total_pages,
//        'carts' => isset($_SESSION['cart']) ? $_SESSION['cart'] : "",
//        'totalCost' => $totalCost,
        'totalQuantity' => $totalQuantity
    ]);
}


function twigLoader()
{

    require_once '../lib/Twig/Autoloader.php';

    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('../templates');
    $twig = new Twig_Environment($loader);


    $num_perPage = 21;
    if (isset($_REQUEST['page'])) {
        $page = $_REQUEST['page'];
    } else {
        $page = 1;
    }

    $start_from = ($page - 1) * $num_perPage;

    include_once '../models/Wine.php';
    $wine = new Wine();

    if ($result = $wine->displayWine($start_from, $num_perPage)) {

        $num = $wine->countWine();
        $total = $num->fetch_assoc();
        $total_wines = $total["wine_id"];

        $total_pages = ceil($total_wines / $num_perPage);

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $data[] = $row;
        }
    }

    $totalCost = 0;
    $totalQuantity = 0;

    $wine_id = intval(isset($_GET['wine_id']) ? $_GET['wine_id'] : 0);

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $quantity) {
            $totalCost += $_SESSION['cart'][$key]['cost'];
            $totalQuantity += $_SESSION['cart'][$key]['quantity'];
        }
    }

    /** @var array $data */
    /** @var integer $total_wines */
    /** @var integer $total_pages */

    if (isset($_GET['details'])) {
        $url = '/details.html.twig';
    } else {
        $url = '/products.html.twig';
    }

    echo $twig->render($url, [
        'wines' => $data,
        'totalWines' => $total_wines,
        'page' => $page,
        'totalPages' => $total_pages,
        'carts' => isset($_SESSION['cart']) ? $_SESSION['cart'] : "",
        'totalCost' => $totalCost,
        'totalQuantity' => $totalQuantity
    ]);
}


/**
 * Controls the shopping cart
 */
function shoppingCart()
{
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $wine_id = intval(isset($_GET['wine_id']) ? $_GET['wine_id'] : 0);

        switch ($action) {
            case 'add':
                if (!isset($_SESSION['cart'][$wine_id])) {

                    include_once '../models/Wine.php';
                    $cartWine = new Wine();

                    $result = $cartWine->selectWine($wine_id);
                    if ($row = $result->fetch_array(MYSQLI_ASSOC)) {

                        $_SESSION['cart'][$wine_id] = [
                            'id' => $row['wine_id'],
                            'name' => $row['wine_name'],
                            'cost' => $row['cost'],
                            'quantity' => 1,
                        ];
                    }
                } else {
                    echo 'Item already added to cart';
                }
                displayWines();
//                twigLoader();
                break;

            case 'change':
                if (isset($_SESSION['cart'][$wine_id])) {
                    echo $quantity = $_POST['quantity'];

                    include_once '../models/Wine.php';
                    $cartWine = new Wine();

                    $result = $cartWine->selectWine($wine_id);
                    if ($row = $result->fetch_array(MYSQLI_ASSOC)) {

                        if ($quantity < $row['on_hand'] && $quantity > 0) {
                            $_SESSION['cart'][$wine_id]['quantity'] = $quantity;

                            $_SESSION['cart'][$wine_id] = [
                                'id' => $row['wine_id'],
                                'name' => $row['wine_name'],
                                'cost' => $row['cost'] * $_SESSION['cart'][$wine_id]['quantity'],
                                'quantity' => $_SESSION['cart'][$wine_id]['quantity']
                            ];
                        } else {
                            echo 'Available In stock is ' . $row['on_hand'];
                        }

                    } else {
                        echo 'Item does not exist in the database';
                    }
                }
                displayWines();
                break;

            case 'increase':
                if (isset($_SESSION['cart'][$wine_id])) {

                    include_once '../models/Wine.php';
                    $cartWine = new Wine();

                    $result = $cartWine->selectWine($wine_id);
                    if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $_SESSION['cart'][$wine_id]['quantity']++;

                        $_SESSION['cart'][$wine_id] = [
                            'id' => $row['wine_id'],
                            'name' => $row['wine_name'],
                            'cost' => $row['cost'] * $_SESSION['cart'][$wine_id]['quantity'],
                            'quantity' => $_SESSION['cart'][$wine_id]['quantity']
                        ];
                    } else {
                        echo 'Item does not exist in the database';
                    }
                }
                displayWines();
//                twigLoader();
                break;

            case 'decrease':
                if (isset($_SESSION['cart'][$wine_id]) && intval($_SESSION['cart'][$wine_id]['quantity']) > 0) {

                    include_once '../models/Wine.php';
                    $cartWine = new Wine();

                    $result = $cartWine->selectWine($wine_id);
                    if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $_SESSION['cart'][$wine_id]['quantity']--;

                        $_SESSION['cart'][$wine_id] = [
                            'id' => $row['wine_id'],
                            'name' => $row['wine_name'],
                            'cost' => $row['cost'] * $_SESSION['cart'][$wine_id]['quantity'],
                            'quantity' => $_SESSION['cart'][$wine_id]['quantity']
                        ];
                    } else {
                        echo 'Item not in the database';
                    }
                } else {
                    unset($_SESSION['cart'][$wine_id]);
                }
                displayWines();
//                twigLoader();
                break;

            case 'remove':
                if (isset($_SESSION['cart'][$wine_id])) {
                    unset($_SESSION['cart'][$wine_id]);
                }
                displayWines();
//                twigLoader();
                break;

            case 'empty':
                unset($_SESSION['cart']);
                displayWines();
//                twigLoader();
                break;

            default:
                displayWines();
//                twigLoader();
                break;
        }
    }
}


/**
 * Function to display all wines
 */
function displayWines()
{
    $num_perPage = 21;
    if (isset($_REQUEST['page'])) {
        $page = $_REQUEST['page'];
    } else {
        $page = 1;
    }

    $start_from = ($page - 1) * $num_perPage;

    include_once '../models/Wine.php';
    $wine = new Wine();

    if ($result = $wine->displayWine($start_from, $num_perPage)) {

        $num = $wine->countWine();
        $total = $num->fetch_assoc();
        $total_wines = $total["wine_id"];

        $total_pages = ceil($total_wines / $num_perPage);

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $data[] = $row;
        }
    }

    $totalCost = 0;
    $totalQuantity = 0;

    $wine_id = intval(isset($_GET['wine_id']) ? $_GET['wine_id'] : 0);

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $quantity) {
            $totalCost += $_SESSION['cart'][$key]['cost'];
            $totalQuantity += $_SESSION['cart'][$key]['quantity'];
        }
    }

    /** @var TYPE_NAME $data */
    /** @var TYPE_NAME $total_wines */
    /** @var TYPE_NAME $total_pages */
    twiggg('/products.html.twig', $data, $total_wines, $page, $totalCost, $totalQuantity, $total_pages);
}


/**
 * Function to display all wines
 */
function wineDetail()
{

    if (isset($_GET['wine_id'])) {
        include_once '../models/Wine.php';

        $wine_id = $_GET['wine_id'];
        $wine = new Wine();

        if ($result = $wine->wineDetail($wine_id)) {
            $row = $result->fetch_assoc();

            twiggg('/details.html.twig', $row);
        }
    }
}


/**
 * Function to search for a task
 */
function searchWine()
{
    if (isset ($_REQUEST ['searchWord'])) {
        include_once '../models/Wine.php';
        $wine = new Wine ();

        $searchWord = $_REQUEST ['searchWord'];

        if ($result = $wine->searchWine($searchWord)) {
            $row = $result->fetch_assoc();
            echo '{"result":1, "wines": [';
            while ($row) {
                echo '{"wine_id": "' . $row ["wine_id"] . '", "wine_name": "' . $row ["wine_name"] . '",
            "winery_name": "' . $row ["winery_name"] . '", "cost": "' . $row ["cost"] . '",
            "wine_type": "' . $row["wine_type"] . '", "year": "' . $row["year"] . '"}';

                if ($row = $result->fetch_assoc()) {
                    echo ',';
                }
            }
            echo ']}';
        } else {
            echo '{"result":0,"status": "An error occurred for select product."}';
        }
    }
}//end of search_task()


/**
 * Function to display all tasks
 */
function displayWineTypes()
{
    include_once '../models/Wine.php';
    $wine = new Wine ();

    if ($result = $wine->wineType()) {
        $row = $result->fetch_assoc();
        echo '{"result":1, "wineType": [';
        while ($row) {
            echo '{"wine_type_id": "' . $row ["wine_type_id"] . '", "wine_type": "' . $row ["wine_type"] . '"}';

            if ($row = $result->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"status": "An error occurred for display wines."}';
    }
}


/**
 * Function to display all tasks
 */
function displayWineByType()
{
    if (isset ($_REQUEST ['wineType'])) {
        include_once '../models/Wine.php';
        $wine = new Wine ();

        $wineType = $_REQUEST ['wineType'];

        if ($result = $wine->displayWineByType($wineType)) {
            $row = $result->fetch_assoc();
            echo '{"result":1, "wines": [';
            while ($row) {
                echo '{"wine_id": "' . $row ["wine_id"] . '", "wine_name": "' . $row ["wine_name"] . '",
            "winery_name": "' . $row ["winery_name"] . '", "cost": "' . $row ["cost"] . '",
            "wine_type": "' . $row["wine_type"] . '", "year": "' . $row["year"] . '"}';

                if ($row = $result->fetch_assoc()) {
                    echo ',';
                }
            }
            echo ']}';
        } else {
            echo '{"result":0,"status": "An error occurred for display wines."}';
        }
    }
}//end of display_all_tasks()


/**
 * Function to display all sorted wines by cost in
 * descending order
 */
function sortWineDesc()
{
    include_once '../models/Wine.php';
    $wine = new Wine ();

    if ($result = $wine->sortWinePriceDesc()) {
        $row = $result->fetch_assoc();
        echo '{"result":1, "sortWines": [';

        while ($row) {
            echo '{"wine_id": "' . $row ["wine_id"] . '", "wine_name": "' . $row ["wine_name"] . '",
            "winery_name": "' . $row ["winery_name"] . '", "cost": "' . $row ["cost"] . '",
            "wine_type": "' . $row["wine_type"] . '", "year": "' . $row["year"] . '"}';

            if ($row = $result->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"status": "An error occurred for display wines."}';
    }
}


/**
 * Function to display all sorted wines by cost in
 * ascending order
 */
function sortWineAsc()
{
    include_once '../models/Wine.php';
    $wine = new Wine ();

    if ($result = $wine->sortWinePriceAsc()) {
        $row = $result->fetch_assoc();
        echo '{"result":1, "sortWines": [';

        while ($row) {
            echo '{"wine_id": "' . $row ["wine_id"] . '", "wine_name": "' . $row ["wine_name"] . '",
            "winery_name": "' . $row ["winery_name"] . '", "cost": "' . $row ["cost"] . '",
            "wine_type": "' . $row["wine_type"] . '", "year": "' . $row["year"] . '"}';

            if ($row = $result->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"status": "An error occurred for display wines."}';
    }
}


/**
 * Function to display all sorted wines by name
 */
function sortWineName()
{
    include_once '../models/Wine.php';
    $wine = new Wine ();

    if ($result = $wine->sortWineName()) {
        $row = $result->fetch_assoc();
        echo '{"result":1, "sortWines": [';

        while ($row) {
            echo '{"wine_id": "' . $row ["wine_id"] . '", "wine_name": "' . $row ["wine_name"] . '",
            "winery_name": "' . $row ["winery_name"] . '", "cost": "' . $row ["cost"] . '",
            "wine_type": "' . $row["wine_type"] . '", "year": "' . $row["year"] . '"}';

            if ($row = $result->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"status": "An error occurred for display wines."}';
    }
}

function login()
{
    if (isset ($_REQUEST['username']) & isset ($_REQUEST['password'])) {
        include_once '../models/Wine.php';
        $obj = new Wine ();
        $username = stripslashes($_REQUEST ['username']);
        $password = stripslashes($_REQUEST ['password']);
        $username = $obj->real_escape_string($username);
        $password = $obj->real_escape_string($password);

        $result = $obj->login($username, $password);
        $row = $result->fetch_assoc();

        if (!$row) {
            echo '{"result":0, "message":"Failed to login"}';
        } else {
            echo '{"result":1, "user_name":"' . $row['user_name'] . '"}';
        }

        $result->close();
    }

}


function sendMail()
{
    $admin = "chok.real@gmail.com";
    $mail = "fredrick.abayie@ashesi.edu.gh";
    $subject = "Mail sending first test";
    $comment = "good or bad";

    if (mail($admin, $subject, $comment, 'From' . $mail)) {
        echo '{"success"}';
    }
}