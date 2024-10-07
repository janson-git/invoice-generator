## Simple Invoice Generator 

#### TLDR;
```bash
git clone git@github.com:janson-git/invoice-generator.git
cd invoice-generator
# build docker image
make build
# run invoice-generator in docker container
make up
# Done! Open http://localhost:44321 in your browser!

# when you created and saved your invoice, down the docker container
make down
```

### Sample result of invoice generator

![How Invoice Generator works](/docs/how-invoice-generator-work.gif)

**NOTE:** Invoice Generator use  NumberFormatter from INTL php extension to format invoice's **Total sum** as text: 

`123` will converted to `One hundred twenty-three US dollars`.

If you don't need it - remove NumberFormatter usage from invoice template.


### To create new invoice:
0. Open config.php and set up your project title/titles
1. Run Invoice Generator in project folder with `make up` command
2. Open in browser: `http://localhost:4321/`
3. Setup invoice data: date, billed month, number of hours and hourly rate
![](/docs/invoice_generator_form.png)
4. Send form and invoice will be displayed
5. You can print it to PDF-file from browser (Ctrl+P)
6. Stop Invoice Generator with `make down` command

[Example of invoice PDF-file](/docs/2024-10-10%20-%20John%20Doe%20-%20Invoice%20%23241010.pdf)
