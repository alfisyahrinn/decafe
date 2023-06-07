<?php
session_start();
if (isset($_GET["halaman"]) && $_GET["halaman"] == "home") {
  $page = "home.php";
  include 'main.php';
} elseif (isset($_GET["halaman"]) && $_GET["halaman"] == "order") {
  $page = "order.php";
  include 'main.php';
} elseif (isset($_GET["halaman"]) && $_GET["halaman"] == "customer") {
  $page = "customer.php";
  include 'main.php';
} elseif (isset($_GET["halaman"]) && $_GET["halaman"] == "user") {
  if ($_SESSION["levelDecafe"] == 1) {
    $page = "user.php";
    include 'main.php';
  } else {
    $page = "home.php";
    include 'main.php';
  }
} elseif (isset($_GET["halaman"]) && $_GET["halaman"] == "report") {
  if ($_SESSION["levelDecafe"] == 1) {
    $page = "report.php";
    include 'main.php';
  } else {
    $page = "home.php";
    include 'main.php';
  }
} elseif (isset($_GET["halaman"]) && $_GET["halaman"] == "menu") {
  $page = "menu.php";
  include 'main.php';
} elseif (isset($_GET["halaman"]) && $_GET["halaman"] == "katmenu") {
  $page = "katmenu.php";
  include 'main.php';
} elseif (isset($_GET["halaman"]) && $_GET["halaman"] == "login") {
  include 'login.php';
} else {
  include 'main.php';
}
