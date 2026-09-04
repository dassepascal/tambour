@props(['url'])

<div
    x-data="{ playing: false }"
    class="flex items-center gap-4 rounded-full border border-stone-300 bg-white px-5 py-3"
>
    <button
        type="button"
        @click="playing ? $refs.audio.pause() : $refs.audio.play(); playing = !playing"
        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-stone-900 text-white"
    >
        <span x-show="!playing">▶</span>
        <span x-show="playing">❚❚</span>
    </button>

    <p class="text-sm text-stone-600">Écouter le son de ce tambour</p>

    <audio x-ref="audio" @ended="playing = false" src="{{ $url }}" class="hidden"></audio>
</div>
