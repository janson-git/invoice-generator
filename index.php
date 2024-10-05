<?php

ini_set('display_errors', 1);

require "src/Config.php";
require "src/Invoice.php";
require "src/InvoiceItem.php";

Config::init(__DIR__ . '/config.php');


$projects = Config::getProjectList();

$formSent = isset($_POST['submit']);

if ($formSent) {
    // GATHER FORM DATA
    $invoiceDate = $_POST['invoice_date'];

    $billedProjectsList = $_POST['project_to_bill'];
    $loggedHoursArray = $_POST['hours'];
    $hourlyRateArray = $_POST['hourly_rate'];

    list($billedYear, $billedMonth) = explode('-', $_POST['billed_month']);
    $invoice = new Invoice($invoiceDate);
    $invoice->setBilledDate($billedMonth, $billedYear);

    foreach ($billedProjectsList as $key => $project) {
        $invoice->addItem($project, (float) $loggedHoursArray[$key], (int) $hourlyRateArray[$key]);
    }

    // CREATE INVOICE
    include("templates/invoice.php");
} else {
    // DISPLAY FORM TO GATHER DATA
    include("templates/form.php");
}
