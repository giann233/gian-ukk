@props(['errors'])

@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'font-medium text-red-600 text-sm text-center']) }}>
        <ul class="mt-1 mb-4 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
