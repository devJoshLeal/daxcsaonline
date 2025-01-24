<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import OrderList from '@/Components/OrderList.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Orders
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="$page.props.auth.user" class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <OrderList />
                </div>
                <div v-else>
                    <Welcome />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
