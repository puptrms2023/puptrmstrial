<a href="{{ url('admin/deans-list-award/' . $data->courses->course_code . '/' . $data->id) }}"
    class="btn btn-sm btn-secondary"><i class="fa-regular fa-eye"></i> </a>

@can('deans list delete')
    <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-sm btn-info deleteFormbtn"
        data-id="{{ $data->id }}"><i class="fa-solid fa-box-archive"></i></a>
@endcan
