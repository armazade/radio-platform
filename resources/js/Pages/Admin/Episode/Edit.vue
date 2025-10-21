<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import GenreSelector from '@/Components/GenreSelector.vue'
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    episode: {
        type: Object,
        required: true,
    },
})

const form = useForm({
    title: props.episode.title,
    description: props.episode.description,
    date: props.episode.date,
    location: props.episode.location,
    genres: props.episode.genres || [],
    image: null,
    _method: 'PUT',
})

const submit = () => {
    form.post(route('admin.episodes.update', props.episode.id), {
        forceFormData: true,
    })
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Edit Episode" />

        <form @submit.prevent="submit" class="max-w-4xl mx-auto space-y-6 mt-10">
            <div>
                <InputLabel for="title" value="Episode Title" />

                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                />

                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div>
                <InputLabel for="description" value="Description" />

                <TextInput
                    id="description"
                    v-model="form.description"
                    class="mt-1 block w-full"
                ></TextInput>

                <InputError class="mt-2" :message="form.errors.description" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <InputLabel for="date" value="Date" />

                    <TextInput
                        id="date"
                        type="date"
                        v-model="form.date"
                        class="mt-1 block w-full"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.date" />
                </div>

                <div>
                    <InputLabel for="location" value="Location" />

                    <TextInput
                        id="location"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.location"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.location" />
                </div>
            </div>

            <div>
                <InputLabel for="genres" value="Genres" />
                <GenreSelector v-model="form.genres" />
                <InputError class="mt-2" :message="form.errors.genres" />
            </div>

            <div>
                <InputLabel for="image" value="Episode Image"/>
                <div v-if="episode.image" class="mt-2 mb-4">
                    <p class="text-sm text-gray-600">Current image:</p>
                    <img :src="episode.image" alt="Current episode image" class="mt-1 max-w-xs rounded"/>
                </div>
                <input
                    id="image"
                    type="file"
                    accept="image/*"
                    @change="e => form.image = e.target.files[0]"
                    class="mt-1 block w-full"
                />
                <p class="text-sm text-gray-600 mt-1">Leave empty to keep current image</p>
                <InputError :message="form.errors.image" class="mt-2"/>
            </div>

            <div class="flex justify-end">
                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Update Episode
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
