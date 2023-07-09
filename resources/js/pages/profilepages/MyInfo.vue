<template>
    <section class="flex justify-between  mx-4">
        <div class="flex flex-col justify-between py-6 text-xl">
            <p>
                <span class="font-bold text-gray-400">Имя:</span>
                <span class="ml-1 font-semibold">{{ $store.state.user.fname }}</span>
            </p>
            <p>
                <span class="font-bold text-gray-400">Фамилия:</span>
                <span class="ml-1 font-semibold">{{ $store.state.user.lname }}</span>
            </p>
            <p>
                <span class="font-bold text-gray-400">Паспортные данные:</span>
                <span class="ml-1 font-semibold">{{ $store.state.user.passport }}</span>
            </p>
            <p>
                <span class="font-bold text-gray-400">Мобильный телефон:</span>
                <span class="ml-1 font-semibold">{{ $store.state.user.phone }}</span>
            </p>
            <p>
                <span class="font-bold text-gray-400">Адрес:</span>
                <span class="ml-1 font-semibold">{{ $store.state.user.phone }}</span>
            </p>
            <!-- <p>{{ user_info[0].lname }}</p>
            <p>{{ user_info[0].lname }}</p>
            <p>{{ user_info[0].lname }}</p>
            <p>{{ user_info[0].lname }}</p> -->
        </div>
        <!-- <div class="flex flex-col justify-between">
            <p>Mustafoyev Zuhriddin</p>Мобильный телефон
            <p>Mustafoyev Zuhriddin</p>
            <p>Mustafoyev Zuhriddin</p>
            <p>Mustafoyev Zuhriddin</p>
            <p>Mustafoyev Zuhriddin</p>
        </div> -->
    </section>
</template>

<script setup>
import { reactive, ref } from "vue";
import store from "../../store";
const user_info = ref(null);

axios.get(`user-info/${store.state.user.id}`).then(({ data }) => {
    user_info.value = data[0];
})
</script>
