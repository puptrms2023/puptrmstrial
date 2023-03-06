    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        <label for="" class="font-weight-bold">A. Academic Performance (30%)</label>
                    </div>
                    <div class="col-sm-2 d-flex align-items-center justify-content-end">
                        <input type="number" id="" name="acad_perf" min="0" max="30"
                            value="{{ $form->leadership_criteria->academic_performance ?? '' }}"
                            class="form-control form-control-sm text-center" placeholder="Enter percentage">
                    </div>
                </div>
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
                            <td class="text-center">{{ $form->academics->first_year_first ?? 'N/A' }}</td>
                            <td class="text-center">{{ $form->academics->first_year_second ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Second Year</th>
                            <td class="text-center">{{ $form->academics->second_year_first ?? 'N/A' }}</td>
                            <td class="text-center">{{ $form->academics->second_year_second ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Third Year</th>
                            <td class="text-center">{{ $form->academics->third_year_first ?? 'N/A' }}</td>
                            <td class="text-center">{{ $form->academics->third_year_second ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Fourth Year</th>
                            <td class="text-center">{{ $form->academics->fourth_year_first ?? 'N/A' }}</td>
                            <td class="text-center">{{ $form->academics->fourth_year_second ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Fifth Year</th>
                            <td class="text-center">{{ $form->academics->fifth_year_first ?? 'N/A' }}</td>
                            <td class="text-center">{{ $form->academics->fifth_year_second ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        <label for="" class="font-weight-bold">B. Projects Initiated (20%)</label>
                    </div>
                    <div class="col-sm-2 d-flex align-items-center justify-content-end">
                        <input type="number" name="project_initiated" min="0" max="20"
                            value="{{ $form->leadership_criteria->projects_initiated ?? '' }}"
                            class="form-control form-control-sm text-center" placeholder="Enter percentage">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Projects</th>
                                <th>Sponsors</th>
                                <th>Inclusive Date</th>
                                <th>Inclusive Level</th>
                                <th>Beneficiaries</th>
                            </tr>
                        </thead>
                        <tbody id="projects_initiated">
                            @foreach ($form->projects as $value)
                                <tr>
                                    <td>{{ $value->projects }}</td>
                                    <td>{{ $value->sponsors }}</td>
                                    <td>{{ $value->inclusive_date }}</td>
                                    <td>{{ $value->inclusive_level }}</td>
                                    <td>{{ $value->beneficiaries }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        <label for="" class="font-weight-bold">C. Officership/Membership (20%)</label>
                    </div>
                    <div class="col-sm-2 d-flex align-items-center justify-content-end">
                        <input type="number" name="officership" min="0" max="20"
                            value="{{ $form->leadership_criteria->officership ?? '' }}"
                            class="form-control form-control-sm text-center" placeholder="Enter percentage">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Organization</th>
                                <th>Position Held</th>
                                <th>Date Received</th>
                                <th>*Level</th>
                            </tr>
                        </thead>
                        <tbody id="officership">
                            @foreach ($form->officership as $value)
                                <tr>
                                    <td>{{ $value->organization }}</td>
                                    <td>{{ $value->position_held }}</td>
                                    <td>{{ $value->date_received }}</td>
                                    <td>{{ $value->level }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        <label for="" class="font-weight-bold">D. Awards/Received (10%)</label>
                    </div>
                    <div class="col-sm-2 d-flex align-items-center justify-content-end">
                        <input type="number" name="awards" min="0" max="10"
                            value="{{ $form->leadership_criteria->awards_received ?? '' }}"
                            class="form-control form-control-sm text-center" placeholder="Enter percentage">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Awards</th>
                                <th>Awarded By</th>
                                <th>Date Received</th>
                                <th>*Level</th>
                            </tr>
                        </thead>
                        <tbody id="awards_received">
                            @foreach ($form->awards as $value)
                                <tr>
                                    <td>{{ $value->awards }}</td>
                                    <td>{{ $value->awarded_by }}</td>
                                    <td>{{ $value->date_received }}</td>
                                    <td>{{ $value->level }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        <label for="" class="font-weight-bold">E. Community Outreach (10%)</label>
                    </div>
                    <div class="col-sm-2 d-flex align-items-center justify-content-end">
                        <input type="number" name="community_out" min="0" max="10"
                            value="{{ $form->leadership_criteria->community_outreach ?? '' }}"
                            class="form-control form-control-sm text-center" placeholder="Enter percentage">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Involvement</th>
                                <th>Sponsored By</th>
                                <th>Inclusives Dates</th>
                                <th>*Level</th>
                            </tr>
                        </thead>
                        <tbody id="community">
                            @foreach ($form->community_outreach as $value)
                                <tr>
                                    <td>{{ $value->projects }}</td>
                                    <td>{{ $value->involvement }}</td>
                                    <td>{{ $value->sponsored_by }}</td>
                                    <td>{{ $value->inclusive_dates }}</td>
                                    <td>{{ $value->level }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow mt-0 mb-4">
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        <label for="" class="font-weight-bold">F. Interview Results (10%) </label>
                    </div>
                    <div class="col-sm-2 d-flex align-items-center justify-content-end">
                        <input type="number" name="interview" min="0" max="10"
                            value="{{ $form->leadership_criteria->interview ?? '' }}"
                            class="form-control form-control-sm text-center" placeholder="Enter percentage">
                    </div>
                </div>
                @if (!empty($form->interviews->file_path))
                    <a href="{{ asset($form->interviews->file_path) }}" class="btn-link text-muted"
                        target="_blank">{{ $form->interviews->file_name }}</a>
                @else
                    <p>No File</p>
                @endif
            </div>
        </div>
    </div>

    <div class="div">
        <div class="col-md-12">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <span class="text-danger" id="error-message"></span>
                </div>
                <div class="col-sm-2 d-flex align-items-center justify-content-end">
                    <input type="text" name="total" id="total_percentage" class="form-control form-control-sm"
                        value="{{ $form->leadership_criteria->total ?? '' }}" disabled>
                </div>
            </div>
        </div>
    </div>


