<div id="user-app">
    <div class="row">
        <div class="col-sm-9">
            <div class="form-group">
                <label for="title" class="control-label col-sm-2">Title</label>
                <div class="col-sm-10">
                    <input class="form-control" id="title" name="ticket[title]" type="text">
                    <span class="help-block">Min 3 characters</span>
                </div>
            </div>
            <div class="form-group">
                <label for="message" class="control-label col-sm-2">Message</label>
                <div class="col-sm-10">
                    <textarea class="form-control ckeditor" name="ticket[message]" id="message"></textarea>
                    <span class="help-block">Message</span>
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="control-label col-sm-2">Type</label>
                <div class="col-sm-10">
                    <select class="form-control" name="ticket[ticket_type_id]" id="type">
                        @foreach($ticketTypes as $ticketType)
                            <option value="{{ $ticketType->id }}">{{ $ticketType->title }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">Ticket Types</span>
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="control-label col-sm-2">Files</label>
                <div class="col-sm-10">
                    <input type="file" name="ticket[files][]" class="form-control" multiple>
                    <span class="help-block">Attachments</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'ticket[message]' );
    </script>
@endpush