@props(['product'])

@php
    $galleryUrls = $product->getMedia('gallery')->map->getUrl()->values();
    $spinUrls = $product->spinImages()->map->getUrl()->values();
@endphp

<div
    x-data="productViewer({
        gallery: {{ Js::from($galleryUrls) }},
        spin: {{ Js::from($spinUrls) }},
    })"
    class="select-none"
>
    <div
        class="relative aspect-square cursor-zoom-in overflow-hidden rounded-2xl bg-stone-100"
        x-show="mode === 'gallery'"
        @mousemove="onZoomMove($event)"
        @mouseleave="zoomed = false"
        @mousedown="zoomed = !zoomed"
        x-ref="zoomBox"
    >
        <template x-if="gallery.length">
            <img
                :src="gallery[activeIndex]"
                alt="{{ $product->title }}"
                class="h-full w-full origin-center object-cover transition-transform duration-150"
                :style="zoomed ? `transform: scale(2); transform-origin: ${zoomOriginX}% ${zoomOriginY}%;` : ''"
                draggable="false"
            >
        </template>
    </div>

    <div
        class="relative aspect-square cursor-grab overflow-hidden rounded-2xl bg-stone-100 active:cursor-grabbing"
        x-show="mode === 'spin'"
        x-cloak
        @mousedown="startSpin($event)"
        @mousemove.window="dragSpin($event)"
        @mouseup.window="endSpin()"
        @touchstart="startSpin($event)"
        @touchmove.window="dragSpin($event)"
        @touchend.window="endSpin()"
    >
        <template x-if="spin.length">
            <img
                :src="spin[spinIndex]"
                alt="{{ $product->title }} — vue 360°"
                class="h-full w-full object-cover"
                draggable="false"
            >
        </template>

        <div class="pointer-events-none absolute inset-x-0 bottom-3 flex justify-center">
            <span class="rounded-full bg-stone-900/70 px-3 py-1 text-xs text-white">
                Glissez pour faire pivoter
            </span>
        </div>
    </div>

    <div class="mt-4 flex items-center justify-between">
        <div class="grid flex-1 grid-cols-4 gap-3" x-show="mode === 'gallery' && gallery.length > 1">
            <template x-for="(url, index) in gallery" :key="index">
                <button
                    type="button"
                    @click="activeIndex = index"
                    class="aspect-square overflow-hidden rounded-lg bg-stone-100 ring-offset-2"
                    :class="activeIndex === index ? 'ring-2 ring-stone-900' : ''"
                >
                    <img :src="url" alt="{{ $product->title }}" class="h-full w-full object-cover">
                </button>
            </template>
        </div>

        <button
            type="button"
            x-show="spin.length"
            @click="mode = mode === 'spin' ? 'gallery' : 'spin'; zoomed = false"
            class="ml-auto rounded-full border border-stone-300 px-4 py-2 text-sm hover:border-stone-400"
        >
            <span x-text="mode === 'spin' ? 'Voir les photos' : 'Vue 360°'"></span>
        </button>
    </div>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('productViewer', ({ gallery, spin }) => ({
                    gallery,
                    spin,
                    mode: 'gallery',
                    activeIndex: 0,
                    zoomed: false,
                    zoomOriginX: 50,
                    zoomOriginY: 50,
                    spinIndex: 0,
                    spinDragging: false,
                    spinStartX: 0,
                    spinStartIndex: 0,

                    onZoomMove(event) {
                        if (!this.zoomed) {
                            return;
                        }

                        const rect = this.$refs.zoomBox.getBoundingClientRect();
                        this.zoomOriginX = ((event.clientX - rect.left) / rect.width) * 100;
                        this.zoomOriginY = ((event.clientY - rect.top) / rect.height) * 100;
                    },

                    startSpin(event) {
                        this.spinDragging = true;
                        this.spinStartX = event.touches ? event.touches[0].clientX : event.clientX;
                        this.spinStartIndex = this.spinIndex;
                    },

                    dragSpin(event) {
                        if (!this.spinDragging || !this.spin.length) {
                            return;
                        }

                        const clientX = event.touches ? event.touches[0].clientX : event.clientX;
                        const deltaX = clientX - this.spinStartX;
                        const framesPerSweep = this.spin.length;
                        const step = Math.round(deltaX / 8);
                        let index = (this.spinStartIndex + step) % framesPerSweep;

                        if (index < 0) {
                            index += framesPerSweep;
                        }

                        this.spinIndex = index;
                    },

                    endSpin() {
                        this.spinDragging = false;
                    },
                }));
            });
        </script>
    @endpush
@endonce
