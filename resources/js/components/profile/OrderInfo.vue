<template>
    <main @click="$emit('close')"
        class="fixed top-0 left-0 z-40 w-full h-full bg-black bg-opacity-40 flex justify-center items-center p-20">
        <section @click.stop class="bg-white shadow  w-4/5 h-full">
            <div class="flex justify-between flex-col">
                <div class="flex justify-between bg-gray-100 text-xl" v-for="number in order_info">
                    <h1 class="mx-2 my-2 text-gray-400">B{{ number.id }} buyurtma tafsilotlari</h1>
                    <button @click="$emit('close')" class="px-3 py-1 hover:text-red-600">
                        <i class="fal fa-times"></i>
                    </button>
                </div>
                <div class="flex flex-col justify-between">
                    <div class="flex justify-between">
                        <div v-for="item in order_info" class="flex justify-between flex-col w-1/2 h-[200px] shadow mx-2 my-4 text-xl shadow-gray-400">
                            <p class="flex justify-between mx-2 mt-2">
                                <span class="font-semibold">Holati:</span>
                                <span v-if="item.order_check==1">Tasdiqlandi</span>
                                <span v-if="item.order_check==4">Yetkazildi</span>
                                <span v-if="item.order_check==2">To'lov qilinmagan</span>
                            </p>
                            <p class="flex justify-between mx-2 ">
                                <span class="font-semibold">Buyurtma vaqti:</span>
                                <span>{{ item.created_at }}</span>
                            </p>
                            <p class="flex justify-between mx-2 ">
                                <span class="font-semibold">Manzil:</span>
                                <span>Bekor qilindi</span>
                            </p>
                            <p class="flex justify-between mx-2 ">
                                <span class="font-semibold">Yetkazib berish usuli:</span>
                                <span>Bekor qilindi</span>
                            </p>
                            <p class="flex justify-between mx-2 mb-2">
                                <span class="font-semibold">Yetkazilgan vaqti:</span>
                                <span>Bekor qilindi</span>
                            </p>
                        </div>
                        <div v-for="item in order_info" class="flex justify-between flex-col w-1/2 h-[200px] shadow mx-2 my-4 text-xl shadow-gray-400">
                            <p class="flex justify-between mx-2 mt-2">
                                <span class="font-semibold">Maxsulotlar narxi:</span>
                                <span>{{item.order_summa}} UZS</span>
                            </p>
                            <p class="flex justify-between mx-2 ">
                                <span class="font-semibold">Yetkazib berish:</span>
                                <span>Bekor qilindi</span>
                            </p>
                            <p class="flex justify-between mx-2 ">
                                <span class="font-semibold">Jami:</span>
                                <span>Bekor qilindi</span>
                            </p>
                            <p class="flex justify-between mx-2 ">
                                <span class="font-semibold">To'landi:</span>
                                <span>Bekor qilindi</span>
                            </p>
                            <p class="flex justify-between mb-2 border-dashed border-t-2 border-gray-400">
                                <span class="mx-2 font-semibold">Qolgan to'lov:</span>
                                <span class="mx-2">Bekor qilindi</span>
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-start items-center mx-2 text-orange-500">
                        <i class="fal fa-box mr-2"></i>
                        <h1 class="text-2xl  font-bold">Mahsulotlar</h1>
                    </div>
                    <main class="flex flex-col shadow  shadow-gray-400 mx-2 my-4 ">
                        <div v-for="item in order_info" class=" overflow-scroll h-full">
                            <article v-for="(element,index) in item.products"  class="flex justify-between mx-2 text-xl h-full">
                                <div class="mr-4">
                                    <img class="h-[300px] w-[300px] object-contain" :src="'/images/'+
                                      element.products_info.category.category_image" />
                                </div>
                                <div class="flex flex-col justify-start">
                                    <p>{{ element.products_info.id}}</p>
                                    <p>{{ element.count}}</p>
                                    <p>{{ element.count*element.products_info.price}}</p>
                                </div>
                            </article>v8 m16
                        </div>
                    </main>
                </div>
            </div>            
        </section>
    </main>
</template>

<script setup>
import { reactive, onMounted, ref } from "vue";
const { selectedDataDelete } = defineProps(["selectedDataDelete"]);

const emit = defineEmits("added");
const order_info = ref(null);


// const result = reactive({
//     id: store.state.id_selected,
// });

axios.get(`order-by-id/${store.state.id_selected}`).then(({ data }) => {
    order_info.value = data;
})


</script>
