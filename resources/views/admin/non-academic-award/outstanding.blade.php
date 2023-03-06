<div class="card shadow mt-0 mb-4">
    <div class="card-body">
        <div class="col-md-12 mb-3">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <label for="" class="font-weight-bold">A. Projects Initiated (40%)</label>
                </div>
                <div class="col-sm-2 d-flex align-items-center justify-content-end">
                    <input type="number" name="project_initiated" min="0" max="40"
                        value="{{ $form->outstanding_criteria->projects_initiated ?? '' }}"
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
                    <label for="" class="font-weight-bold">B. Awards/Received (20%)</label>
                </div>
                <div class="col-sm-2 d-flex align-items-center justify-content-end">
                    <input type="number" name="awards" min="0" max="20"
                        value="{{ $form->outstanding_criteria->awards_received ?? '' }}"
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
                    <label for="" class="font-weight-bold">C. Community Involvement (20%)</label>
                </div>
                <div class="col-sm-2 d-flex align-items-center justify-content-end">
                    <input type="number" name="community_involvement" min="0" max="20"
                        value="{{ $form->outstanding_criteria->community_involvement ?? '' }}"
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
                    <label for="" class="font-weight-bold">D. Affiliation (10%)</label>
                </div>
                <div class="col-sm-2 d-flex align-items-center justify-content-end">
                    <input type="number" name="affiliation" min="0" max="10"
                        value="{{ $form->outstanding_criteria->affiliation ?? '' }}"
                        class="form-control form-control-sm text-center" placeholder="Enter percentage">
                </div>
            </div>
            <div class="table-resposnive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Affiliation</th>
                        </tr>
                    </thead>
                    <tbody id="affiliation">
                        @foreach ($form->affiliations as $value)
                            <tr>
                                <td>{{ $value->affiliation }}</td>
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
                    <label for="" class="font-weight-bold">E. Financial Statement (10%) </label>
                </div>
                <div class="col-sm-2 d-flex align-items-center justify-content-end">
                    <input type="number" name="financial_statement" min="0" max="10"
                        value="{{ $form->outstanding_criteria->financial_statement ?? '' }}"
                        class="form-control form-control-sm text-center" placeholder="Enter percentage">
                </div>
            </div>
            @if (!empty($form->financials->file_path))
                <a href="{{ asset($form->financials->file_path) }}" class="btn-link text-muted"
                    target="_blank">{{ $form->financials->file_name }}</a>
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
                    value="{{ $form->outstanding_criteria->total ?? '' }}" disabled>
            </div>
        </div>
    </div>
</div>
