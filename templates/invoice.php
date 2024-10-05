<html lang="en">
<?php /** @var Invoice $invoice */ ?>
<head>
    <title><?= $invoice->getInvoiceFormattedDate('Y-m-d') ?> - John Doe - Invoice #<?= $invoice->getInvoiceNumber() ?></title>
    <style>
        #sheet {
            margin: 10mm auto;
            padding: 10mm 5mm 10mm 15mm;
            width: 210mm;
            height: 297mm;
            line-height: 1.5;
            font-size: 10pt;
            font-family: sans-serif;
            color: #666666;
        }
        #head {
            width: 100%;
            font-size: 10pt;
        }
        #executor-name {
            float: left;
            text-align: left;
        }
        #executor-address {
            float: right;
            text-align: right;
        }

        .clear-fix {
            clear: both;
        }

        #invoice {
            margin-top: 15pt;
        }
        #invoice-title {
            font-size: 20pt;
            font-weight: bold;
            margin: 20pt 0;
        }
        .left-float {
            float: left;
            margin-right: 10px;
        }
        .left-pad {
            margin-left: 70pt;
        }

        table, th, tr, td {
            padding: 10pt;
            border-collapse: collapse;
            background-color: #ddeedd;
            line-height: 1.5;
        }

        tbody * {
            background-color: #fff;
            color: #333333;
        }
        .border-bottom {
            border-bottom: #ccc 1px solid;
        }
        td {
            vertical-align: top;
        }
        #invoice-table {
            width: 100%;
            margin: 15pt 0;
        }
        #invoice-table thead {
            font-size: 10pt;
            font-weight: bold;
        }

        .additional-info td {
            color: #666;
        }
        #total-sum {
            text-align: right;
            font-size: 9pt;
        }

        #sign-block {
            margin-top: 20pt;
        }
        #sign-consumer {
            width: 50%;
            float: left;
            position: relative;
            left: 13mm;
        }
        #sign-executor {
            width: 50%;
            float: right;
            position: relative;
            left: 13mm;
        }
        .sign-title {
            font-size: 12px;
            font-weight: bold;
            color: #333;
        }
        .sign-placeholder {
            margin-top: 30px;
            width: 45%;
            font-weight: bold;
            color: #333;
        }
        .underline {
            width: 100%;
            border-bottom: 1px solid #ccc;
            margin-left: 7mm;
        }
        .sign {
            width: 30mm;
            position: relative;
            left: 15mm;
            top: -22mm;
        }

        .center {
            text-align: center;
        }

        #wire-transfer-info {
            position: relative;
            top: -50px;
            width: 100%;
        }
        #wire-transfer-info .title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 10pt;
        }
        #wire-transfer-info table, #wire-transfer-info table td {
            width: 100%;
            border: 2px solid #333;
            border-collapse: collapse;
            font-size: 10pt;
        }
    </style>
</head>

