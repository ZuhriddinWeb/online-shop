<template>
    <section @click="emit('close')" class="flex justify-end fixed top-0 left-0 w-full h-full  bg-black bg-opacity-30 z-40">
        <aside @click.stop  class="md:w-1/3 justify-between h-full overflow-hidden p-4 pr-0 bg-gray-50 shadow">
            <div class="menu flex flex-col justify-between">                  
                <div class="text-black flex justify-between pb-4 pr-4">
                    <span></span>
                    <button @click="emit('close')">
                        <i  class="fal fa-times cursor-pointer text-2xl hover:text-red-600"></i>
                    </button>
                </div> 
                <main class="flex flex-col justify-start mt-56 mx-8">       
                                 
                    <div class="text-3xl">
                        <p>Войти</p>
                        <p>в мой офис</p>
                    </div>
                    <div>
            <div class="flex flex-wrap">
                <div class="w-full">
                <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow  block leading-normal cursor-pointer rounded-sm" v-on:click="toggleTabs(2)" v-bind:class="{'text-orange-500 bg-white': openTab !== 1, 'text-white bg-orange-500': openTab === 1}">
                        <i class="fas fa-space-shuttle text-base mr-1"></i> Tizimga kirish
                    </a>
                    </li>
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow  block leading-normal cursor-pointer rounded-sm" v-on:click="toggleTabs(1)" v-bind:class="{'text-orange-500 bg-white': openTab !== 2, 'text-white bg-orange-500': openTab === 2}">
                        <i class="fas fa-cog text-base mr-1"></i> Ro'yxatdan o'tish
                    </a>
                    </li>       
                </ul>
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 ">
                    <div class="flex-auto">
                    <div class="tab-content tab-space">
                        <div v-bind:class="{'hidden': openTab !== 2, 'block': openTab === 2}" >
                                <form class="flex flex-col justify-center mt-4" autocomplete="off" @submit.prevent="onLogin">
                                    <input  v-model="result_login.phone" type="text" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-gray-200 py-2 focus:outline-none" placeholder="ID/Телефон">
                                    <input  v-model="result_login.password" type="password" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-gray-200 py-2 focus:outline-none" placeholder="Парол">
                                    <!-- <input type="text" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-gray-200 py-2 focus:outline-none" placeholder="ID Приглашатель"> -->
                                    <button class="flex justify-center items-center w-full py-3 bg-orange-500 text-white text-xs font-bold uppercase px-5  shadow  leading-normal cursor-pointer rounded-sm"><i class="fal fa-door-open mr-2 text-base"></i>Kirish</button>
                                </form>
                                <!-- <article class="flex justify-between py-4 text-orange-600">
                                    <p class="cursor-pointer">Начать бизнес</p>
                                    <p class="cursor-pointer">Забыли пароль?</p>
                                </article> -->
                        </div>
                        <div v-bind:class="{'hidden': openTab !== 1, 'block': openTab === 1}">
                                <form class="flex flex-col justify-center mt-4" @submit.prevent="onRegistration">
                                    <input v-model="result.fname" type="text" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-gray-200 py-2 focus:outline-none" placeholder="Ism">
                                    <input v-model="result.lname" type="text" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-gray-200 py-2 focus:outline-none" placeholder="Familiya">
                                    <input v-model="result.passport" type="text" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-gray-200 py-2 focus:outline-none" placeholder="Passport seriya raqami">
                                    <input v-model="result.phone" type="text" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-gray-200 py-2 focus:outline-none" placeholder="Telefon raqam">
                                    <input v-model="result.password" type="password" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-gray-200 py-2 focus:outline-none" placeholder="Parol"  name="password_confirmation" required>                                 
                                    <input v-model="result.password_confirmation" type="password" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-gray-200 py-2 focus:outline-none" placeholder="Parolni tasdiqlash"  name="password_confirmation" required>
                                    <input v-model="result.code" type="text" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-gray-200 py-2 focus:outline-none" placeholder="Promo Code">
                                    <button class="flex justify-center items-center w-full py-3 bg-orange-500 text-white text-xs font-bold uppercase px-5  shadow  leading-normal cursor-pointer rounded-sm"><i class="fal fa-door-open mr-2 text-base"></i>Kirish</button>
                                </form>
                        </div>           
                    </div>
                    </div>
                </div>
                </div>
            </div>            
        </div>
       
                </main>
            </div>          
        </aside>
    </section>
</template>

<script setup>
// import VuePhoneNumberInput from 'vue-phone-number-input';948537875
import { kMaxLength } from "buffer";
import { reactive, onMounted, ref } from "vue";
const emit = defineEmits(['close'])
const openTab = ref(1);

function toggleTabs(tabNumber){
    return openTab.value = tabNumber
}

const result = reactive({
    lname:"",
    fname:"",
    passport:"",
    phone:"",
    password:"",
    password_confirmation:"",
    // promo_code:Math.random().toString(36).slice(2),
    code:"",
});
const result_login = reactive({   
    phone:"",
    password:"",   
});
const onRegistration = async () => {
    var k = Math.random().toString(36).slice(2);
    // console.log(k);
    const { data } = await axios.post("regstration", result);
    if (data.status == 200) {
        // console.log(openTab.value);
        // store.state.opened
        // return openTab.value=2
    }
};
const onLogin = async () => {
    await store.dispatch('login', result_login)
};
</script>
