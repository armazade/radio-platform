<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    allGenres: {
        type: Array,
        required: true,
    },
    selectedGenre: {
        type: String,
        default: null,
    },
});
</script>

<template>
    <div class="mb-6">
        <div class="flex flex-wrap gap-2 items-center">
            <span class="text-white font-medium mr-2">Filter by genre:</span>

            <!-- All Episodes button -->
            <Link
                :href="route('guest.index')"
                class="px-3 py-2 rounded-full text-sm font-medium transition-colors"
                :class="selectedGenre === null
                    ? 'bg-indigo-600 text-white'
                    : 'bg-gray-700 text-gray-300 hover:bg-gray-600'"
            >
                All Episodes
            </Link>

            <!-- Genre filter buttons -->
            <Link
                v-for="genre in allGenres"
                :key="genre"
                :href="route('guest.episodes.genre', { genre })"
                class="px-3 py-2 rounded-full text-sm font-medium transition-colors"
                :class="selectedGenre === genre
                    ? 'bg-indigo-600 text-white'
                    : 'bg-gray-700 text-gray-300 hover:bg-gray-600'"
            >
                {{ genre }}
            </Link>
        </div>
    </div>
</template>
