@props([
    'file',
])

<a href="{{ route('member.submission.file.download', $file) }}" class="card text-decoration-none">
    <div class="card-body p-2 d-flex align-items-center">
        <i class="fa fa-file-pdf ms-1 me-3 fs-2 text-secondary"></i>
        <div>
            <div>
                <small class="fs-6">
                    {{ $file->original_file_name }}
                </small>
            </div>
            <div class="text-muted" style="font-size:0.8rem">
                {{ $file->created_at->format('j M g:i A') }}
            </div>
        </div>
    </div>
</a>