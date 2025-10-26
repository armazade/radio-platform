<script setup>
import Layout from "@/Layouts/Layout.vue";
import EpisodeCard from "@/Components/EpisodeCard.vue";
import GenreFilter from "@/Components/GenreFilter.vue";

defineProps({
    episodes: {
        type: Array,
        required: true,
    },
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
    <Layout title="Home">
        <div class="py-2">
            <div class="w-full">
                <h2 class="text-2xl font-bold text-white mb-6">
                    <span v-if="selectedGenre">{{ selectedGenre }} Episodes</span>
                    <span v-else>Latest Episodes</span>
                </h2>

                <GenreFilter
                    :allGenres="allGenres"
                    :selectedGenre="selectedGenre"
                />

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-7">
                    <EpisodeCard
                        v-for="episode in episodes"
                        :key="episode.id"
                        :episode="episode"
                    />
                </div>

                <!-- No episodes message -->
                <div v-if="episodes.length === 0" class="text-center py-8">
                    <p class="text-gray-400">No episodes found for the selected genre.</p>
                </div>
            </div>
        </div>
    </Layout>
</template>
