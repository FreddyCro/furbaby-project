<template lang="pug">
#app
  fk-dashboard
  fk-header
  router-view
</template>

<script>
import FkDashboard from '@/components/fk-dashboard.vue';
import FkHeader from '@/components/fk-header.vue';

export default {
  name: 'App',
  components: {
    FkDashboard,
    FkHeader,
  },
};
</script>
