<template>
    <div class="container mx-auto p-4">
      <!-- Order Details Section -->
      <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div v-if="orders">
            <div v-for="order in orders" class="">
                <h2 class="text-xl font-bold mb-4">Order {{ order.tracking_id }}</h2>
                <div class="grid md:flex justify-evenly ">
                    <div>
                        <div class="w-1/2 mx-auto ">
                            <img :src="order.product_list[0].image" alt="Product Image" class="rounded-lg">
                        </div>
                    </div>
                    <div>
                        <p><span class="font-semibold">Tracking ID:</span> {{ order.tracking_id }}</p>
                        <p><span class="font-semibold">Product Title:</span> {{ order.product_list[0].title }}</p>
                        <p><span class="font-semibold">Quantity:</span> {{ order.quantity }}</p>
                        <p><span class="font-semibold">Total Price:</span> ${{ order.total_price }}</p>
                        <p><span class="font-semibold">Order Date:</span> {{ order.order_date }}</p>
                        <p><span class="font-semibold">Delivery Date:</span> {{ order.delivery_date }}</p>
                        <p><span class="font-semibold">Phone:</span> {{ order.phone }}</p>
                        <p><span class="font-semibold">Address:</span> {{ order.address }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <p>No orders found, yet!.</p>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
            token: '1470e780fffb1f37b9c224f6bc266a6f080c962124f30c6cf4c6cb472b576ea6',
            orders:{}
        }
    },
    async created() {
        try {
        // Replace with your API endpoint
        const response = await axios.get('/api/order/byUser/', {
            headers: {
            Authorization: this.token
            },
        });
        this.orders = response.data.data; // Populate the order object with API data

        } catch (error) {
        console.error('Error fetching order data:', error);
        }
    },
  }
</script>
