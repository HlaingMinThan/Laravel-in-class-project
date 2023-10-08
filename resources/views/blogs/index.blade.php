<x-layout>
    <x-hero />
    <x-blogs-section
        :blogs="$blogs"
        :categories="$categories"
    />
    <x-subscribe />
</x-layout>