<body>
 <div id="sheet">
     <div id="head">
         <div id="executor-name">
             <span>Executor:</span><br>
             <span>John Doe</span><br>
         </div>
         <div id="executor-address">
             <span>38-44, Sample Road</span><br>
             <span>Example City, DE 12345 United States</span><br>
             <span>john.doe@example.com</span><br>
             <span>+1 234-567-890</span><br>
         </div>
     </div>

     <div class="clear-fix"></div>

     <div id="invoice">
         <div id="invoice-title">
             <span>Invoice #<?= $invoice->getInvoiceNumber() ?></span>
         </div>
         <div id="invoice-info">
             <div class="left-float">
                 <span><b>Date of issue:</b></span><br>
                 <span><b>For the period:</b></span><br>
                 <span><b>Customer:</b></span>
             </div>
            <div class="left-pad">
                <span><?= $invoice->getInvoiceFormattedDate() ?></span><br>
                <span><?= $invoice->getInvoiceRangeStartFormatted() ?> - <?= $invoice->getInvoiceRangeEndFormatted() ?></span><br>
                <span>Benefit Studios LLC,
             321 Another Street #123 MockCity, TX 12345 United States</span>
            </div>
         </div>

         <div class="clear-fix"></div>

         <div id="table">
             <table id="invoice-table">
                  <!-- INVOICE DATA HEADER -->
                  <thead>
                  <tr>
                      <th colspan="1">#</th>
                      <th colspan="3" style="text-align: left">Contract conditions<br>(services, goods, other conditions)</th>
                      <th colspan="1" class="center">Amount</th>
                      <th colspan="1" class="center">Unit</th>
                      <th colspan="1" class="center">Price</th>
                      <th colspan="1" class="center">Total</th>
                  </tr>
                  </thead>

                 <tbody>

                 <?php foreach ($invoice->getItems() as $key => $item) { ?>

                 <tr class="border-bottom">
                     <td colspan="1"><?= $key+1 ?></td>
                     <td colspan="3" style="text-align: left"><?= $item->getTitle() ?></td>
                     <td colspan="1" class="center"><?= $item->getHours() ?></td>
                     <td colspan="1" class="center">hour</td>
                     <td colspan="1" class="center">$<?= $item->getCostPerHour() ?></td>
                     <td colspan="1" class="center">$<?= $item->getPrice() ?></td>
                 </tr>

                 <?php } ?>

                 <tr style="border-bottom: none" class="additional-info">
                     <td colspan="1">&nbsp;</td>
                     <td colspan="3" style="text-align: left">&nbsp;</td>
                     <td colspan="1" class="center"></td>
                     <td colspan="1" class="center"></td>
                     <td colspan="1" class="center border-bottom">Sub Total:</td>
                     <td colspan="1" class="center border-bottom">$<?= $invoice->getTotalValue() ?></td>
                 </tr>
                 <tr style="border-bottom: none" class="additional-info">
                     <td colspan="1">&nbsp;</td>
                     <td colspan="4" id="total-sum">
                         <span>Total sum:</span><br>
                         <?php $formatter = \NumberFormatter::create('en-us', NumberFormatter::SPELLOUT); ?>
                         <b><?= ucfirst( $formatter->format($invoice->getTotalValue()) ) ?> US Dollars</b>
                     </td>
                     <td colspan="1" class="center"></td>
                     <td colspan="1" class="center border-bottom">No VAT:</td>
                     <td colspan="1" class="center border-bottom">-</td>
                 </tr>
                 <tr style="border-bottom: none" class="additional-info">
                     <td colspan="1">&nbsp;</td>
                     <td colspan="4" style="text-align: left">&nbsp;</td>
                     <td colspan="1" class="center"></td>
                     <td colspan="1" class="center border-bottom">Invoice Total:</td>
                     <td colspan="1" class="center border-bottom">$<?= $invoice->getTotalValue() ?></td>
                 </tr>

                 </tbody>
             </table>
         </div>
     </div>


     <div id="notes">
         <ol>
             <li>By issuing this invoice the Executor informs the Customer, that the contract conditions listed below have been fulfilled.</li>
             <li>By full or partial paying this invoice the Customer confirms, that all the contract conditions listed below have been utterly fulfilled in due time and with
             adequate quality. And also confirms mutual agreement to use fax or electronic-digital signatures and stamps reproduction in transactions.</li>
             <li>In case the invoice has not been paid within thirty days from the date of its issuance, the work shall be deemed not performed.</li>
             <li>Correspondent bank fee is paid by the Executor.</li>
         </ol>
     </div>

     <div id="sign-block">
         <div id="sign-consumer">
             <div class="sign-title">Benefit Studios LLC.</div>
             <div class="sign-placeholder">By <div class="underline"></div></div>
         </div>
         <div id="sign-executor">
             <div class="sign-title">John Doe</div>
             <div class="sign-placeholder">By <div class="underline"></div></div>
             <div><img class="sign" src="../resources/signuture-john-doe.png" /></div>
         </div>
     </div>

     <div class="clear-fix"></div>

     <div id="wire-transfer-info">
         <div class="title">Wire transfer information</div>
         <table>
             <tr>
                 <td style="width: 50%">
                     <span><b>Beneficiary</b></span><br>
                     <span>John Doe</span><br>
                     <br>
                     <span><b>Details of payment</b></span><br>
                     <span>Payment against invoice #<?= $invoice->getInvoiceNumber() ?>. Work accepted</span>
                 </td>
                 <td style="width: 50%">
                     <span><b>Benficiary’s Bank</b></span><br>
                     <span>Super Driven International Bank</span><br>
                     <span>Account Name: JOHN DOE</span><br>
                     <span>Account Number: 111222333</span><br>
                     <span>SWIFT: SWIFTCODE</span><br>
                 </td>
             </tr>
         </table>
     </div>
 </div>
</body>

</html>
