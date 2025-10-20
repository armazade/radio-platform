<template>
    <div v-if="genres && genres.length" class="flex flex-wrap gap-2">
        <span
            v-for="(g, index) in genres"
            :key="g.id || g.value || g.name || g || index"
            class="px-2 py-1 rounded-full text-xs font-medium bg-indigo-800 text-white hover:bg-black transition-colors"
        >
            {{ getGenreName(g) }}
        </span>
    </div>
</template>

<script setup>
import { toRefs } from 'vue'

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
