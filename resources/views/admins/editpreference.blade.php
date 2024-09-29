@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Preference</h5>

                <form action="{{ route('update.preference', $preference->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="question">Preference Question</label>
                        <input type="text" class="form-control" id="question" name="question" value="{{ $preference->question }}" required>
                        @error('question')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="single" {{ $preference->type == 'single' ? 'selected' : '' }}>Single Choice</option>
                            <option value="multiple" {{ $preference->type == 'multiple' ? 'selected' : '' }}>Multiple Choice</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="options">Options</label>
                        <div id="option-fields">
                            @foreach($preference->options as $option)
                                <input type="text" class="form-control mb-2" name="options[]" value="{{ $option->option }}" required>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary" id="add-option">Add More Options</button>
                    </div>

                    <div class="form-group">
                        <label for="category_ids">Categories</label>
                        <select class="form-control" id="category_ids" name="category_ids[]" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ in_array($category->id, $preference->options->pluck('category_id')->toArray()) ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_ids')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Update Preference</button>
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
