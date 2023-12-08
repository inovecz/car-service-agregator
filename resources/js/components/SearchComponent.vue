<template>
  <div class="mt-3">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900">
        <form @submit.prevent="searchProducts()" class="mb-8">
          <div class="flex items-center justify-center">
            <div class="flex border-2 rounded w-full">
              <input
                v-model="searchCode"
                type="text"
                id="searchCode"
                name="searchCode"
                class="px-4 py-2 w-full"
                placeholder="Hledat podle kódu"
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
        <div
          v-if="!loading && !products?.length"
          class="mt-4 flex justify-center font-semibold"
        >
          Nejsou výsledky k zobrazení.
        </div>
        <div v-if="loading" class="mt-3 flex justify-center">
          <span
            class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-indigo-500 transition ease-in-out duration-150"
          >
            <svg
              class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
            >
              <circle
                class="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                stroke-width="4"
              ></circle>
              <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
              ></path>
            </svg>
            Načítám...
          </span>
        </div>

        <div v-if="products && products.length" class="mt-3">
          <div class="grid grid-flow-col">
            <div
              class="not-prose relative bg-slate-50 rounded-xl overflow-hidden dark:bg-slate-800/25"
            >
              <!-- <div
                style="background-position: 10px 10px"
                class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,#fff,rgba(255,255,255,0.6))] dark:bg-grid-slate-700/25 dark:[mask-image:linear-gradient(0deg,rgba(255,255,255,0.1),rgba(255,255,255,0.5))]"
              ></div> -->
              <div class="relative rounded-xl overflow-auto">
                <div class="shadow-sm overflow-hidden">
                  <div class="relative ms-3 my-3">
                    <fieldset
                      class="border grid grid-cols-3 gap-2 border-solid border-gray-300 p-3 w-full me-3 my-3 mb-8 bg-w"
                    >
                      <legend>Filtry</legend>
                      <div>
                        <label for="searchCode" class="text-sm">Kód produktu</label>
                        <input
                          type="text"
                          id="searchCode"
                          placeholder="Hledat"
                          class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                        />
                      </div>
                      <div>
                        <label for="searchProductName" class="text-sm"
                          >Název produktu</label
                        >
                        <input
                          type="text"
                          id="searchProductName"
                          placeholder="Hledat"
                          class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                        />
                      </div>
                      <div>
                        <label for="searchSupplier" class="text-sm">Dodavatel</label>
                        <input
                          type="text"
                          id="searchSupplier"
                          placeholder="Hledat"
                          class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                        />
                      </div>
                      <div>
                        <label for="searchPrice" class="text-sm">Cena</label>
                        <input
                          type="text"
                          id="searchPrice"
                          placeholder="Hledat"
                          class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                        />
                      </div>
                      <div>
                        <label for="searchAvailability" class="text-sm">Dostupnost</label>
                        <input
                          type="text"
                          id="searchAvailability"
                          placeholder="Hledat"
                          class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                        />
                      </div>
                    </fieldset>
                  </div>

                  <table class="border-collapse table-auto w-full text-sm">
                    <thead>
                      <tr>
                        <th
                          @click="sortBy('product_code')"
                          class="sortable border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                        >
                          Kód produktu
                          <span :class="sortIcon('product_code')"> </span>
                        </th>
                        <th
                          @click="sortBy('product_name')"
                          class="sortable border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                        >
                          Název produktu<span :class="sortIcon('product_name')"> </span>
                        </th>
                        <th
                          @click="sortBy('supplier_name')"
                          class="sortable border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                        >
                          Dodavatel<span :class="sortIcon('supplier_name')"> </span>
                        </th>
                        <th
                          @click="sortBy('price')"
                          class="sortable border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                        >
                          Cena<span :class="sortIcon('price')"> </span>
                        </th>
                        <th
                          @click="sortBy('availability')"
                          class="sortable border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                        >
                          Dostupnost<span :class="sortIcon('availability')"> </span>
                        </th>
                        <th
                          class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                        >
                          Náhled
                        </th>
                        <th
                          class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                        ></th>
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
                        <td
                          class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400"
                        >
                          {{ product.price }}
                        </td>
                        <td
                          class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400"
                        >
                          {{ product.availability }}
                        </td>
                        <td
                          class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400"
                        >
                          <img
                            v-if="product && product.media_url"
                            :src="product.media_url"
                            class="image_preview"
                            @click="toggleModal(product)"
                          />
                        </td>
                        <td
                          class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400"
                          style="display: table-cell"
                        >
                          <div class="flex justify-end">
                            <a
                              v-if="product && product.url"
                              :href="'//' + product.url"
                              target="_blank"
                              ><i class="bi bi-eye text-lg"></i
                            ></a>
                          </div>
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

    <div
      v-show="isOpen"
      class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 h-full"
    >
      <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
        <div class="flex items-center justify-between">
          <h3 class="text-2xl">Náhled produktu</h3>
          <svg
            @click="toggleModal()"
            xmlns="http://www.w3.org/2000/svg"
            class="w-8 h-8 text-primary-900 cursor-pointer"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
        </div>
        <div class="mt-4">
          <img :src="productForModal?.media_url" class="product_preview"/>
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
      loading: false,
      sortKey: '',
      sortDirection: 1,
      isOpen: false,
      productForModal: null
    };
  },

  methods: {
    searchProducts() {
      let self = this;
      self.loading = true;
      let queryString = '?productCode=' + self.searchCode;

      http.get('/search-products' + queryString).then((response) => {
        self.products = response.data.products;
        self.loading = false;
      });
    },

    sortBy(key) {
      if (this.sortKey === key) {
        this.sortDirection = this.sortDirection * -1;
      } else {
        this.sortDirection = 1;
        this.sortKey = key;
      }

      this.sortProducts();
    },

    sortProducts() {
      this.products.sort((a, b) => {
        const key = this.sortKey;
        const direction = this.sortDirection;

        if (a[key] > b[key]) return direction;
        if (a[key] < b[key]) return -direction;
        return 0;
      });
    },

    sortIcon(key) {
      let self = this;
      if (this.sortKey === key) {
        if (self.sortDirection === 1) {
          return 'bi bi-caret-down-fill';
        } else return 'bi bi-caret-up-fill';
      }
      return;
    },

    toggleModal(product) {
      this.isOpen = !this.isOpen;
      if (product) {
        this.productForModal = product;
      } else {
        this.productForModal = null;
      }
    },
    /* iconStyle(key) {
      if (this.sortKey === key) {
        return { transform: `rotate(${this.sortDirection === 1 ? 0 : 180}deg)` };
      }
      return {};
    }, */
  },
};
</script>
