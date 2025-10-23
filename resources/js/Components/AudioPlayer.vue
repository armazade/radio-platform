<template>
    <div v-if="audioUrl" class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-300 shadow-lg">
        <div class="w-full px-4 py-3">
            <!-- Main Container -->
            <div class="flex items-center gap-4">
                <!-- Left Section: Episode Info + Playback Controls -->
                <div class="flex items-center gap-3 flex-1 min-w-0">
                    <!-- Small Episode Image -->
                    <div class="w-12 h-12 bg-gray-200 rounded-md overflow-hidden flex-shrink-0">
                        <img
                            v-if="imageUrl"
                            :src="imageUrl"
                            :alt="title"
                            class="w-full h-full object-cover"
                        />
                        <div v-else class="w-full h-full flex items-center justify-center text-gray-400 text-xs">
                            No Image
                        </div>
                    </div>

                    <!-- Episode Details -->
                    <div class="min-w-0 flex-shrink-0 w-40">
                        <p v-if="date" class="text-gray-600 text-xs">{{ date }}</p>
                    </div>

                    <!-- Play Button + Timeline (Custom) -->
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <button
                            @click="togglePlay"
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-black hover:bg-gray-800 flex items-center justify-center transition-colors"
                        >
                            <svg v-if="!isPlaying" class="w-5 h-5 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            <svg v-else class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 4h4v16H6V4zm8 0h4v16h-4V4z"/>
                            </svg>
                        </button>

                        <!-- Timeline -->
                        <div class="flex items-center gap-2 flex-1 min-w-0">
                            <span class="text-xs text-gray-600 w-10 text-right">{{ currentTime }}</span>
                            <input
                                type="range"
                                min="0"
                                :max="duration"
                                v-model="currentProgress"
                                @input="seekAudio"
                                class="flex-1 h-1 bg-gray-300 rounded-lg appearance-none cursor-pointer audio-timeline"
                            />
                            <span class="text-xs text-gray-600 w-10">{{ totalTime }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Section: Volume + Download -->
                <div class="flex items-center gap-3 flex-shrink-0">
                    <!-- Volume Control -->
                    <div class="flex items-center gap-2">
                        <button
                            @click="toggleMute"
                            class="text-black hover:text-gray-600 transition-colors"
                        >
                            <svg v-if="!isMuted" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02z"/>
                            </svg>
                            <svg v-else class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/>
                            </svg>
                        </button>
                        <input
                            type="range"
                            min="0"
                            max="100"
                            v-model="volume"
                            @input="changeVolume"
                            class="w-20 h-1 bg-gray-300 rounded-lg appearance-none cursor-pointer audio-timeline"
                        />
                    </div>

                    <!-- Download Button -->
                    <a
                        :href="audioUrl"
                        download
                        class="text-black hover:text-gray-600 transition-colors"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Hidden Audio Element -->
            <audio
                ref="audioPlayer"
                :src="audioUrl"
                @loadedmetadata="onLoadedMetadata"
                @timeupdate="onTimeUpdate"
                @ended="onEnded"
            />
        </div>
    </div>
</template>

<script setup>
import { ref, onBeforeUnmount } from 'vue'

defineProps({
    audioUrl: {
        type: String,
        required: true
    },
    title: {
        type: String,
        default: 'Now Playing'
    },
    imageUrl: {
        type: String,
        default: null
    },
    date: {
        type: String,
        default: null
    }
})

const audioPlayer = ref(null)
const isPlaying = ref(false)
const isMuted = ref(false)
const currentProgress = ref(0)
const duration = ref(0)
const currentTime = ref('0:00')
const totalTime = ref('0:00')
const volume = ref(100)

const formatTime = (seconds) => {
    if (!seconds || isNaN(seconds)) return '0:00'
    const mins = Math.floor(seconds / 60)
    const secs = Math.floor(seconds % 60)
    return `${mins}:${secs.toString().padStart(2, '0')}`
}

const togglePlay = () => {
    if (!audioPlayer.value) return

    if (isPlaying.value) {
        audioPlayer.value.pause()
    } else {
        audioPlayer.value.play()
    }
    isPlaying.value = !isPlaying.value
}

const toggleMute = () => {
    if (!audioPlayer.value) return
    audioPlayer.value.muted = !audioPlayer.value.muted
    isMuted.value = audioPlayer.value.muted
}

const changeVolume = () => {
    if (!audioPlayer.value) return
    audioPlayer.value.volume = volume.value / 100
}

const seekAudio = () => {
    if (!audioPlayer.value) return
    audioPlayer.value.currentTime = currentProgress.value
}

const onLoadedMetadata = () => {
    if (!audioPlayer.value) return
    duration.value = audioPlayer.value.duration
    totalTime.value = formatTime(duration.value)
}

const onTimeUpdate = () => {
    if (!audioPlayer.value) return
    currentProgress.value = audioPlayer.value.currentTime
    currentTime.value = formatTime(audioPlayer.value.currentTime)
}

const onEnded = () => {
    isPlaying.value = false
    currentProgress.value = 0
}

onBeforeUnmount(() => {
    if (audioPlayer.value) {
        audioPlayer.value.pause()
    }
})
</script>

<style scoped>
/* Custom range slider styling */
.audio-timeline {
    accent-color: #000000;
}

.audio-timeline::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #000000;
    cursor: pointer;
}

.audio-timeline::-moz-range-thumb {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #000000;
    cursor: pointer;
    border: none;
}
</style>
