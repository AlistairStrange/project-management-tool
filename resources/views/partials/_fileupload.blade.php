<script type="application/javascript">
    /**
     * Below is piece of JS from laraveldaily.com tutorial
     */
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
        url: '{{ route('tickets.upload') }}',

        maxFilesize: 3, // MB

        addRemoveLinks: true,

        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },

        success: function (file, response) {
        $('form').append('<input type="hidden" name="attachment[]" value="' + response.name + '">')
        uploadedDocumentMap[file.name] = response.name
        },

        removedfile: function (file) {
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name
        } else {
            name = uploadedDocumentMap[file.name]
        }
        $('form').find('input[name="attachment[]"][value="' + name + '"]').remove()
        },
        
        init: function () {
        @if(isset($ticket) && $ticket->attachment)
            var files =
            {!! json_encode($ticket->attachment) !!}
            for (var i in files) {
            var file = files[i]
            this.options.addedfile.call(this, file)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="attachment[]" value="' + file.file_name + '">')
            }
        @endif
        }
    }
</script>