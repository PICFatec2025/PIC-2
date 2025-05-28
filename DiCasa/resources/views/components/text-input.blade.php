@props(['disabled' => false])


<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-[#b0b0b0] dark:border-[#999999] text-black focus:border-black-500 dark:focus:border-black focus:ring-black-500 dark:focus:ring-black-600 rounded-md shadow-sm bg-[#d9d9d9]']) }}>
