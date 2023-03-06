<div id="leadership_fields" class="hidden">

    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">A. Academic Performance (30%)</label>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th rowspan="2" class="align-middle text-center">Academic Year</th>
                            <th colspan="2" class="text-center">General Weighted Average</th>
                        </tr>
                        <tr class="text-center">
                            <th>1st Semester</th>
                            <th>2nd Semester</th>
                        </tr>
                        <tr>
                            <th>First Year</th>
                            <td><input type="text" name="first_year_first" id=""
                                    class="form-control form-control-sm text-center @error('first_year_first') is-invalid @enderror"
                                    value="{{ old('first_year_first') }}">
                            </td>
                            <td><input type="text" name="first_year_second" id=""
                                    class="form-control form-control-sm text-center @error('first_year_second') is-invalid @enderror"
                                    value="{{ old('first_year_second') }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Second Year</th>
                            <td><input type="text" name="second_year_first" id=""
                                    class="form-control form-control-sm text-center @error('second_year_first') is-invalid @enderror"
                                    value="{{ old('second_year_first') }}">
                            </td>
                            <td><input type="text" name="second_year_second" id=""
                                    class="form-control form-control-sm text-center @error('second_year_second') is-invalid @enderror"
                                    value="{{ old('second_year_second') }}"></td>
                        </tr>
                        <tr>
                            <th>Third Year</th>
                            <td><input type="text" name="third_year_first" id=""
                                    class="form-control form-control-sm text-center @error('third_year_first') is-invalid @enderror"
                                    value="{{ old('third_year_first') }}">
                            </td>
                            <td><input type="text" name="third_year_second" id=""
                                    class="form-control form-control-sm text-center @error('third_year_second') is-invalid @enderror"
                                    value="{{ old('third_year_second') }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Fourth Year</th>
                            <td><input type="text" name="fourth_year_first" id=""
                                    class="form-control form-control-sm text-center @error('fourth_year_first') is-invalid @enderror"
                                    value="{{ old('fourth_year_first') }}">
                            </td>
                            <td><input type="text" name="fourth_year_second" id=""
                                    class="form-control form-control-sm text-center @error('fourth_year_second') is-invalid @enderror"
                                    value="{{ old('fourth_year_second') }}"></td>
                        </tr>
                        <tr>
                            <th>Fifth Year</th>
                            <td><input type="text" name="fifth_year_first" id=""
                                    class="form-control form-control-sm text-center @error('fifth_year_first') is-invalid @enderror"
                                    value="{{ old('fifth_year_first') }}">
                            </td>
                            <td><input type="text" name="fifth_year_second" id=""
                                    class="form-control form-control-sm text-center @error('fifth_year_second') is-invalid @enderror"
                                    value="{{ old('fifth_year_second') }}">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">B. Projects Initiated (20%)</label>
                <span class="text-danger">*</span>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Projects</th>
                                <th>Sponsors</th>
                                <th>Inclusive Date</th>
                                <th>Inclusive Level</th>
                                <th>Beneficiaries</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="projects_initiated">
                            @foreach (old('projects', ['']) as $key => $value)
                                <tr>
                                    <td><input type="text" name="projects[]"
                                            class="form-control form-control-sm  @error('projects.' . $key) is-invalid @enderror"
                                            value="{{ $value }}"></td>
                                    <td><input type="text" name="sponsors[]"
                                            class="form-control form-control-sm @error('sponsors.' . $key) is-invalid @enderror"
                                            value="{{ old('sponsors.' . $key) }}"></td>
                                    <td><input type="text"
                                            class="form-control form-control-sm datetimepicker-input @error('inclusive_date.' . $key) is-invalid @enderror"
                                            name="inclusive_date[]" data-toggle="datetimepicker"
                                            data-target="#datetimepicker1" value="{{ old('inclusive_date.' . $key) }}">
                                    </td>
                                    <td><input type="text" name="inclusive_level[]"
                                            class="form-control form-control-sm @error('inclusive_level.' . $key) is-invalid @enderror"
                                            value="{{ old('inclusive_level.' . $key) }}"></td>
                                    <td><input type="text" name="beneficiaries[]"
                                            class="form-control form-control-sm @error('beneficiaries.' . $key) is-invalid @enderror"
                                            value="{{ old('beneficiaries.' . $key) }}"></td>
                                    <td><button type="button" class="btn btn-danger btn-sm"
                                            onclick="removeRow(this)">Remove</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" onclick="addRow()">Add Row</button>
            </div>
        </div>
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">C. Officership/Membership (20%)</label>
                <span class="text-danger">*</span>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Organization</th>
                                <th>Position Held</th>
                                <th>Date Received</th>
                                <th>*Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="officership">
                            @foreach (old('organization', ['']) as $key => $officer)
                                <tr>
                                    <td><input type="text" name="organization[]"
                                            class="form-control form-control-sm @error('organization.' . $key) is-invalid @enderror"
                                            value="{{ $officer }}"></td>
                                    <td><input type="text" name="position_held[]"
                                            class="form-control form-control-sm @error('position_held.' . $key) is-invalid @enderror"
                                            value="{{ old('position_held.' . $key) }}"></td>
                                    <td><input type="text"
                                            class="form-control form-control-sm datetimepicker-input @error('date_received.' . $key) is-invalid @enderror"
                                            name="date_received[]" data-toggle="datetimepicker"
                                            data-target="#datetimepicker1"
                                            value="{{ old('date_received.' . $key) }}">
                                    </td>
                                    <td><input type="text" name="level[]"
                                            class="form-control form-control-sm @error('level.' . $key) is-invalid @enderror"
                                            value="{{ old('level.' . $key) }}"></td>
                                    <td><button type="button" class="btn btn-danger btn-sm"
                                            onclick="removeRow1(this)">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" onclick="addRow1()">Add Row</button>
            </div>
        </div>
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">D. Awards/Received (10%)</label>
                <span class="text-danger">*</span>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Awards</th>
                                <th>Awarded By</th>
                                <th>Date Received</th>
                                <th>*Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="awards_received">
                            @foreach (old('award', ['']) as $key => $value)
                                <tr>
                                    <td><input type="text" name="award[]"
                                            class="form-control form-control-sm @error('award.' . $key) is-invalid @enderror"
                                            value="{{ $value }}"></td>
                                    <td><input type="text" name="awarded_by[]"
                                            class="form-control form-control-sm @error('awarded_by.' . $key) is-invalid @enderror"
                                            value="{{ old('awarded_by.' . $key) }}"></td>
                                    <td><input type="text"
                                            class="form-control form-control-sm datetimepicker-input @error('date_received_off.' . $key) is-invalid @enderror"
                                            name="date_received_off[]" data-toggle="datetimepicker"
                                            data-target="#datetimepicker1"
                                            value="{{ old('date_received_off.' . $key) }}">
                                    </td>
                                    <td><input type="text" name="level_off[]"
                                            class="form-control form-control-sm @error('level_off.' . $key) is-invalid @enderror"
                                            value="{{ old('level_off.' . $key) }}"></td>
                                    <td><button type="button" class="btn btn-danger btn-sm"
                                            onclick="removeRow2(this)">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" onclick="addRow2()">Add Row</button>
            </div>
        </div>
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">E. Community Outreach (10%)</label>
                <span class="text-danger">*</span>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Involvement</th>
                                <th>Sponsored By</th>
                                <th>Inclusives Dates</th>
                                <th>*Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="community">
                            @foreach (old('projects_com', ['']) as $key => $value)
                                <tr>
                                    <td><input type="text" name="projects_com[]" value="{{ $value }}"
                                            class="form-control form-control-sm @error('projects_com.' . $key) is-invalid @enderror">
                                    </td>
                                    <td><input type="text" name="involvement[]"
                                            value="{{ old('involvement.' . $key) }}"
                                            class="form-control form-control-sm @error('involvement.' . $key) is-invalid @enderror">
                                    </td>
                                    <td><input type="text" name="sponsored_by[]"
                                            value="{{ old('sponsored_by.' . $key) }}"
                                            class="form-control form-control-sm @error('sponsored_by.' . $key) is-invalid @enderror">
                                    </td>
                                    <td><input type="text"
                                            class="form-control form-control-sm datetimepicker-input @error('inclusive_date_com.' . $key) is-invalid @enderror"
                                            name="inclusive_date_com[]"
                                            value="{{ old('inclusive_date_com.' . $key) }}"
                                            data-toggle="datetimepicker" data-target="#datetimepicker1"></td>
                                    <td><input type="text" name="level_comm[]"
                                            value="{{ old('level_comm.' . $key) }}"
                                            class="form-control form-control-sm @error('level_comm.' . $key) is-invalid @enderror">
                                    </td>
                                    <td><button type="button" class="btn btn-danger btn-sm"
                                            onclick="removeRow3(this)">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" onclick="addRow3()">Add Row</button>
            </div>
        </div>
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">F. Interview Results (10%) </label>
                <input type="file" class="form-control" name="interview">
                @if ($errors->has('interview'))
                    <div class="text-danger text-left">{{ $errors->first('interview') }}</div>
                @endif
                <span class="small">PDF, DOCX, DOC file is accepted</span>
            </div>
        </div>
    </div>
</div>
