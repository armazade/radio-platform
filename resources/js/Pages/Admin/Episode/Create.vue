<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import GenreSelector from '@/Components/GenreSelector.vue'
import {Head, useForm} from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const form = useForm({
    title: '',
    description: '',
    date: '',
    location: '',
    genres: [],
    image: null,
    audio: null,
})

const submit = () => {
    form.post(route('admin.episodes.store'), {
        forceFormData: true,
    })
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Create Episode" />
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-neutral-800 shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit" class="max-w-4xl mx-auto space-y-6 mt-10">
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
                            <input id="image" type="file" accept="image/*" @change="e => form.image = e.target.files[0]"/>
                            <InputError :message="form.errors.image" class="mt-2"/>
                        </div>

                        <div>
                            <InputLabel for="audio" value="Episode Audio"/>
                            <input
                                id="audio"
                                type="file"
                                accept="audio/*"
                                @change="e => form.audio = e.target.files[0]"
                                class="mt-1 block w-full"
                            />
                            <InputError :message="form.errors.audio" class="mt-2"/>
                        </div>

                        <div class="flex justify-end">
                            <PrimaryButton
                                class="ml-4 mb-5"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Create Episode
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
