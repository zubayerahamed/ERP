@foreach ($categories as $cat)
    <div class="form-check" style="margin-left: {{ $margin }}px;">
        <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $cat->id }}" {{ $product->hasCategory($cat->slug) ? 'checked' : '' }}>
        <label class="form-check-label">{{ $cat->name }}</label>
    </div>
    @if ($cat->getChildCategories)
        @include('layouts.inc.category-recursive', ['categories' => $cat->getChildCategories, 'margin' => $margin + 20, 'product' => $product])
    @endif
@endforeach
