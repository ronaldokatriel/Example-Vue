<template>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      value=""
      id="flexCheckDefault"
    />
    <label
      class="form-check-label"
      v-bind:class="{ 'item-completed': tugasSaya.isDone }"
      for="flexCheckDefault"
      >{{ tugasSaya.namaTugas }}</label
    >
  </div>
</template>

<script>
export default {
    name: "ItemTugas",
    props: ["tugasSaya"]
};
</script>

<style scoped>
</style>