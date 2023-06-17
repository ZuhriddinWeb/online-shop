<template>       
     <section class="flex justify-between bg-pink-300 mx-2">
        <div class="flex flex-col justify-between">
            <p>Mustafoyev Zuhriddin</p>
            <p>Mustafoyev Zuhriddin</p>
            <p>Mustafoyev Zuhriddin</p>
            <p>Mustafoyev Zuhriddin</p>
            <p>Mustafoyev Zuhriddin</p>
        </div>
        <div class="flex flex-col justify-between">
            <p>Mustafoyev Zuhriddin</p>
            <p>Mustafoyev Zuhriddin</p>
            <p>Mustafoyev Zuhriddin</p>
            <p>Mustafoyev Zuhriddin</p>
            <p>Mustafoyev Zuhriddin</p>
        </div>
     </section>
</template>

<script setup>
import { reactive, ref } from "vue";
import store from "../../store";
const orders = ref(null);

axios.get(`user-order/${store.state.user.id}`).then(({ data }) => {
    orders.value = data;
})
</script>
