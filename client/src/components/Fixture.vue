<template>
  <div class="card rounded-md shadow-md w-full border-2 border-gray-100">
    <span class="bg-black text-white py-1 px-2">Week {{ week }}</span>
    <ul class="p-2">
      <li class="" v-for="fixture in group" :key="fixture.id">
        {{ fixture.homeTeam.name }} {{ fixture.home_goals }} -
        {{ fixture.away_goals }} {{ fixture.awayTeam.name }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ["group", 'week'],
};
</script>

<style></style>
