import Vue from "vue";
import VueRouter from "vue-router";

import Home from "./pages/Home.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
      {
        path: "/",
        name: "home",
        component: Home,
      },
      {
        path: "/advanced-research",
        name: "advanced-research",
        component: AdvancedResearch,
      },
      {
        path: "/hotel",
        name: "hotel",
        component: Hotel,
      },
      {
        path: "/send-message",
        name: "send-message",
        component: SendMessage,
      },
      {
        path: "/message-error",
        name: "message-error",
        component: MessageError,
      },
      
    ],
  });
  
  export default router;