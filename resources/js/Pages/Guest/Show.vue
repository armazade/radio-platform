<template>
    <Layout title="Home">
        <Head :title="episode.title" />

        <section
            v-if="imageUrl"
            class="w-full h-[54vh] sm:h-[64vh] bg-center bg-cover"
            :style="{ backgroundImage: `url(${imageUrl})` }"
            aria-label="Episode hero image"
        />

        <section v-else class="w-full h-48 bg-gray-100 flex items-center justify-center">
            <div class="text-gray-400">No image available</div>
        </section>

        <div class="-mt-24 sm:-mt-32 px-4">
            <div class="max-w-4xl bg-white text-black shadow-lg p-8 ml-6 sm:ml-8 lg:ml-12">
                <h1 class="text-3xl sm:text-4xl font-extrabold mb-4">{{ episode.title }}</h1>

                <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
                    <div>{{ location || episode.location }}</div>
                    <div>{{ episode.date }}</div>
                </div>

                <p class="text-gray-800 mb-6">{{ episode.description }}</p>

                <!-- pass genres (fallback to episode.genres if `genres` prop is not provided) -->
                <EpisodeGenres :genres="genres ?? episode.genres" />
            </div>
            <div v-if="episode.audioUrl" class="mb-6 mt-20">
                <audio controls class="w-full">
                    <source :src="episode.audioUrl" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import {Head} from '@inertiajs/vue3'
import Layout from "@/Layouts/Layout.vue";
import EpisodeGenres from "@/Components/EpisodeGenres.vue";

defineProps({
    episode: Object,
    imageUrl: String,
    location: String,
    genres: Array,
})
</script>
