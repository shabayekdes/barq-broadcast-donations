<div class="form-group">
    <label for="amount">Amount</label>
    <input type="number" name="amount" value="{{ old('amount') ?? $donate->amount }}" class="form-control">
    <div>{{ $errors->first('amount') }}</div>
</div>

{{ csrf_field() }}