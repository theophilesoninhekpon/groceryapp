@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm text-orange-600 dark:text-orange-400']) }}>{{ $message }}</p>
@enderror
