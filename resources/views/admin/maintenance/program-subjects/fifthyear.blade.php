{{-- 1st year --}}
<input type="hidden" name="year_level5" value="5">
<div class="card shadow mt-0 mb-4">
    <a href="#collapseCard5" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
        aria-controls="collapseCard5">
        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
            fifth year
        </div>
    </a>
    <div class="collapse show" id="collapseCard5">
        <div class="card-body">
            @include('layouts.partials.messages')
            <div id="1st_sem" class="mb-4">
                <div class="card-title fw-bold">Fifth Year, First Term (Optional)</div>
                <input type="hidden" name="semester9" value="1">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Course Description</th>
                                <th class="text-center" width="10%">Units</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="fiyfs">
                            @foreach ($fiy_fs as $key => $value)
                                <tr>
                                    <td>
                                        <select name="fiy_fs[{{ $key }}][subjects9]"
                                            data-placeholder="Select subject" data-allow-clear="1"
                                            class="selectsub @error('subjects9.' . $key) is-invalid @enderror" required>
                                            <option selected="selected"></option>
                                            @foreach ($sub as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $value->subject_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->s_code }} - {{ $item->s_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="fiy_fs[{{ $key }}][id]"
                                            value="{{ $value->id }}">
                                    </td>
                                    <td><input type="text" name="fiy_fs[{{ $key }}][units9]"
                                            class="form-control text-center @error('units9.' . $key) is-invalid @enderror"
                                            value="{{ $value->units }}" onkeypress="validateInput(event)"
                                            onpaste="return false" required></td>
                                    <td><button type="button" class="btn btn-danger deleteSub"
                                            value="{{ $value->id }}">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success" onclick="addSub9()">Add Row</button>
            </div>
            <div id="2nd_sem">
                <div class="card-title fw-bold">Fifth Year, Second Term (Optional)</div>
                <input type="hidden" name="semester10" value="2">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Course Description</th>
                                <th class="text-center" width="10%">Units</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="fiyss">
                            @foreach ($fiy_ss as $key => $value)
                                <tr>
                                    <td>
                                        <select name="fiy_ss[{{ $key }}][subjects10]"
                                            data-placeholder="Select subject" data-allow-clear="1"
                                            class="selectsub @error('subjects10.' . $key) is-invalid @enderror"
                                            required>
                                            <option selected="selected"></option>
                                            @foreach ($sub as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $value->subject_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->s_code }} - {{ $item->s_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="fiy_ss[{{ $key }}][id]"
                                            value="{{ $value->id }}">
                                    </td>
                                    <td><input type="text" name="fiy_ss[{{ $key }}][units10]"
                                            class="form-control text-center @error('units10.' . $key) is-invalid @enderror"
                                            value="{{ $value->units }}" onkeypress="validateInput(event)"
                                            onpaste="return false" required></td>
                                    <td><button type="button" class="btn btn-danger deleteSub"
                                            value="{{ $value->id }}">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success" onclick="addSub10()">Add Row</button>
            </div>
        </div>
    </div>
</div>
