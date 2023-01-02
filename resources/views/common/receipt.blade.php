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

        table td {
            padding: 20px 10px;
        }

        table thead tr {
            font-weight: 700;
            background-color: #f2f2f2;
        }

        table.payment-details {
            font-weight: 700;
        }

        table.payment-details tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .text-right {
           
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .heading {
            font-size: 2rem;
            font-weight: 700;
        }

        span {
            font-weight: 700;
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
    <section>
        <table>
            <tr>
                <td>
                    <img src="{{asset('asset_website/img/home/logo_.png')}}" />
                </td>
                <td colspan="2">
                    <p class="text-right heading">E-Receipt</p>
                </td>
            </tr>

            <tr>
                <td>
                    <p>Receipt to :</p>
                    <p><span>{{$user_details['user_name']}}</span></p>
                    <p>{{$user_details['mobile']}}</p>
                    <p>{{$user_details['email']}}</p>
                </td>

                <td>
                    <p class="text-right"><span>#{{$user_details['receipt_no']}}</span></p>
                    <p>Date: <span>{{dateFormat($course_detatils['created_at'],"d-m-Y")}}</span></p>
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
                @foreach($course_detatils['subjects'] as $key=>$subject)
                <tr class="text-center">
                    <td>{{$key+1}}</td>
                    <td>{{$course_detatils['subjects'][$key]['subject']['subject_name']}}</td>
                    <td>1</td>
                    <td>&#8377; {{$course_detatils['subjects'][$key]['amount']}}</td>
                </tr>
                @endforeach

                <tr class="text-center">
                    <td colspan="2"></td>
                    <td>Subtotal</td>
                    <td>&#8377;{{$course_detatils['total_amount']}}</td>
                </tr>
                <tr class="text-center">
                    <td colspan="2"></td>
                    <td>Tax</td>
                    <td>&#8377; 0.00</td>
                </tr>
                <tr class="text-center">
                    <td colspan="2"></td>
                    <td>Total</td>
                    <td>&#8377; {{$course_detatils['subjects'][$key]['amount']}}</td>
                </tr>
            </tbody>
        </table>
    </section>

    <div class="signature">
        <p class="sign">Authorised Sign</p>
    </div>
</body>

</html>