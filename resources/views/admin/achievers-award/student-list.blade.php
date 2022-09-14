<!DOCTYPE html>
<html>
<head>
  <title>Achiever Awardee Applicants</title>
  <style type="text/css">
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
    table {
        width: 95%;
        border-collapse: collapse;
        margin: 50px auto;
        position: relative;
    }
    .no {
        border:none;
    }
    .text-center {
        text-align: center;
    }
    .table1 {
        margin:0 auto;
    }
    .table1 td, th{
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
    .table2 td, th{
        border: none;
        text-align: center;
    }
    .table3 {
        margin: 0 auto;
        border: none;
    }
    .table3 td, th{
        border: none;
        font-size: 14px;
        font-weight: normal;
    }
    .column {
        float: left;
        width: 25%;
        padding: 10px;
        height: 300px;
    }
    .row:after {
        content: "";
        display: table;
        clear: both;
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
hr {
    width: 95%;
    height: 1px;
    border: 0;
    border-top: 1px solid rgb(112, 111, 111);
    margin-top: 110px;
    padding: 0;
}
  </style>
</head>
<body>
    <div style="width: 95%; margin: 0 auto;">
        <div style="width:15%;float:left;margin-right:20px;">
            <img src="admin/img/puplogopdf.png" width="100%" alt="">
        </div>
        <div style="float:left;">
            <p>Republic of the Philippines <br>
                <b>POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</b>   <br>
                Office of the Vice President for Branches and Satellite Campuses   <br>
                <b>TAGUIG BRANCH</b><br>
            </p>
        </div>
    </div>
    <hr/>
    <table class="table3">
        <tr>
            <th style="text-align: left; font-size:22px;font-weight:bold;">List of Achievers Awardee Applicants</th>
            <td></td>

        </tr>
        <tr>
            <th style="text-align: left;"><b>Date Created:</b> {{ date('Y-m-d') }}</th>
            <td></td>
        </tr>
    </table>
    <table class="table1">
        <thead>
            <tr>
                <th>Student Number</th>
                <th>Name</th>
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
                <td>{{ $stud->users->last_name.', '.$stud->users->first_name }}</td>
                <td width="12%"">{{ $stud->courses->course_code }}</td>
                <td width="15%">{{ $stud->year_level }}</td>
                <td width="12%" align="center">{{ $stud->gwa_1st}}</td>
                <td width="12%" align="center">{{ $stud->gwa_2nd }}</td>
            </tr>
            @endforeach
        </body>
    </table>
    <br>
    <div  style="width: 95%; margin: 0 auto;">
        <h4><i>NOTHING FOLLOWS</i></h4>
    </div>
    <table class="table2">
        <tr>
            <th ></th>
            <th ></th>
            <th ></th>
            <th ></th>
        </tr>
        <tr>
            <td>Signed by:</td>
            <td>
                <b>Mr. Mhel P. Garcia</b><br>
                Head of Registrar Office
            </td>
            <td>
                <b>Ms. Liwanag Maliksi</b><br>
                Guidance Councelor
            </td>
            <td>
                <b>Ms. Bernadette I. Canlas</b><br>
                Head of Student Services
            </td>
        </tr>
    </table>
</body>
</html>
