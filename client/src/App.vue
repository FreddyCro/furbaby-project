<template lang="pug">
#app
  //- fk-dashboard
  fk-header
  transition(name="fade")
    router-view

  fk-footer
</template>

<script>
// import FkDashboard from '@/components/fk-dashboard.vue';
import FkHeader from '@/components/fk-header.vue';
import FkFooter from '@/components/fk-footer.vue';

export default {
  name: 'App',
  components: {
    // FkDashboard,
    FkHeader,
    FkFooter,
  },
};
</script>
