<template>
    <Head title="Episodes" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-neutral-800 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-neutral-200">
                        <div v-if="$page.props.flash.success" class="mb-4 text-green-600">
                            {{ $page.props.flash.success }}
                        </div>
                        <h1 class="text-2xl font-bold mb-4">Episodes</h1>

                        <ul class="space-y-4">
                            <li
                                v-for="episode in episodes"
                                :key="episode.id"
                                class="p-6 border rounded shadow bg-neutral-700"
                            >
                                <Link
                                    :href="route('admin.episodes.edit', episode.id)"
                                    class="block"
                                >
                                    <h2 >
                                        {{ episode.title }}
                                    </h2>
                                    <p class="text-neutral-200">{{ episode.description }}</p>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    episodes: Array
});
</script>
