{{-- 1st year --}}
<input type="hidden" name="year_level" value="1">
<div class="card shadow mt-0 mb-4">
    <a href="#collapseCard1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
        aria-controls="collapseCard1">
        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
            first year
        </div>
    </a>
    <div class="collapse show" id="collapseCard1">
        <div class="card-body">
            @include('layouts.partials.messages')
            <div id="1st_sem" class="mb-4">
                <div class="card-title fw-bold">First Year, First Term *</div>
                <input type="hidden" name="semester1" value="1">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Course Description</th>
                                <th class="text-center" width="10%">Units</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="fyfs">
                            @foreach ($fy_fs as $key => $value)
                                <tr>
                                    <td>
                                        <select name="fy_fs[{{ $key }}][subjects1]"
                                            data-placeholder="Select subject" data-allow-clear="1"
                                            class="selectsub @error('subjects1.' . $key) is-invalid @enderror" required>
                                            <option selected="selected"></option>
                                            @foreach ($sub as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $value->subject_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->s_code }} - {{ $item->s_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="fy_fs[{{ $key }}][id]"
                                            value="{{ $value->id }}">
                                    </td>
                                    <td><input type="text" name="fy_fs[{{ $key }}][units1]"
                                            class="form-control text-center @error('units1.' . $key) is-invalid @enderror"
                                            value="{{ $value->units }}" onkeypress="validateInput(event)"
                                            onpaste="return false" required></td>
                                    <td><button type="button" class="btn btn-danger deleteSub"
                                            value="{{ $value->id }}">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success" onclick="addSub1()">Add Row</button>
            </div>
            <div id="2nd_sem">
                <div class="card-title fw-bold">First Year, Second Term *</div>
                <input type="hidden" name="semester2" value="2">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Course Description</th>
                                <th class="text-center" width="10%">Units</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="fyss">
                            @foreach ($fy_ss as $key => $value)
                                <tr>
                                    <td>
                                        <select name="fy_ss[{{ $key }}][subjects2]"
                                            data-placeholder="Select subject" data-allow-clear="1"
                                            class="selectsub @error('subjects2.' . $key) is-invalid @enderror" required>
                                            <option selected="selected"></option>
                                            @foreach ($sub as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $value->subject_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->s_code }} - {{ $item->s_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="fy_ss[{{ $key }}][id]"
                                            value="{{ $value->id }}">
                                    </td>
                                    <td><input type="text" name="fy_ss[{{ $key }}][units2]"
                                            class="form-control text-center @error('units2.' . $key) is-invalid @enderror"
                                            value="{{ $value->units }}" onkeypress="validateInput(event)"
                                            onpaste="return false" required></td>
                                    <td><button type="button" class="btn btn-danger deleteSub"
                                            value="{{ $value->id }}">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success" onclick="addSub2()">Add Row</button>
            </div>
        </div>
    </div>
</div>
