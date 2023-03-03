<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Certificate</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0
        }

        body {
            margin: 0;
            height: 8.27in;
            width: 11.69in;
            background-image: url('{{ asset('admin/img/' . $award . '.jpg') }}');
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

        .img-sig {
            margin-top: -25px;
        }

        .highlight {
            font-size: 17px;
        }
    </style>
    @if (!in_array($award, ['AA', 'PL', 'AE', 'DL']))
        <style type="text/css">
            body {
                background-image: url('{{ asset('admin/img/NA.jpg') }}');
                background-size: 11.69in 8.27in;
                background-repeat: no-repeat;
            }
        </style>
    @endif
</head>

<body>
    <div class="name">
        @if ($mname == '')
            {{ $fname . ' ' . $lname }}
        @else
            {{ $fname . ' ' . $mname . ' ' . $lname }}
        @endif
    </div>
    <div class="description">
        @if ($award == 'LA' || $award == 'AYA' || $award == 'OOA' || $award == 'BTA')
            for the remarkable performance in this institution, receiving the<br>
            <span class="highlight">{{ $award_name }}</span> in the S.Y. {{ $sy }}.
        @elseif ($award == 'GOP' || $award == 'GSA')
            for the remarkable service and performance<br>
            in the institution for the Academic Year {{ $sy }}.
        @elseif ($award == 'OC')
            for the representing the institution/organization on the Academic Year {{ $sy }}.
        @elseif ($award == 'GPDT' || $award == 'GPCG')
            for the remarkable performance and outstanding participation in<br>
            the <span class="highlight">{{ $award_name }}</span> for the <br> Academic Year {{ $sy }}.
        @elseif ($award == 'AA' || $award == 'DL' || $award == 'PL' || $award == 'AE')
            for the remarkable academic performance as a student of this institution for obtaning<br>
            a <span class="highlight">General Weighted Average</span> of
            @if (!empty($summer) && empty($fifth_1))
                {{ number_format((float) $totalwithSummer, 3, '.', '') }}
            @elseif(!empty($fifth_1 || $fifth_2) && empty($summer))
                {{ number_format((float) $totalwith5thYear, 3, '.', '') }}
            @elseif(!empty($summer && $fifth_1))
                {{ number_format((float) $totalwith5thAndSummer, 3, '.', '') }}
            @else
                {{ $gwa }}
            @endif
            qualified for the {{ $award_name }} for the S.Y.
            {{ $sy }}.
        @endif
    </div>
    <div class="date"><span class="highlight">Given this day, {{ date('jS \of F Y') }}</span> via Google Mail</div>
    <table class="table2">
        <tr>
            <td width="21%">
                @if ($signature1 != null)
                    <div class="img-sig">
                        <img src="{{ public_path('uploads/signature/' . $signature1) }}" width="100" />
                    </div>
                @endif
                <b>{{ $name1 }}</b><br>
                {{ $position1 }}
            </td>
            <td width="21%">
                @if ($signature2 != null)
                    <div class="img-sig">
                        <img src="{{ public_path('uploads/signature/' . $signature2) }}" width="100" />
                    </div>
                @endif
                <b>{{ $name2 }}</b><br>
                {{ $position2 }}
            </td>
            <td width="21%">
                @if ($signature3 != null)
                    <div class="img-sig">
                        <img src="{{ public_path('uploads/signature/' . $signature3) }}" width="100" />
                    </div>
                @endif
                <b>{{ $name3 }}</b><br>
                {{ $position3 }}
            </td>
        </tr>
    </table>
    <table class="table2">
        <tr>
            <td>
                @if ($signature4 != null)
                    <div class="img-sig">
                        <img src="{{ public_path('uploads/signature/' . $signature4) }}" width="100" />
                    </div>
                @endif
                <b>{{ $name4 }}</b><br>
                {{ $position4 }}
            </td>
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
