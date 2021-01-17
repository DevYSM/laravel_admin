<div class="alert alert-{{$type}} alert-dismissible fade show" role="alert">

    @switch($type)
        @case('success')
        <strong>Woooo....!</strong>    {{ $message }}
        @break
        @case('danger')
        <strong>Ops....!</strong>    {{ $message }}
        @break
        @default
        {{ $message }}
    @endswitch
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
