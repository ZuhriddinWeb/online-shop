<template>
    <AddCard @close="add_card = null" :selectedDataEdit="add_card" v-if="add_card" />
    <div>
        <h3 class="text-3xl h-28 ">Kartalar</h3>
        <main class="flex justify-between md:w-full">
            <div class="flex flex-col justify-start items-center text-white md:w-full md:flex-row md:space-x-4 md:space-y-0">
                <main
                    class="shadow shadow-gray-400 flex flex-col justify-between text-xl min-w-[315px] h-[225px] rounded-xl bg-gradient-to-tr  from-green-600 to-green-400 ">
                    <div class="flex justify-start mx-8 my-4 font-thin">4Ever.uz</div>
                    <div class="flex mx-8 my-4 font-medium" v-for="number in card_number">
                        <p>{{ number.number }}</p>
                    </div>
                    <div class="flex justify-between mx-8 my-4">
                        <p>************************</p>
                        <!-- <p>Humo</p> -->
                    </div>
                </main>
                <main  @click="add_card = true"
                    class="cursor-pointer shadow shadow-gray-400 flex flex-col mt-2 justify-between text-xl min-w-[315px] h-[225px] rounded-xl bg-gradient-to-tr  from-gray-500 to-gray-300 hover:bg-gradient-to-tr  hover:from-gray-600 hover:to-gray-400">
                    <p></p>
                    <p class="flex  justify-center items-center">
                        <span>
                            <i class="fal fa-plus"></i>
                        </span>
                        <span class="ml-2">Karta qo'shish</span>
                    </p>
                    <p></p>
                </main>
            </div>
        </main>
    </div>
</template>

<script setup>
import AddCard from '../../components/profile/AddCard.vue';
import { reactive, ref } from "vue";

const add_card = ref(null);
</script>