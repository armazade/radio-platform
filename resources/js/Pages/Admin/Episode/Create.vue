<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import GenreSelector from '@/Components/GenreSelector.vue'
import {Head, useForm} from '@inertiajs/vue3'

const form = useForm({
    title: '',
    description: '',
    date: '',
    genres: [],
    image: null,
})

const submit = () => {
    form.post(route('admin.episodes.store'), {
        forceFormData: true,
    })
}
</script>

<template>
    <GuestLayout>
        <Head title="Create Episode" />

        <form @submit.prevent="submit" class="max-w-xl mx-auto space-y-6 mt-10">
            <div>
                <InputLabel for="title" value="Episode Title" />

                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                    autofocus
                    autocomplete="off"
                />

                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div>
                <InputLabel for="description" value="Description" />

                <textarea
                    id="description"
                    v-model="form.description"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    rows="4"
                ></textarea>

                <InputError class="mt-2" :message="form.errors.description" />
            </div>

            <div>
                <InputLabel for="date" value="Date" />

                <TextInput
                    id="date"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.date"
                    required
                />

                <InputError class="mt-2" :message="form.errors.date" />
            </div>

            <div>
                <InputLabel for="genres" value="Genres" />
                <GenreSelector v-model="form.genres" />
                <InputError class="mt-2" :message="form.errors.genres" />
            </div>

            <div>
                <InputLabel for="image" value="Episode Image"/>
                <input id="image" type="file" @change="e => form.image = e.target.files[0]"/>
                <InputError :message="form.errors.image" class="mt-2"/>
            </div>

            <div class="flex justify-end">
                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Create Episode
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
