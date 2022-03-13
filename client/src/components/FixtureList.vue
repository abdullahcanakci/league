<template>
  <div class="">
    <h2 class="font-semibold">Fixtures</h2>
    <ul class="flex flex-row flex-wrap justify-start mt-4">
      <li
        class="w-full md:w-1/2 lg:w-1/3 p-1"
        v-for="week in Object.keys(fixtures)"
        :key="week"
      >
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
