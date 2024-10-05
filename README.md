## Simple Invoice Generator 

![Sample of invoice](/docs/invoice_generator_invoice.png)

**NOTE:** It requires INTL php extension installed. Invoice Generator use NumberFormatter to format invoice's **Total sum** as text: 

`123` will converted to `One hundred twenty-three US dollars`.

If you don't need it - remove NumberFormatter usage from invoice template.

For example, to install INTL for php8.2 use:
```text
sudo apt-get install php8.2-intl
```

### To create new invoice:
0. Open config.php and set up your project title/titles
1. Start PHP server in project folder with `make up` command (or type manually `php -S 127.0.0.1:4321`)
2. Open in browser: `http://localhost:4321/`
3. Setup invoice data: date, billed month, number of hours and hourly rate
![](/docs/invoice_generator_form.png)
4. Send form and invoice will be displayed
5. You can print it to PDF-file from browser (Ctrl+P)

[Example of invoice PDF-file](/docs/2024-10-10%20-%20John%20Doe%20-%20Invoice%20%23241010.pdf)
