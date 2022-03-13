<template>
  <div class="flex justify-center items-center h-full">
    <div>
      <button class="btn btn-primary" :disabled="loading" @click="createSeason">
        Create a Season <spinner :show="loading" />
      </button>
    </div>
  </div>
</template>

<script>
import { store } from "@/api/seasons.api";
import Spinner from "../components/Spinner.vue";
export default {
  components: { Spinner },
  data() {
    return {
      loading: false,
    };
  },
  methods: {
    async createSeason() {
      if (this.loading) return;
      this.loading = true;
      const { data } = await store();

      if (data) {
        console.log(data);
        this.$router.push({ name: "seasons.show", params: { id: data.id } });
      }

      this.loading = false;
    },
  },
};
</script>

<style></style>
