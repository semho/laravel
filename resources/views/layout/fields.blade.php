<div class="form-group">
    <label for="inputName">Название статьи</label>
    <input
        type="text"
        name="name"
        class="form-control"
        id="inputName"
        placeholder="Введите название статьи"
        value="{{ old('name', $article->name ?? '') }}"
    >
</div>
<div class="form-group">
    <label for="inputSlug">Символьное название статьи</label>
    <input
        type="text"
        name="slug"
        class="form-control"
        id="inputSlug"
        value="{{ old('slug', $article->slug ?? '') }}"
    >
</div>
<div class="form-group">
    <label for="inputDesc">Краткое описание</label>
    <input
        type="text"
        name="description"
        class="form-control"
        id="inputDesc"
        placeholder="Введите краткое описание"
        value="{{ old('description', $article->description ?? '') }}"
    >
</div>
<div class="form-group">
    <label for="inputText">Текст статьи</label>
    <textarea
        type="text"
        name="text"
        class="form-control"
        id="inputText"
        rows="10">
        {{ old('text', $article->text ?? '') }}
    </textarea>
</div>
<div class="form-group">
    <label for="inputTags">Теги</label>
    <input
        type="text"
        name="tags"
        class="form-control"
        id="inputTags"
        placeholder="Введите теги"
        @if (isset($article->tags))
            value="{{ $article->tags->pluck('name')->implode(',') }}"
        @else
            value="{{ old('tags') }}"
        @endif
    >
</div>

<div class="form-group form-check">
    <input type="hidden" name="is_published" value="0" >
    <input
        type="checkbox"
        class="form-check-input"
        id="publishedCheckbox"
        name="is_published"
        value="1"
        @if (isset($article->is_published) && $article->is_published == 1)
            checked
        @endif
    >
    <label class="form-check-label" for="publishedCheckbox">Опубликовать</label>
</div>
