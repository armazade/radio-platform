<template>
    <Head title="Episodes" />

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div v-if="$page.props.flash.success" class="mb-4 text-green-600">
                        {{ $page.props.flash.success }}
                    </div>
                    <h1 class="text-2xl font-bold mb-4">Episodes</h1>

                    <ul class="space-y-4">
                        <li
                            v-for="episode in episodes"
                            :key="episode.id"
                            class="p-4 border rounded shadow"
                        >
                            <Link
                                :href="route('admin.episodes.create', episode.id)"
                                class="block"
                            >
                                <h2 >
                                    {{ episode.title }}
                                </h2>
                                <p class="text-gray-700">{{ episode.description }}</p>
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'

defineProps({
    episodes: Array
});
</script>
