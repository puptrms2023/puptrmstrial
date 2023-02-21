<!DOCTYPE html>
<html>

<head>
    <title>President's List Applicants</title>
    <style type="text/css">
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            width: 95%;
            border-collapse: collapse;
            margin: 50px auto;
            position: relative;
        }

        .table2 td,
        th {
            border: none;
            text-align: center;
        }

        .table1 {
            margin: 0 auto;
        }

        .table1 td,
        th {
            padding: 10px;
            border: 1.5px solid black;
            font-size: 13px;
        }

        .table1 tr th {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            border: 1.5px solid black;
        }

        .table3 {
            margin: 0 auto;
            border: none;
        }

        .table3 td,
        th {
            border: none;
            font-size: 14px;
            font-weight: normal;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        hr {
            width: 95%;
            height: 1px;
            border: 0;
            border-top: 1px solid rgb(112, 111, 111);
            margin-top: 110px;
            padding: 0;
        }

        /**footer**/
        h4 {
            overflow: hidden;
            text-align: center;
        }

        h4:before,
        h4:after {
            background-color: #000;
            content: "";
            display: inline-block;
            height: 1px;
            position: relative;
            vertical-align: middle;
            width: 50%;
        }

        h4:before {
            right: 0.5em;
            margin-left: -50%;
        }

        h4:after {
            left: 0.5em;
            margin-right: -50%;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 50px;
            right: 50px;
            height: 165px;
            /** Extra personal styles **/
            font-family: "Arial", "sans-serif";
            font-size: 10px;
        }

        .text {
            margin-top: 13px;
            font-family: "Times New Roman", "serif";
            font-size: 20px;
        }

        .caps {
            font-family: "Times New Roman", "serif";
            font-size: 23px;
        }
    </style>
</head>

<body>
    <div style="width: 95%; margin: 0 auto;">
        <div style="width:15%;float:left;margin-right:20px;">
            <img src="admin/img/puplogopdf.png" width="100%" alt="">
        </div>
        <div style="font-family: Times New Roman;float:left;">
            <p>Republic of the Philippines <br>
                <b>POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</b> <br>
                Office of the Vice President for Branches and Satellite Campuses <br>
                <b>TAGUIG BRANCH</b><br>
            </p>
        </div>
    </div>
    <hr />
    <table class="table3">
        <tr>
            <th style="text-align: left; font-size:22px;font-weight:bold;">List of President's List Applicants</th>
            <td></td>

        </tr>
        <tr>
            <th style="text-align: left;"><b>Date Printed:</b> {{ date('Y-m-d') }}</th>
            <td></td>
        </tr>
    </table>
    <table class="table1">
        <thead>
            <tr>
                <th>Student Number</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Course</th>
                <th>Year Level</th>
                <th>1st Sem GWA</th>
                <th>2nd Sem GWA</th>
            </tr>
        </thead>

        <body>
            @foreach ($students as $stud)
                <tr>
                    <td align="center">{{ $stud->users->stud_num }}</td>
                    <td>{{ $stud->users->last_name }}</td>
                    <td>{{ $stud->users->first_name }}</td>
                    <td width="12%" align="center">{{ $stud->courses->course_code }}</td>
                    <td width="15%" align="center">{{ $stud->year_level }}</td>
                    <td width="12%" align="center">{{ $stud->gwa_1st }}</td>
                    <td width="12%" align="center">{{ $stud->gwa_2nd }}</td>
                </tr>
            @endforeach
        </body>
    </table>
    <br>
    <div style="width: 95%; margin: 0 auto;">
        <h4><i>NOTHING FOLLOWS</i></h4>
    </div>
    <table class="table2">
        <tr>
            <td>Signed by:</td>
            <td>
                @if (name1Report()->signature != null)
                    <div class="img-sig">
                        <img src="{{ public_path('uploads/signature/' . name1Report()->signature) }}" width="100" />
                    </div>
                @endif
                <b>{{ name1Report()->rep_name }}</b><br>
                {{ name1Report()->position }}
            </td>
            <td>
                @if (name2Report()->signature != null)
                    <div class="img-sig">
                        <img src="{{ public_path('uploads/signature/' . name2Report()->signature) }}" width="100" />
                    </div>
                @endif
                <b>{{ name2Report()->rep_name }}</b><br>
                {{ name2Report()->position }}
            </td>
            <td>
                @if (name3Report()->signature != null)
                    <div class="img-sig">
                        <img src="{{ public_path('uploads/signature/' . name3Report()->signature) }}" width="100" />
                    </div>
                @endif
                <b>{{ name3Report()->rep_name }}</b><br>
                {{ name3Report()->position }}
            </td>
        </tr>
        <tr>
            <td>Noted by:</td>
            <td colspan="3" align="center" height="110">
                @if (name4Report()->signature != null)
                    <div class="img-sig">
                        <img src="{{ public_path('uploads/signature/' . name4Report()->signature) }}" width="100" />
                    </div>
                @endif
                <b>{{ name4Report()->rep_name }}</b><br>
                {{ name4Report()->position }}
            </td>
        </tr>
    </table>
    <footer>
        <div style="margin-top:25px;">
            <span>General Santos Avenue, Lower
                Bicutan, Taguig City, Philippines 1632</span><br>
            <span>Registrar’s Office: (02) 8837 5859 | Direct Line: (02) 8837 5858 to 60</span><br>
            <span>Website: <a href="www.pup.edu.ph">www.pup.edu.ph</a> | Email: <a
                    href="taguig@pup.edu.ph">taguig@pup.edu.ph</a> |
                <a href="taguig.registrar@pup.edu.ph">taguig.registrar@pup.edu.ph</a></span>
            <div class="text">
                <span class="caps">T</span>HE <span class="caps">C</span>OUNTRY&rsquo;S 1<sup>st</sup> <span
                    class="caps">P</span>OLYTECHNIC<span class="caps">U</span>
            </div>
        </div>
    </footer>
    <footer>
        <div style="width:28%;float:right;">
            <img src="admin/img/footer2.png" width="100%" alt="">
        </div>
    </footer>
</body>

</html>
