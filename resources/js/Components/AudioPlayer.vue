<template>
    <div v-if="audioUrl" class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-300 shadow-lg">
        <div class="w-full px-4 py-3">
            <!-- Episode Info Section -->
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center space-x-3">
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
                    <div class="min-w-0 flex-1">
                        <h3 class="text-black text-sm font-semibold truncate">{{ title || 'Now Playing' }}</h3>
                        <p v-if="date" class="text-gray-600 text-xs">{{ date }}</p>
                    </div>
                </div>
            </div>

            <!-- Audio Player -->
            <audio
                ref="audioPlayer"
                controls
                class="w-full"
            >
                <source :src="audioUrl" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import Plyr from 'plyr'
import 'plyr/dist/plyr.css'

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
let player = null

onMounted(() => {
    if (audioPlayer.value) {
        player = new Plyr(audioPlayer.value, {
            controls: [
                'play-large',
                'play',
                'progress',
                'current-time',
                'duration',
                'mute',
                'volume',
                'download'
            ],
            settings: ['speed'],
            speed: { selected: 1, options: [0.5, 0.75, 1, 1.25, 1.5, 2] },
        })
    }
})

onBeforeUnmount(() => {
    if (player) {
        player.destroy()
    }
})
</script>

<style>
/* Custom Plyr styling for white background with black text */
.plyr {
    --plyr-color-main: #000000;
    --plyr-video-background: transparent;
    --plyr-audio-controls-background: #ffffff;
    --plyr-audio-control-color: #000000;
    --plyr-audio-control-color-hover: #333333;
    --plyr-range-fill-background: #000000;
    --plyr-audio-progress-buffered-background: rgba(0, 0, 0, 0.1);
}

.plyr--audio .plyr__controls {
    background: #ffffff;
    border-radius: 8px;
    padding: 12px;
    color: #000000;
}

.plyr__control--overlaid {
    background: rgba(0, 0, 0, 0.8);
    color: #ffffff;
}

.plyr__control--overlaid:hover {
    background: #000000;
}

.plyr__control {
    color: #000000;
}

.plyr__control:hover {
    color: #333333;
}

.plyr__progress__buffer {
    color: rgba(0, 0, 0, 0.1);
}
</style>
