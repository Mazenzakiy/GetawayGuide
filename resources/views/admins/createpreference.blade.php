@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create Preference</h5>

                <form action="{{ route('store.preference') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="question">Preference Question</label>
                        <input type="text" class="form-control" id="question" name="question" placeholder="Enter preference question" value="{{ old('question') }}">
                        @error('question')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="single" {{ old('type') == 'single' ? 'selected' : '' }}>Single Choice</option>
                            <option value="multiple" {{ old('type') == 'multiple' ? 'selected' : '' }}>Multiple Choice</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="options">Options</label>
                        <div id="option-fields">
                            <input type="text" class="form-control mb-2" name="options[]" placeholder="Option 1" required>
                            <input type="text" class="form-control mb-2" name="options[]" placeholder="Option 2" required>
                        </div>
                        <button type="button" class="btn btn-secondary" id="add-option">Add More Options</button>
                    </div>

                    <div class="form-group">
                    <label for="category_ids">Categories</label>
                    <div>
                        @foreach($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="category_ids[]" value="{{ $category->id }}" id="category_{{ $category->id }}"
                                {{ (collect(old('category_ids'))->contains($category->id)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="category_{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('category_ids')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                    <button type="submit" class="btn btn-primary">Create Preference</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    document.getElementById('add-option').addEventListener('click', function() {
        const optionFields = document.getElementById('option-fields');
        const newOption = document.createElement('input');
        newOption.type = 'text';
        newOption.name = 'options[]';
        newOption.className = 'form-control mb-2';
        newOption.placeholder = 'New Option';
        optionFields.appendChild(newOption);
    });
</script>
