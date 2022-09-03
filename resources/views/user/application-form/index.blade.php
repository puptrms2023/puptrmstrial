@extends('layouts.user')

@section('title','PUPTAAAS Dashboard')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ Auth::user()->first_name }}'s Dashboard</h1>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
</div>

<form action="{{ url('user/application-form') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col-md-9">
        <div class="card shadow mt-0 mb-4">
            <div class="card-header pt-3 pb-1">
                <p class="text-primary font-weight-bold">1st Semester</p>
            </div>
            <div class="card-body">
                @include('layouts.partials.messages')
                <table class="table table-sm table-borderless">
                    <thead>
                        <tr>
                            <th><em>Subject</em></th>
                            <th width="20%"><em>Number of Units</em></th>
                            <th width="20%"><em>Grade</em></th>
                            <th><em>Action</em></th>
                            <th width="20%" style="display:none"><em>Total</em></th>
                        </tr>
                    </thead>
                    <tbody id="calculation">
                        <tr>
                            <td><input type="text" name="subjects" class="form-control" required></td>
                            <td><input type="number" name="units" class="form-control units multi" id="units" required>
                            </td>
                            <td><input type="number" name="grades" class="form-control grades multi" step="any"
                                    id="grades" required>
                            </td>
                            <td><button type="button" class="btn btn-primary" id="add_btn"><i
                                        class="fa-solid fa-circle-plus"></i></button>
                            </td>
                            <td style="display:none"><input type="number" name="total" class="form-control total"
                                    id="total" readonly>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="totalUnits">
                <input type="hidden" id="weight">
                <input type="hidden" id="gwa" name="gwa_1st">
                <p class="text-muted"><small>Total Number of Units: </small><small id="totalUnit"></small></p>
                <p class="font-weight-bold">GWA: <b id="gwa2"></b></p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card shadow mt-0 mb-4">
            <div class="card-header pt-3 pb-1">
                <p class="text-primary font-weight-bold">2nd Semester</p>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <thead>
                        <tr>
                            <th><em>Subject</em></th>
                            <th width="20%"><em>Number of Units</em></th>
                            <th width="20%"><em>Grade</em></th>
                            <th><em>Action</em></th>
                            <th width="20%" style="display:none"><em>Total</em></th>
                        </tr>
                    </thead>
                    <tbody id="calculation1">
                        <tr>
                            <td><input type="text" name="subjects1" class="form-control" required></td>
                            <td><input type="number" name="units1" class="form-control units1 multi1" id="units1"
                                    required>
                            </td>
                            <td><input type="number" name="grades1" class="form-control grades1 multi1" step="any"
                                    id="grades1" required>
                            </td>
                            <td><button type="button" class="btn btn-primary" id="add_btn1"><i
                                        class="fa-solid fa-circle-plus"></i></button>
                            </td>
                            <td style="display:none"><input type="number" name="total" class="form-control total1"
                                    id="total1" readonly>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="totalUnits1">
                <input type="hidden" id="weight1">
                <input type="hidden" id="gwa1" name="gwa_2nd">
                <p class="text-muted"><small>Total Number of Units: </small><small id="totalUnit1"></small></p>
                <p class="font-weight-bold">GWA: <b id="gwa21"></b></p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card shadow mt-0 mb-4">
            <div class="card-body">
                <div class="col-md-12 mb-3">
                    <label for="" class="font-weight-bold">School Year</label>
                    <span class="text-danger">*</span>
                    <select class="form-control" name="school_year">
                        <option value="2022-2023">2022-2023</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card shadow mt-0 mb-4">
            <div class="card-body">
                <div class="col-md-12 mb-3">
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                    <label for="" class="font-weight-bold">Academic Level</label>
                    <span class="text-danger">*</span>
                    <select class="form-control" name="year_level">
                        <option value="1st">1st Year</option>
                        <option value="2nd">2nd Year</option>
                        <option value="3rd">3rd Year</option>
                        <option value="4th">4th Year</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card shadow mt-0 mb-4">
            <div class="card-body">
                <div class="col-md-6 mb-3">
                    <label for="formFile" class="form-label font-weight-bold">2x2 photo: </label>
                    <span class="text-danger">*</span>
                    <input type="file" name="image">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card shadow mt-0 mb-4">
            <div class="card-body">
                <div class="col-md-12 mb-3">
                    <label for="" class="font-weight-bold">Award Applied</label>
                    <span class="text-danger">*</span>
                    <select class="form-control" name="award_applied">
                        <option value="1">Achiever's Award</option>
                        <option value="2">Dean's List (1.51-1.75)</option>
                        <option value="3">President's List (1.00 - 1.51)</option>
                        <option value="4">Academic Excellence</option>
                    </select>
                    <small>Status: Qualified</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-4">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
    </div>
    </div>
