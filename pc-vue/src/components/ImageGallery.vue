<template>
    <div>
        <div class="thumbnail-container">
            <img v-for="item in images" :key="item.id" :src="item.image" @click="showModalBtn(item.image)"
                class="thumbnail" />
        </div>

        <!-- Modal -->
        <transition name="modal">
            <div v-if="showModal" class="modal-mask">
                <div class="modal-wrapper">
                    <button @click="closeModal" class="modal-close"><svg t="1728138547036" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4259" width="30" height="30"><path d="M512 0C229.187368 0 0 229.187368 0 512 0 794.812632 229.187368 1024 512 1024 794.812632 1024 1024 794.812632 1024 512 1024 229.187368 794.812632 0 512 0ZM512 970.105263C259.368421 970.105263 53.894737 764.631579 53.894737 512 53.894737 259.368421 259.368421 53.894737 512 53.894737 764.631579 53.894737 970.105263 259.368421 970.105263 512 970.105263 764.631579 764.631579 970.105263 512 970.105263ZM550.130526 512 719.629474 342.366316C730.273684 331.856842 730.273684 314.88 719.629474 304.370526 709.12 293.726316 692.143158 293.726316 681.633684 304.370526L512 473.869474 342.366316 304.370526C331.856842 293.726316 314.88 293.726316 304.370526 304.370526 293.726316 314.88 293.726316 331.856842 304.370526 342.366316L473.869474 512 304.370526 681.633684C293.726316 692.143158 293.726316 709.12 304.370526 719.629474 309.625263 724.884211 316.496842 727.578947 323.368421 727.578947 330.24 727.578947 337.111579 724.884211 342.366316 719.629474L512 550.130526 681.633684 719.629474C686.888421 724.884211 693.76 727.578947 700.631579 727.578947 707.503158 727.578947 714.374737 724.884211 719.629474 719.629474 730.273684 709.12 730.273684 692.143158 719.629474 681.633684L550.130526 512Z" fill="#ffffff" p-id="4260"></path></svg></button>
                    <div class="modal-container" style="flex-direction: row;justify-content: center;">
                        <button @click="prevImage" class="modal-button" style="transform: scaleX(-1);"><svg t="1728138905580" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5306" width="30" height="30"><path d="M242.005 1000.334c-29.013-27.875-28.444-74.524 0-102.969L627.485 512l-385.48-385.365c-28.444-28.445-28.444-74.525 0-102.97s74.525-28.444 102.97 0l437.02 436.907c15.587 13.768 38.912 61.327 0 102.97l-437.02 436.906c-20.595 21.732-67.243 34.247-102.97-0.114z" fill="#ffffff" p-id="5307"></path></svg></button>
                        <img :src="currentImage" alt="Zoomed Image" class="zoomed-image" />
                        <button @click="nextImage" class="modal-button"><svg t="1728138905580" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5306" width="30" height="30"><path d="M242.005 1000.334c-29.013-27.875-28.444-74.524 0-102.969L627.485 512l-385.48-385.365c-28.444-28.445-28.444-74.525 0-102.97s74.525-28.444 102.97 0l437.02 436.907c15.587 13.768 38.912 61.327 0 102.97l-437.02 436.906c-20.595 21.732-67.243 34.247-102.97-0.114z" fill="#ffffff" p-id="5307"></path></svg></button>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    images: {
        type: Array,
        required: true
    },
    show: {
        type: Boolean,
        default: false
    },
    initialImage: {
        type: String,
        default: ''
    }
});

const emit = defineEmits(['update:show']);

const showModal = ref(props.show);
const currentIndex = ref(0);

// 初始化当前图片的索引
const findInitialIndex = (image) => {
    const index = props.images.findIndex(item => item.image === image);
    return index >= 0 ? index : 0;
};

currentIndex.value = findInitialIndex(props.initialImage);

watch(() => props.show, (newVal) => {
    showModal.value = newVal;
});

watch(() => props.initialImage, (newVal) => {
    currentIndex.value = findInitialIndex(newVal);
});

const currentImage = computed(() => props.images[currentIndex.value]?.image || '');

const showModalBtn = (image) => {
    currentIndex.value = findInitialIndex(image);
    showModal.value = true;
    emit('update:show', true);
};

const closeModal = () => {
    showModal.value = false;
    emit('update:show', false);
};

const nextImage = () => {
    if (currentIndex.value < props.images.length - 1) {
        currentIndex.value++;
    } else {
        currentIndex.value = 0; // 循环到第一张
    }
};

const prevImage = () => {
    if (currentIndex.value > 0) {
        currentIndex.value--;
    } else {
        currentIndex.value = props.images.length - 1; // 循环到最后一张
    }
};
</script>

<style scoped>
.thumbnail-container {
    display: none;
    gap: 10px;
    margin-bottom: 20px;
}

.thumbnail {
    cursor: pointer;
    width: 100px;
    /* 调整缩略图大小 */
}

.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgb(0 0 0 / 80%);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container {
    width: 80%;
    margin: 0px auto;
    padding: 20px 30px;
    display: flex;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
    text-align: center;
}

.zoomed-image {
    max-width: 100%;
    height: auto;
    margin: auto;
}

.modal-button {
    background-color: transparent;
    border: none;
    font-size: 24px;
    cursor: pointer;
}

.modal-close {
    background-color: unset;
    border: none;
    padding: 5px 10px;
    margin-top: 10px;
    cursor: pointer;
    position: absolute;
    right: 5%;
    top: 5%;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
}
</style>