{{-- 2nd year --}}
<input type="hidden" name="year_level2" value="2">
<div class="card shadow mt-0 mb-4">
    <a href="#collapseCard2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
        aria-controls="collapseCard2">
        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
            second year
        </div>
    </a>
    <div class="collapse show" id="collapseCard2">
        <div class="card-body">
            @include('layouts.partials.messages')
            <div id="1st_sem" class="mb-4">
                <div class="card-title fw-bold">Second Year, First Term *</div>
                <input type="hidden" name="semester3" value="1">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Course Description</th>
                                <th class="text-center" width="10%">Units</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="syfs">
                            @foreach ($sy_fs as $key => $value)
                                <tr>
                                    <td>
                                        <select name="sy_fs[{{ $key }}][subjects3]"
                                            data-placeholder="Select subject" data-allow-clear="1"
                                            class="selectsub @error('subjects3.' . $key) is-invalid @enderror" required>
                                            <option selected="selected"></option>
                                            @foreach ($sub as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $value->subject_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->s_code }} - {{ $item->s_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="sy_fs[{{ $key }}][id]"
                                            value="{{ $value->id }}">
                                    </td>
                                    <td><input type="text" name="sy_fs[{{ $key }}][units3]"
                                            class="form-control text-center @error('units3.' . $key) is-invalid @enderror"
                                            value="{{ $value->units }}" onkeypress="validateInput(event)"
                                            onpaste="return false" required></td>
                                    <td><button type="button" class="btn btn-danger deleteSub"
                                            value="{{ $value->id }}">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success" onclick="addSub3()">Add Row</button>
            </div>
            <div id="2nd_sem">
                <div class="card-title fw-bold">Second Year, Second Term *</div>
                <input type="hidden" name="semester4" value="2">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Course Description</th>
                                <th class="text-center" width="10%">Units</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="syss">
                            @foreach ($sy_ss as $key => $value)
                                <tr>
                                    <td>
                                        <select name="sy_ss[{{ $key }}][subjects4]"
                                            data-placeholder="Select subject" data-allow-clear="1"
                                            class="selectsub @error('subjects4.' . $key) is-invalid @enderror" required>
                                            <option selected="selected"></option>
                                            @foreach ($sub as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $value->subject_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->s_code }} - {{ $item->s_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="sy_ss[{{ $key }}][id]"
                                            value="{{ $value->id }}">
                                    </td>
                                    <td><input type="text" name="sy_ss[{{ $key }}][units4]"
                                            class="form-control text-center @error('units4.' . $key) is-invalid @enderror"
                                            value="{{ $value->units }}" onkeypress="validateInput(event)"
                                            onpaste="return false" required></td>
                                    <td><button type="button" class="btn btn-danger deleteSub"
                                            value="{{ $value->id }}">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success" onclick="addSub4()">Add Row</button>
            </div>
        </div>
    </div>
</div>
