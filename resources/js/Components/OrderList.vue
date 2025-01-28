<template>
    <div class="container mx-auto p-4">
      <!-- Order Details Section -->
      <div >
        <div v-if="orders">
            <div v-for="order in orders" class="rounded-lg px-6 pb-6">
                <div class="bg-blue-400 flex justify-between text-white py-4 px-4 font-bold text-sm md:text-base lg:text-lg ">
                    <div class="grid lg:flex"><span>Order Date:</span>
                        <p>{{ dateFormater(order.order_date) }}</p>
                    </div>
                    <div class="grid lg:flex"><span>Total Price:</span>
                        <p>$ {{ order.total_price }}</p>
                    </div>
                    <div class="grid lg:flex"><span>Order ID:</span>
                        <p>{{ order.tracking_id }}</p>
                    </div>
                </div>
                <div class="grid md:flex justify-evenly  bg-white py-4 px-4 ">
                    <div class="flex" v-for="product in order.product_list">
                        <div>
                            <div class="w-3/4">
                                <img :src="product.image" alt="Product Image" class="rounded-lg">
                            </div>
                        </div>
                        <div class="w-48 text-right md:text-justify">
                            <div>
                                <span class="font-semibold">Product Title:</span>
                                <p>{{ product.title }}</p>
                            </div>
                            <div>
                                <span class="font-semibold">Product Platform:</span>
                                <p>{{ product.platform }}</p>
                            </div>
                            <div class="hidden lg:block">
                                <span class="font-semibold">Product Description:</span>
                                <p>{{ product.description }}</p>
                            </div>
                            <p><span class="font-semibold">Product Price:</span> ${{ product.price }}</p>
                            <p><span class="font-semibold">Quantity:</span> {{ order.quantity }}</p>
                            <div class="block md:hidden">
                                <span class="font-semibold">Delivery Date:</span>
                                <p>{{ dateFormater(order.delivery_date) }}</p>
                            </div>
                            <div class="block md:hidden">
                                <span class="font-semibold">Phone:</span>
                                <p>{{ order.phone }}</p>
                            </div>
                            <div class="block md:hidden">
                                <span class="font-semibold">Address:</span>
                                <p class="block md:hidden">{{ order.address }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:flex md:justify-center w-48">
                        <div class="text-right ">
                            <div>
                                <span class="font-semibold">Delivery Date:</span>
                                <p>{{ dateFormater(order.delivery_date) }}</p>
                            </div>
                            <div>
                                <span class="font-semibold">Phone:</span>
                                <p>{{ order.phone }}</p>
                            </div>
                            <div>
                                <span class="font-semibold">Address:</span>
                                <p>{{ order.address }}</p>
                            </div>
                        </div>
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
    props: {
        token: {
            type: String
        }
    },
    data() {
      return {
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
    // Agrega esta función a tu objeto de métodos
    methods: {
        dateFormater(date) {
            const fecha = new Date(date);
            const dia = fecha.getDate().toString().padStart(2, '0');
            const mes = (fecha.getMonth() + 1).toString().padStart(2, '0');
            const año = fecha.getFullYear();
            return `${dia}-${mes}-${año}`;
        }
    }
  }
</script>
