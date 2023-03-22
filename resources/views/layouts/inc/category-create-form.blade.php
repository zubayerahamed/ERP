<x-theme-css></x-theme-css>
<form id="mainform" action="{{ $category->id == null ? route('category.save') : route('category.update', $category->id) }}" method="POST">
    @csrf
    @if ($category->id != null)
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter Category Name" value="{{ old('name', $category->name) }}" required>
        @error('name')
            <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" name="slug" value="{{ old('slug', $category->slug) }}" placeholder="Enter Category Slug" {{ $category->id != null ? 'readonly' : '' }}>
    </div>
    <div class="form-group">
        <label for="parent_category_id">Parent Category</label>
        <select class="form-control select2bs4" name="parent_category_id">
            <option value="">-- Select --</option>
            @foreach ($category->allCategoriesExceptChildsAndSelf as $cat)
                <option value="{{ $cat->id }}" {{ $category->parentCategory != null && $category->parentCategory->id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="seqn">Sequence</label>
        <input type="number" class="form-control" name="seqn" placeholder="Sequence" min="0" step="1" value="{{ old('seqn', $category->seqn == null ? 0 : $category->seqn) }}">
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="active" {{ $category->id == null || $category->active ? 'checked' : '' }}>
            <label for="customCheckbox2" class="custom-control-label">Active?</label>
        </div>
    </div>

    <button type="submit" class="btn btn-success">Submit</button>
</form>
<x-theme-scripts></x-theme-scripts>
