<div class="form-group">
    <label for="inputName">Название новости</label>
    <input
        type="text"
        name="name"
        class="form-control"
        id="inputName"
        placeholder="Введите название новости"
        value="{{ old('name', $tiding->name ?? '') }}"
    >
</div>
<div class="form-group">
    <label for="inputSlug">Символьное название новости</label>
    <input
        type="text"
        name="slug"
        class="form-control"
        id="inputSlug"
        value="{{ old('slug', $tiding->slug ?? '') }}"
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
        value="{{ old('description', $tiding->description ?? '') }}"
    >
</div>
<div class="form-group">
    <label for="inputText">Текст новости</label>
    <textarea
        type="text"
        name="text"
        class="form-control"
        id="inputText"
        rows="10">
        {{ old('text', $tiding->text ?? '') }}
    </textarea>
</div>

<div class="form-group form-check">
    <input type="hidden" name="is_published" value="0" >
    <input
        type="checkbox"
        class="form-check-input"
        id="publishedCheckbox"
        name="is_published"
        value="1"
        @if (isset($tiding->is_published) && $tiding->is_published == 1)
            checked
        @endif
    >
    <label class="form-check-label" for="publishedCheckbox">Опубликовать</label>
</div>
