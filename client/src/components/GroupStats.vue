<template>
  <table class="w-full rounded-md overflow-hidden">
    <thead class="w-full py-2 bg-black text-white font-bold border-x-2">
      <tr class="w-full">
        <th>Team Name</th>
        <th>Points</th>
        <th>Played</th>
        <th>Won</th>
        <th>Drawn</th>
        <th>Lost</th>
        <th>Goal Diff</th>
        <th>Chance</th>
      </tr>
    </thead>
    <tbody class="border-x-2">
      <tr
        class="border-b-2"
        v-for="standing in orderedStandings"
        :key="standing.id"
      >
        <td>{{ standing.team.name }}</td>
        <td>{{ standing.points }}</td>
        <td>{{ standing.plays }}</td>
        <td>{{ standing.wins }}</td>
        <td>{{ standing.draws }}</td>
        <td>{{ standing.loses }}</td>
        <td>{{ standing.goals - standing.goals_conceded }}</td>
        <td>{{ standing.chance }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: ["standings"],
  computed: {
    orderedStandings() {
      const temp = [...this.standings];
      temp.sort((a, b) => b.points - a.points);
      return temp;
    },
  },
};
</script>
<style>
th {
  @apply p-1;
}
td {
  @apply border-r-2 first-of-type:border-l-2;
}
</style>
