<template lang="pug">
#app
  fk-dashboard
  fk-header
  transition(name="fade")
    router-view

  //- footer decoration
  fk-pic(
    src="/assets/img/landing/red_ribbon.png"
    alt="red decoration"
  )

  fk-footer
</template>

<script>
import FkDashboard from '@/components/fk-dashboard.vue';
import FkHeader from '@/components/fk-header.vue';
import FkFooter from '@/components/fk-footer.vue';
import FkPic from '@/components/fk-pic.vue';

export default {
  name: 'App',
  components: {
    FkDashboard,
    FkHeader,
    FkFooter,
    FkPic,
  },
};
</script>
