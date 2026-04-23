
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import OrderList from '@/Components/OrderList.vue';
import Welcome from '@/Components/Welcome.vue';
import { usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const page = usePage();

onMounted(async () => {
    token.value = await getToken(page.props.auth.user);
});

</script>

<template>
<AppLayout title="Dashboard">
    <template #header>
        <div class="flex justify-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                DashBoard
            </h2>
        </div>
    </template>
    <div>
        <Welcome />
    </div>
</AppLayout>
</template>
