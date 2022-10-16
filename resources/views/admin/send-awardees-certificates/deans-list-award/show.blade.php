<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Dean's List Certificate</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0
        }

        body {
            margin: 0;
            height: 8.27in;
            width: 11.69in;
            background-image: url('admin/img/cert_layout1.jpg');
            background-size: 11.69in 8.27in;
            background-repeat: no-repeat;
        }

        .name {
            font-family: 'Times New Roman', Times, serif;
            font-size: .60in;
            line-height: .44in;
            font-weight: 700;
            color: #000000;
            margin-top: 4.12in;
            text-align: center;
        }

        .description {
            margin-top: 35px;
            text-align: center;
            font-weight: 500;
        }

        .date {
            margin-top: 10px;
            text-align: center;
            font-weight: 500;
        }

        table {
            width: 63%;
            border-collapse: collapse;
            margin: 50px auto;
            position: relative;
        }

        .table2 td,
        th {
            border: none;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 15px;
            right: 50px;
            height: 120px;
            font-family: "Arial", "sans-serif";
            font-size: 10px;
        }

        .scan {
            display: inline-block;
            color: white;
            margin-left: 4px;
            font-size: 9px;
            font-weight: bold;
        }

        .qr {
            width: 25%;
            float: left;
        }
    </style>
</head>

<body>
    <div class="name">
        @if ($mname == '')
            {{ $fname . ' ' . $lname }}
        @else
            {{ $fname . ' ' . $mname . ' ' . $lname }}
        @endif
    </div>
    <div class="description">for the remarkable academic performance as a student of this institution for obtaning<br>
        a General Weighted Average of {{ $gwa }} qualified for the Dean's List Award for the S.Y.
        {{ $sy }}.
    </div>
    <div class="date">Given this day, {{ date('jS \of F Y') }} via Google Mail</div>
    <table class="table2">
        <tr>
            @foreach ($sig->take(3) as $item)
                <td width="21%">
                    <b>{{ $item->name }}</b><br>
                    {{ $item->position }}
                </td>
            @endforeach
        </tr>
    </table>
    <table class="table2">
        <tr>
            @foreach ($sig as $item)
                @if ($loop->last)
                    <td>
                        <b>{{ $item->name }}</b><br>
                        {{ $item->position }}
                    </td>
                @endif
            @endforeach
        </tr>
    </table>
    <footer>
        <div class="qr">
            <img src="data:image/png;base64, {!! $qrcode !!}" width="25%" alt="">
            <span class="scan">
                Scan QR Code for verification<br>
                Date Generated: {{ date('m-d-y') }}
            </span>
        </div>
    </footer>
</body>

</html>
