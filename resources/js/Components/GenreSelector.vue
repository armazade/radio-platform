<script setup>
const props = defineProps({
    modelValue: {
        type: Array,
        required: true
    }
})

const emit = defineEmits(['update:modelValue'])

const genres = [
    'Ambient',
    'Jungle',
    'Techno',
    'House',
    'Drum & Bass',
    'Breakbeat',
    'Dubstep',
    'Garage',
    'Grime',
    'Experimental',
    'Jazz',
    'Funk',
    'Soul',
    'Disco',
    'Hip Hop'
]

const updateGenres = (genre) => {
    const currentGenres = [...props.modelValue]
    const index = currentGenres.indexOf(genre)

    if (index === -1) {
        currentGenres.push(genre)
    } else {
        currentGenres.splice(index, 1)
    }

    emit('update:modelValue', currentGenres)
}
</script>

<template>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div v-for="genre in genres" :key="genre" class="flex items-center">
            <input
                type="checkbox"
                :id="genre"
                :value="genre"
                :checked="modelValue.includes(genre)"
                @change="updateGenres(genre)"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
            />
            <label :for="genre" class="ml-2 text-sm text-gray-700">{{ genre }}</label>
        </div>
    </div>
</template>
