{{-- 1st year --}}
<input type="hidden" name="year_level3" value="3">
<div class="card shadow mt-0 mb-4">
    <a href="#collapseCard3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
        aria-controls="collapseCard3">
        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
            third year
        </div>
    </a>
    <div class="collapse show" id="collapseCard3">
        <div class="card-body">
            @include('layouts.partials.messages')
            <div id="1st_sem" class="mb-4">
                <div class="card-title fw-bold">Third Year, First Term *</div>
                <input type="hidden" name="semester5" value="1">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Course Description</th>
                                <th class="text-center" width="10%">Units</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tyfs">
                            @foreach ($ty_fs as $key => $value)
                                <tr>
                                    <td>
                                        <select name="ty_fs[{{ $key }}][subjects5]"
                                            data-placeholder="Select subject" data-allow-clear="1"
                                            class="selectsub @error('subjects5.' . $key) is-invalid @enderror" required>
                                            <option selected="selected"></option>
                                            @foreach ($sub as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $value->subject_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->s_code }} - {{ $item->s_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="ty_fs[{{ $key }}][id]"
                                            value="{{ $value->id }}">
                                    </td>
                                    <td><input type="text" name="ty_fs[{{ $key }}][units5]"
                                            class="form-control text-center @error('units5.' . $key) is-invalid @enderror"
                                            value="{{ $value->units }}" onkeypress="validateInput(event)"
                                            onpaste="return false" required></td>
                                    <td><button type="button" class="btn btn-danger deleteSub"
                                            value="{{ $value->id }}">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success" onclick="addSub5()">Add Row</button>
            </div>
            <div id="2nd_sem">
                <div class="card-title fw-bold">Third Year, Second Term *</div>
                <input type="hidden" name="semester6" value="2">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Course Description</th>
                                <th class="text-center" width="10%">Units</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tyss">
                            @foreach ($ty_ss as $key => $value)
                                <tr>
                                    <td>
                                        <select name="ty_ss[{{ $key }}][subjects6]"
                                            data-placeholder="Select subject" data-allow-clear="1"
                                            class="selectsub @error('subjects6.' . $key) is-invalid @enderror" required>
                                            <option selected="selected"></option>
                                            @foreach ($sub as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $value->subject_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->s_code }} - {{ $item->s_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="ty_ss[{{ $key }}][id]"
                                            value="{{ $value->id }}">
                                    </td>
                                    <td><input type="text" name="ty_ss[{{ $key }}][units6]"
                                            class="form-control text-center @error('units6.' . $key) is-invalid @enderror"
                                            value="{{ $value->units }}" onkeypress="validateInput(event)"
                                            onpaste="return false" required></td>
                                    <td><button type="button" class="btn btn-danger deleteSub"
                                            value="{{ $value->id }}">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success" onclick="addSub6()">Add Row</button>
            </div>
        </div>
    </div>
</div>
