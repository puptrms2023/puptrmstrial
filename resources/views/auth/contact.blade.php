<a href="#" class="float-contact" data-toggle="modal" data-target="#contact-modal">
    <i class="fa-solid fa-comments"></i>
</a>

<!-- Modal -->
<div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="contact-modal-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="contact-modal-label">Contact Us</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="contact-form">
                    @csrf
                    <div class="form-group">
                        <div class="text-muted small">
                            PRIVACY CONSENT: I understand and agree that by filling out this form, I am allowing the
                            PUP Taguig Recognition Management System to collect, process, use, share, and disclose my
                            personal information and also to store it as long as necessary for the fulfillment of the
                            issue and concern, and in accordance with applicable laws, including the Data Privacy Act of
                            2012 and its Implementing Rules and Regulations.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control form-control-sm" id="email" name="email"
                            value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control form-control-sm" id="subject" name="subject"
                            value="{{ old('subject') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea class="form-control form-control-sm" id="details" name="details" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $('#contact-form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('contact.us.store') }}",
                type: "POST",
                data: $('#contact-form').serialize(),
                dataType: 'json',
                success: function(response) {
                    // display a success message
                    toastr.success(response.success);
                    $('#contact-modal').modal('hide');
                },
                error: function(response) {
                    // display an error message
                    toastr.error('An error occurred. Please try again.');
                }
            });
        });
    </script>
@endsection
