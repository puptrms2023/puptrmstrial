<div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Grades</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modal-content-placeholder"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateGradesBtn"
                    data-url="{{ route('excellence.grades.update', $status->id) }}">Save changes</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {

            $("#editImage").click(function() {
                $("#imageModal").modal('show');
            });

            $("#editGrades1,#editGrades2,#editGrades3,#editGrades4,#editGrades5,#editGrades6,#editGrades7,#editGrades8,#editGrades9,#editGrades10,#editGrades11")
                .click(function() {
                    var url = $(this).data('url');
                    var id = $(this).data('id');

                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $("#exampleModal .modal-body").html(response.html);
                            $("#exampleModal").modal("show");
                            calculateGWA();
                        }
                    });
                });

            $("#updateGradesBtn").click(function() {
                var url = $(this).data('url');
                var term = $('#term-table').val();
                var data = {
                    grades: [],
                    units: [],
                    ids: []
                };

                $("tr[data-id]").each(function() {
                    data.grades.push($(this).find("input[name='grades']").val());
                    data.units.push($(this).find("input[name='units']").val());
                    data.ids.push($(this).data("id"));
                });

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        data,
                        term: term
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#exampleModal").modal("hide");
                            toastr.success(response.success);
                            setInterval('location.reload()', 1000);
                        } else {
                            var errors = response.error;
                            var message = '';
                            $.each(errors, function(key, value) {
                                message += value + '<br>';
                            });
                            toastr.error(message);
                        }
                    }
                });
            });

            $("#updateImageBtn").click(function() {
                var url = $(this).data('url');
                var file = $("input[type=file]").prop("files")[0];
                var formData = new FormData();
                formData.append("image", file);

                $.ajax({
                    method: "POST",
                    url: url,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            $("#imageModal").modal("hide");
                            toastr.success(response.success);
                            setInterval('location.reload()', 1000);
                        } else {
                            var errors = response.error;
                            var message = '';
                            $.each(errors, function(key, value) {
                                message += value + '<br>';
                            });
                            toastr.error(message);
                        }
                    }
                });

            });
        });
    </script>
@endsection
