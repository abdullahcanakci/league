<template>
  <spinner v-if="preLoading" />
  <div v-else>
    <div class="flex flex-col gap-4 w-full">
      <fixture-list :fixtures="groupedFixtures" />
      <div class="flex flex-row flex-wrap">
        <group-stats class="w-full md:w-2/3" :standings="season.standings" />
        <div class="w-full md:w-1/3 md:pl-2" v-if="season.week">
          <fixture :group="groupedFixtures[season.week]" :week="season.week" />
          <button
            class="btn btn-primary btn-sm mt-2"
            @click="playWeek"
            :disabled="season.concluded"
          >
            Play Week
          </button>
        </div>
      </div>
      <div>
        <button
          class="btn btn-primary btn-sm"
          :disabled="season.concluded"
          @click="playAllWeeks"
        >
          Play all weeks
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import Spinner from "@/components/Spinner.vue";
import { show, play } from "@/api/seasons.api";
import FixtureList from "@/components/FixtureList.vue";
import GroupStats from "@/components/GroupStats.vue";
import Fixture from "@/components/Fixture.vue";

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

export default {
  name: "season-show",
  components: { Spinner, FixtureList, GroupStats, Fixture },
  computed: {
    seasonId() {
      return this.$route.params.id;
    },
    groupedFixtures() {
      const weeks = {};
      this.season.fixtures.forEach((fixture) => {
        if (!weeks[fixture.week]) {
          weeks[fixture.week] = [];
        }
        weeks[fixture.week].push(fixture);
      });
      return weeks;
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
    async playWeek() {
      const { data } = await play(this.seasonId);
      this.season = data;
    },
    async playAllWeeks() {
      while (!this.season.concluded) {
        await this.playWeek();
        await sleep(500);
      }
    },
  },
  mounted() {
    this.fetchData();
  },
};
</script>

<style></style>
