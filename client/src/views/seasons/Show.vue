<template>
  <spinner v-if="preLoading" />
  <div v-else>
    <div>
      <fixture-list :fixtures="season.fixtures" />
    </div>
  </div>
</template>

<script>
import Spinner from "@/components/Spinner.vue";
import { show } from "@/api/seasons.api";
import FixtureList from "@/components/FixtureList.vue";

export default {
  name: "season-show",
  components: { Spinner, FixtureList },
  computed: {
    seasonId() {
      return this.$route.params.id;
    },
  },
  watch: {
    seasonId() {
      this.preLoading = true;
      this.fetchData();
    },
  },
  data() {
    return {
      preLoading: true,
      season: null,
    };
  },
  methods: {
    async fetchData() {
      const { data } = await show(this.seasonId);
      this.season = data;
      this.preLoading = false;
    },
  },
  mounted() {
    this.fetchData();
  },
};
</script>

<style></style>
