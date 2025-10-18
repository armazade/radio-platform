<script setup>
import Layout from "@/Layouts/Layout.vue";
import EpisodeCard from "@/Components/EpisodeCard.vue";

defineProps({
    episodes: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <Layout title="Home">
        <div class="py-2">
            <div class="w-full">
                <h2 class="text-2xl font-bold text-white mb-6">Latest Episodes</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-7">
                    <EpisodeCard
                        v-for="episode in episodes"
                        :key="episode.id"
                        :episode="episode"
                    />
                </div>
            </div>
        </div>
    </Layout>
</template>
