<template>
    <div class="px-4 md:px-8">
        <div class="w-32 lg:w-48 cursor-pointer" @click.stop="toggleModal(showingProductModal)">
            <img :src="product.image" :alt="product.title ? product.title + ' cover' : 'product cover'"
                class="">
        </div>
        <DialogModal :show="showingProductModal" :closeable="true" @close="toggleModal(showingProductModal)">
            <template #title>
            </template>

            <template #content>
                <div class="space-y-4 max-w-md  mx-auto">
                    <div class="text-lg text-center text-gray-600">
                        <div v-if="product.platform" class="break-words">
                            <span class="font-semibold text-gray-900">{{ product.title}}</span> 
                        </div>
                    </div>
                    <div v-if="product.image" class="flex justify-center">
                        <img :src="product.image" :alt="product.title ? product.title + ' cover' : 'product cover'"
                            class="w-48 rounded" />
                    </div>

                    <div class=" text-gray-600">
                        <div v-if="product.platform" class="break-words">
                            <span class="font-semibold text-gray-900">Platform:</span> {{ product.platform }}
                        </div>
                        <div v-if="product.rating != null" class="break-words">
                            <span class="font-semibold text-gray-900">Rating:</span> {{ product.rating }}
                        </div>
                        <div v-if="product.genre != null" class="break-words">
                            <span class="font-semibold text-gray-900">Genre(s):</span> {{ product.genre }}
                        </div>
                        <div v-if="product.release_date != null" class="break-words">
                            <span class="font-semibold text-gray-900">Release Date</span> {{ product.release_date }}
                        </div>
                    </div>
                    <div v-if="product.description" class="cursor-pointer text-justify text-xs text-gray-600"
                        @click="toggleDescription(showingFullDescription)">
                        {{ showingFullDescription ? product.description :
                            product.description.substring(0, 250) +"...(Click to expand)" }}
                    </div>
                </div>
            </template>

            <template #footer>
                <button type="button"
                    class="inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                    @click="toggleModal(showingProductModal)">
                    Close
                </button>
            </template>
        </DialogModal>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';

defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const showingProductModal = ref(false);
const showingFullDescription = ref(false);
const toggleModal = (status = false) => {
    showingProductModal.value = status ? false : true;
};
const toggleDescription = (status = false) => {
    showingFullDescription.value = status ? false : true;
};
</script>
