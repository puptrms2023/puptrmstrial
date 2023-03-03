<div id="leadership_fields" class="hidden">
    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">A. Academic Performance (30%)</label>
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
                        <td><input type="text" name="" id=""
                                class="form-control form-control-sm text-center"></td>
                        <td><input type="text" name="" id=""
                                class="form-control form-control-sm text-center"></td>
                    </tr>
                    <tr>
                        <th>Second Year</th>
                        <td><input type="text" name="" id=""
                                class="form-control form-control-sm text-center"></td>
                        <td><input type="text" name="" id=""
                                class="form-control form-control-sm text-center"></td>
                    </tr>
                    <tr>
                        <th>Third Year</th>
                        <td><input type="text" name="" id=""
                                class="form-control form-control-sm text-center"></td>
                        <td><input type="text" name="" id=""
                                class="form-control form-control-sm text-center"></td>
                    </tr>
                    <tr>
                        <th>Fourth Year</th>
                        <td><input type="text" name="" id=""
                                class="form-control form-control-sm text-center"></td>
                        <td><input type="text" name="" id=""
                                class="form-control form-control-sm text-center"></td>
                    </tr>
                    <tr>
                        <th>Fifth Year</th>
                        <td><input type="text" name="" id=""
                                class="form-control form-control-sm text-center"></td>
                        <td><input type="text" name="" id=""
                                class="form-control form-control-sm text-center"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">B. Projects Initiated (20%)</label>
                <span class="text-danger">*</span>
                <table class="table table-bordered table-sm" id="projects_initiated">
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
                    <tbody>
                        <tr>
                            <td><input type="text" name="projects[]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="sponsors[]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="inclusive_date[]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="inclusive_level[]" class="form-control form-control-sm">
                            </td>
                            <td><input type="text" name="beneficiaries[]" class="form-control form-control-sm"></td>
                            <td><button type="button" class="btn btn-success add-row"><i
                                        class="fas fa-plus"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">C. Officership/Membership (20%)</label>
                <span class="text-danger">*</span>
                <table id="officership" class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Organization</th>
                            <th>Position Held</th>
                            <th>Date Received</th>
                            <th>*Level</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="organization[]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="position_held[]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="date_received[]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="level[]" class="form-control form-control-sm"></td>
                            <td><button type="button" class="btn btn-success add-row2"><i
                                        class="fas fa-plus"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">D. Awards/Received (10%)</label>
                <span class="text-danger">*</span>
                <table id="awards_received" class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Awards</th>
                            <th>Awarded By</th>
                            <th>Date Received</th>
                            <th>*Level</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="award[]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="awarded_by[]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="date_received[]" class="form-control form-control-sm">
                            </td>
                            <td><input type="text" name="level[]" class="form-control form-control-sm"></td>
                            <td><button type="button" class="btn btn-success add-row3"><i
                                        class="fas fa-plus"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">E. Community Outreach (10%)</label>
                <span class="text-danger">*</span>
                <table id="community" class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Involvement</th>
                            <th>Sponsored By</th>
                            <th>Inclusives Dates</th>
                            <th>*Level</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="projects_c[]" class="form-control form-control-sm">
                            </td>
                            <td><input type="text" name="involvement[]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="sponsored_by[]" class="form-control form-control-sm">
                            </td>
                            <td><input type="text" name="inclusive_dates[]" class="form-control form-control-sm">
                            </td>
                            <td><input type="text" name="level_c[]" class="form-control form-control-sm">
                            </td>
                            <td><button type="button" class="btn btn-success add-row4"><i
                                        class="fas fa-plus"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-6 mb-3">
                <label for="" class="font-weight-bold">F. Interview Results (10%) </label>
                <input type="file" class="form-control" name="file">
                <span class="small">PDF, DOCX, DOC file is accepted</span>
            </div>
        </div>
    </div>
</div>
