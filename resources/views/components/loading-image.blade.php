@props([
    'src',
    'alt' => '',
])

<div
    x-data="{ loaded: false }"
    x-init="
        const img = $refs.image;

        if (img.complete) {
            loaded = true;
        } else {
            img.addEventListener('load', () => loaded = true);
        }
    "
    class="relative"
>
    <div
        x-show="!loaded"
        x-transition
        class="absolute inset-0 flex items-center justify-center bg-muted animate-pulse rounded-lg z-10"
    >
        <span class="text-sm text-muted-foreground">
            {{ __('general.loading') }}
        </span>
    </div>

    <img
        x-ref="image"
        src="{{ $src }}"
        alt="{{ $alt }}"
        loading="lazy"
        {{ $attributes }}
    >
</div>