<div id="outstanding_fields" class="hidden">
    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">A. Projects Initiated (40%)</label>
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
                        <tbody id="o_projects_initiated">
                            @foreach (old('oprojects', ['']) as $key => $value)
                                <tr>
                                    <td><input type="text" name="oprojects[]"
                                            class="form-control form-control-sm  @error('oprojects.' . $key) is-invalid @enderror"
                                            value="{{ $value }}"></td>
                                    <td><input type="text" name="osponsors[]"
                                            class="form-control form-control-sm @error('osponsors.' . $key) is-invalid @enderror"
                                            value="{{ old('osponsors.' . $key) }}"></td>
                                    <td><input type="text"
                                            class="form-control form-control-sm datetimepicker-input @error('oinclusive_date.' . $key) is-invalid @enderror"
                                            name="oinclusive_date[]" data-toggle="datetimepicker"
                                            data-target="#datetimepicker1" value="{{ old('oinclusive_date.' . $key) }}">
                                    </td>
                                    <td><input type="text" name="oinclusive_level[]"
                                            class="form-control form-control-sm @error('oinclusive_level.' . $key) is-invalid @enderror"
                                            value="{{ old('oinclusive_level.' . $key) }}"></td>
                                    <td><input type="text" name="obeneficiaries[]"
                                            class="form-control form-control-sm @error('obeneficiaries.' . $key) is-invalid @enderror"
                                            value="{{ old('obeneficiaries.' . $key) }}"></td>
                                    <td><button type="button" class="btn btn-danger btn-sm"
                                            onclick="o_removeRow(this)">Remove</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" onclick="o_addRow()">Add Row</button>
            </div>
        </div>
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">B. Awards/Received (20%)</label>
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
                        <tbody id="o_awards_received">
                            @foreach (old('oaward', ['']) as $key => $value)
                                <tr>
                                    <td><input type="text" name="oaward[]"
                                            class="form-control form-control-sm @error('oaward.' . $key) is-invalid @enderror"
                                            value="{{ $value }}"></td>
                                    <td><input type="text" name="oawarded_by[]"
                                            class="form-control form-control-sm @error('oawarded_by.' . $key) is-invalid @enderror"
                                            value="{{ old('oawarded_by.' . $key) }}"></td>
                                    <td><input type="text"
                                            class="form-control form-control-sm datetimepicker-input @error('odate_received_off.' . $key) is-invalid @enderror"
                                            name="odate_received_off[]" data-toggle="datetimepicker"
                                            data-target="#datetimepicker1"
                                            value="{{ old('odate_received_off.' . $key) }}">
                                    </td>
                                    <td><input type="text" name="olevel_off[]"
                                            class="form-control form-control-sm @error('olevel_off.' . $key) is-invalid @enderror"
                                            value="{{ old('olevel_off.' . $key) }}"></td>
                                    <td><button type="button" class="btn btn-danger btn-sm"
                                            onclick="o_removeRow1(this)">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" onclick="o_addRow1()">Add Row</button>
            </div>
        </div>
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">C. Community Involvement (20%)</label>
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
                        <tbody id="o_community">
                            @foreach (old('oprojects_com', ['']) as $key => $value)
                                <tr>
                                    <td><input type="text" name="oprojects_com[]" value="{{ $value }}"
                                            class="form-control form-control-sm @error('oprojects_com.' . $key) is-invalid @enderror">
                                    </td>
                                    <td><input type="text" name="oinvolvement[]"
                                            value="{{ old('oinvolvement.' . $key) }}"
                                            class="form-control form-control-sm @error('oinvolvement.' . $key) is-invalid @enderror">
                                    </td>
                                    <td><input type="text" name="osponsored_by[]"
                                            value="{{ old('osponsored_by.' . $key) }}"
                                            class="form-control form-control-sm @error('osponsored_by.' . $key) is-invalid @enderror">
                                    </td>
                                    <td><input type="text"
                                            class="form-control form-control-sm datetimepicker-input @error('oinclusive_date_com.' . $key) is-invalid @enderror"
                                            name="oinclusive_date_com[]"
                                            value="{{ old('oinclusive_date_com.' . $key) }}"
                                            data-toggle="datetimepicker" data-target="#datetimepicker1"></td>
                                    <td><input type="text" name="olevel_comm[]"
                                            value="{{ old('olevel_comm.' . $key) }}"
                                            class="form-control form-control-sm @error('olevel_comm.' . $key) is-invalid @enderror">
                                    </td>
                                    <td><button type="button" class="btn btn-danger btn-sm"
                                            onclick="o_removeRow2(this)">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" onclick="o_addRow2()">Add Row</button>
            </div>
        </div>
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">D. Affiliation (10%)</label>
                <span class="text-danger">*</span>
                <div class="table-resposnive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Affiliation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="affiliation">
                            @foreach (old('affiliation', ['']) as $key => $value)
                                <tr>
                                    <td><input type="text" name="affiliation[]"
                                            class="form-control form-control-sm @error('affiliation.' . $key) is-invalid @enderror"
                                            value="{{ $value }}">
                                    </td>
                                    <td><button type="button" class="btn btn-danger btn-sm"
                                            onclick="o_removeRow3(this)">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" onclick="o_addRow3()">Add Row</button>
            </div>
        </div>
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">E. Financial Statement (.pdf file) (10%) </label>
                <span class="text-danger">*</span>
                <input type="file" class="form-control" name="financial">
                @if ($errors->has('financial'))
                    <div class="text-danger text-left">{{ $errors->first('financial') }}</div>
                @endif
                <span class="small">PDF, DOCX, DOC file is accepted</span>
            </div>
        </div>
    </div>
</div>
