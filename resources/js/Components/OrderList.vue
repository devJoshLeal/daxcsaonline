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
                    <div class="grid lg:flex"><span>Order ID:</span>
                        <p>{{ order.tracking_id }}</p>
                    </div>
                </div>
                <div class=" bg-white p-4">
                    <div class="grid md:flex justify-evenly" v-for="product in order.product_list">
                        <div class="flex justify-center">
                            <ProductBox :product="product"></ProductBox>
                        </div>
                        <div class=" md:text-justify">
                            <div>
                                <span class="font-semibold">Product:</span>
                                <p>{{ product.title }}</p>
                            </div>
                            <div>
                                <span class="font-semibold">Delivery Date:</span>
                                <p>{{ dateFormater(order.delivery_date) }}</p>
                            </div>
                            <p><span class="font-semibold">Quantity:</span> {{ order.quantity }}</p>
                            <div class="">
                                <span class="font-semibold">Address:</span>
                                <p class="">{{ order.address }}</p>
                            </div>
                            <div class="">
                                <span class="font-semibold">Phone:</span>
                                <p>{{ order.phone }}</p>
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
import ProductBox from './ProductBox.vue';
  export default {
    components: { ProductBox},
    // Token as prop
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
        // Fetch all orders from current User
        const response = await axios.get('/api/order/byUser/', {
            headers: {
            Authorization: this.token
            },
        });
        this.orders = response.data.data;

        } catch (error) {
        console.error('Error fetching order data:', error);
        }
    },
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
