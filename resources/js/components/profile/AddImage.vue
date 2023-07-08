<template>
    <main
        @click="$emit('close')"
        class="fixed top-0 left-0 z-40 w-full h-full bg-black bg-opacity-40 flex justify-center items-center p-20"
    >
    <section @click.stop class="bg-white shadow h-3/5 w-[820px] rounded-sm">
            <div class="text-right flex flex-col h-full">
                <main class="flex  justify-between w-full items-center bg-gray-100 shadow-sm">
                    <div class="flex justify-between p-2 w-full">
                        <header class="flex justify-center items-center text-xl text-gray-500">
                            <span>To'lov qilish uchun ma'lumotnoma || </span>
                            <span class="ml-4"> {{ $store.state.summa_price  }} So'm to'lashingiz kerak</span>
                           
                        </header>                    
                        <div class="text-xl">
                            <button @click="$emit('close')" class="px-3 py-1 hover:text-red-600">
                                <i class="fal fa-times"></i>
                            </button>
                        </div>
                    </div>
                </main>
                <article class="flex justify-between w-full h-full">
                    <div class="w-1/2 flex justify-center items-center text-white">
                        <main class="shadow shadow-gray-400 flex flex-col justify-between text-xl min-w-[360px] h-[240px] rounded-xl bg-gradient-to-tr  from-sky-600 via-purple-400 to-sky-400">
                            <div class="flex justify-start mx-8 my-4 font-thin">4Ever.uz</div>
                            <div class="flex mx-8 my-4 font-medium" v-for="number in card_number">
                                <p>{{ number.number }}</p>
                            </div>
                            <div class="flex justify-between mx-8 my-4">
                                <p>************************</p>
                                <p>Humo</p>
                            </div>
                        </main>
                    </div>
                    <div class="w-1/2 mx-4 border-l-2">
                       <div class="text-center">
                            <p class="font-semibold">Rasmda ko'rsatilgan plastik karta raqamiga pul o'tkazib to’lov skrinshotini biriktirib qo’ying</p>
                            <i class="fal fa-arrow-alt-to-bottom text-2xl my-4"></i>
                       </div>
                       <form class="w-full  mb-8 mt-8 mx-2" @submit.prevent="onSubmit" enctype="multipart/form-data">
                            <div class="text-center">
                                <UploadImage :formData="result"/>
                            </div>
                            <div class="flex justify-between">
                                <button type="submit" class="bg-gray-100 w-1/2 py-1 px-4 mr-2 border-b-2 border-blue-500 hover:bg-blue-200">
                                    <i class="far fa-layer-plus mx-2"></i>Saqlash
                                </button>
                                <button @click="emit('close')" class="bg-gray-100 w-1/2 py-1 px-4 ml-2 border-b-2 border-rose-500 hover:bg-rose-200">
                                    <i class="far fa-times mx-2"></i>Bekor qilish
                                </button>
                            </div>
                        </form>
                    </div>
                </article>              
            </div>
        </section>
    </main>
</template>

<script setup>
import { reactive, onMounted, ref } from "vue";
const { selectedDataDelete } = defineProps(["selectedDataDelete"]);
import UploadImage from "./UploadImage.vue";

const emit = defineEmits("added");
const card_number=ref(null);

const result = reactive({
    id_order:store.state.id_selected,
    images: []

});
axios.get(`virtual-numbers`).then((res) => {
    card_number.value = res.data;
})
const onSubmit = async () => {
    const formdata = new FormData()


    for (const key in result) {

        if(key == 'images'){
            result.images.forEach(image => {
                formdata.append('images[]', image)
            })
        }
        else formdata.append(key, result[key])

    }

    const { data } = await axios.post("order-pay-save", formdata);
    if (data.status == 200) {
        emit("added");
        emit("close");
    }
};

</script>
