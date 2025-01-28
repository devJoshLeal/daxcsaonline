
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import OrderList from '@/Components/OrderList.vue';
import Welcome from '@/Components/Welcome.vue';
import { usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';


const token = ref(null);

async function getToken(paramjson) {
try {
    const response = await axios.get('/api/authcontrol/tokenfromuser', { params:
    { json: JSON.stringify(paramjson) }
    });
    return response.data.data.token;
} catch (error) {
    console.error(error);
}
}

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
                Orders
            </h2>
        </div>
    </template>
    <div class="max-w-5xl mx-auto overflow-hidden">
        <OrderList v-if="token" :token="token" />
    </div>
</AppLayout>
</template>
