<template>
  <div class="mt-3">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900">
        <form @submit.prevent="searchProducts()">
          <div class="flex items-center justify-center">
            <div class="flex border-2 rounded w-full">
              <input
                v-model="searchCode"
                type="text"
                id="searchCode"
                name="searchCode"
                class="px-4 py-2 w-full"
                placeholder="Search..."
              />
              <button
                type="submit"
                class="flex items-center justify-center px-4 border-l"
              >
                <svg
                  class="w-6 h-6 text-gray-600"
                  fill="currentColor"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"
                  />
                </svg>
              </button>
            </div>
          </div>
        </form>
        <div v-if="products.length" class="mt-3">
          <div class="grid grid-flow-col">
            <div
              class="not-prose relative bg-slate-50 rounded-xl overflow-hidden dark:bg-slate-800/25"
            >
              <div
                style="background-position: 10px 10px"
                class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,#fff,rgba(255,255,255,0.6))] dark:bg-grid-slate-700/25 dark:[mask-image:linear-gradient(0deg,rgba(255,255,255,0.1),rgba(255,255,255,0.5))]"
              ></div>
              <div class="relative rounded-xl overflow-auto">
                <div class="shadow-sm overflow-hidden my-8">
                  <table class="border-collapse table-auto w-full text-sm">
                    <thead>
                      <tr>
                        <th
                          class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                        >
                          Kód produktu
                        </th>
                        <th
                          class="border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                        >
                          Název produktu
                        </th>
                        <th
                          class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                        >
                          Dodavatel
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-slate-800">
                      <tr v-for="product in products">
                        <td
                          class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"
                        >
                          {{ product.product_code }}
                        </td>
                        <td
                          class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400"
                        >
                          {{ product.product_name }}
                        </td>
                        <td
                          class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400"
                        >
                          {{ product.supplier_name }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div
                class="absolute inset-0 pointer-events-none border border-black/5 rounded-xl dark:border-white/5"
              ></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import http from '@/http';

export default {
  mounted() {},

  data() {
    return {
      searchCode: null,
      products: [],
    };
  },

  methods: {
    searchProducts() {
      let self = this;
      let queryString = '?productCode=' + self.searchCode;

      http.get('/search-products' + queryString).then((response) => {
        self.products = response.data.products;
      });
    },
  },
};
</script>
