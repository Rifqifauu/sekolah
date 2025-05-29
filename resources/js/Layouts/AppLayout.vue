<template>
  <div class="min-h-screen flex flex-col">
    <Header :user="user" />
    
    <main class="flex-grow">
      <slot></slot>
    </main>
    
    <Footer/>
  </div>
</template>

<script>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
export default {
  name: "AppLayout",
  components: {
    Header,
    Footer,
  },
  props: {
    user: Object,
  },
};
</script>
