<?php
session_start();
include("model_customer.php");
include("model_room.php");

// --- INISIALISASI KAMAR ---
function initRooms() {
    if (!isset($_SESSION['rooms'])) {
        $_SESSION['rooms'] = [];
        
        // Regular (101-110)
        for ($i = 101; $i <= 110; $i++) {
            $kamar = new model_room();
            $kamar->nomor_kamar = (string)$i;
            $kamar->tipe_kamar = 'Regular';
            $kamar->customer_id = null;
            $_SESSION['rooms'][(string)$i] = $kamar;
        }
        
        // Deluxe (201-210)
        for ($i = 201; $i <= 210; $i++) {
            $kamar = new model_room();
            $kamar->nomor_kamar = (string)$i;
            $kamar->tipe_kamar = 'Deluxe';
            $kamar->customer_id = null;
            $_SESSION['rooms'][(string)$i] = $kamar;
        }

        // Suite (301-310)
        for ($i = 301; $i <= 310; $i++) {
            $kamar = new model_room();
            $kamar->nomor_kamar = (string)$i;
            $kamar->tipe_kamar = 'Suite';
            $kamar->customer_id = null;
            $_SESSION['rooms'][(string)$i] = $kamar;
        }
    }
}

// --- FUNGSI CUSTOMER & ROOM ---
function listCustomers() {
    initRooms();
    $customers = isset($_SESSION['customers']) ? $_SESSION['customers'] : [];
    include("views/customer_list.php");
}

function createCustomer() {
    initRooms();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nama'])) {
        $newCustomer = new model_customer(); // Sesuai gaya dosen
        $newCustomer->id = uniqid();
        $newCustomer->nama = $_POST['nama'];
        $newCustomer->telepon = $_POST['no_telepon'];
        $newCustomer->rooms_assigned = isset($_POST['rooms']) ? $_POST['rooms'] : [];

        if (!isset($_SESSION['customers'])) $_SESSION['customers'] = [];
        $_SESSION['customers'][$newCustomer->id] = $newCustomer;

        // Update status kamar
        foreach ($newCustomer->rooms_assigned as $nomor) {
            if (isset($_SESSION['rooms'][$nomor])) {
                $_SESSION['rooms'][$nomor]->customer_id = $newCustomer->id;
            }
        }
        header("Location: controller.php?action=list");
        exit;
    }

    // Ambil hanya kamar kosong untuk dropdown View 2
    $available_rooms = [];
    foreach ($_SESSION['rooms'] as $nomor => $obj_kamar) {
        if ($obj_kamar->customer_id == null) $available_rooms[$nomor] = $obj_kamar;
    }
    include("views/customer_add.php");
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

        // Kosongkan kamar lama terlebih dahulu
        foreach ($customer->rooms_assigned as $old_room) {
            $_SESSION['rooms'][$old_room]->customer_id = null;
        }

        // Set kamar baru
        $customer->rooms_assigned = $kamar_baru;
        foreach ($kamar_baru as $new_room) {
            $_SESSION['rooms'][$new_room]->customer_id = $customer->id;
        }

        header("Location: controller.php?action=list");
        exit;
    }

    // Ambil kamar kosong + kamar milik pelanggan ini untuk dropdown View 3
    $rooms_for_dropdown = [];
    foreach ($_SESSION['rooms'] as $nomor => $kamar) {
        if ($kamar->customer_id == null || $kamar->customer_id == $id) {
            $rooms_for_dropdown[$nomor] = $kamar;
        }
    }
    include("views/customer_edit.php");
}

function deleteCustomer() {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if ($id && isset($_SESSION['customers'][$id])) {
        // Kosongkan kamar yang ditinggalkan
        $customer = $_SESSION['customers'][$id];
        foreach ($customer->rooms_assigned as $room) {
            if (isset($_SESSION['rooms'][$room])) {
                $_SESSION['rooms'][$room]->customer_id = null;
            }
        }
        // Hapus data customer
        unset($_SESSION['customers'][$id]);
    }
    header("Location: controller.php?action=list");
    exit;
}

// --- ROUTING UTAMA ---
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

if ($action == 'create') {
    createCustomer();
} elseif ($action == 'edit') {
    editCustomer();
} elseif ($action == 'delete') {
    deleteCustomer();
} else {
    listCustomers();
}
?>