</form>

@endsection

@section('scripts')

<script>
    $(document).ready(function () {
        $('#add_btn').on('click',function () { 
            var html='';
            html+='<tr>'
            html+='<td><input type="text" name="subjects" class="form-control" required></td>';
            html+='<td><input type="number" name="units" class="form-control units multi" id="units" required></td>';
            html+='<td><input type="number" name="grades" class="form-control grades multi" id="grades" step="any" required></td>';
            html+='<td><button type="button" class="btn btn-secondary" id="remove"><i class="fa-solid fa-circle-minus"></i></button></td>';
            html+='<td style="display:none"><input type="number" name="total" class="form-control total" id="total" readonly></td>';
            html+='</tr>';
            $('#calculation').append(html);
        });
    });

    $(document).on('click','#remove', function () { 
        $(this).closest('tr').remove();
        
    });


    $(document).ready(function(){
        $('#calculation').on("keyup",".multi",function(){
        var parent = $(this).closest('tr');
        var quant= $(parent).find('#units').val();
        var price= $(parent).find('#grades').val();

        $(parent).find('#total').val(quant* price);
        grandTotal();
        totalUnits();
        getGWA();
        });
    });


    function grandTotal(){
        var total_avg = 0;

        $('.total').each(function(){
            total_avg +=Number($(this).val());
        });
        document.getElementById('weight').value = total_avg;
    }

    function totalUnits()
    {
        $(document).on('keyup', ".units",function () {
        var total_units = 0;
  
        $('.units').each(function(){
            total_units += parseFloat($(this).val());
        })  
        document.getElementById('totalUnits').value = total_units;
        document.getElementById('totalUnit').innerHTML = total_units;
        });
    }

    function getGWA()
    {
        var total_units = $('#totalUnits').val();
        var weight = $('#weight').val();
        var gwa = weight/total_units;

        document.getElementById('gwa').value = gwa.toFixed(2);;
        document.getElementById('gwa2').innerHTML = gwa.toFixed(2);;
    }
  
    $(document).ready(function () {
        $('#add_btn1').on('click',function () { 
            var html='';
            html+='<tr>'
            html+='<td><input type="text" name="subjects1" class="form-control" required></td>';
            html+='<td><input type="number" name="units1" class="form-control units1 multi1" id="units1" required></td>';
            html+='<td><input type="number" name="grades1" class="form-control grades1 multi1" id="grades1" step="any" required></td>';
            html+='<td><button type="button" class="btn btn-secondary" id="remove1"><i class="fa-solid fa-circle-minus"></i></button></td>';
            html+='<td style="display:none"><input type="number" name="total1" class="form-control total1" id="total1" readonly></td>';
            html+='</tr>';
            $('#calculation1').append(html);
        });
    });

    $(document).on('click','#remove1', function () { 
        $(this).closest('tr').remove();
        
    });

    $(document).ready(function(){
        $('#calculation1').on("keyup",".multi1",function(){
        var parent1 = $(this).closest('tr');
        var quant1= $(parent1).find('#units1').val();
        var price1= $(parent1).find('#grades1').val();

        $(parent1).find('#total1').val(quant1* price1);
        grandTotal1();
        totalUnits1();
        getGWA1();
    });

    function grandTotal1(){
        var total_avg1 = 0;
        $('.total1').each(function(){
            total_avg1 +=Number($(this).val());
        });
        document.getElementById('weight1').value = total_avg1;
    }

    function totalUnits1()
    {
        $(document).on('keyup', ".units1",function () {
        var total_units = 0;
  
        $('.units1').each(function(){
            total_units += parseFloat($(this).val());
        })  
        document.getElementById('totalUnits1').value = total_units;
        document.getElementById('totalUnit1').innerHTML = total_units;
        });
    }

    function getGWA1()
    {
        var total_units = $('#totalUnits1').val();
        var weight = $('#weight1').val();
        var gwa = weight/total_units;

        document.getElementById('gwa1').value = gwa.toFixed(2);;
        document.getElementById('gwa21').innerHTML = gwa.toFixed(2);;
    }
  
});


</script>

@endsection