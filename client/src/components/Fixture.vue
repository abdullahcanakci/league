<template>
  <div class="card rounded-md shadow-md w-full border-2 border-gray-100">
    <span class="bg-black text-white py-1 px-2">Week {{ week }}</span>
    <ul class="p-2">
      <li class="flex" v-for="fixture in group" :key="fixture.id">
        <span class="w-1/3">{{ fixture.homeTeam.name }}</span>
        <span class="w-1/3 text-center">
          {{ fixture.home_goals }} - {{ fixture.away_goals }}
        </span>
        <span class="w-1/3 text-right">{{ fixture.awayTeam.name }}</span>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ["group", "week"],
};
</script>

<style></style>
