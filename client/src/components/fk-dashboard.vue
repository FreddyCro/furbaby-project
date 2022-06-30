<template lang="pug">
.fk-dashboard
  .fk-dashboard__text user: {{ $store.state.user }} |
  .fk-dashboard__text type: {{ $store.state.type }} |
  .fk-dashboard__text score: {{ $store.state.type ? $store.state[$store.state.type].score : 0 }}

</template>

<script>
export default {
  name: 'FkDashboard',
};
</script>

<style lang="scss">
.fk-dashboard {
  position: fixed;
  z-index: 999;
  left: 0;
  top: 0;
  display: flex;
  background-color: lightblue;

  &__text {
    margin-right: 0.5rem;
  }
}
</style>
