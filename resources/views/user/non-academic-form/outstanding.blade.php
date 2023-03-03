<div id="outstanding_fields" class="hidden">
    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">A. Projects Initiated (40%)</label>
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
                <label for="" class="font-weight-bold">B. Awards/Received (20%)</label>
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
                <label for="" class="font-weight-bold">C. Community Involvement (20%)</label>
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
            <div class="col-md-12 mb-3">
                <label for="" class="font-weight-bold">D. Affiliation (10%)</label>
                <span class="text-danger">*</span>
                <table id="affiliation" class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Affiliation</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="projects_c[]" class="form-control form-control-sm">
                            </td>
                            <td><button type="button" class="btn btn-success add-row5"><i
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
                <label for="" class="font-weight-bold">E. Financial Statement (.pdf file) (10%) </label>
                <span class="text-danger">*</span>
                <input type="file" class="form-control" name="file" required>
                <span class="small">PDF, DOCX, DOC file is accepted</span>
            </div>
        </div>
    </div>
</div>
