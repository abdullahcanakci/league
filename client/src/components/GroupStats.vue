<template>
  <table class="w-full rounded-md">
    <thead class="w-full py-2 bg-black text-white font-bold border-x-2">
      <tr class="w-full">
        <th>Team Name</th>
        <th>Points</th>
        <th>Played</th>
        <th>Won</th>
        <th>Drawn</th>
        <th>Lost</th>
        <th>Goal Diff</th>
      </tr>
    </thead>
    <tbody class="border-x-2">
      <tr class="border-b-2" v-for="standing in standings" :key="standing.id">
        <td>{{ standing.team.name }}</td>
        <td>{{ standing.points }}</td>
        <td>{{ standing.plays }}</td>
        <td>{{ standing.wins }}</td>
        <td>{{ standing.draws }}</td>
        <td>{{ standing.loses }}</td>
        <td>{{ standing.goals - standing.goals_conceded }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: ["standings"],
};
</script>
<style>
th {
  @apply p-1;
}
td {
  @apply border-r-2;
}
</style>
