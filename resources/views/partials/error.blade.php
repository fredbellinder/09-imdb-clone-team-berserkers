@if($errors->any())
<div class="p-2 bg-dark text-light text-center">
  <h3>{{ $errors->first() }}
    <h3>
</div>
@endif