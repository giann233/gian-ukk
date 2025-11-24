@props(['type' => 'text'])

<input {{ $attributes->merge(['type' => $type, 'class' => 'block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500']) }}>
