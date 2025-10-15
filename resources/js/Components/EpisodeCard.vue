<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    episode: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="bg-white overflow-hidden shadow hover:shadow-lg transition-shadow duration-200 h-96">
        <div class="p-4 flex flex-col h-full">
            <Link
                :href="route('guest.episode.show', episode.id)"
                class="flex flex-col h-full"
            >
                <!-- Image -->
                <img
                    v-if="episode.imageUrl"
                    :src="episode.imageUrl"
                    alt="Episode Image"
                    class="w-full h-40 object-cover mb-4"
                />

                <!-- Title -->
                <h3 class="text-lg font-semibold mb-2">{{ episode.title }}</h3>

                <!-- Genres -->
                <div v-if="episode.genres && episode.genres.length > 0" class="flex flex-wrap gap-2 mb-3">
                    <span
                        v-for="genre in episode.genres"
                        :key="genre.value"
                        :class="genre.color"
                        class="px-2 py-1 rounded-full text-xs font-medium"
                    >
                        {{ genre.value }}
                    </span>
                </div>
            </Link>
        </div>
    </div>
</template>
