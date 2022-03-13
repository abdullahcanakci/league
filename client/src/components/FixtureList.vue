<template>
  <div>
    <h2 class="font-semibold">Fixtures</h2>
    <ul class="flex flex-row flex-wrap gap-4 justify-center mt-4 w-full">
      <li class="w-full md:w-1/3 lg:w-1/4" v-for="week in Object.keys(fixtures)" :key="week">
        <fixture :group="fixtures[week]" :week="week" />
      </li>
    </ul>
  </div>
</template>

<script>
import Fixture from "./Fixture.vue";
export default {
  props: ["fixtures"],
  components: { Fixture },
};
</script>

<style></style>
