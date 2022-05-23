<div class="add-comment">
    <div class="row d-flex justify-content-center text-dark">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="d-flex flex-start w-100">
                        <div class="form-comment w-100">
                            <h5>Добавить комментарий</h5>
                            <form method="post" action="/articles/{{ $article->slug }}">
                                @csrf
                                <textarea class="form-control" id="textAreaExample" name="text" rows="4"></textarea>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-success">Добавить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
