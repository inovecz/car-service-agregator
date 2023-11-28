<template>
  <div class="mt-3">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900">
        <form>
          <div class="flex items-center justify-center">
            <div class="flex border-2 rounded">
              <input type="text" class="px-4 py-2 w-80" placeholder="Search..." />
              <button class="flex items-center justify-center px-4 border-l">
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
        <div v-if="products">Tu budou produkty</div>
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

      http.get('search-products' + queryString).then((response) => {
        self.products;
      });
    },
  },
};
</script>
