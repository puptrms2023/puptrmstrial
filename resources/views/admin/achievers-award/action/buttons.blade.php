@can('achievers edit')
    <a href="{{ url('admin/achievers-award/' . $data->courses->course_code . '/' . $data->id) }}"
        class="btn btn-sm btn-secondary"><i class="fa-regular fa-eye"></i> </a>
@endcan
@can('achievers delete')
    <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-sm btn-danger deleteFormbtn"
        data-id="' . $data->id . '"><i class="fa fa-trash"></i></a>
@endcan
