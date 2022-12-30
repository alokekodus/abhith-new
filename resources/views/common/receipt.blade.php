<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta charset="utf-8" /> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1" /> --}}
    <title>Receipt</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" /> --}}

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800&display=swap");

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        .fs-4 {
            font-size: 1 !important;
        }

        .fs-5 {
            font-size: 1.25rem !important;
        }

        .fw-bold {
            font-weight: 700 !important;
        }

        /* Bootstrap classes */
        .container {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            width: 90%;
            padding-right: calc(var(--bs-gutter-x) * .5);
            padding-left: calc(var(--bs-gutter-x) * .5);
            margin-right: auto;
            margin-left: auto;
        }

        .justify-content-between {
            justify-content: space-between !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .d-flex {
            display: flex !important;
        }

        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }

        .py-4 {
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }

        .px-5 {
            padding-right: 3rem !important;
            padding-left: 3rem !important;
        }

        .justify-content-between {
            justify-content: space-between !important;
        }

        .align-items-end {
            align-items: flex-end !important;
        }

        .flex-column {
            flex-direction: column !important;
        }

        .col-6 {
            flex: 0 0 auto;
            width: 50%;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: var(--bs-table-color);
            vertical-align: top;
            border-color: var(--bs-table-border-color);
        }

        table {
            caption-side: bottom;
            border-collapse: collapse;
        }

        .text-center {
            text-align: center !important;
        }

        .p-4 {
            padding: 1.5rem !important;
        }

        .border {
            border: 1px solid #dee2e6 !important;
        }

        /* Bootstrap classes ends */
        p {
            margin-bottom: 0;
        }

        .main {
            font-family: "Montserrat", sans-serif;
        }

        .divider {
            height: 5px;
            background-color: #f2f2f2;
            width: 100%;
        }

        .top-header {
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .heading {
            font-size: 2rem;
            font-weight: 900;
        }

        .table {
            font-weight: 700;
            font-size: 1.3rem;
        }

        .signature {
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
    <section class="main">
        <div class="top-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div>
                        {{-- <img src="{{asset('asset_website/img/home/logo_.png')}}" alt="Logo" width="400" /> --}}
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="heading">E-Receipt</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="divider"></div>

        <div class="container">
            <div class="details py-5">
                <div class="d-flex justify-content-between">
                    <div class="col-6">
                        <div class="px-5 py-4 border">
                            <p class="fs-5">Receipt to :</p>
                            <p class="fw-bold fs-5">Nilutpal Saikia</p>
                            <p class="fs-5">+91 9812345670</p>
                            <p class="fs-5">mailto:nilutpal.saikia@ekodus.com</p>
                        </div>

                        <div class="d-flex justify-content-between border border-top-0">
                            <div class="px-5 py-4">
                                Board : <br />
                                <span class="fw-bold fs-5">CBSE</span>
                            </div>
                            <div class="px-5 py-4">
                                Class : <br />
                                <span class="fw-bold fs-5">9</span>
                            </div>
                            <div class="px-5 py-4">
                                Package Type : <br />
                                <span class="fw-bold fs-5">Full Course</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 d-flex flex-column align-items-end">
                        <p class="fw-bold fs-5">#541234</p>
                        <p class="fs-5">
                            Date: <span class="fw-bold fs-5">27-12-2022</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <td class="p-4">SL</td>
                        <td class="p-4" style="width: 50%">Subject</td>
                        <td class="p-4">QTY</td>
                        <td class="p-4">Subtotal</td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td class="p-4">1</td>
                        <td class="p-4">Advance Mathematics</td>
                        <td class="p-4">1</td>
                        <td class="p-4">₹ 1000.00</td>
                    </tr>
                    <tr class="text-center">
                        <td class="p-4">1</td>
                        <td class="p-4">Advance Mathematics</td>
                        <td class="p-4">1</td>
                        <td class="p-4">₹ 1000.00</td>
                    </tr>
                    <tr class="text-center">
                        <td class="p-4">1</td>
                        <td class="p-4">Advance Mathematics</td>
                        <td class="p-4">1</td>
                        <td class="p-4">₹ 1000.00</td>
                    </tr>
                    <tr class="text-center">
                        <td class="p-4">1</td>
                        <td class="p-4">Advance Mathematics</td>
                        <td class="p-4">1</td>
                        <td class="p-4">₹ 1000.00</td>
                    </tr>

                    <tr class="text-center">
                        <td colspan="2" class="p-4"></td>
                        <td class="p-4">Subtotal</td>
                        <td class="p-4">₹ 5000.00</td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="2" class="p-4"></td>
                        <td class="p-4">Tax</td>
                        <td class="p-4">₹ 100.00</td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="2" class="p-4"></td>
                        <td class="p-4">Total</td>
                        <td class="p-4">₹ 5100.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="container">
            <div class="signature">
                <p class="sign">Authorised Sign</p>
            </div>
        </div>
    </section>
    {{-- <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script> --}}
</body>

</html>
