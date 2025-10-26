<template>
    <div v-if="genres && genres.length" class="flex flex-wrap gap-2">
        <Link
            v-for="(g, index) in genres"
            :key="g.id || g.value || g.name || g || index"
            :href="route('guest.episodes.genre', { genre: getGenreName(g) })"
            class="px-2 py-1 rounded-full text-xs font-medium bg-indigo-800 text-white hover:bg-black transition-colors cursor-pointer"
            @click.stop
        >
            {{ getGenreName(g) }}
        </Link>
    </div>
</template>

<script setup>
import { toRefs } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    genres: {
        type: Array,
        default: () => [],
    },
})

const { genres } = toRefs(props)

const getGenreName = (genre) => {
    if (typeof genre === 'string') return genre
    if (genre?.value) return genre.value
    if (genre?.name) return genre.name
    return ''
}
</script>
