@if(count($fields) > 0)
    @foreach($fields as $field)
        <div class="form-group mb-3">
            <label>{{ $field->name }}</label>
            <input type="number" name="fields[{{ $field->id }}]" class="form-control" value="" min="0" required>
        </div>
    @endforeach
@endif