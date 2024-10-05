<?php
/**
 * @var array $projects
 */
?><html lang="ru">
<head>
    <style>
        body {
            font-size: 18px;
        }
        #container {
            margin: 10px auto;
            width: 450px;
        }
        .right {
            float: right;
        }
        .splitter {
            clear: both;
            margin-top: 10px;
        }
        .invoice_item {
            position: relative;
            padding: 10px 40px 10px 20px;
            border: 1px #aaa dashed;
            margin-bottom: 20px;
            background-color: #eeeef5;
            border-radius: 4px;
        }
        .close-item-button {
            position: absolute;
            top: 2px;
            right: 1px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            font-weight: bold;
            border: none;
        }
        .value {
            width: 65%;
        }
    </style>
</head>

<body>
    <div id="container">
        <h3>Setup invoice data:</h3>
    <form action="" method="post" id="base_form">
        <label for="invoice_date">Select invoice date</label>
        <input class="right" type="date" name="invoice_date">
        <div class="splitter"></div>

        <label for="billed_month">Select month to bill</label>
        <input class="right" type="month" name="billed_month">
        <div class="splitter"></div>

        <?php if (count($projects) > 1) : ?>
            <div style="text-align: center; margin: 20px">
                Items for invoice: <button id="add_item">Add</button>
            </div>
            <div class="splitter"></div>

            <div class="invoice_item">
                <label for="project_to_bill[]">Project title</label>
                <select class="right value" name="project_to_bill[]">
                    <?php
                    foreach ($projects as $project) {
                        echo "<option value=\"{$project}\">{$project}</option>";
                    }
                    ?>
                </select>
                <button class="close-item-button">X</button>
                <div class="splitter"></div>

                <label for="total_invoice_sum">Hours logged</label>
                <input class="right value" type="number"  step="0.01" name="hours[]">
                <div class="splitter"></div>

                <label for="total_invoice_sum">Hourly rate</label>
                <input class="right" type="number" name="hourly_rate[]">
                <div class="splitter"></div>
            </div>
        <?php else: ?>
            <div class="invoice_item">
                <label for="project_to_bill[]">Project title</label>
                <input type="text"
                       class="right value"
                       name="project_to_bill[]"
                       value="<?= $projects[0] ?>"
                />
                <div class="splitter"></div>

                <label for="total_invoice_sum">Hours logged</label>
                <input class="right value" type="number"  step="0.01" name="hours[]">
                <div class="splitter"></div>

                <label for="total_invoice_sum">Hourly rate</label>
                <input class="right value" type="number" name="hourly_rate[]">
                <div class="splitter"></div>
            </div>
        <?php endif; ?>

        <input name="submit" type="submit" value="Create invoice" id="send_data_button">

    </form>
    </div>

    <div style="display: none" id="hidden_template">
        <div class="invoice_item">
            <label for="project[]">Project</label>
            <select class="right" name="project_to_bill[]">
                <?php
                foreach ($projects as $project) {
                    echo "<option value=\"{$project}\">{$project}</option>";
                }
                ?>
            </select>
            <button class="close-item-button">X</button>
            <div class="splitter"></div>

            <label for="total_invoice_sum">Hours logged</label>
            <input class="right" type="number"  step="0.01" name="hours[]">
            <div class="splitter"></div>

            <label for="total_invoice_sum">Hourly rate</label>
            <input class="right" type="number" name="hourly_rate[]">
            <div class="splitter"></div>
        </div>
    </div>
<script>
    let items = 1;

    const addItemButton = document.getElementById('add_item')
    const sendDataButton = document.getElementById('send_data_button')

    function addInvoiceItem (event) {
        event.preventDefault()

        console.log(event)
        const tpl = document.getElementById('hidden_template')
        const clonedDiv = tpl.cloneNode(true)

        const id = new Date().getTime()
        clonedDiv.setAttribute('id', id)

        sendDataButton.parentNode.insertBefore(clonedDiv, sendDataButton)
        clonedDiv.style.display = 'block'

        const closeButton = clonedDiv.querySelector('.close-item-button')
        closeButton.setAttribute('data-invoice-item-id', id)
        closeButton.addEventListener('click', removeInvoiceItem)
    }

    function removeInvoiceItem (event) {
        event.preventDefault()
        console.log(event)

        const itemId = event.target.getAttribute('data-invoice-item-id')
        event.target.removeEventListener('click', removeInvoiceItem)

        document.getElementById(itemId).remove()
    }

    addItemButton.addEventListener('click', addInvoiceItem)
</script>
</body>
</html>
