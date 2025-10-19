<script setup>
import { Link } from '@inertiajs/vue3';
import EpisodeGenres from "@/Components/EpisodeGenres.vue";

defineProps({
    episode: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="overflow-hidden shadow transition-shadow duration-200 h-96 border border-gray-500">
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
                    class="w-full h-60 object-cover mb-4"
                />
                <!-- Date and location-->
                <div class="flex justify-between text-sm text-gray-500 mb-1">
                    <div>{{ episode.date }}</div>
                    <div>{{ episode.location }}</div>
                </div>
                <!-- Title -->
                <h3 class="text-lg text-gray-200 font-semibold mb-2">{{ episode.title }}</h3>

            </Link>
            <Link
                :href="route('guest.episode.show', episode.id)"
                class="flex flex-col h-full"
            >
                <!-- Genres -->
                <EpisodeGenres :genres="genres ?? episode.genres" />
            </Link>
        </div>
    </div>
</template>
