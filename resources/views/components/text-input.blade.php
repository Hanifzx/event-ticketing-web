@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'focus:ring-[#fc563c] focus:border-[#fc563c] border-gray-300 rounded-md shadow-sm']) }}>
