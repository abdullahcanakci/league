<template>
  <div class="spinner-border spinner-border-sm" role="status" v-if="show">
    <span class="visually-hidden">Loading...</span>
  </div>
</template>

<script>
export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "spinner",
  props: { show: { type: Boolean, default: true } },
};
</script>

<style></style>
