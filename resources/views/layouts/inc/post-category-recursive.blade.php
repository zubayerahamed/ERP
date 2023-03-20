@foreach ($categories as $cat)
    <div class="form-check" style="margin-left: {{ $margin }}px;">
        <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $cat->id }}" {{ $post->hasCategory($cat->slug) ? 'checked' : '' }}>
        <label class="form-check-label">{{ $cat->name }}</label>
    </div>
    @if ($cat->childCategories)
        @include('layouts.inc.post-category-recursive', ['categories' => $cat->childCategories, 'margin' => $margin + 20, 'post' => $post])
    @endif
@endforeach
