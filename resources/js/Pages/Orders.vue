
<script setup>
// Uses default applayout
import AppLayout from '@/Layouts/AppLayout.vue';
// Impórts Order List Component
import OrderList from '@/Components/OrderList.vue';
import { usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

defineProps({
    token: String,
});

const page = usePage();

onMounted(async () => {
    // Once loaded, the page request the user's token
    token.value = await getToken(page.props.auth.user);
});

</script>

<template>
<AppLayout title="Dashboard">
    <template #header>
        <div class="flex justify-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Orders
            </h2>
        </div>
    </template>
    <div class="max-w-5xl mx-auto overflow-hidden">
        <OrderList v-if="token" :token="token" />
    </div>
</AppLayout>
</template>
