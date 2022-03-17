<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Reservasi | Hotel Hebat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('img/logo/oyo.ico') }}" type="image/x-icon">
</head>

<style>
    table tr td,
    table tr th {

        font-size: 15px;

    }

    @page {

        margin: 50px 25px;

        margin-bottom: 0cm;

    }

    /* .gambar{

        width: 450px;

        opacity: 0.1;

        margin-top: 240px; 

        position: relative;

    } */

    .logo {

        max-width: 150px;

        max-height: 150px;

        margin-right: 500px;

    }

    .reservasi {

        /* margin-top: -400px; */

    }

    .custom-footer-page-number:after {

        content: counter(page) " / "counter(page);

    }

    footer {

        position: fixed;

        bottom: 0cm;

        left: 0cm;

        right: 0cm;

        height: 1.3cm;

        margin-right: -25px;

        margin-left: -25px;

        font-size: 12px;



        /** Extra personal styles **/

        /*background-color: #135889;

        color: white;*/

        line-height: 0.05cm;

    }

    .space {

        width: 80%;

    }

    #footer {

        position: fixed;

        width: 100%;

        bottom: 0;

        left: 0;

        right: 0;

    }

    /* .foto{

        max-height: 200px;

        margin-left: -100px;

    } */

    .data {

        margin-left: 100px;

    }



    .content {

        margin-top: -50px;

    }

    .pagenum:before {

        content: counter(page);

    }

    .validasi {
        margin-top: 140px;
        /* margin-left: 100px; */
    }

</style>

<body>

    <header>
        <div class="row">
            <div class="col col-md-4">

                <img src="{{ $logo }}" class="logo d-block" width="80%" style="width: 20% !important; margin-left: 10%">

            </div>

            <center>

                <div class="col col-md-8" style="font-size: 12px; margin-left: 100px; margin-top: -18.5%;">

                    <p style="font-size: 18px;">
                    <h4>HOTEL HEBAT</h4>Jl. Kopo Raya No. 401, Babakan Ciparay, West Java 40235, Indonesia <br>Telepon
                    (021) 3456789 <br>Email : marketing@hotelhebat.com <br>Website : <a href="#">hotelhebat.com</a></p>

                </div> <br>

                <div class="col col-md-4" style="font-size: 12px;">

                    <hr>

                    <h5 class="mt-5">BUKTI RESERVASI<br>HOTEL HEBAT</h5>

                </div>

            </center>
        </div>
    </header>

    <div class="col-md-8 reservasi data">

        <table width="100%" class="ml-1 mt-5 " style="font-size: 15px;" cellpadding="10" cellspacing="10">

            <tr>

                <td>Nama Pemesan</td>

                <td>:</td>

                <td>{{ $reservasi->nama }}</td>

            </tr>

            <tr>

                <td>Email</td>

                <td>:</td>

                <td>{{ $reservasi->email }}</td>

            </tr>

            <tr>

                <td>No. Handphone</td>

                <td>:</td>

                <td>{{ $reservasi->nohp }}</td>

            </tr>

            <tr>

                <td>Nama Tamu</td>

                <td>:</td>

                <td>{{ $reservasi->nama_tamu }}</td>

            </tr>

            <tr>

                <td>Tanggal Pemesanan</td>

                <td>:</td>

                <td>{{ date('d F Y', strtotime($reservasi->tgl_reservasi)) }}</td>

            </tr>

            <tr>

                <td>Tanggal Cek In</td>

                <td>:</td>

                <td>{{ date('d F Y', strtotime($reservasi->tgl_checkin)) }}</td>

            </tr>

            <tr>

                <td>Tanggal Cek Out</td>

                <td>:</td>

                <td>{{ date('d F Y', strtotime($reservasi->tgl_checkout)) }}</td>

            </tr>

            <tr>

                <td>Tipe Kamar</td>

                <td>:</td>

                <td>{{ $reservasi->tipe_kamar }}</td>

            </tr>

            <tr>

                <td>Jumlah Kamar</td>

                <td>:</td>

                <td>{{ $reservasi->jumlah_kamar }}</td>

            </tr>

        </table>

        <div class="validasi">
            <div class="flex">
                <div class="flc" align="left">
                    <h6 class="">RESEPSIONIS HOTEL HEBAT</h6>
                    <br><br>
                    <p class="">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kevin Sipahutar</p>
                </div>
                <div class="flc" style="margin-top: -15.7%px; margin-left: 48%">
                    <h6 class="">ADMIN WEB HOTEL HEBAT</h6>
                    <br><br>
                    <p class="">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kevin Sipahutar</p>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>