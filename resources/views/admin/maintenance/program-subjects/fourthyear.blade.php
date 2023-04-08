{{-- 1st year --}}
<input type="hidden" name="year_level4" value="4">
<div class="card shadow mt-0 mb-4">
    <a href="#collapseCard4" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
        aria-controls="collapseCard4">
        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
            fourth year
        </div>
    </a>
    <div class="collapse show" id="collapseCard4">
        <div class="card-body">
            @include('layouts.partials.messages')
            <div id="1st_sem" class="mb-4">
                <div class="card-title fw-bold">Fourth Year, First Term *</div>
                <input type="hidden" name="semester7" value="1">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Course Description</th>
                                <th class="text-center" width="10%">Units</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="foyfs">
                            @foreach ($foy_fs as $key => $value)
                                <tr>
                                    <td>
                                        <select name="foy_fs[{{ $key }}][subjects7]"
                                            data-placeholder="Select subject" data-allow-clear="1"
                                            class="selectsub @error('subjects7.' . $key) is-invalid @enderror" required>
                                            <option selected="selected"></option>
                                            @foreach ($sub as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $value->subject_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->s_code }} - {{ $item->s_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="foy_fs[{{ $key }}][id]"
                                            value="{{ $value->id }}">
                                    </td>
                                    <td><input type="text" name="foy_fs[{{ $key }}][units7]"
                                            class="form-control text-center @error('units7.' . $key) is-invalid @enderror"
                                            value="{{ $value->units }}" onkeypress="validateInput(event)"
                                            onpaste="return false" required></td>
                                    <td><button type="button" class="btn btn-danger deleteSub"
                                            value="{{ $value->id }}">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success" onclick="addSub7()">Add Row</button>
            </div>
            <div id="2nd_sem">
                <div class="card-title fw-bold">Fourth Year, Second Term *</div>
                <input type="hidden" name="semester8" value="2">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Course Description</th>
                                <th class="text-center" width="10%">Units</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="foyss">
                            @foreach ($foy_ss as $key => $value)
                                <tr>
                                    <td>
                                        <select name="foy_ss[{{ $key }}][subjects8]"
                                            data-placeholder="Select subject" data-allow-clear="1"
                                            class="selectsub @error('subjects8.' . $key) is-invalid @enderror" required>
                                            <option selected="selected"></option>
                                            @foreach ($sub as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $value->subject_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->s_code }} - {{ $item->s_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="foy_ss[{{ $key }}][id]"
                                            value="{{ $value->id }}">
                                    </td>
                                    <td><input type="text" name="foy_ss[{{ $key }}][units8]"
                                            class="form-control text-center @error('units8.' . $key) is-invalid @enderror"
                                            value="{{ $value->units }}" onkeypress="validateInput(event)"
                                            onpaste="return false" required></td>
                                    <td><button type="button" class="btn btn-danger deleteSub"
                                            value="{{ $value->id }}">Remove</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success" onclick="addSub8()">Add Row</button>
            </div>
        </div>
    </div>
</div>
