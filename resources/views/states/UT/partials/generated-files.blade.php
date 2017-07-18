<legend>Generated Files</legend>
<p>Your documents will be automatically deleted at their expires time.</p>
<table class="table table-condensed table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Created</th>
        <th>Expires At</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($application->files AS $file)
        <tr>
            <td>document-package.docx</td>
            <td>
                {{ $file->created_at->format('m/d/Y g:i a') }}
            </td>
            <td>
                {{ $file->expired_at->format('m/d/Y g:i a') }}</td>
            </td>
            <td>
                <a href="{{ route('states.UT.download', ['application'=>$application, 'application_file'=>$file]) }}" title="Download" download><i class="fa fa-download"></i> Download</a>
                <a href="#" title="Delete" class="btn-confirm delete-file-btn" data-file-id="{{ $file->id }}"
                   data-after-confirm="window.delete_file({{ $file->id }});"><i class="fa fa-remove"></i> Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>