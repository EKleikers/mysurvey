@if (count($errors))
<div class="note note-warning">
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif
@if (isset($issue))
<div class="note note-warning">
    <p>{{ $issue }}</p>
</div>
@endif
