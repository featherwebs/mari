<div id="user-app">
    <div class="form-group">
        <label for="message" class="control-label col-sm-2">Message</label>
        <div class="col-sm-10">
            <textarea class="form-control ckeditor" name="message[message]" id="message"></textarea>
            <span class="help-block">Message</span>
        </div>
    </div>

    <div class="form-group">
        <label for="type" class="control-label col-sm-2">Files</label>
        <div class="col-sm-10">
            <input type="file" name="message[files][]" class="form-control" multiple>
            <span class="help-block">Attachments</span>
        </div>
    </div>
</div>
@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script>
        CKEDITOR.replace('message[message]');
    </script>
    <script>
        $(document).ready(function () {
            $(".select2").select2({
                tags:true,
                tokenSeparators: [",", " "],
            });
        })
    </script>
@endpush