<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    title: String,
    canLogin: Boolean,
    canRegister: Boolean,
    auth: Object,
});
</script>

<template>
    <Head :title="title" />

    <div class="flex flex-col min-h-screen bg-white">
        <!-- Navbar -->
        <header class="p-4 flex justify-between items-center border-b dark:border-gray-700">
            <Link href="/" class="text-lg font-bold text-white-100 dark:text-white-100">
                Radio
            </Link>

            <nav class="flex items-center gap-4">
                <!-- MyRadio Button -->
                <Link
                    :href="auth?.user ? '/dashboard' : '/login'"
                    class="px-4 py-2 text-lg font-bold text-indigo-700"
                >
                    MyRadio
                </Link>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="flex-grow p-6">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="p-4 text-center border-t dark:border-gray-700">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Hard To Miss Us © {{ new Date().getFullYear() }} All rights reserved
            </p>
        </footer>
    </div>
</template>
