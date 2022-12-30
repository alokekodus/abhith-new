<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <style>
      @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800&display=swap");

      body {
        font-family: "Montserrat", sans-serif;
      }

      table {
        width: 100%;
        font-size: 1.2rem
      }

      table td{
        padding: 20px 10px;
      }

      table thead tr{
        font-weight: 700;
        background-color: #f2f2f2;
      }

      table.payment-details{
        font-weight: 700;
      }

      table.payment-details tbody tr:nth-child(even){
        background-color: #f2f2f2;
      }

      .text-right{
        text-align: right;
      }

      .text-center{
        text-align: center;
      }

      .heading{
        font-size: 2rem;
        font-weight: 700;
      }

      span{
        font-weight: 700;
      }

      .signature{
        padding-top: 300px;
        padding-bottom: 200px;
      }

      .sign {
        border-top: 5px solid;
        padding-top: 20px;
        padding-left: 20px;
        padding-right: 20px;
        font-weight: 700;
        font-size: 1.3rem;
        float: right;
      }
    </style>
  </head>
  <body>
    <section>
      <table>
        <tr>
          {{-- <td>
            <img src="http://127.0.0.1:8000/asset_website/img/home/logo_.png" alt="" />
          </td> --}}
          <td colspan="2">
            <p class="text-right heading">E-Receipt</p>
          </td>
        </tr>

        <tr>
            <td>
              <p>Receipt to :</p>
              <p><span>Nilutpal Saikia</span></p>
              <p>+91 9812345670</p>
              <p>nilutpal.saikia@ekodus.com</p>
            </td>
  
            <td>
              <p class="text-right"><span>#541234</span></p>
              <p class="text-right">Date: <span>27-12-2022</span></p>
            </td>
          </tr>
      </table>

      <table style="margin-top: 50px;" class="payment-details">
        <thead>
          <tr class="text-center">
            <td>SL</td>
            <td style="width: 50%">Subject</td>
            <td>QTY</td>
            <td>Subtotal</td>
          </tr>
        </thead>
        <tbody>
          <tr class="text-center">
            <td>1</td>
            <td>Advance Mathematics</td>
            <td>1</td>
            <td>&#8377; 1000.00</td>
          </tr>
          <tr class="text-center">
            <td>2</td>
            <td>Advance Mathematics</td>
            <td>1</td>
            <td>&#8377; 1000.00</td>
          </tr>
          <tr class="text-center">
            <td>3</td>
            <td>Advance Mathematics</td>
            <td>1</td>
            <td>&#8377; 1000.00</td>
          </tr>
          <tr class="text-center">
            <td>4</td>
            <td>Advance Mathematics</td>
            <td>1</td>
            <td>&#8377; 1000.00</td>
          </tr>

          <tr class="text-center">
            <td colspan="2"></td>
            <td>Subtotal</td>
            <td>&#8377; 5000.00</td>
          </tr>
          <tr class="text-center">
            <td colspan="2"></td>
            <td>Tax</td>
            <td>&#8377; 100.00</td>
          </tr>
          <tr class="text-center">
            <td colspan="2"></td>
            <td>Total</td>
            <td>&#8377; 5100.00</td>
          </tr>
        </tbody>
      </table>
    </section>

    <div class="signature">
        <p class="sign">Authorised Sign</p>
      </div>
  </body>
</html>
