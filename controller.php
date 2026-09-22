<?php
include("model_customer.php");
include("model_room.php");
session_start();

function initRooms() {
    if (!isset($_SESSION['rooms'])) {
        $_SESSION['rooms'] = [];
        
        for ($i = 101; $i <= 110; $i++) {
            $kamar = new model_room();
            $kamar->nomor_kamar = (string)$i;
            $kamar->tipe_kamar = 'Regular';
            $kamar->customer_id = null;
            $_SESSION['rooms'][(string)$i] = $kamar;
        }
        
        for ($i = 201; $i <= 210; $i++) {
            $kamar = new model_room();
            $kamar->nomor_kamar = (string)$i;
            $kamar->tipe_kamar = 'Deluxe';
            $kamar->customer_id = null;
            $_SESSION['rooms'][(string)$i] = $kamar;
        }

        for ($i = 301; $i <= 310; $i++) {
            $kamar = new model_room();
            $kamar->nomor_kamar = (string)$i;
            $kamar->tipe_kamar = 'Suite';
            $kamar->customer_id = null;
            $_SESSION['rooms'][(string)$i] = $kamar;
        }
    }
}

function listCustomers() {
    initRooms();
    $customers = isset($_SESSION['customers']) ? $_SESSION['customers'] : [];
    include("view_list_order.php");
}

function listCustomerDirectory() {
    initRooms();
    $customers = isset($_SESSION['customers']) ? $_SESSION['customers'] : [];
    include("view_customer.php");
}

function createCustomer() {
    initRooms();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nama'])) {
        $newCustomer = new model_customer();
        $newCustomer->id = uniqid();
        $newCustomer->nama = $_POST['nama'];
        $newCustomer->telepon = $_POST['no_telepon'];
        $newCustomer->rooms_assigned = isset($_POST['rooms']) ? $_POST['rooms'] : [];

        if (!isset($_SESSION['customers'])) $_SESSION['customers'] = [];
        $_SESSION['customers'][$newCustomer->id] = $newCustomer;

        foreach ($newCustomer->rooms_assigned as $nomor) {
            if (isset($_SESSION['rooms'][$nomor])) {
                $_SESSION['rooms'][$nomor]->customer_id = $newCustomer->id;
            }
        }
        header("Location: controller.php?action=list");
        exit;
    }

    $available_rooms = [];
    foreach ($_SESSION['rooms'] as $nomor => $obj_kamar) {
        if ($obj_kamar->customer_id == null) $available_rooms[$nomor] = $obj_kamar;
    }
    include("index.php");
}

function editCustomer() {
    initRooms();
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    
    if (!$id || !isset($_SESSION['customers'][$id])) {
        header("Location: controller.php?action=list");
        exit;
    }

    $customer = $_SESSION['customers'][$id];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nama'])) {
        $customer->nama = $_POST['nama'];
        $customer->telepon = $_POST['no_telepon'];
        $kamar_baru = isset($_POST['rooms']) ? $_POST['rooms'] : [];

        foreach ($customer->rooms_assigned as $old_room) {
            $_SESSION['rooms'][$old_room]->customer_id = null;
        }

        $customer->rooms_assigned = $kamar_baru;
        foreach ($kamar_baru as $new_room) {
            $_SESSION['rooms'][$new_room]->customer_id = $customer->id;
        }

        header("Location: controller.php?action=list");
        exit;
    }

    $rooms_for_dropdown = [];
    foreach ($_SESSION['rooms'] as $nomor => $kamar) {
        if ($kamar->customer_id == null || $kamar->customer_id == $id) {
            $rooms_for_dropdown[$nomor] = $kamar;
        }
    }
    include("view_edit_customer.php");
}

function deleteCustomer() {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if ($id && isset($_SESSION['customers'][$id])) {
        $customer = $_SESSION['customers'][$id];
        foreach ($customer->rooms_assigned as $room) {
            if (isset($_SESSION['rooms'][$room])) {
                $_SESSION['rooms'][$room]->customer_id = null;
            }
        }
        unset($_SESSION['customers'][$id]);
    }
    header("Location: controller.php?action=list");
    exit;
}

if (defined('INDEX_VIEW')) {
    initRooms();
    $available_rooms = [];
    foreach ($_SESSION['rooms'] as $nomor => $kamar) {
        if ($kamar->customer_id === null) {
            $available_rooms[$nomor] = $kamar;
        }
    }
} else {
    $action = isset($_GET['action']) ? $_GET['action'] : 'list';

    if ($action == 'create') {
        createCustomer();
    } elseif ($action == 'customers') {
        listCustomerDirectory();
    } elseif ($action == 'edit') {
        editCustomer();
    } elseif ($action == 'delete') {
        deleteCustomer();
    } else {
        listCustomers();
    }
}
?>