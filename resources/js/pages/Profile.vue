<template>
     <header>
        <Header />
    </header>
    

    <div class=" container mx-auto bg-white my-5 w-full flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0">
        <main class="sm:w-3/3 md:w-2/3  lg:w-1/4 px-5 py-4">
            <div class="flex flex-col border-b-2">
                    <div class="flex justify-start  py-6 px-4">
                        <div class="bg-gray-100 rounded-full mr-8">
                            <i class="fal fa-user p-4 text-center text-xl"></i>
                        </div>
                        <div class="flex flex-col">
                            <p class="flex justify-center font-medium">
                                <span class="mr-1">{{ $store.state.user.fname }}</span> 
                                <span>{{ $store.state.user.lname }}</span>
                            </p>
                            <p class="flex justify-center font-medium text-gray-500">
                                <span>
                                    {{ $store.state.user.phone }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <main class="flex flex-col">
                        <div class="flex justify-between ">
                             <div class="bg-gray-100 rounded-sm w-1/2 mx-1 my-1">
                                 <p class="flex justify-between flex-col">
                                     <span class="py-2 px-2">Bonus:</span>
                                     <span></span>
                                 </p>
                             </div>
                             <div class="bg-gray-100 rounded-sm w-1/2 mx-1 my-1">
                                 <p class="flex justify-between flex-col">
                                     <span class="py-2 px-2">Cashback:{{ my_cashback?.cashback }}</span>
                                     <span></span>
                                 </p>
                             </div>
                        </div>
                        <article class="flex justify-between bg-gray-100 rounded-sm  mx-1 my-1 items-center">
                            <input @keyup.alt.67="YourFn" class="w-5/6" type="text" :value="'www.4ever.uz/register/'+$store.state.user.promo_code" disabled>
                            <span class="mx-1"></span>
                            <i class="fal fa-copy mx-1 hover:text-green-500"></i>
                        </article>

                    </main>
                </div>
                <article class="flex justify-start  py-6 px-4 hover:shadow cursor-pointer">
                    <div class="bg-gray-100 rounded-full mr-8">
                        <i class="fal fa-user p-4  text-center text-xl"></i>
                    </div>
                    <div class="flex justify-center mt-2">
                        <router-link class="font-normal" :to="{name: 'myinfo'}">Mening malumotlarim</router-link>
                    </div>
                </article>
                <article class="flex justify-start  py-6 px-4 hover:shadow cursor-pointer">
                    <div class="bg-gray-100 rounded-full mr-8">
                        <i class="fal fa-wallet p-4 text-center text-xl"></i>
                    </div>
                    <div class="flex justify-center mt-2">
                        <router-link class="font-normal" :to="{name: 'mywallet'}">Mening hamyonim</router-link>
                    </div>
                </article>
                <article class="flex justify-start  py-6 px-4 hover:shadow cursor-pointer" @click="my_orders=true,my_peoples=false,my_info=false">
                    <div class="bg-gray-100 rounded-full mr-8">
                        <i class="fal fa-box p-4 text-center text-xl"></i>
                    </div>
                    <div class="flex justify-center mt-2">
                        <router-link class="font-normal" :to="{name: 'myorders'}">Mening buyurtmalarim</router-link>
                    </div>
                </article>
                <article class="flex justify-start  py-6 px-4 hover:shadow cursor-pointer" @click="my_peoples=true,my_orders=false,my_info=false">
                    <div class="bg-gray-100 rounded-full mr-8">
                        <i class="fal fa-users p-4 text-center text-xl"></i>
                    </div>
                    <div class="flex justify-center mt-2">
                        <router-link class="font-normal" :to="{name: 'mypeoples'}">Mening izdoshlarim</router-link>
                    </div>
                </article>
                <article class="flex justify-start  py-6 px-4 hover:shadow cursor-pointer">
                    <div class="bg-gray-100 rounded-full mr-8">
                        <i class="fal fa-receipt p-4 text-center text-xl"></i>
                    </div>
                    <div class="flex justify-center mt-2">
                        <router-link class="font-normal" :to="{name: 'myhistory'}">To'lovlar tarixi</router-link>
                    </div>
                </article>
                <article class="flex justify-start  py-6 px-4 hover:shadow cursor-pointer">
                    <div class="bg-gray-100 rounded-full mr-8">
                        <i class="fal fa-sign-out p-4 text-center text-xl"></i>
                    </div>
                    <div class="flex justify-center mt-2" @click="$store.dispatch('logout')">
                        <span class="font-normal">Chiqish</span>
                    </div>
                </article>
        </main>
        <aside class="sm:w-3/3 md:w-1/3 lg:w-3/4 px-5 py-4">
            <!-- <div class="flex justify-start h-24">
                    <span class="text-xl font-semibold ml-4">Ma'lumotlar</span>
                </div> -->
                <div>
                    <router-view></router-view>                   
                </div>
        </aside>
    </div>
</template>
<script setup>
import Header from "../components/Header.vue"
import { reactive, ref } from "vue";

const add_Check = ref(null);
const my_orders = ref(null);
const my_peoples = ref(null);
const my_cashback = ref(null);
const my_info = ref(true);

axios.get(`cashback`).then(({ data }) => {
    my_cashback.value = data;
})


</script>
<style>
::-webkit-scrollbar {
    width: 3px;
    height: 3px;
}
 
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}
 
::-webkit-scrollbar-thumb {
    background-color:  rgb(249 115 22);
}
</style>