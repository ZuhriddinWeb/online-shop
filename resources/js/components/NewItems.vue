<template>
    <section class="bg-white py-8">

<div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">

    <nav id="store" class="w-full z-30 top-0 px-6 py-1">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

            <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
        Store
    </a>

            <div class="flex items-center" id="store-nav-content">

                <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                    <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
                    </svg>
                </a>

                <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                    <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z" />
                    </svg>
                </a>

            </div>
      </div>
    </nav>

    <main class="flex flex-wrap w-full">
            <div v-for="item,index in products" class="px-2 md:w-1/4 xl:w-1/5 cursor-pointer border-gray-50" >
                <div class="w-full p-4 flex flex-col bg-white my-2 rounded-sm border border-gray-100 hover:shadow-lg" >

                    <main class="-m-4 mb-3 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-full bg-black/20"></div>
                        <img class=" h-[180px] w-full object-contain " src="https://static.tildacdn.com/stor6464-3731-4561-b439-353734643438/80317068.jpg" alt="">
                    </main>
                   <main class="flex flex-col">
                        <h3 class="font-semibold text-xl">{{ item.product_name }}</h3>
                        <p class="text-orange-500">{{ item.category_name }}</p>
                        <p class="text-gray-400 mb-4">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem, sint velit cumque similique rerum impedit earum...
                        </p>
                        <main class="text-gray-400 flex justify-between items-center">
                            <span>
                                <i class="fal fa-certificate text-orange-500 mr-1"></i> Aroma
                            </span>
                            <div >
                                <span class="text-xs">
                                    17 Mar 
                                </span>
                                <i class="ml-1 fal text-orange-500 fa-calendar"></i>
                            </div>
                        </main>
                   </main>           
                </div>
            </div>
        </main>

    </div>

</section>
  </template>
  
  <script setup>
  import { reactive, onMounted, ref } from "vue";
  import Header from "./Header.vue";
  const category_id = defineProps(['id','category_id'])
  
  const categories = ref(null);
  const products = ref(null);
  
  
  // import store from "../../store";
  axios.get(`products/${category_id.id}`).then((res) => {
      products.value = res.data
      console.log(products.value);
  })
  onMounted(async () => {
      const { data } = await axios.get(`category_id/${category_id.id}`);
      categories.value = data;  
  });
    </script>