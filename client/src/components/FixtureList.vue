<template>
  <ul
    class="d-flex flex-row gap-2 list-unstyled flex-wrap justify-content-start"
  >
    <li
      class="card list-item rounded-md"
      style="width: 45%"
      v-for="group in Object.keys(groupedFixtures)"
      :key="group"
    >
      <span class="bg-black text-white py-1 px-2">Week {{ group }}</span>
      <ul class="list-group">
        <li
          class="list-group-item"
          v-for="fixture in groupedFixtures[group]"
          :key="group"
        >
          {{ fixture.homeTeam.name }} - {{ fixture.awayTeam.name }}
        </li>
      </ul>
    </li>
  </ul>
</template>

<script>
export default {
  props: ["fixtures"],

  computed: {
    groupedFixtures() {
      const weeks = {};
      this.fixtures.forEach((fixture) => {
        if (!weeks[fixture.week]) {
          weeks[fixture.week] = [];
        }
        weeks[fixture.week].push(fixture);
      });
      return weeks;
    },
  },
};
</script>

<style></style>
