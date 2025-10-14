<script setup>
import Layout from "@/Layouts/Layout.vue";
import {Link} from "@inertiajs/vue3";

defineProps({
    episodes: Object,
    imageUrl: String,
})

</script>

<template>
  <Layout title="Home">
    <div class="py-2">
      <div class="w-full">
        <h2 class="text-2xl font-bold mb-6 "></h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-7">
          <div
              v-for="episode in episodes"
              :key="episode.id"
              class="bg-white overflow-hidden shadow hover:shadow-lg transition-shadow duration-200 h-96"
          >
            <div class="p-4 flex flex-col h-full">
                <Link
                    :href="route('guest.episode.show', episode.id)"
                    class="block"
                >
                    <img
                        v-if="episode.imageUrl"
                        :src="episode.imageUrl"
                        alt="Episode Image"
                        class="w-full h-40 object-cover mb-4"
                    />
                  <h3 class="text-lg font-semibold mb-2">{{ episode.title }}</h3>
                  <p class="text-black-700  flex-grow">{{ episode.description }}</p>
                </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
