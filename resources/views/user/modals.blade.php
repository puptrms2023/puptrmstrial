<div class="modal fade" id="maxNumber" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="maxNumberLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="maxNumberLabel">Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                You have already exceeded the maximum number of award application.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Reminders</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="text-primary">
                    <li>Please put the <b>exact and grades</b> listed in your PUP SIS account.</li>
                    <li>Otherwise, you will be <b>sanctioned for falsification of records</b>.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <a href="{{ url('user/application-form') }}" class="btn btn-success"
                    id="redirect-to-new-page">Proceed</a>
            </div>
        </div>
    </div>
</div>
