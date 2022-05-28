@php
    $comments = $comments ?? collect();

@endphp
@if($comments->isNotEmpty())
    <div class="show-comment">
        <div class="row">
            <div class="col-md-12">
                @foreach($comments as $comment)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex flex-start">
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="text-primary fw-bold mb-0">
                                            {{ $comment->author }}
                                        </h6>
                                        <p class="mb-0">{{ $comment->created_at->toFormattedDateString() }}</p>
                                    </div>
                                    <p>{{ $comment->text }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
